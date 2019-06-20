<?php 
  function bs_customize_register($wp_customize){
    // Contact Section
    $wp_customize->add_section('contacts', array(
      'title' => 'Контакты в шапке',
      'description' => 'Настройка контактной иформации в шапке сайта',
      'priority' => 130
    ));
    // Title field
    $wp_customize->add_setting('contacts_title', array(
      'default' => 'Контакты',
      'type' => 'theme_mod'
    ));
    $wp_customize->add_control('contacts_title', array(
      'label' => 'Заголовок',
      'section' => 'contacts',
      'priority' => 1
    ));
    // Phone Field
    $wp_customize->add_setting('contacts_phone', array(
      'default' => '+7 (000) 000-00-00',
      'type' => 'theme_mod'
    ));
    $wp_customize->add_control('contacts_phone', array(
      'label' => 'Телефон',
      'section' => 'contacts',
      'priority' => 2
    ));
    // Address Field
    $wp_customize->add_setting('contacts_address', array(
      'default' => '',
      'type' => 'theme_mod'
    ));
    $wp_customize->add_control('contacts_address', array(
      'label' => 'Адрес',
      'section' => 'contacts',
      'priority' => 3
    ));
    // Address Link Url
    $wp_customize->add_setting('contacts_address_link', array(
      'default' => '',
      'type' => 'theme_mod'
    ));
    $wp_customize->add_control('contacts_address_link', array(
      'label' => 'Адрес ссылается на страницу',
      'section' => 'contacts',
      'priority' => 4
    ));
    // Login button checkbox
    $wp_customize->add_setting('contacts_enter_checkbox', array(
      'default' => true,
      'type' => 'theme_mod'
    ));
    $wp_customize->add_control('contacts_enter_checkbox', array(
      'label' => 'Отображать кнопку "Войти"',
      'section' => 'contacts',
      'type' => 'checkbox',
      'priority' => 5
    ));
  }

  add_action( 'customize_register', 'bs_customize_register');