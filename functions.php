<?php
/**
 * psrm functions and definitions
 *
 * @package psrm
 */

function psrm_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'psrm' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'psrm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    // Enable title tag support
    add_theme_support('title-tag');
}
add_action( 'after_setup_theme', 'psrm_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function psrm_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Home Page Slider', 'psrm' ),
		'id'            => 'home-slider-desktop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title sr-only">',
		'after_title'   => '</div>',
	) );
    register_sidebar( array(
		'name'          => __( 'Sidebar', 'psrm' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
    register_sidebar( array(
		'name'          => __( 'Home Museum Info', 'psrm' ),
		'id'            => 'home-museum-info',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
    register_sidebar( array(
		'name'          => __( 'Home Welcome', 'psrm' ),
		'id'            => 'home-welcome',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
    register_sidebar( array(
		'name'          => __( 'Home CTA', 'psrm' ),
		'id'            => 'home-cta',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'psrm_widgets_init' );
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Enqueue scripts and styles.
 */
function psrm_scripts() {

	wp_enqueue_style( 'psrm-google-font', '//fonts.googleapis.com/css?family=Oswald:400' );
	wp_enqueue_style( 'psrm-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'psrm-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', array('psrm-google-font', 'psrm-font-awesome'), '1430489675' );

    wp_enqueue_script('psrm-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), '1430489675', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'psrm_scripts' );

function psrm_theme_url_compare($url, $rel) {
    $url = trailingslashit($url);
    $rel = trailingslashit($rel);

    if ((strcasecmp($url, $rel) === 0) ) {
        return true;
    } else {
        return false;
    }
}

function is_element_empty( $element ) {
    $element = trim( $element );
    return !empty( $element );
}

function psrm_new_excerpt_more($more)
{
    global $post;

    return '... <a class="moretag" href="' . get_permalink($post->ID) . '"> Read the full article...</a>';
}

add_filter('excerpt_more', 'psrm_new_excerpt_more');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Nav Menu
 */
require get_template_directory() . '/inc/nav.php';