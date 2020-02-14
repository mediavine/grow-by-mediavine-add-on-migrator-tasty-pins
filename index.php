<?php
/**
 * Plugin Name: Social Pug - Tasty Pins Migrator
 * Plugin URI: http://www.devpups.com/social-pug/
 * Description: Migrates Tasty Pins Pinterest images and descriptions to Social Pug
 * Version: 1.0.0
 * Author: DevPups
 * Text Domain: social-pug
 * Author URI: http://www.devpups.com/
 * License: GPL2
 */


/**
 * Includes the needed files
 *
 */
function dpsp_migrator_load_files_tasty_pins() {

	if( ! is_admin() )
		return;

	// Migrator submenu page
	if( file_exists( plugin_dir_path( __FILE__ ) . '/admin/submenu-page-migrator.php' ) )
		include_once( plugin_dir_path( __FILE__ ) . '/admin/submenu-page-migrator.php' );

}
add_action( 'init', 'dpsp_migrator_load_files_tasty_pins' );


/**
 * Searches the post meta table for the Tasty Pins hidden images and Pinterest description and if it finds something
 * it adds it to what Social Pug has saved
 *
 */
function dpsp_migrator_migrate_hidden_images_tp() {

	// Verify for nonce
	if( empty( $_GET['dpsp_token'] ) || ! wp_verify_nonce( $_GET['dpsp_token'], 'dpsp_migrate_hidden_images_tp' ) )
		return;

	global $wpdb;

	$results = array();

	// Grab the hidden images
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->postmeta} WHERE ( meta_key = 'tp_pinterest_hidden_image' OR meta_key = 'tp_pinterest_default_text' )", ARRAY_A );

	// Exit if no data was found
	if( empty( $results ) ) {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { window.location.replace("' . add_query_arg( array( 'page' => 'dpsp-migrator', 'dpsp_message_class' => 'updated', 'message' => urlencode( __( "There are no hidden Pinterest images or default Pinterest texts set in Tasty Pins for your posts, thus there is nothing to migrate.", 'social-pug' ) ) ), admin_url( 'admin.php' ) ) . '") })';
		echo '</script>';

		return;

	}

	$arr 		   = array();
	$posts_updated = ( ! empty( $_GET['posts_updated'] ) ? absint( $_GET['posts_updated'] ) : 0 );

	foreach( $results as $result ) {

		if( empty( $result['post_id'] ) )
			continue;

		if( empty( $result['meta_key'] ) )
			continue;

		if( empty( $result['meta_value'] ) )
			continue;

		if( empty( $arr[$result['post_id']] ) )
			$arr[$result['post_id']] = array();

		$arr[$result['post_id']][$result['meta_key']] = $result['meta_value'];

	}

	$_arr = array_slice( $arr, $posts_updated, 20, true );

	foreach( $_arr as $post_id => $meta_data ) {

		// Update the hidden images
		if( ! empty( $meta_data['tp_pinterest_hidden_image'] ) ) {

			$hidden_images = explode( ',', $meta_data['tp_pinterest_hidden_image'] );

			update_metadata( 'post', $post_id, 'dpsp_pinterest_hidden_images', $hidden_images );

		}

		// Update the post Pinterest description
		if( ! empty( $meta_data['tp_pinterest_default_text'] ) ) {

			$share_options = get_post_meta( $post_id, 'dpsp_share_options', true );

			if( empty( $share_options ) )
				$share_options = array();

			$share_options['custom_description_pinterest'] = sanitize_text_field( $meta_data['tp_pinterest_default_text'] );

			update_metadata( 'post', $post_id, 'dpsp_share_options', $share_options );

		}

		$posts_updated++;

	}

	// Go to the next batch if posts updated hasn't reached the maximum number of posts that need migrated
	if( $posts_updated != count( $arr ) ) {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { setTimeout( function() { window.location.replace("' . add_query_arg( array( 'posts_updated' => $posts_updated ) ) . '") }, 2500 ) })';
		echo '</script>';

	} else {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { window.location.replace("' . add_query_arg( array( 'page' => 'dpsp-migrator', 'dpsp_message_class' => 'updated', 'message' => urlencode( sprintf( __( 'Pinterest hidden images and default Pinterest texts for %d posts have been migrated to Social Pug.', 'social-pug' ), $posts_updated ) ) ), admin_url( 'admin.php' ) ) . '") })';
		echo '</script>';

	}

}


