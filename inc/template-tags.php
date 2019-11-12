<?php
/**
 * Custom template tags for Karma.
 *
 * @package Karma
 * @since 1.0.0
 */

/**
 * Displays the site logo, either text or image.
 *
 * @param array   $args Arguments for displaying the site logo.
 * @param boolean $echo Echo or return the HTML.
 *
 * @return string $html Compiled HTML based on passed arguments.
 */
function karma_site_logo( $args = array(), $echo = true ) {
	$logo       = get_custom_logo();
	$site_title = get_bloginfo( 'name' );
	$contents   = '';
	$classname  = '';

	$defaults = array(
		'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
		'logo_class'  => 'site-logo',
		'title'       => '<a href="%1$s">%2$s</a>',
		'title_class' => 'site-title',
		'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
		'single_wrap' => '<div class="%1$s">%2$s</div>',
		'condition'   => ( is_front_page() || is_home() ) && is_page(),
	);

	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments for `karma_site_logo()`.
	 *
	 * @param array $args     Parsed arguments.
	 * @param array $defaults Function's default arguments.
	 */
	$args = apply_filters( 'karma_site_logo_args', $args, $defaults );

	if ( has_custom_logo() ) {
		$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
		$classname = $args['logo_class'];
	} else {
		$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
		$classname = $args['title_class'];
	}

	$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

	$html = sprintf( $args[ $wrap ], $classname, $contents );

	/**
	 * Filters the arguments for `karma_site_logo()`.
	 *
	 * @param string $html      Compiled HTML based on passed arguments.
	 * @param array  $args      Parsed arguments.
	 * @param string $classname Class name based on current view.
	 * @param string $contents  HTML for site title or logo.
	 */
	$html = apply_filters( 'karma_site_logo', $html, $args, $classname, $contents );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Displays the site description.
 *
 * @param boolean $echo Echo or return the HTML.
 *
 * @return string $html The HTML to display.
 */
function karma_site_description( $echo = true ) {
	$description = get_bloginfo( 'description' );

	if ( ! $description ) {
		return;
	}

	$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

	$html = sprintf( $wrapper, esc_html( $description ) );

	/**
	 * Filters the HTML for the site description.
	 *
	 * @param string $html        The HTML to display.
	 * @param string $description Site description.
	 * @param string $wrapper     The format used in case you want to reuse it.
	 */
	$html = apply_filters( 'karma_site_description', $html, $description, $wrapper );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Gets meta for a specified post.
 *
 * @param int    $post_id  The ID of the post to get the meta of.
 * @param string $location The location the meta info will be placed.
 *
 * @return string $meta_output The HTML code for the post meta.
 */
function karma_get_post_meta( $post_id = null, $location = 'single-top' ) {
	if ( ! $post_id ) {
		return;
	}

	$post_meta_wrapper_classes = '';
	$post_meta_classes         = '';

	if ( 'single-top' === $location ) {
		$post_meta_wrapper_classes = ' post-meta-single post-meta-single-top';
		$post_meta                 = apply_filters(
			'karma_post_meta_location_single_top',
			array(
				'author',
				'post-date',
			)
		);
	}

	if ( $post_meta && ! in_array( 'empty', $post_meta, true ) ) {
		$has_meta = false;

		global $post;
		$the_post = get_post( $post_id );
		setup_postdata( $the_post );

		ob_start();

		?>
		<div class="post-meta-wrapper<?php echo esc_attr( $post_meta_wrapper_classes ); ?>">

			<ul class="post-meta<?php echo esc_attr( $post_meta_classes ); ?>">

				<?php
				if ( in_array( 'post-date', $post_meta, true ) ) {
					$has_meta = true;
					?>
					<li class="post-date meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php esc_html_e( 'Post date', 'karma' ); ?></span>
							<?php karma_the_theme_svg( 'calendar' ); ?>
						</span><!-- .meta-icon -->
						<span class="meta-text">
							<?php the_time( get_option( 'date_format' ) ); ?>
						</span><!-- .meta-text -->
					</li>
					<?php
				}
				?>

			</ul><!-- .post-meta -->

		</div><!-- .post-meta-wrapper -->
		<?php

		wp_reset_postdata();
		$meta_output = ob_get_clean();

		// @TODO: Add customization here.
		$categories_to_ignore = array(
			'tools',
			'maps',
		);

		if ( is_page( $post_id ) || in_category( $categories_to_ignore, $the_post ) ) {
			$has_meta = false;
		}

		if ( $has_meta && $meta_output ) {
			return $meta_output;
		}
	}
}

/**
 * Gets the post meta HTML and echoes it.
 *
 * @param int    $post_id  The ID of the post to get the meta of.
 * @param string $location The location the meta info will be placed.
 */
function karma_the_post_meta( $post_id = null, $location = 'single-top' ) {
	echo karma_get_post_meta( $post_id, $location ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
