<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	/*array(
		'type'	=>	'select',
		'label' =>	'User Role Title',
		'field' =>	'user_role_title',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	285,
						'height'=>	190
		),
		'thumbsize'	=>	array(
						'width'	=>	25,
						'height'=>	25
		),
		//'support'	=> array('jpe?g','jpg'),
		'validator' => array('required'),
		'note'		=> ''
	),*/
	array(
		'type' 	=>	'text',
		'label' =>	'User Role Title',
		'field' =>	'user_role_title',
		'req'	=>	true,
		'validator' => array('required','alphanumeric'),
		'max'	=> 	50,
		'class' =>	'',
		'note'		=> ''
	),
	array(
		'type'	=>	'image',
		'label' =>	'Image',
		'field' =>	'image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	285,
						'height'=>	190
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
		'type'	=>	'ckeditor',
		//user_id'=> 'user_role_id',
		'label' =>	'User Role Description',
		'field' =>	'user_role_description',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
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