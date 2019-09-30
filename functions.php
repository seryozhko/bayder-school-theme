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

  function myplugin_registration_save( $userId ) {
    $user = get_userdata( $userId );

    if(!$userId > 0 || $user->roles[0] !== 'instructor') return;

    $post = array(
      'post_title' => $user->last_name . " ". $user->first_name,
      'post_content' => '<!-- wp:bayder-school/bio -->
        <div class="wp-block-bayder-school-bio media flex-wrap"><img src="http://placehold.it/160x236" class="align-self-center mx-auto mx-sm-0"/><div class="media-body flex-wrap ml-4"><div class="font-weight-bold text-nowrap"></div><div></div></div></div>
        <!-- /wp:bayder-school/bio -->
        
        <!-- wp:paragraph {"placeholder":"Биография"} -->
        <p></p>
        <!-- /wp:paragraph -->
        
        <!-- wp:bayder-school/schedule /-->',
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
  
  function link_to_profile($link, $author_id, $author_nicename) {
    $profile_id = get_user_meta( $author_id, 'profile_page_id', true );
    $link = $profile_id ? get_post_permalink( $profile_id ) : $link;
    return $link;
  }
  add_filter( 'author_link', 'link_to_profile', 10, 3 );

  function my_user_field($user){
    $profile_id = get_user_meta( $user->ID, 'profile_page_id', true );
    if( $profile_id ){
      $post_link = get_edit_post_link( $profile_id );
      // var_dump($post_link);
      echo "<a href='{$post_link}' class='button button-primary'>Редактировать публичный профиль</a>";
    }
  }
  add_action( 'show_user_profile', 'my_user_field' );
  add_action( 'edit_user_profile', 'my_user_field' );

  function hide_profile_fields() {
    $current_screen = get_current_screen();
    if($current_screen->id === "profile" && !in_array('administrator', wp_get_current_user()->roles)){

      function my_custom_admin_footer(){
        echo "<script>
          function hideBlock(selector, parentTag) {
            var parent = $(selector).closest(parentTag);
            parent.hide();
            parent.prev().hide();
          }
          hideBlock('.user-admin-color-wrap', 'table');
          hideBlock('.user-description-wrap', 'table');
          hideBlock('#url', 'td');
        </script>";
      }
      add_action( 'admin_footer', 'my_custom_admin_footer' );

    }    
  }
  add_action( 'current_screen', 'hide_profile_fields' );

  function my_remove_menu_pages() {
    global $user_ID;
    if ( current_user_can( 'instructor' ) ) {
      remove_menu_page( 'edit.php?post_type=instructors' );
      remove_menu_page( 'edit.php?post_type=venues' );
      remove_menu_page('upload.php');
      remove_menu_page('edit-comments.php');
      remove_menu_page('tools.php');
      remove_menu_page('gutenberg');
    }
  }
  add_action( 'admin_init', 'my_remove_menu_pages' );

  add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^.*?: (.*?)/s', '$1', $title);
  });