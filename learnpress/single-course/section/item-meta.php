<?php
/**
 * Template for displaying item section meta in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/item-meta.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user   = learn_press_get_current_user();
$course = learn_press_get_course( $section->get_course_id() );

$item_id   = $item->get_id();
$course_id = $section->get_course_id();

$item_status = $user->get_item_status( $item_id, $course_id );
?>

<span class="course-item-meta">

	<?php do_action( 'learn-press/course-section-item/before-' . $item->get_item_type() . '-meta', $item ); ?>

	<?php if ( $item->is_preview() ): ?>

		<?php if ( get_post_meta( $course_id, '_lp_required_enroll', true ) == 'yes' ) { ?>
			<span class="lp-label lp-label-preview"><?php esc_html_e( 'Preview', 'ivy-school' ); ?></span>
		<?php } ?>

	<?php else: ?>

		<?php
		if ( $user->can_view_item( $item_id, $course_id ) !== false ) {
			if ( get_post_type( $item_id ) == 'lp_quiz' ) {
				if ( $item_status == 'completed' ) {
					$quiz_result = $user->get_quiz_results( $item_id, $course_id, false );

					if ( $quiz_result['grade'] === 'passed' ) {
						?>
						<span class="lp-icon item-status item-has-status item-status-passed" title="<?php esc_attr_e( 'Passed', 'ivy-school' ); ?>"></span>
					<?php } else {
						?>
						<span class="lp-icon item-status item-has-status item-status-failed" title="<?php esc_attr_e( 'Failed', 'ivy-school' ); ?>"></span>
						<?php
					}
				} elseif ( $item_status == 'started' ) {
					?>
					<span class="lp-label lp-label-in-progress"><?php esc_html_e( 'In Progress', 'ivy-school' ); ?></span>
					<span class="lp-icon item-status item-has-status item-status-viewed"></span>
					<?php
				} elseif ( $item_status == 'viewed' ){
					?>
					<span class="lp-icon item-status item-has-status item-status-viewed" title="<?php esc_attr_e( 'Viewed', 'ivy-school' ); ?>"></span>
					<?php
				} else {
					echo '<span class="lp-icon item-status"></span>';
				}
			} else {
				if ( $item_status == 'completed' ) {
					?>
					<span class="lp-icon item-status item-has-status item-status-completed" title="<?php esc_attr_e( 'Completed', 'ivy-school' ); ?>"></span>
					<?php
				} elseif ( $item_status == 'started' ) {
					?>
					<span class="lp-icon item-status item-has-status item-status-viewed"></span>
					<?php
				} else {
					echo '<span class="lp-icon item-status"></span>';
				}
			}
		}
		?>

	<?php endif; ?>

    <?php $duration = $item->get_duration();?>
    <div class="courses-time"><?php echo esc_html($duration->to_timer( '', true ));?></div>

	<?php do_action( 'learn-press/course-section-item/after-' . $item->get_item_type() . '-meta', $item ); ?>

</span>
