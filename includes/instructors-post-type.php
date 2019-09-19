<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  define('CAPABILITY', 'update_core');

  $args = [
    'menu_icon' => 'dashicons-admin-users',
    // 'show_in_menu' => 'edit.php?post_type=venues',
    'hierarchical' => false,
    'has_archive' => false,
    'rewrite' => array( 'slug' => 'zaly_i_instructory/instructor', 'with_front' => true ),
    'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes'),
    'capabilities' => [
      'edit_post'          => CAPABILITY,
      'read_post'          => CAPABILITY,
      'delete_post'        => CAPABILITY,
      'edit_posts'         => CAPABILITY,
      'edit_others_posts'  => CAPABILITY,
      'delete_posts'       => CAPABILITY,
      'publish_posts'      => CAPABILITY,
      'read_private_posts' => CAPABILITY
    ],
    'template' => [
      ['core/paragraph', [ 'placeholder' => 'Bio' ] ],
    ],
  ];
  $labels = ['add_new' => "Добавить нового"];
  $instructors = new PostType('Инструктор', 'Инструкторы', 'instructors', 'm', $args, $labels);
  $instructors->add_meta('venueIds');