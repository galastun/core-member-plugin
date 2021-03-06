<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/galastun
 * @since      1.0.0
 *
 * @package    Core_Member
 * @subpackage Core_Member/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Core_Member
 * @subpackage Core_Member/admin
 * @author     Brandon Kissam <brandon.kissam@gmail.com>
 */
class Core_Member_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Core_Member_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Core_Member_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/core-member-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Core_Member_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Core_Member_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/core-member-admin.js', array( 'jquery' ), $this->version, false );

  }
  
  /**
   * Adds the admin menu for the plugin.
   * 
   * @return {void}
   */
  public function add_plugin_admin_menu() {
      add_options_page(
        'CORE Member Setup', 
        'CORE Member', 
        'manage_options', 
        $this->plugin_name, 
        array($this, 'display_plugin_setup_page')
      );
  }

  /**
   * Adds the settings links to dislpay the admin page.
   * 
   * @param {String} links the links to use
   * @return {Array}
   */
  public function add_action_links( $links ) {
    $settings_link = array(
      '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
    );
    return array_merge(  $settings_link, $links );

  }

  /**
   * Displays the plugin setup page.
   * 
   * @return {void}
   */
  public function display_plugin_setup_page() {
      include_once( 'partials/core-member-admin-display.php' );
  }

  /**
   * Sets up the validate function to be run on POST.
   * 
   * @return {void}
   */
  public function options_update() {
    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
  }

  /**
   * Validates the input from the Admin page to ensure it is acceptable.
   * 
   * @param {Object} input The POST body from the admin form.
   * @return {Boolean} 
   */
  public function validate($input) {    
    $valid = array();

    $valid['app-id'] = filter_var($input['app-id'], FILTER_SANITIZE_STRING);
    $valid['client-secret'] = filter_var($input['client-secret'], FILTER_SANITIZE_STRING);

    return $valid;
 }
}
