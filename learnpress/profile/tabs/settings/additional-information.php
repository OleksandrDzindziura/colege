<?php
/**
 * Form for display additional info user in profile page
 *
 * @author  ThimPress
 * @version 2.1.1
 */

defined( 'ABSPATH' ) || exit;

$phone = ! empty( $lp_info['phone'] ) ? $lp_info['phone'] : '';
$skype = ! empty( $lp_info['skype'] ) ? $lp_info['skype'] : '';
$gg    = ! empty( $lp_info['google'] ) ? $lp_info['google'] : '';
$fb    = ! empty( $lp_info['facebook'] ) ? $lp_info['facebook'] : '';
$tt    = ! empty( $lp_info['twitter'] ) ? $lp_info['twitter'] : '';
$in    = ! empty( $lp_info['linkedin'] ) ? $lp_info['linkedin'] : '';
?>

<div class="section-wrap">
    <ul class="lp-form-field-wrap additional-information">
        <li class="lp-form-field">
            <label class="lp-form-field-label"
                   for="lp_info_phone"><?php esc_html_e( 'Phone Number', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[phone]" id="lp_info_phone" value="<?php echo esc_attr( $phone ); ?>"
                       class="regular-text">
                <label class="icon" for="lp_info_phone">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label" for="email"><?php esc_html_e( 'Email', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="email" id="email" value="<?php echo esc_attr( $user->get_email() ); ?>"
                       class="regular-text" disabled>
                <label class="icon" for="email">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </label>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label" for="lp_info_skype"><?php esc_html_e( 'Skype', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[skype]" id="lp_info_skype" value="<?php echo esc_attr( $skype ); ?>"
                       class="regular-text">
                <label class="icon" for="lp_info_skype">
                    <i class="fa fa-skype" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label"
                   for="lp_info_google_plus"><?php esc_html_e( 'Google Plus URL', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[google]" id="lp_info_google_plus"
                       value="<?php echo esc_attr( $gg ); ?>" class="regular-text">
                <label class="icon" for="lp_info_google_plus">
                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label"
                   for="lp_info_facebook"><?php esc_html_e( 'Facebook URL', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[facebook]" id="lp_info_facebook" value="<?php echo esc_attr( $fb ); ?>"
                       class="regular-text">
                <label class="icon" for="lp_info_facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label"
                   for="lp_info_twitter"><?php esc_html_e( 'Twitter URL', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[twitter]" id="lp_info_twitter" value="<?php echo esc_attr( $tt ); ?>"
                       class="regular-text">
                <label class="icon" for="lp_info_twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>

        <li class="lp-form-field">
            <label class="lp-form-field-label"
                   for="lp_info_linkedin"><?php esc_html_e( 'Linkedin URL', 'ivy-school' ); ?></label>
            <div class="lp-form-field-input">
                <input type="text" name="lp_info[linkedin]" id="lp_info_linkedin" value="<?php echo esc_attr( $in ); ?>"enu
                       class="regular-text">
                <label class="icon" for="lp_info_linkedin">
                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                </label>
                <span class="clear-field"><?php esc_html_e( 'Remove', 'ivy-school' ) ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="save-profile-addition-information-nonce"
           value="<?php echo wp_create_nonce( 'save-profile-addition-information' ); ?>">
</div>
