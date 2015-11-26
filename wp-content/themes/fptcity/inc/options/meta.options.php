<?php
/**
 * Meta options
 * 
 * @author Fox
 * @since 1.0.0
 */
class ZOMetaOptions
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }
    /* add script */
    function admin_script_loader()
    {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');
            
            wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
            wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
        }
    }
    /* add meta boxs */
    public function add_meta_boxes()
    {
        $this->add_meta_box('template_post_options', __('Setting', 'fptcity'), 'post');
        $this->add_meta_box('template_page_options', __('Setting', 'fptcity'), 'page');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_zo_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }
    /* --------------------- POST ---------------------- */
    function template_post_options() {
		?>
		<div class="tab-container clearfix">
	        <ul class='etabs clearfix'>
	           <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', 'fptcity'); ?></a></li>
	        </ul>
			<div class='panel-container'>
                <div id="tabs-general">
					<?php 
						zo_options(array(
							'id' => 'source_of_post',
							'label' => __('Source: ','fptcity'),
							'type' => 'text'
						));
						zo_options(array(
							'id' => 'type_copy',
							'label' => __('Type: ','fptcity'),
							'type' => 'select',
							'options' => array(
								'' => 'default',
								'fptcity' => 'Fpt City',
								'baomoi' => 'Bao Moi'
							)
						));
					?>
				</div>
			</div>
		</div>
		<?php
	}
	
    /* --------------------- PAGE ---------------------- */
    function template_page_options() {
        global $smof_data;
        ?>
        <div class="tab-container clearfix">
	        <ul class='etabs clearfix'>
	           <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', 'fptcity'); ?></a></li>
	           <li class="tab"><a href="#tabs-header"><i class="fa fa-diamond"></i><?php _e('Header', 'fptcity'); ?></a></li>
	           <li class="tab"><a href="#tabs-page-title"><i class="fa fa-connectdevelop"></i><?php _e('Page Title', 'fptcity'); ?></a></li>
	        </ul>
	        <div class='panel-container'>
                <div id="tabs-general">
                <?php
                zo_options(array(
                    'id' => 'full_width',
                    'label' => __('Full Width','fptcity'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                ));
                ?>
                </div>
                <div id="tabs-header">
                <?php
                /* header. */
                zo_options(array(
                    'id' => 'header',
                    'label' => __('Header','fptcity'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_enable'))
                ));
                ?>  <div id="page_header_enable"><?php
                zo_options(array(
                    'id' => 'header_layout',
                    'label' => __('Layout','fptcity'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                    )
                ));
				zo_options(array(
					'id' => 'header_logo',
					'label' => __('Logo','fptcity'),
					'type' => 'image'
				));
				?>
				<div id="page_header_logo_menu_canvans">
				<?php
					zo_options(array(
						'id' => 'header_logo_canvans',
						'label' => __('Logo on canvans','fptcity'),
						'type' => 'image'
					));
				?>
				</div>
				<?php
                if($smof_data['menu_transparent']) {
                    zo_options(array(
                        'id' => 'disable_header_transparent',
                        'label' => __('Disable Header Transparent','fptcity'),
                        'type' => 'switch',
                        'options' => array('on'=>'1','off'=>''),
                    ));
                }
                /*
                 * Custom main menu color
                 */
                zo_options(array(
                    'id' => 'enable_header_menu',
                    'label' => __('Custom Header Menu Color','fptcity'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_menu_enable'))
                ));
                ?> <div id="page_header_menu_enable"><?php
                zo_options(array(
                    'id' => 'header_menu_color',
                    'label' => __('Menu Color - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_menu_color_hover',
                    'label' => __('Menu Hover - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_menu_color_active',
                    'label' => __('Menu Active - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                /*
                 * Custom menu color for header fixed
                 */
                zo_options(array(
                    'id' => 'enable_header_fixed',
                    'label' => __('Header Fixed','fptcity'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_fixed_enable'))
                ));
                ?> <div id="page_header_fixed_enable"><?php
                zo_options(array(
                    'id' => 'header_fixed_bg_color',
                    'label' => __('Header Fixed - Background Color','fptcity'),
                    'type' => 'color',
                    'default' => '#fff',
                    'rgba' => true
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color',
                    'label' => __('Header Fixed - Menu Color - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_hover',
                    'label' => __('Header Fixed - Menu Hover Color - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_active',
                    'label' => __('Header Fixed - Menu Active Color - First Level','fptcity'),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                $menus = array();
                $menus[''] = 'Default';
                $obj_menus = wp_get_nav_menus();
                foreach ($obj_menus as $obj_menu){
                    $menus[$obj_menu->term_id] = $obj_menu->name;
                }
                $navs = get_registered_nav_menus();
                foreach ($navs as $key => $mav){
                    zo_options(array(
                    'id' => $key,
                    'label' => $mav,
                    'type' => 'select',
                    'options' => $menus
                    ));
                }
                ?>
                </div>
                </div>
                <div id="tabs-page-title">
                <?php
                /* page title. */
                zo_options(array(
                    'id' => 'page_title',
                    'label' => __('Page Title','fptcity'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_title_enable'))
                ));
                ?>  <div id="page_title_enable"><?php
                zo_options(array(
                    'id' => 'page_title_text',
                    'label' => __('Title','fptcity'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_sub_text',
                    'label' => __('Sub Title','fptcity'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_margin',
                    'label' => __('Page Title Margin','fptcity'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_background',
                    'label' => __('Page Title Background','fptcity'),
                    'type' => 'image',
                ));
                zo_options(array(
                    'id' => 'page_title_type',
                    'label' => __('Layout','fptcity'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                        '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                        '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                        '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                        '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
                    )
                ));
                ?>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
}

new ZOMetaOptions();