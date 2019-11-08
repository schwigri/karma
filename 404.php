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
		</div><!-- .intro-text -->

		<?php
		get_search_form(
			array(
				'label' => __( '404 not found', 'karma' ),
			)
		);
		?>

	</div><!-- .inner -->

</main><!-- .site-content -->

<?php get_footer(); ?>
