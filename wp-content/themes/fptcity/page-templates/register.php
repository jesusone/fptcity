<?php
/**
 * Template Name: Register
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
                          <?php do_action('process_customer_registration_form'); ?>
                        <form id="gform-2" action="" enctype="multipart/form-data" method="post" class="form-register">
                            <ul>
                                <li>
                                    <label class="gfield-label"><?php _e('Name:'); ?> <span class="gfield-required">*</span></label>
                                    <div id="name" class="name">
                                        <span class="name-first">
                                            <input id="fist" type="text" value="<?php echo isset($_POST['fist']) ? esc_attr($_POST['fist']) : null; ?>" name="fist">
                                            <label class="gfield-description"><?php _e('First:'); ?></label>
                                        </span>
                                        <span class="name-last">
                                            <input id="last" type="text" value="<?php echo isset($_POST['last']) ? esc_attr($_POST['last']) : null; ?>" name="last">
                                            <label class="gfield-description"><?php _e('Last:'); ?></label>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label"><?php _e(' Company Name:'); ?><span class="gfield-required">*</span></label>
                                    <div id="company-name" class="company-name">
                                        <input id="company" class="medium" type="text"  value="<?php echo isset($_POST['company']) ? esc_attr($_POST['company']) : null; ?>" name="company">
                                    </div>
                                    <div class="gfield-description"><?php _e('The name of the company you would like in your custom recording.'); ?></div>
                                </li>
                                <li>
                                    <label class="gfield-label" for="address"> <?php _e('Address:'); ?> <span class="gfield-required">*</span></label>
                                    <div id="stress-address"  class="address">
                                        <span id="stress-address">
                                            <input id="stress-address" type="text" tabindex="7" value="<?php echo isset($_POST['stress-address']) ? esc_attr($_POST['stress-address']) : null; ?>" name="stress-address">
                                            <label id="stress-address-label" for="stress-address" class="gfield-description"><?php _e('Street Address'); ?></label>
                                        </span>
                                        <span id="address-line-2">
                                            <input id="address-line-2" type="text" tabindex="8" value="<?php echo isset($_POST['address-line-2']) ? esc_attr($_POST['address-line-2']) : null; ?>" name="address-line-2">
                                            <label id="address-line-2-label" for="address-line-2" class="gfield-description"><?php _e('Address Line 2'); ?></label>
                                        </span>
                                        <span class="input-left">
                                            <input id="city" type="text" tabindex="9" value="<?php echo isset($_POST['city']) ? esc_attr($_POST['city']) : null; ?>" name="city">
                                            <label id="city-label" for="city"><?php _e('City:'); ?></label>
                                        </span>
                                        <span class="input-right">
                                            <input id="state" type="text" tabindex="11" value="<?php echo isset($_POST['state']) ? esc_attr($_POST['state']) : null; ?>" name="state">
                                            <label id="state-label" for="state" class="gfield-description"><?php _e('State / Province / Region'); ?></label>
                                        </span>
                                        <span class="input-left">
                                            <input id="zip" type="text" tabindex="12" value="<?php echo isset($_POST['zip']) ? esc_attr($_POST['zip']) : null; ?>" name="zip">
                                            <label id="zip-label" for="zip" class="gfield-description"><?php _e('ZIP / Postal Code'); ?></label>
                                        </span>
                                        <span id="country" class="input-right">
                                            <select id="country" tabindex="13" name="country"></select>
                                            <label id="country-label" for="country" class="gfield-description"><?php _e('Country'); ?></label>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label" for="address"> <?php _e('Address:'); ?> <span class="gfield-required">*</span></label>
                                    <div id="stress-address"  class="address">
                                        <span id="stress-address">
                                            <input id="stress-address" type="text" tabindex="7" value=<?php echo isset($_POST['stress-address']) ? esc_attr($_POST['stress-address']) : null; ?>"" name="stress-address">
                                            <label id="stress-address-label" for="stress-address" class="gfield-description"><?php _e('Address Street:'); ?></label>
                                        </span>
                                        <span id="address-line-2">
                                            <input id="address-line-2" type="text" tabindex="8" value="<?php echo isset($_POST['address-line-2']) ? esc_attr($_POST['address-line-2']) : null; ?>" name="address-line-2">
                                            <label id="address-line-2-label" for="address-line-2" class="gfield-description"><?php _e('Address Line 2:'); ?></label>
                                        </span>
                                        <span class="input-left">
                                            <input id="city" type="text" tabindex="9" value="<?php echo isset($_POST['city']) ? esc_attr($_POST['city']) : null; ?>" name="city">
                                            <label id="city-label" for="city"><?php _e('City:'); ?></label>
                                        </span>
                                        <span class="input-right">
                                            <input id="state" type="text" tabindex="11" value="<?php echo isset($_POST['state']) ? esc_attr($_POST['state']) : null; ?>" name="state">
                                            <label id="state-label" for="state" class="gfield-description"><?php _e('State / Province / Region:'); ?></label>
                                        </span>
                                        <span class="input-left">
                                            <input id="zip" type="text" tabindex="12" value="<?php echo isset($_POST['zip']) ? esc_attr($_POST['zip']) : null; ?>" name="zip">
                                            <label id="zip-label" for="zip" class="gfield-description"><?php _e('ZIP / Postal Code:'); ?></label>
                                        </span>
                                        <span id="country" class="input-right">
                                            <select id="country" tabindex="13" name="country"></select>
                                            <label id="country-label" for="country" class="gfield-description"><?php _e('Country:'); ?></label>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label"><?php _e('Phone:'); ?> <span class="gfield-required">*</span></label>
                                    <div id="phone" class="phone">
                                        <input id="phone" class="medium" type="text"  value="<?php echo isset($_POST['website']) ? esc_attr($_POST['website']) : null; ?>" name="website">
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label"><?php _e('Email:'); ?> <span class="gfield-required">*</span></label>
                                    <div id="email" class="email">
                                        <span class="enter-email">
                                            <input type="text" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : null; ?>" name="enter-email">
                                            <label class="gfield-description"><?php _e('Enter email'); ?></label>
                                        </span>
                                        <span class="confirm-email">
                                            <input type="text" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : null; ?>" name="confirm-email">
                                            <label class="gfield-description"><?php _e('Confirm email'); ?></label>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label"><?php _e('Website:'); ?></label>
                                    <div id="website" class="website">
                                        <input id="website" class="medium" type="text"  value="<?php echo isset($_POST['website']) ? esc_attr($_POST['website']) : null; ?>" name="website">
                                    </div>
                                </li>
                                <li>
                                    <label class="gfield-label"><?php _e('Date of Purchase:'); ?></label>
                                    <div id="date-of-purchase" class="date-of-purchase">
                                        <input id="date-of-purchase" class="medium" type="text"  value="<?php echo isset($_POST['date-of-purchase']) ? esc_attr($_POST['date-of-purchase']) : null; ?>" name="date-of-purchase">
                                    </div>
                                </li>
                            </ul>
                            <div class="form-submit">
                                <input name="register" type="submit" id="register" class="button-primary" value="<?php _e('Submit'); ?>" />
                                <?php wp_nonce_field('register-user', 'add-nonce') ?>
                                <input name="action" type="hidden" id="action" value="register" />
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>
<?php
get_footer();

