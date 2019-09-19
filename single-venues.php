<?php	get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <article>
      <h5 class="text-light bg-primary text-uppercase p-2 text-center"><?php the_title(); ?></h5>
      <?php 
        the_content();     
        $venue_IDs[] = get_the_ID();
      ?>
    </article>
  <?php endwhile;

  set_query_var( 'ids', $venue_IDs );
  get_template_part( 'template-parts/venues/instructors', 'loop' );

  wp_reset_postdata();
  get_footer();
