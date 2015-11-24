<?php
global $zo_base;
/* get local fonts. */
$local_fonts = is_admin() ? $zo_base->getListLocalFontsName() : array() ;
/**
 * Home Options
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Main Options', 'startup'),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'id' => 'intro_product',
            'type' => 'intro_product',
        )
    )
);
/* Start Dummy Data*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('ZoThemeCore') or !function_exists('cptui_create_custom_post_types')){
    $disabled = ' disabled ';
    $msg='You should be install visual composer, ZoTheme and Custom Post Type UI plugins to import data.';
}
$this->sections[] = array(
    'icon' => 'el-icon-briefcase',
    'title' => __('Demo Content', 'startup'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => '<input type=\'button\' name=\'sample\' id=\'dummy-data\' '.$disabled.' value=\'Import Now\' /><div class=\'zo-dummy-process\'><div  class=\'zo-dummy-process-bar\'></div></div><div id=\'zo-msg\'><span class="zo-status"></span>'.$msg.'</div>',
            'id' => 'theme',
            'icon' => true,
            'default' => 'startup',
            'options' => array(
                'startup' => get_template_directory_uri().'/assets/images/dummy/zap.png'
            ),
            'type' => 'image_select',
            'title' => 'Select Theme'
        )
    )
);
/* End Dummy Data*/
/**
 * Header Options
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Header', 'startup'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', 'startup'),
            'subtitle' => __('select a layout for header', 'startup'),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
            )
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Header Height', 'startup'),
            'output' => array('#zo-header'),
            'width' => false,
            'default'  => array(
                'height'  => '55px'
            ),
        ),
        array(
            'id' => 'header_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header'),
            'default' => array(
                'margin-top'     => '100px',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'header_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'subtitle' => __('enable transparent mode for header.', 'startup'),
            'id' => 'menu_transparent',
            'type' => 'switch',
            'title' => __('Transparent Header', 'startup'),
            'default' => true,
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', 'startup'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Header', 'startup'),
            'default' => false,
        ),
        array(
            'id'       => 'menu_sticky_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Sticky Header Height', 'startup'),
            'width' => false,
            'default'  => array(
                'height'  => '55px'
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'menu_sticky_header_margin',
            'title' => __('Sticky Header Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'menu_sticky_header_padding',
            'title' => __('Sticky Header Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', 'startup'),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', 'startup'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', 'startup'),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', 'startup'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */

$this->sections[] = array(
    'title' => __('Header Top', 'startup'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable header top.', 'startup'),
            'id' => 'enable_header_top',
            'type' => 'switch',
            'title' => __('Enable Header Top', 'startup'),
            'default' => false,
        ),
        array(
            'id' => 'header_top_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'header_top_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', 'startup'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Select Logo', 'startup'),
            'subtitle' => __('Select an image file for your logo.', 'startup'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'id'       => 'main_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Logo Height', 'startup'),
            'width' => false,
            'default'  => array(
                'height'  => '60px'
            ),
        ),
        array(
            'id'       => 'sticky_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Sticky Logo Height', 'startup'),
            'width' => false,
            'default'  => array(
                'height'  => '80px'
            ),
        ),
    )
);

/* Menu */
$this->sections[] = array(
    'title' => __('Menu', 'startup'),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Menu position.',
            'id' => 'menu_position',
            'options' => array(
                1 => 'Menu Left',
                2 => 'Menu Right',
                3 => 'Menu Center',
            ),
            'type' => 'select',
            'title' => __('Menu Position', 'startup'),
            'default' => '2'
        ),
        array(
            'id' => 'menu_margin_first_level',
            'title' => __('Menu Margin - First Level', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '9px',
                'margin-bottom'  => '30px',
                'margin-left'    => '9px',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_padding_first_level',
            'title' => __('Menu Padding - First Level', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '30px',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_fontsize_first_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - First Level', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '14px',
            )
        ),
        array(
            'id' => 'menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - Sub Level', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li ul a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '11px',
            )
        ),
        array(
            'subtitle' => __('enable sub menu border bottom.', 'startup'),
            'id' => 'menu_border_color_bottom',
            'type' => 'switch',
            'title' => __('Border Bottom Menu Item Sub Level', 'startup'),
            'default' => false,
        ),
        array(
            'subtitle' => __('Enable mega menu.', 'startup'),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => __('Mega Menu', 'startup'),
            'default' => true,
        ),
        array(
            'subtitle' => __('Enable menu first level uppercase.', 'startup'),
            'id' => 'menu_first_level_uppercase',
            'type' => 'switch',
            'title' => __('Menu First Level Uppercase', 'startup'),
            'default' => false,
        ),
        array(
            'id' => 'menu_icon_font_size',
            'type' => 'typography',
            'title' => __('Menu Icon Font Size', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
    )
);

