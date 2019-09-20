<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  // define('CAPABILITY', 'update_core');
define('CAPABILITY', 'update_core');

  $args = [
    'menu_icon' => 'dashicons-admin-users',
    // 'show_in_menu' => 'edit.php?post_type=venues',
    'hierarchical' => false,
    'has_archive' => false,
    'rewrite' => array( 'slug' => 'zaly_i_instructory/instructor', 'with_front' => true ),
    'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes'),
    // 'capability_type' => 'post',
    // 'map_meta_cap' => true,

    // 'capabilities' => [
      // 'edit_published_posts' => 'read_post',
      // 'edit_post'          => CAPABILITY,
      // 'read_post'          => CAPABILITY,
    //   'delete_post'        => CAPABILITY,
      // 'edit_posts'         => CAPABILITY,
    //   'edit_others_posts'  => CAPABILITY,
    //   'delete_posts'       => CAPABILITY,
      // 'publish_posts'      => 'edit_others_posts',
    //   'read_private_posts' => CAPABILITY
    // ],

    // 'map_meta_cap' => false,
    // 'capability_type' => 'instructor',
    // 'capabilities' => [
      // meta caps (don't assign these to roles)
      
        // 'edit_post'              => 'edit_posts',
        // 'read_post'              => 'edit_posts',
        // 'delete_post'            => 'delete_others_posts',
        
      // primitive/meta caps
      
        // 'create_posts'           => 'edit_private_posts',
      
      // primitive caps used outside of map_meta_cap()
      // 'edit_posts'             => 'edit_instructors',

        // 'edit_posts'             => 'edit_posts',
        // 'edit_others_posts'      => 'edit_private_posts',
        // 'publish_posts'          => 'edit_posts',
        // 'read_private_posts'     => 'edit_private_posts',
      
      // primitive caps used inside of map_meta_cap()
      // 'read'                   => 'read',
      // 'delete_posts'           => 'delete_instructors',
      // 'delete_private_posts'   => 'delete_privete_instructors',
      // 'delete_published_posts' => 'delete_published_instructors',
      // 'delete_others_posts'    => 'delete_others_instructors',
      // 'edit_private_posts'     => 'edit_private_instructors',
      // 'edit_published_posts'   => 'edit_published_instructors',
    // ],

    'template' => [
      ['bayder-school/bio'],
      ['core/paragraph', [ 'placeholder' => 'Биография' ] ],
      ['bayder-school/schedule'],
    ],
  ];
  $labels = ['add_new' => "Добавить нового"];
  $instructors = new PostType('Инструктор', 'Инструкторы', 'instructors', 'm', $args, $labels);
  $instructors->add_meta('venueIds');