<?php	get_header(); ?>

  <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
      <div>
        <h2><?php the_title(); ?></h2>
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

<?php get_footer();
