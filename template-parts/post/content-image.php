<?php if ( has_post_thumbnail() ) :?>

    <div class="site-post-image">
        <?php the_post_thumbnail('full'); ?>
    </div>

<?php endif; ?>