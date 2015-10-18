<?php

function ulysses_timetable( $atts ){
	global $ulysses_option;

    extract(shortcode_atts(array(
		'section_id' => ''
    ), $atts));

   if( '' === $section_id ) :
        $section_id = __('timetable','ulysses');
   endif;

   // TIMETABLE 
   ob_start();
?>
	
	<div class="timetable" id="<?php echo $section_id ?>">
		<div class="container">
			<ul class="timetable-head">
				<li>&nbsp;</li>
				<li><?php _e( 'Monday', 'ulysses' ); ?></li>
				<li><?php _e( 'Tuesday', 'ulysses' ); ?></li>
				<li><?php _e( 'Wednesday', 'ulysses' ); ?></li>
				<li><?php _e( 'Thursday', 'ulysses' ); ?></li>
				<li><?php _e( 'Friday', 'ulysses' ); ?></li>
				<li><?php _e( 'Saturday', 'ulysses' ); ?></li>
				<li><?php _e( 'Sunday', 'ulysses' ); ?></li>
			</ul>
			<div class="timetable-item">
				<?php if($ulysses_option['on_off_time1'] == 1): ?>
				<ul>
					<li><?php _e( '09:00 - 10:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday1']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday1'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday1']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time2'] == 1): ?>
				<ul>
					<li><?php _e( '10:00 - 11:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday2']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday2'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday2']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time3'] == 1): ?>
				<ul>
					<li><?php _e( '11:00 - 12:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday3']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday3'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday3']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time4'] == 1): ?>
				<ul>
					<li><?php _e( '12:00 - 13:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday4']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday4'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday4']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time5'] == 1): ?>
				<ul>
					<li><?php _e( '13:00 - 14:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday5']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday5'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday5']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time6'] == 1): ?>
				<ul>
					<li><?php _e( '14:00 - 15:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday6']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday6'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday6']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time7'] == 1): ?>
				<ul>
					<li><?php _e( '15:00 - 16:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday7']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday7'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday7']; ?></li>
				</ul>
				<?php endif; ?>

				<?php if($ulysses_option['on_off_time8'] == 1): ?>
				<ul>
					<li><?php _e( '16:00 - 17:00', 'ulysses' ); ?></li>
					<li <?php if(!empty($ulysses_option['txt_monday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_monday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_tuesday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_tuesday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_wednesday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_wednesday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_thursday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_thursday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_friday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_friday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_saturday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_saturday8']; ?></li>
					<li <?php if(!empty($ulysses_option['txt_sunday8'])) : echo 'class="d-bg-c timetable-text"'; endif; ?>><?php echo $ulysses_option['txt_sunday8']; ?></li>
				</ul>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('ulysses_timetable', 'ulysses_timetable');
?>