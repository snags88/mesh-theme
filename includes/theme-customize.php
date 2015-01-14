<?php
/**
* Contains methods for customizing the theme customization screen.
*
* @link http://codex.wordpress.org/Theme_Customization_API
* @since Broadcast 1.0
*/

add_action('customize_register', 'zilla_customize_register');
function zilla_customize_register($wp_customize) {

	class Zilla_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea style="width:100%" rows="8" <?php $this->link(); ?>><<?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php }
	}

	$wp_customize->add_setting(
		'zilla_theme_options[general_display_description]',
		array()
	);

	$wp_customize->add_control( 'zilla_general_display_description', array(
		'label' => __( 'Display site description below logo', 'zilla' ),
		'section' => 'title_tagline',
		'settings' => 'zilla_theme_options[general_display_description]',
		'type' => 'checkbox'
	));

	/* General Options --- */
	$wp_customize->add_section(
		'zilla_general_options',
		array(
			'title' => __( 'General Options', 'zilla' ),
			'priority' => 24,
			'capability' => 'edit_theme_options',
			'description' => __('Control and configure the basics of your theme.', 'zilla')
		)
	);

	$wp_customize->add_setting(
		'zilla_theme_options[general_text_logo]',
		array() // use defaults
	);

	$wp_customize->add_control( 'zilla_general_text_logo', array(
		'label' => __( 'Plain Text Logo', 'zilla' ),
		'section' => 'title_tagline',
		'settings' => 'zilla_theme_options[general_text_logo]',
		'type' => 'checkbox',
		'priority' => 2
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_custom_logo]',
		array(
			'default' => get_template_directory_uri() . '/images/logo.png',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_general_custom_logo',
		array(
			'label' => __( 'Logo Upload', 'zilla' ),
			'section' => 'title_tagline',
			'settings' => 'zilla_theme_options[general_custom_logo]',
			'priority' => 1
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_custom_favicon]',
		array() // use defaults
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_general_custom_favicon',
		array(
			'label' => __( 'Favicon Upload (16x16 image file)', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_custom_favicon]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_contact_email]',
		array( 'type' => 'option' )
	);

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zilla_general_contact_email',
		array(
			'label' => __( 'Contact Form Email Address', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_contact_email]'
		)
	));

	/* Style Options --- */
	$wp_customize->add_section(
		'zilla_style_options',
		array(
			'title' => __( 'Style Options', 'zilla' ),
			'priority' => 25,
			'capability' => 'edit_theme_options',
			'description' => __('Give your site a custom coat of paint by updating the style options.', 'zilla')
		)
	);

	$wp_customize->add_setting(
		'zilla_theme_options[style_accent_color]',
		array(
			'default' => '#f23e2f',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_accent_color',
		array(
			'label' => __( 'Accent Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_accent_color]'
		)
	));

	$wp_customize->add_setting( 'zilla_theme_options[style_custom_css]', array('default' => ''));

	$wp_customize->add_control( new Zilla_Customize_Textarea_Control(
		$wp_customize,
		'zilla_style_custom_css',
		array(
			'label' => __( 'Custom CSS', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_custom_css]',
		)
	));

	if( $wp_customize->is_preview() && ! is_admin() ) {
		add_action('wp_footer', 'zilla_live_preview', 21);
	}
}

/**
* This outputs the javascript needed to automate the live settings preview.
*
*/
function zilla_live_preview() { ?>
	<script type="text/javascript">
		( function( $ ) {

			wp.customize( 'zilla_theme_options[general_custom_logo]', function( value ) {
				value.bind( function( newval ) {
					$('#logo img').attr('src', newval);
				});
			});

			wp.customize( 'zilla_theme_options[style_accent_color]', function( value ) {
				value.bind( function( newval ) {
					$('#content a').css('color', newval);
				});
			});

		})(jQuery);
	</script>
<?php }

/**
* This will output the custom WordPress settings to the live theme's WP head.
*
*/
function header_output() {

	$theme_options = get_theme_mod('zilla_theme_options');

	/* Output the favicon */
	if( isset($theme_options['general_custom_favicon']) && $theme_options['general_custom_favicon'] ) {
		echo '<link rel="shortcut icon" href="'. $theme_options['general_custom_favicon'] .'" />' . "\n";
	}

}
add_action( 'wp_head' , 'header_output' );

/**
* Output the custom CSS
*/
function zilla_custom_css($content) {
	$theme_options = get_theme_mod( 'zilla_theme_options' );

	if( isset($theme_options['style_custom_css']) && $theme_options['style_custom_css'] != '' ){
		$content .= '/* Custom CSS */' . "\n";
		$content .= stripslashes($theme_options['style_custom_css']);
		$content .= "\n\n";
	}

	return $content;
}
add_filter( 'zilla_custom_styles', 'zilla_custom_css' );

/**
* Output the custom accent color
*/
function zilla_accent_color($content) {
	$theme_options = get_theme_mod( 'zilla_theme_options' );

	if( isset($theme_options['style_accent_color']) && $theme_options['style_accent_color'] != '' ) {
		$color = $theme_options['style_accent_color'];

		if( !empty($color) && $color != '#f23e2f' ) {
			$content .= "/* Custom Accent Color */\n";

			$rgba = zilla_hex2rgba( $color, '0.9' );
			$content .= "/* Custom Accent Color */\n\n";

			$content .= "a,\n#logo:hover,\n.entry-title a:hover,\nbutton:hover,\ninput[type='submit']:hover,\ninput[type='submit']:focus,\ninput[type='button']:hover,\ninput[type='reset']:hover,\n#commentform .required,\n.page-navigation .nav-previous a:hover,\n.page-navigation .nav-next a:hover,\n#footer a,\nwidget .current-cat > a,\n.widget .current-menu-item > a,\n.widget ul a:hover,\n.widget ul a.active-filter,\n.mobile-menu a:hover,\n.mobile-menu .current-cat > a,\n.mobile-menu .current-menu-item > a,\n.mobile-menu .current_page_item > a,\n.mobile-menu ul a:hover,\n#footer .zilla-tweet-widget .twitter-time-stamp:hover { color: $color; }\n\n";

			$content .= ".post-media a,\n.post-media .zilla-slide-prev:hover,\n.post-media .zilla-slide-next:hover,\n.portfolio-feed .portfolio > a,\n#toggle-footer { background-color: $color; }\n\n";

			$content .= ".zilla-gallery .slide-caption,\n.single-portfolio .entry-content { background-color: rgba($rgba); }\n\n";
		}
	}

	return $content;
}
add_filter( 'zilla_custom_styles', 'zilla_accent_color' );

/**
* Helper function to convert hexcode to rgb
*
* @since Mesh 1.0
*
* @param string $hex
* @param string $alpha
* @return string $rgba
*/
function zilla_hex2rgba($hex, $alpha) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgba = array($r, $g, $b, $alpha);
	return implode(",", $rgba); // returns the rgb values separated by commas
	// return $rgba; // returns an array with the rgb values
}