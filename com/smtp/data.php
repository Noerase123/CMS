<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Mail Host',
		'field' =>	'smtp_host',
	),
	//array(
		//'type' 	=>	'select',
		//'label' =>	'Mail Port',
		//'field' =>	'smtp_port',
	//),
	array(
		'type' 	=>	'text',
		'label' =>	'Mail Username',
		'field' =>	'smtp_username',
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Mail Password',
		'field' =>	'smtp_password',
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