<?php

function dwdownload_mail_form($output){

	$outputprefix = '<h3>Der Code wurde bereits verwendet. Bitte gib hier hinterlegte Mailadresse ein.</h3>';

	$dwcode = $_POST["dwcode"];

	$output .= '<form action="' . get_permalink() . '" method="post"  class="dwdownload codeform">
					<input type="hidden" name="dwcode" value="' . $dwcode . '"/>
					<input type="text" placeholder="Email" name="dwmail" required/>
					<input type="submit" name="Absenden" />
				</forms>
				';
	return $outputprefix . ' ' . $output;
}

add_filter('dwcode_mailform', 'dwdownload_mail_form', 20 );