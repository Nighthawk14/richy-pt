<?php

/**
 * Post Tabs Widget class
 *
 * @since 1.0
 */
class OW_Widget_Post_Tabs extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array('classname' => 'widget_post_tabs', 'description' => __( 'A Post View Tabs.', 'ulysses') );
		parent::__construct( 'post_tabs', _x( 'Ulysses :: Post Tabs', 'Post Tabs widget', 'ulysses' ), $widget_ops );
	}
	public function widget( $args, $instance )
	{
		echo $args['before_widget'];

		?>
		<div class="tab-widget">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#popular_posts" class="d-text-c-h" data-toggle="tab"><?php _e( 'Popular', 'ulysses' ); ?></a></li>
				<li><a href="#recent_posts" class="d-text-c-h" data-toggle="tab"><?php _e( 'Recent', 'ulysses' ); ?></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="popular_posts">
					<?php
					// WP_Query arguments
					$pp_args = array (
						'posts_per_page' => 2,
						'meta_key' => 'wpb_post_views_count',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					);

					// The Query
					$popularpost = new WP_Query($pp_args);

					if ( $popularpost->have_posts() )
					{
						while ( $popularpost->have_posts() ) : $popularpost->the_post();
							?>
							<div class="mini-post">
								<div class="mini-post-cover"><a href="#"><?php the_post_thumbnail('thumb-221-221'); ?></a></div>
								<h3><a href="<?php echo esc_url( get_permalink() ); ?>" class="d-text-c-h"><?php the_title(); ?></a></h3>
							</div>
							<?php
						endwhile;
					}

					// Restore original Post Data
					wp_reset_postdata();
					?>
			  </div>
			  <div class="tab-pane fade" id="recent_posts">
					<?php

					// WP_Query arguments
					$rp_args = array (
						'posts_per_page' => 2,
						'order' => 'ASC'
					);

					// The Query
					$recentpost = new WP_Query($rp_args);

					if ( $recentpost->have_posts() )
					{
						while ( $recentpost->have_posts() ) : $recentpost->the_post();
							?>
							<div class="mini-post">
								<div class="mini-post-cover"><a href="#"><?php the_post_thumbnail('thumb-221-221'); ?></a></div>
								<h3><a href="<?php echo esc_url( get_permalink() ); ?>" class="d-text-c-h"><?php the_title(); ?></a></h3>
								<!--h6>5 days ago</h6-->
							</div>
							<?php
						endwhile;
					}

					// Restore original Post Data
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		?>
		<p><?php _e( ' There is no need of setting for this widget ', 'ulysses' ); ?></p>
		<?php
	}
	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
}

