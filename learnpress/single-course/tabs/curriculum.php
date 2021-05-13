<?php
/**
 * Template for displaying curriculum tab of single course.
 *
 * @author  ThimPress
 * @package CourseBuilder/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
$user   = LP_Global::user();


$curriculum_heading = apply_filters( 'learn_press_curriculum_heading', esc_html__( 'Course Content', 'ivy-school' ) );
?>
<?php if ( ! learn_press_is_learning_course() ): ?>
	<div id="tab-curriculum" style="height: 68px;"></div>
<?php endif; ?>

<div class="course-curriculum" id="learn-press-course-curriculum">
	<div class="curriculum-heading">
		<?php if ( $curriculum_heading ) { ?>
			<div class="title">
				<h2 class="course-curriculum-title"><?php echo esc_html( $curriculum_heading ); ?></h2>
			</div>
		<?php } ?>

		<div class="search">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" class="search-field"
				       placeholder="<?php echo esc_attr__( 'Search...', 'ivy-school' ) ?>"
				       value="<?php echo get_search_query() ?>" name="s" />
				<input type="hidden" name="post_type" value="lp_lession">
				<button type="submit" class="search-submit"><span class="ion-android-search"></span></button>
			</form>
		</div>

        <div class="meta-section">
            <!-- Display total learning in landing course page -->
            <?php
            $total_lessson = $course->count_items( 'lp_lesson' );
            $total_quiz    = $course->count_items( 'lp_quiz' );

            if ( $total_lessson || $total_quiz ) {
                echo '<span class="courses-lessons">' . esc_html__( 'Total learning: ', 'ivy-school' );
                if ( $total_lessson ) {
                    echo '<span class="text">' . sprintf( _n( '%d lesson', '%d lessons', $total_lessson, 'ivy-school' ), $total_lessson ) . '</span>';
                }

                if ( $total_quiz ) {
                    echo '<span class="text">' . sprintf( _n( ' / %d quiz', ' / %d quizzes', $total_quiz, 'ivy-school' ), $total_quiz ) . '</span>';
                }
                echo '</span>';
            }
            ?>
            <!-- End -->

            <!-- Display total course time in landing course page -->
            <?php
            $course_duration_text = thim_duration_time_calculator( $course->get_id(), 'lp_course' );
            $course_duration_meta = get_post_meta( $course->get_id(), '_lp_duration', true );
            $course_duration      = explode( ' ', $course_duration_meta );

            if ( ! empty( $course_duration[0] ) && $course_duration[0] != '0' ) {
                ?>
                <span class="courses-time"><?php esc_html_e( 'Time: ', 'ivy-school' ); ?>
                    <span class="text"><?php echo esc_html( $course_duration_text ); ?></span></span>
                <?php
            }
            ?>
            <!-- End -->
        </div>
	</div>

	<!-- Display Breadcrumb in sidebar course item popup -->
	<?php
	$args = wp_parse_args( $args, apply_filters( 'learn_press_breadcrumb_defaults', array(
		'delimiter'   => ' <span class="delimiter">/</span> ',
		'wrap_before' => '<nav class="thim-font-heading learn-press-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
	) ) );

	learn_press_breadcrumb( $args );
	?>
	<!-- End -->

	<!-- Display course progress in course item popup -->
	<?php learn_press_course_progress(); ?>
	<!-- End -->

	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-single-course-curriculum' ); ?>

	<?php if ( $curriculum = $course->get_curriculum() ) { ?>
		<div class="curriculum-sections">
			<?php
            $i=0;
            foreach ( $curriculum as $section ) {
                $i++;
			    $active = ( $i==1 ) ? true : false;
				learn_press_get_template( 'single-course/loop-section.php', array( 'section' => $section, 'active' => $active ) );
			} ?>
		</div>
	<?php } else { ?>
        <p class="curriculum-empty"><?php echo apply_filters( 'learn_press_course_curriculum_empty', esc_attr__( 'Curriculum is empty', 'ivy-school' ) ); ?></p>
	<?php } ?>

	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-single-course-curriculum' );
	?>
</div>

