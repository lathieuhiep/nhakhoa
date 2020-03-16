
<?php if( is_active_sidebar( 'nhakhoa-sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( nhakhoa_col_sidebar() ); ?> site-sidebar order-1">
        <?php dynamic_sidebar( 'nhakhoa-sidebar-main' ); ?>
    </aside>

<?php endif; ?>