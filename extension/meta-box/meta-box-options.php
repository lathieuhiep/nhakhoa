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

    return $nhakhoa_meta_boxes;

}