<?php
/**
 * Displays the footer brands widgets.
 *
 * @package Karma
 * @since 1.0.0
 */

$has_footer_brands = is_active_sidebar( 'footer-brand-widgets' );
?>
<?php if ( $has_footer_brands ) : ?>

<div class="footer-brands-container">

	<?php dynamic_sidebar( 'footer-brand-widgets' ); ?>

</div><!-- .footer-brands-container -->

<?php endif; ?>
