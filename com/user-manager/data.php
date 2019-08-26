<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type'	=>	'select',
		'label' =>	'User Role',
		'field' =>	'user_role_id',
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
	/*array(
		'type' 	=>	'text',
		'label' =>	'User Role',
		'field' =>	'user_role_id',
		'req'	=>	true,
		'validator' => array('required','alphanumeric'),
		'max'	=> 	50,
		'class' =>	'',
		'note'		=> ''
	),*/
	array(
		'type'	=>	'text',
		'label' =>	'Login Email',
		'field' =>	'email_address',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required','email')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Login Password',
		'field' =>	'password',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Confirm Password',
		'field' =>	'confirmpassword',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required','equalTo')
	),
	array(
		'type'	=>	'text',
		'label' =>	'First Name',
		'field' =>	'firstname',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Last Name',
		'field' =>	'lastname',
		'req'	=>	true,
		'max'	=>	255, //if 0 no maxlength
		'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Job Title',
		'field' =>	'job_title',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Department',
		'field' =>	'department',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Contact Number',
		'field' =>	'contact_number',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Mobile Number',
		'field' =>	'mobile_number',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Fax Number',
		'field' =>	'fax_number',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'text',
		'label' =>	'Notes',
		'field' =>	'notes',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
	),
	array(
		'type'	=>	'password',
		'label' =>	'varkey',
		'field' =>	'varkey',
		//'req'	=>	false,
		'max'	=>	255, //if 0 no maxlength
		//'validator' => array('required')
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