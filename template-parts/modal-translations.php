<?php
/**
 * Karma modal translations presenter
 *
 * @package Karma
 * @since 1.0.0
 */

?>
<div class="search-modal cover-modal header-footer-group translations-modal" data-modal-target-string=".translations-modal">

	<div class="search-modal-inner modal-inner">

		<div class="inner">

			<div class="translations-content-wrapper" style="display: flex; flex-direction: column;">

			<style>
				.skiptranslate {
					padding: 0 .2em;
				}

				.skiptranslate > div {
					margin-left: -0.2em;
				}

				.skiptranslate select {
					font-size: 2em;
				}
			</style>

				<div id="google_translate_element" style="padding-top: 1em;"></div>
				<script>
					var m = false;
					function googleTranslateElementInit() {
						new google.translate.TranslateElement( {
							pageLanguage: 'en',
							includedLanguages: 'am,en,es,ko,lo,ru,so,th,vi,zh-CN,zh-TW',
							layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
						}, 'google_translate_element' );
					}
				</script>
				<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

				<p class="disclaimer-notice" style="padding: 0; width: 100%; color: #666; font-size: 0.8em; margin-top: 0.5em; ">
					<em><a href="#">* Disclaimer</a></em>

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
