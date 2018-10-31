<?php

require_once('UserUpdate.php');
require_once('Member.php');

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/galastun
 * @since      1.0.0
 *
 * @package    Core_Member
 * @subpackage Core_Member/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Core_Member
 * @subpackage Core_Member/public
 * @author     Brandon Kissam <brandon.kissam@gmail.com>
 */
class Core_Member_Public {
  public $state = 'main';

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
    $this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/core-member-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/core-member-public.js', array( 'jquery' ), $this->version, false );

  }

  /**
   * Registers the shortcodes to be used with the plugin.
   * 
   * @return {void}
   */
  public function register_shortcodes() {
    add_shortcode('core-member', array($this, 'add_core_form'));
  }
  
  /**
   * Adds the CORE Member Form to the publid display.
   * 
   * @return {void}
   */
  public function add_core_form() {
    include_once( 'partials/core-member-public-display.php' );
  }

  /**
   * Takes the POST body data from the client form and updates the user on the
   * Planning Center Server.
   * 
   * @param {Object} postInfo the POST body from the client form
   * @return {void}
   */
  public function update_user($postInfo) {
    $userUpdate = new UserUpdate($this->plugin_name, $postInfo['email']);
    $userExists = $userUpdate->init();

    if($userExists) {
      print_r($postInfo);
      $userUpdate->updateUser($postInfo);
    } else {
      $this->state = 'add';
    }
  }

  /**
   * Adds a new member to Planning Center and any household members.
   * 
   * @param {Object} postInfo the POST body from the client form
   * @return {void}
   */
  public function add_new($postInfo) {
    $householdMembers = array();

    // Set Head of Household
    $member = new Member($this->plugin_name);
    $member->setEmail($postInfo['email']);
    $member->setFirstName($postInfo['firstName'][0]);
    $member->setLastName($postInfo['lastName'][0]);

    $member->create();

    for($i = 1; $i < sizeof($postInfo['firstName']); $i++) {
      $householdMember = new Member($this->plugin_name);
      $householdMember->setFirstName($postInfo['firstName'][$i]);
      $householdMember->setLastName($postInfo['lastName'][$i]);
      $householdMember->create();
      array_push($householdMembers, $householdMember);
    }

    if(sizeof($householdMembers) > 0) {
      $member->addHousehold($householdMembers);
    }

    $userUpdate = new UserUpdate($this->plugin_name, $postInfo['email']);
    $userUpdate->init();

    $userUpdate->updateUser(array(
      'email' => $postInfo['email'],
      'include-household' => $postInfo['include-household'],
      'attend-weekly' => $postInfo['attend-weekly'],
      'serving-ministry' => $postInfo['serving-ministry'],
      'attend-lifegroup' => $postInfo['attend-lifegroup'],
      'educating-self' => $postInfo['educating-self'],
    ));
  }
}
