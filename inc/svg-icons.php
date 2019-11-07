<?php
/**
 * Karma SVG Icon helper functions
 *
 * @package Karma
 * @since 1.0.0
 */

if ( ! function_exists( 'karma_get_theme_svg' ) ) {
	/**
	 * Get theme SVG.
	 *
	 * @param string $name  The name of the icon.
	 * @param string $group The group the icon belongs to.
	 * @param string $color The color the icon should be.
	 */
	function karma_get_theme_svg( $name, $group = 'ui', $color = '' ) {
		$svg = wp_kses(
			Karma_SVG_Icons::get_svg( $name, $group, $color ),
			array(
				'svg'     => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true,
				),
				'path'    => array(
					'fill'      => true,
					'fill-rule' => true,
					'd'         => true,
					'transform' => true,
				),
				'polygon' => array(
					'fill'      => true,
					'fill-rule' => true,
					'points'    => true,
					'transform' => true,
					'focusable' => true,
				),
			)
		);
		if ( ! $svg ) {
			return false;
		}
		return $svg;
	}
}

if ( ! function_exists( 'karma_the_theme_svg' ) ) {
	/**
	 * Get and output theme SVG.
	 *
	 * @param string $name  The name of the icon.
	 * @param string $group The group the icon belongs to.
	 * @param string $color The color the icon should be.
	 */
	function karma_the_theme_svg( $name, $group = 'ui', $color = '' ) {
		echo karma_get_theme_svg( $name, $group, $color ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in karma_get_theme_svg().
	}
}
