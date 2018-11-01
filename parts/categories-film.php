<?php if ( $categories = Film::get_categories() ): ?>
	<ul class="categories">
		<?php foreach ( $categories as $category ): ?>
			<li class="<?= Film::is_current_category( $category ) ? 'current' : '' ?>">
				<a href="<?= get_category_link( $category ) ?>"><?= $category->name ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>