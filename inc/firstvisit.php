<?php

function dwdownload_first_visit_form($output){

	$outputprefix = '<h3>Der Code ist nur einmalig Gültig. Gib bitte um
um Weiterhin auf die Songs zugreifen zu können
deine Mailadresse ein.*</h3>';
	$dwcode = $_POST["dwcode"];

	$outputprefix .= '<form action="' . get_permalink() . '" method="post" class="dwdownload mailform">
						<input type="hidden" name="dwcode" value="' . $dwcode . '"/>
						<input id="dwnewsletter" type="checkbox" name="dwnewsletter" value="true"><label for="dwnewsletter">Newsletter erhalten</label>
						<div class="input-group">
							<input type="text" placeholder="Email" name="dwmail" required/>
							<div class="input-group-button">
								<input type="submit" name="Absenden" class="button" required/>
							</div>
						</div>
					</forms>';
	
	return $outputprefix . ' ' .$output;
}

add_filter('dwcode_firstvisit', 'dwdownload_first_visit_form', 20);