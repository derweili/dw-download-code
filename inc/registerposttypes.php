<?php


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function dwdownload_register_dwcode() {

	$labels = array(
		'name'                => __( 'Downloadcode', 'dw-download-code' ),
		'singular_name'       => __( 'Downloadcode', 'dw-download-code' ),
		'add_new'             => _x( 'Add New Downloadcode', 'dw-download-code', 'dw-download-code' ),
		'add_new_item'        => __( 'Add New Downloadcode', 'dw-download-code' ),
		'edit_item'           => __( 'Edit Downloadcode', 'dw-download-code' ),
		'new_item'            => __( 'New Downloadcode', 'dw-download-code' ),
		'view_item'           => __( 'View Downloadcode', 'dw-download-code' ),
		'search_items'        => __( 'Search Downloadcode', 'dw-download-code' ),
		'not_found'           => __( 'No Downloadcode found', 'dw-download-code' ),
		'not_found_in_trash'  => __( 'No Downloadcode found in Trash', 'dw-download-code' ),
		'parent_item_colon'   => __( 'Parent Downloadcode:', 'dw-download-code' ),
		'menu_name'           => __( 'Downloadcode', 'dw-download-code' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title','custom-fields',
			)
	);

	register_post_type( 'dw-code', $args );
}

add_action( 'init', 'dwdownload_register_dwcode' );


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function dwdownloads_register_cr_rebug() {

	$labels = array(
		'name'                => __( 'CR Debug Logs', 'dw-download-code' ),
		'singular_name'       => __( 'CR Debug Log', 'dw-download-code' ),
		'add_new'             => _x( 'Add New CR Debug Log', 'dw-download-code', 'dw-download-code' ),
		'add_new_item'        => __( 'Add New CR Debug Log', 'dw-download-code' ),
		'edit_item'           => __( 'Edit CR Debug Log', 'dw-download-code' ),
		'new_item'            => __( 'New CR Debug Log', 'dw-download-code' ),
		'view_item'           => __( 'View CR Debug Log', 'dw-download-code' ),
		'search_items'        => __( 'Search CR Debug Logs', 'dw-download-code' ),
		'not_found'           => __( 'No CR Debug Logs found', 'dw-download-code' ),
		'not_found_in_trash'  => __( 'No CR Debug Logs found in Trash', 'dw-download-code' ),
		'parent_item_colon'   => __( 'Parent CR Debug Log:', 'dw-download-code' ),
		'menu_name'           => __( 'CR Debug Logs', 'dw-download-code' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor','custom-fields'
			)
	);

	register_post_type( 'cr-debug-log', $args );
}

add_action( 'init', 'dwdownloads_register_cr_rebug' );


