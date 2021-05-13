<?php
/**
 * Template for displaying complete button in content lesson.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-lesson/button-complete.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.2
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $course ) || ! isset( $item ) ||
	! isset( $security ) || ! isset( $completed ) ) {
	return;
}
?>

<form method="post" name="learn-press-form-complete-lesson"
      data-confirm="<?php ! $completed ? LP_Strings::esc_attr_e( 'confirm-complete-lesson', 'ivy-school', array( $item->get_title() ) ) : ''; ?>"
      class="learn-press-form form-button<?php echo esc_attr( $completed ? ' completed' : '' ); ?>">

	<?php do_action( 'learn-press/lesson/before-complete-button' ); ?>

	<?php if ( $completed ) { ?>

        <p><i class="fa fa-check"></i> <?php echo esc_html__( 'Completed', 'ivy-school' ); ?></p>

	<?php } else { ?>

        <input type="hidden" name="id" value="<?php echo esc_attr($item->get_id()); ?>"/>
        <input type="hidden" name="course_id" value="<?php echo esc_attr($course->get_id()); ?>"/>
        <input type="hidden" name="complete-lesson-nonce" value="<?php echo esc_attr( $security ); ?>"/>
        <input type="hidden" name="type" value="lp_lesson"/>
        <input type="hidden" name="lp-ajax" value="complete-lesson"/>
        <input type="hidden" name="noajax" value="yes"/>
        <button class="btn-normal shape-round btn-primary button-complete-item button-complete-lesson"><?php echo esc_html__( 'Complete', 'ivy-school' ); ?></button>

	<?php } ?>

	<?php do_action( 'learn-press/lesson/after-complete-button' ); ?>

</form>
