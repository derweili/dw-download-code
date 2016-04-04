<?php

function dwdownload_codeform($output){

	$output .= '<form action="' . get_permalink() . '" method="post"  class="dwdownload codeform">
					<div class="input-group">
					<input type="text" placeholder="Code" class="input-group-field" name="dwcode" />
					<div class="input-group-button">
						<input type="submit" name="Absenden" class="button" required/>
					</div>
				</forms>
				';
	return $output;
}

add_filter('dwcode_nocode', 'dwdownload_codeform', 20 );
add_filter('dwcode_invalidcode', 'dwdownload_codeform', 20);


function dwdownload_istprotected_prefix($output){

	$output .= '<h2>Code Eingeben</h2>';
	return $output;
};
add_filter('dwcode_nocode', 'dwdownload_istprotected_prefix', 10 );
