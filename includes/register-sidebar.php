<?php
/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'nhakhoa_widgets_init');

function nhakhoa_widgets_init() {

	$nhakhoa_widgets_arr  =   array(

		'nhakhoa-sidebar-main'    =>  array(
			'name'              =>  esc_html__( 'Sidebar Main', 'nhakhoa' ),
			'description'       =>  esc_html__( 'Display sidebar right or left on all page.', 'nhakhoa' )
		),

		'nhakhoa-sidebar-wc' =>  array(
			'name'              =>  esc_html__( 'Sidebar Woocommerce', 'nhakhoa' ),
			'description'       =>  esc_html__( 'Display sidebar on page shop.', 'nhakhoa' )
		),

		'nhakhoa-sidebar-footer-multi-column-1'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 1', 'nhakhoa' ),
			'description'       =>  esc_html__('Display footer column 1 on all page.', 'nhakhoa' )
		),

		'nhakhoa-sidebar-footer-multi-column-2'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 2', 'nhakhoa' ),
			'description'       =>  esc_html__('Display footer column 2 on all page.', 'nhakhoa' )
		),

		'nhakhoa-sidebar-footer-multi-column-3'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 3', 'nhakhoa' ),
			'description'       =>  esc_html__('Display footer column 3 on all page.', 'nhakhoa' )
		),

		'nhakhoa-sidebar-footer-multi-column-4'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 4', 'nhakhoa' ),
			'description'       =>  esc_html__('Display footer column 4 on all page.', 'nhakhoa' )
		)

	);

	foreach ( $nhakhoa_widgets_arr as $nhakhoa_widgets_id => $nhakhoa_widgets_value ) :

		register_sidebar( array(
			'name'          =>  esc_attr( $nhakhoa_widgets_value['name'] ),
			'id'            =>  esc_attr( $nhakhoa_widgets_id ),
			'description'   =>  esc_attr( $nhakhoa_widgets_value['description'] ),
			'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
			'after_widget'  =>  '</section>',
			'before_title'  =>  '<h2 class="widget-title">',
			'after_title'   =>  '</h2>'
		));

	endforeach;

}