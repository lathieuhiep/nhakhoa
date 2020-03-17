<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class nhakhoa_widget_product_list extends Widget_Base {

	public function get_categories() {
		return array( 'nhakhoa_widgets' );
	}

	public function get_name() {
		return 'nhakhoa-product-list';
	}

	public function get_title() {
		return esc_html__( 'Danh sách sản phẩm', 'nhakhoa' );
	}

	public function get_icon() {
		return 'fas fa-shopping-cart';
	}

	protected function _register_controls() {

		/* Start Section Heading */
		$this->start_controls_section(
			'section_heading',
			[
				'label' =>  esc_html__( 'Heading', 'sport' )
			]
		);

		$this->add_control(
			'image_heading',
			[
				'label'     =>  esc_html__( 'Image Heading', 'nhakhoa' ),
				'type'      =>  Controls_Manager::MEDIA,
				'default'   =>  [
					'url'   =>  Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .element-product-list .heading-product .title-heading' => 'background-image: url({{URL}})',
				],
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         =>  esc_html__( 'Heading', 'nhakhoa' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Tên danh mục', 'nhakhoa' ),
				'label_block'   =>  true
			]
		);

		$this->end_controls_section();

		/* Start Section Query */
		$this->start_controls_section(
			'section_query',
			[
				'label' =>  esc_html__( 'Query', 'sport' )
			]
		);

		$this->add_control(
			'select_cat',
			[
				'label'         =>  esc_html__( 'Select Category', 'nhakhoa' ),
				'type'          =>  Controls_Manager::SELECT,
				'options'       =>  nhakhoa_check_get_cat( 'product_cat' ),
				'label_block'   =>  true,
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

		if ( !empty( $select_cat ) ) :

			$args = array(
				'post_type'         =>  'product',
				'posts_per_page'    =>  $settings['limit'],
				'order'             =>  $settings['order'],
				'orderby'           =>  $settings['order_by'],
				'tax_query'         =>  array(
					array(
						'taxonomy'  =>  'product_cat',
						'field'     =>  'term_id',
						'terms'     =>  array( $select_cat ),
					)
				)
			);

		else:

			$args = array(
				'post_type'         =>  'product',
				'posts_per_page'    =>  $settings['limit'],
				'order'             =>  $settings['order'],
				'orderby'           =>  $settings['order_by'],
			);

		endif;

		$query = new \ WP_Query( $args );

		if ( $query->have_posts() ) :

		?>

			<div class="element-product-list element-product">
				<div class="heading-product">
					<h2 class="title-heading">
						<?php echo esc_html( $settings['heading'] ); ?>
					</h2>
				</div>

				<div class="product-list-box">
					<?php
					while ( $query->have_posts() ):
						$query->the_post();
					?>

						<div class="item-product">
							<div class="img-product">
								<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
									<?php the_post_thumbnail( 'large' ); ?>
								</a>
							</div>

							<div class="item-content">
								<h4 class="title-product">
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

Plugin::instance()->widgets_manager->register_widget_type( new nhakhoa_widget_product_list );