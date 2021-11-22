<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    A11y_Overlay_Search
 * @subpackage A11y_Overlay_Search/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    A11y_Overlay_Search
 * @subpackage A11y_Overlay_Search/public
 * @author     Henri Avoketo, Avidly
 */
class A11y_Overlay_Search_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in A11y_Overlay_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The A11y_Overlay_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/overlay-search-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in A11y_Overlay_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The A11y_Overlay_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/overlay-search-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Search form, used in dialog output.
	 *
	 * @return $form HTML output.
	 */
	private function search_form() {

		// Detect current language if Polylang is used.
		$lang = ( function_exists( 'pll_current_language' ) ) ? pll_current_language() : '';

		$form = sprintf(
			'<div class="a11y-overlaysearch__wrapper">
			<form id="a11y-overlaysearch" role="search" method="get" class="a11y-overlaysearch__form" action="%1$s">
			<label for="s" class="screen-reader-text">%2$s</label>
			<input placeholder="%2$s" autocomplete="off" type="search" value="%3$s" name="s" class="a11y-overlaysearch__input" autofocus />
			<button type="submit" form="a11y-overlaysearch" value="%4$s" class="a11y-overlaysearch__submit a11y-overlaysearch--icon"><span class="screen-reader-text">%4$s</span>%5$s</button>
			</form>
			</div>',
			esc_url( home_url( '/' ) . $lang ), // Form action.
			esc_html__( 'Search from site', 'overlay-search' ), // Label & placeholder text.
			get_search_query(), // Input value.
			esc_html__( 'Search', 'overlay-search' ), // Submit value.
			'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
		);

		return $form;
	}

	/**
	 * Overlay dialog HTML output.
	 *
	 * @return void
	 */
	public function dialog() {
		$overlay_search = sprintf(
			'<div role="dialog" class="a11y-overlaysearch__dialog">
			<div class="a11y-overlaysearch__container">
			%s<button class="a11y-overlaysearch__close a11y-overlaysearch--icon"><span class="screen-reader-text">%s</span>%s</button></div>
			</div>',
			$this->search_form(), // Form.
			esc_html__( 'Close search', 'overlay-search' ), // Close button screen reader text.
			'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>'
		);

		echo $overlay_search; // phpcs:ignore
	}
}