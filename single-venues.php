<?php	get_header(); ?>

    <?php while(have_posts()) : the_post(); ?>
      <article>
        <h5 class="text-light bg-primary text-uppercase p-2 text-center"><?php the_title(); ?></h5>
        <?php 
          the_content();
          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }
        ?>
      </article>
    <?php endwhile; ?>

<?php get_footer();
