<?php get_header(); ?>
    <section>
        <div class="container">
			<?php the_post(); ?>
            <article>
                <h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ): ?>
                    <div class="page-excerpt content">
						<?php the_excerpt(); ?>
                    </div>
				<?php endif; ?>
                <div class="page-content content">
					<?php the_content(); ?>
                </div>
            </article>
        </div>
    </section>
<?php get_footer(); ?>