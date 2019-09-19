<?php	get_header(); ?>
single
  <?php while(have_posts()) : the_post(); ?>
    <article>
      <h5 class="text-light bg-primary text-uppercase p-2"><?php the_title(); ?></h5>
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
      <?php
        // var_dump(json_decode(get_post_meta(get_the_ID(), 'venueIds', true)));
        the_content();
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }
      ?>
    </article>
  <?php endwhile; ?>

<?php get_footer();
