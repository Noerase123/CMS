<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Booking Reference',
		'field' =>	'booking',
	),

	
	
	// array(
	// 	'type'	=>	'ckeditor',
	// 	'label' =>	'2nd Paragraph',
	// 	'field' =>	'paragraph2',
	// 	// 'req'	=>	true,
	// 	// // 'max'	=>	255, //if 0 no maxlength
	// 	// 'validator' => array('required')
	// )
);



$field_count = count($editor_fields);


$grid_info 	= array(
	'name'	=> array(
				'type'		=> 'text',
				'display'	=> 'Title',
				'field'		=> 'name',
				'width'		=> '530'
	)
);

$action_data = array(
	'view'		=> true,
	'add'		=> true,
	'delete'	=> true,
	'edit'		=> true,
	'active'	=> true,
	'move'		=> true
);



?>