<?php
/**
 * @package Download Code
 * @version 1
 */
/*
Plugin Name: DW Download Code
Plugin URI: http://derweili.de
Description: Download Code Plugin for Wordpress.
Author: derweili
Version: 1
Author URI: http://derweili.de/
*/


require_once('inc/registerposttypes.php');
require_once('inc/isprotected.php');
require_once('inc/firstvisit.php');
require_once('inc/expired.php');
require_once('inc/new-mail.php');
require_once('inc/mailform.php');
require_once('inc/wrong-mail.php');
require_once('inc/invalide-code.php');
require_once('inc/admin.php');
require_once('inc/clever-reach-api-connector.php');


function dwdownloads_codeblock( $content ){

	$protected = get_post_meta( get_the_id(), 'dwdownloads_protected', true );//Get Protected Meta


	if ($protected && !current_user_can('edit_posts')) { // If Post is Protected

		if ( !isset( $_POST["dwcode"] ) ) { //If no downloadcode ist send
			
			// dwdownload_isprotected  - 20

			return apply_filters( 'dwcode_nocode', ''); 

		}elseif( isset( $_POST["dwcode"] ) ){ // If a downloadcode is send

			 $dwcode_object = get_page_by_title( $_POST["dwcode"], 'object', 'dw-code' );
			 if (empty($dwcode_object)) {
			 	$output = apply_filters( 'dwcode_invalidcode', '' );
			 	return $output;
			 }

			 $dwcode_expired = get_post_meta( $dwcode_object->ID, 'dwdownloads_expired', true );
			 $dwcode_mail = get_post_meta( $dwcode_object->ID, 'dwdownloads_mail', true );


			if(!$dwcode_expired){

				$output = apply_filters( 'dwcode_firstvisit', $content );

				add_post_meta($dwcode_object->ID, 'dwdownloads_expired', 'true', true);

				return $output;
				

			}elseif( $dwcode_expired && empty( $dwcode_mail ) && !isset( $_POST["dwmail"] ) ) { //If dw code is expired and no mail is supplied
			 			
			 	//Code is expired
			 	return apply_filters( 'dwcode_expired', '' );


			}elseif( $dwcode_expired && empty( $dwcode_mail ) && isset( $_POST["dwmail"] ) ){

				//Code is expired, no email stored but new mail has been send
				$output = apply_filters( 'dwcode_new_mail', $content );

				$dwmail = $_POST["dwmail"];

				$dwcodeid = $dwcode_object->ID;

				do_action( 'dwdownloads_after_mail_registration' );

				add_post_meta($dwcode_object->ID, 'dwdownloads_mail', $_POST["dwmail"], true);

				


				return $output;

			}elseif( $dwcode_expired && !empty( $dwcode_mail ) && !isset( $_POST["dwmail"] ) ){
				//Display form if Code is expired but email is stored
				$output = apply_filters( 'dwcode_mailform', '' );

				return $output;
				
			}elseif( $dwcode_expired && !empty( $dwcode_mail ) && isset( $_POST["dwmail"] ) ){
				
				if ($dwcode_mail != $_POST["dwmail"]) {	//Check if email is correct
					$output = apply_filters( 'dwcode_wrong_mail', '' );
				}else{
					$output = apply_filters( 'dwcode_known_mail', $content );
				}

				return $output;

			}else{

			print_r('error');

			}

		}
	}else{

		return $content;

	}
}


add_filter( 'the_content', 'dwdownloads_codeblock', 20 ); 