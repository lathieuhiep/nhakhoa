<?php

global $nhakhoa_options;

$nhakhoa_show_loading = $nhakhoa_options['nhakhoa_general_show_loading'] == '' ? '0' : $nhakhoa_options['nhakhoa_general_show_loading'];

if(  $nhakhoa_show_loading == 1 ) :

    $nhakhoa_loading_url  = $nhakhoa_options['nhakhoa_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $nhakhoa_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $nhakhoa_loading_url ); ?>" alt="<?php esc_attr_e('loading...','nhakhoa') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','nhakhoa') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>