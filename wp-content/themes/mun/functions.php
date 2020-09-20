<?php
/**
 * mun functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mun
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


// add_image_size('menu_thumb_image_small', 262, 245, true);
add_image_size('slider_shop_image', 680,690, true);
// add_image_size('menu_thumb_image', 750,700, true);
// add_image_size('about_page_image', 700,700, true);
// add_image_size('breadcrumb_image', 1500,1000, true);
// add_image_size('menu_listing_image', 1170,700, true);
// add_image_size('slider_image', 2000, 1300, true);



if ( ! function_exists( 'mun_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mun_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mun, use a find and replace
		 * to change 'mun' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mun', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'mun' ),
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
				'mun_custom_background_args',
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
add_action( 'after_setup_theme', 'mun_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mun_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mun_content_width', 640 );
}
add_action( 'after_setup_theme', 'mun_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mun_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mun' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mun' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mun_widgets_init' );

/**
 * Enqueue scripts and styles.
 */


function mun_scripts() {
	wp_enqueue_style( 'mun-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mun-style', 'rtl', 'replace' );
	wp_enqueue_style('Swansea', get_template_directory_uri() . '/assets/fonts/Swansea/style.css');	
	wp_enqueue_style('Skape', get_template_directory_uri() . '/assets/fonts/Skape/style.css');	
	wp_enqueue_style('Socicons', get_template_directory_uri() . '/assets/fonts/Socicons/socicon.css');	
	wp_enqueue_style('plugin', get_template_directory_uri() . '/assets/css/plugin.css');	
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');	
	wp_enqueue_style('uikit', get_template_directory_uri() . '/assets/css/uikit.min.css');	
	wp_enqueue_style('stylecustom', get_template_directory_uri() . '/assets/css/customstyle.css');	
	
	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery.magnific-popup.min', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery.counterup.min', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery.countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery.ui', get_template_directory_uri() . '/assets/js/jquery.ui.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery.elevatezoom', get_template_directory_uri() . '/assets/js/jquery.elevatezoom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'isotope.pkgd.min', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'slinky.menu', get_template_directory_uri() . '/assets/js/slinky.menu.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'uikit', get_template_directory_uri() . '/assets/js/uikit.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'mun-helpers', get_template_directory_uri() . '/assets/js/mun-helpers.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'mun-controllers.min', get_template_directory_uri() . '/assets/js/mun-controllers.min.js', array(), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mun_scripts' );

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


// Required Custom post type and taxonomies

function required_custom_post_type_and_taxonomies(){

	// whyus
	register_post_type('faqs', array(
		'labels' => array('name' => 'FAQs'),
		'public' => true,
		'menu_position'=> 23,
		'supports' => array('title','editor','thumbnail'),
		'rewrite'=> array('slug'=> 'faqs'),
		'menu_icon' => 'dashicons-align-right'
	));
	
	// // Services
	
	// register_post_type('best-menu', array(
	// 	'labels' => array('name' => 'Best Menu'),
	// 	'public' => true,
	// 	'menu_position'=> 24,
	// 	'supports' => array('title','editor','thumbnail'),
	// 	'rewrite'=> array('slug'=> 'services'),
	// 	'menu_icon' => 'dashicons-star-filled'
	// ));
	
	// register_post_type('menu-items', array(
	// 	'labels' => array('name' => 'Menu'),
	// 	'public' => true,
	// 	'menu_position'=> 24,
	// 	'supports' => array('title','editor','thumbnail'),
	// 	'rewrite'=> array('slug'=> 'menu'),
	// 	'menu_icon' => 'dashicons-image-filter'
	// ));
	
	

}
add_action('init','required_custom_post_type_and_taxonomies');


function excerpt($limit)
{
    $excerpt = explode(' ', get_the_content(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

    return $excerpt;
}

function limit_word($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}


function limit_text($text, $limit) {

    if (strlen($text) > $limit) {
        $text  = substr($text, 0,$limit) . '...';
    }
    return $text;
}


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php            
    }
        ?></a><?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );
