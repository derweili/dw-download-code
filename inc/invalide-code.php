<?php

function dwdownload_invalide_form($output){

	$output .= '<h3>Dieser Code ist leider nicht gültig. Bitte gib einen gültigen Code ein.</h3>';
	return $output;
}

add_filter('dwcode_invalidcode', 'dwdownload_invalide_form', 5);