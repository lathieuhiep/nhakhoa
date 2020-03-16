<?php $nhakhoa_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $nhakhoa_unique_id; ?>">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'nhakhoa' ); ?></span>
    </label>
    <input type="search" id="<?php echo $nhakhoa_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'nhakhoa' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit">
        <span class="search-reader-text">
            <?php echo _x( 'Search', 'submit button', 'nhakhoa' ); ?>
        </span>
    </button>
</form>