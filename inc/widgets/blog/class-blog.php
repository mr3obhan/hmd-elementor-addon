<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HMD_Post extends Widget_Base {

	public static string $domain_plugin = 'hmd-elementor-addon';

	public function get_name() {
		return 'hmd_post_blog';
	}

	public function get_title() {
		return esc_html__( 'شبکه مطالب وبلاگ', self::$domain_plugin );
	}

	public function get_icon() {
		return 'ss';
	}

	public function get_categories() {
		return [ 'hmd-elements' ];
	}

	public function get_keywords() {
		return [ 'Blog', 'Grid' ];
	}

	protected function register_controls() {

		/**
		 * Content Tab Start
		 */
		$this->start_controls_section(
			'general_content_section',
			[
				'label' => esc_html__( 'General', self::$domain_plugin ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'       => esc_html__( 'Order by', self::$domain_plugin ),
				'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', self::$domain_plugin ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''               => '',
					'date'           => esc_html__( 'Date', self::$domain_plugin ),
					'id'             => esc_html__( 'ID', self::$domain_plugin ),
					'author'         => esc_html__( 'Author', self::$domain_plugin ),
					'title'          => esc_html__( 'Title', self::$domain_plugin ),
					'modified'       => esc_html__( 'Last modified date', self::$domain_plugin ),
					'comment_count'  => esc_html__( 'Number of comments', self::$domain_plugin ),
					'menu_order'     => esc_html__( 'Menu order', self::$domain_plugin ),
					'meta_value'     => esc_html__( 'Meta value', self::$domain_plugin ),
					'meta_value_num' => esc_html__( 'Meta value number', self::$domain_plugin ),
					'rand'           => esc_html__( 'Random order', self::$domain_plugin ),
				),
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Sort order',  self::$domain_plugin ),
				'description' => 'Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.',
				'type'        => Controls_Manager::SELECT,
				'default'     => 'DESC',
				'options'     => array(
					'DESC' => esc_html__( 'Descending',  self::$domain_plugin ),
					'ASC'  => esc_html__( 'Ascending',  self::$domain_plugin ),
				),
			]
		);

		$this->add_control(
			'first_items_per_page',
			[
				'label'       => esc_html__( 'Items per page',  self::$domain_plugin ),
				'description' => esc_html__( 'Number of items to show per page.',  self::$domain_plugin ),
				'default'     => 1,
				'placeholder' => '1',
				'type'        => Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'second_items_per_page',
			[
				'label'       => esc_html__( 'Items per page second posts',  self::$domain_plugin ),
				'description' => esc_html__( 'Number of items to show per page.',  self::$domain_plugin ),
				'default'     => 3,
				'placeholder' => '3',
				'type'        => Controls_Manager::NUMBER,
			]
		);

		$this->end_controls_section();
		/**
		 * Content Tab End
		 */

		// ------------------------------------------------------

		/**
		 * Style Tab Start
		 *
		 * Start General Style
		 */

		$this->start_controls_section(
			'general_style_section',
			[
				'label' => esc_html__( 'General',  self::$domain_plugin ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'height_container',
			[
				'label'      => esc_html__( 'ارتفاع شبکه نوشته ها', self::$domain_plugin ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default'     => [
					'unit' => 'px',
					'height' => 400
				],
				'range'      => [
					'px' => [
						'min'  => 400,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'placeholder' => '400px',
				'selectors'  => [
					'{{WRAPPER}} .hmd-container-height' => 'height:  {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'نرمی مطالب', 'elementor-addon-hmd' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hmd-border-radius' => 'border-radius:  {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'padding_radius_main_post',
			[
				'label'      => esc_html__( 'Padding', self::$domain_plugin ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .hmd-second-p' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * End General Style
		 */

		/**
		 * Start Typography Style
		 */

		$this->start_controls_section(
			'typography_style_sections',
			[
				'label' => esc_html__( 'Typography Style',  self::$domain_plugin ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'main_title_typography',
				'label'    => esc_html__( 'عنوان نوشته اصلی', self::$domain_plugin ),
				'selector' => '{{WRAPPER}} article h2',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_title_typography',
				'label'    => esc_html__( 'عنوان نوشته ها', self::$domain_plugin ),
				'selector' => '{{WRAPPER}} article h3',
			]
		);

		$this->add_control(
			'margin_bottom_title',
			[
				'label'      => esc_html__( 'فاصله', self::$domain_plugin ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} article h3.hmd-mb' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'colors_titles'
		);

		// Add tab Normal
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', self::$domain_plugin ),
			]
		);

		$this->add_control(
			'title_color_normal',
			[
				'label'       => esc_html__( 'رنگ عنوان', self::$domain_plugin ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} article h2' => 'color: {{VALUE}}',
					'{{WRAPPER}} article h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Add tab Hover
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', self::$domain_plugin ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'       => esc_html__( 'رنگ عنوان', self::$domain_plugin ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} article:hover h2' => 'color: {{VALUE}}',
					'{{WRAPPER}} article:hover h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} article h2 a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} article h3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * End Typography Style
		 */

		/**
		 * Start Category Style
		 */

		$this->start_controls_section(
			'category_style_sections',
			[
				'label' => esc_html__( 'Category',  self::$domain_plugin ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_title_typography',
				'label'    => esc_html__( 'Font', self::$domain_plugin ),
				'selector' => '{{WRAPPER}} article ul li',
			]
		);

		$this->add_control(
			'color_text_category',
			[
				'label'      => esc_html__( 'رنگ دسته بندی', self::$domain_plugin ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} ul li.hmd-category' => 'background-color : {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'space_category',
			[
				'label'      => esc_html__( 'فاصله دسته بندی', self::$domain_plugin ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} ul' => 'gap : {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'padding_radius_category',
			[
				'label'      => esc_html__( 'Padding', self::$domain_plugin ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} ul li.hmd-category' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'border_radius_category',
			[
				'label'      => esc_html__( 'نرمی دسته بندی', self::$domain_plugin ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} ul li.hmd-category' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'margin_bottom_category',
			[
				'label'      => esc_html__( 'فاصله', self::$domain_plugin ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} ul.hmd-mb' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				],
			]
		);

		/**
		 * End Category Style
		 */

		/**
		 * Style Tab End
		 */

		// ------------------------------------------------------


	}

	protected function render() {
		hmd_elementor_blog_template( $this->get_settings_for_display() );
	}

}

Plugin::instance()->widgets_manager->register( new HMD_Post() );