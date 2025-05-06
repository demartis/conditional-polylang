<?php
/**
 * Shortcodes for Conditional Polylang Plugin with simplified and restricted syntax.
 *
 * This file provides shortcodes to conditionally display content based on the current language,
 * using a simplified syntax for the Conditional Polylang plugin.
 */

global $cpl_container_active, $cpl_container_output;
$cpl_container_active = false;
$cpl_container_output = array( 'match' => '', 'fallback' => '' );

/**
 * Handles the [conditional_language] shortcode which acts as a container for conditional content.
 *
 * @param array  $atts    Shortcode attributes (unused in this case).
 * @param string $content The content inside the [conditional_language] tags.
 * @return string The processed content based on language conditions.
 */
function cpl_container_shortcode( $atts, $content = null ) {
    global $cpl_container_active, $cpl_container_output;

    $cpl_container_active = true;
    $cpl_container_output = array( 'match' => '', 'fallback' => '' );

    do_shortcode( $content );

    $output = '';
    if ( ! empty( $cpl_container_output['match'] ) ) {
        $output = $cpl_container_output['match'];
    } elseif ( ! empty( $cpl_container_output['fallback'] ) ) {
        $output = $cpl_container_output['fallback'];
    }

    $cpl_container_active = false;

    return $output;
}

/**
 * Handles the [if] shortcode which checks if the current language matches a specified one.
 *
 * @param array  $atts    Shortcode attributes with 'lang' key (e.g., lang="en").
 * @param string $content The content to display if the condition is met.
 * @return string Empty string, as output is handled by the container.
 */
function cpl_if_shortcode( $atts, $content = null ) {
    global $cpl_container_active, $cpl_container_output;

    // Only operate inside a container
    if ( ! $cpl_container_active ) {
        return ''; // or optionally: return '<!-- [if] used outside of [conditional_language] -->';
    }

    $atts = shortcode_atts(
        array(
            'lang' => '',
        ),
        $atts,
        'if'
    );

    if ( ! empty( $atts['lang'] ) && conditional_polylang_is_language( $atts['lang'] ) ) {
        if ( empty( $cpl_container_output['match'] ) ) {
            $cpl_container_output['match'] = do_shortcode( $content );
        }
    }

    return '';
}

/**
 * Handles the [else] shortcode which provides fallback content when no [if] condition is met.
 *
 * @param array  $atts    Shortcode attributes (unused in this case).
 * @param string $content The content to display if no previous [if] condition matched.
 * @return string Empty string, as output is handled by the container.
 */
function cpl_else_shortcode( $atts, $content = null ) {
    global $cpl_container_active, $cpl_container_output;

    if ( ! $cpl_container_active ) {
        return '';
    }

    if ( empty( $cpl_container_output['match'] ) && empty( $cpl_container_output['fallback'] ) ) {
        $cpl_container_output['fallback'] = do_shortcode( $content );
    }

    return '';
}

// Register the simplified shortcodes
add_shortcode( 'conditional_language', 'cpl_container_shortcode' );
add_shortcode( 'if', 'cpl_if_shortcode' );
add_shortcode( 'else', 'cpl_else_shortcode' );
