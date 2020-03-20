<?php

add_filter( 'rwmb_meta_boxes', 'nhakhoa_register_meta_boxes' );

function nhakhoa_register_meta_boxes() {

    /* Start meta box post */
    $nhakhoa_meta_boxes[] = array(
        'id'         => 'post_format_option',
        'title'      => esc_html__( 'Post Format', 'nhakhoa' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'               => 'nhakhoa_gallery_post',
                'name'             => 'Gallery',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
            ),

            array(
                'id'            => 'nhakhoa_video_post',
                'name'          => 'Video Or Audio',
                'type'          => 'oembed',
            ),


        )
    );
    /* End meta box post */

	/* Start meta box post */
	$nhakhoa_meta_boxes[] = array(
		'id'         => 'product_option_meta_box',
		'title'      => esc_html__( 'Product Option', 'nhakhoa' ),
		'post_types' => array( 'product' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'fields' => array(

			array(
				'id'            =>  'product_meta_bao_hanh',
				'name'          =>  esc_html__( 'Bảo hành', 'nhakhoa' ),
				'type'          =>  'text',
				'placeholder'   =>  'Bảo hành chính hãng 10 năm'
			),

			array(
				'id'            =>  'product_meta_link_bao_hanh',
				'name'          =>  esc_html__( 'Chính sách bảo hành', 'nhakhoa' ),
				'type'          => 'post',
				'post_type'     => 'page',
				'field_type'    => 'select_tree',
			),

			array(
				'id'      => 'product_meta_km',
				'name'    => esc_html__( 'Khuyến mãi', 'nhakhoa' ),
				'type'    => 'fieldset_text',
				'options' => array(
					'name'  => 'Quà khuyến mãi',
					'time'  => 'Thời gian',
				),
				'clone' => true,
			),

		)
	);
	/* End meta box post */

    return $nhakhoa_meta_boxes;

}