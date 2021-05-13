<?php
/**
 * Template for displaying content of learning course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/content-learning.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
// add nofication when duration blocked
$user        = learn_press_get_current_user();
$course      = learn_press_get_the_course();
if($user->user_check_blocked_duration( $course->get_id() ) == true && $user->can_retake_course($course->get_id()) >=0 && ! $user->get_course_data( $course->get_id() )->is_finished() ){
    echo '<div class="lp-nofication__duration">';
    echo '<p style="color:red">'.esc_html__('The course duration has run out. You cannot access the content of this course anymore.','learnpress').'</p>';
    echo '</div>';
}
?>


<div class="header-course">
    <div class="header-content">
        <div class="row">
            <?php
                if(has_post_thumbnail()) {
                    ?>
                    <div class="col-md-6">
                        <?php learn_press_get_template('single-course/thumbnail.php'); ?>
                    </div>
                    <div class="col-md-6">
                        <div class="header-info">
                            <h1 class="course-title"><?php the_title(); ?></h1>
                            <?php if (get_the_excerpt()) { ?>
                                <p class="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 35); ?>
                                </p>
                            <?php } ?>
                        </div>

                        <?php learn_press_get_template('single-course/progress.php');
                        // get course bbpress forum
                        $forum_id = get_post_meta($course->get_id(), '_lp_course_forum', true);
                        if ($forum_id && class_exists('LP_Addon_bbPress') && class_exists('bbPress')) { ?>
                            <div class="forum-section">
                                <span class="label"><?php esc_html_e('Visit Forum: ', 'ivy-school'); ?></span>
                                <?php LP_Addon_bbPress::instance()->forum_link(); ?>
                            </div>
                        <?php } ?>
                        <?php do_action('learn-press/course-buttons'); ?>
                    </div>
                    <?php
                }else {
                    ?>
                    <div class="col-md-12">
                        <div class="header-info">
                            <h1 class="course-title text-center"><?php the_title(); ?></h1>
                            <?php if (get_the_excerpt()) { ?>
                                <p class="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 35); ?>
                                </p>
                            <?php } ?>
                        </div>

                        <?php learn_press_get_template('single-course/progress.php');
                        // get course bbpress forum
                        $forum_id = get_post_meta($course->get_id(), '_lp_course_forum', true);
                        if ($forum_id && class_exists('LP_Addon_bbPress') && class_exists('bbPress')) { ?>
                            <div class="forum-section">
                                <span class="label"><?php esc_html_e('Visit Forum: ', 'ivy-school'); ?></span>
                                <?php LP_Addon_bbPress::instance()->forum_link(); ?>
                            </div>
                        <?php } ?>
                        <?php do_action('learn-press/course-buttons'); ?>
                    </div>

                    <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="course-learning-summary">
	<?php do_action( 'learn-press/content-learning-summary' ); ?>
</div>
