<?php if ( $categories = Film::get_categories() ): ?>
    <ul class="categories">
		<?php foreach ( $categories as $i => $category ): ?>
            <li class="<?= Film::is_current_category( $category ) ? 'current' : '' ?>" data-aos="fade-top"
                data-aos-delay="<?= 400 + 100 * $i ?>">
                <a href="<?= get_category_link( $category ) ?>"><?= $category->name ?></a>
            </li>
		<?php endforeach; ?>
    </ul>
<?php endif; ?>