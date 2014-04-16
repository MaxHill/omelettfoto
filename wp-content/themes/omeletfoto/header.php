<?php
	//Set variables for performance
	$turl = get_bloginfo("template_url");
?>
<!doctype html>
<!--[if lt IE 7]> 	<html class="no-js ie6 oldie" lang="en">	<![endif]-->
<!--[if IE 7]>    	<html class="no-js ie7 oldie" lang="en">	<![endif]-->
<!--[if IE 8]>    	<html class="no-js ie8 oldie" lang="en">	<![endif]-->
<!--[if gt IE 8]>	<!--> <html class="no-js" lang="en"> 		<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title('|', true, 'right'); ?></title>

<!-- Mobile viewport -->
<meta name="viewport" content="width=device-width,initial-scale=1">


<!-- Favicon and Feed -->
<link rel="shortcut icon" type="image/png" href="<?php echo $turl; ?>/favicon.png">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
<?php 
	//----------------------------------------------------
	//	Include iOS touch icons if is_mobile()
	//----------------------------------------------------	
	if(function_exists('is_ios') && is_ios()) get_template_part('parts/general/head-mobile-icons');
	

	//----------------------------------------------------
	//	Javascriptfiles (Combined & Minified by Houston)
	//----------------------------------------------------
    wp_enqueue_script('jquery');
    wp_enqueue_script('modernizr', $turl . '/assets/js/vendor/modernizr-2.6.2.min.js','','',false);
    //wp_enqueue_script('salvattore', $turl . '/assets/js/vendor/salvattore.js','','',true);
    wp_enqueue_script('plugin', $turl . '/assets/js/plugins.min.js','','',true);
	wp_enqueue_script('app', $turl . '/assets/js/source/main.js','','',true);


	//----------------------------------------------------
	//	Additional CSSfiles
	//----------------------------------------------------
    
	wp_head();
?>

<!-- Styles -->
<link rel="stylesheet" href="<?php echo $turl; ?>/assets/css/ui.css">
<link rel="stylesheet" href="<?php echo $turl; ?>/assets/css/framework.css">
<link rel="stylesheet" href="<?php echo $turl; ?>/assets/css/app.css">

    <link rel="stylesheet" href="<?php echo $turl; ?>/css/ie.css">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="<?php echo $turl; ?>/assets/js/vendor/respond.min.js"></script>
    <![endif]-->

</head>
<body <?php body_class(); ?>>
<!-- Body scripts (FB-SDK)-->
<?php get_template_part('parts/general/body-scripts'); ?>

<!-- Navigation -->
<?php do_action("houston_before_nav"); ?>
<nav id="navigation">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a id="logo" class="brand" href="<?php bloginfo("home"); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
            </div>
            <div class="col-8">
             <?php
                $navigation = 'primary_navigation';
                wp_nav_menu( array(
                    'container' => false,
                    'container_class' => false,
                    'theme_location' => $navigation,
                    'menu_class' => 'nav',
                ) );
            ?>
            </div>
        </div>
    </div>
</nav>
<?php do_action("houston_after_nav"); ?>
<!-- End nav -->

