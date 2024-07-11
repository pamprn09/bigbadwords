<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it's ready for translation.
 *
 * @link       https://pamelaribeiro.dev.br
 * @since      1.0.0
 *
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it's ready for translation.
 *
 * @since      1.0.0
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/includes
 */
class Collaborative_Glossary_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'collaborative-glossary',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }
}
