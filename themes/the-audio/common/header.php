<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    
    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

<!-- Plugin Stuff -->

    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


<!-- Stylesheets -->
    <?php 
	queue_css_file('normalize');
	queue_css_file('style');
	queue_css_url('http://fonts.googleapis.com/css?family=Crimson+Text|Allerta'); 
	echo head_css();
	echo theme_header_background();
	?>
	
<!-- JavaScripts -->
	<?php queue_js_file('modernizr'); ?>
	<?php queue_js_file('selectivizr-min'); ?>
	<?php queue_js_file('respond.min'); ?>
	<?php queue_js_file('globals'); ?>
	<?php queue_js_file('jquery.min', 'javascripts/speakker-big-1.2.07r157'); ?>
	<?php queue_js_file('speakker-big-1.2.07r157.min', 'javascripts/speakker-big-1.2.07r157'); ?>
	<?php if (get_theme_option('content') === 'collection' && get_records("collection", array("public"=>"true","featured"=>"true")) != null):
		get_speaker_playlist();
	endif;?>
    <?php echo head_js(); ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

<div id="wrap">
<!-- header -->
	<header>
           <?php fire_plugin_hook('public_header'); ?>
           <div id="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>
				<nav id="primary-nav">
					<div id="search-wrap">
	                   <?php echo search_form(array('show_advanced' => false)); ?>
	            	</div>
					<?php echo public_nav_main(); ?>
	           </nav>
	</header>
              
<!-- end header -->
	<div id="content">
		<?php fire_plugin_hook('public_content_top'); ?>