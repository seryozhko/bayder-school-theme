<?php	get_header(); ?>
  <h5 class="text-light bg-primary text-uppercase p-2 text-center">
    <?php the_archive_title();?>
  </h5>
  <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
      <article>
        <h2>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <p class="px-2">
          <svg xmlns="http://www.w3.org/2000/svg" style="fill:#dc3545;" class="mb-1" width="16" height="16" viewBox="0 0 24 24"><path d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
          <?php the_time('F j, Y'); ?> | Автор:
          <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
            <?php the_author(); ?>
          </a>
        </p>
        <?php if(has_post_thumbnail()): ?>
          <div>
            <?php the_post_thumbnail('medium_large', array('class' => 'w-100 h-auto')); ?>
          </div>
        <?php endif; ?>
        <div class="px-1">
          <?php the_excerpt(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php echo 'Нет Статей'?></p>
  <?php endif; ?>

<?php get_footer();
