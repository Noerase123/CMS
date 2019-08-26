<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'ex_title',
	),

	array(
		'type' 	=>	'text',
		'label' =>	'Distance',
		'field' =>	'ex_distance',
	),

	array(
		'type' 	=>	'text',
		'label' =>	'Location',
		'field' =>	'ex_location',
	),


	array(
		'type'	=>	'image',
		'label' =>	'Image',
		'field' =>	'ex_image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	360,
						'height'=>	222
		),
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
	),

	array(
		'type' 	=>	'text',
		'label' =>	'Google Map URL',
		'field' =>	'ex_map',
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