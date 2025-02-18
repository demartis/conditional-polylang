<?php
/**
 * Shortcodes for Conditional Polylang Plugin with simplified syntax.
 *
 * Usage:
 * [conditional_language]
 *   [if_lang code="gb"]This is the content for GB[/if_lang]
 *   [if_lang code="au"]This is the content for Australia[/if_lang]
 *   [otherwise]This is the content for other languages[/otherwise]
 * [/conditional_language]
 *
 * The [if_lang] shortcode also works outside the container:
 *
 * [if_lang code="gb"]This is the content for GB[/if_lang]
 *
 * @package Conditional_Polylang
 * @since 1.2.0
 */

// Global variables to store container state and output.
global $cpl_container_active, $cpl_container_output;
$cpl_container_active = false;
$cpl_container_output = array( 'match' => '', 'fallback' => '' );

/**
 * Container shortcode handler.
 *
 * Processes all enclosed [if_lang] and [otherwise] shortcodes.
 *
 * @param array       $atts    Shortcode attributes.
 * @param string|null $content The content inside the container.
 * @return string The output: first matched [if_lang] content if available, otherwise the fallback.
 */
function cpl_container_shortcode( $atts, $content = null ) {
	global $cpl_container_active, $cpl_container_output;

	// Set the container flag and initialize the output.
	$cpl_container_active = true;
	$cpl_container_output = array( 'match' => '', 'fallback' => '' );

	// Process inner shortcodes.
	do_shortcode( $content );

	// Determine which content to output.
	$output = '';
	if ( ! empty( $cpl_container_output['match'] ) ) {
		$output = $cpl_container_output['match'];
	} elseif ( ! empty( $cpl_container_output['fallback'] ) ) {
		$output = $cpl_container_output['fallback'];
	}

	// Reset the container flag.
	$cpl_container_active = false;

	return $output;
}

/**
 * [if_lang] shortcode handler.
 *
 * Checks if the current language matches the provided 'code' attribute.
 * If a container is active, it stores the content; otherwise, it outputs immediately.
 *
 * @param array       $atts    Shortcode attributes.
 * @param string|null $content The content to display if the condition is met.
 * @return string Always returns an empty string in container mode, or the content when used standalone.
 */
function cpl_if_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'code' => '', // The language code.
		),
		$atts,
		'if_lang'
	);

	// Check if the language condition is met.
	if ( ! empty( $atts['code'] ) && conditional_polylang_is_language( $atts['code'] ) ) {
		global $cpl_container_active, $cpl_container_output;
		// If inside a container, store the content if not already stored.
		if ( $cpl_container_active ) {
			if ( empty( $cpl_container_output['match'] ) ) {
				$cpl_container_output['match'] = do_shortcode( $content );
			}
			// Return an empty string so the container controls the output.
			return '';
		} else {
			// Standalone use: return the content immediately.
			return do_shortcode( $content );
		}
	}

	return '';
}

/**
 * [otherwise] shortcode handler.
 *
 * Intended to be used only inside a container, it stores the fallback content.
 *
 * @param array       $atts    Shortcode attributes (unused).
 * @param string|null $content The fallback content.
 * @return string Always returns an empty string.
 */
function cpl_else_shortcode( $atts, $content = null ) {
	global $cpl_container_active, $cpl_container_output;
	if ( $cpl_container_active ) {
		// Only set fallback if no match has been stored and fallback not already set.
		if ( empty( $cpl_container_output['match'] ) && empty( $cpl_container_output['fallback'] ) ) {
			$cpl_container_output['fallback'] = do_shortcode( $content );
		}
	}
	return '';
}

// Register the shortcodes.
add_shortcode( 'conditional_language', 'cpl_container_shortcode' );
add_shortcode( 'if_lang', 'cpl_if_shortcode' );
add_shortcode( 'otherwise', 'cpl_else_shortcode' );
