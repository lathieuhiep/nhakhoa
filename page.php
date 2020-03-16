<?php
get_header();

$nhakhoa_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$nhakhoa_class_elementor =   '';

if ( $nhakhoa_check_elementor ) :
    $nhakhoa_class_elementor =   ' site-container-elementor';
endif;

?>

    <main class="site-container<?php echo esc_attr( $nhakhoa_class_elementor ); ?>">

        <?php
        if ( $nhakhoa_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>

    </main>

<?php 

get_footer();