/* Stick Menu */
$this->sections[] = array(
    'title' => __('Stick Menu', 'startup'),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'stick_menu_fontsize_first_level',
            'type' => 'typography',
            'title' => __('Stick Menu Font Size - First Level', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'id' => 'sticky_menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => __('Sticky Menu Font Size - Sub Level', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li ul li a',
                '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li a '),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'id' => 'sticky_menu_icon_font_size',
            'type' => 'typography',
            'title' => __('Sticky Menu Icon Font Size', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header.header-fixed .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),

    )
);

/**
 * Page Title
 *
 * @author Fox
 */

/**
 * Page title settings
 *
 */
$page_title = array(
    array(
        'id' => 'page_title_layout',
        'title' => __('Layouts', 'startup'),
        'subtitle' => __('select a layout for page title', 'startup'),
        'default' => '5',
        'type' => 'image_select',
        'options' => array(
            '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
            '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
            '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
            '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
            '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
            '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
            '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
        )
    ),
    array(
        'id'       => 'page_title_background',
        'type'     => 'background',
        'title'    => __( 'Background', 'startup' ),
        'subtitle' => __( 'page title background with image, color, etc.', 'startup' ),
        'output'   => array('#zo-page-element-wrap'),
        'default'   => array(
            'background-color'=>'#ffffff',
            'background-image'=> get_template_directory_uri().'/assets/images/pagetitle.jpg',
            'background-repeat'=>'',
            'background-size'=>'cover',
            'background-attachment'=>'',
            'background-position'=>'center center'
        )
    ),
    array(
        'id' => 'page_title_margin',
        'title' => __('Margin', 'startup'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'margin',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'margin-top'     => '0',
            'margin-right'   => '0',
            'margin-bottom'  => '80px',
            'margin-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_padding',
        'title' => __('Padding', 'startup'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'padding',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'padding-top'     => '340px',
            'padding-right'   => '0',
            'padding-bottom'  => '260px',
            'padding-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_parallax',
        'title' => __('Enable Header Parallax', 'startup'),
        'type' => 'switch',
        'default' => false
    ),
    array(
        'id' => 'page_title_custom_post',
        'title' => __('Custom Background For Post Type', 'startup'),
        'type' => 'switch',
        'default' => false
    ),
);
/**
 * add custom background for post type
 */
$post_types = zo_list_post_types();
foreach( $post_types as $type => $name) {
    $page_title[] = array(
        'id'       => 'page_title_custom_post_' . $type,
        'type'     => 'background',
        'title'    => sprintf( __( 'Background For %s' , 'startup'), $name),
        'subtitle' => sprintf( __( 'Custom background image for post type %s', 'startup' ), $name),
        'output'   => array('.single-'.$type.' #zo-page-element-wrap'),
        'background-color' => false,
        'background-repeat' => false,
        'background-size' => false,
        'background-attachment' => false,
        'background-position' => false,
        'default'   => array(
            'background-image'=> '',
        ),
        'required' => array( 'page_title_custom_post', '=', 1 )
    );
}
/**
 * Section settings
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', 'startup'),
    'icon' => 'el-icon-map-marker',
    'fields' => $page_title
);

/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', 'startup'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'startup'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '48px',
                'line-height' => '60px',
                'text-align' => 'center'
            )
        ),
        array(
            'id' => 'page_sub_title_typography',
            'type' => 'typography',
            'title' => __('Sub Title', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text .page-sub-title'),
            'units' => 'px',
            'subtitle' => __('Typography option with sub title text.', 'startup'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '36px',
                'text-align' => 'center'
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', 'startup'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', 'startup'),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', 'startup'),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('#breadcrumb #breadcrumb-text .breadcrumbs','#breadcrumb #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'startup'),
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '12px',
                'line-height' => '12px',
                'text-align' => 'center'
            )
        ),
    )
);

/**
 * Body
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Body', 'startup'),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', 'startup'),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', 'startup'),
            'default' => false,
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'startup' ),
            'subtitle' => __( 'body background with image, color, etc.', 'startup' ),
            'output'   => array('body'),
        ),
        array(
            'id' => 'body_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'body_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
    )
);

/**
 * Content
 *
 * Archive, Pages, Single, 404, Search, Category, Tags ....
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Content', 'startup'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'startup' ),
            'subtitle' => __( 'Container background with image, color, etc.', 'startup' ),
            'output'   => array('#main'),
        ),
        array(
            'id' => 'container_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page #main'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'container_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page #main'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        )
    )
);

/**
 * Page Loadding
 *
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Loadding', 'startup'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable page loadding.', 'startup'),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => __('Enable Page Loadding', 'startup'),
            'default' => false,
        ),
        array(
            'subtitle' => __('Select Style Page Loadding.', 'startup'),
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => __('Page Loadding Style', 'startup'),
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )
    )
);

/**
 * Footer
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Footer', 'startup'),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => __('Footer Top', 'startup'),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer top.', 'startup'),
            'id' => 'enable_footer_top',
            'type' => 'switch',
            'title' => __('Enable Footer Top', 'startup'),
            'default' => true,
        ),
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'startup' ),
            'subtitle' => __( 'footer background with image, color, etc.', 'startup' ),
            'output'   => array('footer #zo-footer-top'),
            'default'   => array(
                'background-color'=>'#202020'
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'padding-top'     => '60px',
                'padding-right'   => '0',
                'padding-bottom'  => '20px',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
    )
);

/* footer botton */
$this->sections[] = array(
    'title' => __('Footer Bottom', 'startup'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer bottom.', 'startup'),
            'id' => 'enable_footer_bottom',
            'type' => 'switch',
            'title' => __('Enable Footer Bottom', 'startup'),
            'default' => false,
        ),
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'startup' ),
            'subtitle' => __( 'background with image, color, etc.', 'startup' ),
            'output'   => array('footer #zo-footer-bottom'),
            'default'   => array(
                'background-color'=>'#202020'
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_margin',
            'title' => __('Margin', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_padding',
            'title' => __('Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'padding-top'     => '20px',
                'padding-right'   => '0',
                'padding-bottom'  => '20px',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable button back to top.', 'startup'),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', 'startup'),
            'default' => true,
        )
    )
);

/**
 * Button Option
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Button', 'startup'),
    'icon' => 'el el-bold',
    'fields' => array(
        array(
            'id' => 'button_font_size',
            'type' => 'typography',
            'title' => __('Button Font Size', 'startup'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('.vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3 , .button, .btn, input[type="submit"]'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'subtitle' => __('Enable button uppercase.', 'startup'),
            'id' => 'button_text_uppercase',
            'type' => 'switch',
            'title' => __('Button Text Uppercase', 'startup'),
            'default' => true,
        ),
    )
);

/* Button Default */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Default', 'startup'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_default_padding',
            'title' => __('Button Default - Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_default_border',
            'type'     => 'border',
            'title'    => __('Button Default - Border', 'startup'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_hover',
            'type'     => 'border',
            'title'    => __('Button Default - Border Hover', 'startup'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:hover, .button:hover, .btn:hover, input[type="submit"]:hover, .vc_general.vc_btn3.btn:focus, button.vc_general.vc_btn3:focus, a.vc_general.vc_btn3:focus, .button:focus, .btn:focus, input[type="submit"]:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Default - Border Radius', 'startup'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);

/* Button Primary */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Primary', 'startup'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_primary_padding',
            'title' => __('Button Primary - Padding', 'startup'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn.btn-primary, .vc_general.btn.btn-primary'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_primary_border',
            'type'     => 'border',
            'title'    => __('Button Primary - Border', 'startup'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_hover',
            'type'     => 'border',
            'title'    => __('Button Primary - Border Hover', 'startup'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary:hover, .vc_general.vc_btn3.btn.btn-primary:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Primary - Border Radius', 'startup'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);
/**
 * Styling
 *
 * css color.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Styling', 'startup'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('set color main color.', 'startup'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', 'startup'),
            'default' => '#fcc403'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', 'startup'),
            'default' => '#ffdd00'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', 'startup'),
            'id' => 'link_color',
            'type' => 'color',
            'title' => __('Link Color', 'startup'),
            'output'  => array('a'),
            'default' => '#333'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', 'startup'),
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => __('Link Color Hover', 'startup'),
            'output'  => array('a:hover'),
            'default' => '#fcc403'
        )
    )
);

/** Header Top Color **/
$this->sections[] = array(
    'title' => __('Header Top Color', 'startup'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set background color header top.', 'startup'),
            'id' => 'bg_header_top_color',
            'type' => 'color',
            'title' => __('Background Color', 'startup'),
            'default' => '#ececec'
        ),
        array(
            'subtitle' => __('Set color header top.', 'startup'),
            'id' => 'header_top_color',
            'type' => 'color',
            'title' => __('Font Color', 'startup'),
            'default' => ''
        )
    )
);

/** Header Main Color **/
$this->sections[] = array(
    'title' => __('Header Main Color', 'startup'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for header background color.', 'startup'),
            'id' => 'bg_header',
            'type' => 'color_rgba',
            'title' => __('Header Background Color', 'startup'),
            'default'   => array(
                'alpha'     => 0
            )
        )
    )
);

/** Sticky Header Color **/
$this->sections[] = array(
    'title' => __('Sticky Header', 'startup'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for sticky header.', 'startup'),
            'id' => 'bg_sticky_header',
            'type' => 'color_rgba',
            'title' => __('Sticky Background Color', 'startup'),
            'default'   => array(
                'alpha'     => 0
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/** Menu Color **/

$this->sections[] = array(
    'title' => __('Menu Color', 'startup'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the text color of first level menu items.', 'startup'),
            'id' => 'menu_color_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color - First Level', 'startup'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', 'startup'),
            'id' => 'menu_color_hover_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - First Level', 'startup'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', 'startup'),
            'id' => 'menu_color_active_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Active - First Level', 'startup'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => __('Controls the text color of sub level menu items.', 'startup'),
            'id' => 'menu_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color - Sub Level', 'startup'),
            'default' => '#909090'
        ),
        array(
            'subtitle' => __('Controls the text hover color of sub level menu items.', 'startup'),
            'id' => 'menu_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - Sub Level', 'startup'),
            'default' => '#eeb013'
        ),
        array(
            'subtitle' => __('Controls the border color of sub level menu items.', 'startup'),
            'id' => 'menu_item_border_color',
            'type' => 'color',
            'title' => __('Border Color - Sub Level', 'startup'),
            'default' => '',
            'required' => array( 0 => 'menu_border_color_bottom', 1 => '=', 2 => 1 )
        )
    )
);

/** Button Color **/

$this->sections[] = array(
    'title' => __('Button Color', 'startup'),
    'icon' => 'el el-bold',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the button text color.', 'startup'),
            'id' => 'btn_default_color',
            'type' => 'color',
            'title' => __('Button Default - Font Color', 'startup'),
            'default' => '#000000'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', 'startup'),
            'id' => 'btn_default_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Font Color Hover', 'startup'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'startup'),
            'id' => 'btn_default_bg_color',
            'type' => 'color',
            'title' => __('Button Default - Background Color', 'startup'),
            'default' => 'transparent'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'startup'),
            'id' => 'btn_default_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Background Color Hover', 'startup'),
            'default' => '#f0ba00'
        ),
        array(
            'subtitle' => __('Controls the button text color.', 'startup'),
            'id' => 'btn_primary_color',
            'type' => 'color',
            'title' => __('Button Primary - Font Color', 'startup'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', 'startup'),
            'id' => 'btn_primary_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Font Color Hover', 'startup'),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'startup'),
            'id' => 'btn_primary_bg_color',
            'type' => 'color',
            'title' => __('Button Primary - Background Color', 'startup'),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'startup'),
            'id' => 'btn_primary_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Background Color Hover', 'startup'),
            'default' => 'transparent'
        ),
    )
);

