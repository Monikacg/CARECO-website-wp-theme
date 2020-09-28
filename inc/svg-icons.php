<?php
if ( ! function_exists( 'twentytwenty_the_theme_svg' ) ) {
	function twentytwenty_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
		echo twentytwenty_get_theme_svg( $svg_name, $group, $color );
	}
}

if ( ! function_exists( 'twentytwenty_get_theme_svg' ) ) {
	function twentytwenty_get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
		$svg = wp_kses(
			TwentyTwenty_SVG_Icons::get_svg( $svg_name, $group, $color ),
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
