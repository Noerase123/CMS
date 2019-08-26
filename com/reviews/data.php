<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Title',
		'field' =>	'review_title',
	),

	array(
		'type'	=>	'image',
		'label' =>	'Avatar Image',
		'field' =>	'review_image',
		'req'	=>	true,
		'size' 	=>	array(
						'width'	=>	80,
						'height'=>	80
		),
		//'support'	=> array('jpe?g','jpg'),
		//'validator' => array('accept','required'),
		'note'		=> ''
	),

	array(
		'type' 	=>	'text',
		'label' =>	'Name',
		'field' =>	'review_name',
	),
	
	array(
		'type' 	=>	'ckeditor',
		'label' =>	'Review Description',
		'field' =>	'review_description',
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