/** My Twitter Widget
  * Objective:
  *		1.To list out the latest tweets
**/
class MY_Twitter extends WP_Widget {
	#1.constructor
	function MY_Twitter() {
		$widget_options = array("classname"=>'twitter_widget', 'description'=>'To Show latest twitter tweets');
		$this->WP_Widget(false,'Ulysses'.__(' Twitter Widget','ulysses'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array( 'title' => __('Latest Tweets','ulysses'), 'count' => '3', 'username' => '',
						'exclude_replies'=>'1' , 'time'=>'1', 'display_avatar'=>'0', 'consumer_key'=>'','consumer_secret'=>'','access_token'=>'','access_token_secret'=>'') );
						
		$title = 					empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
		$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
		$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
		$access_token_secret = 		empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
		$count = 					empty($instance['count']) ? '' : strip_tags($instance['count']);
		$username = 				empty($instance['username']) ? '' : strip_tags($instance['username']);
		$exclude_replies = 			empty($instance['exclude_replies']) ? 0 : 1;
		$time = 					empty($instance['time']) ? 0 : 1;
		$display_avatar = 			empty($instance['display_avatar']) ? 0 : 1;?>
        
        <p><label for="<?php echo esc_html( $this->get_field_id('title') ); ?>"><?php _e('Title:','ulysses');?> 
		   <input class="widefat" id="<?php echo esc_html( $this->get_field_id('title') ); ?>" name="<?php echo esc_html( $this->get_field_name('title') ); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

        <p><label for="<?php echo esc_html( $this->get_field_id('consumer_key') ); ?>"><?php _e('Consumer Key:','ulysses');?> 
		   <input class="widefat" id="<?php echo esc_html( $this->get_field_id('consumer_key') ); ?>" name="<?php echo esc_html( $this->get_field_name('consumer_key') ); ?>" 
            type="text" value="<?php echo esc_attr($consumer_key); ?>" /></label></p>
            
        <p><label for="<?php echo esc_html( $this->get_field_id('consumer_secret') ); ?>"><?php _e('Consumer Secret:','ulysses');?> 
		   <input class="widefat" id="<?php echo esc_html( $this->get_field_id('consumer_secret') ); ?>" name="<?php echo esc_html( $this->get_field_name('consumer_secret') ); ?>" 
            type="text" value="<?php echo esc_attr($consumer_secret); ?>" /></label></p>

        <p><label for="<?php echo esc_html( $this->get_field_id('access_token') ); ?>"><?php _e('Access Token:','ulysses');?> 
		   <input class="widefat" id="<?php echo esc_html( $this->get_field_id('access_token') ); ?>" name="<?php echo esc_html( $this->get_field_name('access_token') ); ?>" 
            type="text" value="<?php echo esc_attr($access_token); ?>" /></label></p>
            
        <p><label for="<?php echo esc_html( $this->get_field_id('access_token_secret') ); ?>"><?php _e('Access Token Secret:','ulysses');?> 
		   <input class="widefat" id="<?php echo esc_html( $this->get_field_id('access_token_secret') ); ?>" name="<?php echo esc_html( $this->get_field_name('access_token_secret') ); ?>" 
            type="text" value="<?php echo esc_attr($access_token_secret); ?>" /></label></p>

        <p><label for="<?php echo esc_html( $this->get_field_id('username') ); ?>"><?php _e('Enter your twitter username:','ulysses');?>
           <input class="widefat" id="<?php echo esc_html( $this->get_field_id('username') ); ?>" name="<?php echo esc_html( $this->get_field_name('username') ); ?>"
            type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
            
        <p><label for="<?php echo esc_html( $this->get_field_id('count') ); ?>"><?php _e('How many entries do you want to show:','ulysses');?>
        	<select class="widefat" id="<?php echo esc_html( $this->get_field_id('count') ); ?>" name="<?php echo esc_html( $this->get_field_name('count') ); ?>">
            <?php for($i = 1; $i <= 20; $i++):	
					$selected = ($count == $i ) ? "selected='selected'" : "";?>
	              <option <?php echo($selected);?> value="<?php echo($i);?>"><?php echo($i);?></option>
            <?php endfor;?>
            </select></label></p>
            
        <p><input type="checkbox" id="<?php echo esc_html( $this->get_field_id('exclude_replies') ); ?>" name="<?php echo esc_html( $this->get_field_name('exclude_replies') );?>" 
			<?php checked($exclude_replies); ?> /> <label for="<?php echo esc_html( $this->get_field_id('exclude_replies') ); ?>"><?php _e('Exclude @replies','ulysses');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo esc_html( $this->get_field_id('time') ); ?>" name="<?php echo esc_html( $this->get_field_name('time') );?>" 
			<?php checked($time); ?> /> <label for="<?php echo esc_html( $this->get_field_id('time') ); ?>"><?php _e('Show time of tweet','ulysses');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo esc_html( $this->get_field_id('time') ); ?>" name="<?php echo esc_html( $this->get_field_name('display_avatar') ); ?>" 
				<?php checked($display_avatar); ?> /> <label for="<?php echo esc_html( $this->get_field_id('display_avatar') ); ?>"><?php _e('Show user avatar','ulysses');?></label></p>		
	<?php
	}
	
	#3.processes & saves the twitter widget option
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = strip_tags($new_instance['consumer_key']);
		$instance['consumer_secret'] = strip_tags($new_instance['consumer_secret']);
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['exclude_replies'] = empty($new_instance['exclude_replies']) ? 0 : 1;
		$instance['time'] = empty($new_instance['time']) ? 0 : 1;
		$instance['display_avatar'] = empty($new_instance['display_avatar']) ? 0 : 1;
		return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
			$title = 			empty($instance['title']) ?	'' : strip_tags($instance['title']);
			$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
			$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
			$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
			$access_token_secret = 			empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
			$count = 			empty($instance['count']) ? '' : strip_tags($instance['count']);
			$username = 		empty($instance['username']) ? '' : strip_tags($instance['username']);
			$exclude_replies = 	empty($instance['exclude_replies']) ? false : true;
			$time = 			empty($instance['time']) ? false : true;
			$display_avatar = 	empty($instance['display_avatar']) ? false : true ;

		echo $before_widget;			
			
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
			
			if($username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 

					$transName = 'list_tweets';
					$cacheTime = 10;
			
					require_once 'twitteroauth/twitteroauth.php';
						$twitterConnection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret );
						$twitterData = $twitterConnection->get('statuses/user_timeline',array('screen_name' => $username, 'count' => $count,'exclude_replies' => $exclude_replies));
			
						 if($twitterConnection->http_code != 200) {
							 $twitterData = get_transient($transName);
						 }
			 
					set_transient($transName, $twitterData, 60 * 10);
					$twitter = get_transient($transName);
				
				echo "<ul class='twitter'>";
				if($twitter && is_array($twitter)) {
					foreach( $twitter as $tweet ):

						$latestTweet = $tweet->text;
						$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
						$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
						
						$twitterTime = strtotime($tweet->created_at);
						$twitterTime = !empty($tweet->utc_offset) ? $twitterTime+($tweet->utc_offset ) : $twitterTime;
						$timeAgo = date_i18n(  get_option('date_format'), $twitterTime ); 
						
						echo '<li class="tweet">';
								if( $display_avatar )
								echo '<div class="tweet-thumb"><a href="http://twitter.com/'.$username.'" title=""><img src="'.$tweet->user->profile_image_url.'" alt="" /></a></div>';
								echo '<div class="tweet-text avatar_'.$display_avatar.'">'.$latestTweet;
							
								if( $time )
								echo "<div class='tweet-time'>{$timeAgo}</div>";
						echo '</div></li>';

					endforeach;
				} else {
					echo '<li>'.__('No public Tweets found','ulysses').'</li>';
				}
				echo "</ul>";
			}
		echo $after_widget;
	}
}

