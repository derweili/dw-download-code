<?php

function dwdownload_new_mail_message( $output ){

	$outputprefix = '<h2>Deine Mailadresse wurde gespeichert</h3>';
	
	return $outputprefix . ' ' . $output;
}

add_filter('dwcode_new_mail', 'dwdownload_new_mail_message', 20);