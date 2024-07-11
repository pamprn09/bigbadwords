<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pamelaribeiro.dev.br
 * @since      1.0.0
 *
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version,
 * and hooks for how to enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/public
 */
class Collaborative_Glossary_Public {

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Enqueue the public-facing stylesheets.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/collaborative-glossary-public.css',
            [],
            $this->version,
            'all'
        );
    }

    /**
     * Enqueue the public-facing JavaScript.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/collaborative-glossary-public.js',
            [ 'jquery' ],
            $this->version,
            false
        );
    }
}
