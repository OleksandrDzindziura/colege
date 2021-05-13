<?php
/**
 * Template for displaying Purchase button in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/buttons/purchase.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $course ) ) {
	$course = learn_press_get_course();
}
$guest_checkout = ( LP()->checkout()->is_enable_guest_checkout() ) ? 'allow_guest_checkout' : '';
?>

<?php do_action( 'learn-press/before-purchase-form' ); ?>

    <form name="purchase-course" class="purchase-course <?php echo esc_attr( $guest_checkout );?>" method="post" enctype="multipart/form-data">

		<?php do_action( 'learn-press/before-purchase-button' ); ?>

        <input type="hidden" name="purchase-course" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
        <input type="hidden" name="purchase-course-nonce"
               value="<?php echo esc_attr( LP_Nonce_Helper::create_course( 'purchase' ) ); ?>"/>

        <button class="button-purchase-course btn-buy-course btn-normal shape-round">
			<?php echo esc_html( apply_filters( 'learn-press/purchase-course-button-text', esc_html__( 'Buy this course', 'ivy-school' ) ) ); ?>
        </button>
        <input type="hidden" name="redirect_to" value="">

		<?php do_action( 'learn-press/after-purchase-button' ); ?>

    </form>

<?php do_action( 'learn-press/after-purchase-form' ); ?>