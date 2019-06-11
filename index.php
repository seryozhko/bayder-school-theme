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
  <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
      <article>
        <h2>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
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
        <?php the_excerpt(); ?>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php echo 'Нет Статей'?></p>
  <?php endif; ?>


  <div class="card border-0">
    <div class="card-body p-0">
      <h5 class="card-title p-2 text-light bg-primary">ВИДЕО О ШКОЛЕ</h5>
      <div class="card-text">

        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="false">
          <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>
          </ol>                  
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/e8w8WoBO2X8?controls=0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="carousel-item">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/qPqz0b6dF3M?controls=0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="carousel-item">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vNDFclffXm8?controls=0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
      </div>
    </div>
  </div>
        

<?php get_footer();
