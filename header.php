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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <h6 class="text-uppercase px-1">федерация айкидо</h6>

        <div class="row justify-content-around no-gutters">
          <a href="" class="px-sm-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-primary btn-sm p-0">
              <path d="M0 0h24v24H0z" fill="none"/><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg><span class="d-none align-middle d-md-inline-block ml-1">+7 (495) 211 66 44</span>
          </a>
          <a href="" class="px-sm-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-danger btn-sm p-0">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/>
            </svg><span class="ml-1 align-middle d-none d-lg-inline-block">ул. Вятская, дом 27, корпус 12</span>
          </a>
          <a href="/wp-admin" class="px-sm-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn btn-primary btn-sm p-0">
              <path d="M0 0h24v24H0z" fill="none"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
            </svg><span class="ml-1 align-middle d-none d-sm-inline">Войти</span>
          </a>
        </div>

      </div>
    </div>
    
		<div class="navbar navbar-expand-md navbar-light bg-light shadow-sm px-0">
			<div class="container d-flex justify-content-between">
				
				<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<form class="form-inline order-md-last">
					<div class="input-group">
						<input type="text" class="form-control d-inline-block d-md-none d-lg-inline-block" placeholder="Поиск..." aria-label="Поиск" aria-describedby="basic-addon2">
            <button class="btn btn-grey px-1" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            </button>
					</div>
				</form>
        
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

  <?php get_template_part( 'template-parts/header/hero', 'section' ); ?>
  
  <main role="main" class="container px-0">
    <div class="row no-gutters">
      <?php get_sidebar(); ?>
      <div class="col-12 pt-2 order-md-first <?php echo is_active_sidebar('sidebar') ? 'col-md-9' : ''; ?>">