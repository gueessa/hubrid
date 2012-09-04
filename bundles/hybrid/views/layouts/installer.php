<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex" />
	<meta name="robots" content="nofollow" />
    <title></title>
    <?php
    	$asset = Asset::container('hybrid.backend')
            ->style('reset',        'bundles/hybrid/css/reset.css')
            ->style('forms',        'bundles/hybrid/css/forms.css', 'reset')
            ->style('alerts',       'bundles/hybrid/css/alerts.css', 'reset')
            ->style('buttons',      'bundles/hybrid/css/buttons.css', 'reset')
            ->style('installer',    'bundles/hybrid/css/installer.css', 'reset')
            ->script('jquery',      'bundles/hybrid/js/jquery.min.js')
            ->script('form',        'bundles/hybrid/js/jquery.form.min.js', 'jquery')
            ->script('core',        'bundles/hybrid/js/core.js', 'jquery')
            ->script('ajax',        'bundles/hybrid/js/ajax.js', 'jquery')
            ->script('validator',   'bundles/hybrid/js/plugins/validator.js', 'jquery')
            ->script('alert',       'bundles/hybrid/js/plugins/alert.js', 'jquery');
        echo $asset->styles();
        echo $asset->scripts();            
    ?>
    <noscript></noscript>
</head>    
<body>
    
    <!-- Header -->
    <div class="header">
        <div class="section">
        </div>
    </div>
    <!-- @end header -->
    
    <!-- Content -->
    <div class="content">
        <div class="section">
            <?php if (isset($content)) echo $content ?>
        </div>
    </div>
    <!-- @end content -->
    
    <!-- Footer -->
    <div class="footer">
        <div class="section">
        </div>
    </div>
    <!-- @end footer -->
    
    <?php if (isset($javascript)) echo $javascript ?>
    
</body>
</html>