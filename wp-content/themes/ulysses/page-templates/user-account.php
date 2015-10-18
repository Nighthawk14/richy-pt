<?php 
/*
	Template Name: User Account
*/

get_header(); ?>

	<!-- === START PATH === -->
	<div class="path-section">
		<div class="bg-cover">
			<div class="container">
				<h3><?php the_title(); ?></h3>
			</div>
		</div>
	</div>
	<!-- === END PATH === -->

	<!-- === START BLOG RIGHT SIDEBAR === -->
	<div class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div id="login-register-password">
						<?php
						// echo '<pre>'.the_ID().'</pre>';					
						global $user_ID, $user_identity;

						get_currentuserinfo();

						if (!$user_ID)
						{
							?>
							<ul class="tabs_login">
								<li class="active_login"><a href="#tab1_login"><?php _e( 'Login', 'ulysses' ); ?></a></li>
								<li><a href="#tab2_login"><?php _e( 'Register', 'ulysses' ); ?></a></li>
								<li><a href="#tab3_login"><?php _e( 'Forgot', 'ulysses' ); ?></a></li>
							</ul>
							<div class="tab_container_login">
								<div id="tab1_login" class="tab_content_login">
									<?php
									$register = isset($_GET['register']) ? $_GET['register'] : '';
									$reset = isset($_GET['reset']) ? $_GET['reset'] : '';

									if ($register == true)
									{
										?>
										<h3><?php _e( 'Success!', 'ulysses' ); ?></h3>
										<p><?php _e( 'Check your email for the password and then return to log in.', 'ulysses' ); ?></p>
										<?php
									}
									elseif ($reset == true)
									{
										?>
										<h3><?php _e( 'Success!', 'ulysses' ); ?></h3>
										<p><?php _e( 'Check your email to reset your password.', 'ulysses' ); ?></p>
										<?php
									}
									else
									{
										?>
										<h3><?php _e( 'Have an account?', 'ulysses' ); ?></h3>
										<p><?php _e( 'Log in or sign up! It&rsquo;s fast &amp; <em>free!</em>', 'ulysses' ); ?></p>
										<?php
									}
									?>
									<form method="post" action="<?php echo esc_url(home_url()) ?>/wp-login.php" class="wp-user-form">
										<div class="username">
											<label for="user_login"><?php _e('Username', 'ulysses'); ?>: </label>
											<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" required />
										</div>
										<div class="password">
											<label for="user_pass"><?php _e('Password', 'ulysses'); ?>: </label>
											<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" required />
										</div>
										<div class="login_fields">
											<div class="rememberme no-padding col-xs-4 col-md-3">
												<?php
												do_action('login_form');
												$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
												?>
												<input type="submit" name="user-submit" value="<?php _e('Login', 'ulysses'); ?>" tabindex="14" class="button user-submit" />
												<input type="hidden" name="redirect_to" value="<?php echo esc_url( get_permalink( get_page_by_title( 'My Account' ) ) ); ?>" />
												<input type="hidden" name="user-cookie" value="1" />
											</div>
											<div class="rememberme no-padding col-xs-8 col-md-3">
												<label for="rememberme">
													<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> <?php _e( 'Remember me', 'ulysses' ); ?>
												</label>
											</div>
										</div>
									</form>
								</div>
								<div id="tab2_login" class="tab_content_login" style="display:none;">
									<h3><?php _e( 'Register for this site!', 'ulysses' ); ?></h3>
									<p><?php _e( 'Sign up now for the good stuff.', 'ulysses' ); ?></p>
									<form method="post" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>" class="wp-user-form">
										<div class="username">
											<label for="user_login"><?php _e('Username', 'ulysses'); ?>: </label>
											<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" required />
										</div>
										<div class="password">
											<label for="user_email"><?php _e('Your Email', 'ulysses'); ?>: </label>
											<input type="email" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" required />
										</div>
										<div class="login_fields">
											<?php do_action('register_form'); ?>
											<input type="submit" name="user-submit" value="<?php _e('Sign up!', 'ulysses'); ?>" class="user-submit" tabindex="103" />
											<?php
											$register = isset($_GET['register']) ? $_GET['register'] : '';
											if($register == true)
											{
												echo '<p>Check your email for the password!</p>';
											}
											?>
											<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?register=true" />
											<input type="hidden" name="user-cookie" value="1" />
										</div>
									</form>
								</div>
								<div id="tab3_login" class="tab_content_login" style="display:none;">
									<h3><?php _e( 'Lose something?', 'ulysses' ); ?></h3>
									<p><?php _e( 'Enter your username or email to reset your password.', 'ulysses' ); ?></p>
									<form method="post" action="<?php echo esc_url(site_url('wp-login.php?action=lostpassword', 'login_post')); ?>" class="wp-user-form">
										<div class="username">
											<label for="user_login" class="hide"><?php _e('Username or Email', 'ulysses'); ?>: </label>
											<input type="email" name="user_login" value="" size="20" id="user_login" tabindex="1001" required />
										</div>
										<div class="login_fields">
											<?php do_action('login_form', 'resetpass'); ?>
											<input type="submit" name="user-submit" value="<?php _e('Reset my password', 'ulysses'); ?>" class="user-submit" tabindex="1002" required />
											<?php
											$reset = isset($_GET['reset']) ? $_GET['reset'] : '';
											if($reset == true)
											{
												echo '<p>A message will be sent to your email address.</p>';
											} ?>
											<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?reset=true" />
											<input type="hidden" name="user-cookie" value="1" />
										</div>
									</form>
								</div>
							</div>
							<?php
						}
						else
						{
							// is logged in ?>
							<div class="sidebox">
								<h5><?php _e( 'Welcome, ', 'ulysses' ); ?><?php echo esc_html( $user_identity ); ?></h5>
								<div class="col-md-2 usericon">
									<?php
									global $userdata;
									get_currentuserinfo();
									echo get_avatar($userdata->ID, 60);
									?>
								</div>
								<div class="userinfo col-md-10">
									<p><?php _e( 'You&rsquo;re logged in as ', 'ulysses' ); ?><strong><?php echo esc_html( $user_identity ); ?></strong></p>
									<p>
										<a href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>"><?php _e( 'Log out</a> | ', 'ulysses' ); ?>
										<?php
										if (current_user_can('manage_options'))
										{
											echo '<a href="' . esc_url(admin_url()) . '">' . __('Admin', 'ulysses') . '</a>';
										}
										else
										{ 
											echo '<a href="' . esc_url(admin_url()) . 'profile.php">' . __('Profile', 'ulysses') . '</a>';
										}
										?>
									</p>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- === END BLOG RIGHT SIDEBAR === -->
<?php get_footer(); ?>