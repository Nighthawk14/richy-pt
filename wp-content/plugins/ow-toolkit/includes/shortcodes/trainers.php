<?php 
function ulysses_trainers( $atts )
	// START TRAINERS SECTION 
					$trainer_designation = get_post_meta(get_the_ID(), 'trainer_designation', true);
					$trainer_fb = get_post_meta(get_the_ID(), 'trainer_fb', true);