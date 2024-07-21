<?php
/**
 * Template Name: Single Glossary Entry
 *
 * This template is used to display single glossary entries.
 */

get_header();

// Start the loop
while ( have_posts() ) : the_post();
    ?>
    <main id="main" class="site-main" role="main">
        <div class="glossary-entry">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title">title is:<?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>

                    <?php
                    // Display related terms custom field
                    $related_terms = get_post_meta( get_the_ID(), 'related_terms', true );
                    //var_dump($related_terms);
                    var_dump(get_post_meta(get_the_ID()));

                    if ($related_terms) :
                        ?>
                        <div class="related-terms">
                            <h3>Related Terms</h3>
                            <ul>
                                <?php foreach ($related_terms as $term) : ?>
                                    <li><?php echo esc_html($term); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
        </div>
    </main>
    <?php
endwhile; // End of the loop.

get_footer();
