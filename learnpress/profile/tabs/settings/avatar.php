<?php
/**
 * Template for displaying user avatar editor for changing avatar in user profile.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/avatar.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile      = LP_Profile::instance();
$user         = $profile->get_user();
$custom_img   = $user->get_upload_profile_src();
$gravatar_img = $user->get_profile_picture( 'gravatar', 500 );
$thumb_size   = learn_press_get_avatar_thumb_size();

?>
<div class="section-wrap">
	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-profile-avatar-fields', $profile );
	?>

	<div id="lp-user-edit-avatar" class="lp-edit-profile lp-edit-avatar">
		<div class="lp-form-field-wrap">
			<div class="lp-form-field">
				<label class="lp-form-field-label"><?php esc_html_e( 'Avatar', 'ivy-school' ); ?></label>
				<div class="lp-form-field-input lp-form-field-avatar">
					<div class="lp-avatar-preview"
					     style="width: <?php echo esc_html($thumb_size['width']); ?>px;height: <?php echo esc_html($thumb_size['height']); ?>px;">
						<div class="profile-picture profile-avatar-current">
							<?php if ( $custom_img ) { ?>
								<img src="<?php echo esc_url($custom_img); ?>" />
							<?php } else { ?>
								<?php echo ent2ncr($gravatar_img); ?>
							<?php } ?>
						</div>
						<?php if ( $custom_img ) { ?>
							<div class="profile-picture profile-avatar-hidden">
								<?php echo ent2ncr($gravatar_img); ?>
							</div>
						<?php } ?>

						<div class="lp-avatar-upload-progress">
							<div class="lp-avatar-upload-progress-value"></div>
						</div>

						<div class="lp-avatar-upload-error">
						</div>

						<div id="lp-avatar-actions">
							<button id="lp-upload-photo">
								<i class="fa fa-camera" aria-hidden="true" title="<?php esc_attr_e( 'Upload', 'ivy-school' ) ?>"></i>
							</button>
							<?php if ( $custom_img != '' ): ?>
								<button id="lp-remove-upload-photo" title="<?php esc_attr_e( 'Remove', 'ivy-school' ) ?>">
									<i class="fa fa-times" aria-hidden="true"></i></button>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-profile-avatar-fields', $profile );
	?>

	<p>
		<input type="hidden" name="save-profile-avatar"
		       value="<?php echo wp_create_nonce( 'learn-press-save-profile-avatar' ); ?>">
	</p>

	<script type="text/html" id="tmpl-crop-user-avatar">
		<div class="lp-avatar-crop-image" style="width: {{data.viewWidth}}px; height: {{data.viewHeight}}px;">
			<img src="{{data.url}}?r={{data.r}}" />
			<div class="lp-crop-controls">
				<div class="lp-zoom">
					<div></div>
				</div>
				<a href="" class="lp-cancel-upload dashicons dashicons-no-alt"></a>
			</div>
			<input type="hidden" name="lp-user-avatar-crop[name]" data-name="name" value="{{data.name}}" />
			<input type="hidden" name="lp-user-avatar-crop[width]" data-name="width" value="" />
			<input type="hidden" name="lp-user-avatar-crop[height]" data-name="height" value="" />
			<input type="hidden" name="lp-user-avatar-crop[points]" data-name="points" value="" />
			<input type="hidden" name="lp-user-avatar-custom" value="yes" />
		</div>
	</script>
</div>