/**
 * Searches the post meta table for the Tasty Pins pin description and repin ID data, if it finds something
 * it adds it to the images as Social Pug uses it
 *
 */
function dpsp_migrator_migrate_images_pin_data_tp() {

	// Verify for nonce
	if( empty( $_GET['dpsp_token'] ) || ! wp_verify_nonce( $_GET['dpsp_token'], 'dpsp_migrate_images_pin_data_tp' ) )
		return;

	global $wpdb;

	$results = array();

	// Grab the hidden images
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->postmeta} WHERE ( meta_key = 'tp_pinterest_text' OR meta_key = 'tp_pinterest_repin_id' )", ARRAY_A );

	// Exit if no data was found
	if( empty( $results ) ) {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { window.location.replace("' . add_query_arg( array( 'page' => 'dpsp-migrator', 'dpsp_message_class' => 'updated', 'message' => urlencode( __( "There is no image pin data set in Tasty Pins for your images, thus there is nothing to migrate.", 'social-pug' ) ) ), admin_url( 'admin.php' ) ) . '") })';
		echo '</script>';

		return;

	}

	$arr 		   = array();
	$posts_updated = ( ! empty( $_GET['posts_updated'] ) ? absint( $_GET['posts_updated'] ) : 0 );

	foreach( $results as $result ) {

		if( empty( $result['post_id'] ) )
			continue;

		if( empty( $result['meta_key'] ) )
			continue;

		if( empty( $result['meta_value'] ) )
			continue;

		if( empty( $arr[$result['post_id']] ) )
			$arr[$result['post_id']] = array();

		$arr[$result['post_id']][$result['meta_key']] = $result['meta_value'];

	}

	$_arr = array_slice( $arr, $posts_updated, 20, true );

	foreach( $_arr as $post_id => $meta_data ) {

		// Update the image Pinterest description
		if( ! empty( $meta_data['tp_pinterest_text'] ) ) {

			$pinterest_text = sanitize_text_field( $meta_data['tp_pinterest_text'] );

			update_metadata( 'post', $post_id, 'pin_description', $pinterest_text );

		}

		// Update the image Pinterest repind ID
		if( ! empty( $meta_data['tp_pinterest_repin_id'] ) ) {

			$pinterest_repin_id = sanitize_text_field( $meta_data['tp_pinterest_repin_id'] );

			update_metadata( 'post', $post_id, 'pin_repin_id', $pinterest_repin_id );

		}

		$posts_updated++;

	}

	// Go to the next batch if posts updated hasn't reached the maximum number of posts that need migrated
	if( $posts_updated != count( $arr ) ) {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { setTimeout( function() { window.location.replace("' . add_query_arg( array( 'posts_updated' => $posts_updated ) ) . '") }, 2500 ) })';
		echo '</script>';

	} else {

		echo '<script type="text/javascript">';
			echo 'jQuery(window).load( function() { window.location.replace("' . add_query_arg( array( 'page' => 'dpsp-migrator', 'dpsp_message_class' => 'updated', 'message' => urlencode( sprintf( __( 'Pin data for %d images have been migrated to Social Pug.', 'social-pug' ), $posts_updated ) ) ), admin_url( 'admin.php' ) ) . '") })';
		echo '</script>';

	}

}


/*
 * Display admin notices for our pages
 *
 */
function dpsp_migrator_admin_notices_tasty_pins() {

	if( empty( $_GET['message'] ) )
		return;

	$admin_page = ( isset( $_GET['page'] ) ? $_GET['page'] : '' );

	// Show these notices only on dpsp pages
	if( strpos( $admin_page, 'dpsp' ) === false )
		return;

	// Get messages
	$message = sanitize_text_field( $_GET['message'] );

	$class = ( isset( $_GET['dpsp_message_class'] ) ? $_GET['dpsp_message_class'] : 'updated' );;

	if( isset( $message ) ) {

		echo '<div class="dpsp-admin-notice notice is-dismissible ' . esc_attr( $class ) . '">';
        	echo '<p>' . esc_attr( $message ) . '</p>';
        echo '</div>';
	}

}
add_action( 'admin_notices', 'dpsp_migrator_admin_notices_tasty_pins' );