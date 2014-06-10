<?php
/*
Plugin Name: WP Testimoni
Plugin URI: http://www.ngrambe.net/wordpress/wp-testimoni/
Description: Add testimonials to your wordpress blog.
Version: 0.3
Author: Aryan
Author URI: http://www.ngrambe.net/
License: GPL v2 or higher
License URI: License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//Initialize the metabox class

function ngrmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once(plugin_dir_path( __FILE__ ) . 'init.php');
}

add_action( 'init', 'ngrmb_initialize_cmb_meta_boxes', 9999 );

//Add Meta Boxes

function ngrmb_sample_metaboxes( $meta_boxes ) {
	$prefix = '_ngrmb_'; // Prefix for all fields

	$meta_boxes[] = array(
		'id' => 'test_metabox',
		'title' => 'Info Pengirim Testimoni',
		'pages' => array('testimonial'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Name',
				'desc' => 'Aryan (optional)',
				'id' => $prefix . 'name', // tampilkan di loop >> echo get_post_meta( get_the_ID(), 'name', true );
				'type' => 'text'
			),
			array(
				'name' => 'City',
				'desc' => 'Ngawi (optional)',
				'id' => $prefix . 'city',
				'type' => 'text'
			),
			array(
				'name' => 'Website',
				'desc' => 'http://www.ngrambe.net/ (optional)',
				'id' => $prefix . 'website',
				'type' => 'text'
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'ngrmb_sample_metaboxes' );

// Register Custom Post Type
function testimonial() {

	$labels = array(
		'name'                => _x( 'Testimonial', 'Post Type General Name', 'testimoni' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'testimoni' ),
		'menu_name'           => __( 'Testimonial', 'testimoni' ),
		'parent_item_colon'   => __( 'Parent Item:', 'testimoni' ),
		'all_items'           => __( 'All Items', 'testimoni' ),
		'view_item'           => __( 'View Item', 'testimoni' ),
		'add_new_item'        => __( 'Add New Testimonial', 'testimoni' ),
		'add_new'             => __( 'Add New', 'testimoni' ),
		'edit_item'           => __( 'Edit Item', 'testimoni' ),
		'update_item'         => __( 'Update Item', 'testimoni' ),
		'search_items'        => __( 'Search Item', 'testimoni' ),
		'not_found'           => __( 'Not found', 'testimoni' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'testimoni' ),
	);
	$args = array(
		'label'               => __( 'testimonial', 'testimoni' ),
		'description'         => __( 'Tempat untuk posting testimoni.', 'testimoni' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'http://gravis-design.com/wp-content/themes/gravis/favicon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'testimonial', $args );

}

// Hook into the 'init' action
add_action( 'init', 'testimonial', 0 );

?>