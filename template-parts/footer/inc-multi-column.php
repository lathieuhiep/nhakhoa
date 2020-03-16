<?php
//Global variable redux
global $nhakhoa_options;

$multi_column     =   $nhakhoa_options ["nhakhoa_footer_multi_column"];
$multi_column_l   =   $nhakhoa_options ["nhakhoa_footer_multi_column_1"];
$multi_column_2   =   $nhakhoa_options ["nhakhoa_footer_multi_column_2"];
$multi_column_3   =   $nhakhoa_options ["nhakhoa_footer_multi_column_3"];
$multi_column_4   =   $nhakhoa_options ["nhakhoa_footer_multi_column_4"];

if( is_active_sidebar( 'nhakhoa-sidebar-footer-multi-column-1' ) || is_active_sidebar( 'nhakhoa-sidebar-footer-multi-column-2' ) || is_active_sidebar( 'nhakhoa-sidebar-footer-multi-column-3' ) || is_active_sidebar( 'nhakhoa-sidebar-footer-multi-column-4' ) ) :

?>

    <div class="site-footer__multi--column">
        <div class="container">
            <div class="row">
                <?php
                for( $i = 0; $i < $multi_column; $i++ ):

                    $j = $i +1;

                    if ( $i == 0 ) :
                        $nhakhoa_col = $multi_column_l;
                    elseif ( $i == 1 ) :
                        $nhakhoa_col = $multi_column_2;
                    elseif ( $i == 2 ) :
                        $nhakhoa_col = $multi_column_3;
                    else :
                        $nhakhoa_col = $multi_column_4;
                    endif;

                    if( is_active_sidebar( 'nhakhoa-sidebar-footer-multi-column-'.$j ) ):
                ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $nhakhoa_col ); ?>">

                        <?php dynamic_sidebar( 'nhakhoa-sidebar-footer-multi-column-'.$j ); ?>

                    </div>

                <?php
                    endif;

                endfor;
                ?>
            </div>
        </div>
    </div>

<?php endif; ?>