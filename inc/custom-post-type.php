<?php
function glossary_register_custom_post_type() {
    $labels = array(
        'name'               => __( 'Terms', 'glossary' ),
        'singular_name'      => __( 'Term', 'glossary' ),
        'add_new'            => __( 'Add New Term', 'glossary' ),
        'add_new_item'       => __( 'Add New Term', 'glossary' ),
        'edit_item'          => __( 'Edit Term', 'glossary' ),
        'new_item'           => __( 'New Term', 'glossary' ),
        'all_items'          => __( 'All Terms', 'glossary' ),
        'view_item'          => __( 'View Term', 'glossary' ),
        'search_items'       => __( 'Search Terms', 'glossary' ),
        'not_found'          => __( 'No terms found', 'glossary' ),
        'not_found_in_trash' => __( 'No terms found in Trash', 'glossary' ),
        'menu_name'          => __( 'Glossary', 'glossary' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'term' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor' ),
    );

    register_post_type( 'term', $args );
}
add_action( 'init', 'glossary_register_custom_post_type' );
