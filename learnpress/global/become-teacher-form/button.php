<?php
/**
 * Template for displaying submit button of become teacher form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/become-teacher-form/button.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$user = learn_press_get_current_user( false );
?>

<button <?php if( ! $user || $user instanceof LP_User_Guest || learn_press_become_teacher_sent() ) ;?> type="submit" data-text="<?php esc_attr_e( 'Get the learning program', 'ivy-school' ); ?>"><?php echo esc_html__( 'Get the learning program', 'ivy-school' ); ?></button>