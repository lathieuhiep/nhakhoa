<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class nhakhoa_widget_product_brand extends Widget_Base {

	public function get_categories() {
		return array( 'nhakhoa_widgets' );
	}

	public function get_name() {
		return 'nhakhoa-product-brand';
	}

	public function get_title() {
		return esc_html__( 'Thương hiệu sản phẩm', 'nhakhoa' );
	}

	public function get_icon() {
		return 'fas fa-shopping-cart';
	}

	public function get_script_depends() {
		return ['nhakhoa-elementor-custom'];
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
					'{{WRAPPER}} .element-product-brand .heading-product .title-heading' => 'background-image: url({{URL}})',
				],
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         =>  esc_html__( 'Heading', 'nhakhoa' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Ghế nha khoa theo thương hiệu', 'nhakhoa' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'image_brand',
			[
				'label'     =>  esc_html__( 'Image Brand', 'nhakhoa' ),
				'type'      =>  Controls_Manager::MEDIA,
				'default'   =>  [
					'url'   =>  Utils::get_placeholder_image_src(),
				],
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
				'label'         =>  esc_html__( 'Chọn Thương Hiệu', 'nhakhoa' ),
				'type'          =>  Controls_Manager::SELECT,
				'options'       =>  nhakhoa_check_get_cat( 'product_cat', '0' ),
				'label_block'   =>  true,
			]
		);

		$this->add_control(
			'limit',
			[
				'label'     =>  esc_html__( 'Number of Product', 'nhakhoa' ),
				'type'      =>  Controls_Manager::NUMBER,
				'default'   =>  6,
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

		/* Start Section Button */
		$this->start_controls_section(
			'section_button',
			[
				'label' =>  esc_html__( 'Button', 'sport' )
			]
		);

		$this->add_control(
			'text_button',
			[
				'label'         =>  esc_html__( 'Text button', 'nhakhoa' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Xem tất cả', 'nhakhoa' ),
				'label_block'   =>  true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings       =   $this->get_settings_for_display();
		$select_cat     =   $settings['select_cat'];

		if ( !empty( $select_cat ) ) :

			$term_children = get_term_children( $select_cat, 'product_cat' );

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

			$term_children = '';

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

		<div class="element-product-brand element-product">
            <div class="heading-product">
                <h2 class="title-heading">
					<?php echo esc_html( $settings['heading'] ); ?>
                </h2>
            </div>

			<div class="row row-no-margin">
				<div class="col-12 col-md-4 d-flex flex-column item-col-no-padding">
					<div class="list-brand d-flex flex-column flex-grow-1">
						<div class="list-brand__image">
							<?php echo wp_get_attachment_image( $settings['image_brand']['id'], 'full' ); ?>
						</div>

                        <?php if ( !empty( $term_children ) ): ?>

                            <div class="list-brand-box d-flex flex-column flex-grow-1 justify-content-between">
                                <ul class="list-brand-item">
                                    <?php
                                    foreach ( $term_children as $child ) :
	                                    $term = get_term_by( 'id', $child, 'product_cat' );
                                    ?>

                                        <li class="item-brand">
                                            <a href="<?php echo esc_url( get_term_link( $child, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
                                                <?php echo esc_html( $term->name ); ?>
                                            </a>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>

                                <div class="list-link-all-brand">
                                    <a href="<?php echo esc_url( get_term_link( (int)$select_cat, 'product_cat' ) ); ?>">
		                                <?php echo esc_html( $settings['text_button'] ); ?>
                                    </a>
                                </div>
                            </div>

                        <?php endif; ?>

					</div>
				</div>

				<div class="col-12 col-md-8 item-col-no-padding">
					<div class="get-product-box">
						<div class="row">
							<?php
							while ( $query->have_posts() ):
								$query->the_post();
							?>

								<div class="col-12 col-sm-6 col-md-4 item-col d-flex">
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
				</div>
			</div>
		</div>

	<?php

		endif;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new nhakhoa_widget_product_brand );