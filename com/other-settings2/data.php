<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(

	array(
		'type'	=>	'image',
		'label' =>	'Pre-loader',
		'field' =>	'ex_image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	220,
						'height'=>	101
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

	// array(
	// 	'type' 	=>	'text',
	// 	'label' =>	'Title',
	// 	'field' =>	'ex_title',
	// ),

	array(
		'type' 	=>	'text',
		'label' =>	'Recaptcha Site Key',
		'field' =>	'recaptcha1',
	),

	array(
		'type' 	=>	'text',
		'label' =>	'Recaptcha Secret Key',
		'field' =>	'recaptcha2',
	),


	// array(
	// 	'type' 	=>	'text',
	// 	'label' =>	'Google Map URL',
	// 	'field' =>	'ex_map',
	// ),

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