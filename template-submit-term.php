<?php
/**
 * Template Name: Submit Glossary Term
 *
 * This template is used to display a form for submitting new glossary terms.
 *
 * @package Collaborative_Glossary
 */

// Check if the form is submitted and process the form data.
if ( isset( $_POST['submit_term'] ) && wp_verify_nonce( $_POST['submit_term_nonce'], 'submit_term_action' ) ) {
    $term_title = sanitize_text_field( $_POST['term_title'] );
    $term_definition = sanitize_textarea_field( $_POST['term_definition'] );
    $related_terms = sanitize_text_field( $_POST['related_terms'] );
    $relevant_links = esc_url_raw( $_POST['relevant_links'] );

    // Create a new glossary term post.
    $new_term_args = array(
        'post_title'    => $term_title,
        'post_content'  => $term_definition,
        'post_type'     => 'glossary', // Replace with your custom post type slug.
        'post_status'   => 'pending', // Set initial status as pending for admin approval.
    );

    $new_term_id = wp_insert_post( $new_term_args );

    if ( ! is_wp_error( $new_term_id ) ) {
        // Update custom fields (related terms and relevant links).
        update_post_meta( $new_term_id, 'related_terms', $related_terms );
        update_post_meta( $new_term_id, 'relevant_links', $relevant_links );

        // Optionally, notify the administrator of the new term submission.
        $admin_email = get_option( 'admin_email' );
        $subject = 'New Glossary Term Submission';
        $message = 'A new glossary term has been submitted and is pending approval. Title: ' . $term_title;
        wp_mail( $admin_email, $subject, $message );

        // Redirect to a thank you page or the same page with a success message.
        wp_redirect( home_url( '/submit-term/?submitted=1' ) );
        exit;
    } else {
        // Handle errors if post creation fails.
        $error_message = $new_term_id->get_error_message();
        wp_die( 'Error creating glossary term: ' . $error_message );
    }
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <?php
                // Output a success message if the term is successfully submitted.
                if ( isset( $_GET['submitted'] ) && $_GET['submitted'] == 1 ) {
                    echo '<p class="submit-success">Thank you! Your glossary term has been submitted and is pending approval.</p>';
                }
                ?>

                <form id="submit-glossary-term-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

                    <input type="hidden" name="action" value="submit_glossary_term">
                    <?php wp_nonce_field( 'submit_term_action', 'submit_term_nonce' ); ?>

                    <p>
                        <label for="term_title">Term Title:</label><br>
                        <input type="text" id="term_title" name="term_title" required>
                    </p>

                    <p>
                        <label for="term_definition">Term Definition:</label><br>
                        <textarea id="term_definition" name="term_definition" rows="4" required></textarea>
                    </p>

                    <p>
                        <label for="related_terms">Related Terms:</label><br>
                        <input type="text" id="related_terms" name="related_terms">
                    </p>

                    <p>
                        <label for="relevant_links">Relevant Links:</label><br>
                        <input type="url" id="relevant_links" name="relevant_links">
                    </p>

                    <p>
                        <input type="submit" name="submit_term" value="Submit Term">
                    </p>

                </form>

            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
