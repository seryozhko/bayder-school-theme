<?php	get_header(); ?>
  archive
  <h5 class="text-light bg-primary text-uppercase p-2 text-center">
    <?php 
      // echo post_type_archive_title( '', false );
      the_archive_title();
    ?>
  </h5>
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

<?php get_footer();
