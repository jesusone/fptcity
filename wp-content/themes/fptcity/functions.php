<?php
/**
 * Zo Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
/**
 * Add global values.
 */
global $smof_data, $zo_meta, $zo_base;

$theme = wp_get_theme();

define('THEMENAME', $theme->get('Name'));


/* Add base functions */
require( get_template_directory() . '/inc/base.class.php' );

if (class_exists("ZO_Base")) {
    $zo_base = new ZO_Base();
}

/* Add ReduxFramework. */
if (!class_exists('ReduxFramework')) {
    require( get_template_directory() . '/inc/ReduxCore/framework.php' );
}

/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/* Add custom vc params. */
if (class_exists('Vc_Manager')) {

    /* Add theme elements */
    add_action('vc_before_init', 'zo_vc_elements');

    function zo_vc_elements() {
        if (class_exists('ZoShortcode')) {
            $element = get_template_directory() . '/inc/elements/googlemap';

           // require( $element . '/zo_googlemap.php' );
        }
    }

    add_action('init', 'zo_vc_params');

    function zo_vc_params() {
        require( get_template_directory() . '/vc_params/vc_rows.php' );
        require( get_template_directory() . '/vc_params/vc_column.php' );
        require( get_template_directory() . '/vc_params/vc_btn.php' );
        require( get_template_directory() . '/vc_params/vc_separator.php' );
        require( get_template_directory() . '/vc_params/vc_tabs.php' );
        require( get_template_directory() . '/vc_params/vc_pie.php' );
        require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
        require( get_template_directory() . '/vc_params/vc_images_carousel.php' );
    }

}
/* Remove Element VC */
if (class_exists('Vc_Manager')) {
    vc_remove_element("vc_button");
    vc_remove_element("vc_cta_button");
    vc_remove_element("vc_cta_button2");
}
/* Add SCSS */
if (!class_exists('scssc')) {
    require( get_template_directory() . '/inc/libs/scss.inc.php' );
}

/* Add Meta Core Options */
if (is_admin()) {

    if (!class_exists('ZoCoreControl')) {
        /* add mete core */
        require( get_template_directory() . '/inc/metacore/core.options.php' );
        /* add meta options */
        require( get_template_directory() . '/inc/options/meta.options.php' );
    }

    /* tmp plugins. */
    require( get_template_directory() . '/inc/options/require.plugins.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css */
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Add mega menu */
if (isset($smof_data['menu_mega']) && $smof_data['menu_mega'] && !class_exists('HeroMenuWalker')) {
    require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
}

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cart_search.php' );
require( get_template_directory() . '/inc/widgets/news_tabs.php' );
require( get_template_directory() . '/inc/widgets/recent_post_v2.php' );
require( get_template_directory() . '/inc/widgets/instagram.php' );
require( get_template_directory() . '/inc/widgets/tweets.php' );
require( get_template_directory() . '/inc/widgets/social.php' );
require( get_template_directory() . '/inc/widgets/recent-posts-widget-with-thumbnails.php' );
require( get_template_directory() . '/inc/widgets/flickr-badges-widget.php' );

/*Setup Webservice*/
require( get_template_directory() . '/webservice/webservice.php' );

// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width))
    $content_width = 625;
/*
 * Limit Words
 */
if (!function_exists('zo_limit_words')) {

    function zo_limit_words($string, $word_limit) {
        $words = explode(' ', strip_tags($string), ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return apply_filters('the_excerpt', implode(' ', $words));
    }

}

/**
 * Zo ZAP setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Zo ZAP supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Zo ZAP 1.0
 */
function zo_setup() {
    /*
     * Makes Zo ZAP available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Zo ZAP, use a find and replace
     * to change 'zo-zap' to the name of your theme in all the template files.
     */
    load_theme_textdomain('fptcity', get_template_directory() . '/languages');

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds title tag
    add_theme_support("title-tag");

    // Add woocommerce
    add_theme_support('woocommerce');

    // Adds custom header
    add_theme_support('custom-header');

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('video', 'audio', 'gallery', 'link', 'quote',));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'fptcity'));

    /*
     * This theme supports custom background color and image,
     * and here we also set up the default background color.
     */
    add_theme_support('custom-background', array(
        'default-color' => 'e6e6e6',
    ));

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    add_image_size('zo-blog-medium', 480, 330, true);
    add_image_size('zo-blog-thumbnail', 370, 340, true);
    add_image_size('zo-team-thumbnail', 480, 460, true);
    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
}

