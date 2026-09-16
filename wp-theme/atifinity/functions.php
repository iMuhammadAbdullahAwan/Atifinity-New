<?php
/**
 * Atifinity theme functions and definitions
 */

if ( ! function_exists( 'atifinity_setup' ) ) {
	function atifinity_setup() {
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add custom image sizes
		add_image_size( 'blog-card', 800, 450, true );
		add_image_size( 'blog-hero', 1200, 675, true );

		// Register Navigation Menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'atifinity' ),
			'footer'  => esc_html__( 'Footer Menu', 'atifinity' ),
		) );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo' );

		// Add support for HTML5 markup.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );
	}
}
add_action( 'after_setup_theme', 'atifinity_setup' );

/**
 * Enqueue scripts and styles.
 */
function atifinity_scripts() {
	// Enqueue output.css
	$css_path = get_template_directory() . '/dist/css/output.css';
	$css_version = file_exists( $css_path ) ? filemtime( $css_path ) : '1.0.0';
	wp_enqueue_style( 'atifinity-style', get_template_directory_uri() . '/dist/css/output.css', array(), $css_version );

	// Enqueue app.js
	$js_path = get_template_directory() . '/dist/js/app.js';
	$js_version = file_exists( $js_path ) ? filemtime( $js_path ) : '1.0.0';
	wp_enqueue_script( 'atifinity-script', get_template_directory_uri() . '/dist/js/app.js', array(), $js_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Blog-specific styles for WordPress-generated HTML
	$blog_css = '
	/* ─── Pagination ─── */
	.nav-links { display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
	.nav-links a, .nav-links span { display: inline-flex; align-items: center; justify-content: center; min-width: 2.5rem; height: 2.5rem; padding: 0 0.75rem; border-radius: 0.375rem; border: 1px solid rgba(255,255,255,0.1); font-size: 0.875rem; font-family: var(--font-mono, monospace); color: rgba(255,255,255,0.5); transition: all 0.2s ease; }
	.nav-links a:hover { border-color: rgba(255,255,255,0.2); color: #fff; background: rgba(255,255,255,0.05); }
	.nav-links .current { background: var(--color-primary, #E32227); border-color: var(--color-primary, #E32227); color: #fff; }
	.nav-links .dots { border: none; min-width: auto; padding: 0; }

	/* ─── Search Form ─── */
	.search-form { display: flex; gap: 0.5rem; }
	.search-form .search-field { flex: 1; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 0.375rem; padding: 0.625rem 1rem; color: #fff; font-size: 0.875rem; outline: none; transition: border-color 0.2s; }
	.search-form .search-field:focus { border-color: var(--color-primary, #E32227); }
	.search-form .search-field::placeholder { color: rgba(255,255,255,0.3); }
	.search-form .search-submit { background: var(--color-primary, #E32227); color: #fff; border: none; border-radius: 0.375rem; padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: opacity 0.2s; }
	.search-form .search-submit:hover { opacity: 0.85; }

	/* ─── Comments ─── */
	.comment-list { list-style: none; padding: 0; margin: 0; }
	.comment-list .comment { padding: 1.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
	.comment-list .comment:last-child { border-bottom: none; }
	.comment-author { font-weight: 600; color: #fff; }
	.comment-metadata { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 0.25rem; }
	.comment-metadata a { color: rgba(255,255,255,0.4); text-decoration: none; }
	.comment-content { margin-top: 0.75rem; color: rgba(255,255,255,0.6); line-height: 1.7; }
	.comment-content p { margin-bottom: 0.75rem; }
	.comment-respond { margin-top: 2rem; }
	.comment-reply-title { font-size: 1.25rem; font-weight: 700; color: #fff; margin-bottom: 1rem; }
	.comment-form label { display: block; font-size: 0.75rem; font-family: var(--font-mono, monospace); text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5); margin-bottom: 0.5rem; }
	.comment-form input[type="text"],
	.comment-form input[type="email"],
	.comment-form input[type="url"],
	.comment-form textarea { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 0.375rem; padding: 0.625rem 1rem; color: #fff; font-size: 0.875rem; margin-bottom: 1rem; outline: none; transition: border-color 0.2s; }
	.comment-form input:focus, .comment-form textarea:focus { border-color: var(--color-primary, #E32227); }
	.comment-form textarea { min-height: 8rem; resize: vertical; }
	.comment-form .submit { background: var(--color-primary, #E32227); color: #fff; border: none; border-radius: 0.375rem; padding: 0.75rem 1.5rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: opacity 0.2s; }
	.comment-form .submit:hover { opacity: 0.85; }

	/* ─── Post Navigation ─── */
	.post-navigation .nav-links { justify-content: space-between; }
	.post-navigation .nav-links a { border: none; min-width: auto; height: auto; padding: 0; }

	/* ─── WordPress Block Styles ─── */
	.wp-block-image { margin: 2rem 0; }
	.wp-block-image img { border-radius: 0.375rem; border: 1px solid rgba(255,255,255,0.1); }
	.wp-block-quote { border-left: 3px solid var(--color-primary, #E32227); padding-left: 1.5rem; margin: 2rem 0; }

	/* ─── Line Clamp ─── */
	.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
	.line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
	';
	wp_add_inline_style( 'atifinity-style', $blog_css );
}
add_action( 'wp_enqueue_scripts', 'atifinity_scripts' );

/**
 * Register widget area.
 */
function atifinity_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'atifinity' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'atifinity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'atifinity_widgets_init' );

/**
 * Register Custom Post Types
 */
function atifinity_register_cpt() {
	// Portfolio CPT
	$portfolio_args = array(
		'labels' => array(
			'name' => 'Portfolio',
			'singular_name' => 'Portfolio Item',
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-video-alt3',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite' => array( 'slug' => 'work' ),
		'show_in_rest' => true,
	);
	register_post_type( 'portfolio', $portfolio_args );

	// Service CPT
	$service_args = array(
		'labels' => array(
			'name' => 'Services',
			'singular_name' => 'Service',
		),
		'public' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-admin-tools',
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
	);
	register_post_type( 'service', $service_args );
}
add_action( 'init', 'atifinity_register_cpt' );

/**
 * Helper function for template directory URI
 */
function atifinity_uri() {
	return get_template_directory_uri();
}
