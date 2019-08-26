<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	
	// array(
	// 	'type'	=>	'image',
	// 	'label' =>	'Favicon',
	// 	'field' =>	'favicon',
	// 	'req'	=>	true,
	// 	'size' 	=>	array(
	// 					'width'	=>	50,
	// 					'height'=>	50
	// 	),
	// 	'support'	=> array('jpe?g','jpg','png'),
	// 	'validator' => array('accept','required'),
	// 	'note'		=> ''
	// ),
	// array(
	// 	'type'	=>	'image',
	// 	'label' =>	'Header Logo',
	// 	'field' =>	'room_image',
	// 	'req'	=>	true,
	// 	'size' 	=>	array(
	// 					'width'	=>	230,
	// 					'height'=>	167
	// 	),
	// 	'thumbsize'	=>	array(
	// 					'width'	=>	25,
	// 					'height'=>	25
	// 	),
	// 	'support'	=> array('jpe?g','jpg','png'),
	// 	'validator' => array('accept','required'),
	// 	'note'		=> ''
	// ),
	// array(
	// 	'type'	=>	'image',
	// 	'label' =>	'Footer logo',
	// 	'field' =>	'footer_logo',
	// 	'req'	=>	true,
	// 	'size' 	=>	array(
	// 					'width'	=>	175,
	// 					'height'=>	127
	// 	),
	// 	'thumbsize'	=>	array(
	// 					'width'	=>	25,
	// 					'height'=>	25
	// 	),
	// 	'support'	=> array('jpe?g','jpg','png'),
	// 	'validator' => array('accept','required'),
	// 	'note'		=> ''
	// ),
	array(
		'type'	=>	'image',
		'label' =>	'Pre-loader',
		'field' =>	'preloader',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	250,
						'height'=>	181
		),
		'thumbsize'	=>	array(
						'width'	=>	25,
						'height'=>	25
		),
		'support'	=> array('jpe?g','jpg','png'),
		'validator' => array('accept','required'),
		'note'		=> ''
	),
	
	array(
		'type'	=>	'color_picker',
		'label' =>	'Main Background Color',
		'field' =>	'first_color',
		'class' => 'jscolor'
	),
	array(
		'type'	=>	'color_picker',
		'label' =>	'Text Color',
		'field' =>	'first_text_color',
		'class' => 'jscolor'
	),
	array(
		'type'	=>	'color_picker',
		'label' =>	'Secondary Color',
		'field' =>	'second_color',
		'class' => 'jscolor'
	),
	array(
		'type'	=>	'color_picker',
		'label' =>	'Text Color',
		'field' =>	'second_text_color',
		'class' => 'jscolor'
	),
	array(
		'type'	=>	'color_picker',
		'label' =>	'Button Color',
		'field' =>	'third_color',
		'class' => 'jscolor'
	),
	array(
		'type'	=>	'color_picker',
		'label' =>	'Text Color',
		'field' =>	'third_text_color',
		'class' => 'jscolor'
	),
	array(
		'type' 	=>	'text_box',
		'label' =>	'Analytics',
		'field' =>	'analytics',
		'req'	=>	true,
	),
	array(
		'type' 	=>	'text_box',
		'label' =>	'News Letter',
		'field' =>	'newsletter',
		'req'	=>	true,
	),
	array(
		'type' 	=>	'text_box',
		'label' =>	'Trip Advisor',
		'field' =>	'trip_advisor',
		'req'	=>	true,
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Recaptcha Site Key',
		'field' =>	'site_key',
		'req'	=>	true,
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Recaptcha Secret Key',
		'field' =>	'secret_key',
		'req'	=>	true,
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