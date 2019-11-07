<?php
/**
 * Template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Karma
 * @since 1.0.0
 */

get_header();
?>

<main class="site-content 
<?php 
if ( has_post_thumbnail() ) :
	?>
	has-header-image<?php endif; ?>" role="main">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}
	?>

</main><!-- .site-content -->

<?php get_footer(); ?>
