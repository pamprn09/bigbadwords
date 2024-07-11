<?php
/**
 * Fired during plugin deactivation.
 *
 * @link       https://pamelaribeiro.dev.br
 * @since      1.0.0
 *
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/includes
 */

/**
 * This class defines all code necessary to run during the plugin's deactivation.
 */
class Collaborative_Glossary_Deactivator {

    /**
     * Method to run during plugin deactivation.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        // Flush rewrite rules to remove custom post types and taxonomies.
        flush_rewrite_rules();
    }

}
