<?php
/**
 * Template for displaying user profile content.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/content.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $user ) ) {
	$user = learn_press_get_current_user();
}

$profile = learn_press_get_profile();
$tabs    = $profile->get_tabs();
$current = $profile->get_current_tab();

$user = $profile->get_user();
$user_meta = get_user_meta( $profile->get_user_data( 'id' ) );
$user_meta = array_map( 'thim_get_user_meta', $user_meta );
$lp_info = get_the_author_meta( 'lp_info', $profile->get_user_data( 'id' ) );
?>
<div id="learn-press-profile-content" class="lp-profile-content ">

	<?php foreach ( $tabs as $tab_key => $tab_data ) {

		if ( ! $profile->tab_is_visible_for_user( $tab_key ) ) {
			continue;
		}
		?>

		<div id="profile-content-<?php echo esc_attr( $tab_key ); ?>">
			<?php
			// show profile sections
			do_action( 'learn-press/before-profile-content', $tab_key, $tab_data, $user ); ?>

			<?php if ( empty( $tab_data['sections'] ) ) {
				if ( is_callable( $tab_data['callback'] ) ) {
					echo call_user_func_array( $tab_data['callback'], array( $tab_key, $tab_data, $profile ) );
				} else {
					do_action( 'learn-press/profile-content', $tab_key, $tab_data, $user );
				}
			} else {
				if ( 'settings' == $tab_key ) {
					?>

					<form method="post" name="lp-edit-profile" class="learnpress-v3-profile">
						<?php
						foreach ( $tab_data['sections'] as $key => $section ) {
							$location = learn_press_locate_template( 'profile/tabs/settings/' . $key . '.php' );

							echo '<div class="lp-profile-section ' . $key . '">';
							if ( file_exists( $location ) ) {
								include $location;
							}
							echo '<input type="hidden" name="lp-profile-section" value=' . $key . ' />';
							echo '</div>';
						}
						?>

						<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $user->get_id() ); ?>" />
						<input type="hidden" name="profile-nonce"
						       value="<?php echo esc_attr( wp_create_nonce( 'learn-press-update-user-profile-' . $user->get_id() ) ); ?>" />
						<div class="submit update-profile">
							<button type="submit" name="submit" id="submit"
							        class="button button-primary"><?php esc_html_e( 'Update', 'ivy-school' ); ?>
								<div class="sk-three-bounce hidden">
									<div class="sk-child sk-bounce1"></div>
									<div class="sk-child sk-bounce2"></div>
									<div class="sk-child sk-bounce3"></div>
								</div>
							</button>
						</div>
					</form>

					<?php
				} else {
					foreach ( $tab_data['sections'] as $key => $section ) {
						if ( $profile->get_current_section( '', false, false ) === $section['slug'] ) {
							if ( is_callable( $tab_data['callback'] ) ) {
								echo call_user_func_array( $section['callback'], array( $key, $section, $user ) );
							} else {
								do_action( 'learn-press/profile-section-content', $key, $section, $user );
							}
						}
					}
				}

			} ?>

			<?php do_action( 'learn-press/after-profile-content' ); ?>
		</div>

	<?php } ?>

</div>

