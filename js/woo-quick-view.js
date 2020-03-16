/**
 * Quick view product
 */

( function( $ ) {

    "use strict";

    let btn_quick_view_product  =   $( '.btn-quick-view-product' );

    btn_quick_view_product.on( 'click', function (e) {

        e.preventDefault();

        let product_id  =   $(this).data( 'id-product' );

        $.ajax({

            url: woo_quick_view_product.url,
            type: 'POST',
            data: ({

                action: 'nhakhoa_get_quick_view_product',
                product_id: product_id

            }),

            beforeSend: function () {

            },

            success: function( data ){

                if ( data ){

                    site_shop_product.empty().append(data).find( 'li.product' ).addClass( 'popIn' );

                }

                setTimeout( function() {

                    site_shop_product.find( 'ul.products li.product' ).removeClass( 'popIn' );

                }, 800 );

            }

        });


    } );

} )( jQuery );