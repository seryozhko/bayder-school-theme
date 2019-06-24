<?php
// http://justintadlock.com/archives/2011/10/20/custom-user-taxonomies-in-wordpress
// http://justintadlock.com/archives/2011/10/20/custom-user-taxonomies-in-wordpress#comment-568682
/* class to make it easy to add user taxonomies
 * Useage: 
 * $tax = new User_Taxonomy( array('taxonomy_name'=> 'profession', 'singular_label' => 'Profession', 'plural_label' => 'Professions') );
/*------------------------------------------------------------------------------------------------*/
class User_Taxonomy{
  
  var $taxonomy_name;
  var $params;
  
  public function __construct( $args ){
    
    $defaults = array(
  		'taxonomy_name' => null,
  		'singular_label' => null,
  		'plural_label' => null
  	);
  	$this->params = wp_parse_args( $args, $defaults );
  	
  	add_action( 'init', array(&$this, 'register_taxonomy') );
    add_action( 'admin_menu', array(&$this, 'add_admin_page') );
    add_filter( 'parent_file', array(&$this, 'fix_user_tax_page') );
    add_filter( 'manage_edit-'. $this->params['taxonomy_name'] .'_columns', array(&$this, 'manage_user_column') );
    add_action( 'manage_'. $this->params['taxonomy_name'] .'_custom_column', array(&$this, 'manage_column'), 10, 3 );
    
  }
  
  /**
   * Registers the taxonomy for users.  This is a taxonomy for the 'user' object type rather than a
   * post being the object type.
   */
  public function register_taxonomy(){    
  	 register_taxonomy(
  		$this->params['taxonomy_name'],
  		'user',
  		array(
  			'public' => true,
  			'labels' => array(
  				'name' => __( $this->params['plural_label'] ),
  				'singular_name' => __( $this->params['singular_label'] ),
  				'menu_name' => __( $this->params['plural_label'] ),
  				'search_items' => __( 'Search ' . $this->params['plural_label'] ),
  				'popular_items' => __( 'Popular ' . $this->params['plural_label'] ),
  				'all_items' => __( 'All ' . $this->params['plural_label'] ),
  				'edit_item' => __( 'Edit ' . $this->params['singular_label'] ),
  				'update_item' => __( 'Update ' . $this->params['singular_label'] ),
  				'add_new_item' => __( 'Add New ' . $this->params['singular_label'] ),
  				'new_item_name' => __( 'New '. $this->params['singular_label'] .' Name' ),
  				'separate_items_with_commas' => __( 'Separate '. $this->params['plural_label'] .' with commas' ),
  				'add_or_remove_items' => __( 'Add or remove ' . $this->params['plural_label'] ),
  				'choose_from_most_used' => __( 'Choose from the most popular ' . $this->params['plural_label'] ),
  			),
  			'capabilities' => array(
  				'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
  				'edit_terms'   => 'edit_users',
  				'delete_terms' => 'edit_users',
  				'assign_terms' => 'read',
  			),
  			'update_count_callback' => array(&$this, 'update_privilege_count') // Use a custom function to update the count.
  		)
  	);
  }
  
  /**
   * Function for updating the taxonomy count.  What this does is update the count of a specific term
   * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
   * We're just updating the count with no specifics for simplicity.
   *
   * See the _update_post_term_count() function in WordPress for more info.
   *
   * @param array $terms List of Term taxonomy IDs
   * @param object $taxonomy Current taxonomy object of terms
   */
  public function update_privilege_count( $terms, $taxonomy ){
    global $wpdb;
  	foreach ( (array) $terms as $term ) {
  		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );
  		do_action( 'edit_term_taxonomy', $term, $taxonomy );
  		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
  		do_action( 'edited_term_taxonomy', $term, $taxonomy );
  	}
  }
  
  /**
   * Creates the admin page for the taxonomy under the 'Users' menu.  It works the same as any
   * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When
   * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts'
   * instead of 'Users'.  We really need WP core support for this.
   */
  public function add_admin_page(){
    
    $tax = get_taxonomy( $this->params['taxonomy_name'] );
    
    add_users_page(
  		esc_attr( $tax->labels->menu_name ),
  		esc_attr( $tax->labels->menu_name ),
  		$tax->cap->manage_terms,
  		'edit-tags.php?taxonomy=' . $tax->name
  	);
  }
  
  /* fix taxonomy page so it highlights users instead of posts */
  public function fix_user_tax_page( $parent_file = '' ){
    global $pagenow;
  	if ( ! empty( $_GET[ 'taxonomy' ] ) && $_GET[ 'taxonomy' ] == $this->params['taxonomy_name'] && $pagenow == 'edit-tags.php' ) {
  		$parent_file = 'users.php';
  	}
  	return $parent_file;
  }
  
  /* Create custom columns for the manage taxonomy page. */
  public function manage_user_column( $columns ){
    unset( $columns['posts'] );
  	$columns['users'] = __( 'Users' );
  	return $columns;
  }
  /**
   * Customize the output of the custom column on the manage taxonomy page.
   * Displays content for custom columns on the manage professions page in the admin.
   *
   * @param string $display WP just passes an empty string here.
   * @param string $column The name of the custom column.
   * @param int $term_id The ID of the term being displayed in the table.
   */
  public function manage_column( $display, $column, $term_id ){
    if ( 'users' === $column ) {
  		$term = get_term( $term_id, $this->params['taxonomy_name'] );
  		echo $term->count;
  	}
  }
  
}
