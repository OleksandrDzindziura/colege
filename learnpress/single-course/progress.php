<?php
/**
 * Template for displaying progress of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
$user   = LP_Global::user();

if ( ! $course || ! $user ) {
	return;
}

// get course id
$course_id = $course->get_id();

if ( ! $user->has_enrolled_course( $course_id ) ) {
	return;
}

// user course data
$course_data       = $user->get_course_data( $course_id );
$course_results    = $course_data->get_results( false );
$passing_condition = $course->get_passing_condition();
$result            = round( $course_results['result'], 2 );
$grade             = $course_results['grade'];

$completed_items = $course_results['completed_items'];
$course_items    = $course->count_items('', true);
?>

<div class="learn-press-course-results-progress">

    <div class="items-progress">
        <div class="lp-course-status">
			<?php if ( $grade ) { ?>
                <span class="lp-grade <?php echo esc_attr( $grade ); ?>"> <?php learn_press_course_grade_html( $grade ); ?> </span>
			<?php } ?>
            (<span class="number"><?php printf( esc_html__( '%d of %d items', 'ivy-school' ), $completed_items, $course_items ); ?></span>
            <span class="extra-text"><?php esc_html_e( ' completed', 'ivy-school' ) ?></span>)
        </div>
    </div>

    <div class="course-progress">
        <div class="lp-course-status">
            <span class="number"><?php echo esc_html($result); ?><span class="percentage-sign">%</span></span>
			<?php if ( $grade ) { ?>
                <span class="grade <?php echo esc_attr( $grade ); ?>">
				<?php learn_press_course_grade_html( $grade ); ?>
				</span>
			<?php } ?>
        </div>

        <div class="lp-course-progress <?php echo esc_attr( $course_data->is_passed() ? ' passed' : '' ); ?>"
             data-value="<?php echo esc_attr( $result ); ?>"
             data-passing-condition="<?php echo esc_attr( $passing_condition ); ?>">
            <div class="lp-progress-bar progress-bg">
                <div class="lp-progress-value progress-active" style="left: <?php echo esc_attr( $result ); ?>%;"></div>
            </div>
            <div class="lp-passing-conditional"
                 data-content="<?php printf( esc_html__( 'Passing condition: %s%%', 'ivy-school' ), $passing_condition ); ?>"
                 style="left: <?php echo esc_attr( $passing_condition ); ?>%;">
            </div>
        </div>
    </div>
</div>