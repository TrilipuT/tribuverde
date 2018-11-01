<?php while ( have_posts() ): the_post(); ?>
    <a class="item" data-aos="fade-<?= $wp_query->current_post % 2 ? 'right' : 'left' ?>"
       href="<?php the_permalink() ?>">
		<?php the_post_thumbnail( $wp_query->current_post % 2 ? 'grid-2' : 'grid-1' ) ?>
        <div class="info">
            <h2><?php the_title() ?></h2>
			<?php if ( has_excerpt() ): ?>
                <p><?php the_excerpt() ?></p>
			<?php endif; ?>
        </div>
    </a>
<?php endwhile; ?>