<?php
global $nhakhoa_options;

$nhakhoa_nav_top_sticky   =   $nhakhoa_options['nhakhoa_nav_top_sticky'];
?>

<nav id="site-navigation" class="main-navigation<?php echo esc_attr( $nhakhoa_nav_top_sticky == 1 ? ' active-sticky-nav' : '' ); ?>">
    <div class="site-navbar navbar-expand-lg">
        <div class="container">
            <div class="site-navigation_warp d-flex">
                <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

                <div class="site-menu collapse navbar-collapse d-lg-flex">

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
            </div>
        </div>
    </div>
</nav>