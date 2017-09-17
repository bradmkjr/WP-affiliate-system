<?php
defined('ABSPATH') or die("No script kiddies please!");

class WPASPosts
{

    /**
     * Start up
     */
    public function __construct()
    {
        
        add_action( 'init', array( $this, 'register_cpt_product' ) );
        add_action( 'init', array( $this, 'register_taxonomy_product_category' ) );
        add_action( 'admin_menu', array( $this, 'remove_meta_box' ), 100 );
    }
    
    /**
	* Remove the WooThemes metabox on new page
	* @since 1.15.2
	* http://codex.gravityview.co/class-gravityview-theme-hooks-woothemes_8php_source.html
	*/
	public function remove_meta_box() {
	 remove_meta_box( 'woothemes-settings', 'product', 'normal' );	  
	 remove_meta_box( 'woothemes-settings', 'service', 'normal' );	  
	
	}

	public function register_cpt_product() {
		$labels = array(
			'name' => _x( 'Products', 'wp-affiliate-system' ),
			'singular_name' => _x( 'Product', 'wp-affiliate-system' ),
			'add_new' => _x( 'Add New', 'wp-affiliate-system' ),
			'add_new_item' => _x( 'Add New Product', 'wp-affiliate-system' ),
			'edit_item' => _x( 'Edit Product', 'wp-affiliate-system' ),
			'new_item' => _x( 'New Product', 'wp-affiliate-system' ),
			'view_item' => _x( 'View Product', 'wp-affiliate-system' ),
			'search_items' => _x( 'Search Products', 'wp-affiliate-system' ),
			'not_found' => _x( 'No products found', 'wp-affiliate-system' ),
			'not_found_in_trash' => _x( 'No products found in Trash', 'wp-affiliate-system' ),
			'parent_item_colon' => _x( 'Parent Product:', 'wp-affiliate-system' ),
			'menu_name' => _x( 'Products', 'wp-affiliate-system' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'supports' => array( 'title', ), // 'author', 'editor', 'excerpt', , 'custom-fields'  // 'editor', 'excerpt',  'thumbnail', 'custom-fields'
			// 'taxonomies' => array( 'product_levels' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => false,
			'can_export' => false,
			'rewrite' => false,
			'menu_icon' => 'dashicons-cart',
			'capability_type' => 'post'
		);
		register_post_type( 'product', $args );
			
	}
	
	
	public function register_taxonomy_product_category() {
		$labels = array(
			'name' => _x( 'Product Categories', 'wp-affiliate-system' ),
			'singular_name' => _x( 'Product Category', 'wp-affiliate-system' ),
			'search_items' => _x( 'Search Product Categories', 'wp-affiliate-system' ),
			'popular_items' => _x( 'Popular Product Categories', 'wp-affiliate-system' ),
			'all_items' => _x( 'All Product Categories', 'wp-affiliate-system' ),
			'parent_item' => _x( 'Parent Product Category', 'wp-affiliate-system' ),
			'parent_item_colon' => _x( 'Parent Product Category:', 'wp-affiliate-system' ),
			'edit_item' => _x( 'Edit Product Category', 'wp-affiliate-system' ),
			'update_item' => _x( 'Update Product Category', 'wp-affiliate-system' ),
			'add_new_item' => _x( 'Add New Product Category', 'wp-affiliate-system' ),
			'new_item_name' => _x( 'New Product Category', 'wp-affiliate-system' ),
			'separate_items_with_commas' => _x( 'Separate sponsor levels with commas', 'wp-affiliate-system' ),
			'add_or_remove_items' => _x( 'Add or remove sponsor levels', 'wp-affiliate-system' ),
			'choose_from_most_used' => _x( 'Choose from the most used sponsor levels', 'wp-affiliate-system' ),
			'menu_name' => _x( 'Product Categories', 'wp-affiliate-system' ),
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'rewrite' => true,
			'query_var' => true
		);
		register_taxonomy( 'product_category', array('product'), $args );
	}

}




// Creating the widget
class WPASPostMetaBoxes {

	/**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    
    
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		
		// Set class property
        $this->options = get_option( 'wpsa_option_name' );
		
	}
	function admin_init() {
	    add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	    add_action( 'save_post', array( $this, 'save_post' ), 10);	    
	}
	  
	// Create the meta box
	function add_meta_boxes() {
	      add_meta_box(
	          'select_item',
	          'Enter Amazon Product ASIN',
	          array( $this, 'content' ),
	          'product',
	          'normal',
	          'high'
	      );
	}
	// Create the meta box content
	function content() {
		global $post;
		wp_nonce_field( basename( __FILE__ ), 'wp-affiliate-system_nonce' );
	    $asin = get_post_meta( $post->ID, '_asin', true );
	    ?>
	    <table class="form-table">
		    <tbody>
		        <tr>
		        	<th scope="row">
						<label for="asin" class="prfx-row-title"><?php _e( 'ASIN', 'wp-affiliate-system' )?></label>
					</th>		 
				    <td>
				        <input type="text" name="asin" id="asin" class="regular-text" value="<?php if ( isset ( $asin ) ) echo $asin; ?>" />
				        <br>
				        <span class="description">Amazon ASIN</span>
				    </td>
				</tr>
				<tr>
				<td></td>
				<td>
				
				
				<ul>
					<li>
						<a href="http://www.amazon.com/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇺🇸 <?php the_title(); ?></a>
						</li>
						<li>
				<a href="http://www.amazon.ca/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇨🇦 <?php the_title(); ?></a>
					</li>
					<li>
				<a href="http://www.amazon.co.uk/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇬🇧 <?php the_title(); ?></a>
				</li>
				<li>
				<a href="http://www.amazon.co.jp/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇯🇵 <?php the_title(); ?></a>
				</li>
				<li>
				<a href="http://www.amazon.fr/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇫🇷 <?php the_title(); ?></a>
				</li>
				<li>
				<a href="http://www.amazon.de/dp/<?php echo $asin; ?>/ref=nosim?tag=<?php echo $this->options['amazon_associate_id']; ?>" target="_BLANK" />🇩🇪 <?php the_title(); ?></a>
				</li>
				
				
				</ul>
				</td>
				</tr>
		    </tbody>
		</table>
 
	    <?php
	   
	}
	// Save the selection
	function save_post( $post_id ) {
	    $selected_item = null;
	    
	    // Checks save status
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    $is_valid_nonce = ( isset( $_POST[ 'wp-affiliate-system_nonce' ] ) && wp_verify_nonce( $_POST[ 'wp-affiliate-system_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	 
	    // Exits script depending on save status
	    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
	        return;
	    }
	 
	    // Checks for input and sanitizes/saves if needed
	    if( isset( $_POST[ 'asin' ] ) ) {
	        update_post_meta( $post_id, '_asin', sanitize_text_field( $_POST[ 'asin' ] ) );
	    
	    }
	    	    
	}
	
	
	
}

$wpas_posts = new WPASPosts();
$wpas_post_meta_boxes = new WPASPostMetaBoxes();