/** Footer Top Color **/
$this->sections[] = array(
    'title' => __('Footer Top Color', 'startup'),
    'icon' => 'el-icon-chevron-up',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', 'startup'),
            'id' => 'footer_top_color',
            'type' => 'color',
            'title' => __('Footer Top Color', 'startup'),
            'default' => '#636363'
        ),
        array(
            'subtitle' => __('Set title color footer top.', 'startup'),
            'id' => 'footer_heading_color',
            'type' => 'color',
            'title' => __('Footer Heading Color', 'startup'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', 'startup'),
            'id' => 'footer_top_link_color',
            'type' => 'color',
            'title' => __('Footer Link Color', 'startup'),
            'default' => '#636363'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', 'startup'),
            'id' => 'footer_top_link_color_hover',
            'type' => 'color',
            'title' => __('Footer Link Color Hover', 'startup'),
            'default' => '#fcc403'
        )
    )
);

/** Footer Bottom Color **/
$this->sections[] = array(
    'title' => __('Footer Bottom Color', 'startup'),
    'icon' => 'el-icon-chevron-down',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', 'startup'),
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'title' => __('Footer Bottom Color', 'startup'),
            'default' => '#3a3a3a'
        )
    )
);

/**
 * Typography
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Typography', 'startup'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'default' => array(
                'color' => '#6f6f6f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '30px',
                'text-align' => ''
            ),
            'subtitle' => __('Typography option with each property can be called individually.', 'startup'),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => __('H1', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '36px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => __('H2', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '30px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => __('H3', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => __('H4', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '20px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => __('H5', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => __('H6', 'startup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '60px',
                'text-align' => ''
            )
        )
    )
);

/* extra font. */
$this->sections[] = array(
    'title' => __('Extra Fonts', 'startup'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => __('Font 1', 'startup'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400italic',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', 'startup'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'startup'),
            'validate' => 'no_html',
            'default' => '.font-second',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => __('Font 2', 'startup'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '700italic',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', 'startup'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'startup'),
            'validate' => 'no_html',
            'default' => '.font-second-bold',
        ),
        array(
            'id' => 'google-font-3',
            'type' => 'typography',
            'title' => __('Font 3', 'startup'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-3',
            'type' => 'textarea',
            'title' => __('Selector 3', 'startup'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'startup'),
            'validate' => 'no_html',
            'default' => '.font-second-normal',
        ),
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => __('Local Fonts', 'startup'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => __( 'Fonts 1', 'startup' ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', 'startup'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'startup'),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-1',
                1 => '!=',
                2 => ''
            )
        ),
        array(
            'id'       => 'local-fonts-2',
            'type'     => 'select',
            'title'    => __( 'Fonts 2', 'startup' ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', 'startup'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'startup'),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-2',
                1 => '!=',
                2 => ''
            )
        )
    )
);

/**
 * Custom CSS
 *
 * extra css for customer.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Custom CSS', 'startup'),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', 'startup'),
            'subtitle' => __('create your css code here.', 'startup'),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Animations', 'startup'),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', 'startup'),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', 'startup'),
            'default' => false
        ),
        array(
            'subtitle' => __('Enable animation parallax for images...', 'startup'),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => __('Images Paralax', 'startup'),
            'default' => true
        ),
    )
);
/**
 * Optimal Core
 *
 * Optimal options for theme. optimal speed
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Optimal Core', 'startup'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', 'startup'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', 'startup'),
            'default' => false
        )
    )
);