<?php

function dwdownload_codeform($output){

	$output .= '<form action="' . get_permalink() . '" method="post"  class="dwdownload codeform">
					<input type="text" placeholder="Code" name="dwcode" />
					<input type="submit" name="Absenden" required/>
				</forms>
				';
	return $output;
}

add_filter('dwcode_nocode', 'dwdownload_codeform', 20 );
add_filter('dwcode_invalidcode', 'dwdownload_codeform', 20);