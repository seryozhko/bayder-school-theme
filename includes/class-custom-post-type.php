<?php
namespace PostTypes;

class TaxonomyImage
{
  public $taxonomy;
  public $name;
  public $title;

  public function __construct($taxonomy = 'category', $name = 'category-image', $title = 'Изображение')
  {
    $this->taxonomy = $taxonomy;
    $this->name = $name;
    $this->title = $title;

    add_action( "{$this->taxonomy}_add_form_fields", array ( &$this, 'add_image_form' ), 10, 2 );
    add_action( "{$this->taxonomy}_edit_form_fields", array ( &$this, 'update_image_form' ), 10, 2 );

    add_action( "created_{$this->taxonomy}", array ( &$this, 'save_image_to_meta' ), 10, 2 );
    add_action( "edited_{$this->taxonomy}", array ( &$this, 'update_image_in_meta' ), 10, 2 );

    add_action( 'admin_enqueue_scripts', array( &$this, 'load_media' ) );
    add_action( 'admin_footer', array( &$this, 'add_script' ) );
  }

  public function load_media()
  {
    wp_enqueue_media();
    wp_register_script('media-uploader', get_bloginfo('template_url').'/js/admin-media-upload.js', array('jquery'));
    wp_enqueue_script('media-uploader');
  }

  public function add_image_form($taxonomy)
  { ?>
    <div class="form-field term-group">
      <label for="<?php echo $this->name; ?>-id"><?php echo $this->title; ?></label>
      <input type="hidden" id="<?php echo $this->name; ?>-id" name="<?php echo $this->name; ?>-id" class="custom_media_url" value="">
      <div id="<?php echo $this->name; ?>-wrapper"></div>
      <p>
        <input type="button" class="button button-secondary ct_tax_media_button" id="<?php echo $this->name; ?>_media_add" name="<?php echo $this->name; ?>_media_add" value="Добавить изображение" />
        <input type="button" class="button button-secondary ct_tax_media_remove" id="<?php echo $this->name; ?>_media_remove" name="<?php echo $this->name; ?>_media_remove" value="Удалить изображение" />
      </p>
    </div>
  <?php
  }

  public function update_image_form ( $term, $taxonomy )
  {
    $image_id = get_term_meta ( $term->term_id, "{$this->name}-id", true ); ?>
    <tr class="form-field term-group-wrap">
    <th scope="row">
      <label for="<?php echo $this->name; ?>-id"><?php echo $this->title; ?></label>
    </th>
    <td>
      <input type="hidden" id="<?php echo $this->name; ?>-id" name="<?php echo $this->name; ?>-id" value="<?php echo $image_id; ?>">
      <div id="<?php echo $this->name; ?>-wrapper">
        <?php echo $image_id ? wp_get_attachment_image ( $image_id, 'thumbnail' ) : '' ?>
      </div>
      <p>
        <input type="button" class="button button-secondary ct_tax_media_button" id="<?php echo $this->name; ?>_media_add" name="<?php echo $this->name; ?>_media_add" value="Добавить изображение" />
        <input type="button" class="button button-secondary ct_tax_media_remove" id="<?php echo $this->name; ?>_media_remove" name="<?php echo $this->name; ?>_media_remove" value="Удалить изображение" />
      </p>
    </td>
    </tr>
  <?php
  }

  public function save_image_to_meta($term_id, $tt_id)
  {
    (isset($_POST["{$this->name}-id"]) && '' !== $_POST["{$this->name}-id"]) ? add_term_meta($term_id, "{$this->name}-id", $_POST["{$this->name}-id"], true) : null;
  }

  public function update_image_in_meta($term_id, $tt_id)
  {
    $image = (isset( $_POST["{$this->name}-id"] ) && '' !== $_POST["{$this->name}-id"]) ? $_POST["{$this->name}-id"] : '';
    update_term_meta( $term_id, "{$this->name}-id", $image );
  }

  public function add_script()
  { ?>
    <script>jQuery(($) => init_custom_media("<?php echo $this->name; ?>", "<?php echo $this->title; ?>"));</script>
  <?php
  }
}

class Taxonomy
{
    public $name;
    public $singular;
    public $plural;
    public $slug;
    public $sex;
    public $options;
    public $labels;
    public $posttypes = [];
    public $columns;

