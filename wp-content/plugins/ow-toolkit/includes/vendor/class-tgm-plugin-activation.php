<?php 
/**
 * Plugin installation and activation for WordPress themes.
 *
 * @package   TGM-Plugin-Activation
 * @version   2.4.0
 * @author    Thomas Griffin <thomasgriffinmedia.com>
 * @author    Gary Jones <gamajo.com>
 * @copyright Copyright (c) 2012, Thomas Griffin
 * @license   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
    /**
     * Automatic plugin installation and activation library.
     *
     * Creates a way to automatically install and activate plugins from within themes.
     * The plugins can be either pre-packaged, downloaded from the WordPress
     * Plugin Repository or downloaded from a private repository.
     *
     * @since 1.0.0
     *
     * @package TGM-Plugin-Activation
     * @author  Thomas Griffin <thomasgriffinmedia.com>
     * @author  Gary Jones <gamajo.com>
     */
    class TGM_Plugin_Activation {
        /**
         * Holds a copy of itself, so it can be referenced by the class name.
         *
         * @since 1.0.0
         *
         * @var TGM_Plugin_Activation
         */
        public static $instance;
        /**
         * Holds arrays of plugin details.
         *
         * @since 1.0.0
         *
         * @var array
         */
        public $plugins = array();
        /**
         * Name of the querystring argument for the admin page.
         *
         * @since 1.0.0
         *
         * @var string
         */
        public $menu = 'tgmpa-install-plugins';
        /**
         * Default absolute path to folder containing pre-packaged plugin zip files.
         *
         * @since 2.0.0
         *
         * @var string Absolute path prefix to packaged zip file location. Default is empty string.
         */
        public $default_path = '';
        /**
         * Flag to show admin notices or not.
         *
         * @since 2.1.0
         *
         * @var boolean
         */
        public $has_notices = true;
        /**
         * Flag to determine if the user can dismiss the notice nag.
         *
         * @since 2.4.0
         *
         * @var boolean
         */
        public $dismissable = true;
        /**
         * Message to be output above nag notice if dismissable is false.
         *
         * @since 2.4.0
         *
         * @var string
         */
        public $dismiss_msg = '';
        /**
         * Flag to set automatic activation of plugins. Off by default.
         *
         * @since 2.2.0
         *
         * @var boolean
         */
        public $is_automatic = false;
        /**
         * Optional message to display before the plugins table.
         *
         * @since 2.2.0
         *
         * @var string Message filtered by wp_kses_post(). Default is empty string.
         */
        /**
         * Holds configurable array of strings.
         *
         * Default values are added in the constructor.
         *
         * @since 2.0.0
         *
         * @var array
         */
        public $strings = array();
        /**
         * Holds the version of WordPress.
         *
         * @since 2.4.0
         *
         * @var int
         */
        public $wp_version;
        /**
         * Adds a reference of this object to $instance, populates default strings,
         * does the tgmpa_init action hook, and hooks in the interactions to init.
         *
         * @since 1.0.0
         *
         * @see TGM_Plugin_Activation::init()
         */
        public function __construct() {
            self::$instance = $this;
            $this->strings = array(
                'page_title'                     => __( 'Install Required Plugins', 'tgmpa' ),
                'menu_title'                     => __( 'Install Plugins', 'tgmpa' ),
                'installing'                     => __( 'Installing Plugin: %s', 'tgmpa' ),
                'oops'                           => __( 'Something went wrong.', 'tgmpa' ),
                'notice_can_install_required'    => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
                'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
                'notice_cannot_install'          => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
                'notice_can_activate_required'   => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
                'notice_can_activate_recommended'=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
                'notice_cannot_activate'         => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
                'notice_ask_to_update'           => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
                'notice_cannot_update'           => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
            // Set the current WordPress version.
            // When the rest of WP has loaded, kick-start the rest of the class.
        /**
        public function init() {
                foreach ( $this->plugins as $plugin ) {
                    $sorted[] = $plugin['name'];
                }
                array_multisort( $sorted, SORT_ASC, $this->plugins );
                    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
                if ( $this->has_notices ) {
                // Setup the force activation hook.
                // Setup the force deactivation hook.
                foreach ( $this->plugins as $plugin ) {
        /**
        public function admin_init() {
            if ( ! $this->is_tgmpa_page() ) {
            if ( isset( $_REQUEST['tab'] ) && 'plugin-information' == $_REQUEST['tab'] ) {
                require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for install_plugin_information().
                global $tab, $body_id;
                install_plugin_information();
        /**
            if ( ! get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', true ) ) {
        /**
        public function admin_menu() {
            $this->populate_file_path();
                if ( ! is_plugin_active( $plugin['file_path'] ) ) {
                    add_theme_page(
        public function install_plugins_page() {
            // Return early if processing a plugin installation action.
                <form id="tgmpa-plugins" action="" method="post">
        /**
        protected function do_plugin_install() {
            // All plugin information will be stored in an array for processing.
            // Checks for actions from hover links to process the installation.
                if ( false === ( $creds = request_filesystem_credentials( $url, $method, false, false, $fields ) ) ) {
                // Set plugin source to WordPress API link if available.
                    if ( isset( $api->download_link ) ) {
                $nonce = 'install-plugin_' . $plugin['slug'];
                // Only activate plugins if the config option is set to true.
                    if ( is_wp_error( $activate ) ) {
                    if ( ! is_plugin_active( $plugin['file_path'] ) ) {
                        echo '<p><a href="' . add_query_arg( 'page', $this->menu, network_admin_url( 'themes.php' ) ) . '" title="' . esc_attr( $this->strings['return'] ) . '" target="_parent">' . $this->strings['return'] . '</a></p>';
                // Filter out any empty entries.
            // Checks for actions from hover links to process the activation.
                // Populate $plugin array with necessary information.
                if ( is_wp_error( $activate ) ) {
                    echo '<div id="message" class="error"><p>' . $activate->get_error_message() . '</p></div>';
        /**
        public function notices() {
            global $current_screen;
            // Return early if the nag message has been dismissed.
            foreach ( $this->plugins as $plugin ) {
                // If the plugin is installed and active, check for minimum version argument before moving forward.
                    if ( current_user_can( 'install_plugins' ) ) {
            // If we have notices to display, we move forward.
                // If dismissable is false and a message is set, output it now.
                    // Count number of plugins in each message group to calculate singular/plural message.
                    // Loop through the plugin names to make the ones pulled from the .org repo linked.
                        $external_url = $this->_get_plugin_data_from_name( $plugin_group_single_name, 'external_url' );
                    $last_plugin = array_pop( $plugin_groups ); // Pop off last name to prep for readability.
                // Define all of the action links.
                $action_links = array_filter( $action_links ); // Remove any empty array items.
                // Register the nag messages and prepare them to be processed.
            // Admin options pages already output settings_errors, so this is to avoid duplication.
        /**
        public function config( $config ) {
        public function actions( $install_actions ) {
            return $install_actions;
        /**
            // Add file_path key for all plugins.
        /**
        /**
        protected function _get_plugin_data_from_name( $name, $data = 'slug' ) {
            foreach ( $this->plugins as $plugin => $values ) {
        protected function is_tgmpa_page() {
            if ( isset( $_GET['page'] ) && $this->menu === $_GET['page'] ) {
        /**
            // Set file_path parameter for any installed plugins.
            foreach ( $this->plugins as $plugin ) {
        /**
            // Set file_path parameter for any installed plugins.
            foreach ( $this->plugins as $plugin ) {
        public static function get_instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof TGM_Plugin_Activation ) ) {
                self::$instance = new TGM_Plugin_Activation();
            }
            return self::$instance;
        }
    }
    // Ensure only one instance of the class is ever invoked.
    $tgmpa = TGM_Plugin_Activation::get_instance();
     *
     * @since 2.0.0
     *
    function tgmpa( $plugins, $config = array() ) {
        if ( $config ) {
if ( ! class_exists( 'WP_List_Table' ) ) {
if ( ! class_exists( 'TGMPA_List_Table' ) ) {
    /**
    class TGMPA_List_Table extends WP_List_Table {
        public function __construct() {
        /**
        protected function _gather_plugin_data() {
            // Load thickbox for plugin links.
            // Prep variables for use and grab list of all installed plugins.
            foreach ( TGM_Plugin_Activation::$instance->plugins as $plugin ) {
                $table_data[$i]['sanitized_plugin'] = $plugin['name'];
                if ( $external_url && preg_match( '|^http(s)?://|', $external_url ) ) {
                if ( isset( $table_data[$i]['plugin'] ) && (array) $table_data[$i]['plugin'] ) {
                if ( ! empty( $plugin['source'] ) ) {
                if ( ! isset( $installed_plugins[$plugin['file_path']] ) ) {
            // Sort plugins by Required/Recommended type and by alphabetical listing within each type.
            // Sort alphabetically each plugin type array, merge them and then sort in reverse (lists Required plugins first).
        /**
        /**
        public function column_plugin( $item ) {
            $installed_plugins = get_plugins();
            // No need to display any hover links.
            // We need to display the 'Install' hover link.
        public function column_cb( $item ) {
        /**
        public function no_items() {
        /**
        /**
        public function get_bulk_actions() {
            $actions = array(
        /**
                // Grab information from $_POST if available.
                    foreach ( $plugins_to_install as $plugin_data ) {
                // Look first to see if information has been passed via WP_Filesystem.
                // Look first to see if information has been passed via WP_Filesystem.
                // Loop through plugin slugs and remove already installed plugins from the list.
                $i = 0;
                foreach ( $plugin_installs as $key => $plugin ) {
                        // If the plugin path isn't in the $_GET variable, we can unset the corresponding path.
                        // If the plugin name isn't in the $_GET variable, we can unset the corresponding name.
                // Reset array indexes in case we removed already installed plugins.
                // If we grabbed our plugin info from $_GET, we need to decode it for use.
                require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api
                // Loop through each plugin to install and try to grab information from WordPress API, if not create 'tgmpa-empty' scalar.
                if ( is_wp_error( $api ) ) {
                // Create a new instance of TGM_Bulk_Installer.
                // Wrap the install process with the appropriate HTML.
                // Grab plugin data from $_POST.
                // Split plugin value into array with plugin file path, plugin source and plugin name.
                foreach ( $plugins_to_activate as $i => $array ) {
                    if ( ! preg_match( '|.php$|', $array[0] ) ) {
                // Return early if there are no plugins to activate.
                $plugins      = array();
                foreach ( $plugins_to_activate as $plugin_string ) {
                $count       = count( $plugin_names ); // Count so we can use _n function.
                // Now we are good to go - let's start activating plugins.
                if ( is_wp_error( $activate ) ) {
                // Update recently activated plugins option.
                foreach ( $plugins as $plugin => $time ) {
                update_option( 'recently_activated', $recent );
        /**
        public function prepare_items() {
            // Process our bulk actions here.
            // Store all of our plugin data into $items array so WP_List_Table can use it.
if ( ! class_exists( 'WP_Upgrader' ) && ( isset( $_GET['page'] ) && TGM_Plugin_Activation::$instance->menu === $_GET['page'] ) ) {
    if ( ! class_exists( 'TGM_Bulk_Installer' ) ) {
        /**
        class TGM_Bulk_Installer extends WP_Upgrader {
            /**
            public $result;
            /**
            public $bulk = false;
            /**
            public function bulk_install( $packages ) {
                // Pass installer skin object and set bulk property to true.
                $this->init();
                // Set install strings and automatic activation strings (if config option is set to true).
                // Run the header string to notify user that the process has begun.
                // Connect to the Filesystem.
                if ( ! $res ) {
                // Set the bulk header and prepare results array.
                // Get the total number of packages being processed and iterate as each package is successfully installed.
                // Loop through each plugin and process the installation.
                    // Do the plugin install.
                    // Store installation results in result property.
                    // Prevent credentials auth screen from displaying multiple times.
                // Pass footer skin strings.
                // Default config options.
                // Connect to the Filesystem.
                // Call $this->header separately if running multiple times.
                // Set strings before the package is installed.
                // Download the package (this just returns the filename of the file if the package is a local file).
                // Don't accidentally delete a local file.
                // Unzip file into a temporary working directory.
                // Install the package into the working directory with all passed config options.
                // Pass the result of the installation.
                // Set correct strings based on results.
                // The plugin install is successful.
                // Only process the activation of installed plugins if the automatic flag is set to true.
                    // Get the installed plugin file and activate it.
                    // Re-populate the file path now that the plugin has been installed and activated.
                    // Set correct strings based on results.
                // Flush plugins cache so we can make sure that the installed plugins list is always up to date.
                // Set install footer strings.
                $this->strings['no_package']          = __( 'Install package not available.', 'tgmpa' );
            /**
            public function activate_strings() {
            /**
            public function plugin_info() {
                // Assume the requested plugin is the first in the list.
    if ( ! class_exists( 'TGM_Bulk_Installer_Skin' ) ) {
            /**
            public $plugin_info = array();
            /**
            /**
            public $i = 0;
            public function __construct( $args = array() ) {
                // Set plugin names to $this->plugin_names property.
                // Extract the new args.
            /**
            /**
            public function before( $title = '' ) {
                // Flush header output buffer.
            /**
            public function after( $title = '' ) {
                // Output error strings if an error has occurred.
                // If the result is set and there are no errors, success!
                // Set in_loop and error to false and flush footer output buffer.
            /**
            public function bulk_footer() {
                // Filter out any empty entries.
                // All plugins are active, so we display the complete string and hide the menu to protect users.
            /**
            public function before_flush_output() {
            /**
            public function after_flush_output() {