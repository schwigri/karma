<?php
/**
 * Karma Customizer settings
 *
 * @package Karma
 * @since 1.0.0
 */

if ( ! class_exists( 'Karma_Customize' ) ) {
	/**
	 * Customizer settings.
	 */
	class Karma_Customize {
		/**
		 * Register Customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function register( $wp_customize ) {
			/**
			 * Site identity.
			 */

			// 2x logo.
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
					'label'       => __( 'Retina logo', 'karma' ),
					'description' => __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'karma' ),
				)
			);

			/**
			 * Theme options.
			 */
			$wp_customize->add_section(
				'options',
				array(
					'title'       => __( 'Theme Options', 'karma' ),
					'priority'    => 40,
					'capability'  => 'edit_theme_options',
					'description' => __( 'Specific settings for the Karma theme.', 'karma' ),
				)
			);

			// Enable/disable header search.
			$wp_customize->add_setting(
				'enable_header_search',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control(
				'enable_header_search',
				array(
					'type'     => 'checkbox',
					'section'  => 'options',
					'priority' => 10,
					'label'    => __( 'Show search in header', 'karma' ),
				)
			);

			// Add homepage video/image settings.
			$wp_customize->add_setting(
				'homepage_video',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_video' ),
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Upload_Control(
					$wp_customize,
					'homepage_video',
					array(
						'section'  => 'options',
						'priority' => 5,
						'label'    => __( 'Homepage video (WebM)', 'karma' ),
					)
				)
			);

			$wp_customize->add_setting(
				'homepage_video_backup',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_video' ),
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Upload_Control(
					$wp_customize,
					'homepage_video_backup',
					array(
						'section'  => 'options',
						'priority' => 5,
						'label'    => __( 'Homepage video (non-WebM)', 'karma' ),
					)
				)
			);

			$wp_customize->add_setting(
				'homepage_image',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_image' ),
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'homepage_image',
					array(
						'section'  => 'options',
						'priority' => 5,
						'label'    => __( 'Homepage image', 'karma' ),
					)
				)
			);

			// Add exclusion categories.
			$wp_customize->add_setting(
				'exclude_categories',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_text' ),
				)
			);

			$wp_customize->add_control(
				'exclude_categories',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Categories to exclude from blog', 'karma' ),
				)
			);

			// Add custom blog title.
			$wp_customize->add_setting(
				'blog_title',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_text' ),
				)
			);

			$wp_customize->add_control(
				'blog_title',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Blog page title', 'karma' ),
				)
			);

			// Add custom header text.
			$wp_customize->add_setting(
				'homepage_banner_text',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_text' ),
				)
			);

			$wp_customize->add_control(
				'homepage_banner_text',
				array(
					'type'     => 'textarea',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Homepage banner text line one', 'karma' ),
				)
			);

			// Add custom header text, second line.
			$wp_customize->add_setting(
				'homepage_banner_text_line_two',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_text' ),
				)
			);

			$wp_customize->add_control(
				'homepage_banner_text_line_two',
				array(
					'type'     => 'textarea',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Homepage banner text line two', 'karma' ),
				)
			);

			// Add custom header CTA text.
			$wp_customize->add_setting(
				'homepage_banner_cta_text',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_text' ),
				)
			);

			$wp_customize->add_control(
				'homepage_banner_cta_text',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Homepage banner CTA text', 'karma' ),
				)
			);

			// Add custom header CTA link.
			$wp_customize->add_setting(
				'homepage_banner_cta_link',
				array(
					'capabilitiy'       => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_url' ),
				)
			);

			$wp_customize->add_control(
				'homepage_banner_cta_link',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'priority' => 0,
					'label'    => __( 'Homepage banner CTA link', 'karma' ),
				)
			);

			// Add support for Adobe fonts.
			$wp_customize->add_setting(
				'adobe_fonts_project_id',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => '',
					'sanitize_callback' => array( __CLASS__, 'sanitize_alphanum' ),
				)
			);

			$wp_customize->add_control(
				'adobe_fonts_project_id',
				array(
					'type'        => 'text',
					'section'     => 'options',
					'priority'    => 10,
					'label'       => __( 'Adobe Fonts Project ID', 'karma' ),
					'description' => __( 'Loads your Adobe Fonts web project to enable custom font usage.', 'karma' ),
				)
			);
		}

		/**
		 * Sanitize text.
		 *
		 * @param string $value The text value to sanitize.
		 */
		public static function sanitize_text( $value ) {
			return $value;
		}

		/**
		 * Sanitize URL.
		 *
		 * @param string $url The URL to sanitize.
		 */
		public static function sanitize_url( $url ) {
			return $url;
		}

		/**
		 * Sanitize a string, making sure it only contains alphanumeric symbols.
		 *
		 * @param string $value The string to sanitize.
		 */
		public static function sanitize_alphanum( $value ) {
			$value = preg_replace( '/\s+/', '', $value );
			if ( ctype_alnum( $value ) ) {
				return $value;
			}
			return '';
		}

		/**
		 * Sanitize video file types.
		 *
		 * @param string $file The URL of the file.
		 */
		public static function sanitize_video( $file ) {
			return $file;
		}

		/**
		 * Sanitize image file types.
		 *
		 * @param string $file The URL of the file.
		 */
		public static function sanitize_image( $file ) {
			return $file;
		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @param boolean $checked Whether or not the checkbox is checked.
		 */
		public static function sanitize_checkbox( $checked ) {
			return ( isset( $checked ) && true === $checked ) ? true : false;
		}
	}

	// Setup the Theme Customizer settings and controls.
	add_action( 'customize_register', array( 'Karma_Customize', 'register' ) );
}
