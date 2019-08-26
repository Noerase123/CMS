<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'party_title',
	),

	array(
		'type' 	=>	'text',
		'label' =>	'SubTitle',
		'field' =>	'party_subtitle',
	),
	
	array(
		'type' 	=>	'ckeditor',
		'label' =>	'Description',
		'field' =>	'party_description',
	),
	
	// array(
	// 	'type'	=>	'image',
	// 	'label' =>	'Image',
	// 	'field' =>	'event_image',
	// 	'req'	=>	true,
	// 	'size' 	=>	array(
	// 					'width'	=>	277,
	// 					'height'=>	207
	// 	),
	// 	//'support'	=> array('jpe?g','jpg'),
	// 	//'validator' => array('accept','required'),
	// 	'note'		=> ''
	// ),
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