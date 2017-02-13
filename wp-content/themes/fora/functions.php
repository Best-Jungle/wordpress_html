<?php
/**
 * fora functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fora
 */

if ( ! function_exists( 'fora_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fora_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fora, use a find and replace
	 * to change 'fora' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fora', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'fora-slider', 1200, 800, true);
	add_image_size( 'fora-standard', 800, 9999);
	add_image_size( 'fora-little-post', 800, 400, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'fora' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'fora_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fora_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fora_content_width', 790 );
}
add_action( 'after_setup_theme', 'fora_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fora_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fora' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fora' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'fora_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fora_scripts() {
	wp_enqueue_style( 'fora-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
	$query_args = array(
		'family' => 'Roboto:400,700%7CMontserrat:400,700'
	);
	wp_register_style( 'fora-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'fora-googlefonts' );

	wp_enqueue_script( 'fora-custom', get_template_directory_uri() . '/js/jquery.fora.js', array('jquery', 'jquery'), '1.0', true );
	wp_enqueue_script( 'fora-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'fora-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'fora-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Dequeue default WooCommerce Layout */
	wp_dequeue_style ( 'woocommerce-layout' );
	wp_dequeue_style ( 'woocommerce-smallscreen' );
	wp_dequeue_style ( 'woocommerce-general' );
	
	wp_enqueue_script( 'fora-html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.3', false );
	wp_script_add_data( 'fora-html5shiv', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'fora_scripts' );

/**
 * WooCommerce Support
 */
if ( ! function_exists( 'fora_woocommerce_support' ) ) :
	function fora_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'fora_woocommerce_support' );
endif; // fora_woocommerce_support


/**
 * Replace Excerpt More
 */
function fora_new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'fora_new_excerpt_more');

 /**
 * Delete font size style from tag cloud widget
 */
function fora_fix_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'fora_fix_tag_cloud',10,3);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/fora-admin-page.php';
}

/**
 * Load PRO Button in the customizer
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/pro-button/class-customize.php' );
