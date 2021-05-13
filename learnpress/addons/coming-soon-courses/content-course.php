<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/coming-soon-courses/content-course.php.
 *
 * @author ThimPress
 * @package LearnPress/Coming-Soon-Courses/Templates
 * @version 3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

$message   = '';
$course    = learn_press_get_course();
$course_id = $course->get_id();
if ( learn_press_is_coming_soon( $course_id ) && '' !== get_post_meta( $course_id, '_lp_coming_soon_msg', true ) ) {
	$message = strip_tags( get_post_meta( $course_id, '_lp_coming_soon_msg', true ) );
}else{
    $message = '';
}
?>

<div id="post-<?php the_ID(); ?>" class="col-md-4">

    <div class="course-item">

        <?php
        // @since 3.0.0
        do_action( 'learn-press/before-courses-loop-item' );
        ?>

        <?php do_action( 'thim-courses-loop-item-thumbnail' );?>

        <div class="content">

            <?php if ( $message ) { ?>
                <div class="learn-press-coming-soon-course-message"> <?php echo esc_html($message); ?></div>
            <?php } ?>

        </div>

    </div>

</div>