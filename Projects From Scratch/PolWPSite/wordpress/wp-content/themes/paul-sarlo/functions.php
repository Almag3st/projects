<?php
/**
 * Paul Sarlo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Paul_Sarlo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'paul_sarlo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function paul_sarlo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Paul Sarlo, use a find and replace
		 * to change 'paul-sarlo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'paul-sarlo', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header_menu' => esc_html__( 'Primary', 'paul-sarlo' ),
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
				'paul_sarlo_custom_background_args',
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
	}
endif;
add_action( 'after_setup_theme', 'paul_sarlo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paul_sarlo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paul_sarlo_content_width', 640 );
}
add_action( 'after_setup_theme', 'paul_sarlo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paul_sarlo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'paul-sarlo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'paul-sarlo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s card sidebarWidget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-center">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'paul_sarlo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function paul_sarlo_scripts() {
	wp_enqueue_style( 'paul-sarlo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'paul-sarlo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'paul-sarlo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paul_sarlo_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function new_excerpt_more($more) {
	global $post;
	return '... </br><div class="row readmore"> <a class="moretag" href=" ' . get_permalink($post->ID) . '"<span class="nav-subtitle">Read More &raquo;<span class="nav-subtitle"></a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// adding global fields for header images of 404, archive, search, etc

add_action('admin_menu', 'headerImageInterface');

function headerImageInterface() {
	add_options_page('Default Page Header Images', 'Default Page Header Images', '8', 'functions', 'editDefaultPageheaderImages');
}

function editDefaultPageheaderImages() {
	?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>404 Header Image Url</strong><br />
	<input type="text" name="fourOfourImageUrl" size="45" value="<?php echo get_option('fourOfourImageUrl'); ?>" /></p>

	<p><strong>Archive Header Image Url</strong><br />
	<input type="text" name="archiveImageUrl" size="45" value="<?php echo get_option('archiveImageUrl'); ?>" /></p>

	<p><strong>Search Header Image Url</strong><br />
	<input type="text" name="searchImageUrl" size="45" value="<?php echo get_option('searchImageUrl'); ?>" /></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="fourOfourImageUrl,archiveImageUrl,searchImageUrl" />

	</form>
	</div>
	<?php
}

?>