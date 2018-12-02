<?php

namespace modules\theme;

use WPKit\AdminPage\OptionPage;
use WPKit\Module\AbstractThemeInitialization;
use WPKit\Options\Option;
use WPKit\Options\OptionBox;

/**
 * Class Initialization
 *
 * @package modules\theme
 */
class Initialization extends AbstractThemeInitialization {

	/**
	 * @var array
	 */
	protected static $_image_sizes = [
		'grid-1' => [ 665, 885, true ],
		'grid-2' => [ 1170, 655, true ],
//		'article'        => [ 1230, 600, true ],


//        'hero'         => [ 1440, 630, true ],
//		'gallery'      => [ 1024, 680, false ],
//		'archive-news' => [ 300, 300, true ],
//		'news'         => [ 800, 470, true ],

//		'grid-small'   => [ 590, 440, true ],
	];

	public static function register_login_url() {
		add_filter( 'login_headerurl', function () {
			return home_url( '/' );
		} );
	}


	public function add_action_nav_menu_css_class( $classes, $item ) {
		// Getting the current post details
		global $post;
		// Getting the post type of the current post
		$current_post_type      = get_post_type_object( get_post_type( $post->ID ) );
		$current_post_type_slug = $current_post_type->rewrite['slug'];
		// Getting the URL of the menu item
		$menu_slug = strtolower( trim( $item->url ) );
		// If the menu item URL contains the current post types slug add the current-menu-item class
		if ( strpos( $menu_slug, $current_post_type_slug ) !== false ) {
			$classes[] = 'current-menu-item';
		}

		// Return the corrected set of classes to be added to the menu item
		return $classes;
	}


	public function add_filter_wp_calculate_image_srcset( $source ) {
		if ( is_singular( 'page' ) ) {
			return false;
		}

		return $source;
	}


	public function add_filter_nav_menu_css_class( $classes = array(), $menu_item = false ) {
		global $post;

		// Get post ID, if nothing found set to NULL
		$id = ( isset( $post->ID ) ? get_the_ID() : null );

		// Checking if post ID exist...
		if ( isset( $id ) && ( is_category() || is_archive() || strpos( $_SERVER['REQUEST_URI'], '/media' ) === 0 ) ) {
			if ( $menu_item->url != home_url( $_SERVER['REQUEST_URI'] ) ) {
				if ( ( $key = array_search( 'current-menu-item', $classes ) ) !== false ) {
					unset( $classes[ $key ] );
				}
			}
//var_dump($_SERVER['REQUEST_URI']);
//			$classes[] = ( $menu_item->url ==$_SERVER['REQUEST_URI'] ) ? 'current-menu-item' : '';
		}

		return $classes;
	}

	public function register_image_sizes() {
		foreach ( static::$_image_sizes as $key => $data ) {
			$width  = isset( $data[0] ) ? $data[0] : 0;
			$height = isset( $data[1] ) ? $data[1] : 0;
			$crop   = isset( $data[2] ) ? $data[2] : false;

			add_image_size( $key, $width, $height, $crop );
		}
	}

	public function register_nav_menus() {
		register_nav_menus( [
			'main' => __( 'Main', TEXT_DOMAIN ),
		] );
	}

	public function _register_async_scripts_loading() {
		add_filter( 'script_loader_tag', function ( $tag ) {
			return ! is_admin() ? str_replace( ' src', ' defer src', $tag ) : $tag;
		}, 10, 2 );
		/**
		 * For film when jQuery is used before it will be loaded (in content)
		 * Also added code snippet in the end of last script which call all saved functions
		 */
		add_action( 'wp_head', function () {
			?>
            <script>
              (function (w, d, u) {
                var alias,
                  pushToQ

                w.bindReadyQ = []
                w.bindLoadQ = []

                pushToQ = function (x, y) {

                  switch (x) {
                    case 'load':
                      w.bindLoadQ.push(y)

                      break
                    case 'ready':
                      w.bindReadyQ.push(y)

                      break
                    default:
                      w.bindReadyQ.push(x)

                      break
                  }
                }

                alias = {
                  load: pushToQ,
                  ready: pushToQ,
                  bind: pushToQ,
                  on: pushToQ,
                }

                w.$ = w.jQuery = function (handler) {

                  if (handler === d || handler === u || handler === w) {
                    return alias
                  } else {
                    pushToQ(handler)
                  }
                }
              })(window, document)
            </script>
			<?php
		}, 1 );
	}

	public function add_action_wp_enqueue_scripts() {
		static::_enqueue_styles();
		static::_enqueue_scripts();
	}

	protected function _enqueue_styles() {
		wp_enqueue_style(
			'fonts',
			'https://fonts.googleapis.com/css?family=Montserrat:400,700,900&amp;subset=cyrillic'
		);
		wp_enqueue_style(
			'theme',
			$this->get_theme_assets_url() . "/built/stylesheets/screen.min.css", [ 'fonts' ],
			filemtime( get_template_directory() . "/assets/built/stylesheets/screen.min.css" )
		);

	}

	protected function _enqueue_scripts() {
		wp_register_script(
			'theme',
			$this->get_theme_assets_url() . '/built/javascripts/common.min.js',
			[ 'jquery' ],
			filemtime( get_template_directory() . "/assets/built/javascripts/common.min.js" ),
			true
		);
//		wp_localize_script('theme', 'theme_settings', []);
		wp_enqueue_script( 'theme' );
	}