/**
 * Social Icons Widget class
 *
 * @since 1.0
 */
class OW_Widget_Social_Icons extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array('classname' => 'widget_social_icons', 'description' => __( 'A Social Icons Widget.', 'ulysses') );
		parent::__construct( 'social_icons', _x( 'Ulysses :: Social Icons', 'Social Icons widget' , 'ulysses'), $widget_ops );
	}
	public function widget( $args, $instance )
	{
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget; // Widget starts to print information

		if ( $title )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$social_facebook = empty( $instance['social_facebook'] ) ? '' : $instance['social_facebook'];
		$social_twitter = empty( $instance['social_twitter'] ) ? '' : $instance['social_twitter'];
		$social_instagram = empty( $instance['social_instagram'] ) ? '' : $instance['social_instagram'];
		$social_googleplus = empty( $instance['social_googleplus'] ) ? '' : $instance['social_googleplus'];
		$social_rss = empty( $instance['social_rss'] ) ? '' : $instance['social_rss'];
		$social_pinterest = empty( $instance['social_pinterest'] ) ? '' : $instance['social_pinterest'];
		$social_linkedin = empty( $instance['social_linkedin'] ) ? '' : $instance['social_linkedin'];
		$social_vine = empty( $instance['social_vine'] ) ? '' : $instance['social_vine'];
		$social_vk = empty( $instance['social_vk'] ) ? '' : $instance['social_vk'];
		$social_skype = empty( $instance['social_skype'] ) ? '' : $instance['social_skype'];
		?>
		<ul class="socials">
			<?php if(!empty($social_facebook)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_facebook); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
			<?php if(!empty($social_twitter)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_twitter); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
			<?php if(!empty($social_instagram)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_instagram); ?>"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
			<?php if(!empty($social_googleplus)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_googleplus); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
			<?php if(!empty($social_rss)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_rss); ?>"><i class="fa fa-rss"></i></a></li><?php endif; ?>
			<?php if(!empty($social_pinterest)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_pinterest); ?>"><i class="fa fa-pinterest"></i></a></li><?php endif; ?>
			<?php if(!empty($social_linkedin)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
			<?php if(!empty($social_vine)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_vine); ?>"><i class="fa fa-vine"></i></a></li><?php endif; ?>
			<?php if(!empty($social_vk)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_vk); ?>"><i class="fa fa-vk"></i></a></li><?php endif; ?>
			<?php if(!empty($social_skype)): ?><li><a class="d-bg-c-h" href="<?php echo esc_url($social_skype); ?>"><i class="fa fa-skype"></i></a></li><?php endif; ?>
		</ul>
		<?php
		echo $after_widget; // Widget ends printing information
	}

	public function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );

		$title = $instance['title'];
		$social_facebook = $instance[ 'social_facebook' ];
		$social_twitter = $instance[ 'social_twitter' ];
		$social_instagram = $instance[ 'social_instagram' ];
		$social_googleplus = $instance[ 'social_googleplus' ];
		$social_rss = $instance[ 'social_rss' ];
		$social_pinterest = $instance[ 'social_pinterest' ];
		$social_linkedin = $instance[ 'social_linkedin' ];
		$social_vine = $instance[ 'social_vine' ];
		$social_vk = $instance[ 'social_vk' ];
		$social_skype = $instance[ 'social_skype' ];
		?>
		<p><label for="<?php echo esc_html( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('title') ); ?>" name="<?php echo esc_html( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_facebook') ); ?>"><?php _e('Facebook:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_facebook') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_facebook') ); ?>" type="text" value="<?php echo esc_attr($social_facebook); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_twitter') ); ?>"><?php _e('Twitter:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_twitter') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_twitter') ); ?>" type="text" value="<?php echo esc_attr($social_twitter); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_instagram') ); ?>"><?php _e('Instagram:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_instagram') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_instagram') ); ?>" type="text" value="<?php echo esc_attr($social_instagram); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_googleplus') ); ?>"><?php _e('Google Plus:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_googleplus') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_googleplus') ); ?>" type="text" value="<?php echo esc_attr($social_googleplus); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_rss') ); ?>"><?php _e('Rss:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_rss') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_rss') ); ?>" type="text" value="<?php echo esc_attr($social_rss); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_pinterest') ); ?>"><?php _e('Pinterest:', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_pinterest') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_pinterest') ); ?>" type="text" value="<?php echo esc_attr($social_pinterest); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_linkedin') ); ?>"><?php _e('Linkedin', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_linkedin') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_linkedin') ); ?>" type="text" value="<?php echo esc_attr($social_linkedin); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_vine') ); ?>"><?php _e('Vine', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_vine') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_vine') ); ?>" type="text" value="<?php echo esc_attr($social_vine); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_vk') ); ?>"><?php _e('VK', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_vk') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_vk') ); ?>" type="text" value="<?php echo esc_attr($social_vk); ?>" /></label></p>
		<p><label for="<?php echo esc_html( $this->get_field_id('social_skype') ); ?>"><?php _e('Skype', 'ulysses'); ?> <input class="widefat" id="<?php echo esc_html( $this->get_field_id('social_skype') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_skype') ); ?>" type="text" value="<?php echo esc_attr($social_skype); ?>" /></label></p>
		<?php
	}
	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['social_facebook'] = ( ! empty( $new_instance['social_facebook'] ) ) ? strip_tags( $new_instance['social_facebook'] ) : '';
		$instance['social_twitter'] = ( ! empty( $new_instance['social_twitter'] ) ) ? strip_tags( $new_instance['social_twitter'] ) : ''; 
		$instance['social_instagram'] = ( ! empty( $new_instance['social_instagram'] ) ) ? strip_tags( $new_instance['social_instagram'] ) : ''; 
		$instance['social_googleplus'] = ( ! empty( $new_instance['social_googleplus'] ) ) ? strip_tags( $new_instance['social_googleplus'] ) : ''; 
		$instance['social_rss'] = ( ! empty( $new_instance['social_rss'] ) ) ? strip_tags( $new_instance['social_rss'] ) : ''; 
		$instance['social_pinterest'] = ( ! empty( $new_instance['social_pinterest'] ) ) ? strip_tags( $new_instance['social_pinterest'] ) : ''; 
		$instance['social_linkedin'] = ( ! empty( $new_instance['social_linkedin'] ) ) ? strip_tags( $new_instance['social_linkedin'] ) : ''; 
		$instance['social_vine'] = ( ! empty( $new_instance['social_vine'] ) ) ? strip_tags( $new_instance['social_vine'] ) : ''; 
		$instance['social_vk'] = ( ! empty( $new_instance['social_vk'] ) ) ? strip_tags( $new_instance['social_vk'] ) : ''; 
		$instance['social_skype'] = ( ! empty( $new_instance['social_skype'] ) ) ? strip_tags( $new_instance['social_skype'] ) : ''; 

		return $instance;
	}
}

