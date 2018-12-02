<!DOCTYPE html>
<html <?php language_attributes() ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( "charset" ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>

<?php if ( ! is_home() ): ?>
    <aside class="menu">
        <label class="menu-toggler-burger">
            <i class="menu-toggler-burger-line"></i>
            <i class="menu-toggler-burger-line"></i>
            <i class="menu-toggler-burger-line"></i>
        </label>

        <div class="menu-holder">
			<?php wp_nav_menu( [
				'theme_location'  => 'main',
				'depth'           => 1,
				'container'       => 'nav',
				'container_class' => 'menu-content',
				'menu_class'      => 'menu-items-content',
				'link_before'     => '<span data-aos="fade-right">',
				'link_after'      => '</span>',
			] ) ?>
        </div>

    </aside>
<?php endif; ?>
<div class="background">
    <div class="logo-animation">
        <span class="top-part" data-aos="fade-top"
              data-aos-delay="400"
              data-aos-easing="ease-in-sine">TRIBU</span>
        <span class="right-part" data-aos="fade-top"
              data-aos-delay="400"
              data-aos-easing="ease-in-sine">VERDE</span>
    </div>
</div>
<svg id="forest" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" data-aos="fade-in">
    <defs>
        <clipPath id="mask">
            <path class="st0" id="mask-source"
                  d="M29.3,161.2c22.5,14.6,54.6,9.9,75.3-6.7c10.6-8.6,14.8-20.3,15.3-33.4c0.4-8.5-2.7-16.2-7.4-23.3c-3.6-5.2-6.5-9.7-7.6-16.2c-1.5-9.2,0.9-18.1,5.7-25.9c3.5-5.8,7.2-11.3,7.8-18.4c2.8-25.4-33.2-48.7-53.7-31.1c-11,9.4-19.7,22.6-21.4,36.8c-1.4,11.3-5.1,16.9-14,23.4c-9.3,6.5-18.9,11.4-24.6,22C-0.6,97.7-9.2,136.1,29.3,161.2z"></path>
        </clipPath>
    </defs>
    <g clip-path="url(#mask)">
        <image xmlns:xlink="http://www.w3.org/1999/xlink"
               xlink:href="<?= get_template_directory_uri() ?>/assets/built/images/forest.jpg"
               width="1120px" height="840px"></image>
    </g>
</svg>