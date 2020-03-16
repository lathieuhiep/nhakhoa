<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action( 'wp_head','nhakhoa_config_theme' );

        function nhakhoa_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $nhakhoa_options;
                    $nhakhoa_favicon = $nhakhoa_options['nhakhoa_favicon_upload']['url'];

                    if( $nhakhoa_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url( $nhakhoa_favicon ) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'nhakhoa_custom_css', 99 );

        function nhakhoa_custom_css() {

            global $nhakhoa_options;

            $nhakhoa_typo_selecter_1   =   $nhakhoa_options['nhakhoa_custom_typography_1_selector'];

            $nhakhoa_typo1_font_family   =   $nhakhoa_options['nhakhoa_custom_typography_1']['font-family'] == '' ? '' : $nhakhoa_options['nhakhoa_custom_typography_1']['font-family'];

            $nhakhoa_css_style = '';

            if ( $nhakhoa_typo1_font_family != '' ) :
                $nhakhoa_css_style .= ' '.esc_attr( $nhakhoa_typo_selecter_1 ).' { font-family: '.balanceTags( $nhakhoa_typo1_font_family, true ).' }';
            endif;

            if ( $nhakhoa_css_style != '' ) :
                wp_add_inline_style( 'nhakhoa-style', $nhakhoa_css_style );
            endif;

        }

    endif;
