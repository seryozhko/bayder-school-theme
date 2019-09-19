<?php get_header(); ?>

<h5 class="text-light bg-primary text-uppercase p-2 text-center">
  <?php the_archive_title();?>
</h5>

<?php if(have_posts()) :
  while(have_posts()) : the_post();
    $ids[] = get_the_ID();
    $blocks = parse_blocks( get_the_content() );
    foreach ( $blocks as $block ) {
      if ( 'bayder-school/map' === $block['blockName'] ) {
        $points[] = $block["attrs"]["point"];
        break;
      }
    }
  endwhile;
endif;

if($points): ?>
  <div class="ymap-block" point="<?php echo implode(",", $points); ?>" center="[55.75, 37.57]" zoom="16">
    <?php get_template_part( 'template-parts/venues/map', 'submenu' ); ?>
  </div>
<?php endif;

set_query_var( 'ids', $ids );
get_template_part( 'template-parts/venues/instructors', 'loop' ); 

wp_reset_postdata();
get_footer();
