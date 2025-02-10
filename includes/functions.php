<?php
/**
 * Conditional Tag to check against a defined language.
 *
 * @package Conditional_Polylang
 * @since 1.0.0
 */

/**
 * Checks if the current Polylang language matches the specified language code.
 *
 * @param string $language The language code to check.
 * @return bool True if the current language matches; otherwise, false.
 */
function conditional_polylang_is_language( $language ) {
	if ( function_exists( 'pll_current_language' ) ) {
		$current_language = pll_current_language( 'slug' );
		return ( $language === $current_language );
	}
	return false;
}
