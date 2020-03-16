<?php
$nhakhoa_post_type = get_post_type( get_the_ID() );

if ( $nhakhoa_post_type != 'page' ) :

    get_template_part( 'template-parts/archive/content', 'archive-info' );

else:

?>

    <h2 class="site-post-title">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
        </a>
    </h2>

<?php endif; ?>








