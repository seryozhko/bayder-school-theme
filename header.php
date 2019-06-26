<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?php bloginfo('description'); ?>">
  <title>
		<?php bloginfo('name'); ?> <?php is_front_page() ? bloginfo('description') : wp_title(); ?>
	</title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<?php wp_head(); ?>
</head>

<body>
  <?php wp_body_open(); ?>
  <header class="mb-2">
	
    <div class="container d-flex justify-content-between py-2 px-1">
    
		  <div class="col-auto text-center px-0">
        <a href="/">
          <img src="<?php bloginfo('template_url'); ?>/assets/logo.png" class="logo" alt=""><h5 class="d-sm-inline-block align-middle ml-1 mb-0">Школа Байдера</h5>
        </a>
      </div>

      <div class="col-auto text-right px-0">
        <h6 class="text-uppercase px-1">
          <?php echo get_theme_mod( 'contacts_title', 'Контакты' ); ?>
        </h6>

        <div class="row justify-content-around no-gutters">
          <?php if(get_theme_mod( 'contacts_phone', false )) : ?>
            <a href="tel:<?php echo preg_replace( '/[^0-9+]/', '', get_theme_mod( 'contacts_phone' ) ) ?>" class="px-sm-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-primary btn-sm p-0">
                <path d="M0 0h24v24H0z" fill="none"/><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
              </svg><span class="d-none align-middle d-md-inline-block ml-1">
                <?php echo get_theme_mod( 'contacts_phone', false ); ?>
              </span>
            </a>
          <?php endif; ?>
          <?php if(get_theme_mod( 'contacts_address', false )) : ?>
            <a <?php echo get_theme_mod( 'contacts_address_link', false ) ? 'href="' . get_theme_mod( 'contacts_address_link' ). '"' : ''; ?> class="px-sm-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-danger btn-sm p-0">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/>
              </svg><span class="ml-1 align-middle d-none d-lg-inline-block">
                <?php echo get_theme_mod( 'contacts_address' ); ?>
              </span>
            </a>
          <?php endif; ?>
          <?php if(get_theme_mod( 'contacts_enter_checkbox', true )) : ?>
            <a href="/wp-admin" class="px-sm-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-primary btn-sm p-0">
                <path d="M0 0h24v24H0z" fill="none"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
              </svg><span class="ml-1 align-middle d-sm-inline">Войти</span>
            </a>
          <?php endif; ?>
        </div>

      </div>
    </div>
    
		<div class="navbar navbar-expand-md navbar-light bg-light shadow-sm px-0">
			<div class="container d-flex justify-content-between">
				
				<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

        <?php get_search_form(); ?>
        
        <?php
          wp_nav_menu( array(
            'theme_location'  => 'primary',
            'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse flex-nowrap',
            'container_id'    => 'navbarCollapse',
            'menu_class'      => 'navbar-nav text-center',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
          ) );
        ?>

			</div>
		</div>

	</header>

  <?php //get_template_part( 'template-parts/header/hero', 'section' ); 
    get_sidebar('hero');
  ?>
  
  <main role="main" class="container px-0">
    <div class="row no-gutters">
      <?php get_sidebar(); ?>
      <div class="col-12 pt-2 order-md-first <?php echo is_active_sidebar('sidebar') ? 'col-md-9' : ''; ?>">