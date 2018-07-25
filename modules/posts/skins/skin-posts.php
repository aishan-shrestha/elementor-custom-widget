<?php
use Elementor\Controls_Manager;
class Custom_Posts_Skin extends \ElementorPro\Modules\Posts\Skins\Skin_Cards {
	public function __construct( $parent ) {
      parent::__construct( $parent );
    }
	public function get_id() {
		return 'cards-rebud';
	}
	public function get_title() {
		return __( 'Custom Cards Rebuild', 'elementor-pro' );
	}

	protected function register_meta_data_controls() {
		$this->add_control(
			'meta_data',
			[
				'label' => __( 'After Title Meta Data', 'elementor-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => [ 'date', 'comments' ],
				'multiple' => true,
				'options' => [
					'author' => __( 'Author', 'elementor-pro' ),
					'date' => __( 'Date', 'elementor-pro' ),
					'time' => __( 'Time', 'elementor-pro' ),
					'comments' => __( 'Comments', 'elementor-pro' ),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'second_meta_data',
			[
				'label' => __( 'After Excerpt Text Meta Data', 'elementor-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => [ 'date', 'comments' ],
				'multiple' => true,
				'options' => [
					'category' => __( 'Category', 'elementor-pro' ),
					'tags' => __( 'Tags', 'elementor-pro' ),
					'comments' => __( 'Comments', 'elementor-pro' ),
				],
				'separator' => 'before',
			]
		);

	}
	public function register_badge_controls() { }

	protected function render_meta_data() {
		/** @var array $settings. e.g. [ 'author', 'date', ... ] */
		$settings = $this->get_instance_value( 'meta_data' );

		if ( empty( $settings ) ) {
			return;
		}
		?>
		<div class="elementor-post__meta-data">
			<?php
			if ( in_array( 'date', $settings ) ) {
				$this->render_date();
			}

			if ( in_array( 'author', $settings ) ) {
				$this->render_author();
			}


			if ( in_array( 'time', $settings ) ) {
				$this->render_time();
			}

			if ( in_array( 'comments', $settings ) ) {
				$this->render_comments();
			}
			?>
		</div>
		<?php
	}

	protected function render_date() {
		?>
		<span class="elementor-post-date">
			<?php
			/** This filter is documented in wp-includes/general-template.php */
			echo 'Posted on '.apply_filters( 'the_date', get_the_date(), get_option( 'date_format' ), '', '' );
			?>
		</span>
		<?php
	}

	protected function render_author() {
		?>
		<span class="elementor-post-author">
			by <?php the_author(); ?>
		</span>
		<?php
	}

	protected function render_excerpt() {
		if ( ! $this->get_instance_value( 'show_excerpt' ) ) {
			return;
		}

		add_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );

		?>
		<div class="elementor-post__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php

		remove_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );
		remove_filter( 'excerpt_more', [ $this, 'filter_excerpt_more' ], 20 );
	}

	protected function render_after_excerpt_meta() {
		/** @var array $settings. e.g. [ 'author', 'date', ... ] */
		$settings = $this->get_instance_value( 'second_meta_data' );
		if ( empty( $settings ) ) {
			return;
		}
		?>
		<div class="elementor-post__after_excerpt_meta-data">
			<?php
			if ( in_array( 'category', $settings ) ) {
				$this->render_category();
			}

			if ( in_array( 'tags', $settings ) ) {
				$this->render_tags();
			}

			if ( in_array( 'comments', $settings ) ) {
				$this->render_comments();
			}
			?>
		</div>
		<?php
	}

	protected function render_category() {
		$post_id = get_the_ID();
		$category_object = get_the_category($post_id);

		if($category_object) : ?>
		<span class="cat-links">
			Posted in
			<?php
			$resultstr = array();
			foreach ($category_object as $category) {
			  $resultstr[] = '<a href="'.esc_url( get_category_link($category->cat_ID) ).'" rel="category tag">'. $category->name.'</a>';
			}
			echo implode(",",$resultstr);
			?>

		</span>
		<?php
		endif;
	}
	protected function render_tags() {
		$post_id = get_the_ID();
		$tags_object = get_the_tags($post_id);
		if($tags_object) : ?>
		<span class="tags-links">
			Tagged
			<?php
			$resultstr = array();
			foreach ($tags_object as $tag) {
			  $resultstr[] = '<a href="'.esc_url( get_tag_link($tag->term_id) ).'" rel="tag tag">'. $tag->name.'</a>';
			}
			echo implode(",",$resultstr);
			?>

		</span>
		<?php
		endif;
		?>
		<?php
	}
	protected function render_comments() {
		?>
		<span class="comments-link">
			<a href="<?php the_permalink() ?>#respond">Leave a Comment</a>
		</span>
		<?php
	}

	protected function render_post() {
		$this->render_post_header();
		$this->render_thumbnail();
		$this->render_text_header();
		$this->render_title();
		$this->render_meta_data();
		$this->render_excerpt();
		$this->render_read_more();
		$this->render_after_excerpt_meta();
		$this->render_text_footer();
		$this->render_post_footer();
	}

}