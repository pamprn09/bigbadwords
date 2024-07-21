<?php
/**
 * Plugin Name: Collaborative Glossary
 * Plugin URI: https://pamelaribeiro.dev.br/collaborative-glossary
 * Description: A collaborative glossary plugin allowing users to submit and manage glossary terms.
 * Version: 1.0.0
 * Author: Pamela Ribeiro
 * Author URI: https://pamelaribeiro.dev.br
 * Text Domain: collaborative-glossary
 * Domain Path: /languages
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'COLLABORATIVE_GLOSSARY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_collaborative_glossary() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-collaborative-glossary-activator.php';
    Collaborative_Glossary_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_collaborative_glossary() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-collaborative-glossary-deactivator.php';
    Collaborative_Glossary_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_collaborative_glossary' );
register_deactivation_hook( __FILE__, 'deactivate_collaborative_glossary' );

/**
 * Register custom template for 'glossary' custom post type.
 */
function collaborative_glossary_template_include($template) {
    if (is_singular('glossary')) {
        $glossary_template = plugin_dir_path(__FILE__) . '/single-glossary.php';
        if ('' !== $glossary_template) {
            return $glossary_template;
        }
    }
    return $template;
}
add_filter('template_include', 'collaborative_glossary_template_include');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-collaborative-glossary.php';

/**
 * Begins execution of the plugin.
 */
function run_collaborative_glossary() {
    $plugin = new Collaborative_Glossary();
    $plugin->run();
}
run_collaborative_glossary();

?>