	public function add_action_after_setup_theme() {
		add_theme_support( 'post-thumbnails', [ 'news', 'page' ] );
		add_theme_support( 'title-tag' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	}

	public function add_action_enqueue_block_editor_assets() {
		wp_enqueue_style(
			'tribu-fonts',
			'https://fonts.googleapis.com/css?family=Montserrat:400,700,900&amp;subset=cyrillic'
		);
		wp_enqueue_style( 'tribu-gutenberg', $this->get_theme_assets_url() . "/built/stylesheets/editor.css", false, '@@pkg.version', 'all' );
		wp_enqueue_script( 'tribu-gutenberg-script',
			get_stylesheet_directory_uri() . '/assets/src/javascripts/guttenberg_blocks.js',
			array( 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api' )
		);
	}


	public function __add_action_login_enqueue_scripts() {
		//wp_enqueue_style( 'theme-login', $this->get_theme_assets_url() . '/built/stylesheets/login.css' );
	}


	public function add_action_admin_init() {
		add_post_type_support( 'page', 'excerpt' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'postcustom', [], 'normal' );
		remove_meta_box( 'trackbacksdiv', [], 'normal' );
	}

	public function add_action_admin_menu() {
		remove_menu_page( 'edit.php' );
		if ( ! is_user_admin() ) {
			remove_menu_page( 'plugins.php' );
			remove_submenu_page( 'themes.php', 'themes.php' );
		}
	}

	/**
	 * @param \WP_Screen $current_screen
	 */
	public function add_action_current_screen( $current_screen ) {
		if ( $current_screen->base == 'edit' ) {
			$columns_hook = function ( $columns ) {
				unset( $columns['comments'] );

				return $columns;
			};

			foreach ( [ 'posts', 'pages', 'cases' ] as $post_type ) {
				add_filter( "manage_{$post_type}_columns", $columns_hook );
			}
		}
	}

	public function add_action_wp_head() {
		echo Option::get( 'head_code' );
	}

	public function __add_action_admin_enqueue_scripts() {
		// wp_enqueue_style( 'theme-admin', $this->get_theme_assets_url() . '/built/stylesheets/admin.css' );
	}

	public function add_action_wp_footer() {
		echo "<noscript>
            <div style=\"position: absolute; bottom: 0; left: 0; right: 0; padding: 10px 20px; background-color: #FFF; text-align: center; color: #000; z-index: 999; border-top: 1px solid #000;\">
                " . __( 'JavaScript is disabled on your browser. Please enable JavaScript or upgrade to a JavaScript-capable browser to use this site.', TEXT_DOMAIN ) . "
            </div>
        </noscript>
        <script>
            document.getElementsByTagName('html')[0].className = document.getElementsByTagName('html')[0].className.replace(/\b(no-js)\b/,'');
        </script>";
		echo Option::get( 'footer_code' );
	}

	/**
	 * @return string
	 */
	public function add_filter_network_home_url() {
		return home_url( '/' );
	}

	/**
	 * @return string
	 */
	public function add_filter_excerpt_more() {
		return '...';
	}

	public function add_filter_excerpt_length() {
		return 20;
	}

	/**
	 * @param string $html
	 *
	 * @return string
	 */
	public function add_filter_embed_oembed_html( $html ) {
		if ( preg_match( '(youtube|vimeo|twitter|instagram)', $html, $matches ) ) {
			$class = $matches[0];
			if ( in_array( $matches[0], [ 'youtube', 'vimeo' ] ) ) {
				$class .= ' video-wrapper';
			}

			return "<div class=\"{$class} aligncenter\">$html</div>";
		}

		return $html;
	}

	public function register_dynamic_sidebars() {
		// TODO: Implement register_dynamic_sidebars() method.
	}

	/**
	 * @param array $settings
	 *
	 * @return array
	 */
	public function add_filter_tiny_mce_before_init( $settings ) {
		$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';

		return $settings;
	}

	public function admin_register_option_pages() {
		new OptionPage( 'theme', __( 'Theme Settings', TEXT_DOMAIN ) );
//		new OptionPage( self::OPTIONS_PAGE_SOCIAL, __( 'Social', TEXT_DOMAIN ), 'theme' );
//		new OptionPage( self::OPTIONS_PAGE_FOOTER, __( 'Footer', TEXT_DOMAIN ), 'theme' );
	}

	public function admin_register_options() {
		$this->_add_theme_options();
	}

	protected function _add_theme_options() {
		$option_box = new OptionBox( 'general', __( 'General Options', TEXT_DOMAIN ) );
		$option_box->add_field( 'head_code', __( 'Head code', TEXT_DOMAIN ), 'Textarea' );
		$option_box->add_field( 'footer_code', __( 'Footer code', TEXT_DOMAIN ), 'Textarea' );
		$option_box->set_page( 'theme' );
	}

	public function admin_register_remove_from_nav_menus() {
		add_action( 'admin_head-nav-menus.php', function () {
			remove_meta_box( 'add-post_tag', 'nav-menus', 'side' );
			remove_meta_box( 'add-post', 'nav-menus', 'side' );
			remove_meta_box( 'add-category', 'nav-menus', 'side' );
		} );
	}

}

