<?php
get_header();

global $nhakhoa_options;

$nhakhoa_blog_sidebar_single = !empty( $nhakhoa_options['nhakhoa_blog_sidebar_single'] ) ? $nhakhoa_options['nhakhoa_blog_sidebar_single'] : 'right';

$nhakhoa_class_col_content = nhakhoa_col_use_sidebar( $nhakhoa_blog_sidebar_single, 'nhakhoa-sidebar-main' );

get_template_part( 'template-parts/breadcrumbs/inc', 'breadcrumbs' );
?>

<div class="site-container site-single">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $nhakhoa_class_col_content ); ?>">

                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>

            </div>

            <?php
            if ( $nhakhoa_blog_sidebar_single !== 'hide' ) :
	            get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

