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
    <div class="forest">
<!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">-->
<!--            <defs>-->
<!--                <clipPath id="mask">-->
<!--                    <path d="M62.27 336.44c44.6 33.56 113.71 20.67 156.79-13.96 22.14-17.91 28.3-44.73 29.26-71.98.9-17.63-3.03-31.28-12.97-46.16-7.55-10.86-13.51-20.11-15.84-33.75-3.1-19.26 1.81-37.67 11.92-54.04 7.28-11.98 14.96-23.56 16.25-38.39 5.91-52.87-69.17-101.38-111.86-64.75-22.95 19.51-41.14 47.06-44.51 76.7-2.94 23.63-10.62 35.21-29.13 48.73-19.31 13.52-39.41 23.83-51.16 45.8-10.93 19.58-29.76 90.81 51.26 151.78z"/>-->
<!--                </clipPath>-->
<!--            </defs>-->
<!--            <g clip-path="url(#mask)">-->
<!--                <image xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                       xlink:href="--><?//= get_template_directory_uri() ?><!--/assets/built/images/forest.jpg" width="1120px"-->
<!--                       height="840px"></image>-->
<!--            </g>-->
<!--        </svg>-->


        <!--         <img src="--><? //= get_template_directory_uri() ?><!--/assets/built/images/forest.jpg" alt="">-->
        <!--        <svg xmlns="http://www.w3.org/2000/svg" viewBox="600 550 0 0" width="600" height="300">-->
        <!--            <defs>-->
        <!--                <clipPath id="forest-mask">-->
        <!--                    <path d="M62.27 336.44c44.6 33.56 113.71 20.67 156.79-13.96 22.14-17.91 28.3-44.73 29.26-71.98.9-17.63-3.03-31.28-12.97-46.16-7.55-10.86-13.51-20.11-15.84-33.75-3.1-19.26 1.81-37.67 11.92-54.04 7.28-11.98 14.96-23.56 16.25-38.39 5.91-52.87-69.17-101.38-111.86-64.75-22.95 19.51-41.14 47.06-44.51 76.7-2.94 23.63-10.62 35.21-29.13 48.73-19.31 13.52-39.41 23.83-51.16 45.8-10.93 19.58-29.76 90.81 51.26 151.78z"/>-->
        <!--                </clipPath>-->
        <!--            </defs>-->
        <!--        </svg>-->
    </div>
    <div class="logo-animation">
        <span class="top-part" data-aos="fade-top"
              data-aos-delay="400"
              data-aos-easing="ease-in-sine">TRIBU</span>
        <span class="right-part">VERDE</span>
    </div>

</div>