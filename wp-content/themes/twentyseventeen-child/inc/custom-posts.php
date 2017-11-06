<?php
do_action( 'woocommerce_register_post_type' );

add_action( 'init', 'create_movie' );
function create_movie() {

	$supports = array( 'title', 'editor', 'thumbnail', 'comments' );

	register_post_type( 'movie',
		apply_filters( 'woocommerce_register_post_type_product',
			array(
				'labels'              => array(
					'name'                  => __( 'Movies', TEXTDOMAIN ),
					'singular_name'         => __( 'Movie', TEXTDOMAIN ),
					'all_items'             => __( 'All Movies', TEXTDOMAIN ),
					'menu_name'             => _x( 'Movies', 'Admin menu name', TEXTDOMAIN ),
					'add_new'               => __( 'Add New', TEXTDOMAIN ),
					'add_new_item'          => __( 'Add new movie', TEXTDOMAIN ),
					'edit'                  => __( 'Edit', TEXTDOMAIN ),
					'edit_item'             => __( 'Edit movie', TEXTDOMAIN ),
					'new_item'              => __( 'New movie', TEXTDOMAIN ),
					'view'                  => __( 'View movie', TEXTDOMAIN ),
					'view_item'             => __( 'View movie', TEXTDOMAIN ),
					'search_items'          => __( 'Search movies', TEXTDOMAIN ),
					'not_found'             => __( 'No movies found', TEXTDOMAIN ),
					'not_found_in_trash'    => __( 'No movies found in trash', TEXTDOMAIN ),
					'parent'                => __( 'Parent movie', TEXTDOMAIN ),
					'featured_image'        => __( 'Movies image', TEXTDOMAIN ),
					'set_featured_image'    => __( 'Set movie image', TEXTDOMAIN ),
					'remove_featured_image' => __( 'Remove movie image', TEXTDOMAIN ),
					'use_featured_image'    => __( 'Use as movie image', TEXTDOMAIN ),
					'insert_into_item'      => __( 'Insert into movie', TEXTDOMAIN ),
					'uploaded_to_this_item' => __( 'Uploaded to this movie', TEXTDOMAIN ),
					'filter_items_list'     => __( 'Filter movies', TEXTDOMAIN ),
					'items_list_navigation' => __( 'Movies navigation', TEXTDOMAIN ),
					'items_list'            => __( 'Movies list', TEXTDOMAIN ),
				),
				'description'         => __( 'This is where you can add new movies to your store.', TEXTDOMAIN ),
				'public'              => true,
				'show_ui'             => true,
				'capability_type'     => 'product',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'hierarchical'        => true,
				'rewrite'             => array( 'slug' => 'movie', 'with_front' => false, 'feeds' => true ),
				'query_var'           => true,
				'supports'            => $supports,
				'has_archive'         => true,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'taxonomies' => array( 'movie_cat' ),
				'menu_icon' => 'dashicons-format-video',
			)
		)
	);

	register_taxonomy( 'movie_cat',
		apply_filters( 'woocommerce_taxonomy_objects_movie_cat', array( 'movie' ) ),
		apply_filters( 'woocommerce_taxonomy_args_movie_cat', array(
			'hierarchical'          => true,
			'update_count_callback' => '_wc_term_recount',
			'label'                 => __( 'Movie Categories', TEXTDOMAIN ),
			'labels' => array(
				'name'              => __( 'Movie categories', TEXTDOMAIN ),
				'singular_name'     => __( 'Category', TEXTDOMAIN ),
				'menu_name'         => _x( 'Categories', 'Admin menu name', TEXTDOMAIN ),
				'search_items'      => __( 'Search categories', TEXTDOMAIN ),
				'all_items'         => __( 'All categories', TEXTDOMAIN ),
				'parent_item'       => __( 'Parent category', TEXTDOMAIN ),
				'parent_item_colon' => __( 'Parent category:', TEXTDOMAIN ),
				'edit_item'         => __( 'Edit category', TEXTDOMAIN ),
				'update_item'       => __( 'Update category', TEXTDOMAIN ),
				'add_new_item'      => __( 'Add new category', TEXTDOMAIN ),
				'new_item_name'     => __( 'New category name', TEXTDOMAIN ),
				'not_found'         => __( 'No categories found', TEXTDOMAIN ),
			),
			'show_ui'               => true,
			'query_var'             => true,
			'capabilities'          => array(
				'manage_terms' => 'manage_product_terms',
				'edit_terms'   => 'edit_product_terms',
				'delete_terms' => 'delete_product_terms',
				'assign_terms' => 'assign_product_terms',
			),
			'rewrite'          => array(
				'slug'         => 'category',
				'with_front'   => false,
				'hierarchical' => true,
			),
		) )
	);
}

add_action( 'admin_init', 'my_admin' );
function my_admin() {
	add_meta_box( 'movie_meta_box',
		'Custom Fields',
		'display_movie_meta_box',
		'movie', 'normal', 'high'
	);
}

function display_movie_meta_box( $movie ) {

	$subtitle = esc_html( get_post_meta( $movie->ID, 'subtitle', true ) );
	$_price = esc_html( get_post_meta( $movie->ID, '_price', true ) );
	?>
	<table>
		<tr>
			<td style="width: 30%">Subtitle</td>
			<td><input type="text" size="150" name="subtitle" value="<?php echo $subtitle; ?>" /></td>
		</tr>
		<tr>
			<td style="width: 30%">Price</td>
			<td><input type="text" size="5" name="_price" value="<?php echo $_price; ?>" /></td>
		</tr>
	</table>
	<?php
}

add_action( 'save_post', 'add_movie_fields', 10, 2 );
function add_movie_fields( $movie_review_id, $movie_review ) {

	if ( $movie_review->post_type == 'movie' ) {

		if ( isset( $_POST['subtitle'] ) && $_POST['subtitle'] != '' ) {
			update_post_meta( $movie_review_id, 'subtitle', $_POST['subtitle'] );
		}
		if ( isset( $_POST['product_id'] ) && $_POST['product_id'] != '' ) {
			update_post_meta( $movie_review_id, 'product_id', $_POST['product_id'] );
		}
		if ( isset( $_POST['_price'] ) && $_POST['_price'] != '' ) {
			update_post_meta( $movie_review_id, '_price', $_POST['_price'] );
		}
	}
}

add_filter( 'woocommerce_data_stores', 'my_woocommerce_data_stores' );
function my_woocommerce_data_stores( $stores ) {

	require_once get_theme_file_path('/inc/product-data.php');
	$stores['product'] = 'MY_Product_Data_Store_CPT';

	return $stores;
}

add_action('parse_query', 'custom_parse_query');
function custom_parse_query($wp_query){

	if(is_admin()) {
		return;
	}

	if(!empty($wp_query->query['post_type']) && $wp_query->query['post_type'] == 'movie' && !empty($wp_query->query['name'])) {

		global $product;

		$slug = $wp_query->query['name'];

		if ( $post = get_page_by_path( $slug, OBJECT, 'movie' ) ) {

			$id = $post->ID;

			$product = wc_get_product( $id );
		}
	}
}