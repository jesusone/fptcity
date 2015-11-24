<?php
/**
 * Template Name: Cart
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 * @author Fox
 */
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit();
}
get_header();
global $smof_data, $wpdb;
?>

<div id="page-default" class="<?php zo_main_class(); ?>">
    <div class="row">
        <div id="primary" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="content" role="main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('single-templates/content', 'page'); ?>
                    <?php comments_template('', true); ?>
                <?php endwhile; // end of the loop. ?>
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      
                    </div>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>
<?php
get_footer();

