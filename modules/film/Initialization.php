<?php

namespace modules\film;


use WPKit\Module\AbstractModuleInitialization;
use WPKit\PostType\PostType;
use WPKit\Taxonomy\Taxonomy;

class Initialization extends AbstractModuleInitialization {
	const POST_TYPE = 'film';
	const FILMS = 'film_category';
	private $post_type;

	public function register_post_type() {
		$this->post_type = new PostType( self::POST_TYPE, __( 'Films', TEXT_DOMAIN ), [ 'name' => 'Фільми' ] );
		$this->post_type->set_supports( [ 'title', 'thumbnail', 'editor', 'excerpt' ] );
		$this->post_type->set_use_archive( 'films' );
		$this->post_type->set_menu_icon( 'dashicons-video-alt' );
		$this->post_type->set_show_in_rest( true );
		$this->post_type->set_rewrite( [ 'slug' => 'film' ] );

		$tax = new Taxonomy( self::FILMS, 'Category' );
		$tax->set_rewrite( [ 'slug' => 'film-category' ] );
		$tax->add_post_type( $this->post_type );


//		$meta = new MetaBox( 'info', __( 'Info', TEXT_DOMAIN ) );
//		$meta->add_field( 'client', __( 'Client', TEXT_DOMAIN ) );
//		$meta->add_field( 'year', __( 'Year' ) );
//		$meta->add_field( 'header_video', __( 'Header video', TEXT_DOMAIN ), function () {
//			$f = new File();
//			$f->set_accepts( [ 'video' ] );
//			$f->set_description( 'Прев\'ю, до 10 сек, маленький файл.' );
//
//			return $f;
//		} );
//		$meta->add_field( 'header_video_full', __( 'Header video full', TEXT_DOMAIN ), 'Video' );
//		$meta->add_field( 'making_of', __( 'Making of', TEXT_DOMAIN ), 'Video' );
//		$meta->add_field( 'making_of_thumb', __( 'Making of thumbnail', TEXT_DOMAIN ), 'Image' );
//		$meta->add_field( 'hover_video', __( 'Hover video', TEXT_DOMAIN ), function () {
//			$f = new File();
//			$f->set_accepts( [ 'video' ] );
//			$f->set_description( 'Відео на ховер' );
//
//			return $f;
//		} );
//		$meta->add_field( 'hover_video_wide', __( 'Hover video wide', TEXT_DOMAIN ), function () {
//			$f = new File();
//			$f->set_accepts( [ 'video' ] );
//			$f->set_description( 'Широке відео на ховер якщо кейс перший.' );
//
//			return $f;
//		} );
//		$meta->add_post_type( $this->post_type );
//
//		$videos = new MetaBoxRepeatable( 'videos', __( 'Video' ) );
//		$videos->set_priority( 'high' );
//		$videos->add_field( 'video', __( 'Video' ), 'Video' );
//		$videos->add_field( 'video_thumb', __( 'Video thumbnail' ), 'Image' );
//		$videos->add_post_type( $this->post_type );
//
//		$gallery = new MetaBoxRepeatable( 'gallery', __( 'Gallery' ) );
//		$gallery->add_field( 'image', __( 'Image' ), 'Image' );
//		$gallery->add_post_type( $this->post_type );
//
//		$frontpage_cases = new MetaBoxRelatedPosts( self::POST_TYPE, __( 'Cases', TEXT_DOMAIN ) );
//		$frontpage_cases->set_related_post_types( [ self::POST_TYPE ] );
//
//		if ( isset( $_GET['post'] ) && get_page_template_slug( $_GET['post'] ) == 'templates/production-home.php' ) {
//			$frontpage_cases->add_post_type( 'page' );
//		}

	}
}
