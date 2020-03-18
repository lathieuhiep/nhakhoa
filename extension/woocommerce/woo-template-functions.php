<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 * @see nhakhoa_shop_setup()
 * @see nhakhoa_show_products_per_page()
 * @see nhakhoa_loop_columns_product()
 */

add_action( 'after_setup_theme', 'nhakhoa_shop_setup' );

function nhakhoa_shop_setup() {

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/* Start limit product */
add_filter('loop_shop_per_page', 'nhakhoa_show_products_per_page');

function nhakhoa_show_products_per_page() {
    global $nhakhoa_options;

    $nhakhoa_product_limit = $nhakhoa_options['nhakhoa_product_limit'];

    return $nhakhoa_product_limit;

}
/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'nhakhoa_loop_columns_product');

function nhakhoa_loop_columns_product() {
    global $nhakhoa_options;

    $nhakhoa_products_per_row = $nhakhoa_options['nhakhoa_products_per_row'];

    if ( !empty( $nhakhoa_products_per_row ) ) :
        return $nhakhoa_products_per_row;
    else:
        return 4;
    endif;

}
/* End Change number or products per row */

/* Start get cart */
if ( ! function_exists( 'nhakhoa_get_cart' ) ):

    function nhakhoa_get_cart() {

    ?>

        <div class="cart-box text-right">
            <div class="cart-customlocation">
                <i class="fas fa-shopping-cart"></i>

                <span class="number-cart-product">
                     <?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
                </span>
            </div>
        </div>

    <?php
    }

endif;

/* To ajaxify your cart viewer */
add_filter( 'woocommerce_add_to_cart_fragments', 'nhakhoa_add_to_cart_fragment' );

if ( ! function_exists( 'nhakhoa_add_to_cart_fragment' ) ) :

    function nhakhoa_add_to_cart_fragment( $nhakhoa_fragments ) {

        ob_start();

        do_action( 'nhakhoa_woo_shopping_cart' );

        $nhakhoa_fragments['.cart-box'] = ob_get_clean();

        return $nhakhoa_fragments;

    }

endif;
/* End get cart */

