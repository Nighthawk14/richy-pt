<?php

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

define('THEME_OPTIONS', get_template_directory_uri() . '/admin/theme-options');
define('THEME_URI', get_template_directory_uri());

/* Include Admin */
require_once( dirname( __FILE__ ) . '/admin/inc.php' );

if( ! is_admin() ) {
	/* Include Front-end */
	require_once( dirname( __FILE__ ) . '/include/inc.php' );

	if (file_exists(dirname( __FILE__ ) . '/woocommerce/inc.php' ))
	{
		/* Include Woocommerce */
		require_once( dirname( __FILE__ ) . '/woocommerce/inc.php' );
	}
}

if ( is_admin() && get_option('defaults_have_been_set') != 'yes') {
	set_default_settings();
}

function set_default_settings() {
	// changing WordPress default settings
	update_option("users_can_register", "1");
	add_option('defaults_have_been_set', 'yes', '', 'no');
}

/**
 * Set up the content width value based on the theme's design.
 *
 * @see ulysses_content_width()
 *
 * @since ulysses 1.0
 */
if ( ! isset( $content_width ) ) { $content_width = 474; }

/**
 * Adjust content_width value for image attachment template.
 *
 * @since ulysses 1.0
 */
function ulysses_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) { $GLOBALS['content_width'] = 810; }
}
add_action( 'template_redirect', 'ulysses_content_width' );

/**************************************************************************/

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since ulysses 1.0
 */
function ulysses_theme_setup() {

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css' ) );
	
	add_theme_support( "title-tag" );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );

	set_post_thumbnail_size( 672, 372, true );

	// add_image_size( 'thumb-1170-440', 1170, 440, true );
	add_image_size( 'thumb-136-91', 136, 91, true ); // woocommerce single thumbnails
	add_image_size( 'thumb-900-500', 900, 500, true ); //  post list thumbnail image
	add_image_size( 'thumb-1140-760', 1140, 760, true ); // woocommerce single image
	add_image_size( 'thumb-290-387', 290, 387, true );
	add_image_size( 'thumb-495-495', 495, 495, true );
	add_image_size( 'thumb-221-221', 221, 221, true ); // post tabs
	add_image_size( 'thumb-263-263', 263, 263, true ); // portfolio image
	add_image_size( 'thumb-120-120', 120, 120, true ); // services icon
	// add_image_size( 'thumb-350-178', 350, 178, true ); // services icon

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary menu', 'ulysses' ),
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
add_action( 'after_setup_theme', 'ulysses_theme_setup' );

/**************************************************************************/

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since ulysses 1.0
 */
