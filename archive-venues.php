<?php get_header(); ?>

<h5 class="text-light bg-primary text-uppercase p-2 text-center">
  <?php
    $description = term_description();
    if($description)
      echo preg_replace("#^<p>(.*?)</p>#ms", '$1', $description);      
    else
      the_archive_title();
  ?>
</h5>

<?php if(have_posts()) :
  while(have_posts()) : the_post();
    $ids[] = get_the_ID();
    $blocks = parse_blocks( get_the_content() );
    foreach ( $blocks as $block ) {
      if ( 'bayder-school/map' === $block['blockName'] ) {
        $points[] = [
          'baloonContent' => $block["attrs"]["baloonContent"],
          'location' => $block["attrs"]["point"],
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ];
        break;
      }
    };
  endwhile;
endif;

if($points): ?>
  <div class="ymap-block" center="[55.75, 37.57]" zoom="16">
    <?php get_template_part( 'template-parts/venues/map', 'submenu' );
    foreach($points as $point) :?>

      <div class="point d-none" title="<?php echo $point['title']; ?>" link="<?php echo $point['permalink']; ?>" location="<?php echo $point['location']; ?>">
        <div class='text-center'><?php echo $point['baloonContent']; ?></div>
      </div>

    <?php endforeach; ?>
  </div>
<?php endif;

set_query_var( 'ids', $ids );
get_template_part( 'template-parts/venues/instructors', 'loop' ); 

wp_reset_postdata();
get_footer();
