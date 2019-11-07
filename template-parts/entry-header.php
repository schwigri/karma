<?php
/**
 * The header for a post or page.
 *
 * @package Karma
 * @since 1.0.0
 */

?>
<?php if ( ! is_front_page() ) : ?>
	<?php
	$header_class = '';
	if ( has_post_thumbnail() ) {
		$header_class .= ' has-image ';
	}
	$post_meta = get_post_meta( get_the_ID() );
	if ( array_key_exists( 'hide_title', $post_meta ) && 'true' === $post_meta['hide_title'][0] ) {
		$header_class .= ' hide-title ';
	}
	?>
	<header class="entry-header <?php echo esc_attr( $header_class ); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="page-header-featured-image-container">
				<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="">
			</div><!-- .page-header-featured-image-container -->
		<?php endif; ?>

		<div class="inner">
			<?php
			if ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			}

			karma_the_post_meta( get_the_ID(), 'single-top' );
			?>
		</div>

	</header><!-- .entry-header -->
<?php endif; ?>
