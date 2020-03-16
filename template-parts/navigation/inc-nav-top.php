<?php
global $nhakhoa_options;

$nhakhoa_logo_image_id    =   $nhakhoa_options['nhakhoa_logo_image']['id'];
$nhakhoa_nav_top_sticky   =   $nhakhoa_options['nhakhoa_nav_top_sticky'];
?>

<nav id="site-navigation" class="main-navigation<?php echo esc_attr( $nhakhoa_nav_top_sticky == 1 ? ' active-sticky-nav' : '' ); ?>">
    <div class="site-navbar navbar-expand-lg">
        <div class="container">
            <div class="site-navigation_warp d-flex justify-content-lg-end">
                <div class="site-logo d-flex align-items-center">
                    <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                        <?php
                            if ( !empty( $nhakhoa_logo_image_id ) ) :
                                echo wp_get_attachment_image( $nhakhoa_logo_image_id, 'full' );
                            else :
                                echo'<img class="logo-default" src="'.esc_url( get_theme_file_uri( '/images/logo.png' ) ).'" alt="'.get_bloginfo('title').'" />';
                            endif;
                        ?>
                    </a>

                    <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="site-menu collapse navbar-collapse d-lg-flex justify-content-lg-end">

                    <?php

                    if ( has_nav_menu('primary') ) :

                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'navbar-nav',
                            'container'      => false,
                        ) ) ;

                    else:

                    ?>

                        <ul class="main-menu">
                            <li>
                                <a href="<?php echo get_admin_url().'/nav-menus.php'; ?>">
                                    <?php esc_html_e( 'ADD TO MENU','nhakhoa' ); ?>
                                </a>
                            </li>
                        </ul>

                    <?php endif; ?>

                </div>

                <?php if ( class_exists('Woocommerce') ) : ?>

                    <div class="shop-cart-view d-flex align-items-center">
                        <?php
                        do_action( 'nhakhoa_woo_shopping_cart' );

                        the_widget( 'WC_Widget_Cart', '' );
                        ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>