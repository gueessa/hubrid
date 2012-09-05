<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex" />
	<meta name="robots" content="nofollow" />
    <title></title>

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->   

    <?php
    	$asset = Asset::container('hybrid.backend')
            ->style('reset',        'bundles/hybrid/css/reset.css')
            ->style('layout',       'bundles/hybrid/css/layout.css')
            ->style('forms',        'bundles/hybrid/css/forms.css', 'reset')
            ->style('alerts',       'bundles/hybrid/css/alerts.css', 'reset')
            ->style('buttons',      'bundles/hybrid/css/buttons.css', 'reset')
            
            // Jquery
            ->script('jquery',      'bundles/hybrid/js/jquery/jquery.min.js')
            ->script('form',        'bundles/hybrid/js/jquery/jquery.form.min.js', 'jquery')
            
            // Backbone
            ->script('json2',       'bundles/hybrid/js/backbone/json2.js')
            ->script('underscore',  'bundles/hybrid/js/backbone/underscore.min.js', 'jquery')
            ->script('backbone',    'bundles/hybrid/js/backbone/backbone.min.js', 'jquery')
            //->script('localstorage','bundles/hybrid/js/backbone/backbone-localstorage.js', 'backbone')
           
            
            // Core
            ->script('core',        'bundles/hybrid/js/core/core.js', 'jquery')
            ->script('ajax',        'bundles/hybrid/js/core/ajax.js', 'jquery')
            
            // Plugins
            ->script('layout',      'bundles/hybrid/js/plugins/layout.js', 'jquery')
            ->script('validator',   'bundles/hybrid/js/plugins/validator.js', 'jquery')
            ->script('alert',       'bundles/hybrid/js/plugins/alert.js', 'jquery');
            
        echo $asset->styles();
        echo $asset->scripts();            
    ?>

    @section('styles')
    @yield_section

    @section('scripts')
    @yield_section

    <noscript></noscript>
</head>    
<body class="right-panel-visible">
    <!-- Header begin -->
    <header>
    
        <div class="branding">
        </div>
        
        <nav class="main-navigation">
        </nav>
        
        <div class="side-bar">
        </div>
        
        <div class="bread-crumb">
        </div>
        
    </header>
    <!-- Header end -->

    <!-- Content end -->
    <section>
        @yield('content')
    </section>
    <!--
    <section class="three-panels">
        <div class="left-panel" data-role="left-panel">
        </div>
        <div class="center-panel" data-role="center-panel">
        </div>
        <div class="right-panel" data-role="right-panel">
        </div>
        <div class="bottom-panel" data-role="bottom-panel">
            <div class="bottom-bar">
                <div class="help-bar">
                </div>
            </div>
        </div>
    </section>
    -->
    <!--
    <section class="main-container">
        <div class="nav-container">
        </div>
        <div class="page-container">
            <div class="page-header">
                <table>
                    <tr>
                        <td class="title"><h1></h1></td>
                        <td class="shortcuts">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    -->
    <!-- Content end -->

    <!-- Footer begin -->
    <footer>
    </footer>
    <!-- Footer end -->
</body>
</html>