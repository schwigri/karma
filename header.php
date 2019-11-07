<?php
/**
 * Header for Karma
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karma
 * @since 1.0.0
 */

?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<header id="site-header" class="site-header" role="banner">

			<div class="inner header-inner">

				<div class="header-titles-wrapper">

					<?php
					$enable_header_search = get_theme_mod( 'enable_header_search', true );
					?>
					<?php if ( true === $enable_header_search ) : ?>
					<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php karma_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php esc_html_e( 'Search', 'karma' ); ?></span>
							</span>
						</button><!-- .mobile-search-toggle -->
					<?php endif; ?>

					<div class="header-titles">

						<?php
						// Site title or logo.
						karma_site_logo();

						// Site description.
						karma_site_description();
						?>

					</div><!-- .header-titles -->

					<!--
					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php karma_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php esc_html_e( 'Menu', 'karma' ); ?></span>
						</span>
					</button>--><!-- .mobile-nav-toggle -->

					<button class="toggle translations-toggle mobile-translations-toggle" data-toggle-target=".translations-modal"  data-toggle-body-class="showing-translations-modal" aria-expanded="false" data-set-focus=".close-translations-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php karma_the_theme_svg( 'translation' ); ?>
							</span>
							<span class="toggle-text"><?php esc_html_e( 'Translations', 'karma' ); ?></span>
						</span>
					</button><!-- .mobile-translations-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'karma' ); ?>" role="navigation">

						<ul class="primary-menu reset-list-style">

							<?php
							wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '%3$s',
									'theme_location' => 'primary',
								)
							);
							?>

						</ul><!-- .primary-menu -->

					</nav><!-- .primary-menu-wrapper -->
				<?php endif; ?>
				<?php if ( true === $enable_header_search ) : ?>
					<div class="header-toggles hide-no-js">

						<div class="toggle-wrapper search-toggle-wrapper">

						<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php karma_the_theme_svg( 'search' ); ?>
									</span>
									<span class="toggle-text"><?php esc_html_e( 'Search', 'karma' ); ?></span>
								</span>
							</button><!-- .desktop-search-toggle -->

						</div><!-- .search-toggle-wrapper -->

						<div class="toggle-wrapper translate-toggle-wrapper">

							<button class="toggle search-toggle desktop-translate-toggle">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php karma_the_theme_svg( 'translation' ); ?>
									</span>
									<span class="toggle-text"><?php esc_html_e( 'Translate', 'karma' ); ?></span>
								</span>
							</button><!-- .desktop-translate-toggle -->

						</div><!-- .translate-toggle-wrapper -->

					</div><!-- .header-toggles -->
				<?php endif; ?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

			<?php
			// Check if homepage image and video are set.
			$show_homepage_image        = get_theme_mod( 'homepage_image', false );
			$show_homepage_video        = get_theme_mod( 'homepage_video', false );
			$show_homepage_video_backup = get_theme_mod( 'homepage_video_backup', false );
			?>
			<?php if ( is_front_page() && false !== $show_homepage_image ) : ?>
				<div class="homepage-media">

					<div class="homepage-media-background">

						<?php if ( false !== $show_homepage_video || false !== $show_homepage_video_backup ) : ?>
							<video id="homepage-video" class="homepage-video" poster="<?php echo esc_url( $show_homepage_image ); ?>" data-play-button="homepage-video-play-button" data-pause-button="homepage-video-pause-button" muted loop>
								<?php if ( false !== $show_homepage_video ) : ?>
									<source src="<?php echo esc_url( $show_homepage_video ); ?>" type="video/webm">
								<?php endif; ?>
								<?php if ( false !== $show_homepage_video_backup ) : ?>
									<source src="<?php echo esc_url( $show_homepage_video_backup ); ?>" type="video/mp4">
								<?php endif; ?>
								<img class="homepage-video-image" style="display: none;" src="<?php echo esc_url( $show_homepage_image ); ?>" alt="" role="presentation" aria-hidden="true">
							</video>
						<?php else : ?>
							<img class="homepage-image" src="<?php echo esc_url( $show_homepage_image ); ?>" alt="" role="presentation" aria-hidden="true">
						<?php endif; ?>

					</div><!-- .homepage-media-background -->

					<div class="homepage-media-foreground">

						<div class="homepage-media-foreground-content">

							<?php
							// Check if homepage banner text and link are set.
							$homepage_banner_text          = get_theme_mod( 'homepage_banner_text', '' );
							$homepage_banner_text_line_two = get_theme_mod( 'homepage_banner_text_line_two', '' );
							$homepage_banner_cta_link      = get_theme_mod( 'homepage_banner_cta_link', '' );
							$homepage_banner_cta_text      = get_theme_mod( 'homepage_banner_cta_text' );
							?>
							<?php if ( '' !== $homepage_banner_text ) : ?>
								<p><?php echo esc_html( $homepage_banner_text ); ?></p>
							<?php endif; ?>

							<?php if ( '' !== $homepage_banner_text_line_two ) : ?>
								<p><?php echo esc_html( $homepage_banner_text_line_two ); ?></p>
							<?php endif; ?>

							<?php if ( '' !== $homepage_banner_cta_link && '' !== $homepage_banner_cta_text ) : ?>
								<div class="cta-wrapper">
									<a href="<?php echo esc_url( $homepage_banner_cta_link ); ?>" class="button cta"><?php echo esc_html( $homepage_banner_cta_text ); ?></a>
								</div><!-- .cta-wrapper -->
							<?php endif; ?>

						</div><!-- .homepage-media-foreground-content -->

						<?php if ( false !== $show_homepage_video || false !== $show_homepage_video_backup ) : ?>
						<div class="video-controls homepage-media-video-controls">

							<button id="homepage-video-play-button" class="toggle video-control play-button" aria-pressed="false">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php karma_the_theme_svg( 'play' ); ?>
									</span>
									<span class="toggle-text screen-reader-text">Play video</span>
								</span>
							</button>

							<button id="homepage-video-pause-button" class="toggle video-control pause-button" aria-pressed="false">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php karma_the_theme_svg( 'pause' ); ?>
									</span>
									<span class="toggle-text screen-reader-text">Pause video</span>
								</span>
							</button>

						</div><!-- .homepage-media-video-controls -->
						<?php endif; ?>

					</div><!-- .homepage-media-foreground -->

				</div><!-- .homepage-media -->
			<?php endif; ?>

		</header><!-- .site-header -->
