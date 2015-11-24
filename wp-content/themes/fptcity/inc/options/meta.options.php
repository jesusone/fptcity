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
        $this->add_meta_box('template_page_options', __('Setting', 'fptcity'), 'page');
        $this->add_meta_box('testimonial_options', __('Testimonial about', 'fptcity'), 'testimonial');
        $this->add_meta_box('pricing_options', __('Pricing Option', 'fptcity'), 'pricing');
        $this->add_meta_box('team_options', __('Team About', 'fptcity'), 'team');
        $this->add_meta_box('portfolio_options', __('Portfolio About', 'fptcity'), 'portfolio');
        $this->add_meta_box('productseting_options', __('Product Tab seting', 'fptcity'), 'product');
        $this->add_meta_box('fptcity_options', __('fptcitys Setting', 'fptcity'), 'fptcity');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_zo_' . $id, $label, array($this, $id), $post_type, $context, $priority);
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
    /* [Start fptcity options] */
    function fptcity_options (){
        ?>
         <div class="tab-container clearfix">
                <ul class='etabs clearfix'>
                    <li class="tab"><a href="#tabs-general-setting"><i class="fa fa-server"></i><?php _e('General', 'fptcity'); ?></a></li>
                   <li class="tab"><a href="#tabs-social-setting"><i class="fa fa-server"></i><?php _e('Social', 'fptcity'); ?></a></li>
                   <li class="tab"><a href="#tabs-investor-setting"><i class="fa fa-server"></i><?php _e('investor', 'fptcity'); ?></a></li>
                </ul>
                <div class='panel-container'>
                    <div id="tabs-general-setting">
                        <?php
                        zo_options(array(
                            'id' => 'company_website',
                            'label' => __('Company Website', 'fptcity'),
                            'type' => 'text',
                            'placeholder' => '',
                        ));
                        zo_options(array(
                            'id' => 'fptcity_location',
                            'label' => __('HQ Location', 'fptcity'),
                            'type' => 'text',
                            'placeholder' => '',
                        ));
                        zo_options(array(
                            'id' => 'fptcity_verticals',
                            'label' => __('Verticals', 'fptcity'),
                            'type' => 'text',
                            'placeholder' => '',
                        )); 
                        zo_options(array(
                            'id' => 'total_disclosed_funding',
                            'label' => __('Total Disclosed Funding', 'fptcity'),
                            'type' => 'text',
                            'placeholder' => '',
                        ));
                        ?>
                    </div>
                    <div id="tabs-social-setting">
                        <?php
                        zo_options(array(
                            'id' => 'socials',
                            'label' => __('Socials of fptcity','fptcity'),
                            'type' => 'social',
                        ));
                        ?>
                    </div>
                    <div id="tabs-investor-setting">
                        <?php
                        zo_options(array(
                            'id' => 'investor_no_funding',
                            'label' => __('No Funding','fptcity'),
                            'type' => 'selectpostype',
                            'postyple' => 'investor'
                        ));
                         zo_options(array(
                            'id' => 'investor_others',
                            'label' => __('Others','fptcity'),
                            'type' => 'selectpostype',
                            'postyple' => 'investor'
                        ));
                        zo_options(array(
                            'id' => 'investor_undisclosed',
                            'label' => __('Undisclosed','fptcity'),
                            'type' => 'selectpostype',
                            'postyple' => 'investor'
                        ));
                        zo_options(array(
                            'id' => 'investor_seed',
                            'label' => __('Seed','fptcity'),
                            'type' => 'selectpostype',
                            'postyple' => 'investor'
                        ));
                        ?>
                    </div>
                </div>
            </div>
     <?php       
    }
    /* [End fptcity options] */
    /* --------------------- RATING TESTIMONIAL ---------------------- */
    function testimonial_options(){
        ?>
        <div class="testimonial-rating">
            <?php
                zo_options(array(
                    'id' => 'testimonial_position',
                    'label' => __('Client Position','fptcity'),
                    'type' => 'text',
                ));
            ?>
        </div>
        <?php
    }
    /* --------------------- PRICING ---------------------- */

    function pricing_options() {
        ?>
        <div class="pricing-option-wrap">
            <table class="wp-list-table widefat fixed">
                <tr>
                    <td>
                        <?php
						zo_options(array(
                            'id' => 'background',
                            'label' => __('Background Title','fptcity'),
                            'type' => 'image',
                        ));
						zo_options(array(
                            'id' => 'subtitle',
                            'label' => __('Sub Title','fptcity'),
                            'type' => 'text',
                        ));
                        zo_options(array(
                            'id' => 'price',
                            'label' => __('Price','fptcity'),
                            'type' => 'text',
                        ));
						
						zo_options(array(
                            'id' => 'hot',
                            'label' => __('Hot','fptcity'),
                            'type' => 'switch',
                            'options' => array('on'=>'1','off'=>''),
                        ));

                        zo_options(array(
                            'id' => 'value',
                            'label' => __('Value','fptcity'),
                            'type' => 'select',
                            'options' => array(
                                'Monthly' => 'Monthly',
                                'Year' => 'Year'
                            )
                        ));

                        zo_options(array(
                            'id' => 'icon_font',
                            'label' => __('Icon Font','fptcity'),
                            'type' => 'icon'
                        ));

                        zo_options(array(
                            'id' => 'icon_image',
                            'label' => __('Icon Image','fptcity'),
                            'type' => 'image'
                        ));

                        zo_options(array(
                            'id' => 'button_url',
                            'label' => __('Button Url','fptcity'),
                            'type' => 'text',
                        ));

                        zo_options(array(
                            'id' => 'button_text',
                            'label' => __('Button Text','fptcity'),
                            'type' => 'text',
                        ));

                        zo_options(array(
                            'id' => 'is_feature',
                            'label' => __('Is feature','fptcity'),
                            'type' => 'switch',
                            'options' => array('on'=>'1','off'=>''),
                        )); ?>
                    </td>
                    <td>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option1',
                                'label' => __('Option 1','fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option1_feature',
                                'label' => __('Option 1 Feature','fptcity'),
                                'type' => 'switch',
                                'options' => array('on'=>'1','off'=>''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option2',
                                'label' => __('Option 2', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option2_feature',
                                'label' => __('Option 2 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option3',
                                'label' => __('Option 3', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option3_feature',
                                'label' => __('Option 3 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option4',
                                'label' => __('Option 4', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option4_feature',
                                'label' => __('Option 4 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option5',
                                'label' => __('Option 5', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option5_feature',
                                'label' => __('Option 5 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option6',
                                'label' => __('Option 6', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option6_feature',
                                'label' => __('Option 6 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option7',
                                'label' => __('Option 7', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option7_feature',
                                'label' => __('Option 7 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option8',
                                'label' => __('Option 8', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option8_feature',
                                'label' => __('Option 8 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option9',
                                'label' => __('Option 9', 'fptcity'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option9_feature',
                                'label' => __('Option 9 Feature', 'fptcity'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
    /* --------------------- PRICING ---------------------- */

    /*-----------------------TEAM-------------------------*/
    function team_options() {
        ?>

            <div class="tab-container clearfix">
                <ul class='etabs clearfix'>
                    <li class="tab"><a href="#tabs-position"><i class="fa fa-server"></i><?php _e('Position', 'fptcity'); ?></a></li>
                   <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', 'fptcity'); ?></a></li>
                </ul>
                <div class='panel-container'>
                    <div id="tabs-position">
                        <?php
                        zo_options(array(
                            'id' => 'team_position',
                            'label' => __('Position', 'fptcity'),
                            'type' => 'text',
                            'placeholder' => '',
                        ));
                        ?>
                    </div>
                    <div id="tabs-general">
                        <?php
                        zo_options(array(
                            'id' => 'socials',
                            'label' => __('Socials of team','fptcity'),
                            'type' => 'social',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
    /*-----------------------Portfolio-------------------------*/
    function portfolio_options() {
        ?>
        <div class="tab-container clearfix">
            <ul class='etabs clearfix'>
                <li class="tab"><a href="#tabs-about"><i class="fa fa-server"></i><?php _e('About', 'fptcity'); ?></a></li>
                <li class="tab"><a href="#tabs-layout"><i class="fa fa-server"></i><?php _e('Layout', 'fptcity'); ?></a></li>
            </ul>
            <div class='panel-container'>
                <div id="tabs-about">
                    <?php
                    zo_options(array(
                        'id' => 'portfolio_client',
                        'label' => __('Client', 'fptcity'),
                        'type' => 'text',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_date',
                        'label' => __('Date', 'fptcity'),
                        'type' => 'date',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_skills',
                        'label' => __('Skills', 'fptcity'),
                        'type' => 'text',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_url',
                        'label' => __('URL', 'fptcity'),
                        'type' => 'text',
                        'value' => '#',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_images',
                        'label' => __('Gallery', 'fptcity'),
                        'type' => 'images',
                    ));
                    ?>
                </div>
                <div id="tabs-layout">
                    <?php
                    zo_options(array(
                        'id' => 'portfolio_layout',
                        'label' => __('Layout', 'fptcity'),
                        'type' => 'select',
                        'options' => array(
                            '' => 'Default',
                            'gallery' => 'Gallery'
                        )
                    ));
                    ?>
                </div>
            </div>
        </div>


        <?php
    }
    /*-----------------------Product-------------------------*/
    function productseting_options(){
       ?>
        <div class="tab-container clearfix">
            <ul class='etabs clearfix'>
                <li class="tab"><a href="#tabs-product-tab"><i class="fa fa-server"></i><?php _e('Tab seting', 'fptcity'); ?></a></li>
            </ul>
            <div class='panel-container'>
                <div id="tabs-product-tab">
                    <?php
                    zo_options(array(
                        'id' => 'showtab_detault',
                        'label' => __('Show Tab Detail', 'fptcity'),
                        'type' => 'switch',
                        'options' => array('on' => '1', 'off' => ''),
                        'follow' => array('1'=>array('#changenamedetail'))
                    )); ?>
                    <div id="changenamedetail">
                       <?php
                        zo_options(array(
                            'id' => 'changenamedetail',
                            'label' => __('Name tab', 'fptcity'),
                            'type' => 'text',
                            'value' => '#',
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