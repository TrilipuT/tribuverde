<?php get_header(); ?>
<section class="error404">
	<div class="container">
		<div class="row">
			<div class="error-image">
				<figure>
					<figcaption>404</figcaption>
					<img src="<?= get_template_directory_uri(); ?>/assets/built/images/sad-robot.png" alt="404">
				</figure>
			</div>
			<div class="error-text">
				<h1><?php _e('Uh oh...', 'datarobot3'); ?></h1>
				<p>
					<?php _e("We couldn't find the page you're looking for.", "datarobot3"); ?>
					<br>
					<?php _e("Try starting with the home page.", "datarobot3"); ?>
				</p>
				<a href="/" class="bg-filled-blue button"><?php _e('Go to the homepage', 'datarobot3'); ?></a>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
<?php get_template_part('end'); ?>