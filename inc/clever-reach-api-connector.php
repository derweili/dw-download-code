<?php

function dwdownloads_api_connector(){

	$dwmail = $_POST["dwmail"];
	$dwcode = $_POST["dwcode"];

	if( !isset( $_POST["dwnewsletter"] ) ){
		echo "<h1>No checkbox send</h1>";
		exit();
	}
	if ( $_POST["dwnewsletter"] != 'true' ){
		echo "<h1>Checkbox not true</h1>";
		exit();
	}

	//Get Download Code Metas
	$dwcode_object = get_page_by_title( $_POST["dwcode"], 'object', 'dw-code' );
	$dwcode_zip = get_post_meta( $dwcode_object->ID, 'dwdownloads_zip', true );
	$dwcode_city = get_post_meta( $dwcode_object->ID, 'dwdownloads_city', true );
	$dwcode_country = get_post_meta( $dwcode_object->ID, 'dwdownloads_country', true );



	//API Cedentials
	$apiKey = "13ea7e08b5140adff6e73b3f15fc064a-4";
	$wsdl_url="http://api.cleverreach.com/soap/interface_v5.1.php?wsdl";
	$listId = "791054";

	$api = new SoapClient($wsdl_url);


	####################
	# Add User
	####################

	$user = array(
	"email" => $dwmail,
	"registered" => time(),
	//"activated" => time(),
	"source" => "Downloadcodes",
	"attributes" => array(
		0 => array( "key" => "city", "value" => $dwcode_city ),
		1 => array( "key" => "zip", "value" => $dwcode_zip ),
		2 => array( "key" => "country", "value" => $dwcode_country ),
	),
	//--- you can include orders here too ---
	    "orders" => array(
	         0 => array(
	             // --- required order fields ---
	            "stamp" => time(), //order date, unix timestamp
	            "order_id" => $dwcode, //unique order ID (order_id & product are the unqiue key)
	            "product" => "Long Nights and Hurricanes", //product name
	            // --- Optional order fields ---
	            "product_id" => "001",    //product ID, integer
	            "quantity" => 1, //default 1
	            "price" => 9.99,
	            "source" => "CD",
	            //"mailing_id" => 12345678,     //if available (via connect link extension),
	                                         //set this to see order conversion in statistics
	         )
	    ),
	);

	$reveiverAddResult = $api->receiverAdd($apiKey, $listId, $user);


	####################
	# Send Activation Mail (Opt-in)
	####################


	$doidata = array(
		"user_ip" => $_SERVER['REMOTE_ADDR'], //the IP of the user who registered. not yours!
		"user_agent" => $_SERVER['HTTP_USER_AGENT'],
		"referer" => get_permalink(),
		//"postdata" => "firtsname:bruce,lastname:whayne,nickname:Batman", //just an example. any txt format will do.
		//"info" => "Extra info. the more you provide, the better.",
	);

	$sendActivationMailResult = $api->formsSendActivationMail($apiKey, '118394', $dwmail, $doidata);


}

add_action('dwdownloads_after_mail_registration', 'dwdownloads_api_connector' );