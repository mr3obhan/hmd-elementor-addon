<?php

namespace HMD_ELEMENTOR_ADDON;

class HMD_Elementor {

	public function __construct() {
		add_action( 'elementor/widgets/register', [ $this, 'hmd_register_widgets' ] );
		//add_action('elementor/controls/register', [$this, 'hmd_register_controls']);
		add_action('elementor/elements/categories_registered', [$this, 'hmd_add_widget_categories'],1);
		add_action( 'elementor/init', [ $this, 'hmd_files_include' ], 20 );
	}

	function hmd_files_include() {
		require_once( __DIR__ . '/widgets/blog/blog.php' );
	}

	/**
	 * Add theme widget categories
	 *
	 *
	 */
	public function hmd_add_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'hmd-elements',
			array(
				'title' => esc_html__( '[XTemos] Elements', 'hmd-elementor-addon' ),
				'icon'  => 'fab fa-plug',
			)
		);
	}

	/**
	 * Register new controls.
	 *
	 * @since 1.0.0
	 */
	public function hmd_register_widgets() {
		require_once( __DIR__ . '/widgets/blog/class-blog.php' );
	}

}