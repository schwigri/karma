<?php
/**
 * Default tempalte for displaying content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Karma
 * @since 1.0.0
 */

$post_class = is_singular() ? '' : 'card';
?>

<article <?php post_class( $post_class ); ?> id="post-<?php the_ID(); ?>">

	<?php get_template_part( 'template-parts/entry-header' ); ?>

	<div class="post-inner">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() ) {
				the_excerpt();
				?><p><a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Read more', 'karma' ); ?></a></p><?php
			} else {
				the_content();
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

</article><!-- .post -->
