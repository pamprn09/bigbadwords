<?php
function glossary_submission_form_shortcode() {
    ob_start();
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php _e( 'Submit New Term', 'glossary' ); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <form id="submit-term-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                        <input type="hidden" name="action" value="submit_new_term">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'submit_new_term_nonce' ); ?>">
                        <p>
                            <label for="termo"><?php _e( 'Term:', 'glossary' ); ?></label><br>
                            <input type="text" name="termo" id="termo" required>
                        </p>
                        <p>
                            <label for="definicao"><?php _e( 'Definition:', 'glossary' ); ?></label><br>
                            <textarea name="definicao" id="definicao" required></textarea>
                        </p>
                        <!-- Add additional fields as necessary (e.g., related terms and relevant links) -->
                        <p>
                            <input type="submit" value="<?php _e( 'Submit', 'glossary' ); ?>">
                        </p>
                    </form>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    return ob_get_clean();
}
add_shortcode( 'glossary_submission_form', 'glossary_submission_form_shortcode' );

function glossary_process_form_submission() {
    // Security check
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'submit_new_term_nonce' ) ) {
        wp_die( 'Security check failed. Please try again.' );
    }

    // Required fields check
    if ( ! isset( $_POST['termo'] ) || ! isset( $_POST['definicao'] ) ) {
        wp_die( 'Please fill out all required fields.' );
    }

    // Validate and sanitize input
    $term = array(
        'post_title'   => sanitize_text_field( $_POST['termo'] ),
        'post_content' => sanitize_text_field( $_POST['definicao'] ),
        'post_type'    => 'term',
        'post_status'  => 'draft', // Suggestions will be reviewed before publishing
    );

    // Insert term as draft
    $term_id = wp_insert_post( $term );

    // Process additional suggestions (e.g., related terms and relevant links)
    // process_suggestion_term( $term_id, $_POST['suggestion'] ); // Uncomment if necessary

    // Redirect to confirmation page
    wp_redirect( home_url( '/term-submitted/' ) );
    exit;
}
add_action( 'admin_post_submit_new_term', 'glossary_process_form_submission' );
add_action( 'admin_post_nopriv_submit_new_term', 'glossary_process_form_submission' );