/* Start Sidebar Shop */
if ( ! function_exists( 'nhakhoa_woo_get_sidebar' ) ) :

    function nhakhoa_woo_get_sidebar() {

	    global $nhakhoa_options;
	    $nhakhoa_sidebar_woo_position = $nhakhoa_options['nhakhoa_sidebar_woo'];


	    if( is_active_sidebar( 'nhakhoa-sidebar-wc' ) ):

	        if ( $nhakhoa_sidebar_woo_position == 'left' ) :
		        $class_order = 'order-md-1';
	        else:
		        $class_order = 'order-md-2';
	        endif;
    ?>

            <aside class="col-12 col-md-4 col-lg-3 order-2 <?php echo esc_attr( $class_order ); ?>">
                <?php dynamic_sidebar( 'nhakhoa-sidebar-wc' ); ?>
            </aside>

    <?php
        endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if ( ! function_exists( 'nhakhoa_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function nhakhoa_woo_before_main_content() {
        global $nhakhoa_options;
        $nhakhoa_sidebar_woo_position = $nhakhoa_options['nhakhoa_sidebar_woo'];

    ?>

        <div class="site-shop">
            <div class="container">
                <div class="row">

                <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked nhakhoa_woo_sidebar - 10
                     */
                    do_action( 'nhakhoa_woo_sidebar' );

                ?>

                    <div class="<?php echo is_active_sidebar( 'nhakhoa-sidebar-wc' ) && $nhakhoa_sidebar_woo_position != 'hide' ? 'col-12 col-md-8 col-lg-9 order-1 has-sidebar' : 'col-md-12'; ?>">

    <?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function nhakhoa_woo_after_main_content() {
        global $nhakhoa_options;
        $nhakhoa_sidebar_woo_position = $nhakhoa_options['nhakhoa_sidebar_woo'];
    ?>

                    </div><!-- .col-md-9 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->

    <?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_product_thumbnail_open' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked nhakhoa_woo_product_thumbnail_open - 5
     */

    function nhakhoa_woo_product_thumbnail_open() {

?>

        <div class="site-shop__product--item-image">

<?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_product_thumbnail_close' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked nhakhoa_woo_product_thumbnail_close - 15
     */

    function nhakhoa_woo_product_thumbnail_close() {

        do_action( 'nhakhoa_woo_button_quick_view' );
?>

        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">

<?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_get_product_title' ) ) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked nhakhoa_woo_get_product_title - 10
     */

    function nhakhoa_woo_get_product_title() {
    ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'nhakhoa_woo_after_shop_loop_item_title' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked nhakhoa_woo_after_shop_loop_item_title - 15
     */
    function nhakhoa_woo_after_shop_loop_item_title() {
    ?>
        </div><!-- .site-shop__product--item-content -->
    <?php
    }
endif;

if ( ! function_exists( 'nhakhoa_woo_loop_add_to_cart_open' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked nhakhoa_woo_loop_add_to_cart_open - 4
     */

    function nhakhoa_woo_loop_add_to_cart_open() {
    ?>
        <div class="site-shop__product-add-to-cart">
    <?php
    }

endif;

if ( ! function_exists( 'nhakhoa_woo_loop_add_to_cart_close' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked nhakhoa_woo_loop_add_to_cart_close - 12
     */

    function nhakhoa_woo_loop_add_to_cart_close() {
    ?>
        </div><!-- .site-shop__product-add-to-cart -->
    <?php
    }

endif;

if ( ! function_exists( 'nhakhoa_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked nhakhoa_woo_before_shop_loop_item - 5
     */
    function nhakhoa_woo_before_shop_loop_item() {
    ?>

        <div class="site-shop__product--item">

    <?php
    }
endif;

if ( ! function_exists( 'nhakhoa_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked nhakhoa_woo_after_shop_loop_item - 15
     */
    function nhakhoa_woo_after_shop_loop_item() {
    ?>

        </div><!-- .site-shop__product--item -->

    <?php
    }
endif;

if ( ! function_exists( 'nhakhoa_woo_before_shop_loop_open' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked nhakhoa_woo_before_shop_loop_open - 5
     */
    function nhakhoa_woo_before_shop_loop_open() {

    ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">

    <?php
    }

endif;

if ( ! function_exists( 'nhakhoa_woo_before_shop_loop_close' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked nhakhoa_woo_before_shop_loop_close - 35
     */
    function nhakhoa_woo_before_shop_loop_close() {

    ?>

        </div><!-- .site-shop__result-count-ordering -->

    <?php
    }

endif;

/*
* Single Shop
*/

if ( ! function_exists( 'nhakhoa_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked nhakhoa_woo_before_single_product - 5
     */

    function nhakhoa_woo_before_single_product() {

    ?>

        <div class="site-shop-single">

    <?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_after_single_product' ) ) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked nhakhoa_woo_after_single_product - 30
     */

    function nhakhoa_woo_after_single_product() {

    ?>

        </div><!-- .site-shop-single -->

    <?php

    }

endif;

if ( !function_exists( 'nhakhoa_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked nhakhoa_woo_before_single_product_summary_open_warp - 1
     */

    function nhakhoa_woo_before_single_product_summary_open_warp() {

	    global $product;
	    $review_count = $product->get_review_count();
    ?>

        <div class="site-shop-single__top d-flex align-items-center">
            <?php
            woocommerce_template_single_title();

            if ( $review_count > 0 ) :
                woocommerce_template_single_rating();
            else:
            ?>

            <div class="no-rating">
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            </div>

            <?php endif; ?>

        </div>

        <div class="site-shop-single__warp">

    <?php

    }

endif;

if ( !function_exists( 'nhakhoa_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked nhakhoa_woo_after_single_product_summary_close_warp - 5
     */

    function nhakhoa_woo_after_single_product_summary_close_warp() {

    ?>

        </div><!-- .site-shop-single__warp -->

    <?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_before_single_product_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked nhakhoa_woo_before_single_product_summary_open - 5
     */

    function nhakhoa_woo_before_single_product_summary_open() {

    ?>

        <div class="site-shop-single__gallery-box">

    <?php

    }

endif;

if ( ! function_exists( 'nhakhoa_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked nhakhoa_woo_before_single_product_summary_close - 30
     */

    function nhakhoa_woo_before_single_product_summary_close() {

    ?>

        </div><!-- .site-shop-single__gallery-box -->

    <?php

    }

endif;

/* Start out of stock product */
function nhakhoa_out_of_stock() {

	$nhakhoa_post_id      = get_the_ID();
	$nhakhoa_stock_status = get_post_meta( $nhakhoa_post_id, '_stock_status',true );

	if ( $nhakhoa_stock_status == 'outofstock' ) {
		return true;
	} else {
		return false;
	}

}
/* End out of stock product */

/* Start check in stock product */
if ( ! function_exists( 'nhakhoa_check_in_stock_product' ) ):

	function nhakhoa_check_in_stock_product() {
		if ( !nhakhoa_out_of_stock() ) :

?>
        <span class="tzProductInStock">
            <i class="fa fa-check-square-o"></i>
            <?php esc_html_e( 'In Stock', 'maniva-meetup' ); ?>
        </span>
<?php
		endif;
	}

endif;
/* End check in stock product */

function nhakhoa_woocommerce_custom_single_price() {
//    global $product;
//	var_dump( wc_get_stock_html( $product  ) );
	?>

    <div class="price-single-box d-flex align-items-center">
        <p class="text">
            <?php esc_html_e( 'Giá: ', 'nhakhoa' ); ?>
        </p>

        <?php woocommerce_template_single_price(); ?>
    </div>

<?php
}

/*
* change sale flash text
* Author: https://levantoan.com
*/
add_filter('woocommerce_sale_flash','nhakhoa_woocommerce_sale_flash', 10, 3);
function nhakhoa_woocommerce_sale_flash($text, $post, $product){
	ob_start();
	$sale_price = get_post_meta( $product->get_id(), '_price', true);
	$regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
	if (empty($regular_price) && $product->is_type( 'variable' )){
		$available_variations = $product->get_available_variations();
		$variation_id = $available_variations[0]['variation_id'];
		$variation = new WC_Product_Variation( $variation_id );
		$regular_price = $variation ->regular_price;
		$sale_price = $variation ->sale_price;
	}
	$sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
	if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :
		$R = floor((255*$sale)/100);
		$G = floor((255*(100-$sale))/100);
		$bg_style = 'background:none;background-color: #f34723;';
		echo apply_filters( 'nhakhoa_woocommerce_sale_flash', '<span class="onsale" style="'. $bg_style .'">' . esc_html__( 'Giảm ' ) . $sale . '%</span>', $post, $product );
	endif;
	return ob_get_clean();
}

/* Custom rating */
function nhakhoa_woo_custom_html_rating() {

	global $product;

	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();

	if ( $rating_count > 0 ) :
?>

    <div class="woocommerce">
        <div class="woocommerce-product-rating">
		    <?php echo wc_get_rating_html( $average, $rating_count ); ?>

            <a href="<?php the_permalink(); ?>" class="woocommerce-review-link" rel="nofollow">
			    <?php echo esc_html( $review_count ) . ' '; esc_html_e( 'đánh giá', 'nhakhoa' ); ?>
            </a>
        </div>
    </div>

<?php
    endif;
}