<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	// array(
	// 	'type' 	=>	'text',
	// 	'label' =>	'Logo Name',
	// 	'field' =>	'room_title',
	// ),
	array(
		'type'	=>	'image',
		'label' =>	'Header Logo',
		'field' =>	'room_image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	230,
						'height'=>	230
		),
		
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
	),
	array(
		'type'	=>	'image',
		'label' =>	'Footer Logo',
		'field' =>	'room_image2',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	175,
						'height'=>	175
		),
		
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
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