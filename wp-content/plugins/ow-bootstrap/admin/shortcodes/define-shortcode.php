<?php

$ow_shortcodes = array();

// Elements
$ow_shortcodes['header_4'] = array( 
	'type' => 'heading',
	'title' => __('Elements', 'ulysses')
);

// Container
$ow_shortcodes['ow_container'] = array( 
	'type'=>'simple', 
	'title'=>__('Container', 'ulysses'), 
	'attr' => array(		
		'id' => array(
			'type' => 'text',
			'title' => __('Container Id', 'ulysses')
		),
	)
);
	
$ow_shortcodes['ow_divider'] = array( 
    'type'=>'radios', 
    'title'=>__('Divider', 'ulysses'), 
    'attr'=>array(
		'size'=>array(
			'type'=>'select', 
			'title'=> __('Divider Size', 'ulysses'), 
			'values'=>array(
				'divider-default'   =>'Default',
				'divider-lg'        =>'Large',
				'divider-md'        =>'Medium',
				'divider-sm'        =>'Small',
				'divider-xs'        =>'Extra Small',
				)
        ),
    ) 
);	
	
// Block Heading
$ow_shortcodes['ow_block_heading'] = array( 
	'type'=>'radios', 
	'title'=>__('Block Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H1 Heading
$ow_shortcodes['ow_h1_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H1 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H2 Heading
$ow_shortcodes['ow_h2_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H2 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H3 Heading
$ow_shortcodes['ow_h3_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H3 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H4 Heading
$ow_shortcodes['ow_h4_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H4 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H5 Heading
$ow_shortcodes['ow_h5_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H5 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// H6 Heading
$ow_shortcodes['ow_h6_heading'] = array( 
	'type'=>'simple', 
	'title'=>__('H6 Heading', 'ulysses' ), 
	'attr' => array(		
		'title' => array(
			'type' => 'text',
			'title' => __('Title', 'ulysses')
		),
	)
);

// Columns
$ow_shortcodes['ow_columns'] = array(
	'type' => 'dynamic', 
	'title' => __('Columns', 'ulysses' ), 
	'attr' => array(
		'column' => array('type'=>'custom')
	)
);

// Accordion
$ow_shortcodes['ulysses_accordion'] = array( 
	'type' => 'dynamic',
	'title' => __('Accordion', 'ulysses'),
	'attr' => array(
		'accordion' => array('type'=>'custom')
	)
);

// Button
$ow_shortcodes['ow_button'] = array(
	'type' => 'radios',
	'title' => __('Button', 'ulysses'), 
	'attr' => array(
		'size' => array(
			'type' => 'select', 
			'title' => __('Button Size', 'ulysses'), 
			'values' => array(
				'' => 'Default',
				'xlg' => 'Extra Large',
				'lg' => 'Large',
				'sm' => 'Medium',
				'xs' => 'Small',
			)
		),
		'type' => array(
			'type' => 'select', 
			'title' => __('Button Type', 'ulysses'), 
			'values' => array(
				'default' => 'Default',
				'primary' => 'Primary',
				'success' => 'Success',
				'info' => 'Info',
				'warning' => 'Warning',
				'danger' => 'Danger',
				'link' => 'Link',
			)
		),
		'url' => array(
			'type' => 'text',
			'title' => __('Link URL', 'ulysses')
		),
		'text' => array(
			'type' => 'text',
			'title' => __('Text', 'ulysses')
		),
		/*
		'icon' => array(
			'type' => 'icon', 
			'title' => __('Select Icon', 'ulysses'),
			'values' => $fontawesome_icons,
		),
		*/
	)
);

// alert
$ow_shortcodes['ow_alert'] = array( 
	'type' => 'simple', 
	'title' => __('Alert', 'ulysses' ),
	'attr' => array(
		'close' => array(
			'type' => 'select', 
			'title' => __('Show Close Button', 'ulysses'), 
			'values' => array( 'no' => 'No', 'yes' => 'Yes' )
		),  
		'type' => array(
			'type' => 'select', 
			'title' => __('Alert Type', 'ulysses'), 
			'values' => array( 'none' => 'None', 'success' => 'Success', 'info' => 'Info', 'warning' => 'Warning', 'danger' => 'Danger' )
		),  
		'title' => array(
			'type' => 'text', 
			'title' => __('Alert Title', 'ulysses')
		),
	)
);