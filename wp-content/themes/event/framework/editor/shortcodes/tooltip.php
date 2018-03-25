<?php 

$pix_options =array(


	array(
		'name' 	=> 	__('Tooltip Text', 'innwit'),
		'desc' 	=> 	__('Enter the tooltip text', 'innwit'),
		'id'	=>	'tooltip_title',
		'std'	=>	'Tooltip Text', //optional
		'type'	=>	'text',
		//'con'	=>	false //true to display inbetween shortcodes
		),

	array(
		'name' 	=> 	__('Alignment', 'innwit'),
		'desc' 	=> 	__('Choose the alignment you want', 'innwit'),
		'id'	=>	'align',
		'std'	=>	'top',
		'options'=> array('left','right','top','bottom'),
		'type'	=>	'select',
		),

	array(
		'name' 	=> 	__('Tooltip URL', 'innwit'),
		'desc' 	=> 	__('Enter the Tooltip URL', 'innwit'),
		'id'	=>	'link',
		'std'	=>	'#', //optional
		'type'	=>	'text',
		//'con'	=>	false //true to display inbetween shortcodes
		),

	array(
		'name' 	=> 	__('Tooltip Content', 'innwit'),
		'desc' 	=> 	__('Enter the tooltip content', 'innwit'),
		'id'	=>	'tooltip_content',
		'std'	=>	'Tooltip Content', //optional
		'type'	=>	'text',
		//'con'	=>	false //true to display inbetween shortcodes
		),

);

?>