<?php
global $nhakhoa_options;

$nhakhoa_logo_image_id    =   $nhakhoa_options['nhakhoa_logo_image']['id'];

?>
<div class="header-top">
	<div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-3">
                <div class="site-logo">
                    <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			            <?php
			            if ( !empty( $nhakhoa_logo_image_id ) ) :
				            echo wp_get_attachment_image( $nhakhoa_logo_image_id, 'full' );
			            else :
				            echo'<img class="logo-default" src="'.esc_url( get_theme_file_uri( '/images/logo.png' ) ).'" alt="'.get_bloginfo('title').'" />';
			            endif;
			            ?>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-7">
                <div class="header-search">
                    <div class="header-search__box">
			            <?php get_template_part( 'searchform', 'product' ); ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-2">
	            <?php if ( class_exists('Woocommerce') ) : ?>

                    <div class="shop-cart-view">
			            <?php do_action( 'nhakhoa_woo_shopping_cart' ); ?>

                        <div class="cart-view-box-widget d-flex flex-column">
                            <div class="cart-view-box__close"></div>

                            <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                        </div>
                    </div>

	            <?php endif; ?>
            </div>
        </div>
	</div>
</div>