<?php

namespace HMD_ELEMENTOR_ADDON\admin;
use HMD_ELEMENTOR_ADDON;

class Admin {

	/**
	 * Admin Page slug
	 */
	public static $admin_page_slug;

	/**
	 * Admin_Page constructor.
	 */
	public function __construct() {
		/*
		 * Set Page slug Admin
		 */
		self::$admin_page_slug = 'hmd-elementor-addon';
		/*
		 * Setup Admin Menu
		 */
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		/*
		 * Register Script in Admin Area
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
	}

	/**
	 * Admin Link
	 *
	 * @param $page
	 * @param array $args
	 * @return string
	 */
	public static function admin_link( $page, $args = array() ) {
		return add_query_arg( $args, admin_url( 'admin.php?page=' . $page ) );
	}

	/**
	 * If in Page in Admin
	 *
	 * @param $page_slug
	 * @return bool
	 */
	public static function in_page( $page_slug ) {
		global $pagenow;
		if ( $pagenow == "admin.php" and isset( $_GET['page'] ) and $_GET['page'] == $page_slug ) {
			return true;
		}

		return false;
	}

	/**
	 * Load assets file in admin
	 */
	public function admin_assets() {
		global $pagenow;

		//List Allow This Script
		if ( $pagenow == "admin.php" ) {

			// Get Plugin Version
			$plugin_version = HMD_ELEMENTOR_ADDON::$plugin_version;
			if (defined('SCRIPT_DEBUG') and SCRIPT_DEBUG === true) {
			    $plugin_version = time();
			}
			
			wp_enqueue_style( 'hmd-elementor-addon', HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/admin/css/style.css', array(), $plugin_version, 'all' );
			wp_enqueue_script( 'hmd-elementor-addon', HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/admin/js/script.js', array( 'jquery' ), $plugin_version, false );
			wp_localize_script('hmd-elementor-addon', 'hmd_elementor_addon', array(
			    'ajax' => admin_url('admin-ajax.php'),
			));
		}

	}

	/**
	 * Set Admin Menu
	 */
	public function admin_menu() {
		add_menu_page( __( 'hmd-elementor-addon', 'hmd-elementor-addon' ), __( 'hmd-elementor-addon', 'hmd-elementor-addon' ), 'manage_options', self::$admin_page_slug, array( $this, 'admin_page' ), 'dashicons-cart', 8 );
		add_submenu_page( self::$admin_page_slug, __( 'order', 'hmd-elementor-addon' ), __( 'order', 'hmd-elementor-addon' ), 'manage_options', self::$admin_page_slug, array( $this, 'admin_page' ) );
		add_submenu_page( self::$admin_page_slug, __( 'setting', 'hmd-elementor-addon' ), __( 'setting', 'hmd-elementor-addon' ), 'manage_options', 'wp_plugin_option', array( Settings::instance(), 'setting_page' ) );
	}

	/*
	 * Admin Page
	 */
	public function admin_page() {
		$simple_text = 'Hi';
		require_once HMD_ELEMENTOR_ADDON::$plugin_path . '/inc/admin/views/default.php';
	}

}
