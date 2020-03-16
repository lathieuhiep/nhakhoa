<div class="site-post-content">
    <h2 class="site-post-title">
        <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
            <?php if ( is_sticky() && is_home() ) : ?>
                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
            <?php
            endif;

            the_title();
            ?>
        </a>
    </h2>

    <?php
    nhakhoa_post_formats();

    nhakhoa_post_meta();
    ?>

    <div class="site-post-excerpt">
        <p>
            <?php
            if ( has_excerpt() ) :
                echo esc_html( get_the_excerpt() );
            else:
                echo wp_trim_words( get_the_content(), 30, '...' );
            endif;
            ?>
        </p>

        <a href="<?php the_permalink();?>" class="text-read-more">
            <?php esc_html_e(  'Read more','nhakhoa' ); ?>
        </a>

        <?php nhakhoa_link_page(); ?>

    </div>
</div>