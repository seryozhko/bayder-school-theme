<?php
  add_filter('xmlrpc_enabled', '__return_false');
  // Register Nav Walker class_alias
  require_once( get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php' );
  require_once( get_template_directory() . '/includes/class-custom-post-type.php' );

  // Theme Support
  function bs_theme_setup(){
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    // add_theme_support('wp-block-styles');
    // add_theme_support( 'custom-logo' );
    add_editor_style( 'css/style-editor.css' );
    add_image_size( 'profileThumb', 160, 236, true );

    register_nav_menus(array(
      'primary' => 'Главное Меню'
    ));
  }
  add_action('after_setup_theme', 'bs_theme_setup');

  // Make custom sizes selectable from WordPress admin.
  function custom_image_sizes( $size_names ) {
    $new_sizes = array(
      'profileThumb' => 'Фото для профиля',
    );
    return array_merge( $size_names, $new_sizes );
  }
  add_filter( 'image_size_names_choose', 'custom_image_sizes' );

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
      'before_widget' => '<div class="card mb-2 border-0"><div class="card-body p-0">',
      'after_widget' => '</div></div></div>',
      'before_title' => '<h5 class="card-title p-2 text-light bg-primary text-uppercase">',
      'after_title' => '</h5><div class="card-text">',
    ));
    register_sidebar(array(
      'name' => 'Верхняя панель на главной',
      'id' => 'hero-section',
      'before_widget' => '<div class="row no-gutters">',
      'after_widget' => '</div>',
    ));
  }
  add_action('widgets_init', 'bs_init_widgets');

  require get_template_directory() . '/includes/customizer.php';
  require get_template_directory() . '/includes/venues-post-type.php';
  require get_template_directory() . '/includes/instructors-post-type.php';
  flush_rewrite_rules();

  function my_user_field($user){
    echo "<a href class='button button-primary'>Редактировать публичный профиль</a>";
  }

  add_action( 'show_user_profile', 'my_user_field' );
  add_action( 'edit_user_profile', 'my_user_field' );

  function myplugin_registration_save( $userId ) {
    $user = get_userdata( $userId );

    if(!$userId > 0 || $user->roles[0] !== 'author') return;

    $post = array(
      'post_title' => $user->last_name . " ". $user->first_name,
      'post_status' => 'publish',
      'post_author' => $userId,
      'post_type' => 'instructors',
      'post_name' => $user->user_nicename,
    );

    $postId = wp_insert_post( $post );

    if($postId) {
      update_user_meta($userId, 'profile_page_id', $postId);
    }
  }
  add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

  function my_delete_user( $userId ) {
    $postId = get_user_meta($userId,  'profile_page_id', true );
    if ( $postId !== '' )
      wp_delete_post( $postId, true );
  }
  add_action( 'delete_user', 'my_delete_user' );

  function jr3_enqueue_gutenberg() {
    wp_register_style( 'bootstrap-gutenberg', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap-gutenberg' );

    wp_register_script( 'bootstrapjs-gutenberg','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), false, true );
    wp_enqueue_script( 'bootstrapjs-gutenberg' );
  }
  // add_action( 'enqueue_block_editor_assets', 'jr3_enqueue_gutenberg' );
 
  // add external link to Tools area
  // function blocks_admin_menu() {
  //   global $submenu;
  //   $url = '/wp-admin/edit.php?post_type=wp_block';
  //   $submenu['tools.php'][] = array('Мои блоки', 'manage_options', $url);
  // }
  // add_action('admin_menu', 'blocks_admin_menu');

  // $args = array(
  //   'menu_icon' => 'dashicons-admin-users',
  //   'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'custom-fields', 'page-attributes')
  // );
  // $instructor = new Custom_Post_Type( 'Инструктор', 'Инструкторы', 'instructor', 'm', $args );

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