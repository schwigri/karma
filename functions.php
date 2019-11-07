<?php
/**
 * Karma functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Karma
 * @since 1.0.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function karma_theme_support() {
	// Add default posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Custom logo.
	$logo_id     = get_theme_mod( 'custom_logo' );
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'karma_retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'width'       => $logo_width,
			'height'      => $logo_height,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	/**
	 * Switch default core markup for search form, comment form, and comments to
	 * output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Make theme available for translation.
	load_theme_textdomain( 'karma' );

	// Add theme support for wide align images.
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'karma_theme_support' );

/**
 * Required files.
 */

// SVG Icons.
require get_template_directory() . '/classes/class-karma-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Template tags.
require get_template_directory() . '/inc/template-tags.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-karma-customize.php';

// Register shortcodes.
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Register and enqueue styles.
 */
function karma_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue theme style.
	wp_enqueue_style( 'karma-style', get_stylesheet_uri(), array(), $theme_version );

	// Enqueue Inter font.
	wp_enqueue_style( 'karma-inter', get_template_directory_uri() . '/assets/fonts/inter/inter.css', array(), $theme_version );

	// Enqueue Google Fonts.
	wp_enqueue_style( 'karma-google-fonts', 'https://fonts.googleapis.com/css?family=Bowlby+One+SC|Nunito+Sans:400,700&display=swap&subset=latin-ext', array(), $theme_version );

	// Add fonts.
	if ( get_theme_mod( 'adobe_fonts_project_id', false ) && ! get_theme_mod( 'adobe_fonts_project_dynamic', false ) ) {
		wp_enqueue_style( 'karma-custom-adobe-fonts', 'https://use.typekit.net/' . get_theme_mod( 'adobe_fonts_project_id', '' ) . '.css', array(), $theme_version );
	}

	// Add Lity.
	wp_enqueue_style( 'karma-lity-style', get_template_directory_uri() . '/assets/styles/lity.min.css', array(), $theme_version );
}

// Enqueue styles.
add_action( 'wp_enqueue_scripts', 'karma_register_styles' );

/**
 * Register and enqueue scripts.
 */
function karma_register_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue theme script.
	wp_enqueue_script( 'karma-script', get_template_directory_uri() . '/assets/scripts/karma.js', array(), $theme_version, true );

	// Enqueue Lity.
	wp_enqueue_script( 'karma-lity-script', get_template_directory_uri() . '/assets/scripts/lity.js', array( 'jquery' ), $theme_version, true );

	// Enqueue Twentytwenty script.
	wp_enqueue_script( 'karma-twentytwenty-script', get_template_directory_uri() . '/assets/scripts/twentytwenty.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );
}

// Enqueue scripts.
add_action( 'wp_enqueue_scripts', 'karma_register_scripts' );

/**
 * Register nav menus.
 */
function karma_menus() {
	$locations = array(
		'primary' => __( 'Main Menu', 'karma' ),
		'mobile'  => __( 'Mobile Nav Menu', 'karma' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'karma_menus' );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function karma_register_sidebars() {
	// Shared arguments.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
	);

	// Footer branding widgets.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer Brands', 'karma' ),
				'id'          => 'footer-brand-widgets',
				'description' => __( 'Widgets in this area will be displayed in the footer.', 'karma' ),
			)
		)
	);

	// Footer text widgets.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer Text', 'karma' ),
				'id'          => 'footer-text-widgets',
				'description' => __( 'Widgets in this area will be displayed in the footer, under the brands.', 'karma' ),
			)
		)
	);

	// Home show recent posts.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Homepage recent posts', 'karma' ),
				'id'          => 'homepage-recent-posts',
				'description' => __( 'Widgets in this area will be displayed at the bottom of the homepage.', 'karma' ),
			)
		)
	);
}

add_action( 'widgets_init', 'karma_register_sidebars' );

/**
 * Exclude categories from blog.
 *
 * @param WP_Query $query The query to exclude categories from.
 */
function karma_exclude_categories( $query ) {
	$raw_exclude_categories = get_theme_mod( 'exclude_categories' );
	if ( $raw_exclude_categories ) {
		$exclude_categories = '';
		foreach ( explode( ',', $raw_exclude_categories ) as $raw_category ) {
			$raw_category = trim( $raw_category );
			$category     = get_category_by_slug( $raw_category );
			if ( $category ) {
				$exclude_categories .= '-' . $category->term_id . ', ';
			}
		}
		$exclude_categories = substr( $exclude_categories, 0, -2 );
		if ( '' !== $exclude_categories ) {
			if ( $query->is_home() && $query->is_main_query() ) {
				$query->set(
					'cat',
					$exclude_categories
				);
			}
		}
	}
}

add_action( 'pre_get_posts', 'karma_exclude_categories' );
