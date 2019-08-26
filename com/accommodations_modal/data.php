<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type'	=>	'image',
		'label' =>	'Image',
		'field' =>	'room_image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	1024,
						'height'=>	700
		),
		'thumbsize'	=>	array(
						'width'	=>	25,
						'height'=>	25
		),
		'support'	=> array('jpe?g','jpg'),
		'validator' => array('accept','required'),
		'note'		=> ''
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'room_title',
	),
	array(
		'type'	=>	'ckeditor',
		'label' =>	'Description',
		'field' =>	'room_description',
		'req'	=>	true,
		// 'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),
	array(
		'type'	=>	'ckeditor',
		'label' =>	'Other Description',
		'field' =>	'room_desc_others',
		// 'req'	=>	true,
		// 'max'	=>	255, //if 0 no maxlength
		// 'validator' => array('required')
	)
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