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

/**
 * Query callback
 *
 */
function a11y_overlaysearch_query_callback( $query ) {
	$results = [];

	$query = new WP_Query([
		's'					=> sanitize_text_field( $query['s'] ),
	    'post_status'       => 'publish',
	    'orderby' 			=> 'title',
	    'order' 			=> 'ASC',
	    'posts_per_page'    => 25,
	    'no_found_rows'     => true,
	 ]);

	 if ( function_exists( 'relevanssi_do_query' ) ) {
	 	relevanssi_do_query( $query );
	 }

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
	    	$query->the_post();

		    $results[ get_the_ID() ] = [
		        'id'        => get_the_ID(),
		        'title'     => get_the_title(),
		        'permalink' => get_the_permalink(),
		        'post_type' => get_post_type_object(get_post_type())->labels->singular_name,
		    ];
	    }
	} 

	wp_reset_query();

	return $results;
}

/**
 * Set locale
 *
 */
if ( wp_is_json_request()) {
  add_filter( 'locale', 'a11y_overlaysearch_set_json_locale' );
  function a11y_overlaysearch_set_json_locale( $lang ) {
    $current_language = $_GET['lang'];

    if ( isset( $current_language ) ) {
      return $current_language;
    }
  }
}
