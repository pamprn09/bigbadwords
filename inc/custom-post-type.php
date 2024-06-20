<?php
function collaborative_glossary_register_custom_post_type() {
    $labels = array(
        'name'               => __( 'Terms', 'collaborative-glossary' ),
        'singular_name'      => __( 'Term', 'collaborative-glossary' ),
        'add_new'            => __( 'Add New Term', 'collaborative-glossary' ),
        'add_new_item'       => __( 'Add New Term', 'collaborative-glossary' ),
        'edit_item'          => __( 'Edit Term', 'collaborative-glossary' ),
        'new_item'           => __( 'New Term', 'collaborative-glossary' ),
        'all_items'          => __( 'All Terms', 'collaborative-glossary' ),
        'view_item'          => __( 'View Term', 'collaborative-glossary' ),
        'search_items'       => __( 'Search Terms', 'collaborative-glossary' ),
        'not_found'          => __( 'No terms found', 'collaborative-glossary' ),
        'not_found_in_trash' => __( 'No terms found in Trash', 'collaborative-glossary' ),
        'menu_name'          => __( 'collaborative-glossary', 'collaborative-glossary' ),
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
add_action( 'init', 'collaborative_glossary_register_custom_post_type' );
