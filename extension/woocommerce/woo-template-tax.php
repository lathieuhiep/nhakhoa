<?php
/**
 * Start add taxonomy woo
 * @see nhakhoa_register_taxonomy_woo()
 */

add_action( 'init', 'nhakhoa_register_taxonomy_woo', 5 );

function nhakhoa_register_taxonomy_woo() {

    $nhakhoa_tax_product_brand = array(
        'name'              =>  _x( 'Thương hiệu', 'taxonomy general name', 'nhakhoa' ),
        'singular_name'     =>  _x( 'Thương hiệu', 'taxonomy singular name', 'nhakhoa' ),
        'search_items'      =>  esc_html__( 'Search Product Type', 'nhakhoa' ),
        'all_items'         =>  esc_html__( 'All Product Type', 'nhakhoa' ),
        'parent_item'       =>  esc_html__( 'Parent category', 'nhakhoa' ),
        'parent_item_colon' =>  esc_html__( 'Parent category:', 'nhakhoa' ),
        'edit_item'         =>  esc_html__( 'Edit category', 'nhakhoa' ),
        'update_item'       =>  esc_html__( 'Update category', 'nhakhoa' ),
        'add_new_item'      =>  esc_html__( 'Add New category', 'nhakhoa' ),
        'new_item_name'     =>  esc_html__( 'New category Name', 'nhakhoa' ),
        'menu_name'         =>  esc_html__( 'Thương hiệu', 'nhakhoa' ),
    );
    
    $nhakhoa_tax_product_brand_args = array(
        'labels'                =>  $nhakhoa_tax_product_brand,
        'hierarchical'          =>  true,
        'public'                =>  true,
        'show_ui'               =>  true,
        'show_admin_column'     =>  true,
        'query_var'             =>  true,
        'update_count_callback' =>  '_update_post_term_count',
        'rewrite'               =>  array( 'slug' => 'thuong-hieu' ),
    );
    
    register_taxonomy( 'product_brand', array( 'product' ), $nhakhoa_tax_product_brand_args );

}