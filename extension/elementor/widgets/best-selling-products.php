<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class nhakhoa_widget_best_selling_products extends Widget_Base {

	public function get_categories() {
		return array( 'nhakhoa_widgets' );
	}

	public function get_name() {
		return 'nhakhoa-best-selling-products';
	}

	public function get_title() {
		return esc_html__( 'Sản phẩm bán chạy', 'nhakhoa' );
	}

	public function get_icon() {
		return 'fas fa-shopping-cart';
	}

	public function get_script_depends() {
		return ['nhakhoa-elementor-custom'];
	}

	protected function _register_controls() {

		/* Start Section Query */
		$this->start_controls_section(
			'section_query',
			[
				'label' =>  esc_html__( 'Query', 'sport' )
			]
		);

        $this->add_control(
            'select_type_product',
            [
                'label'     =>  esc_html__( 'Lấy sản phẩm theo', 'nhakhoa' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  1,
                'options'   =>  [
                    1   =>  esc_html__( 'Sản phẩm bán chạy', 'nhakhoa' ),
                    2   =>  esc_html__( 'Sản phẩm theo danh mục', 'nhakhoa' ),
                ],
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'total_sales_product',
            [
                'label'     =>  esc_html__( 'Số sản phẩm bán ra', 'nhakhoa' ),
                'type'      =>  Controls_Manager::NUMBER,
                'min'       =>  0,
                'max'       =>  '',
                'step'      =>  '1',
                'default'   =>  0,
                'condition' => [
                    'select_type_product' => '1',
                ],
            ]
        );

		$this->add_control(
			'select_cat',
			[
				'label'         =>  esc_html__( 'Select Category', 'nhakhoa' ),
				'type'          =>  Controls_Manager::SELECT2,
				'options'       =>  nhakhoa_check_get_cat( 'product_cat' ),
				'label_block'   =>  true,
				'multiple'      =>  true,
                'condition' => [
                    'select_type_product' => '2',
                ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'     =>  esc_html__( 'Number of Product', 'nhakhoa' ),
				'type'      =>  Controls_Manager::NUMBER,
				'default'   =>  12,
				'min'       =>  1,
				'max'       =>  100,
				'step'      =>  1,
			]
		);

		$this->add_control(
			'order',
			[
				'label'     =>  esc_html__( 'Order', 'nhakhoa' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'ASC',
				'options'   =>  [
					'ASC'   =>  esc_html__( 'Ascending', 'nhakhoa' ),
					'DESC'  =>  esc_html__( 'Descending', 'nhakhoa' ),
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'     =>  esc_html__( 'Order By', 'nhakhoa' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'id',
				'options'   =>  [
					'id'    =>  esc_html__( 'ID', 'nhakhoa' ),
					'title' =>  esc_html__( 'Title', 'nhakhoa' ),
					'date'  =>  esc_html__( 'Date', 'nhakhoa' ),
				],
			]
		);

		$this->end_controls_section();
		/* End Section Query */

	}

	protected function render() {

		$settings       =   $this->get_settings_for_display();
		$select_cat     =   $settings['select_cat'];

		if ( !empty( $select_cat ) && $settings['select_type_product'] == 2 ) :

			$args = array(
				'post_type'         =>  'product',
				'posts_per_page'    =>  $settings['limit'],
				'order'             =>  $settings['order'],
				'orderby'           =>  $settings['order_by'],
				'tax_query'         =>  array(
					array(
						'taxonomy'  =>  'product_cat',
						'field'     =>  'term_id',
						'terms'     =>  $select_cat,
					)
				)
			);

		else:

			$args = array(
				'post_type'         =>  'product',
				'posts_per_page'    =>  $settings['limit'],
				'meta_key'          =>  'total_sales',
				'order'             =>  $settings['order'],
				'orderby'           =>  'meta_value_num',
				'meta_query'        =>  array(
					array(
						'key'       => 'total_sales',
						'value'     => $settings['total_sales_product'],
						'compare'   => '>='
					)
				)
			);

        endif;

		$query = new \ WP_Query( $args );

		if ( $query->have_posts() ) :

	?>

		<div class="element-best-selling-product element-product">
            <div class="row">
                <?php
                while ( $query->have_posts() ):
                    $query->the_post();
                ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 item-col d-flex">
	                    <div class="item-product d-flex flex-column">
	                        <div class="img-product d-flex flex-grow-1">
	                            <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
	                                <?php the_post_thumbnail( 'large' ); ?>
	                            </a>

		                        <?php woocommerce_show_product_loop_sale_flash(); ?>
	                        </div>

	                        <div class="item-content d-flex flex-column flex-grow-1">
	                            <h4 class="title-product flex-grow-1">
	                                <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
	                                    <?php the_title(); ?>
	                                </a>
	                            </h4>

	                            <?php
	                            nhakhoa_woo_custom_html_rating();

                                woocommerce_template_loop_price();
                                ?>
	                        </div>
	                    </div>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
		</div>

	<?php

		endif;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new nhakhoa_widget_best_selling_products );