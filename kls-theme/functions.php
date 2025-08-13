<?php
/**
 * klsTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package klsTheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kls_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on klsTheme, use a find and replace
		* to change 'kls' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'kls', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// MY SIZES THUMBNAIL FOR PROJECT
	//add_image_size('project_thumb', 383, 280, true);
	//add_image_size('book_thumb', 340, 265, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-top' => esc_html__( 'Menu Top', 'kls' ),
			'menu-lang' => esc_html__( 'Menu Languages', 'kls' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'kls_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/**
	 * Add support woocommerce
	 */
	//add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'kls_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kls_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kls_content_width', 640 );
}
add_action( 'after_setup_theme', 'kls_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kls_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kls' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kls' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kls_widgets_init' );

/**
 *  MY CODE FUNCTIONS
 */

/**
 * Function display array
 */
function pre($str) {
	echo '<pre>';
	print_r ($str);
	echo '</pre>';
}

/**
 * отключаем создание миниатюр файлов для указанных размеров
 */
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
			'medium_large',
		//'large',
			'1536x1536',
			'2048x2048',
	] );
}

/**
 * Add custom class for nav menu
 */
add_filter( 'nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1 );
function custom_nav_menu_css_class ($classes){
    $classes[] = 'menu__item';
    return $classes;
}

//	if ( $depth == 1 ) {
////		$args->before = `<span></span>`;
////		$classes[] = 'menu__item222';
////		return $args;
//	} else {
//		$classes[] = 'menu__item';
//	}
//	return $classes;
//}

/**
 * Отключаем поиск по сайту
 */
function disable_search( $query, $error = true ) {
	if ( is_search() ) {
		$query->is_search = false;
		$query->query_vars['s'] = false;
		$query->query['s'] = false;
		// Опционально: можно перенаправить пользователя на главную страницу или страницу 404
		if ( $error == true ) {
			$query->is_404 = true;
		}
	}
}
add_action( 'parse_query', 'disable_search' );
add_filter( 'get_search_form', '__return_null' );


/** DISABLE UPDATE PLUGINS */
add_filter('auto_update_plugin', '__return_false');
add_filter( 'auto_update_translation', '__return_false');
add_filter( 'site_transient_update_plugins', 'kls_disable_plugins_update' );
function kls_disable_plugins_update( $value ) {
	unset( $value->response['polylang-pro/polylang.php'] );
	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	return $value;
}
add_filter( 'pre_site_transient_update_core', static function( $value ) {
	$upinfo = new stdClass();
	$upinfo->updates = [];
	$upinfo->version_checked = $GLOBALS['wp_version'];
	$upinfo->last_checked = time();
	return $upinfo;
} );
add_filter( 'pre_site_transient_update_themes', static function( $value ) {
	static $themes;
	$themes || $themes = wp_get_themes();

	$upinfo = new stdClass();
	$upinfo->last_checked = time();
	$upinfo->checked = [];

	foreach ( $themes as $theme ) {
		$upinfo->checked[ $theme->get_stylesheet() ] = $theme->get( 'Version' );
	}

	return $upinfo;
} );

/** disable function */
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
//add_filter('rest_authentication_errors', function( $result ) {
//	if (!is_user_logged_in()) {
//		return new WP_Error('rest_forbidden', 'REST API отключен.', array('status' => 403));
//	}
//	return $result;
//});
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

/* Remove WP version */
function remove_version_info() {
	return '';
}
add_filter('the_generator', 'remove_version_info');
/* Удалить версии скриптов и стилей */
function remove_wp_version_strings( $src ) {
	global $wp_version;
	parse_str(parse_url($src, PHP_URL_QUERY), $query);
	if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter( 'script_loader_src', 'remove_wp_version_strings' );
add_filter( 'style_loader_src', 'remove_wp_version_strings' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Woocommerce Hooks
 */
// require get_template_directory() . '/inc/woocommerce-hooks.php';