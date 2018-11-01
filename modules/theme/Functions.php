<?php

namespace modules\theme;

use WPKit\Module\AbstractThemeFunctions;
use WPKit\Options\Option;
use WPKit\PostType\MetaBox;

/**
 * Class Functions
 *
 * @package modules\theme
 */
class Functions extends AbstractThemeFunctions {
	/**
	 * Get array of socials
	 *
	 * @return array
	 */
	public static function get_socials() {
		$socials = [
			'facebook'  => Option::get( 'facebook' ),
			'instagram' => Option::get( 'instagram' ),
			'telegram'  => Option::get( 'telegram' ),
			'youtube'   => Option::get( 'youtube' ),
			'vimeo'     => Option::get( 'vimeo' ),
		];

		return array_filter( $socials );
	}

	public static function get_footer_text() {
		return Option::get( self::localize_key( Initialization::OPTIONS_FOOTER_TEXT ) );
	}

	public static function localize_key( string $key ): string {
		if ( function_exists( 'pll_current_language' ) ) {
			return sanitize_key( pll_current_language() . '_' . $key );
		}

		return $key;
	}

	public static function get_production_link() {
		$id = self::get_page_id_by_template( 'templates/production-home' );

		return get_permalink( function_exists( 'pll_get_post' ) ? pll_get_post( $id ) : $id );
	}

	public static function get_footer_email() {
		$key = Initialization::OPTIONS_FOOTER_MEDIA_EMAIL;
		if ( is_page_template() || is_tax( \modules\cases\Initialization::SERVICE ) || is_post_type_archive( \modules\cases\Initialization::POST_TYPE ) || is_singular( \modules\cases\Initialization::POST_TYPE ) ) {
			$key = Initialization::OPTIONS_FOOTER_PROD_EMAIL;
		}

		return antispambot( Option::get( $key ) );
	}

	public static function get_production_header_video() {
		return wp_get_attachment_url( MetaBox::get( get_the_ID(), 'production', 'header_video' ) );
	}

	public static function get_showreel_video(): string {
		return MetaBox::get( get_the_ID(), 'production', 'showreel_video' );
	}

	/**
	 * @return array
	 */
	public static function get_team(): array {
		$photos      = MetaBox::get( get_the_ID(), 'team', 'image' );
		$image_hover = MetaBox::get( get_the_ID(), 'team', 'image_hover' );
		$names       = MetaBox::get( get_the_ID(), 'team', 'name' );
		$titles      = MetaBox::get( get_the_ID(), 'team', 'title' );
		$team        = [];
		if ( $names ) {
			foreach ( $names as $i => $name ) {
				$team[] = [
					'name'        => $name,
					'image'       => $photos[ $i ],
					'image_hover' => $image_hover[ $i ],
					'title'       => $titles[ $i ],
				];
			}
		}

		return $team;
	}

	/**
	 * @return array
	 */
	public static function get_clients(): array {
		$logos   = MetaBox::get( get_the_ID(), 'clients', 'image' );
		$urls    = MetaBox::get( get_the_ID(), 'clients', 'link' );
		$clients = [];
		foreach ( $logos as $i => $logo ) {
			$clients[] = [
				'logo' => $logo,
				'link' => $urls[ $i ],
			];
		}

		return $clients;
	}

	public static function get_about_video(): string {
		return MetaBox::get( get_the_ID(), 'about', 'video' );
	}

	public static function get_about_thumb(): string {
		return (string) wp_get_attachment_image_url( MetaBox::get( get_the_ID(), 'about', 'video_thumb' ), 'full' );
	}

	public static function show_forward( $template_name ) {
		$page_id = self::get_page_id_by_template( $template_name );
		setup_postdata( $page_id );
		get_template_part( 'parts/production/forward' );
		wp_reset_postdata();
	}
}
