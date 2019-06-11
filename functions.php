<?php
  //Register Nav Walker class_alias
  require_once('class-wp-bootstrap-navwalker.php');

  //Theme Support
  function bs_theme_setup(){
    add_theme_support('post-thumbnails');
    //Nav Menus
    register_nav_menus(array(
      'primary' => 'Главное Меню'
    ));
  }

  add_action('after_setup_theme', 'bs_theme_setup');

  //Excerpt Length control
  function bs_set_excerpt_length(){
    return 50;
  }

  add_filter('excerpt_length', 'bs_set_excerpt_length');

  function bs_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( 'post-thumbnail' === $size ) {
      is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
      ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
  }
  add_filter( 'wp_get_attachment_image_attributes', 'bs_post_thumbnail_sizes_attr', 10 , 3 );
  