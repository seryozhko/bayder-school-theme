<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  $args = [
    'menu_icon' => 'dashicons-admin-users',
    // 'show_in_menu' => 'edit.php?post_type=venues',
    'hierarchical' => false,
    'has_archive' => false,
    'rewrite' => array( 'slug' => 'zaly_i_instructory/instructor', 'with_front' => true ),
    'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes'),
    'capability_type' => 'instructor',
    'map_meta_cap' => true,
    'template' => [
      ['bayder-school/bio'],
      ['core/paragraph', [ 'placeholder' => 'Биография' ] ],
      ['bayder-school/schedule'],
    ],
  ];
  $labels = ['add_new' => "Добавить нового"];
  $instructors = new PostType('Инструктор', 'Инструкторы', 'instructors', 'm', $args, $labels);
  $instructors->add_meta('venueIds');