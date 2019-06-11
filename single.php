<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage bayder-school
 * @since 1.0.0
 */
	get_header();
?>
    <div class="container px-0">
      <div class="row no-gutters">
        <div class="col-12 col-md-3 pt-2 pl-md-2 order-md-last">
          <div class="card">
              <div class="card-body p-0">
                <h5 class="card-title p-1 text-light bg-primary">ПРЕТЕНДЕНТАМ</h5>
                <div class="card-text">

                </div>
              </div>
          </div>
        </div>
        <div class="col-12 col-md-9 pt-2 order-md-first">
          <div>
            <?php if(have_posts()) : ?>
              <?php while(have_posts()) : the_post(); ?>
                <div>
                  <h2><?php the_title(); ?></h2>
                  <p>
                    <?php the_time('F j, Y G:i'); ?> автор
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                      <?php the_author(); ?>
                    </a>
                  </p>
                  <?php if(has_post_thumbnail()): ?>
                    <div>
                      <?php the_post_thumbnail('medium_large', array('class' => 'w-100 h-auto')); ?>
                    </div>
                  <?php endif; ?>
                  <?php the_content(); ?>
                  <hr>
                  <?php comments_template(); ?>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <p><?php echo 'Нет Статей'?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>

  </main>

<?php get_footer();
