<?php
/**
 * The main template file
 *
 * Used as a template when no other template applies.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Karma
 * @since 1.0.0
 */

// @TODO: Build the theme.

get_header();
?>

<?php
	$archive_title    = '';
	$archive_subtitle = '';
	$featured_image   = '';

if ( is_search() ) {
	global $wp_query;

	$archive_title = sprintf(
		'%1$s %2$s',
		'<span class="color-accent">' . __( 'Search:', 'karma' ) . '</span>',
		'&ldquo;' . get_search_query() . '&rdquo;'
	);

	if ( $wp_query->found_posts ) {
		$archive_subtitle = sprintf(
			/* Translators: %s is the numebr of posts. */
			_n(
				'We found %s result for your search.',
				'We found %s results for your search.',
				$wp_query->found_posts,
				'karma'
			),
			number_format_i18n( $wp_query->found_posts )
		);
	} else {
		$archive_subtitle = __( 'We could not find any results for your search.', 'karma' );
	}
} elseif ( ! is_home() ) {
	$archive_title    = get_the_archive_title();
	$archive_subtitle = get_the_archive_description();
} else {
	$archive_title = single_post_title( '', false );

	if ( '' !== get_theme_mod( 'blog_title', '' ) ) {
		$archive_title = get_theme_mod( 'blog_title', $archive_title );
	}

	$blog_page_id   = get_option( 'page_for_posts' );
	$featured_image = get_the_post_thumbnail_url( $blog_page_id );
}
?>
	<main class="site-content
	<?php
	if ( $featured_image ) :
		?>
		has-header-image<?php endif; ?>" role="main">
	<?php if ( $archive_title || $archive_subtitle ) : ?>
		<header class="archive-header
		<?php
		if ( $featured_image ) :
			?>
			has-image<?php endif; ?>">

			<?php if ( $featured_image ) : ?>
				<div class="page-header-featured-image-container">
					<img src="<?php echo esc_url( $featured_image ); ?>" alt="" aria-hidden="true" role="presentation">
				</div><!-- .page-header-featured-image-container -->
			<?php endif; ?>

			<div class="archive-header-inner inner">

				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php endif; ?>
				<?php if ( $archive_subtitle ) : ?>
					<p class="archive-subtitle subtitle"><?php echo wp_kses_post( $archive_subtitle ); ?></p>
				<?php endif; ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->
	<?php endif; ?>

	<div class="large-cards-container">

	<?php
	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) {
			$i++;

			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	} elseif ( is_search() ) {
		?>
		<div class="no-search-results-form inner">

			<?php
			get_search_form(
				array(
					'label' => __( 'Search again', 'karma' ),
				)
			);
			?>

		</div><!-- .no-search-results-form -->
		<?php
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

	</div>

</main>

<?php get_footer(); ?>
