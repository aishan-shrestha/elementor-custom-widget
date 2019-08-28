<?php
/**
 * Plugin Name: Elementor Custom Widgets
 * Description: Basic Boilerplate for Custom widgets added to Elementor
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define('ECW_PLUGIN_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define( 'ECW_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

// plug it in
add_action('plugins_loaded', 'ecw_require_files');
function ecw_require_files() {
    require_once ECW_PLUGIN_PLUGIN_PATH.'modules.php';
}


// enqueue your custom style/script as your requirements
// add_action( 'wp_enqueue_scripts', 'ecw_enqueue_styles', 25);
function ecw_enqueue_styles() {
    wp_enqueue_style( 'elementor-custom-widget-editor', ECW_PLUGIN_DIR_URL . 'assets/css/editor.css');
}