function ulysses_enqueue_scripts() {
	global $ulysses_option;
	global $post;

	// load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'ie-css', get_template_directory_uri() . '/css/ie.css' , '20131205' );
	wp_style_add_data( 'ie-css', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	{
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'bootstrap-min', get_template_directory_uri() . '/libraries/bootstrap/bootstrap.min.css', array(), null );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/libraries/fonts/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/libraries/animate.css', array(), null );

	// load main stylesheet.
	wp_enqueue_style( 'main', get_stylesheet_uri(), null );	

	if(!empty($ulysses_option['opt-select-stylesheet'])) : 
		$active_css = $ulysses_option['opt-select-stylesheet'];
	else :
		$active_css = 'default.css';
	endif;

	wp_enqueue_style( 'responsive-media', get_template_directory_uri() . '/css/media.css', array(), null );

	/* Color Scheme */
	wp_enqueue_style( 'color-scheme', get_template_directory_uri() . '/color-box/color-scheme/'.$active_css, array(), null );
	wp_enqueue_style( 'redux', THEME_OPTIONS . '/assets/css/redux.css', array(), null );

	/* load fonts */
	wp_enqueue_style( 'Playfair-Display', '//fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic%7CMontserrat:400,700', array(), null, 'screen' );

	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/libraries/bootstrap/bootstrap.min.js', array( 'jquery' ),  null, true );

	// wp_enqueue_script( 'jquery.swipebox.min', get_template_directory_uri() . '/libraries/jquery.swipebox.min.js', array( 'jquery' ),  null, true );
	wp_enqueue_script( 'jquery-easing-min', get_template_directory_uri() . '/libraries/jquery.easing.min.js', array( 'jquery' ),  null, true );
	wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/libraries/jquery.appear.js', array( 'jquery' ),  null, true );
	wp_enqueue_script( 'wow-min', get_template_directory_uri() . '/libraries/wow.min.js', array( 'jquery' ),  null, true );

	$chkWooComm = "";
	if( function_exists( "is_woocommerce" ) ) 
	{
		if( !is_404() && !is_archive() && !is_search() && !is_woocommerce() )
		{
			if( has_shortcode($post->post_content, 'ulysses_blog') || has_shortcode($post->post_content, 'ulysses_product_carousel') || has_shortcode( $post->post_content, 'ulysses_trainers' ))
			{
				wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/libraries/owl-carousel/owl.carousel.css', array(), null );
				wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/libraries/owl-carousel/owl.carousel.js', array( 'jquery' ),  null, true );
			}

			if( has_shortcode($post->post_content, 'ulysses_slider') || has_shortcode($post->post_content, 'ulysses_classes')|| has_shortcode($post->post_content, 'ulysses_testimonial') )
			{
				wp_enqueue_script( 'jquery-flexslider-min', get_template_directory_uri() . '/libraries/flexslider/jquery.flexslider-min.js', array( 'jquery' ),  null, true );
			}

			if( has_shortcode($post->post_content, 'ulysses_statistics') )
			{
				wp_enqueue_script( 'jquery-animateNumber-min', get_template_directory_uri() . '/libraries/jquery.animateNumber.min.js', array( 'jquery' ),  null, true );
			}

			/* gMap */
			if( has_shortcode($post->post_content, 'ulysses_contact') )
			{
				wp_enqueue_script( 'gmap-api', 'https://maps.google.com/maps/api/js?sensor=false', array(), null, true );
				wp_enqueue_script( 'gmap', get_template_directory_uri() . '/libraries/jquery.gmap.min.js', array(), null, true );
			}
		}
	}
	else if ( !is_404() && !is_archive() && !is_search() ) 
	{

			if( has_shortcode($post->post_content, 'ulysses_blog') || has_shortcode($post->post_content, 'ulysses_product_carousel') || has_shortcode( $post->post_content, 'ulysses_trainers' ))
			{
				wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/libraries/owl-carousel/owl.carousel.css', array(), null );
				wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/libraries/owl-carousel/owl.carousel.js', array( 'jquery' ),  null, true );
			}

			if( has_shortcode($post->post_content, 'ulysses_slider') || has_shortcode($post->post_content, 'ulysses_classes')|| has_shortcode($post->post_content, 'ulysses_testimonial') )
			{
				wp_enqueue_script( 'jquery-flexslider-min', get_template_directory_uri() . '/libraries/flexslider/jquery.flexslider-min.js', array( 'jquery' ),  null, true );
			}

			if( has_shortcode($post->post_content, 'ulysses_statistics') )
			{
				wp_enqueue_script( 'jquery-animateNumber-min', get_template_directory_uri() . '/libraries/jquery.animateNumber.min.js', array( 'jquery' ),  null, true );
			}

			/* gMap */
			if( has_shortcode($post->post_content, 'ulysses_contact') )
			{
				wp_enqueue_script( 'gmap-api', 'https://maps.google.com/maps/api/js?sensor=false', array(), null, true );
				wp_enqueue_script( 'gmap', get_template_directory_uri() . '/libraries/jquery.gmap.min.js', array(), null, true );
			}
	}

	/* theme js */
	wp_enqueue_script( 'functions-main', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ),  null, true );
}
add_action( 'wp_enqueue_scripts', 'ulysses_enqueue_scripts' );

// IE8 
function ulysses_ie_scripts()
{
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5/html5shiv.js"></script>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5/respond.min.js"></script>
	<![endif]-->
	<?php
}
add_action( 'wp_head', 'ulysses_ie_scripts' );

/**************************************************************************/

/**
 * Enqueue scripts and styles for the admin
 *
 * @since ulysses 1.0
 */
function ulysses_admin_scripts()
{
	wp_enqueue_style( 'wp-admin-style', get_template_directory_uri() . '/admin/assets/css/admin.css', array(), null );
}
add_action( 'admin_enqueue_scripts', 'ulysses_admin_scripts' );

/**************************************************************************/

