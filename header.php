<?php
/**
 * Template for displaying the head content
 *
 * @package Mesh
 * @since Mesh 1.0
 */

$theme_options = get_theme_mod('zilla_theme_options');
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!-- BEGIN html -->
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<![endif]-->
	<?php zilla_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- RSS & Pingbacks -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"/>
	<?php wp_head(); ?>
	<?php zilla_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
<?php zilla_body_start(); ?>

	<!-- BEGIN #container -->
	<div id="container" class="container">

		<?php zilla_header_before(); ?>
		<!-- BEGIN #header -->
		<header id="header" class="header">
			<div id="header-inner" class="header-inner">
			<?php zilla_header_start(); ?>

			<!-- BEGIN site-intro -->
			<div class="site-intro">
				<div id="logo">
					<a href="http://instagram.com/lookmachine" target="_blank">
						<?php
						if (isset($theme_options['general_text_logo'])||isset($theme_options['general_custom_logo'])) { ?>
							<img src="<?php echo $theme_options['general_custom_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
						<div id="header-title"><?php bloginfo( 'name' ); ?> </div>
		                <?php } else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="70" height="70" />
						<?php } ?>
					</a>
				</div>

				<?php if ( isset($theme_options['general_display_description'])) {
					printf( '<p class="site-description">' . get_option('blogdescription') . '</p>' );
				} ?>
		<!-- END .site-intro -->
			</div>

			<?php if( has_nav_menu( 'mobile-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id' => 'mobile-menu',
					'menu_class' => 'mobile-menu',
					'container' => ''
				) );
			} ?>

			<?php get_sidebar(); ?>
            <div id="header-footer">
			<p class="insta">
                <a href="http://instagram.com/lookmachine/" target="_blank">
                    <i class="icon-instagramm"></i>
                </a> 
            </p>
            <p class="copyright">
                &copy; <?php echo date( 'Y' );?> <?php bloginfo( 'name' ); ?></p>

			
            </div>

            <?php zilla_header_end(); ?>
			<!--END .header-inner -->
			</div>
		<!--END #header-->
		</header>
		<?php zilla_header_after(); ?>

		<!--BEGIN #content -->
		<div id="content" class="content">
		<?php zilla_content_start(); ?>