add_action('after_setup_theme', 'zo_setup');

/**
 * Add Image Size to Media
 *
 * @param $sizes
 * @return array
 */
function zo_media_image_sizes($sizes) {
    return array_merge($sizes, array(
        'zo-blog-thumbnail' => 'Image Size 370x340',
        'zo-blog-medium' => 'Image Size 480x330',
        'zo-team-thumbnail' => 'Image Size 480x460',
    ));
}

add_filter('image_size_names_choose', 'zo_media_image_sizes');

/**
 * Get meta data.
 * @author Fox
 * @return mixed|NULL
 */
function zo_meta_data() {
    global $post, $zo_meta;
	
    if (!isset($post->ID))
        return;

    $zo_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if (empty($zo_meta))
        return;

    foreach ($zo_meta as $key => $meta) {
        $zo_meta->$key = rawurldecode($meta);
    }
}

add_action('wp', 'zo_meta_data');

/**
 * Get post meta data.
 * @author Fox
 * @return mixed|NULL
 */
function zo_post_meta_data() {
    global $post;

    if (!isset($post->ID))
        return null;

    $post_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if (empty($post_meta))
        return null;

    foreach ($post_meta as $key => $meta) {
        $post_meta->$key = rawurldecode($meta);
    }

    return $post_meta;
}

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since ZO SuperHeroes 1.0
 */
