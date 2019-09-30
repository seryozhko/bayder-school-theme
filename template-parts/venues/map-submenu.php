<?php
$terms = get_terms( [
  'taxonomy' => 'locations',
  'parent' => is_tax() ? get_queried_object()->term_id : 0,
]); 

if(count($terms)) :?>

  <div class="list-group p-1 d-none" style="position:absolute; z-index:99; overflow:auto">
    <?php 
    foreach($terms as $term) :
      $term_link = esc_url( get_term_link( $term ) );
      $image_link = wp_get_attachment_url( get_term_meta($term->term_id, 'location-image-id', true) );?>

      <a href="<?php echo $term_link; ?>" class="list-group-item list-group-item-action px-2 py-1">
        <img class="mr-2" style="width:30px" src="<?php echo $image_link; ?>">
        <?php echo $term->name; ?>
      </a>

    <?php
    endforeach;?>
  </div>
<?php

endif; ?>