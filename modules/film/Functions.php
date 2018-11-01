<?php

namespace modules\film;


use WPKit\Module\AbstractFunctions;

/**
 * Class Functions
 * @package modules\case
 */
class Functions extends AbstractFunctions {

	/**
	 * @return array|int|\WP_Error
	 */
	public static function get_categories(): array {
		return get_terms( Initialization::FILMS );
	}

	public static function is_current_category( \WP_Term $cat ): bool {
		return get_queried_object_id() == $cat->term_id;
	}
}