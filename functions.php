<?php
/**
 * Theme functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

update_site_option( 'thim_core_product_registration_themes', [ 'ivy-school' => [ 'site_key' => 'site_key' ] ] );

define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THIM_VERSION', '1.3.7' );

if ( ! function_exists( 'thim_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'ivy-school' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ivy-school', THIM_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'ivy-demo-data' );

        // Add support Woocommerce
        add_theme_support( 'woocommerce' );

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
		register_nav_menus( array(
			'primary'       => esc_html__( 'Primary Menu', 'ivy-school' ),
            'menu-account'  => esc_html__( 'Menu Account', 'ivy-school'),
		) );

		if ( get_theme_mod( 'copyright_menu', true ) ) {
			register_nav_menus( array(
				'copyright_menu' => esc_html__( 'Copyright Menu', 'ivy-school' ),
			) );
		}

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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
			'chat',
		) );

		add_theme_support( 'custom-background' );

		add_theme_support( 'thim-core' );

        // Support Gutenberg

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        // Editor color palette.
        add_theme_support( 'editor-color-palette', array(

            array(
                'name'  => esc_html__( 'Primary Color', 'ivy-school' ),
                'slug'  => 'primary',
                'color' => get_theme_mod( 'body_primary_color', '#3ac569' ),
            ),

            array(
                'name'  => esc_html__( 'Title Color', 'ivy-school' ),
                'slug'  => 'title',
                'color' => get_theme_mod( 'thim_font_title_color', '#333333' ),
            ),

            array(
                'name'  => esc_html__( 'Body Color', 'ivy-school' ),
                'slug'  => 'body',
                'color' => get_theme_mod( 'thim_font_body_color', '#777777' ),
            ),

            array(
                'name'  => esc_html__( 'Border Color', 'ivy-school' ),
                'slug'  => 'border',
                'color' => '#eeeeee',
            ),
        ) );

	}
endif;
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thim_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thim_content_width', 640 );
}

add_action( 'after_setup_theme', 'thim_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thim_widgets_init() {
	$thim_options = get_theme_mods();
    unregister_sidebar('course-sidebar');
	unregister_sidebar('archive-courses-sidebar');
	/**
	 * Sidebar for module Topbar
	 */
	if ( get_theme_mod( 'header_topbar_display', true ) ) {
        if ( get_theme_mod( 'header_style', 'header_v1' ) == 'header_v3' ) {
            register_sidebar( array(
                'name'          => esc_html__( 'Top Bar', 'ivy-school' ),
                'id'            => 'topbar',
                'description'   => esc_html__( 'Display in topbar.', 'ivy-school' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        } else {
            register_sidebar( array(
                'name'          => esc_html__( 'Top Bar - Left', 'ivy-school' ),
                'id'            => 'topbar_left',
                'description'   => esc_html__( 'Display in topbar left.', 'ivy-school' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
            register_sidebar( array(
                'name'          => esc_html__( 'Top Bar - Right', 'ivy-school' ),
                'id'            => 'topbar_right',
                'description'   => esc_html__( 'Display in topbar right.', 'ivy-school' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }
	}

    if ( get_theme_mod( 'header_style', 'header_v1' ) == 'header_v3' ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Logo Right', 'ivy-school' ),
            'id'            => 'logo-right',
            'description'   => esc_html__( 'Display in sidebar logo.', 'ivy-school' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ivy-school' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Courses', 'ivy-school' ),
        'id'            => 'sidebar-courses',
        'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Event', 'ivy-school' ),
        'id'            => 'sidebar-events',
        'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Menu', 'ivy-school' ),
		'id'            => 'menu-right',
		'description'   => esc_html__( 'Appears in right of primary menu.', 'ivy-school' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Top', 'ivy-school' ),
        'id'            => 'footer-top',
        'description'   => esc_html__( 'Appears in top of footer.', 'ivy-school' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

	if ( isset( $thim_options['footer_columns'] ) ) {
		$footer_columns = (int) $thim_options['footer_columns'];
		for ( $i = 1; $i <= $footer_columns; $i ++ ) {
			register_sidebar( array(
				'name'          => sprintf( 'Footer Sidebar %s', $i ),
				'id'            => 'footer-sidebar-' . $i,
				'description'   => esc_html__( 'Sidebar display widgets.', 'ivy-school' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}

    register_sidebar( array(
        'name'          => esc_html__( 'Copy Right', 'ivy-school' ),
        'id'            => 'copy-right',
        'description'   => esc_html__( 'Appears in copy right of footer.', 'ivy-school' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

	/**
	 * Not remove
	 * Function create sidebar on wp-admin.
	 */
	$sidebars = apply_filters( 'thim_core_list_sidebar', array() );
	if ( count( $sidebars ) > 0 ) {
		foreach ( $sidebars as $sidebar ) {
			$new_sidebar = array(
				'name'          => $sidebar['name'],
				'id'            => $sidebar['id'],
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			);

			register_sidebar( $new_sidebar );
		}
	}

}

add_action( 'widgets_init', 'thim_widgets_init' );

/**
 * Enqueue styles.
 */
if( !function_exists( 'thim_styles' ) ) {
    function thim_styles() {
        // ionicon
        wp_enqueue_style( 'builder-press-ionicons', THIM_URI . 'assets/css/libs/ionicons/ionicons.css', false, THIM_VERSION );
        //awesome
        wp_enqueue_style( 'font-awesome', THIM_URI . 'assets/css/libs/awesome/font-awesome.css', array() );
        // select 2
        wp_enqueue_style( 'select2-style', THIM_URI . 'assets/css/libs/select2/core.css', array() );
        // bootstrap
        wp_enqueue_style( 'builder-press-bootstrap', THIM_URI . 'assets/css/libs/bootstrap/bootstrap.css', array() );
        // Slick
        wp_enqueue_style( 'builder-press-slick', THIM_URI . 'assets/css/libs/slick/slick.css', array() );
        wp_enqueue_style( 'magnific', THIM_URI . 'assets/css/magnific-popup.css', array() );
        // Style default
        if ( ! thim_plugin_active( 'thim-core' ) ) {
            wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i', array() );
            wp_enqueue_style( 'thim-default', THIM_URI . 'inc/data/default.css', array() );
        }
        //	RTL
        if ( get_theme_mod( 'feature_rtl_support', false ) ) {
            wp_enqueue_style( 'thim-style-rtl', THIM_URI . 'rtl.css', array() );
        }
        // Theme Style
        if ( is_multisite() ) {
            wp_enqueue_style( 'thim-style', THIM_URI . 'style.css', array(), THIM_VERSION );
        } else {
            wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_VERSION );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'thim_styles', 1001 );

/**
 * Enqueue scripts
 */
if( !function_exists('thim_scripts') ) {
    function thim_scripts() {
        wp_enqueue_script( 'builder-press-slick', THIM_URI . 'assets/js/libs/slick.min.js', array( 'jquery' ), THIM_VERSION, true );
        wp_enqueue_script( 'tether', THIM_URI . 'assets/js/libs/1_tether.min.js', array( 'jquery' ), THIM_VERSION, true );
        wp_enqueue_script( 'bootstrap', THIM_URI . 'assets/js/libs/bootstrap.min.js', array( 'jquery' ), THIM_VERSION, true );
        wp_enqueue_script( 'flexslider', THIM_URI . 'assets/js/libs/jquery.flexslider-min.js', array( 'jquery' ), THIM_VERSION, true );
        wp_enqueue_script( 'select2', THIM_URI . 'assets/js/libs/select2.min.js', array( 'jquery' ), THIM_VERSION, true );
        wp_enqueue_script( 'stellar', THIM_URI . 'assets/js/libs/stellar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'magnific', THIM_URI . 'assets/js/libs/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
        if ( thim_plugin_active( 'thim-core' ) ) {
            wp_enqueue_script('theia-sticky-sidebar', THIM_URI . 'assets/js/libs/theia-sticky-sidebar.js', array('jquery'), '', true);
        }
        if ( get_theme_mod( 'feature_smoothscroll', false ) ) {
            wp_enqueue_script( 'smoothscroll', THIM_URI . 'assets/js/libs/smoothscroll.min.js', array( 'jquery' ), '', true );
        }
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        if ( is_page_template( 'templates/comingsoon.php' ) ) {
            wp_enqueue_script( 'knob-lugin', THIM_URI . 'assets/js/libs/jquery.plugin.min.js', array( 'jquery' ), '', true );
            wp_enqueue_script( 'countdown-js', THIM_URI . 'assets/js/libs/jquery.countdown.min.js', array( 'jquery' ), '', true );
        }
        //	Scripts
        wp_enqueue_script( 'thim-main', THIM_URI . 'assets/js/thim-custom.js', array(
            'jquery',
            'imagesloaded'
        ), THIM_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'thim_scripts', 1000 );

add_action( 'admin_enqueue_scripts', 'thim_admin_scripts' );
function thim_admin_scripts() {
    wp_enqueue_script( 'thim-admin-script', THIM_URI . 'assets/js/admin-script.js', array( 'jquery' ) );
    wp_enqueue_style( 'thim-admin-style', THIM_URI . 'assets/css/admin.css', array() );
}

function thim_custom_stylesheet_for_developer( $stylesheet, $stylesheet_dir ) {
	if ( WP_DEBUG && ! is_child_theme() ) {
		$stylesheet = $stylesheet_dir . '/style.unminify.css';
	}

	return $stylesheet;
}

/**
 * Implement the theme wrapper.
 */
require_once( THIM_DIR . 'inc/libs/theme-wrapper.php' );


/**
 * Implement the Custom Header feature.
 */
require_once( THIM_DIR . 'inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require_once( THIM_DIR . 'inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require_once( THIM_DIR . 'inc/extras.php' );

/**
 * Extra setting on plugins, export & import with demo data.
 */
include_once THIM_DIR . 'inc/data/extra-plugin-settings.php';

/**
 * Load Jetpack compatibility file.
 */
require_once( THIM_DIR . 'inc/jetpack.php' );

/**
 * Custom wrapper layout for theme
 */
require_once( THIM_DIR . 'inc/wrapper-layout.php' );

/**
 * Custom functions
 */
require_once( THIM_DIR . 'inc/custom-functions.php' );
/**
 * Check new version of LearnPress
 *
 * @return mixed
 */
function thim_is_new_learnpress( $version ) {
	if ( defined( 'LEARNPRESS_VERSION' ) ) {
		return version_compare( LEARNPRESS_VERSION, $version, '>=' );
	} else {
		return version_compare( get_option( 'learnpress_version' ), $version, '>=' );
	}
}
/**
 * Learnpress functions
 */
if ( class_exists( 'LearnPress' ) ) {
	function thim_new_learnpress_template_path( $slash ) {
		if ( thim_is_new_learnpress( '4.0' ) ) {
			return 'learnpress-v4';
		} else {
			return 'learnpress';
		}
	}

	if ( thim_is_new_learnpress( '4.0' ) ) {
		require_once THIM_DIR . 'inc/learnpress-v4-functions.php';
	} else {
		require_once THIM_DIR . 'inc/learnpress-functions.php';
	}

	add_filter( 'learn_press_template_path', 'thim_new_learnpress_template_path', 999 );
	
}


/**
 * Woocommerce custom functions
 */
if ( class_exists( 'WooCommerce' ) ) {
    include_once THIM_DIR . 'woocommerce/custom-functions.php';
}

/**
 * Option Shortcode
 */
require_once( THIM_DIR . 'inc/custom-shortcodes.php' );

/**
 * Customizer additions.
 */
require_once( THIM_DIR . 'inc/customizer.php' );

/**
 * Require plugins
 */
if ( is_admin() && current_user_can( 'manage_options' ) ) {
	include_once THIM_DIR . 'inc/admin/installer/installer.php';
	include_once THIM_DIR . 'inc/admin/plugins-require.php';
}

/*
 * WPBakery Page Builder custom functions
 * */
if ( thim_plugin_active( 'js_composer' ) ) {
	require_once( THIM_DIR . 'vc_templates/js_composer.php' );
}

add_filter( 'builder-press/elements-unset', 'thim_custom_builder_press_elements' );

if ( ! function_exists( 'thim_custom_builder_press_elements' ) ) {
	/**
	 * @param $elements
	 *
	 * @return mixed
	 */
	function thim_custom_builder_press_elements( $unset ) {

		// elements want to remove
		$elements = array();

		$unset = array_merge( $unset, $elements );

		return $unset;
	}
}


add_filter( 'login_url', 'thim_ivy_custom_login_url', 999, 3 );
if ( ! function_exists( 'thim_ivy_custom_login_url' ) ) {
	function thim_ivy_custom_login_url( $login_url, $redirect, $force_reauth ) {
		if(isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'resetpass'){
			$login_url = thim_get_login_page_url();
		}
		return $login_url;
	}
}