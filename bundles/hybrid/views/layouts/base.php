<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex" />
	<meta name="robots" content="nofollow" />
    <title></title>
	<?php 
	   $asset = Asset::container('hybrid.backend');
	   $asset->script('jquery', 'bundles/Hybrid/js/jquery.min.js');

	   echo $asset->styles();
	   echo $asset->scripts(); 
    ?>
    <noscript></noscript>
</head>    
<body>
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
    <section class="main-container">
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
            <?php if (isset($content)) echo $content ?>
        </div>
    </section>
    <!-- Content end -->

    <!-- Footer begin -->
    <footer>
    </footer>
    <!-- Footer end -->
</body>
</html>