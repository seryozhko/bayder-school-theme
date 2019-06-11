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
  <header>
	
    <div class="container d-flex justify-content-between py-2 px-1">
    
		  <div class="col-auto text-center px-0">
        <a href="/">
          <img src="src/assets/logo.png" class="logo" alt="">
          <h5 class="d-sm-inline-block align-middle ml-1 mb-0">Школа Байдера</h5>
        </a>
      </div>

      <div class="col-auto text-right px-0">
        <h6 class="text-uppercase px-1">федерация айкидо</h6>

        <div class="row justify-content-around no-gutters">
          <a href="" class="px-sm-2">
            <button class="btn btn-primary btn-sm p-1" type="button">
              <i class="material-icons align-top md-21">phone</i>
            </button><span class="d-none d-md-inline-block ml-1">+7 (495) 211 66 44</span>
          </a>
          <a href="" class="px-sm-2">
            <button class="btn btn-danger btn-sm p-1 text-white" type="button">
              <i class="material-icons align-top md-21">place</i>
            </button><span class="ml-1 d-none d-lg-inline-block">ул. Вятская, дом 27, корпус 12</span>
          </a>
          <a class="px-sm-2">
            <button class="btn btn-primary btn-sm p-1" type="button">
              <span class="d-none d-sm-inline">Войти</span> <i class="material-icons align-top md-21">account_circle</i>
            </button>
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
						<button class="btn btn-grey px-1" type="submit"><i class="material-icons align-top">search</i></button>
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