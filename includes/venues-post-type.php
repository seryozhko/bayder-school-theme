<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  $args = [
    'menu_icon' => 'dashicons-location',
    'has_archive' => 'zaly_i_instructory',
    'rewrite' => ['slug' => 'zaly_i_instructory/zal', 'with_front' => true],
    'supports' => ['title', 'editor', 'custom-fields', 'page-attributes'],
    'capability_type' => 'venue',
    'map_meta_cap' => true,
    'template' => [
      ['bayder-school/map', ['anchor' => 'map'] ],
    ],
    'template_lock' => 'all',
  ];
  $venues = new PostType('Зал', 'Залы', 'venues', 'm', $args, ['name' => 'Залы Федерации']);

  $venues->add_meta('point');
  $venues->add_meta('venueAddress');
  $venues->add_meta('baloonContent');
  $venues->add_meta('zoom', ['type' => 'number']);

  $args = [
    'rewrite' => [ 'slug' => 'zaly_i_instructory' ],
  ];
  $location = new Taxonomy('Регион', 'Регионы', 'locations', 'm', $args);
  $location->posttype('venues');
  $location->register();

  $locationImage = new TaxonomyImage('locations', 'location-image', 'Изображение региона');

  add_filter( 'template_include', function($template) {
    return is_tax('locations') ? get_query_template( 'archive-venues' ) : $template;
  });