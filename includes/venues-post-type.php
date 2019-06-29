<?php
  use PostTypes\PostType;
  use PostTypes\Taxonomy;
  use PostTypes\TaxonomyImage;

  $args = array(
    'menu_icon' => 'dashicons-location',
    'has_archive' => 'zaly_i_instructory',
    'rewrite' => array( 'slug' => 'zaly_i_instructory/zal', 'with_front' => true ),
    'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes')
  );
  $venues = new PostType('Зал', 'Залы', 'venues', 'm', $args);

  $args = array(
    'rewrite' => array( 'slug' => 'zaly_i_instructory'),
  );
  $location = new Taxonomy('Регион', 'Регионы', 'locations', 'm', $args);
  $location->posttype('venues');
  $location->register();
    
  $locationImage = new TaxonomyImage('locations', 'location-image', 'Изображение региона');

  flush_rewrite_rules();