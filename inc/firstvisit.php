<?php

function dwdownload_first_visit_form($output){

	$outputprefix = '<h3>Der Code ist nur einmalig Gültig. Gib bitte um
um Weiterhin auf die Songs zugreifen zu können
deine Mailadresse ein.*</h3>';
	$dwcode = $_POST["dwcode"];

	$outputprefix .= '<form action="' . get_permalink() . '" method="post" class="dwdownload mailform">
						<input type="hidden" name="dwcode" value="' . $dwcode . '"/>
						<input type="text" placeholder="Email" name="dwmail" required/>
						<input type="submit" name="Absenden" />
					</forms>';
	
	return $outputprefix . ' ' .$output;
}

add_filter('dwcode_firstvisit', 'dwdownload_first_visit_form', 20);