/**
 * Working Hours widget class
 *
 * @since 2.8.0
 */
class WP_Widget_WorkingHours extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_working_hours', 'description' => __('Arbitrary text or HTML.'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('text_working_hours', __('Ulysses : Working Hours'), $widget_ops, $control_ops);
	}

	public function widget( $args, $instance ) {

		global $ulysses_option;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'widget_working_hours', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="info-section">
			<div class="info-details d-bg-c">
				<ul class="ul-time">
					<?php
					if ( isset( $ulysses_option['opt_working_hours'] ) ) :	 
						$working_hours_list = $ulysses_option['opt_working_hours']; 
						if( count( $working_hours_list ) > 0 ) :
							foreach ( $working_hours_list as $key => $value ) :
								echo '<li>'.$working_hours_list[$key].'</li>';
							endforeach;
						endif;
					endif;
					?>
				</ul>
			</div>
			<div class="under-button">
				<span></span>
				<a href="<?php echo esc_url($ulysses_option['opt_block1_btn_url']); ?>" class="d-border-c d-bg-c-h d-text-c"><?php echo $ulysses_option['opt_block1_btn_txt']; ?></a>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<?php echo __('<b>Data Will Display From :</b> "Theme Setting > Header Settings > Header : Block 1"','ulysses'); ?>
		</p>
		<?php
	}
}

