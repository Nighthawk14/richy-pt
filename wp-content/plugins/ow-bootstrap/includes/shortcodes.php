<?php

// Button
add_shortcode( 'ow_button', function( $atts, $content= null )
{
	$atts = shortcode_atts(

	array(
		'text'  => 'Button',
		'type'  => 'default',
		'size'  => '',
		'url'   => '#',
		'class' => '',
		'icon'  => '',
		'target'=>'_self'
	), $atts);

	extract($atts);

	$classes  = 'btn';
	$output   = $text;

	if($type) $classes .= ' btn-'. $type;
	if($size) $classes .= ' btn-'. $size;
	if($class) $classes .= ' '. $class;
	if($icon) $output = '<i class="' . $icon . '"></i> ' . $text;

	return '<a target="' . $target . '" href="' . $url . '" class="' . $classes . '">' .  do_shortcode($output)  . '</a>';
});

// Alert
add_shortcode( 'ow_alert', function( $atts, $content= null )
{
	$atts = shortcode_atts(
		array(
			"type" => 'info',
			"close" => 'no',
			"title" => '',
		), $atts
	);

	// extract($atts);
	$output = '<div class="alert' .  (($atts['type']=='none' ) ? '':' alert-'.$atts['type']) .  (($atts['close']=='no' ) ? '':' alert-dismissable') .' fade in">';

	if($atts['close']=='yes' )
	{
		$output .='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	}
	if( $atts['title']!='' )
	{
		$output .='<h4>'. $atts['title']. '</h4>';
	}
	$output .= do_shortcode($content);
	$output .='</div>';

	return $output;
});


// Button
add_shortcode( 'ow_block_heading', function( $atts, $content= null )
{
	$atts = shortcode_atts(

	array(
		'text'  => 'Button',
		'type'  => 'default',
		'size'  => '',
		'url'   => '#',
		'class' => '',
		'icon'  => '',
		'target'=>'_self'
	), $atts);

	extract($atts);

	$classes  = 'btn';
	$output   = $text;

	if($type) $classes .= ' btn-'. $type;
	if($size) $classes .= ' btn-'. $size;
	if($class) $classes .= ' '. $class;
	if($icon) $output = '<i class="' . $icon . '"></i> ' . $text;

	return '<a target="' . $target . '" href="' . $url . '" class="' . $classes . '">' .  do_shortcode($output)  . '</a>';
});

// Block Heading
add_shortcode( 'ow_block_heading', function( $atts, $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h1 class="styled">';
	$output .= $title;
	$output .= '</h1>';
	return $output;
});

// H1
add_shortcode( 'ow_h1_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h1>';
	$output .= $title;
	$output .= '</h1>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// H2
add_shortcode( 'ow_h2_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h2>';
	$output .= $title;
	$output .= '</h2>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// H3
add_shortcode( 'ow_h3_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h3>';
	$output .= $title;
	$output .= '</h3>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// H4
add_shortcode( 'ow_h4_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h4>';
	$output .= $title;
	$output .= '</h4>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// H5
add_shortcode( 'ow_h5_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h5>';
	$output .= $title;
	$output .= '</h5>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// H6
add_shortcode( 'ow_h6_heading', function( $atts=array(), $content=null )
{
	$atts = shortcode_atts(

	array(
		'title'  => 'title',
	), $atts);

	extract($atts);
	
	$output = '<h6>';
	$output .= $title;
	$output .= '</h6>';
	$output .= '<p>'.$content.'</p>';

	return $output;
});

// Columns
add_shortcode( 'ow_columns', function( $atts=array(), $content=null )
{
	$output = '<div class="row">';
	$output .= do_shortcode( str_replace('<p></p>', '', $content) );
	$output .= '</div>';
	return $output;
});

// Column
add_shortcode( 'ow_column', function( $atts, $content=null )
{
	$atts = shortcode_atts(
		array(
			'size' => '1',
			'title' => 'title'
		), $atts
	);

	$output = '<div class="col-md-'.$atts['size'].'">';
	$output .= '<h6>'.$atts['title'].'</h6>';
	$output .= '<p>'.do_shortcode( str_replace('<p></p>', '', $content) ).'</p>';
	$output .= '</div>';
	return $output;
});

// Accordion
add_shortcode( 'ulysses_accordion', function( $atts=array(), $content=null )
{
	$output = '<div class="panel-group" id="accordion">';
	$output .= do_shortcode( str_replace('<p></p>', '', $content) );
	$output .= '</div>';
	return $output;
});

// Toggle
add_shortcode( 'ulysses_toggle', function( $atts, $content=null )
{
	$atts = shortcode_atts(
		array(
			'title' => 'title',
			'id' => 'id'
		), $atts
	);
		
	$output = '<div class="panel panel-default">';
	$output .= '<div class="panel-heading"><h4 class="panel-title">';
	$output .= '<a data-toggle="collapse" data-parent="#accordion" href="#'.$atts['id'].'">'.$atts['title'].'</a></h4></div>';
	$output .= '<div id="'.$atts['id'].'" class="panel-collapse collapse">';
	$output .= '<div class="panel-body">'.do_shortcode( str_replace('<p></p>', '', $content) ).'</div></div></div>';
	return $output;
});

//Container
add_shortcode( 'ow_container', function( $atts, $content = null ) {
  $atts = shortcode_atts(
    array(
      'id'           => ''
      ), $atts);
  
  extract($atts);

  return '<div class="container" id="'.$id.'">' . do_shortcode( $content ) . '</div>';
});