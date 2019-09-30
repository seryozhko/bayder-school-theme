<?php	
get_header();

while(have_posts()) : the_post(); ?>
  <article>
    <h5 class="text-light bg-primary text-uppercase p-2 text-center"><?php the_title(); ?></h5>
    
    <?php
      the_content();
      $author = get_the_author_ID();
    ?>
  </article>
<?php
endwhile;

$loop = new WP_Query([
  'post_type' => 'post',
  'post_stattus' => 'publish',
  'author' => $author,
  'posts_per_page' => -1,
]);
  
if($loop->have_posts()) : ?>
  <h5 class="text-light bg-primary text-uppercase p-2">Статьи</h5>
  <?php while($loop->have_posts()) : $loop->the_post(); ?>
    <article>
      <h2>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h2>
      <p class="px-2">
        <svg xmlns="http://www.w3.org/2000/svg" style="fill:#dc3545;" class="mb-1" width="16" height="16" viewBox="0 0 24 24"><path d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
        <?php the_time('F j, Y'); ?>
      </p>
      <div class="px-1">
        <?php the_excerpt(); ?>
      </div>
    </article>
  <?php endwhile;
endif;

wp_reset_postdata();
get_footer();
