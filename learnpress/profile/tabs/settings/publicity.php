<?php
/**
 * Template for displaying change password form in profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/change-password.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>
<div class="section-wrap">
	<!--Layout for checkbox button-->
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
		<symbol id="checkmark" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-miterlimit="10" fill="none" d="M22.9 3.7l-15.2 16.6-6.6-7.1">
			</path>
		</symbol>
	</svg>
	<!--End layout for checkbox button-->
	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-profile-publicity-fields', $profile ); ?>

	<div class="lp-form-field-wrap">

		<?php
		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/begin-profile-publicity-fields', $profile );
		?>
		<div class="promoted-checkbox">
			<input id="my-dashboard" type="checkbox" class="svg-input-checkbox" name="_lp_profile_publicity[my-dashboard]"
			       value="yes" <?php checked( $profile->get_publicity( 'my-dashboard' ), 'yes' ); ?>/>
			<label for="my-dashboard">
				<svg>
					<use xlink:href="#checkmark" />
				</svg>
				<?php esc_html_e( 'Public your profile dashboard', 'ivy-school' ); ?>
			</label>
		</div>

		<?php if ( LP()->settings()->get( 'profile_publicity.courses' ) === 'yes' ) { ?>
			<div class="promoted-checkbox">
				<input type="checkbox" class="svg-input-checkbox" name="_lp_profile_publicity[courses]" value="yes"
				       id="my-courses" <?php checked( $profile->get_publicity( 'courses' ), 'yes' ); ?>/>
				<label for="my-courses">
					<svg>
						<use xlink:href="#checkmark" />
					</svg>
					<?php esc_html_e( 'Public your profile courses', 'ivy-school' ); ?>
				</label>
			</div>
		<?php } ?>

		<?php if ( LP()->settings()->get( 'profile_publicity.quizzes' ) === 'yes' ) { ?>
			<div class="promoted-checkbox">
				<input name="_lp_profile_publicity[quizzes]" class="svg-input-checkbox" value="yes" type="checkbox"
				       id="my-quizzes" <?php checked( $profile->get_publicity( 'quizzes' ), 'yes' ); ?>/>
				<label for="my-quizzes">
					<svg>
						<use xlink:href="#checkmark" />
					</svg>
					<?php esc_html_e( 'Public your profile quizzes', 'ivy-school' ); ?>
				</label>
			</div>
		<?php } ?>

		<?php
		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/end-profile-publicity-fields', $profile );

		?>

	</div>

	<input type="hidden" name="save-profile-publicity"
	       value="<?php echo wp_create_nonce( 'learn-press-save-profile-publicity' ); ?>" />
	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-profile-publicity-fields', $profile );
	?>
</div>