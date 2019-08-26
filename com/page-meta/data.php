<?php 
//list of fields

//validator list required,remote,email,url,date,dateISO,dateDE,number,numberDE,digits,creditcard,equalTo,accept,maxlength,minlength,rangelength,range,max,min

$editor_fields = array(
	array(
		'type' 	=>	'text',
		'label' =>	'Page',
		'field' =>	'meta_page',
	),	
	array(
		'type' 	=>	'text',
		'label' =>	'Meta Title',
		'field' =>	'meta_title',
	),	
	array(
		'type' 	=>	'ckeditor',
		'label' =>	'Meta Keywords',
		'field' =>	'meta_keywords',
	),	
	array(
		'type' 	=>	'ckeditor',
		'label' =>	'Meta Description',
		'field' =>	'meta_description',
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