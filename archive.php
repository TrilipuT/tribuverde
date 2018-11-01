<?php get_header(); ?>
    <section class="posts-listing">
        <div class="container">
            <h1 class="page-title" data-aos="fade-in" data-aos-delay="300"><?= get_post_type_labels( get_queried_object() )->name ?></h1>
            <div class="page-content">
				<?php get_template_part( 'parts/categories', get_post_type() ); ?>
                <div class="list">
					<?php get_template_part( 'parts/list' ); ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();