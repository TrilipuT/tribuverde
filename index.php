<?php get_header(); ?>
    <section>
        <div class="container">
			<?php the_post(); ?>
            <article>
                <h1 class="page-title" data-aos="fade-in" data-aos-delay="300"><span><?php the_title(); ?></span></h1>
				<?php if ( has_excerpt() ): ?>
                    <div class="page-excerpt content" data-aos="fade-in" data-aos-delay="400">
						<?php the_excerpt(); ?>
                    </div>
				<?php endif; ?>
                <div class="page-content content" data-aos="fade-in" data-aos-delay="500">
					<?php the_content(); ?>
                </div>
            </article>
        </div>
    </section>
<?php get_footer(); ?>