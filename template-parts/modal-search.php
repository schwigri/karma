<?php
/**
 * Karma modal search
 *
 * @package Karma
 * @since 1.0.0
 */

?>
<div class="search-modal cover-modal header-footer-group" data-modal-target-string=".search-modal">

	<div class="search-modal-inner modal-inner">

		<div class="inner">

			<?php
			get_search_form(
				array(
					'label' => __( 'Search for:', 'karma' ),
				)
			);
			?>

			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
				<span class="toggle-inner">
					<span class="toggle-icon">
						<?php karma_the_theme_svg( 'cross' ); ?>
					</span>
					<span class="toggle-text"><?php esc_html_e( 'Close search', 'karma' ); ?></span>
				</span>
			</button><!-- .search-untoggle -->

		</div><!-- .inner -->

	</div><!-- .search-modal-inner -->

</div><!-- .search-modal -->
