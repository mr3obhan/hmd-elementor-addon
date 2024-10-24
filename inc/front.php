<?php

namespace HMD_ELEMENTOR_ADDON;

use HMD_ELEMENTOR_ADDON;

class Front {

	/**
	 * Asset Script name
	 */
	public static $asset_name = 'hmd-elementor-addon';

	/**
	 * constructor.
	 */
	public function __construct() {
		/*
		 * Add Script
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_style' ) );

	}

	/**
	 * Register Asset
	 */
	public function wp_enqueue_style() {

		// Get Plugin Version
		$plugin_version = HMD_ELEMENTOR_ADDON::$plugin_version;
		if ( defined( 'SCRIPT_DEBUG' ) and SCRIPT_DEBUG === true ) {
			$plugin_version = time();
		}

		//Jquery Raty
		//@see https://github.com/wbotelhos/raty
		wp_enqueue_style( 'jquery-raty', HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/jquery-raty/jquery.raty.css', array(), HMD_ELEMENTOR_ADDON::$plugin_version, 'all' );
		wp_enqueue_script( 'jquery-raty', HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/jquery-raty/jquery.raty.js', array( 'jquery' ), HMD_ELEMENTOR_ADDON::$plugin_version, false );

		//Native Plugin
		wp_enqueue_style( self::$asset_name, HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/public/css/style.css', array(), HMD_ELEMENTOR_ADDON::$plugin_version, 'all' );
		wp_enqueue_style( 'tailwind', HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/public/css/output.css', array(), HMD_ELEMENTOR_ADDON::$plugin_version, 'all' );
//		$custom_css = ".test {color: " . HMD_ELEMENTOR_ADDON::$option['star_color'] . ";}";
//		wp_add_inline_style( self::$asset_name, $custom_css );

		wp_enqueue_script( self::$asset_name, HMD_ELEMENTOR_ADDON::$plugin_url . '/asset/public/script.js', array( 'jquery' ), $plugin_version, false );
//		wp_localize_script( self::$asset_name, 'wp_reviews_js', array(
//			'ajax'          => home_url() . '/?WP_PLUGIN_check_notification=yes&time=' . current_time( 'timestamp' ),
//			'is_login_user' => ( is_user_logged_in() ? 1 : 0 )
//		) );
	}

}
