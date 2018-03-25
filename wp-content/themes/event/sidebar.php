<?php

	//Get single blog values from theme option
	$selected_sidebar_replacement = isset($selected_sidebar_replacement) ? $selected_sidebar_replacement : '0';

	pix_sidebar($selected_sidebar_replacement, 'blog-sidebar', 'style1', 0);

?>