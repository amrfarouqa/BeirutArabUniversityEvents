<?php 

$pix_options =array(


	array(
		'name' 	=> 	__('Author Name (Optional)', 'innwit'),
		'desc' 	=> 	__('Enter the author name', 'innwit'),
		'id'	=>	'author_name',
		'std'	=>	'John Deo', //optional
		'type'	=>	'text'
		),

	array(
		'name' 	=> 	__('Content', 'innwit'),
		'desc' 	=> 	__('Enter the  blockquote content', 'innwit'),
		'id'	=>	'blockquote_con',
		'std'	=>	'Content Goes Here',
		'type'	=>	'textarea',
		'con'	=>	true //true to display inbetween shortcodes
		),

	array(
		'name' 	=> 	__('Alignment', 'innwit'),
		'desc' 	=> 	__('BlockQuote alignment left or right', 'innwit'),
		'id'	=>	'align',
		'std'	=>	'left',
		'options'=> array('left','right'),
		'type'	=>	'select'
		),

);

?>