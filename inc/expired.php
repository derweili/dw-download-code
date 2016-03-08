<?php

function dwdownload_expired_message($output){

	$output = 'Dieser Code ist abgelaufen';
	
	return $output;
}

add_filter('dwcode_expired', 'dwdownload_expired_message', 20);