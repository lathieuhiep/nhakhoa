<?php

$nhakhoa_video_post = get_post_meta(  get_the_ID() , 'nhakhoa_video_post', true );

if ( !empty( $nhakhoa_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $nhakhoa_video_post ); ?>
    </div>

<?php endif;?>