function zo_scripts_styles() {

    global $smof_data, $wp_styles, $wp_scripts;

    /** theme options. */
    $script_options = array(
        'menu_sticky' => $smof_data['menu_sticky'],
        'menu_sticky_tablets' => $smof_data['menu_sticky_tablets'],
        'menu_sticky_mobile' => $smof_data['menu_sticky_mobile'],
        'paralax' => $smof_data['paralax'],
        'back_to_top' => $smof_data['footer_botton_back_to_top'],
        'page_title_parallax' => $smof_data['page_title_parallax'],
    );

    /* ------------------------------------- JavaScript --------------------------------------- */


    /** --------------------------libs--------------------------------- */
    /* Adds JavaScript Bootstrap. */
    wp_enqueue_script('zotheme-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2');

    /* Add parallax plugin. */
    if ($smof_data['paralax']) {
        wp_enqueue_script('zotheme-parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array('jquery'), '1.1.3', true);
    }
    /* Add smoothscroll plugin */
    if ($smof_data['smoothscroll']) {
        wp_enqueue_script('zotheme-smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array('jquery'), '1.0.0', true);
    }

    /* Fancy box */
    wp_register_script('zotheme-fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);
    wp_register_style('zotheme-fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.css');
    /* Slick Slider */
    wp_register_script('zo-slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.5.7', true);
    wp_register_style('zo-slick-css', get_template_directory_uri() . '/assets/css/slick.css');
    /** --------------------------custom------------------------------- */
    /* Add main.js */
    wp_register_script('zotheme-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    wp_localize_script('zotheme-main', 'ZOOptions', $script_options);
    wp_enqueue_script('zotheme-main');
    /* Add menu.js */
    wp_enqueue_script('zotheme-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);
    /* VC Pie Custom JS */
    wp_register_script('progressCircle', get_template_directory_uri() . '/assets/js/process_cycle.js', array('jquery'), '1.0.0', true);
    wp_register_script('vc_pie_custom', get_template_directory_uri() . '/assets/js/vc_pie_custom.js', array('jquery'), '1.0.0', true);
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    // check for plugin using plugin name
    if (is_plugin_active('timetable/timetable.php')) {
        wp_dequeue_script('timetable_main');
        wp_enqueue_script('timetable_custom', get_template_directory_uri() . '/assets/js/timetable.js', array('jquery'), '1.0.0', true);
    }
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /* ------------------------------------- Stylesheet --------------------------------------- */

    /** --------------------------libs--------------------------------- */
    /* Loads Bootstrap stylesheet. */
    wp_enqueue_style('zotheme-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');

    /* Loads Bootstrap stylesheet. */
    wp_enqueue_style('zotheme-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');

    /* Loads Font Ionicons. */
    wp_enqueue_style('zotheme-font-ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', array(), '2.0.1');

    /* Loads Pe Icon. */
    wp_enqueue_style('zotheme-pe-icon', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), '1.0.1');

    /** --------------------------custom------------------------------- */
    /* Loads our main stylesheet. */
    wp_enqueue_style('zotheme-style', get_stylesheet_uri(), array('zotheme-bootstrap'));

    /* Loads the Internet Explorer specific stylesheet. */
    wp_enqueue_style('zo_zap-ie', get_template_directory_uri() . '/assets/css/ie.css', array('zotheme-style'), '20121010');
    $wp_styles->add_data('zo_zap-ie', 'conditional', 'lt IE 9');

    /* Load static css */
    wp_enqueue_style('zotheme-static', get_template_directory_uri() . '/assets/css/static.css', array('zotheme-style'), '1.0.0');

    /**
     * IE Fallbacks
     */
    wp_register_script('ie_html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), false, '3.7.2');
    wp_enqueue_script('ie_html5shiv');
    $wp_scripts->add_data('ie_html5shiv', 'conditional', 'lt IE 9');

    wp_register_script('ie_respond', get_template_directory_uri() . '/assets/js/respond.min.js', array(), false, '1.4.2');
    wp_enqueue_script('ie_respond');
    $wp_scripts->add_data('ie_respond', 'conditional', 'lt IE 9');
}

add_action('wp_enqueue_scripts', 'zo_scripts_styles');

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function zo_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'fptcity'),
        'id' => 'sidebar-1',
        'description' => __('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Header Top 1', 'fptcity'),
        'id' => 'sidebar-2',
        'description' => __('Appears when using the optional Header with a page set as Header top left', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Menu logo', 'fptcity'),
        'id' => 'sidebar-3',
        'description' => __('Appears when using the optional Header with a page set as Header top right', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Menu Right', 'fptcity'),
        'id' => 'sidebar-4',
        'description' => __('Appears when using the optional Menu with a page set as Menu right', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Content', 'fptcity'),
        'id' => 'sidebar-content',
        'description' => __('Appears when using the optional Content with a page set as Content', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Content', 'fptcity'),
        'id' => 'sidebar-content',
        'description' => __('Appears when using the optional Content with a page set as Content', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Top 1', 'fptcity'),
        'id' => 'sidebar-5',
        'description' => __('Appears when using the optional Footer with a page set as Footer Top 1', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Top 2', 'fptcity'),
        'id' => 'sidebar-6',
        'description' => __('Appears when using the optional Footer with a page set as Footer Top 2', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Top 3', 'fptcity'),
        'id' => 'sidebar-7',
        'description' => __('Appears when using the optional Footer with a page set as Footer Top 3', 'fptcity'),
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Top 4', 'fptcity'),
        'id' => 'sidebar-8',
        'description' => __('Appears when using the optional Footer with a page set as Footer Top 4', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Bottom Left', 'fptcity'),
        'id' => 'sidebar-9',
        'description' => __('Appears when using the optional Footer Bottom with a page set as Footer Bottom left', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Bottom Right', 'fptcity'),
        'id' => 'sidebar-10',
        'description' => __('Appears when using the optional Footer Bottom with a page set as Footer Bottom right', 'fptcity'),
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Shop Menu Sidebar', 'fptcity'),
        'id' => 'sidebar-11',
        'description' => __('Appears when using the optional Shop with Menu attach Widget', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Shop Sidebar', 'fptcity'),
        'id' => 'sidebar-12',
        'description' => __('Appears when using the optional Shop with a page set as Shop page', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Header Right', 'fptcity'),
        'id' => 'header-right',
        'description' => __('Appears when using the optional Cart & Search', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Header Top Sliders', 'fptcity'),
        'id' => 'header-top-sliders',
        'description' => __('Appears when using the optional Revolution Sliders', 'fptcity'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
}

add_action('widgets_init', 'zo_widgets_init');

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function zo_page_menu_args($args) {
    if (!isset($args['show_home']))
        $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'zo_page_menu_args');

/**
 * Add field subtitle to post.
 * 
 * @since 1.0.0
 */
function zo_add_subtitle_field() {
    global $post, $zo_meta;

    /* get current_screen. */
    $screen = get_current_screen();

    /* show field in post. */
    if (in_array($screen->id, array('post'))) {

        /* get value. */
        $value = get_post_meta($post->ID, 'post_subtitle', true);

        /* html. */
        echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr($value) . '" id="subtitle" placeholder = "' . __('Subtitle', 'fptcity') . '" style="width: 100%;margin-top: 4px;"></div>';
    }
}

//add_action( 'edit_form_after_title', 'zo_add_subtitle_field' );

/**
 * Save custom theme meta. 
 * 
 * @since 1.0.0
 */
function zo_save_meta_boxes($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    /* update field subtitle */
    if (isset($_POST['post_subtitle'])) {
        update_post_meta($post_id, 'post_subtitle', $_POST['post_subtitle']);
    }
}

add_action('save_post', 'zo_save_meta_boxes');

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 * @param null $query
 */
function zo_paging_nav($query = null) {
    // Don't print empty markup if there's only one page.
    if ($query) {
        $zo_query = $query;
    } else {
        $zo_query = $GLOBALS['wp_query'];
    }
    if ($zo_query->max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $zo_query->max_num_pages,
        'current' => $paged,
        'mid_size' => 1,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => __('<i class="fa fa-angle-double-left"></i>', 'fptcity'),
        'next_text' => __('<i class="fa fa-angle-double-right"></i>', 'fptcity'),
    ));

    if ($links) :
        ?>
        <nav class="navigation paging-navigation clearfix" role="navigation">
            <div class="pagination loop-pagination">
                <?php echo '' . $links; ?>
            </div><!-- .pagination -->
        </nav><!-- .navigation -->
        <?php
    endif;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0.0
 */
function zo_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous)
        return;
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links clearfix">
            <?php
            $prev_post = get_previous_post();
            if (!empty($prev_post)):
                ?>
                <a class="post-prev left" href="<?php echo get_permalink($prev_post->ID); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><i class="fa fa-long-arrow-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
            <?php endif; ?>
            <?php
            $next_post = get_next_post();
            if (is_a($next_post, 'WP_Post')) :
                ?>
                <a class="post-next right" href="<?php echo get_permalink($next_post->ID); ?>" title="<?php echo get_the_title($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?><i class="fa fa-long-arrow-right"></i></a>
            <?php endif; ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

/* Add Custom Comment */

function zo_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author-image vcard">
            <?php echo get_avatar($comment, 109); ?>
        </div>
        <div class="comment-main">
            <div class="comment-header">
                <?php printf(__('<span class="comment-author">%s</span>', 'fptcity'), get_comment_author_link()); ?>
                <span class="comment-date">
                    <?php echo get_comment_time('d.m.Y') . ' ' . __('at', 'fptcity') . ' ' . get_comment_time('H:i'); ?>
                </span>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'fptcity'); ?></em>
                <?php endif; ?>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <div class="reply">
                <?php
                comment_reply_link(
                        array_merge($args, array(
                    'add_below' => $add_below,
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'])
                        )
                );
                ?>
                <i class="fa fa-mail-forward"></i>
            </div>
        </div>
        <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/* End Custom Comment */

/* Custom excerpt length */

function zo_excerpt_length($length) {
    return 30;
}

add_filter('excerpt_length', 'zo_excerpt_length', 999);

function zo_excerpt_more($more) {
    return '';
}

add_filter('excerpt_more', 'zo_excerpt_more');
/* End Custom excerpt length */

/**
 * Ajax post like.
 *
 * @since 1.0.0
 */
function zo_post_like_callback() {

    $post_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $likes = null;

    if ($post_id && !isset($_COOKIE['zo_post_like_' . $post_id])) {

        /* get old like. */
        $likes = get_post_meta($post_id, '_zo_post_likes', true);

        /* check old like. */
        $likes = $likes ? $likes : 0;

        $likes++;

        /* update */
        update_post_meta($post_id, '_zo_post_likes', $likes);

        /* set cookie. */
        setcookie('zo_post_like_' . $post_id, $post_id, time() * 20, '/');
    }

    echo esc_attr($likes);

    die();
}

add_action('wp_ajax_zo_post_like', 'zo_post_like_callback');
add_action('wp_ajax_nopriv_zo_post_like', 'zo_post_like_callback');

/**
 * Load ajax url.
 */
function zo_ajax_url_head() {
    echo '<script type="text/javascript"> var ajaxurl = "' . admin_url('admin-ajax.php') . '"; </script>';
}

add_action('wp_head', 'zo_ajax_url_head');

/**
 * Count post view.
 *
 * @since 1.0.0
 */
function zo_set_count_view() {
    global $post;

    if (is_single() && !empty($post->ID) && !isset($_COOKIE['zo_post_view_' . $post->ID])) {

        $views = get_post_meta($post->ID, '_zo_post_views', true);

        $views = $views ? $views : 0;

        $views++;

        update_post_meta($post->ID, '_zo_post_views', $views);

        /* set cookie. */
        setcookie('zo_post_view_' . $post->ID, $post->ID, time() * 20, '/');
    }
}

add_action('wp', 'zo_set_count_view');

/**
 * Get Post view
 * @return int|mixed
 */
function zo_get_count_view() {
    global $post;

    $views = get_post_meta($post->ID, '_zo_post_views', true);

    $views = $views ? $views : 0;
    return $views;
}

/**
 * Image Resize
 *
 * @param $attachment_id
 * @param int $w
 * @param int $h
 * @return bool|mixed|string
 */
function zo_image_resize($attachment_id, $w = 300, $h = 300) {
    $attachment_url = wp_get_attachment_url($attachment_id);
    $attachment_file = str_replace(home_url('/'), ABSPATH, $attachment_url);
    if (is_file($attachment_file)):
        $img = wp_get_image_editor($attachment_file);
        if (!is_wp_error($img)) {
            $img->resize($w, $h, true);
            $img = $img->save();
            $attachment_url = str_replace(ABSPATH, home_url('/'), $img['path']);
        }
    endif;
    return $attachment_url;
}

/**
 * Get list image sizes
 * @return array
 */
function zo_image_sizes() {
    $sizes = zo_get_image_sizes();
    $images = array();
    foreach ($sizes as $key => $size) {
        $images["$key {$size['width']}x{$size['height']}"] = $key;
    }
    $images["FULL"] = 'full';
    return $images;
}

/**
 * List available image sizes with width and height following
 *
 * @param string $size
 * @return array|bool
 */
function zo_get_image_sizes($size = '') {

    global $_wp_additional_image_sizes;

    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();

    // Create the full array with sizes and crop info
    foreach ($get_intermediate_image_sizes as $_size) {

        if (in_array($_size, array('thumbnail', 'medium', 'large'))) {

            $sizes[$_size]['width'] = get_option($_size . '_size_w');
            $sizes[$_size]['height'] = get_option($_size . '_size_h');
            $sizes[$_size]['crop'] = (bool) get_option($_size . '_crop');
        } elseif (isset($_wp_additional_image_sizes[$_size])) {

            $sizes[$_size] = array(
                'width' => $_wp_additional_image_sizes[$_size]['width'],
                'height' => $_wp_additional_image_sizes[$_size]['height'],
                'crop' => $_wp_additional_image_sizes[$_size]['crop']
            );
        }
    }
    // Get only 1 size if found
    if ($size) {

        if (isset($sizes[$size])) {
            return $sizes[$size];
        } else {
            return false;
        }
    }

    return $sizes;
}

/**
 * Get list custom post type using for custom background header in theme options.
 *
 * @return array
 */
function zo_list_post_types() {
    $types = array();
    /*
     * Add Product Post Type of WooCommerce
     */
    if (class_exists('WooCommerce')) {
        $types['product'] = __('Products', 'fptcity');
    }
    /*
     * Get list custom post type CPT
     */
    $post_types = get_option('cptui_post_types', array());
    foreach ($post_types as $type) {
        $types[$type['name']] = $type['label'];
    }

    return $types;
}

/**
 * Add Fancybox into a post type
 */
function zo_add_fancybox() {
    if (is_singular('portfolio')) {
        wp_enqueue_script('zotheme-fancybox');
        wp_enqueue_style('zotheme-fancybox');
        wp_enqueue_script('zo-slick-js');
        wp_enqueue_style('zo-slick-css');
    }
}

add_action('wp_enqueue_scripts', 'zo_add_fancybox');

/* Woo support */
if (class_exists('Woocommerce')) {
    //item per page
    require get_template_directory() . '/woocommerce/wc-template-functions.php';
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}

/* Filter Search results */

function zo_searchfilter($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post','product','team', 'portfolio', 'testimonial', 'pricing', 'service'));
    }
    return $query;
}
add_filter('pre_get_posts', 'zo_searchfilter');

/**
 * 		Add User Role Meta Box
 */
function zo_user_role_meta_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {

		add_meta_box(
			'_zo_user_role',
			__( 'User Role', 'fptcity' ),
			'user_role_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'zo_user_role_meta_box' );

function user_role_meta_box_callback( $post ) {
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_zo_user_role', true );
	echo '<label for="user_role_field">';
	_e( 'Default: 1,2,3,4,5 (Admin: 1, Khách Hàng: 2, Đối Tác: 3, Khách Vãn Lai: 4, Người xem: 5)', 'ftpcity' );
	echo '</label> ';
	echo '<input type="text" id="user_role_field" name="user_role_field" value="' . esc_attr( $value ) . '" size="25" />';
}
 
function user_role_save_meta_box_data( $post_id ) {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}	
	// Make sure that it is set.
	if ( ! isset( $_POST['user_role_field'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['user_role_field'] );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_zo_user_role', $my_data );
}
add_action( 'save_post', 'user_role_save_meta_box_data' );

/**
 * 		Add Public / Private Meta Box
 */
function zo_public_or_private_meta_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {

		add_meta_box(
			'_zo_public_or_private',
			__( 'Public / Private', 'fptcity' ),
			'public_or_private_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'zo_public_or_private_meta_box' );

function public_or_private_meta_box_callback( $post ) {
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_zo_public_or_private', true );
	?>
		<select id="user_public_or_private" name="user_public_or_private">
			<option value="1" <?php echo ($value) == 1 ? 'selected' : ''; ?>><?php _e('Public','fptcity');?></option>
			<option value="0" <?php echo ($value) == 0 ? 'selected' : ''; ?>><?php _e('Private','fptcity');?></option>
		</select>
	<?php
}
 
function public_or_private_save_meta_box_data( $post_id ) {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}	
	// Make sure that it is set.
	if ( ! isset( $_POST['user_public_or_private'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['user_public_or_private'] );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_zo_public_or_private', $my_data );
}
add_action( 'save_post', 'public_or_private_save_meta_box_data' );

/**
 * 		Add Type Of Copy Meta Box
 */
function zo_type_of_copy_meta_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {

		add_meta_box(
			'_zo_type_of_copy',
			__( 'Type of Copy', 'fptcity' ),
			'type_of_copy_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'zo_type_of_copy_meta_box' );

function type_of_copy_meta_box_callback( $post ) {
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_zo_type_of_copy', true );
	?>
		<select id="user_type_of_copy" name="user_type_of_copy">
			<option value="0" <?php echo ($value) == 0 ? 'selected' : ''; ?>><?php _e('Default','fptcity');?></option>
			<option value="1" <?php echo ($value) == 1 ? 'selected' : ''; ?>><?php _e('Bao Moi','fptcity');?></option>
		</select>
	<?php
}
 
function type_of_copy_save_meta_box_data( $post_id ) {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}	
	// Make sure that it is set.
	if ( ! isset( $_POST['user_type_of_copy'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['user_type_of_copy'] );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_zo_type_of_copy', $my_data );
}
add_action( 'save_post', 'type_of_copy_save_meta_box_data' );

/**
 * 		Add Source Meta Box
 */
function zo_source_meta_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {

		add_meta_box(
			'_zo_get_source',
			__( 'Get Source', 'fptcity' ),
			'source_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'zo_source_meta_box' );

function source_meta_box_callback( $post ) {
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_zo_get_source', true );
	echo '<label for="source_field">';
	_e( 'Source:' );
	echo '</label> ';
	echo '<input type="text" id="source_field" name="source_field" value="' . esc_attr( $value ) . '" size="25" />';
}
 
function source_save_meta_box_data( $post_id ) {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}	
	// Make sure that it is set.
	if ( ! isset( $_POST['source_field'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['source_field'] );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_zo_get_source', $my_data );
}
add_action( 'save_post', 'source_save_meta_box_data' );