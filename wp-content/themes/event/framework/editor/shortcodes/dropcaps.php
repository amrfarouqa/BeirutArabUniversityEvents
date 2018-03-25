<?php 

$pix_options =array(

	array('break' =>  false),

	array(
		'name' 	=> 	__('Dropcaps Style', 'innwit'),
		'desc' 	=> 	__('Choose the style you want', 'innwit'),
		'id'	=>	'style',
		'std'	=>	'default',
		'options'=> array('default','square','circle'),
		'type'	=>	'select'
		),

	array(
		'name' 	=> 	__('Dropcaps Text', 'innwit'),
		'desc' 	=> 	__('Enter the dropcaps text', 'innwit'),
		'id'	=>	'dropcap_text',
		'std'	=>	'S', //optional
		'type'	=>	'text',
		'con'   =>  true 
	)

);

?>