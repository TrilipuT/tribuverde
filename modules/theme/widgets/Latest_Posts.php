<?php

namespace modules\theme\widgets;

use modules\news\Initialization;

/**
 *
 * @package    comma
 * @author     vitaly
 *
 */
class Latest_Posts extends \WPKit\Widgets\AbstractWidget {
	protected function _get_config() {
		return [
			'id'              => 'latest_posts',
			'name'            => __( 'Recent Posts' ),
			'widget_options'  => array( 'classname' => '' ),
			'control_options' => array(),
		];
	}

	protected function _build_fields() {
		$this->_add_field( 'title', __( 'Title', TEXT_DOMAIN ) );
	}

	protected function _render( $args, $data ) {
		$title = ( ! empty( $data['title'] ) ) ? $data['title'] : __( 'Recent Posts' );

		$number = ( ! empty( $data['number'] ) ) ? absint( $data['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		$r = new \WP_Query( apply_filters( 'widget_posts_args', array(
			'post_type'           => Initialization::POST_TYPE,
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'post__not_in'        => [ get_the_ID() ],
		) ) );

		if ( $r->have_posts() ) : ?>
            <div class="last-news">
				<?php if ( $title ) :
					echo $args['before_title'] . $title . $args['after_title'];
				endif;
				while ( $r->have_posts() ) : $r->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="last-news-item">
						<?php if ( has_post_thumbnail() ): ?>
                            <div class="thumbnail-container">
								<?php the_post_thumbnail( 'thumbnail' ) ?>
                            </div>
						<?php endif; ?>
                        <div class="text-container">
                            <p>
								<?php the_title() ?>
                            </p>
                        </div>
                    </a>
				<?php endwhile;
				wp_reset_postdata(); ?>
            </div>
			<?php
		endif;
	}

}