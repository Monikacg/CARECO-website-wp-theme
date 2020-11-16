<?php
if ( ! class_exists( 'TwentyTwenty_Customize' ) ) {
	class TwentyTwenty_Customize {
		public static function register( $wp_customize ) {
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'twentytwenty_customize_partial_blogname',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'twentytwenty_customize_partial_blogdescription',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'custom_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'twentytwenty_customize_partial_site_logo',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'retina_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'twentytwenty_customize_partial_site_logo',
				)
			);

			$wp_customize->add_setting(
				'retina_logo',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'retina_logo',
				array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'priority'    => 10,
					'label'       => __( 'Retina logo', 'twentytwenty' ),
					'description' => __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'twentytwenty' ),
				)
			);

			$wp_customize->add_section(
				'cover_template_options',
				array(
					'title'       => __( 'Cover Template', 'twentytwenty' ),
					'capability'  => 'edit_theme_options',
					'description' => __( 'Settings for the "Cover Template" page template. Add a featured image to use as background.', 'twentytwenty' ),
					'priority'    => 42,
				)
			);

			$wp_customize->add_setting(
				'cover_template_fixed_background',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => false,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'cover_template_fixed_background',
				array(
					'type'        => 'checkbox',
					'section'     => 'cover_template_options',
					'label'       => __( 'Fixed Background Image', 'twentytwenty' ),
					'description' => __( 'Creates a parallax effect when the visitor scrolls.', 'twentytwenty' ),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'cover_template_fixed_background',
				array(
					'selector' => '.cover-header',
					'type'     => 'cover_fixed',
				)
			);
		}
	}
	add_action( 'customize_register', array( 'TwentyTwenty_Customize', 'register' ) );
}

if ( ! function_exists( 'twentytwenty_customize_partial_blogname' ) ) {
	function twentytwenty_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'twentytwenty_customize_partial_blogdescription' ) ) {
	function twentytwenty_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}

if ( ! function_exists( 'twentytwenty_customize_partial_site_logo' ) ) {
	function twentytwenty_customize_partial_site_logo() {
		twentytwenty_site_logo();
	}
}
