<?php
/**
 * Template for displaying layout 1 content of landing course.
 *
 * @author  ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<div class="row">
    <div class="col-lg-9 col-xl-9 col-md-12">
        <div class="course-summary wrap-content-single-course">
            <div class="landing-1">

                <?php learn_press_get_template( 'single-course/course-title.php' ); ?>

                <?php learn_press_get_template( 'single-course/course-info.php' ); ?>

                <?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>

                <div class="course-landing-summary">

                    <div class="content-landing-1">
                        <?php do_action( 'learn-press/content-landing' ); ?>
                       
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xl-3 col-md-12 sticky-sidebar">
        <?php do_action( 'thim-info-bar-position' );?>
    </div>
</div>

