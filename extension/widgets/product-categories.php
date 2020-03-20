<?php
/**
 * Widget Name: Recent Post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class nhakhoa_product_cate_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */

	public function __construct() {

		$widget_ops = array(
			'classname'     =>  'nhakhoa_product_cate_widget',
			'description'   =>  esc_html__( 'A widget show category product', 'nhakhoa' ),
		);

		parent::__construct( 'nhakhoa_product_cate_widget', 'Nha Khoa: Product Categories', $widget_ops );

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$terms = get_terms( array(
			'taxonomy'      =>  'product_cat',
			'hide_empty'    =>  true,
            'parent'        =>  0
		) );

		if ( !empty( $terms ) ):
	?>

		<div class="product-cate-widget-warp">
            <ul class="product-categories">
                <?php

                foreach ( $terms as $item ):
	                $has_cate_children  =   get_term_children( $item->term_id, 'product_cat' );
	                $class_cat          =   '';

                    if ( is_tax( 'product_cat', $item->slug ) ):
	                    $class_cat .= ' current-cat';
                    endif;

                    if ( !empty( $has_cate_children ) ):
	                    $class_cat .= ' cat-parent';
                    endif;

                ?>

                <li class="cat-item<?php echo esc_attr( $class_cat ); ?>">
                    <a href="<?php echo esc_url( get_term_link( $item->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $item->name ); ?>">
		                <?php
		                echo esc_html( $item->name ); var_dump($has_cate_children);
		                ?>
                    </a>

	                <?php if ( !empty( $has_cate_children ) ) : ?>

		                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
			                <i class="fas fa-plus"></i>
			                <i class="fas fa-minus"></i>
		                </button>

		                <ul class="children collapse" id="multiCollapseExample2">
			                <?php
			                foreach ( $has_cate_children as $item_children ):

				                $class_cat_child_current    =   '';
				                $cate_children_product      =   get_term_by('term_id', $item_children, 'product_cat');

			                if ( is_tax( 'product_cat', $cate_children_product->slug ) ):
				                $class_cat_child_current = ' current-cat';
			                endif;

			                ?>

				                <li class="cat-item<?php echo esc_attr( $class_cat_child_current ); ?>">
					                <a href="<?php echo esc_url( get_term_link( $item_children, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $cate_children_product->name ); ?>">
						                <?php echo esc_html( $cate_children_product->name ); ?>
					                </a>
				                </li>

			                <?php endforeach; ?>
		                </ul>

	                <?php endif; ?>
                </li>

                <?php endforeach; ?>
            </ul>
        </div>

	<?php

        endif;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {

		$defaults = array(
			'title' => 'Danh mục sản phẩm',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Danh mục sản phẩm', 'nhakhoa' ); ?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

	<?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      =   strip_tags( $new_instance['title'] );

		return $instance;
	}

}

// Register widget
function nhakhoa_product_cate_widget_register() {
	register_widget( 'nhakhoa_product_cate_widget' );
}

add_action( 'widgets_init', 'nhakhoa_product_cate_widget_register' );