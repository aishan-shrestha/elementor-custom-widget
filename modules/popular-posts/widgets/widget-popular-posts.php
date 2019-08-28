<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Popular_Posts extends Widget_Base {

	public function get_name() {

		return 'popular-posts';
	}

	public function get_title() {
		return __( 'Popular Posts', 'elementor-custom-widget' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	protected function _register_controls() {


		/*
		 * start control section and followup with adding control fields.
		 * end control after all control field and repeat if you need other control section respectively.
		*/

		/*
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elementor-custom-widget' ),
			]
		);
		$this->add_control(
			'sample_text',
			[
				'label' => __( 'Primary Text', 'elementor-custom-widget' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter some text', 'elementor-custom-widget' ),
			]
		);
		$this->end_controls_section();
		*/

		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Basic', 'elementor-custom-widget' ),
			]
		);
		$this->add_control(
			'heading_text',
			[
				'label' => __( 'Heading Text', 'elementor-custom-widget' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter some text', 'elementor-custom-widget' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Number of Posts', 'elementor-custom-widget' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1  => __( 'One', 'elementor-custom-widget' ),
					2  => __( 'Two', 'elementor-custom-widget' ),
					5  => __( 'Five', 'elementor-custom-widget' ),
					10 => __( 'Ten', 'elementor-custom-widget' ),
					-1 => __( 'All', 'elementor-custom-widget' ),

				]
			]
		);
		$this->end_controls_section();



	}

	protected function render( $instance = [] ) {
		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();
		$custom_text = ! empty( $settings['heading_text'] ) ? $settings['heading_text'] : ' Popular Posts ';
		$post_count = ! empty( $settings['posts_per_page'] ) ? (int)$settings['posts_per_page'] : 1;
		?>
		<h3><?php echo $custom_text; ?></h3>
		<ul class="popular-posts">
			<?php
			$args = array( 'numberposts' => $post_count );
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $recent ){
				echo '<li><a href="' . esc_url( get_permalink( $recent["ID"] ) ). '">' .   esc_html( $recent["post_title"] ).'</a> </li> ';
			}
			wp_reset_query();
			?>
		</ul>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_Popular_Posts() );
