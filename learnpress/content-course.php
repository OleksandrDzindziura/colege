<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$user = LP_Global::user();
$i=0;
?>
<?php
    global $layout_courses;
    $layout_courses = get_theme_mod('layout_courses','default_courses');
    // learpress
    $course = LP_Global::course();
?>

<div id="post-<?php the_ID(); ?>" class="col-md-4 wrapper-item-course">
    <?php
        if($layout_courses === "left_courses"){
    ?>
           <div class="item-course color-2">
               <?php
                   // @since 3.0.0
                   do_action('learn-press/before-courses-loop-item');
               ?>
               <div class="pic">
                   <?php do_action('thim-courses-loop-item-thumbnail'); ?>
                   <div class="price<?php if($course->is_free()) echo ' free';?>">
                       <?php echo esc_html($course->get_price_html()); ?>
                       <?php if ( $course->has_sale_price() ) { ?>
                           <span class="old-price"> <?php echo esc_html($course->get_origin_price_html()); ?></span>
                       <?php } ?>
                   </div>
               </div>
               <div class="text">
                   <div class="teacher">
                       <div class="ava">
                           <?php echo ent2ncr($course->get_instructor()->get_profile_picture( '', 68 )); ?>
                       </div>
                       <?php echo ent2ncr($course->get_instructor_html()); ?>
                    </div>
                   <h3 class="title-course">
                       <a href="<?php the_permalink(); ?>">
                           <?php the_title(); ?>
                       </a>
                   </h3>
                   <?php do_action('thim-courses-loop-item-info'); ?>
               </div>
               <?php
                   // @since 3.0.0
                   do_action('learn-press/after-courses-loop-item');
               ?>
           </div>
    <?php }else { ?>
            <div class="course-item">

                <?php
                // @since 3.0.0
                do_action('learn-press/before-courses-loop-item');
                ?>

                <?php do_action('thim-courses-loop-item-thumbnail'); ?>

                <div class="content">

                    <?php do_action('thim-before-courses-loop-item-title'); ?>

                    <?php do_action('learn-press/courses-loop-item-title'); ?>

                </div>

                <?php do_action('thim-courses-loop-item-info'); ?>

                <?php
                // @since 3.0.0
                do_action('learn-press/after-courses-loop-item');
                ?>

            </div>
            <?php
        }
    ?>

</div>