    /**
     * Create a Taxonomy
     * @param mixed $names The name(s) for the Taxonomy
     */
    public function __construct($singular, $plural, $slug, $sex = 'f', $options = [], $labels = [])
    {
        $this->sex = $sex;
        $this->slug = $slug;
        $this->name = strtolower(str_replace(['-', '_'], ' ', $slug));
        $this->singular = $singular;
        $this->plural = $plural;
        $this->options = $options;
        $this->labels = $labels;
    }
    /**
     * Assign a PostType to register the Taxonomy to
     * @param  string $posttype
     * @return $this
     */
    public function posttype($posttype)
    {
        $this->posttypes[] = $posttype;
        return $this;
    }
    /**
     * Get the Column Manager for the Taxonomy
     * @return Columns
     */
    public function columns()
    {
        if (!isset($this->columns)) {
            $this->columns = new Columns;
        }
        return $this->columns;
    }
    /**
     * Register the Taxonomy to WordPress
     * @return void
     */
    public function register()
    {
        // register the taxonomy, set priority to 9
        // so taxonomies are registered before PostTypes
        add_action('init', [&$this, 'registerTaxonomy'], 9);
        // assign taxonomy to post type objects
        add_action('init', [&$this, 'registerTaxonomyToObjects']);
        if (isset($this->columns)) {
            // modify the columns for the Taxonomy
            add_filter("manage_edit-{$this->name}_columns", [&$this, 'modifyColumns']);
            // populate the columns for the Taxonomy
            add_filter("manage_{$this->name}_custom_column", [&$this, 'populateColumns'], 10, 3);
            // set custom sortable columns
            add_filter("manage_edit-{$this->name}_sortable_columns", [&$this, 'setSortableColumns']);
            // run action that sorts columns on request
            add_action('parse_term_query', [&$this, 'sortSortableColumns']);
        }
    }
    /**
     * Register the Taxonomy to WordPress
     * @return void
     */
    public function registerTaxonomy()
    {
        if (!taxonomy_exists($this->name)) {
            // create options for the Taxonomy
            $options = $this->createOptions();
            // register the Taxonomy with WordPress
            register_taxonomy($this->name, null, $options);
        }
    }
    /**
     * Register the Taxonomy to PostTypes
     * @return void
     */
    public function registerTaxonomyToObjects()
    {
        // register Taxonomy to each of the PostTypes assigned
        if (!empty($this->posttypes)) {
            foreach ($this->posttypes as $posttype) {
                register_taxonomy_for_object_type($this->name, $posttype);
            }
        }
    }
    /**
     * Create options for Taxonomy
     * @return array Options to pass to register_taxonomy
     */
    public function createOptions()
    {
        // default options
        $options = [
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'rewrite' => [
                'slug' => $this->slug,
            ],
        ];
        // replace defaults with the options passed
        $options = array_replace_recursive($options, $this->options);
        // create and set labels
        if (!isset($options['labels'])) {
            $options['labels'] = $this->createLabels();
        }
        return $options;
    }
    /**
     * Create labels for the Taxonomy
     * @return array
     */
    public function createLabels()
    {
        $new = $this->sex == 'f' ? 'новую' : 'новый';
        $parent = $this->sex == 'f' ? 'Родительская' : 'Родительский';
        // default labels
        $labels = [
            'name' => $this->plural,
            'singular_name' => $this->singular,
            'menu_name' => $this->plural,
            'all_items' => "Все {$this->plural}",
            'edit_item' => "Изменить {$this->singular}",
            'view_item' => "Отобразить {$this->singular}",
            'update_item' => "Обновить {$this->singular}",
            'add_new_item' => "Добавить {$new} {$this->singular}",
            'new_item_name' => "Название",
            'parent_item' => "{$parent} {$this->singular}",
            'parent_item_colon' => "{$parent} {$this->singular}:",
            'search_items' => "Найти {$this->plural}",
            'popular_items' => "Популярные {$this->plural}",
            'separate_items_with_commas' => "Разделите {$this->plural} запятыми",
            'add_or_remove_items' => "Добавить или удалить {$this->plural}",
            'choose_from_most_used' => "Выбрать из наиболее используемых {$this->plural}",
            'not_found' => "{$this->plural} не найдены",
        ];
        return array_replace($labels, $this->labels);
    }
    /**
     * Modify the columns for the Taxonomy
     * @param  array  $columns  The WordPress default columns
     * @return array
     */
    public function modifyColumns($columns)
    {
        $columns = $this->columns->modifyColumns($columns);
        return $columns;
    }
    /**
     * Populate custom columns for the Taxonomy
     * @param  string $content
     * @param  string $column
     * @param  int    $term_id
     */
    public function populateColumns($content, $column, $term_id)
    {
        if (isset($this->columns->populate[$column])) {
            $content = call_user_func_array($this->columns()->populate[$column], [$content, $column, $term_id]);
        }
        return $content;
    }
    /**
     * Make custom columns sortable
     * @param array $columns Default WordPress sortable columns
     */
    public function setSortableColumns($columns)
    {
        if (!empty($this->columns()->sortable)) {
            $columns = array_merge($columns, $this->columns()->sortable);
        }
        return $columns;
    }
    /**
     * Set query to sort custom columns
     * @param WP_Term_Query $query
     */
    public function sortSortableColumns($query)
    {
        // don't modify the query if we're not in the post type admin
        if (!is_admin() || !in_array($this->name, $query->query_vars['taxonomy'])) {
            return;
        }
        // check the orderby is a custom ordering
        if (isset($_GET['orderby']) && array_key_exists($_GET['orderby'], $this->columns()->sortable)) {
            // get the custom sorting options
            $meta = $this->columns()->sortable[$_GET['orderby']];
            // check ordering is not numeric
            if (is_string($meta)) {
                $meta_key = $meta;
                $orderby = 'meta_value';
            } else {
                $meta_key = $meta[0];
                $orderby = 'meta_value_num';
            }
            // set the sort order
            $query->query_vars['orderby'] = $orderby;
            $query->query_vars['meta_key'] = $meta_key;
        }
    }
}

