<?php

/*
* Start quick view product
*/
function nhakhoa_button_quick_view() {

?>

    <a class="btn-quick-view-product" href="#" title="<?php esc_attr_e( 'Quick view product', 'nhakhoa' ); ?>" data-id-product="<?php echo esc_attr( get_the_ID() ); ?>">
        <i class="fas fa-search"></i>
    </a>

<?php

}

function nhakhoa_popup_quick_view_product() {

?>

    <div class="popup-quick-view-product">
        <div class="quick-view-container">
            <div class="quick-view-body">
                <p class="permanent">
                    Simple inner scrollbar over content
                </p>
                <p class="permanent">
                    <a href="#anchor">Click to test #anchors</a><br><br>
                    <input type="text" value="Use TAB to focus next input" style="max-width:220px; width: 100%;">
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a,
                    scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus.
                    Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel
                    hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue,
                    pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam
                    sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare,
                    ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget
                    nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam
                    viverra nisi, in interdum massa nibh nec erat.
                </p>
            </div>
        </div>
    </div>

<?php

}

/* Start ajax quick view product */
add_action( 'wp_ajax_nopriv_nhakhoa_get_quick_view_product', 'nhakhoa_get_quick_view_product' );
add_action( 'wp_ajax_nhakhoa_get_quick_view_product', 'nhakhoa_get_quick_view_product' );

function nhakhoa_get_quick_view_product() {

    $product_id   =   $_POST['product_id'];

}