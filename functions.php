<?php
  //Register Nav Walker class_alias
  require_once('class-wp-bootstrap-navwalker.php');

  //Theme Support
  function bs_theme_setup(){
    //Nav Menus
    register_nav_menus(array(
      'primary' => 'Главное Меню'
    ));
  }

  add_action('after_setup_theme', 'bs_theme_setup');