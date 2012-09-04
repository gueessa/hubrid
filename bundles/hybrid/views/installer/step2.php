<div class="page-header">
    <div class="navigation">
        <ul>
            <li><?php echo HTML::link(handles('hybrid::installer'), __('hybrid::installer.tabs.database')) ?></li>
            <li><?php echo HTML::link(handles('hybrid::installer/steps/1'), __('hybrid::installer.tabs.account')) ?></li>
            <li><?php echo HTML::link(handles('hybrid::installer/steps/2'), __('hybrid::installer.tabs.done')) ?></li>
        </ul>
    </div>
</div>

<?php echo Form::open(handles('hybrid::installer/steps/2'), 'POST') ?>

<div class="page-body">

    <h3><?php echo __('hybrid::installer.titles.create_account') ?></h3>    

	<?php $message = Hybrid\Messages::retrieve() ?>
	<?php if ($message instanceof Hybrid\Messages): ?>
        <?php foreach (array('error', 'info', 'success') as $key): ?>
            <?php if ($message->has($key)): ?>
                <?php $message->format('<div class="alert alert-'.$key.'">:message<a class="close" data-dismiss="alert">×</a></div>') ?>
                <?php echo implode('', $message->get($key)) ?>
            <?php endif ?> 
        <?php endforeach ?>
    <?php endif ?>

    <div class="fields horizontal">
        <div class="field">
            <?php echo Form::label('username', __('hybrid::installer.labels.auth_username'), array('class' => 'required')) ?>
            <div class="controls">
                <?php echo Form::text('username', Form::value('username'), array('data-validations' => 'required')) ?>
                <?php echo Form::error('username') ?>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('email', __('hybrid::installer.labels.auth_email'), array('class' => 'required')) ?>
            <div class="controls">
                <?php echo Form::text('email', Form::value('email'), array('data-validations' => 'required|email')) ?>
                <?php echo Form::error('email') ?>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('password', __('hybrid::installer.labels.auth_password'), array('class' => 'required')) ?>
            <div class="controls">
                <?php echo Form::text('password', Form::value('password'), array('data-validations' => 'required')) ?>
                <?php echo Form::error('password') ?>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('fullname', __('hybrid::installer.labels.auth_fullname'), array('class' => 'required')) ?>
            <div class="controls">
                <?php echo Form::text('fullname', Form::value('fullname'), array('data-validations' => 'required')) ?>
                <?php echo Form::error('fullname') ?>
            </div>
        </div>
    </div>

    <h3><?php echo __('hybrid::installer.titles.application_information') ?></h3>
    
    <div class="fields horizontal">
        <div class="field">
            <?php echo Form::label('site_name', __('hybrid::installer.labels.app_site_name')) ?>
            <div class="controls">
                <?php echo Form::text('site_name', Form::value('site_name'), array('data-validations' => 'required')) ?>
                <?php echo Form::error('site_name') ?>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('site_email', __('hybrid::installer.labels.app_site_email')) ?>
            <div class="controls">
                <?php echo Form::text('site_email', Form::value('site_email'), array('data-validations' => 'required|email')) ?>
                <?php echo Form::error('site_email') ?>
            </div>
        </div>
    </div>        
</div>

<div class="page-footer">
    <?php echo Form::submit(__('hybrid::hybrid.buttons.submit'), array('class' => 'btn btn-success')) ?>
</div>

<?php echo Form::close() ?>

<script>
$(document).ready(function() {
    $('input').validator({
        events   : 'blur change',
        callback : function(elem, valid) {
            if ( ! valid) {
                $(elem).closest('div.controls').addClass('error');
                $(elem).addClass('error');
            }
            else {
                $(elem).closest('div.controls').addClass('success');
                $(elem).addClass('success');
            }
        }
    });
});
</script>