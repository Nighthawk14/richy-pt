<?php

if ( !class_exists("Redux_Framework_sample_config") )
{
    class Redux_Framework_sample_config
	{
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
		{
            if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
        }

        public function initSettings()
		{
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( !isset($this->args['opt_name']) )
			{
				return;
			}

            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css)
		{
			global $wp_filesystem;

			$filename = dirname(__FILE__) . '/assets/css/redux.css';

			if( empty( $wp_filesystem ) )
			{
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}

			if( $wp_filesystem )
			{
				$wp_filesystem->put_contents(
					$filename,
					$css,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
        function dynamic_section($sections)
		{
            $sections[] = array(
                'title' => __('Section via hook', 'ulysses'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'ulysses'),
                'icon' => 'el-icon-paper-clip',
                'fields' => array()
            );
            return $sections;
        }
        function change_arguments($args)
		{
            //$args['dev_mode'] = true;
            return $args;
        }
        function change_defaults($defaults)
		{
            $defaults['str_replace'] = "Testing filter hook!";
            return $defaults;
        }

        function remove_demo()
		{
            if (class_exists('ReduxFrameworkPlugin'))
			{
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }
        public function setSections()
		{
			// Background Patterns Reader			
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if ( is_dir($sample_patterns_path) ) :
                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();
                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false)
					{
                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false)
						{
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();			
            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'ulysses'), $this->theme->display('Name'));
			$sitename = get_bloginfo('name');
			$current_year = date('Y');
			$theme_info = wp_get_theme();
            ?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
				<?php if ($screenshot) : ?>
					<?php if (current_user_can('edit_theme_options')) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
					<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
				<?php endif; ?>
				<h4><?php echo esc_html( $this->theme->display('Name') ); ?></h4>
				<div>
					<ul class="theme-info">
					<li><?php printf(__('By %s', 'ulysses'), $this->theme->display('Author')); ?></li>
					<li><?php printf(__('Version %s', 'ulysses'), $this->theme->display('Version')); ?></li>
					<li><?php echo '<strong>' . __('Tags', 'ulysses') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo esc_html( $this->theme->display('Description') ); ?></p>
					<?php
					if ($this->theme->parent())
					{
						printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'ulysses'), $this->theme->parent()->display('Name'));
					}
					?>
				</div>
			</div>

            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html'))
			{
                global $wp_filesystem;
                if (empty($wp_filesystem))
				{
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

			if ( empty($alt_stylesheets) )
			{
				$alt_stylesheets = "";
			}
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Header Settings', 'ulysses'),
				'icon' => 'el-icon-paper-clip',
				'subsection' => true,
				'fields' => array(
					/*
                    array(
                        'id'        => 'opt_fa_icon',
                        'type'      => 'ow_fa',
                        'title'     => __('Fontawesome Icon', 'ulysses'),
                    ),					
                    array(
                        'id'        => 'opt_icon',
                        'type'      => 'ow_icons',
                        'title'     => __('Fontawesome Icon', 'ulysses'),
                    ),
					*/
                    array(
                        'id'        => 'opt_favicon_logo',
                        'type'      => 'media',
                        'title'     => __('Favicon Icon', 'ulysses'),
						'default'  => array(
							'url'=> get_template_directory_uri() . '/images/favicon.ico'
						),
                    ),
                    array(
                        'id'        => 'opt_site_logo',
                        'type'      => 'media',
                        'title'     => __('Site logo (205x65px recommended)', 'ulysses'),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo.png',
							'width' => '200',
							'height' => '65',
						),
                    ),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'icon_type' => 'image',
				'title' => __('Header : Block 1', 'ulysses'),
				'subsection' => true,
				'fields' => array(
                    array(
                        'id'        => 'opt_header_info',
                        'type'      => 'info',
                        'title'     => __('Working Hours', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block1_title',
                        'type'      => 'text',
                        'title'     => __('Block Title', 'ulysses'),
						'default'	=> 'Working Hours'
                    ),
                    array(
                        'id'        => 'opt_block1_btn_txt',
                        'type'      => 'text',
                        'title'     => __('Button Text', 'ulysses'),
						'default'	=> 'Join Us'
                    ),
                    array(
                        'id'        => 'opt_block1_btn_url',
                        'type'      => 'text',
                        'title'     => __('Button URL', 'ulysses'),
						'default'	=> '#'
                    ),
					array(
						'id'        => 'opt_working_hours',
						'type'      => 'multi_text',
						'title'     => __('Time/Date & Days', 'ulysses'),
						'default'  =>__(
							array(
								'Monday 9.00 - 17.00',
								'Tuesday 9.00 - 20.00',
								'Wednesday 9.00 - 20.00',
								'Thursday 9.00 - 20.00',
								'Friday 9.00 - 19.00',
								'Saturday 9.00 - 15.00',
								'Sunday 9.00 - 12.00'
							), 'ulysses'
						),
                    ),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'icon_type' => 'image',
				'title' => __('Header : Block 2', 'ulysses'),
				'subsection' => true,
				'fields' => array(
					array(
                        'id'        => 'opt_header_info',
                        'type'      => 'info',
                        'title'     => __('What is Next', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_title',
                        'type'      => 'text',
                        'title'     => __('Block Title', 'ulysses'),
						'default'	=> 'WHATS NEXT?'
                    ),
					array(
                        'id'        => 'opt_block2_img',
                        'type'      => 'media',
                        'title'     => __('Block Image', 'ulysses'),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/info-img.jpg',
							'width' => '200',
							'height' => '65',
						),
                    ),
                    array(
                        'id'        => 'opt_block2_btn_txt',
                        'type'      => 'text',
                        'title'     => __('Button Text', 'ulysses'),
						'default'	=> 'View Timetable'
                    ),
                    array(
                        'id'        => 'opt_block2_btn_url',
                        'type'      => 'text',
                        'title'     => __('Button URL', 'ulysses'),
						'default'	=> '#'
                    ),
					array(
                        'id'        => 'opt_header_block2_cls1',
                        'type'      => 'info',
                        'title'     => __('Class 1', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls1_title',
                        'type'      => 'text',
                        'title'     => __('Title', 'ulysses'),
						'default'	=> __('YOGA', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls1_time',
                        'type'      => 'text',
                        'title'     => __('Time', 'ulysses'),
						'default'	=> __('Room C 9.00 - 10.00', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls1_person',
                        'type'      => 'text',
                        'title'     => __('Name', 'ulysses'),
						'default'	=> __('Amanda Bale', 'ulysses'),
                    ),
					array(
                        'id'        => 'opt_header_block2_cls2',
                        'type'      => 'info',
                        'title'     => __('Class 2', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls2_title',
                        'type'      => 'text',
                        'title'     => __('Title', 'ulysses'),
						'default'	=> __('FITNESS', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls2_time',
                        'type'      => 'text',
                        'title'     => __('Time', 'ulysses'),
						'default'	=> __('Room B 11.00 - 14.00', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls2_person',
                        'type'      => 'text',
                        'title'     => __('Name', 'ulysses'),
						'default'	=> __('Jana Doe', 'ulysses'),
                    ),
					array(
                        'id'        => 'opt_header_block2_cls3',
                        'type'      => 'info',
                        'title'     => __('Class 3', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls3_title',
                        'type'      => 'text',
                        'title'     => __('Title', 'ulysses'),
						'default'	=> __('BOX', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls3_time',
                        'type'      => 'text',
                        'title'     => __('Time', 'ulysses'),
						'default'	=> __('Room A 16.00 - 18.00', 'ulysses'),
                    ),
                    array(
                        'id'        => 'opt_block2_cls3_person',
                        'type'      => 'text',
                        'title'     => __('Name', 'ulysses'),
						'default'	=> __('Alex Krasnov', 'ulysses'),
                    ),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'icon_type' => 'image',
				'title' => __('Header : Block 3', 'ulysses'),
				'subsection' => true,
				'fields' => array(
					array(
                        'id'        => 'opt_header_info',
                        'type'      => 'info',
                        'title'     => __('Contact info', 'ulysses'),
                    ),
					array(
                        'id'        => 'opt_block3_title',
                        'type'      => 'text',
                        'title'     => __('Block Title', 'ulysses'),
						'default'	=> 'Contact Info'
                    ),
					array(
                        'id'        => 'opt_block3_address',
                        'type'      => 'text',
                        'title'     => __('Contact Address', 'ulysses'),
						'default'	=> '<span>Trafalgar Square</span><span>70567 PO 345 London</span><span>United Kingdom</span>'
                    ),
					array(
                        'id'        => 'opt_block3_contact1',
                        'type'      => 'text',
                        'title'     => __('Contact No 1', 'ulysses'),
						'default'	=> '+ 555 789 678 45'
                    ),
					array(
                        'id'        => 'opt_block3_contact2',
                        'type'      => 'text',
                        'title'     => __('Contact No 2', 'ulysses'),
						'default'	=> '+ 555 456 678 90'
                    ),
					array(
                        'id'        => 'opt_block3_email',
                        'type'      => 'text',
                        'title'     => __('Contact Email', 'ulysses'),
						'default'	=> 'example@mail.com'
                    ),
					array(
                        'id'        => 'opt_block3_skype',
                        'type'      => 'text',
                        'title'     => __('Skype ID', 'ulysses'),
						'default'	=> 'ulysses.training'
                    ),
                    array(
                        'id'        => 'opt_block3_btn_txt',
                        'type'      => 'text',
                        'title'     => __('Button Text', 'ulysses'),
						'default'	=> 'Contact Us'
                    ),
                    array(
                        'id'        => 'opt_block3_btn_url',
                        'type'      => 'text',
                        'title'     => __('Button URL', 'ulysses'),
						'default'	=> '#'
                    ),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Body Settings', 'ulysses'),
				'icon' => 'el-icon-check-empty',
				'fields' => array(
					array(
						'id' => 'opt-background',
						'type' => 'background',
						'title' => __('Body Background', 'redux-framework-demo'),
						'subtitle' => __('Body background image', 'redux-framework-demo'),
						'compiler'  => array( 'body' ),
					),
					array(
						'id'       => 'opt-body-layout',
						'type'     => 'image_select',
						'title'    => __( 'Layout type', 'redux-framework-demo' ),
						'options'  => array(
							'1' => array( 'title' => 'Wide', 'img' => THEME_OPTIONS . '/assets/images/1c.png' ),
							'2' => array( 'title' => 'Boxed', 'img' => THEME_OPTIONS . '/assets/images/3cm.png' ),
						),
						'default'  => '1'
					),
					array(
						'id'       => 'opt-select-stylesheet',
						'type'     => 'select',
						'title'    => __( 'Site Color', 'redux-framework-demo' ),
						'subtitle' => __( 'Select your themes alternative color scheme.', 'redux-framework-demo' ),
						'options'  => array(
							'default.css' => 'Default Color',
							'color1.css' => 'Color Style 1',
							'color2.css' => 'Color Style 2',
							'color3.css' => 'Color Style 3',
							'color4.css' => 'Color Style 4'
						),
						'default'  => 'default.css',
					),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Page Section', 'ulysses'),
				'icon' => 'el-icon-file',
				'fields' => array(
				)
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('About Block', 'ulysses'),
				'subsection' => true,
				'fields' => array(
					array(
						'id'        => 'opt_about_left_img',
						'type'      => 'media',
						'title'     => __('About Block Image (Suitable size is 570x532px)', 'ulysses'),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/presentation.png',
							'width' => '200',
							'height' => '65',
						),
					),
					array(
						'id'=>'opt_about_content',
						'type' => 'slides',
						'title' => __('Block Content', 'ulysses'),
						'placeholder' => array(
							'title'           => __('Service title Here', 'ulysses'),
							'description'     => __('Service Description Here', 'ulysses'),
							'url'             => __('Set Service Redirection Link Here!', 'ulysses'),
						),
					),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Contact Section', 'ulysses'),
				'subsection' => true,
				'fields' => array(                    
					array(
						'id'=>'opt_contact_email',
						'type' => 'text',
						'title' => __('Email', 'ulysses'),
						'subtitle' => __('Sets the email for the contact map.', 'ulysses'),
						'validate' => 'email',
						'msg' => __('Enter a valid email address.', 'ulysses'),
						'default' => 'example@mail.com'
					),
					array(
						'id'=>'opt_contact_iframe',
						'type' => 'text',
						'title' => __('Contact Form 7 Shortcode', 'ulysses'),
						'subtitle' => __('Here Add Contact Form 7 Shortcode, e.g : [contact-form-7 id="266" title="Contact form 1"]', 'ulysses'),
					),
					array(
                        'id'        => 'opt_contact_address',
                        'type'      => 'text',
						'title'     => __('Address', 'ulysses'),
						'default'  =>__('38-44 Amethyst Way, San Francisco, CA 94131, USA', 'ulysses'),
                    ),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Statistics Section', 'ulysses'),
				'subsection' => true,
				'fields' => array(
                    array(
						'id'=>'opt_statistics',
						'type' => 'slides',
						'title' => __('Block Content', 'ulysses'),
						'placeholder' => array(
							'title'           => __('Statistics Number', 'ulysses'),
							'description'     => __('Statistics Title', 'ulysses'),
							'url'             => __('Statistics URL', 'ulysses'),
						),
					),
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Purchase Section', 'ulysses'),
				'subsection' => true,
				'fields' => array(					
                    array(
                        'id'        => 'opt_purchase_subtitle',
                        'type'      => 'text',
                        'title'     => __('Sub Title', 'ulysses'),
                        'default'     => 'Already excited with the seen?',
                    ),
                    array(
                        'id'        => 'opt_purchase_title',
                        'type'      => 'text',
                        'title'     => __('Title', 'ulysses'),
                        'default'     => 'Purchase ulysses now',
                    ),
                    array(
                        'id'        => 'opt_purchase_btn_txt',
                        'type'      => 'text',
                        'title'     => __('Button Text', 'ulysses'),
                        'default'     => 'Buy it now',
                    ),
                    array(
                        'id'        => 'opt_purchase_btn_url',
                        'type'      => 'text',
                        'title'     => __('Button URL', 'ulysses'),
                        'default'     => 'http://themeforest.net/user/geothemes/portfolio?ref=geothemes',
                    )
				),
			);
			/* **************************************************************************** */
			$this->sections[] = array(
				'title' => __('Timetable Page', 'ulysses'),
				'subsection' => true,
				'fields' => array(
					// 1
                    array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('09:00 - 10:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time1',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
					array(
						'id'    => 'txt_monday1',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('Cardio <span>09:00 - 10:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday1',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('Gymnastics <span>09:00 - 10:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday1',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday1',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday1',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('Boxing <span>09:00 - 11:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday1',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('Cardio <span>09:00 - 10:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday1',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('Yoga <span>09:30 - 11:00</span>', 'ulysses'),
					),
					// 2
                    array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('10:00 - 11:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time2',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday2',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('Cardio <span>09:00 - 10:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday2',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday2',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('Boxing <span>10:30 - 12:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday2',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('Yoga <span>10:00 - 11:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday2',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('Boxing <span>10:30 - 12:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday2',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday2',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('Yoga <span>09:30 - 11:00</span>', 'ulysses'),
					),
					// 3
                    array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('11:00 - 12:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time3',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday3',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday3',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('Pilates <span>11:00 - 13:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday3',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('Boxing <span>10:30 - 12:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday3',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday3',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday3',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('Gymnastics <span>11:00 - 13:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday3',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
					// 4
                    array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('12:00 - 13:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time4',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday4',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday4',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('Boxing <span>11:00 - 13:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday4',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday4',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('Boxing <span>12:00 - 14:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday4',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('Pilates <span>12:00 - 13:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday4',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('Gymnastics <span>11:00 - 13:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday4',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('Boxing <span>12:00 - 13:00</span>', 'ulysses'),
					),
					// 5
					array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('13:00 - 14:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time5',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday5',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('Yoga <span>13:00 - 15:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday5',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday5',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('Yoga <span>13:00 - 14:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday5',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('Boxing <span>12:00 - 14:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday5',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('Pilates <span>12:00 - 13:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday5',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday5',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
					// 6
					array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('14:00 - 15:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time6',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday6',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('Yoga <span>13:00 - 15:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday6',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('Boxing <span>12:00 - 15:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday6',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday6',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('Gymnastics <span>14:30 - 16:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday6',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday6',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday6',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('Pilates <span>14:00 - 16:00</span>', 'ulysses'),
					),
					// 7
					array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('15:00 - 16:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time7',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday7',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday7',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('Boxing <span>14:00 - 15:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday7',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('Cardio <span>15:00 - 17:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday7',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('Gymnastics <span>14:30 - 16:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday7',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday7',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('Boxing <span>15:00 - 16:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday7',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('Pilates <span>14:00 - 16:00</span>', 'ulysses'),
					),
					// 8
                    array(
						'id'    => 'info_timetable',
						'type'  => 'info',
						'desc'  => __('16:00 - 17:00', 'ulysses'),
					),
					array(
						'id'       => 'on_off_time8',
						'type'     => 'switch',
						'title'    => __( 'Display Time', 'ulysses' ),
						'default'  => 1,
						'on'       => 'Enabled',
						'off'      => 'Disabled',
					),
                    array(
						'id'    => 'txt_monday8',
						'type'  => 'text',
						'title'     => __('Monday', 'ulysses'),
						'default'  => __('Fitness <span>16:00 - 17:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_tuesday8',
						'type'  => 'text',
						'title'     => __('Tuesday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_wednesday8',
						'type'  => 'text',
						'title'     => __('Wednesday', 'ulysses'),
						'default'  => __('Cardio <span>15:00 - 17:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_thursday8',
						'type'  => 'text',
						'title'     => __('Thursday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
                    array(
						'id'    => 'txt_friday8',
						'type'  => 'text',
						'title'     => __('Friday', 'ulysses'),
						'default'  => __('Cardio <span>16:00 - 17:00</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_saturday8',
						'type'  => 'text',
						'title'     => __('Saturday', 'ulysses'),
						'default'  => __('Boxing <span>15:00 - 16:30</span>', 'ulysses'),
					),
                    array(
						'id'    => 'txt_sunday8',
						'type'  => 'text',
						'title'     => __('Sunday', 'ulysses'),
						'default'  => __('', 'ulysses'),
					),
				),
			);
			/* **************************************************************************** */			
			/*$this->sections[] = array(
                'title'     => __('Advanced Styling', 'ulysses'),
				'icon' => 'el-icon-cogs',
                'fields'    => array(
					array(
                        'id'        => 'opt_dynamic_css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'ulysses'),
                        'subtitle'  => __('Paste your CSS code here.', 'ulysses'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
					),
                )
            );*/
			/* **************************************************************************** */
			$this->sections[] = array(
                'title'     => __('Footer Settings', 'ulysses'),
				'icon' => 'el-icon-website',
                'fields'    => array(
					array(
						'id'    => 'info_footer_social',
						'type'  => 'info',
						'desc'  => __('Footer Social Options', 'ulysses'),
					),
					array(
                        'id'        => 'opt_icons_footer',
                        'type'      => 'slides',
                        'title'     => __('Social Icons Footer', 'ulysses')
                    ),
					/******************************************************/
                    array(
						'id'    => 'info_copyright_text',
						'type'  => 'info',
						'desc'  => __('Copyright Text Options', 'ulysses'),
					),
					array(
                        'id'        => 'opt_copyright_text',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'ulysses'),
                        'default' => '&copy; Copyright 2015 by GeoThemes. All rights reserved.',
                    ),
                )
            );
			/* **************************************************************************** */
        }

        /**
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		*/
        public function setArguments()
		{
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'ulysses_option', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Settings', 'ulysses'),
                'page_title' => __('Theme Settings', 'ulysses'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                //'async_typography' => false, // Use a asynchronous font on the front end or font string
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
				'customizer' => false,
                'output' => '1', // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => '1', // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                'footer_credit'      	=> '', // DisableDisable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false)
			{
                if (!empty($this->args['global_variable']))
				{
                    $v = $this->args['global_variable'];
                }
				else
				{
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
            }
			else
			{
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'ulysses');
            }
        }
    }
    new Redux_Framework_sample_config();
}

/*
	Custom function for the callback referenced above
*/
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value)
	{
        print_r($field);
        print_r($value);
    }
endif;

/*
  Custom function for the callback validation referenced above
*/
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value)
	{
        $error = false;
        $value = 'just testing';

        $return['value'] = $value;
        if ($error == true)
		{
            $return['error'] = $field;
        }
        return $return;
    }
endif;