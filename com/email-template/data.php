<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'From',
		'field' =>	'contact_from',
		'req'	=>	false
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Cc',
		'field' =>	'contact_cc',
		'req'	=>	false
	),
	array(
		'type' 	=>	'text',
		'label' =>	'Bcc',
		'field' =>	'contact_bcc',
		'req'	=>	false
	),
	array(
		'type' 	=>	'ckeditor',
		'label' =>	'Receiver Message',
		'field' =>	'contact_message',
		'req'	=>	false
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