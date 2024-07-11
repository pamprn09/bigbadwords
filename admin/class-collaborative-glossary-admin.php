<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @package    Collaborative_Glossary
 * @subpackage Collaborative_Glossary/admin
 */

class Collaborative_Glossary_Admin {

    /**
     * The ID of this plugin.
     *
     * @var string
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @var string
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    /**
     * Register the custom post type for glossary terms.
     *
     * @since    1.0.0
     */
    public function register_cpt_glossary_term() {
        $labels = [
            'name'                  => _x( 'Glossary Terms', 'Post Type General Name', 'collaborative-glossary' ),
            'singular_name'         => _x( 'Glossary Term', 'Post Type Singular Name', 'collaborative-glossary' ),
            'menu_name'             => __( 'Glossary', 'collaborative-glossary' ),
            'name_admin_bar'        => __( 'Glossary Term', 'collaborative-glossary' ),
            'all_items'             => __( 'All Items', 'collaborative-glossary' ),
            'add_new_item'          => __( 'Add New Item', 'collaborative-glossary' ),
            'add_new'               => __( 'Add New', 'collaborative-glossary' ),
            'new_item'              => __( 'New Item', 'collaborative-glossary' ),
            'edit_item'             => __( 'Edit Item', 'collaborative-glossary' ),
            'update_item'           => __( 'Update Item', 'collaborative-glossary' ),
            'view_item'             => __( 'View Item', 'collaborative-glossary' ),
            'view_items'            => __( 'View Items', 'collaborative-glossary' ),
            'search_items'          => __( 'Search Item', 'collaborative-glossary' ),
            'not_found'             => __( 'Not found', 'collaborative-glossary' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'collaborative-glossary' ),
        ];
        $args = [
            'label'                 => __( 'Glossary Term', 'collaborative-glossary' ),
            'description'           => __( 'Glossary Terms', 'collaborative-glossary' ),
            'labels'                => $labels,
            'supports'              => [ 'title', 'editor', 'revisions' ],
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'menu_icon'             => 'dashicons-book-alt',
            'supports'              => array( 'title', 'editor' ),
        ];
        register_post_type( 'glossary', $args );
    }

    /**
     * Enqueue the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/collaborative-glossary-admin.js',
            [ 'jquery' ],
            $this->version,
            false
        );
    }

    /**
     * Save post handler for the custom post type.
     *
     * @since    1.0.0
     * @param int $post_id The ID of the post being saved.
     * @return void
     */
    public function save_post( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['collaborative_glossary_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['collaborative_glossary_nonce'], 'save_collaborative_glossary' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Sanitize and save data.
        $fields = ['related_terms', 'relevant_links'];

        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
    }

    /**
     * Register the meta box for related terms.
     */
    public function add_meta_boxes() {
        add_meta_box(
            'related_terms_meta_box',
            __( 'Related Terms', 'collaborative_glossary' ),
            array( $this, 'render_related_terms_meta_box' ),
            'term',
            'side',
            'default'
        );
    }

    /**
     * Render the meta box for related terms.
     *
     * @param WP_Post $post The post object.
     */
    public function render_related_terms_meta_box( $post ) {
        $related_terms = get_post_meta( $post->ID, '_related_terms', true );
        $all_terms = get_posts( array(
            'post_type'   => 'term',
            'numberposts' => -1,
            'post_status' => 'publish',
        ) );

        wp_nonce_field( 'save_related_terms', 'related_terms_nonce' );

        ?>
        <p>
            <label for="related_terms"><?php _e( 'Select Related Terms:', 'collaborative_glossary' ); ?></label>
            <select name="related_terms[]" id="related_terms" multiple style="width: 100%;">
                <?php foreach ( $all_terms as $term ) : ?>
                    <option value="<?php echo esc_attr( $term->ID ); ?>" <?php selected( in_array( $term->ID, (array) $related_terms ) ); ?>>
                        <?php echo esc_html( $term->post_title ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    /**
     * Save the related terms meta data.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_related_terms_meta_box( $post_id ) {
        if ( ! isset( $_POST['related_terms_nonce'] ) || ! wp_verify_nonce( $_POST['related_terms_nonce'], 'save_related_terms' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $related_terms = isset( $_POST['related_terms'] ) ? array_map( 'intval', $_POST['related_terms'] ) : array();
        update_post_meta( $post_id, '_related_terms', $related_terms );
    }
}
