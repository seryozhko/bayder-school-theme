<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?php bloginfo('description'); ?>">
  <title>
		<?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(); ?>
	</title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body>
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
          <!-- <a href="" class="px-sm-2">
            <button class="btn btn-light btn-sm p-1" type="button">
              <i class="material-icons align-top md-21">search</i>
            </button>
          </a>-->
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

				<div class="collapse navbar-collapse flex-nowrap" id="navbarCollapse">
					<ul class="navbar-nav text-center">
						<li class="nav-item active">
							<a class="nav-link" href="#">ГЛАВНАЯ<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">ЗАЛЫ И ИНСТРУКТОРЫ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">ЭКИПИРОВКА</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">КОНТАКТЫ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">НОВОСТИ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">СЕМИНАРЫ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">СТАТЬИ</a>
						</li>
					</ul>
				</div>          

			</div>
		</div>

	</header>

  <main role="main">
    <section class="container text-center px-0">
      <div class="row no-gutters">
        <div class="col-md-9">
          <img src="src/assets/slide1.jpg" alt="" class="w-100">
        </div>

        <div class="col-md-3 pl-md-2 py-1 py-md-0">
        
          <div class="row no-gutters h-100 align-items-center">
            <div class="col col-md-12">
              <img src="src/assets/banner1.jpg" alt="" class="w-100">
            </div>
            <div class="col col-md-12 px-1 px-md-0">
                <img src="src/assets/banner2.jpg" alt="" class="w-100">
            </div>
            <div class="col col-md-12">
                <img src="src/assets/banner3.jpg" alt="" class="w-100">
            </div>
          </div>

        </div>
      </div>
      <div class="row no-gutters py-md-2">
        <div class="col text-light bg-dark">
          <p class="p-2">Айкидо - одно из самых молодых боевых искусств, максимально отвечающее потребностям сегодняшнего дня. Для изучения этого боевого искусства не надо какой-либо начальной подготовки. Эта школа доступна к практике в любом возрасте. Как правило, айкидо практикуется на протяжении всей жизни, что дает возможность поддерживать высокий уровень здоровья и внутреннего комфорта все годы занятий.</p>
        </div>
      </div>
    </section>