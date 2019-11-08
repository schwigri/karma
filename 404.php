<?php
/**
 * Template for the 404 error page
 *
 * @package Karma
 * @since 1.0.0
 */

get_header();
?>

<main class="site-content" role="main">

	<div class="inner">

		<h1 class="entry-title"><?php esc_html_e( 'Looks like you drove down SR 404.', 'karma' ); ?></h1>
		<div class="intro-text">
			<p>
				<?php esc_html_e( 'The page you were looking for could not be found.', 'karma' ); ?>
			</p>
			<p>
				<button class="button" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
					<?php esc_html_e( 'Search for something', 'karma' ); ?>
				</button>
			</p>
		</div><!-- .intro-text -->

	</div><!-- .inner -->

</main><!-- .site-content -->

<?php get_footer(); ?>
