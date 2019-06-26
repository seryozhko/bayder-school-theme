<?php if(is_front_page() && is_active_sidebar('hero-section')) : ?> 
  <section class="container text-center px-0">
    <div class="row no-gutters">
      <div class="col-md-9">
        <img src="<?php bloginfo('template_url'); ?>/assets/slide1.jpg" alt="" class="w-100">
      </div>

      <div class="col-md-3 pl-md-2 py-1 py-md-0">
      
        <div class="row no-gutters h-100 align-items-center">
          <div class="col col-md-12">
            <img src="<?php bloginfo('template_url'); ?>/assets/banner1.jpg" alt="" class="w-100">
          </div>
          <div class="col col-md-12 px-1 px-md-0">
              <img src="<?php bloginfo('template_url'); ?>/assets/banner2.jpg" alt="" class="w-100">
          </div>
          <div class="col col-md-12">
              <img src="<?php bloginfo('template_url'); ?>/assets/banner3.jpg" alt="" class="w-100">
          </div>
        </div>

      </div>
    </div>
    <?php dynamic_sidebar('hero-section'); ?>
    <!-- <div class="row no-gutters">
      <div class="col text-light bg-dark my-md-2">
        <p class="p-2">Айкидо - одно из самых молодых боевых искусств, максимально отвечающее потребностям сегодняшнего дня. Для изучения этого боевого искусства не надо какой-либо начальной подготовки. Эта школа доступна к практике в любом возрасте. Как правило, айкидо практикуется на протяжении всей жизни, что дает возможность поддерживать высокий уровень здоровья и внутреннего комфорта все годы занятий.</p>
      </div>
    </div> -->
  </section>
<? endif; ?>