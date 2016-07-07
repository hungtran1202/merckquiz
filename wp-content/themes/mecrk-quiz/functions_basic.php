<?php
/**
 * Created by PhpStorm.
 * User: lacphan
 * Date: 2/19/16
 * Time: 10:32 AM
 */

if ( ! function_exists( 'enpii_setup' ) ) :

    function enpii_setup() {


        load_theme_textdomain( _NP_TEXT_DOMAIN, _NP_TEMPLATE_PATH . '/languages'. '/languages' );

        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/".$locale.".php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );

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
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 9999 );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu',  _NP_TEXT_DOMAIN),
            'footer'  => __( 'Footer Menu',  _NP_TEXT_DOMAIN),
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

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ) );

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.css', enpii_fonts_url() ) );
    }
endif;
add_action( 'after_setup_theme', 'enpii_setup' );


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function enpii_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'enpii_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function enpii_body_classes( $classes ) {
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of group-blog to sites with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of no-sidebar to sites without active sidebar.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    $classes[]= 'login';
    return $classes;
}
add_filter( 'body_class', 'enpii_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function enpii_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require _NP_TEMPLATE_PATH . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require _NP_TEMPLATE_PATH . '/inc/customizer.php';


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function enpii_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];

    840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

    if ( 'page' === get_post_type() ) {
        840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    } else {
        840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    }

    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'enpii_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function enpii_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( 'post-thumbnail' === $size ) {
        is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'enpii_post_thumbnail_sizes_attr', 10 , 3 );

function enpii_widgets_init() {
    if (!function_exists('grabvn_widgets_init')) {
        register_sidebar(array(
            'name' => __('Sidebar', _NP_TEXT_DOMAIN),
            'id' => 'sidebar-1',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<header><h2 class="widget-title">',
            'after_title' => '</h2></header>',
        ));
    }
    add_action('widgets_init', 'enpii_widgets_init');
}
add_action( 'widgets_init', 'enpii_widgets_init' );
/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function enpii_widget_tag_cloud_args( $args ) {
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'enpii_widget_tag_cloud_args' );

if ( ! function_exists( 'enpii_fonts_url' ) ) :
    /**
     * Register Google fonts for Twenty Sixteen.
     *
     * Create your own twentysixteen_fonts_url() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function enpii_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Montserrat:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Inconsolata:400';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

if (!function_exists('enpii_scripts')) {
    /**
     * Enqueue scripts and styles.
     */
    function enpii_scripts()
    {
        if(defined('_ENPII_CORE')) {
            NpWp::useAddOn(array(
                'font-awesome',
//                'bootstrap-js',
                'bx-slider',
                'detect-izr',
                'color-box',
                'owl-carousel',
                'packery',
                'slick'
            ));
        }
        //Add google font
        wp_enqueue_style( 'enpii-fonts', enpii_fonts_url(), array(), null );

        wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

        // Theme stylesheet.
        wp_enqueue_style( 'enpii-style', get_stylesheet_uri() );

        // Load the Internet Explorer specific stylesheet.
        wp_enqueue_style( 'enpii-ie', get_template_directory_uri() . '/css/ie.css', array( 'enpii-style' ), '20150930' );
        wp_style_add_data( 'enpii-ie', 'conditional', 'lt IE 10' );

        // Load the Internet Explorer 8 specific stylesheet.
        wp_enqueue_style( 'enpii-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'enpii-style' ), '20151230' );
        wp_style_add_data( 'enpii-ie8', 'conditional', 'lt IE 9' );

        // Load the Internet Explorer 7 specific stylesheet.
        wp_enqueue_style( 'enpii-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'enpii-style' ), '20150930' );
        wp_style_add_data( 'enpii-ie7', 'conditional', 'lt IE 8' );

        wp_add_inline_style( 'custom-style', get_field('custom_css', 'option') );

        // Load the html5 shiv.
        wp_enqueue_script( 'enpii-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
        wp_script_add_data( 'enpii-html5', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'enpii-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true );
        wp_enqueue_script('google-maps-api',  '//maps.googleapis.com/maps/api/js', array(), _NP_THEME_VERSION, true);
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        if ( is_singular() && wp_attachment_is_image() ) {
            wp_enqueue_script( 'enpii-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
        }

        wp_enqueue_script( 'enpii-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151204', true );

        wp_localize_script( 'enpii-script', 'screenReaderText', array(
            'expand'   => __( 'expand child menu', _NP_TEXT_DOMAIN ),
            'collapse' => __( 'collapse child menu', _NP_TEXT_DOMAIN ),
        ) );


        if (_NP_TEMPLATE_URL != _NP_CHILD_TEMPLATE_URL) {
//            wp_enqueue_style('bootstrap_base-child', _NP_CHILD_TEMPLATE_URL . '/css/bootstrap_base.css', array(), _NP_THEME_VERSION);
//            wp_enqueue_style('font-css', _NP_CHILD_TEMPLATE_URL . '/css/font.css', array(), _NP_THEME_VERSION);
            wp_enqueue_style('style-child', _NP_CHILD_TEMPLATE_URL . '/css/main.css', array(), _NP_THEME_VERSION);
            wp_enqueue_style('style-custom-child', _NP_CHILD_TEMPLATE_URL . '/css/custom.css', array(), _NP_THEME_VERSION);
        } else {
//            wp_enqueue_style('bootstrap_base', _NP_TEMPLATE_URL . '/css/bootstrap_base.css', array(), _NP_THEME_VERSION);
//            wp_enqueue_style('font-css', _NP_TEMPLATE_URL . '/css/font.css', array(), _NP_THEME_VERSION);
            wp_enqueue_style('style-parent', _NP_TEMPLATE_URL . '/css/main.css', array(), _NP_THEME_VERSION);
            wp_enqueue_style('style-custom', _NP_TEMPLATE_URL . '/css/custom.css', array(), _NP_THEME_VERSION);
        }

        if(_NP_TEMPLATE_URL != _NP_CHILD_TEMPLATE_URL) {
            wp_enqueue_script('modernizr-child', _NP_CHILD_TEMPLATE_URL . '/js/modernizr.js', array(), _NP_THEME_VERSION, true);
            wp_enqueue_script('detectizr-child', _NP_CHILD_TEMPLATE_URL . '/js/detectizr.js', array(), _NP_THEME_VERSION, true);
            wp_enqueue_script('main-child', _NP_CHILD_TEMPLATE_URL . '/js/main.js', array(), _NP_THEME_VERSION, true);
        } else {
            wp_enqueue_script('modernizr',  _NP_TEMPLATE_URL . '/js/modernizr.js', array(), _NP_THEME_VERSION, true);
            wp_enqueue_script('detectizr',  _NP_TEMPLATE_URL . '/js/detectizr.js', array(), _NP_THEME_VERSION, true);
            wp_enqueue_script('validate',  _NP_TEMPLATE_URL . '/js/jquery.validate.js', array(), _NP_THEME_VERSION, true);
            wp_enqueue_script('main',  _NP_TEMPLATE_URL . '/js/main.js', array(), _NP_THEME_VERSION, true);
        }

        // js for threaded comments
        if (_NP_ALLOW_COMMENT && is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('wp_enqueue_scripts', 'enpii_scripts');

