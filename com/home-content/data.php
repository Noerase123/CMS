<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Booking',
		'field' =>	'home_booking',
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'home_room_title',
	),
	array(
		'type'	=>	'ckeditor',
		'label' =>	'Description',
		'field' =>	'home_room_description',
		'req'	=>	true,
		// 'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Restaurant',
		'field' =>	'home_restaurant',
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Activities',
		'field' =>	'home_activities',
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Gallery',
		'field' =>	'home_gallery',
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Parallax',
		'field' =>	'home_parallax',
	),
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