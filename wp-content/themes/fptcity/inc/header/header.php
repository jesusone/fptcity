<?php
/**
 * @name : Default
 * @package : ZoTheme
 * @author : Fox
 */
?>
<?php global $smof_data, $zo_meta; ?>
<?php if ($smof_data['enable_header_top'] == '1'): ?>
    <!-- insert layout header top -->
    <div id="zo-header-top">
    <div class="container">
        <div class="row">
            <div
                class="zo-header-logo col-xs-4 col-sm-4 col-md-4 col-lg-4"> <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="" src="<?php echo esc_url(zo_page_header_logo()); ?>"></a></div>
            <div class="zo-header-icon col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <?php if (is_active_sidebar('sidebar-2')) : ?>
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div id="zo-header" class="zo-main-header header-default <?php
if (!$smof_data['menu_sticky']) {
    echo 'no-sticky';
}
?> <?php
if ($smof_data['menu_sticky_tablets']) {
    echo 'sticky-tablets';
}
?> <?php
if ($smof_data['menu_sticky_mobile']) {
    echo 'sticky-mobile';
}
?> <?php
if (!empty($zo_meta->_zo_enable_header_fixed)) {
    echo 'header-fixed-page';
}
?> <?php
if (!empty($zo_meta->_zo_enable_header_menu)) {
    echo 'header-menu-custom';
}
?> <?php
if ($smof_data['menu_transparent']) {
    echo 'header-transparent';
}
?> <?php
if (!empty($zo_meta->_zo_disable_header_transparent)) {
    echo 'header-transparent-disable';
}
?>">
    <div class="no-container zo-header-menu ">
    <div class="container">
        <div class="row">
            <?php if (is_active_sidebar('header-right')): ?>
                <div id="zo-header-navigation" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php else : ?>
                    <div id="zo-header-navigation" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php endif; ?>
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        $attr = array(
                            'menu' => zo_menu_location(),
                            'menu_class' => 'nav-menu menu-main-menu',
                        );

                        $menu_locations = get_nav_menu_locations();

                        if (!empty($menu_locations['primary'])) {
                            $attr['theme_location'] = 'primary';
                        }

                        /* enable mega menu. */
                        if (class_exists('HeroMenuWalker')) {
                            $attr['walker'] = new HeroMenuWalker();
                        }

                        /* main nav. */
                        wp_nav_menu($attr);
                        ?>
                    </nav>
                </div>
                <?php if (is_active_sidebar('header-right')): ?>
                    <div id="zo-header-right" class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                        <?php dynamic_sidebar('header-right'); ?>
                    </div>
                <?php endif; ?>
                <div id="zo-menu-mobile" class="collapse navbar-collapse"><i class="pe-7s-menu"></i></div>
            </div>
        </div>
        <!-- #site-navigation -->
    </div>
    </div>
    <!--#zo-header-->
