<?php#-----------------------------------------------------------------# Columns#-----------------------------------------------------------------$ow_shortcodes = array();// Custom$ow_shortcodes['header_0'] = array(    'type' => 'heading',    'title' => __('Homepage Shortcodes', 'ulysses'));// 01) Slider$ow_shortcodes['ulysses_slider'] = array( 	'type' => 'radios',	'title' => __(' 01) Home Slider ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		)	));// 02) Info Block$ow_shortcodes['ulysses_info'] = array( 	'type' => 'radios',	'title' => __(' 02) Info Block ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		)	));// 03) About Section$ow_shortcodes['ulysses_aboutus'] = array( 	'type' => 'radios',	'title' => __(' 03) About Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// 04) Statistics Section$ow_shortcodes['ulysses_statistics'] = array( 	'type' => 'radios',	'title' => __(' 04) Statistics Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		)	));// 05) Classes Section$ow_shortcodes['ulysses_classes'] = array( 	'type' => 'radios',	'title' => __(' 05) Classes Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));$ow_shortcodes['ulysses_bootcamp'] = array( 	'type' => 'radios',	'title' => __(' 05) Bootcamp Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// 06) Trainers Section$ow_shortcodes['ulysses_trainers'] = array( 	'type' => 'radios',	'title' => __(' 06) Trainer Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// 07) Purchase Section$ow_shortcodes['ulysses_purchase'] = array( 	'type' => 'radios',	'title' => __(' 07) Purchase Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		)	));// 08) Blog Section$ow_shortcodes['ulysses_blog'] = array( 	'type' => 'radios',	'title' => __(' 08) Blog Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// 09) Price Table$ow_shortcodes['ulysses_pricetable'] = array( 	'type' => 'radios',	'title' => __(' 09) Price Table Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		)	));// 10) Contact$ow_shortcodes['ulysses_contact'] = array( 	'type' => 'radios',	'title' => __(' 10) Contact Section ', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// Other$ow_shortcodes['header_2'] = array( 	'type' => 'heading',	'title' => __('Woocommerce', 'ulysses'));// Product Carousel$ow_shortcodes['ulysses_product_carousel'] = array( 	'type' => 'radios',	'title' => __('Product Carousel', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),	));// Other$ow_shortcodes['header_3'] = array( 	'type' => 'heading',	'title' => __('Other', 'ulysses'));// Testimonials Carousel$ow_shortcodes['ulysses_testimonial'] = array( 	'type' => 'radios',	'title' => __('Testimonials Carousel', 'ulysses'),	'attr' => array(		'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),		'title' => array(			'type' => 'text', 			'title' => __('Title', 'ulysses')		),		'sub_title' => array(			'type' => 'text', 			'title' => __('Sub Title', 'ulysses')		),	));// Timetable Section$ow_shortcodes['ulysses_timetable'] = array( 	'type' => 'radios',	'title' => __('Timetable Section', 'ulysses'),	'attr' => array(				'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),	));// Portfolio List/* $ow_shortcodes['ulysses_portfolio'] = array( 	'type' => 'radios',	'title' => __('Portfolio List', 'ulysses'),	'attr' => array(				'section_id' => array(			'type' => 'text', 			'title' => __('Section Name', 'ulysses')		),	)); */