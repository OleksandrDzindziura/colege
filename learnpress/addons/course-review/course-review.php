<?php
/**
 * Template for displaying course review.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/course-review.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * @version 3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

$course_id     = get_the_ID();
$paged = ! empty( $_REQUEST['paged'] ) ? intval( $_REQUEST['paged'] ) : 1;
$course_review = learn_press_get_course_review( $course_id, $paged );
if ( $course_review['total'] ) {
	$reviews = $course_review['reviews']; ?>
	<div id="comments" class="comments-area">
        <div class="list-comments">
            <ul class="comment-list">
                <?php foreach ( $reviews as $review ) { ?>
                    <?php learn_press_course_review_template( 'loop-review.php', array( 'review' => $review ) ); ?>
                <?php } ?>

                <?php if ( empty( $course_review['finish'] ) ) { ?>
                    <li class="loading"><?php echo esc_html__( 'Loading...', 'ivy-school' ); ?></li>
                <?php } ?>
            </ul>
        </div>

		<?php if ( empty( $course_review['finish'] ) ) { ?>
			<button class="button course-review-load-more" id="course-review-load-more"
			        data-paged="<?php echo esc_attr($course_review['paged']); ?>"><?php echo esc_html__( 'Load More', 'ivy-school' ); ?></button>
		<?php } ?>
	</div>
<?php }