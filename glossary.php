<?php
/*
Plugin Name: Glossary Plugin
Description: A collaborative glossary plugin.
Version: 1.0
Author: Pamela Ribeiro
Author URI: pamelaribeiro.dev.br
Text Domain: glossary
Domain Path: /languages
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load plugin text domain for translations
function glossary_load_textdomain() {
    load_plugin_textdomain( 'glossary', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'glossary_load_textdomain' );

// Include required files
require_once plugin_dir_path( __FILE__ ) . 'inc/functions.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/custom-post-type.php';

// Admin-specific files
if ( is_admin() ) {
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
}

// Public-specific files
require_once plugin_dir_path( __FILE__ ) . 'public/public-functions.php';

function ygp_load_textdomain() {
    load_plugin_textdomain( 'glossary', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'glossary_load_textdomain' );

