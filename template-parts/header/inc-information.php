<?php
global $nhakhoa_options;

$nhakhoa_information_show_hide = $nhakhoa_options['nhakhoa_information_show_hide'] == '' ? 1 : $nhakhoa_options['nhakhoa_information_show_hide'];

if ( $nhakhoa_information_show_hide == 1 ) :

$nhakhoa_information_address   =   $nhakhoa_options['nhakhoa_information_address'];
$nhakhoa_information_mail      =   $nhakhoa_options['nhakhoa_information_mail'];
$nhakhoa_information_phone     =   $nhakhoa_options['nhakhoa_information_phone'];

?>

<div class="information">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-7">
                <?php if ( $nhakhoa_information_address != '' ) : ?>

                    <span>
                        <i class="fas fa-map-marker" aria-hidden="true"></i>
                        <?php echo esc_html( $nhakhoa_information_address ); ?>
                    </span>

                <?php
                endif;

                if ( $nhakhoa_information_mail != '' ) :
                ?>

                    <span>
                        <i class="fas fa-envelope"></i>
                        <?php echo esc_html( $nhakhoa_information_mail ); ?>
                    </span>

                <?php
                endif;

                if ( $nhakhoa_information_phone != '' ) :
                ?>

                    <span>
                        <i class="fas fa-mobile-alt"></i>
                        <?php echo esc_html( $nhakhoa_information_phone ); ?>
                    </span>

                <?php endif; ?>
            </div>

            <div class="col-12 col-md-12 col-lg-5 d-none d-lg-block">
                <div class="information__social-network social-network-toTopFromBottom d-lg-flex justify-content-lg-end">
                    <?php nhakhoa_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

endif;