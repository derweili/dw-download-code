<?php

function dwdownload_mail_form($output){

	$outputprefix = '<h2>Email bestätigen</h2>
	<h3>Der Code wurde bereits verwendet. Bitte gib hier deine hinterlegte Mailadresse ein.</h3>';

	$dwcode = $_POST["dwcode"];

	$output .= '<form action="' . get_permalink() . '" method="post"  class="dwdownload codeform">
					<input type="hidden" name="dwcode" value="' . $dwcode . '"/>
					<div class="input-group">
						<input type="email" placeholder="Email" name="dwmail" class="input-group-field" required/>
						<div class="input-group-button">
							<input type="submit" name="Absenden" class="button" required/>
						</div>
					</div>
				</forms>
				';
	return $outputprefix . ' ' . $output;
}

add_filter('dwcode_mailform', 'dwdownload_mail_form', 20 );