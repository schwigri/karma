<?php
/**
 * Karma modal banner presenter
 *
 * @package Karma
 * @since 1.1.0
 */

?>
<?php if ( '' !== get_theme_mod( 'banner_text', '' ) ) : ?>
	<div class="banner" id="banner">

		<div class="banner-inner">

			<p class="banner-emoji-container">
				<span class="banner-emoji emoji" aria-label="Megaphone emoji">📢</span>
			</p>

			<p class="banner-inner-contenr">
				<?php
				echo wp_kses(
					get_theme_mod( 'banner_text' ),
					array(
						'a'  => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
							'class'  => array(),
							'lang'   => array(),
						),
						'br' => array(),
					)
				);
				?>
			</p>

			<p>
				<?php if ( '' !== get_theme_mod( 'banner_link' ) ) : ?>
					<a class="button" href="<?php echo esc_url( get_theme_mod( 'banner_link' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( get_theme_mod( 'banner_button_text' ) ); ?></a>
				<?php endif; ?>
				<button id="close-banner-button" class="button button-borderless">
					<?php if ( '' !== get_theme_mod( 'close_banner_text', '' ) ) : ?>
						<?php echo esc_html( get_theme_mod( 'close_banner_text' ) ); ?>
					<?php else : ?>
						Not right now
					<?php endif; ?>
				</button>
			</p>

		</div><!-- .banner-inner -->

	</div><!-- .banner -->
<?php endif; ?>
