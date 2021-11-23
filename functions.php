<?php
/**
 * Forms and dialog functionality.
 *
 * @package Overlay_Search
 */

/**
 * Overlay search button to open modal, HTML output.
 *
 * @param bool   $show_label to determe should search label be visible or not.
 * @param string $class set custom classes for search button.
 * @param string $svg set custom icon for search button.
 *
 * @return $button
 */
function a11y_overlaysearch_button( $show_label = true, $class = '', $svg = '' ) {

	// Set defaults.
	$sr_only = ( $show_label ) ? '' : 'screen-reader-text';
	$class   = ( $class ) ? 'a11y-overlaysearch__open a11y-overlaysearch--icon ' . $class : 'a11y-overlaysearch__open a11y-overlaysearch--icon';
	$svg     = ( $svg ) ? $svg : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>';

	$button = sprintf(
		'<button class="%s" aria-haspopup="dialog"><span class="%s">%s</span>%s</button>',
		esc_attr( $class ), // Link class.
		esc_attr( $sr_only ), // Span class.
		esc_html__( 'Search', 'overlay-search' ), // Span content.
		$svg
	);

	return $button;
}
