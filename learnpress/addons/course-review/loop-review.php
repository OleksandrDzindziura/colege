<?php
/**
 * Template for displaying loop course review.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/loop-review.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
?>

<li class="comment">
    <?php echo get_avatar( $review->user_email, 84 ) ?>
    <div class="content-comment">
        <div class="author">
            <div class="author-infor">
                <span class="author-name">
                    <?php do_action( 'learn_press_before_review_username' ); ?>
                    <?php echo esc_html($review->display_name); ?>
                    <?php do_action( 'learn_press_after_review_username' ); ?>
                </span>
                <span class="comment-extra-info">
                    <?php
                    printf( get_comment_date( get_option( 'date_format' ), $review->comment_id ) );
                    echo esc_html__( ' at ', 'ivy-school' );
                    printf( get_comment_date( get_option( 'time_format' ), $review->comment_id ) ) ?>

                </span>
            </div>
        </div>
        <div class="message">
            <p>
                <?php do_action( 'learn_press_before_review_content' ); ?>
                <?php echo esc_html($review->content); ?>
                <?php do_action( 'learn_press_after_review_content' ); ?>
            </p>
        </div>
    </div>
</li>