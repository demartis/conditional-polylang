<?php
/**
 * Shortcode: is_language
 * Description: Displays content only if the specified language matches the current Polylang language.
 *
 * Usage: [is_language lang="en"]Content to display[/is_language]
 *
 * @package Conditional_Polylang
 * @since 1.0.0
 */

/**
 * Class Conditional_Polylang_Shortcode.
 */
class Conditional_Polylang_Shortcode {

	/**
	 * Initialize the shortcode.
	 */
	public static function init() {
		add_shortcode( 'is_language', array( __CLASS__, 'render_shortcode' ) );
	}

	/**
	 * Render the shortcode.
	 *
	 * @param array       $atts    Shortcode attributes.
	 * @param string|null $content Content between shortcode tags.
	 * @return string Shortcode output.
	 */
	public static function render_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'lang' => '', // The language code.
			),
			$atts,
			'is_language'
		);

		// Return content if the current language matches the specified language.
		if ( ! empty( $atts['lang'] ) && conditional_polylang_is_language( $atts['lang'] ) ) {
			return do_shortcode( $content );
		}
		return '';
	}
}

// Register the shortcode.
Conditional_Polylang_Shortcode::init();
