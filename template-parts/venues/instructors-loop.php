<?php
$args = array(  
  'post_type' => 'instructors',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  // 'orderby' => 'title',
  // 'order' => 'ASC',
);

$loop = new WP_Query( $args );  
$authors_to_show = [];
if($loop->have_posts()) : ?>

  <h5 class="text-light bg-primary text-uppercase p-2 mt-3 mb-0 text-center">Инструкторы</h5>
  <div class="row no-gutters">

    <?php while ( $loop->have_posts() ) : $loop->the_post();
      $author_ID = get_the_ID();
      $venues_meta = get_post_meta($author_ID, 'venueIds', true);
      $author_venues = json_decode($venues_meta);

      if( !empty($author_venues) && !empty($ids) && array_intersect($ids, $author_venues) ) :
        $authors_to_show[] = $author_ID;
        $blocks = parse_blocks( get_the_content() );
        foreach ( $blocks as $block ) :
          if ( 'bayder-school/bio' === $block['blockName'] ) :?>

            <div class="col-12 col-lg-6 my-2 px-lg-2">
              <div class="card">
                <h5 class="card-header font-weight-bold">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h5>
                <div class="card-body">
                  <div class="card-text">
                    <?php echo $block['innerHTML']; ?>
                  </div>
                </div>
              </div>
            </div>
            
          <?php break;
          endif;
        endforeach;
      endif;
    endwhile;?>
  </div>
<?php endif;?>
