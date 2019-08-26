<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'mv_title',
	),
	// array(
	// 	'type' 	=>	'text',
	// 	'label' =>	'Subtitle',
	// 	'field' =>	'room_title2',
	// ),
	array(
		'type'	=>	'ckeditor',
		'label' =>	'Mission Vision Display',
		'field' =>	'mv_description',
		'req'	=>	true,
		// 'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),

	array(
		'type'	=>	'image',
		'label' =>	'DOT image',
		'field' =>	'dot',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	110,
						'height'=>	110
		),
		'thumbsize'	=>	array(
						'width'	=>	25,
						'height'=>	25
		),
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
	),

	array(
		'type'	=>	'image',
		'label' =>	'FCAP image',
		'field' =>	'fcap',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	110,
						'height'=>	110
		),
		'thumbsize'	=>	array(
						'width'	=>	25,
						'height'=>	25
		),
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
	)
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