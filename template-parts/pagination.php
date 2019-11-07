<?php
/**
 * Pagination for Karma theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karma
 * @since 1.0.0
 */

$prev_text = sprintf(
	'%s <span class="nav-prev-text">%s</span>',
	'<span aria-hidden="true">&larr;</span>',
	__( 'Newer <span class="nav-short">posts</span>', 'karma' )
);

$next_text = sprintf(
	'<span class="nav-next-text">%s</span> %s',
	__( 'Older <span class="nav-short">posts</span>', 'karma' ),
	'<span aria-hidden="true">&rarr;</span>'
);

$posts_pagination = get_the_posts_pagination(
	array(
		'mid_size'  => 1,
		'prev_text' => $prev_text,
		'next_text' => $next_text,
	)
);

// If we're not outputting the previous page link, prepend a placeholder with visibility: hidden to take its place.
if ( false === strpos( $posts_pagination, 'prev page-numbers' ) ) {
	$posts_pagination = str_replace( '<div class="nav-links">', '<div class="nav-links"><span class="prev page-numbers placeholder" aria-hidden="true">' . $prev_text . '</span>', $posts_pagination );
}

// If we're not outputting the next page link, append a placeholder with visibility: hidden to take its place.
if ( false === strpos( $posts_pagination, 'next page-numbers' ) ) {
	$posts_pagination = str_replace( '</div>', '<span class="next page-numbers placeholder" aria-hidden="true">' . $next_text . '</span></div>', $posts_pagination );
}
?>

<?php if ( $posts_pagination ) : ?>
	<div class="pagination-wrapper inner">
		<hr>
		<?php echo $posts_pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div><!-- .pagination-wrapper -->
<?php endif; ?>
