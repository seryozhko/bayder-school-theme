<?php	get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <article>
      <h2><?php the_title(); ?></h2>
      <?php if(has_post_thumbnail()): ?>
        <div>
          <?php the_post_thumbnail('medium_large', array('class' => 'w-100 h-auto')); ?>
        </div>
      <?php endif; ?>
      <?php 
        the_content();
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }
      ?>
    </article>
  <?php endwhile; ?>

<?php get_footer();
