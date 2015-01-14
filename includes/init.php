<?php

$incdir = get_template_directory() . '/includes/';

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Specific Components
/*-----------------------------------------------------------------------------------*/

require_once $incdir .'theme-customize.php';
require_once $incdir .'posttype-portfolio.php';
require_once $incdir .'meta/post-meta.php';
require_once $incdir .'meta/portfolio-meta.php';
require_once $incdir .'meta/seo-meta.php';

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/

require_once $incdir .'widgets/widget-tweets.php';
require_once $incdir .'widgets/widget-flickr.php';
require_once $incdir .'widgets/widget-video.php';