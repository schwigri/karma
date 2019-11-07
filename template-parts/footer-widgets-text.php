<?php
/**
 * Displays the footer brands widgets.
 *
 * @package Karma
 * @since 1.0.0
 */

$has_footer_text = is_active_sidebar( 'footer-text-widgets' );
?>
<?php if ( $has_footer_text ) : ?>

<div class="footer-text-container">

	<?php dynamic_sidebar( 'footer-text-widgets' ); ?>

</div><!-- .footer-text-container -->

<?php endif; ?>
