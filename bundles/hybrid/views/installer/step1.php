<div class="page-header">
    <div class="navigation">
        <ul>
            <li><?php echo HTML::link(handles('hybrid::installer'), __('hybrid::installer.tabs.database')) ?></li>
            <li><?php echo HTML::link(handles('hybrid::installer/steps/1'), __('hybrid::installer.tabs.account')) ?></li>
            <li><?php echo HTML::link(handles('hybrid::installer/steps/2'), __('hybrid::installer.tabs.done')) ?></li>
        </ul>
    </div>
</div>

<div class="page-body">

    <h3><?php echo __('hybrid::installer.titles.database_setting') ?></h3>

	<?php $message = Hybrid\Messages::retrieve(); ?>
	<?php if ($message instanceof Hybrid\Messages): ?>
        <?php foreach (array('error', 'info', 'success') as $key): ?>
            <?php if ($message->has($key)): ?>
                <?php $message->format('<div class="alert alert-'.$key.'">:message<button class="close" data-dismiss="alert">×</button></div>') ?>
                <?php echo implode('', $message->get($key)) ?>
            <?php endif ?> 
        <?php endforeach ?>
    <?php endif ?>

    <div class="fields horizontal">
        <div class="field">
            <?php echo Form::label('driver', __('hybrid::installer.labels.database_type')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $database['driver'] ?></span>
            </div> 
        </div>
        <div class="field">
            <?php echo Form::label('host', __('hybrid::installer.labels.database_host')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $database['host'] ?></span>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('database', __('hybrid::installer.labels.database')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $database['database'] ?></span>
            </div> 
        </div>
        <div class="field">
            <?php echo Form::label('username', __('hybrid::installer.labels.database_username')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $database['username'] ?></span>
            </div> 
        </div>
        <div class="field">
            <?php echo Form::label('password', __('hybrid::installer.labels.database_password')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $database['password'] ?></span>
            </div> 
        </div>
        <div class="field">
            <?php echo Form::label('status', __('hybrid::installer.labels.database_connection')) ?>
            <div class="controls">
                <?php if (true === $database['status']) : ?>
                    <span class="uneditable-input success"><?php echo __('hybrid::installer.labels.database_connection_success') ?></span>
                <?php else: ?>
                    <span class="uneditable-input fail"><?php echo __('hybrid::installer.labels.database_connection_fail') ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>
    
    <h3><?php echo __('hybrid::installer.titles.authentication_setting') ?></h3>
    
    <?php
        $auth_fluent = $auth_eloquent = true;

		if ($auth['driver'] === 'fluent' and $auth['table'] !== 'users') $auth_fluent = false;
		if ($auth['driver'] === 'eloquent' and ltrim($auth['model'], '\\') !== 'Hybrid\Model\User') $auth_eloquent = false; 
    ?>
    
    <div class="alert alert-info"><?php echo __('hybrid::installer.hints.auth') ?></div>
    
    <div class="fields horizontal">
        <div class="field">
            <?php echo Form::label('driver', __('hybrid::installer.labels.auth_driver')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $auth['driver'] ?></span>
            </div> 
        </div>
        <div class="field">
            <?php echo Form::label('table', __('hybrid::installer.labels.auth_table')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $auth['table'] ?></span> 
                <?php if (false === $auth_fluent): ?>
                    <div class="error"><?php echo __('hybrid::installer.errors.auth_table') ?></div>
                <?php endif ?>
            </div>
        </div>
        <div class="field">
            <?php echo Form::label('driver', __('hybrid::installer.labels.auth_model')) ?>
            <div class="controls">
                <span class="uneditable-input"><?php echo $auth['model'] ?></span>
                <?php if (false === $auth_eloquent): ?>
                    <div class="error"><?php echo __('hybrid::installer.errors.auth_model') ?></div>
                <?php endif ?> 
            </div>
        </div>
    </div>
        
</div>

<div class="page-footer">
	<?php if (true === $database['status'] and true === $auth_fluent && true === $auth_eloquent): ?>
		<?php echo HTML::link(handles('hybrid::installer/steps/1'), __('hybrid::hybrid.buttons.next'), array('class' => 'btn btn-success')) ?>
    <?php endif ?>
</div>