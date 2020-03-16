<?php
/**
 * The template for displaying product search form
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<form role="search" method="get" class="search-form-product d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field-product flex-grow-1" placeholder="<?php echo esc_attr__( 'Tìm sản phẩm... ', 'nhakhoa' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="search-product" />

    <button class="btn-submit global-transition" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'nhakhoa' ); ?>">
        <?php esc_html_e( 'Tìm kiếm', 'nhakhoa' ); ?>
    </button>
    
    <input type="hidden" name="post_type" value="product" />
</form>