if ( ! function_exists( 'ulysses_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Ulysses 1.0
 */
function ulysses_comment_nav()
{
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'ulysses' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'ulysses' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'ulysses' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

/**************************************************************************/

/**
 * Extend the default WordPress body classes.
 *
 * @since ulysses 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function ulysses_body_classes( $classes )
{
	global $ulysses_option;

	if( $ulysses_option['opt-body-layout'] == 2 ):
		$classes[] = 'boxed';
	endif;

	if ( is_singular() && ! is_front_page() )
	{
		$classes[] = 'singular';
	}

	if( !is_front_page() )
	{
		$classes[] = 'single-page';
	}
	else
	{
		$classes[] = 'home-page';
	}

	return $classes;
}
add_filter( 'body_class', 'ulysses_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since ulysses 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function ulysses_post_classes( $classes )
{
	if ( ! is_attachment() && has_post_thumbnail() ) { $classes[] = 'has-post-thumbnail'; }
	return $classes;
}
add_filter( 'post_class', 'ulysses_post_classes' );

if ( ! function_exists( 'ulysses_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since ulysses 1.0
 */
function ulysses_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'ulysses' ),
		'next_text' => __( 'Next &rarr;', 'ulysses' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<!--h1 class="screen-reader-text"><?php // _e( 'Posts navigation', 'ulysses' ); ?></h1-->
		<div class="pagination loop-pagination">
			<ul class="pagination">
				<li> <?php echo esc_html( $links ); ?> </li>
			</ul>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'ulysses_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since ulysses 1.0
 */
function ulysses_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
 <div class="post-navigation">
		<!--h1 class="screen-reader-text"><?php // _e( 'Post navigation', 'ulysses' ); ?></h1-->
		 	
	<ul class="pager">
		<?php
		if ( is_attachment() ) :
			previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'ulysses' ) );
		else :
			previous_post_link( '<li class="previous">%link', __( 'Previous Post</li>', 'ulysses' ) );
			next_post_link( '<li class="next">%link', __( 'Next Post</li>', 'ulysses' ) );
		endif;
		?>
	</ul>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'ulysses_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since ulysses 1.0
 */
function ulysses_posted_on() {

	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="post-date updated entry-date" datetime="%2$s"><i></i>%3$s</time></a></span> <span class="byline"><i></i><span class="vcard author post-author"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since ulysses 1.0
 */
function ulysses_post_thumbnail() {
	if ( is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail(); ?>
	</a>

	<?php endif; // End is_singular()
}

/* ************************************************************************ */

function wpb_track_post_views ($post_id)
{
	if ( !is_single() ) return;
	if ( empty ( $post_id) )
	{
		global $post;
		$post_id = $post->ID;
	}
	wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_set_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);

	if($count=='')
	{
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}
	else
	{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

function wpb_get_post_views($postID)
{
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count=='')
	{
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count.' Views';
}

/* ************************************************************************ */

if( ! function_exists('ow_comment_form') ){

/**
 * Comment form
 */

function ow_comment_form($args = array(), $post_id = null )
{
    if ( null === $post_id )
	{
        $post_id = get_the_ID();
	}
    else
	{
        $id = $post_id;
	}

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		$req	=	get_option( 'require_name_email' );
		$aria_req	=	( $req ? " aria-required='true'" : '' );
		$html5	=	'html5' === $args['format'];
		$fields = array(
			'author' => '<div class="form-group"><div class="col-sm-6 comment-form-author"><input class="form-control"  id="author" placeholder="' . __( 'Name', 'ulysses' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></div>',
			'email'  => '<div class="col-sm-6 comment-form-email"><input id="email" class="form-control" name="email" placeholder="' . __( 'Email', 'ulysses' ) . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' required /></div></div>',
			'url'    => '<div class="form-group"><div class=" col-sm-12 comment-form-url">' . '<input class="form-control" placeholder="'. __( 'Website', 'ulysses' ) .'"  id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',
        );
		$required_text = sprintf( ' ' . __('Required fields are marked %s', 'ulysses'), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="form-group comment-form-comment"><div class="col-sm-12"><textarea class="form-control" id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', 'ulysses' ) . '" rows="8" aria-required="true"></textarea></div></div>',
			'must_log_in'          => '<div class="alert alert-danger must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</div>',
			'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ulysses' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</div>',
			'comment_notes_before' => '<div class="alert alert-info comment-notes">' . __( 'Your email address will not be published.', 'ulysses' ) . ( $req ? $required_text : '' ) . '</div>',
			'comment_notes_after'  => '<div class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'ulysses' ), ' <code>' . allowed_tags() . '</code>' ) . '</div>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply', 'ulysses' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'ulysses' ),
			'cancel_reply_link'    => __( 'Cancel reply', 'ulysses' ),
			'label_submit'         => __( 'Post Comment', 'ulysses' ),
			'format'               => 'xhtml',
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		if ( comments_open( $post_id ) )
		{
			do_action( 'comment_form_before' ); ?>

			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">
					<?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> 
					<small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
				</h3>
				<?php
				if ( get_option( 'comment_registration' ) && !is_user_logged_in() )
				{
					echo esc_html( $args['must_log_in'] );
					do_action( 'comment_form_must_log_in_after' );
				}
				else
				{
					?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="form-horizontal comment-form"<?php echo esc_html( $html5 ) ? ' novalidate' : ''; ?> role="form">
						<?php
						do_action( 'comment_form_top' );

						if ( is_user_logged_in() )
						{
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
						}
						else
						{
							echo $args['comment_notes_before'];

							do_action( 'comment_form_before_fields' );

							foreach ( (array) $args['fields'] as $name => $field )
							{
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}

							do_action( 'comment_form_after_fields' );
						}

						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); 

						echo $args['comment_notes_after']; ?>

						<div class="form-submit">
							<input class="btn btn-danger btn-lg" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</div>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
					<?php
				}
				?>
			</div><!-- #respond -->
			<?php
			do_action( 'comment_form_after' );
		}
		else
		{
			do_action( 'comment_form_comments_closed' );
		}
	}
}

function remove_empty_tags_around_shortcodes($content)
{
    $tags = array(
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br>' => ']',
        ']<br />' => ']'
    );
 
    $content = strtr($content, $tags);
    return $content;
}
add_filter('the_content', 'remove_empty_tags_around_shortcodes');