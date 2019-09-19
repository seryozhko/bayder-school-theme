<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  define('CAPABILITY', 'update_core');

  $args = array(
    'menu_icon' => 'dashicons-location',
    'has_archive' => 'zaly_i_instructory',
    'rewrite' => ['slug' => 'zaly_i_instructory/zal', 'with_front' => true],
    'supports' => ['title', 'editor', 'custom-fields', 'page-attributes'],
    'capabilities' => [
      'edit_post'          => CAPABILITY,
      'read_post'          => CAPABILITY,
      'delete_post'        => CAPABILITY,
      'edit_posts'         => CAPABILITY,
      'edit_others_posts'  => CAPABILITY,
      'delete_posts'       => CAPABILITY,
      'publish_posts'      => CAPABILITY,
      'read_private_posts' => CAPABILITY,
    ],
    'template' => [
      ['bayder-school/map', ['anchor' => 'map'] ],
    ],
    // 'template_lock' => 'all',
  );
  $venues = new PostType('Зал', 'Залы', 'venues', 'm', $args);

  $venues->add_meta('point');
  $venues->add_meta('venueAddress');
  $venues->add_meta('zoom', ['type' => 'number']);

  $args = array(
    'rewrite' => array( 'slug' => 'zaly_i_instructory'),
  );
  $location = new Taxonomy('Регион', 'Регионы', 'locations', 'm', $args);
  $location->posttype('venues');
  $location->register();

  $locationImage = new TaxonomyImage('locations', 'location-image', 'Изображение региона');

  add_filter( 'template_include', function($template) {
    return is_tax('locations') ? get_query_template( 'archive-venues' ) : $template;
  });