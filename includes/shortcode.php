<?php
/**
 * Shortcodes for Conditional Polylang Plugin with simplified syntax.
 *
 * Usage:
 * [conditional_language]
 *   [if_lang lang="gb"]This is the content for GB[/if_lang]
 *   [if_lang lang="au"]This is the content for Australia[/if_lang]
 *   [else_lang]This is the content for other languages[/else_lang]
 * [/conditional_language]
 *
 * The [if_lang] shortcode also works outside the container:
 *
 * [if_lang lang="gb"]This is the content for GB[/if_lang]
 *
 * @package Conditional_Polylang
 * @since 1.1.0
 */

// Global variables to store container state and output.
global $conditional_language_in_container, $conditional_language_output;
$conditional_language_in_container = false;
$conditional_language_output = array( 'match' => '', 'fallback' => '' );

/**
 * Container shortcode handler.
 *
 * Processes all enclosed [if_lang] and [else_lang] shortcodes.
 *
 * @param array       $atts    Shortcode attributes.
 * @param string|null $content The content inside the container.
 * @return string The output: first matched [if_lang] content if available, otherwise the fallback.
 */
function conditional_language_container_shortcode( $atts, $content = null ) {
	global $conditional_language_in_container, $conditional_language_output;

	// Set the container flag and initialize the output.
	$conditional_language_in_container = true;
	$conditional_language_output = array( 'match' => '', 'fallback' => '' );

	// Process inner shortcodes.
	do_shortcode( $content );

	// Determine which content to output.
	$output = '';
	if ( ! empty( $conditional_language_output['match'] ) ) {
		$output = $conditional_language_output['match'];
	} elseif ( ! empty( $conditional_language_output['fallback'] ) ) {
		$output = $conditional_language_output['fallback'];
	}

	// Reset the container flag.
	$conditional_language_in_container = false;

	return $output;
}

/**
 * [if_lang] shortcode handler.
 *
 * Checks if the current language matches the provided 'lang' attribute.
 * If a container is active, it stores the content; otherwise, it outputs immediately.
 *
 * @param array       $atts    Shortcode attributes.
 * @param string|null $content The content to display if the condition is met.
 * @return string Always returns an empty string in container mode, or the content when used standalone.
 */
function conditional_language_if_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'lang' => '', // The language code.
		),
		$atts,
		'if_lang'
	);

	// Check if the language condition is met.
	if ( ! empty( $atts['lang'] ) && conditional_polylang_is_language( $atts['lang'] ) ) {
		global $conditional_language_in_container, $conditional_language_output;
		// If inside a container, store the content if not already stored.
		if ( $conditional_language_in_container ) {
			if ( empty( $conditional_language_output['match'] ) ) {
				$conditional_language_output['match'] = do_shortcode( $content );
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
 * [else_lang] shortcode handler.
 *
 * Intended to be used only inside a container, it stores the fallback content.
 *
 * @param array       $atts    Shortcode attributes (unused).
 * @param string|null $content The fallback content.
 * @return string Always returns an empty string.
 */
function conditional_language_else_shortcode( $atts, $content = null ) {
	global $conditional_language_in_container, $conditional_language_output;
	if ( $conditional_language_in_container ) {
		// Only set fallback if no match has been stored and fallback not already set.
		if ( empty( $conditional_language_output['match'] ) && empty( $conditional_language_output['fallback'] ) ) {
			$conditional_language_output['fallback'] = do_shortcode( $content );
		}
	}
	return '';
}

// Register the shortcodes.
add_shortcode( 'conditional_language', 'conditional_language_container_shortcode' );
add_shortcode( 'if_lang', 'conditional_language_if_shortcode' );
add_shortcode( 'else_lang', 'conditional_language_else_shortcode' );
