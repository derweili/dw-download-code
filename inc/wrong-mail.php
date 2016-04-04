<?php

function dwdownload_wrong_mail_form($output){

	$outputprefix = '<h3>Die eingegebene Mailadresse stimmt leider nicht mit der hinterlegten Mailadresse überein.</h3>';

	$dwcode = $_POST["dwcode"];

	$output .= '<form action="' . get_permalink() . '" method="post"  class="dwdownload codeform">
					<input type="hidden" name="dwcode" value="' . $dwcode . '"/>
					<div class="input-group">
						<input type="text" placeholder="Email" name="dwmail" required/>
						<div class="input-group-button">
							<input type="submit" name="Absenden" class="button" required/>
						</div>
					</div>
				</forms>
				';
	return $outputprefix . ' ' . $output;
}

add_filter('dwcode_wrong_mail', 'dwdownload_wrong_mail_form', 20 );