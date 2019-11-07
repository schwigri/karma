<?php
/**
 * Karma modal translations presenter
 *
 * @package Karma
 * @since 1.0.0
 */

?>
<?php if ( true === get_theme_mod( 'enable_translations' ) ) : ?>
	<div class="search-modal cover-modal header-footer-group translations-modal" data-modal-target-string=".translations-modal">

		<div class="search-modal-inner modal-inner">

			<div class="inner">

				<div class="translations-content-wrapper">

				<div id="google-translate-element" class="google-translate-element"></div>
					<script>
						var m = false;
						function googleTranslateElementInit() {
							new google.translate.TranslateElement( {
								pageLanguage: 'en',
								includedLanguages: 'am,en,es,ko,lo,ru,so,th,vi,zh-CN,zh-TW',
								layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
							}, 'google-translate-element' );
						}
					</script>
					<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

					<?php if ( '' !== get_theme_mod( 'translations_disclaimer_link', '' ) ) : ?>
						<p class="disclaimer-notice">
							<em><a data-lity href="<?php echo esc_url( get_theme_mod( 'translations_disclaimer_link', '' ) ); ?>"><?php esc_html_e( '*Disclaimer', 'karma' ); ?></a></em>
						</p>
					<?php endif; ?>

				</div><!-- .translations-content-wrapper -->

				<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".translations-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".translations-modal" aria-expanded="false">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php karma_the_theme_svg( 'cross' ); ?>
						</span>
						<span class="toggle-text"><?php esc_html_e( 'Close translations', 'karma' ); ?></span>
					</span>
				</button><!-- .search-untoggle -->

			</div><!-- .inner -->

		</div><!-- .search-modal-inner -->

	</div><!-- .search-modal -->
<?php endif; ?>
