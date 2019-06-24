<?php
function my_register_user_taxonomy() {

register_taxonomy(
 'profession',
 'user',
 array(
   'public' => true,
   'labels' => array(
     'name' => __( 'Professions' ),
     'singular_name' => __( 'Profession' ),
     'menu_name' => __( 'Professions' ),
     'search_items' => __( 'Search Professions' ),
     'popular_items' => __( 'Popular Professions' ),
     'all_items' => __( 'All Professions' ),
     'edit_item' => __( 'Edit Profession' ),
     'update_item' => __( 'Update Profession' ),
     'add_new_item' => __( 'Add New Profession' ),
     'new_item_name' => __( 'New Profession Name' ),
     'separate_items_with_commas' => __( 'Separate professions with commas' ),
     'add_or_remove_items' => __( 'Add or remove professions' ),
     'choose_from_most_used' => __( 'Choose from the most popular professions' ),
   ),
   'hierarchical' => true,
   'rewrite' => array(
     'with_front' => true,
     'slug' => 'author/profession' // Use 'author' (default WP user slug).
   ),
   'capabilities' => array(
     'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
     'edit_terms'   => 'edit_users',
     'delete_terms' => 'edit_users',
     'assign_terms' => 'read',
   ),
   'update_count_callback' => function() { return; } // Use a custom function to update the count.
 )
);
}

add_action( 'init', 'my_register_user_taxonomy' );

function my_update_profession_count( $previous_terms_ids, $new_terms_ids ) {
global $wpdb;
$terms_ids = array_unique( array_merge( (array)$previous_terms_ids, (array)$new_terms_ids ) );

if( count( $terms_ids ) < 1 ) { return; }

foreach ( $terms_ids as $term_id ) {
  $count = $wpdb->get_var(
    $wpdb->prepare(
      "SELECT COUNT(*) FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value LIKE %s",
      '_profession',
      '%"' . $term_id . '"%'
    )
  );
  $wpdb->update( $wpdb->term_taxonomy, array( 'count' => $count ), array( 'term_taxonomy_id' => $term_id ) );
}
}

add_action( 'admin_menu', 'my_add_profession_admin_page' );

function my_add_profession_admin_page() {
$tax = get_taxonomy( 'profession' );
add_users_page(
  esc_attr( $tax->labels->menu_name ),
  esc_attr( $tax->labels->menu_name ),
  $tax->cap->manage_terms,
  'edit-tags.php?taxonomy=' . $tax->name
);
}

add_filter( 'parent_file', 'fix_user_tax_page' );

function fix_user_tax_page( $parent_file = '' ){
global $pagenow;
if ( ! empty( $_GET[ 'taxonomy' ] ) && $_GET[ 'taxonomy' ] == 'profession' && $pagenow == 'edit-tags.php' ) {
  $parent_file = 'users.php';
}
return $parent_file;
}

add_action( 'show_user_profile', 'my_edit_user_profession_section' );
add_action( 'edit_user_profile', 'my_edit_user_profession_section' );

function my_edit_user_profession_section( $user ) {
if ( !current_user_can( 'edit_user', $user->ID ) )
  return false;
  
$terms = get_terms( 'profession',array(
  'taxonomy' => 'profession',
  'hide_empty' => 0,
  'orderby' => 'parent',
)); ?>

<table class="form-table">
  <tr>
    <th><label for="prefession">Profession</label></th>
    <td>
      <fieldset>
        <ul>
        <?php
          $form = wp_terms_checklist( $user->ID, array('taxonomy' => 'profession', 'echo' => false) );                        
          $meta_values = get_user_meta( $user->ID, '_profession', true );
          
          $line = preg_replace_callback(
            '|(<input value=")(\d+)(".*?>)|m',
            function ($matches) use ($meta_values) {
              $term_id = isset($matches[2]) ? (int)$matches[2] : NULL;
              $pad = str_repeat( '&#8212; ', count( get_ancestors( $term_id, 'profession', 'taxonomy' ) ) );
              return ( ( isset($term_id) && ( is_array( $meta_values ) && in_array( $term_id, $meta_values ) ) || $term_id == $meta_values ) ? '<input checked="checked" value="' . $term_id . $matches[3] : $matches[0] ) . $pad;
            },
            $form
          );
          echo $line;
          // foreach ( $terms as $term ) {    
          //   $pad = str_repeat( '&#8212; ', count( get_ancestors( $term->term_id, $term->taxonomy, 'taxonomy' ) ) );
          //   $checked = ( ( is_array( $meta_values ) && in_array( $term->term_id, $meta_values ) ) || $term->term_id == $meta_values ) ? " checked='checked'" : '';
          //   echo "<div class='form-field'><input type='checkbox' {$checked} value='{$term->term_id}' name='profession[]' id='profession-{$term->term_id}'><label for='profession-{$term->term_id}'>{$pad}{$term->name}</label></div>";
          // }					
        ?>
        </ul>
      </fieldset>
    </td>
  </tr>
</table>
<?php }

add_action( 'personal_options_update', 'my_save_user_profession_terms' );
add_action( 'edit_user_profile_update', 'my_save_user_profession_terms' );

function my_save_user_profession_terms( $user_id ) {
if ( !current_user_can( 'edit_user', $user_id ) )
  return false;

$new_categories_ids = $_POST["tax_input"]["profession"];

$user_meta = get_user_meta( $user_id, '_profession', true );
$previous_categories_ids = !empty( $user_meta ) ? (array)$user_meta : array();

update_user_meta( $user_id, '_profession', $new_categories_ids );
my_update_profession_count( $previous_categories_ids, $new_categories_ids );
}
