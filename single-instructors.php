<?php	
get_header();

the_breadcrumb();

while(have_posts()) : the_post(); ?>
  <article>
    <h5 class="text-light bg-primary text-uppercase p-2"><?php the_title(); ?></h5>
    
    <?php
      the_content();
      $author = get_the_author_ID();
    ?>
  </article>
<?php
endwhile;?>

<h5 class="text-light bg-primary text-uppercase p-2">Статьи</h5>

<?php
$loop = new WP_Query([
  'post_type' => 'post',
  'post_stattus' => 'publish',
  'author' => $author,
  'posts_per_page' => -1,
]);
  
if($loop->have_posts()) : ?>
  <?php while($loop->have_posts()) : $loop->the_post(); ?>
    <article>
      <h2>
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </h2>
      <p>
        <?php the_time('F j, Y G:i'); ?>
      </p>
      <?php the_excerpt(); ?>
    </article>
  <?php endwhile; ?>
<?php else : ?>
  <p><?php echo 'Нет Статей'?></p>
<?php endif;

get_footer();
