<?php
  // Register Nav Walker class_alias
  require_once('class-wp-bootstrap-navwalker.php');

  // Theme Support
  function bs_theme_setup(){
    add_theme_support('post-thumbnails');
    // Nav Menus
    register_nav_menus(array(
      'primary' => 'Главное Меню'
    ));
  }

  add_action('after_setup_theme', 'bs_theme_setup');

  // Excerpt Length control
  function bs_set_excerpt_length(){
    return 50;
  }

  add_filter('excerpt_length', 'bs_set_excerpt_length');

  // Widget Locations
  function bs_init_widgets($id){
    register_sidebar(array(
      'name' => 'Панель спарва',
      'id' => 'sidebar',
      'before_widget' => '<div class="card mb-2"><div class="card-body p-0">',
      'after_widget' => '</div></div></div>',
      'before_title' => '<h5 class="card-title p-2 text-light bg-primary">',
      'after_title' => '</h5><div class="card-text">',
    ));
  }

  add_action('widgets_init', 'bs_init_widgets');

  // function bs_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
  //   if ( 'post-thumbnail' === $size ) {
  //     is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
  //     ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
  //   }
  //   return $attr;
  // }
  // add_filter( 'wp_get_attachment_image_attributes', 'bs_post_thumbnail_sizes_attr', 10 , 3 );
  
  // function bs_content_image_sizes_attr( $sizes, $size ) {
  //   $width = $size[0];
  //   840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
  //   if ( 'page' === get_post_type() ) {
  //     840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  //   } else {
  //     840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
  //     600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  //   }
  //   return $sizes;
  // }
  // add_filter( 'wp_calculate_image_sizes', 'bs_content_image_sizes_attr', 10 , 2 );