<?php
get_header();

global $nhakhoa_options;

$nhakhoa_title = $nhakhoa_options['nhakhoa_404_title'];
$nhakhoa_content = $nhakhoa_options['nhakhoa_404_editor'];
$nhakhoa_background = $nhakhoa_options['nhakhoa_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $nhakhoa_background ) ):
                        echo wp_get_attachment_image( $nhakhoa_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $nhakhoa_title != '' ):
                        echo esc_html( $nhakhoa_title );
                    else:
                        esc_html_e( 'Awww...Do Not Cry', 'nhakhoa' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $nhakhoa_content != '' ) :
                        echo wp_kses_post( $nhakhoa_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( 'It is just a 404 Error!', 'nhakhoa' ); ?>
                            <br />
                            <?php esc_html_e( 'What you are looking for may have been misplaced', 'nhakhoa' ); ?>
                            <br />
                            <?php esc_html_e( 'in Long Term Memory.', 'nhakhoa' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'nhakhoa'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'nhakhoa'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>