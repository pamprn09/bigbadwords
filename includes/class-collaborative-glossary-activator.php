<?php
/**
 * Fired during plugin activation.
 *
 * @link       https://pamelaribeiro.dev.br
 * @since      1.0.0
 *
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/includes
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 */
class Collaborative_Glossary_Activator {

    /**
     * Method to run during plugin activation.
     *
     * @since    1.0.0
     */
    public static function activate() {
        
        // Flush rewrite rules to ensure the custom post types and taxonomies are recognized.
        flush_rewrite_rules();
    }
}