class PostType
{
    public $post_type_singular;
    public $post_type_plural;
    public $post_type_slug;
    public $post_type_args;
    public $post_type_labels;

    /* Class constructor */
    public function __construct( $singular, $plural, $slug, $sex = 'f', $args = array(), $labels = array() )
    {
      // Set some important variables
      $this->post_type_singular = ucwords( $singular );
      $this->post_type_plural = ucwords( $plural );
      $this->post_type_slug = strtolower( str_replace( ' ', '_', $slug ) );
      $this->post_type_args = $args;
      $this->post_type_labels = $labels;

      // Add action to register the post type, if the post type does not already exist
      if( ! post_type_exists( $this->post_type_slug ) ) {
        add_action( 'init', array( &$this, 'register_post_type' ) );
      }

      // Listen for the save post hook
      $this->save();
    }

    /* Method which registers the post type */
    public function register_post_type()
    {
      $new = $this->post_type_sex == 'f' ? 'новую' : 'новый';
      $parent = $this->post_type_sex == 'f' ? 'Родительская' : 'Родительский';

      // We set the default labels based on the post type name and plural. We overwrite them with the given labels.
      $labels = array_merge(
        // Default
        array(
          'name'               => $this->post_type_plural,
          'singular_name'      => $this->post_type_singular ,
          'add_new'            => "Добавить {$new}",
          'add_new_item'       => "Добавить {$new} {$this->post_type_singular }",
          'new_item'           => "{$new} {$this->post_type_singular }",
          'edit_item'          => "Изменить {$this->post_type_singular }",
          'view_item'          => "Просмотреть {$this->post_type_singular }",
          'all_items'          => "Все {$this->post_type_plural}",
          'search_items'       => "Искать {$this->post_type_plural}",
          'parent_item_colon'  => "{$parent} {$this->post_type_singular}",
          'not_found'          => "{$this->post_type_plural} не найдены",
          'not_found_in_trash' => "{$this->post_type_plural} не найдены"
        ),
        // Given labels
        $this->post_type_labels
      );

      // Same principle as the labels. We set some defaults and overwrite them with the given arguments.
      $args = array_merge(
        // Default
        array(
          'label' => $this->post_type_plural,
          'labels' => $labels,
          'public' => true,
          'publicly_queryable' => true,
          'show_in_menu'       => true,
          'show_ui' => true,
          'show_in_rest' => true,
          'supports' => array( 'title', 'editor' ),
          'show_in_nav_menus' => true,
          'menu_position'      => null,
          'query_var'          => true,
          'has_archive' => true,
          'rewrite'            => array( 'slug' => $this->post_type_slug ),
          '_builtin' => false,
        ),
        // Given args
        $this->post_type_args
      );

      // Register the post type
      register_post_type( $this->post_type_slug, $args );
    }

    /* Method to attach the taxonomy to the post type */
    public function add_taxonomy()
    {

    }

    /* Attaches meta boxes to the post type */
    public function add_meta($meta_name, $meta_args = [])
    {
      if( !empty($meta_name) ){
        $args = array_merge(
          [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string'
          ], 
          $meta_args
        );
        $post_type = $this->post_type_slug;

        add_action( 'init', function() use( $post_type, $meta_name, $args ){
          register_post_meta($post_type, $meta_name, $args);
        });
      }
    }

    /* Listens for when the post type being saved */
    public function save()
    {

    }
}
?>