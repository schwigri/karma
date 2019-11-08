<?php
/**
 * Shortcodes for Karma
 *
 * @package Karma
 * @since 1.0.0
 */

/**
 * Returns all custom fields used by Karma.
 *
 * @return array The custom fields.
 */
function karma_theme_fields() {
	return array(
		'target',
		'hide_title',
		'link',
		// Preexisting things to hide.
		'be_title_toggle_hide',
		'mai_hide_featured_image',
		'mai_hide_breadcrumbs',
		'hide_banner',
	);
}

/**
 * Gets all the custom fields of a post, ignoring certain fields.
 *
 * @param array   $custom_fields All of the custom fields.
 * @param boolean $lity          Whether or not to use Lity.
 * @param array   $ignore        The fields to ignore.
 *
 * @return string $buttons The HTML for the buttons.
 */
function karma_the_custom_field_buttons( $custom_fields, $lity = true, $ignore = array() ) {
	$ignore = array_merge( $ignore, karma_theme_fields() );

	$buttons = '';

	foreach ( $custom_fields as $custom_field_name => $custom_field_value ) {
		if ( ! in_array( $custom_field_name, $ignore, true ) && '_' !== substr( $custom_field_name, 0, 1 ) ) {
			$values     = explode( ',', $custom_field_value[0] );
			$target_url = $values[0];
			$lang       = '';
			if ( count( $values ) > 1 ) {
				$target_url = str_replace( ' ', '', $values[1] );
				$lang       = $values[0];
			}
			$buttons .= '<a class="button button-borderless" lang="' . esc_attr( $lang ) . '" href="' . esc_url( $target_url ) . '" target="_blank"' . ( true === $lity ? ' data-lity' : '' ) . '>' . esc_html( $custom_field_name ) . '</a>';
		}
	}

	return $buttons;
}

/**
 * Displays the latest posts.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string $content The HTML to output.
 */
function karma_recent_posts( $atts ) {
	$attributes = shortcode_atts(
		array(
			'title'   => '',
			'exclude' => '',
		),
		$atts
	);

	$exclude_categories = array();

	foreach ( explode( ',', $attributes['exclude'] ) as $category ) {
		$category = trim( $category );
		$cat_item = get_category_by_slug( $category );

		if ( $cat_item ) {
			array_push( $exclude_categories, $cat_item->cat_ID );
		}
	}

	$posts = new WP_Query(
		array(
			'category__not_in' => $exclude_categories,
			'posts_per_page'   => '3',
		)
	);

	if ( ! $posts->have_posts() ) {
		return;
	}

	$content = '<section class="section recent-posts-section">';

	if ( '' !== $attributes['title'] ) {
		$content .= '<h2>' . esc_html( $attributes['title'] ) . '</h2>';
	}

	$content .= '<div class="cards-container horizontal-cards-container">';

	while ( $posts->have_posts() ) {
		$posts->the_post();

		$content .= '<article class="card horizontal-card">';

		if ( has_post_thumbnail() ) {
			$content .= '<div class="card-image-container">';
			$content .= get_the_post_thumbnail();
			$content .= '</div><!-- .card-image-contianer -->';
		}

		$content .= '<div class="horizontal-card-content">';

		$content .= '<header>';
		$content .= '<h3>' . get_the_title() . '</h3>';
		$content .= '</header>';

		$content .= '<div class="card-content">';
		$content .= '<p>' . get_the_excerpt() . '</p>';
		$content .= '<p>';

		$content .= '<a href="' . get_permalink() . '" class="button">' . __( 'Read more', 'karma' ) . '</a>';

		$content .= '</p>';
		$content .= '</div><!-- .card-content -->';

		$content .= '</div><!-- .horizontal-card-content -->';

		$content .= '</article><!-- .horizontal-card -->';
	}

	$content .= '</div><!-- .horizontal-cards-container -->';

	$content .= '</section><!-- .recent-posts-section -->';

	return $content;
}

add_shortcode( 'recent_posts', 'karma_recent_posts' ); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_add_shortcode

/**
 * Displays a carousel of posts categorized as chapter.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string $content The HTML to output.
 */
