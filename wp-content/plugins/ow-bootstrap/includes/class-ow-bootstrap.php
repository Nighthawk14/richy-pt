<?php

class OW_Bootstrap
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      OW_Bootstrap_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		$this->plugin_name = 'ow-bootstrap';
		$this->version = '1.0';

		$this->load_dependencies();

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies()
	{	
		if(!is_admin())
		{
			require_once plugin_dir_path( __FILE__ ) . 'shortcodes.php';
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ow-bootstrap-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ow-bootstrap-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/class-ow-bootstrap-lib.php';

		$this->loader = new OW_Bootstrap_Loader();
	}

	private function define_admin_hooks()
	{
		$plugin_admin = new OW_Bootstrap_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function define_public_hooks()
	{
		$plugin_public = new OW_Bootstrap_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}
}