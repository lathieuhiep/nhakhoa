<?php

    $nhakhoa_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $nhakhoa_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $nhakhoa_audio ) ) : ?>

                <?php echo wp_oembed_get( $nhakhoa_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $nhakhoa_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>