function karma_chapters( $atts ) {
	$attributes = shortcode_atts(
		array(
			'title' => 'Chapters.',
		),
		$atts
	);

	$posts = new WP_Query(
		array(
			'category_name' => 'chapters',
		)
	);

	if ( ! $posts->have_posts() ) {
		return;
	}


	$content = '<section class="section shaded-section cards-section small-cards-section">';

	$content .= '<h2>' . $attributes['title'] . '</h2>';

	$content .= '<div id="chapters-carousel" class="cards-carousel" data-track="chapters-carousel-track" data-older-button="chapters-older-button" data-newer-button="chapters-newer-button">';

	$content .= '<button id="chapters-newer-button" class="toggle newer-toggle" disabled="disabled">';
	$content .= '<span class="toggle-inner">';
	$content .= '<span class="toggle-icon">';
	$content .= karma_get_theme_svg( 'play' );
	$content .= '</span><!-- .toggle-icon -->';
	/* Translators: Button for newer posts. */
	$content .= '<span class="toggle-text">' . __( 'Newer', 'karma' ) . '</span><!-- .toggle-text -->';
	$content .= '</span><!-- .toggle-inner -->';
	$content .= '</button><!-- .newer-toggle -->';

	$content .= '<div id="chapters-carousel-track" class="cards-carousel-track" data-chapters="' . $posts->found_posts . '">';

	$number_formatter = new NumberFormatter( 'en', NumberFormatter::SPELLOUT );

	$i = $posts->found_posts;

	while ( $posts->have_posts() ) {
		$posts->the_post();

		$content .= '<article class="card">';

		if ( has_post_thumbnail() ) {
			$content .= '<div class="card-image-container">';
			$content .= get_the_post_thumbnail();
			$content .= '</div><!-- .card-image-contianer -->';
		}

		$content .= '<header>';
		$content .= '<h3><small>Chapter ' . $number_formatter->format( $i ) . '</small> ' . get_the_title() . '</h3>';
		$content .= '</header>';

		$content .= '<div class="card-content">';
		$content .= '<p>' . get_the_excerpt() . '</p>';
		$content .= '<p>';

		$content .= '<a data-lity rel="noopener noreferrer" href="' . get_permalink() . '" class="button">' . __( 'Learn more', 'karma' ) . '</a>';

		$custom_properties = get_post_custom( get_the_ID() );

		$content .= karma_the_custom_field_buttons( $custom_properties );

		$content .= '</p>';
		$content .= '</div><!-- .card-content -->';

		$content .= '</article><!-- .card -->';

		$i--;
	}

	$content .= '</div><!-- .cards-carousel-track -->';

	$content .= '</div><!-- .cards-carousel -->';

	$content .= '</section><!-- .small-cards-section -->';

	return $content;
}
add_shortcode( 'chapters', 'karma_chapters' ); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_add_shortcode

/**
 * Displays a grid of tiles given an category and a title.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string $content The HTML to output.
 */
function karma_tiles( $atts ) {
	$attributes = shortcode_atts(
		array(
			'title'    => '',
			'category' => 'uncategorized',
			'size'     => '',
			'spaced'   => false,
			'shaded'   => false,
			'link'     => '',
		),
		$atts
	);

	$posts = new WP_Query(
		array(
			'category_name' => $attributes['category'],
		)
	);

	if ( ! $posts->have_posts() ) {
		return;
	}

	$content = '<section class="section cards-section ' . ( '' !== $attributes['size'] ? esc_attr( $attributes['size'] ) . '-cards-section' : '' ) . ( $attributes['spaced'] ? ' spaced ' : '' ) . ( $attributes['shaded'] ? ' shaded-section ' : '' ) . '">';

	if ( '' !== $attributes['title'] ) {
		$content .= '<h2>' . esc_html( $attributes['title'] ) . '</h2>';
	}

	$content .= '<div class="large-cards-container">';

	while ( $posts->have_posts() ) {
		$posts->the_post();

		$content .= '<article class="card">';

		if ( has_post_thumbnail() ) {
			$content .= '<div class="card-image-container">';
			$content .= get_the_post_thumbnail();
			$content .= '</div><!-- .card-image-contianer -->';
		}

		$content .= '<header>';
		$content .= '<h3>' . get_the_title() . '</h3>';
		$content .= '</header>';

		$content .= '<div class="card-content">';
		$content .= '<p>' . get_the_excerpt() . '</p>';
		$content .= '<p>';

		$custom_properties = get_post_custom( get_the_ID() );

		$link = '<a data-lity rel="noopener noreferrer" href="' . get_permalink() . '" class="button">' . __( 'Learn more', 'karma' ) . '</a>';

		$lity = true;

		if ( $attributes['link'] ) {
			$lity  = false;
			$blank = false === strpos( $custom_properties[$attributes['link']][0], get_site_url() );
			$link  = '<a ' . ( true === $blank ? ' target="_blank" rel="noopener noreferrer" ' : '' ) . ' href="' . esc_url( $custom_properties[ $attributes['link'] ][0] ) . '" class="button">' . __( 'Learn more', 'karma' ) . '</a>';
		}

		$content .= $link;

		$content .= karma_the_custom_field_buttons( $custom_properties, $lity );

		$content .= '</p>';
		$content .= '</div><!-- .card-content -->';

		$content .= '</article><!-- .card -->';
	}

	$content .= '</div><!-- .large-cards-container -->';

	$content .= '</section><!-- .large-cards-section -->';

	return $content;
}
add_shortcode( 'tiles', 'karma_tiles' ); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_add_shortcode
