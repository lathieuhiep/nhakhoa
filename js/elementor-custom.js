(function ($) {

    /* Start Carousel slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find( '.custom-owl-carousel' );

        $( document ).general_owlCarousel_custom( element_slides );

    };

    let ElementTestimonialFlip  =   function( $scope, $ ) {

        let element_slides  =   $scope.find( '.element-testimonial-flipster' ),
            item_avatar     =   $scope.find( '.element-testimonial .item-avatar' );

        element_slides.each( function () {

            $(this).flipster({
                style: 'carousel',
                spacing: -0.1,
                scrollwheel: false,
                nav: false,
                buttons: true,
                onItemSwitch: function ( currentItem, previousItem ) {

                     let data_index     =   $( currentItem ).data( 'index' ),
                         element_parent =   $(this).closest( '.element-testimonial' );

                    element_parent.find( '.element-testimonial-text .item-text' ).removeClass( 'active-text' );
                    element_parent.find( '.element-testimonial-text .item-text[data-index=' + data_index + ']' ).addClass('active-text');

                }
            });

            let data_flipster_index =  $(this).find( '.flipster__item--current' ).data( 'index' );

            $(this).parent().find( '.element-testimonial-text .item-text[data-index=' + data_flipster_index + ']' ).addClass('active-text');

        } );

        item_avatar.on( 'click', function () {

            let data_index_avatar   =   $(this).data( 'index' ),
                element_parent      =   $(this).closest( '.element-testimonial' );

            element_parent.find( '.element-testimonial-text .item-text' ).removeClass( 'active-text' );
            element_parent.find( '.element-testimonial-text .item-text[data-index=' + data_index_avatar + ']' ).addClass('active-text');

        } );

    };

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/nhakhoa-slides.default', ElementCarouselSlider );

        /* Element testimonial */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/nhakhoa-testimonial.default', ElementTestimonialFlip );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/nhakhoa-testimonial.default', ElementCarouselSlider );

        /* Element post carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/nhakhoa-post-carousel.default', ElementCarouselSlider );

    } );

})( jQuery );