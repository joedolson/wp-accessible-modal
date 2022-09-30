<?php
/*
 * Plugin Name: WP Accessible Modal
 * Plugin URI: http://www.joedolson.com/
 * Plugin Description: Implements a simple accessible modal. Uses van11y accessible modal: https://github.com/nico3333fr/van11y-accessible-modal-window-aria
 * Version: 1.0.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_action( 'wp_enqueue_scripts', 'wpam_enqueue_styles', 10, 1 );
/**
 * The primary function this plug-in serves is to enqueue CSS and JS.
 */
function wpam_enqueue_styles() {
	$css_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'src/css/wpam-styles.css' ) );

	if ( SCRIPT_DEBUG && true === SCRIPT_DEBUG ) {
		$script = 'van11y-accessible-modal-window-aria.js';
	} else {
		$script = 'van11y-accessible-modal-window-aria.min.js';
	}
	$js_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'src/js/' . $script ) );

	wp_enqueue_script( 'wpam.script', plugins_url( 'src/js/' . $script, __FILE__ ), array(), $js_ver, true );
	wp_localize_script(
		'wpam.script',
		'wpam',
		array(
			'context' => (string) is_user_logged_in(),
		)
	);
	wp_enqueue_style( 'wpam.style', plugins_url( 'src/css/wpam-styles.css', __FILE__ ), array(), $css_ver );
}

/**
 * Insert a modal dialog.
 *
 * @param array $atts Shortcode attributes.
 * @param string $content Contained content.
 */
function wpam_insert_modal( $atts, $content = '' ) {
	$args = shortcode_atts(
		array(
			'text'     => 'Open Modal',
			'prefix'   => 'simple',
			'title'    => 'Modal Content',
			'close'    => __( 'Close', 'wpam' ),
		),
		$atts,
		'wpam_insert_modal'
	);
	$generated_id = md5( $content );
	$button       = '<button class="js-modal button" data-modal-prefix-class="' . $args['prefix'] . '" data-modal-content-id="' . $generated_id . '" data-modal-title="' . $args['title'] . '" data-modal-close-text="' . $args['close'] . '">' . $args['text'] . '</button>';
	$content = ( '' === $content ) ? __( 'Add content between [modal] and [/modal] to display.', 'wpam' ) : $content;

	return $button . '<div id="' . $generated_id . '" class="modal-content">' . $content . '</div>';
}
add_shortcode( 'modal', 'wpam_insert_modal' );
 