<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class nhakhoa_widget_text_box extends Widget_Base {

    public function get_categories() {
        return array( 'nhakhoa_widgets' );
    }

    public function get_name() {
        return 'nhakhoa-text-box';
    }

    public function get_title() {
        return esc_html__( 'Tiện ích', 'nhakhoa' );
    }

    public function get_icon() {
        return 'fa fa-file-text-o';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'nhakhoa' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     =>  esc_html__( 'Icon', 'nhakhoa' ),
                'type'      =>  Controls_Manager::ICONS,
                'default' => [
	                'value' => 'fas fa-tools',
	                'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'nhakhoa' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Miễn phí vận chuyển', 'nhakhoa' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();

    ?>

        <div class="element-text-box d-flex align-items-center">
            <div class="icon">
	            <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>

            <div class="content">
                <h4 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h4>
            </div>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <#
        var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
        #>

        <div class="elementor-text-box d-flex">
            <div class="icon-image">
                {{{ iconHTML.value }}}
            </div>

            <div class="content">
                <h4 class="title">
                    {{{ settings.title }}}
                </h4>
            </div>
        </div>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new nhakhoa_widget_text_box );