/**
 * What's Next widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Whats_Next extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_whats_next', 'description' => __('Arbitrary text or HTML.'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('whats_Next', __('Ulysses : What\'s Next'), $widget_ops, $control_ops);
	}

	public function widget( $args, $instance ) {

		global $ulysses_option;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'WP_Widget_Whats_Next', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="info-section">
			<div class="info-details info-details-center d-bg-c">
				<div class="info-image"><img src="<?php echo $ulysses_option['opt_block2_img']['url']; ?>" alt="image" /></div>
				<ul class="ul-calendar">
					<li>
						<span><?php echo $ulysses_option['opt_block2_cls1_title']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls1_time']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls1_person']; ?></span>
					</li>
					<li>
						<span><?php echo $ulysses_option['opt_block2_cls2_title']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls2_time']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls2_person']; ?></span>
					</li>
					<li>
						<span><?php echo $ulysses_option['opt_block2_cls3_title']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls3_time']; ?></span>
						<span><?php echo $ulysses_option['opt_block2_cls3_person']; ?></span>
					</li>
				</ul>
			</div>
			<div class="under-button">
				<span></span>
				<a href="<?php echo esc_url($ulysses_option['opt_block2_btn_url']); ?>" class="d-border-c d-bg-c-h d-text-c"><?php echo $ulysses_option['opt_block2_btn_txt']; ?></a>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<?php echo __('<b>Data Will Display From :</b> "Theme Setting > Header Settings > Header : Block 2"','ulysses'); ?>
		</p>
		<?php
	}
}

/**
 * Contact Info widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Contact_Info extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_contact_info', 'description' => __('Arbitrary text or HTML.'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('contact_info', __('Ulysses : Contact Info'), $widget_ops, $control_ops);
	}

	public function widget( $args, $instance ) {

		global $ulysses_option;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'WP_Widget_Contact_Info', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="info-section">
			<div class="info-details d-bg-c">
				<ul class="ul-contact">
					<li class="ul-contact-1">
						<?php echo $ulysses_option['opt_block3_address']; ?>
					</li>
					<li class="ul-contact-2">
						<span><?php echo $ulysses_option['opt_block3_contact1']; ?></span>
						<span><?php echo $ulysses_option['opt_block3_contact2']; ?></span>
					</li>
					<li class="ul-contact-3">
						<a href="mailto:<?php echo $ulysses_option['opt_block3_email']; ?>"><?php echo $ulysses_option['opt_block3_email']; ?></a>
					</li>
					<li class="ul-contact-4"><?php echo $ulysses_option['opt_block3_skype']; ?></li>
				</ul>
			</div>
			<div class="under-button">
				<span></span>
				<a href="<?php echo esc_url($ulysses_option['opt_block3_btn_url']); ?>" class="d-border-c d-bg-c-h d-text-c"><?php echo $ulysses_option['opt_block3_btn_txt']; ?></a>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<?php echo __('<b>Data Will Display From :</b> "Theme Setting > Header Settings > Header : Block 3"','ulysses'); ?>
		</p>
		<?php
	}
}

/* Widget Register / UN-register */
function ulysses_manage_widgets()
{
	register_widget( 'OW_Widget_Post_Tabs' );
	register_widget( 'OW_Widget_Social_Icons' );
	register_widget( 'MY_Twitter' );
	register_widget( 'WP_Widget_WorkingHours' );
	register_widget( 'WP_Widget_Whats_Next' );
	register_widget( 'WP_Widget_Contact_Info' );
}
add_action( 'widgets_init', 'ulysses_manage_widgets' );

/* ************************************************************************ */