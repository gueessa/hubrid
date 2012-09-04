<div class="login-container">

    <div class="header">
        <div class="logo"></div>
    </div>
    
    <?php echo Form::open(handles('hybrid::login'), 'POST', array('data-ajax' => 'true')) ?>

       <?php echo Form::token() ?>
	   <?php echo Form::hidden('redirect', $redirect) ?>

        <div class="body">
            <div class="field">
                <span><i class="username"></i></span>
                <?php echo Form::text('username', Form::value('username'), array('placeholder' => __('hybrid::auth.labels.username'))) ?>
                <?php echo Form::error('username') ?>
            </div>
            <div class="field">
                <span><i class="password"></i></span>
                <?php echo Form::password('password', array('placeholder' => __('hybrid::auth.labels.password'))) ?>
                <button class="btn" onclick="$(this.children).addClass('preloader');"><i class="btn"></i></button>
                <?php echo Form::error('password') ?>
            </div>
            <div class="field">
                <?php echo Form::checkbox('remember', 1, Form::value('remember') == 1, array('class' => 'float-left')) ?>
                <?php echo Form::label('remember', __('hybrid::auth.labels.remember')) ?> 
            </div>    
        </div>

    <?php echo Form::close() ?>
    
    <div class="footer"></div>
        
</div>