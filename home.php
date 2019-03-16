<?php get_header(); ?>
    <div class="navigation" data-aos="fade-in">
		<?php include( "assets/built/images/front-page.svg" ); ?>
    </div>
    <div class="navigation-mobile">
	    <?php wp_nav_menu( [
		    'theme_location'  => 'main',
		    'depth'           => 1,
		    'container'       => 'nav',
		    'container_class' => 'menu-content',
		    'menu_class'      => 'menu-items-content',
		    'link_before'     => '<span data-aos="fade-right" data-aos-delay="200">',
		    'link_after'      => '</span>',
	    ] ) ?>
        <!-- <a href="<?= home_url( '/about' ) ?>" class="about" data-aos="fade-right" data-aos-delay="200"><span>Хто ми</span></a>
        <a href="<?= home_url( '/projects' ) ?>" class="projects" data-aos="fade-left" data-aos-delay="300"><span>Проекти</span></a>
        <a href="<?= home_url( '/shop' ) ?>" class="shop" data-aos="fade-in" data-aos-delay="400"><span>Крамниця</span></a>
        <a href="<?= home_url( '/films' ) ?>" class="films" data-aos="fade-right" data-aos-delay="500"><span>Фільми</span></a> -->
    </div>
<?php get_footer(); ?>