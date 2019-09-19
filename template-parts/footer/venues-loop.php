<?php
$args = array(  
  'post_type' => 'venues',
  'post_status' => 'publish',
  'posts_per_page' => -1,
);

$loop = new WP_Query( $args );
  
if($loop->have_posts()) :
  while($loop->have_posts()) : $loop->the_post();
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
  <h5 class="text-uppercase bg-primary text-white p-2 mt-3">Залы Федерации</h5>
  <div class="ymap-block" point="<?php echo implode(",", $points); ?>" center="[55.75, 37.57]" zoom="16">
    <?php get_template_part( 'template-parts/venues/map', 'submenu' ); ?>
  </div>
<?php endif;

wp_reset_postdata();
