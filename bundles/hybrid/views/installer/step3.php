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
    <h1>Done</h1>

	<?php $message = Hybrid\Messages::retrieve(); ?>
	<?php if ($message instanceof Hybrid\Messages): ?>
        <?php foreach (array('error', 'info', 'success') as $key): ?>
            <?php if ($message->has($key)): ?>
                <?php $message->format('<div class="alert alert-'.$key.'">:message<a class="close" data-dismiss="alert">×</a></div>') ?>
                <?php echo implode('', $message->get($key)) ?>
            <?php endif ?> 
        <?php endforeach ?>
    <?php endif ?>
</div>
<div class="page-footer">
</div>