<?php
// Enable override templates
add_filter( 'learn-press/override-templates', '__return_true' );

// Remove Breadcrumb on Page
LP()->template( 'general' )->remove( 'learn-press/before-main-content', array( '<div class="lp-archive-courses">', 'lp-archive-courses-open' ), -100 );
remove_action( 'learn-press/before-main-content', LP()->template( 'general' )->func( 'breadcrumb' ) );
add_action( 'learn-press/before-main-content' , 'lp_archive_courses_open' , 10 );
if ( !function_exists( 'lp_archive_courses_open' ) ) {
    function lp_archive_courses_open() {
    	$courses_page_id = learn_press_get_page_id('courses');
		$courses_page_url = $courses_page_id ? get_page_link($courses_page_id): learn_press_get_current_url();
		if ( is_post_type_archive( LP_COURSE_CPT ) || is_page( learn_press_get_page_id( 'courses' ) ) ) {
			?>
				<div id="lp-archive-courses" class="lp-archive-courses lp-4">
			<?php
        }
        elseif ( is_singular( LP_COURSE_CPT ) ) {
			?>
				<div id="lp-single-course" class="entry-content lp-single-course lp-4">

			<?php
		}
    }
}

// filter archive course loop
add_filter( 'learn_press_course_loop_begin','learn_press_courses_loop_begin');
add_filter( 'learn_press_course_loop_end', 'learn_press_courses_loop_end');

if(! function_exists('learn_press_courses_loop_begin')){
	function learn_press_courses_loop_begin(){
		return '<div class=" grid-courses archive-page row ">';
	}
}
if(! function_exists('learn_press_courses_loop_end')){
	function learn_press_courses_loop_end(){
		return '</div>';
	}
}

// add action show loop instructor 
add_action( 'thim-before-courses-loop-item-title', 'learn_press_courses_loop_item_instructor', 5 );
if ( ! function_exists( 'learn_press_courses_loop_item_instructor' ) ) {
	function learn_press_courses_loop_item_instructor() {
		learn_press_get_template( 'loop/course/instructor.php' );
	}
}
// add action show loop review
if( thim_plugin_active( 'learnpress-course-review' ) ) {
    add_action( 'thim-before-courses-loop-item-title', 'thim_courses_loop_item_review', 10 );
    if ( ! function_exists( 'thim_courses_loop_item_review' ) ) {
        function thim_courses_loop_item_review() {
            learn_press_get_template( 'loop/course/review.php' );
        }
    }
}
// add action show loop info
add_action( 'thim-courses-loop-item-info', 'thim_courses_loop_item_info', 5 );
if ( ! function_exists( 'thim_courses_loop_item_info' ) ) {
    function thim_courses_loop_item_info() {
        learn_press_get_template( 'loop/course/info.php' );
    }
}

/**
 * Add Class for body
 */
function thim_learnpress_body_classes( $classes ) {
    
    if ( thim_is_new_learnpress( '4.0' ) ) {
        $classes[] = 'lp-4';
    }

    if ( is_singular( 'lp_course' ) ) {
        $layouts = get_theme_mod( 'learnpress_single_course_style', 1 );
        $layouts = isset( $_GET['layout'] ) ? $_GET['layout'] : $layouts;

        $classes[] = 'thim-lp-layout-' . $layouts;

        $course = learn_press_get_the_course();
        $user   = learn_press_get_current_user();
        if ( $user->has_course_status( $course->get_id(), array(
                'enrolled',
                'finished'
            ) ) || ! $course->is_required_enroll()
        ) {
            $classes[] = 'lp-learning';
        } else {
            $classes[] = 'lp-landing';
        }
    }

    if ( learn_press_is_profile() ) {
        $classes[] = 'lp-profile';
    }

    return $classes;
}

add_filter( 'body_class', 'thim_learnpress_body_classes' );

/**
 * Landing
 */

add_action( 'learn-press/content-landing', 'thim_landing_tabs', 22 );
if ( ! function_exists( 'thim_landing_tabs' ) ) {
    function thim_landing_tabs() {
        learn_press_get_template( 'single-course/tabs/tabs-landing.php' );
    }
}
add_action( 'learn-press/content-landing', 'learn_press_course_overview_tabs', 51 );
if ( ! function_exists( 'learn_press_course_overview_tabs' ) ) {
	/**
	 * Output course overview
	 *
	 * @since 1.1
	 */
	function learn_press_course_overview_tabs() {
		learn_press_get_template( 'single-course/tabs/overview.php' );
	}
}
add_action( 'learn-press/content-landing', 'learn_press_course_curriculum_tab', 60 );
add_action( 'learn-press/content-landing', 'learn_press_course_instructor', 65 );


if ( class_exists( 'LP_Addon_Course_Review' ) ) {
    add_action( 'learn-press/content-landing', 'thim_course_rate', 70 );
}
function thim_course_rate() {
    echo '<div class="landing-review">';
    echo '<h3 class="title-rating">' . esc_html__( 'Reviews', 'ivy-school' ) . '</h3>';
    learn_press_course_review_template( 'course-rate.php' );
    learn_press_course_review_template( 'course-review.php' );
    echo '</div>';
}

add_action( 'learn-press/content-landing', 'thim_related_courses', 75 );
if ( ! function_exists( 'thim_related_courses' ) ) {

    function thim_related_courses() {
        $related_courses = thim_get_related_courses( 6 );
        if ( $related_courses ) {
            ?>
            <div class="related-archive">
                <h3 class="related-title"><?php esc_html_e( 'Related Courses', 'ivy-school' ); ?></h3>

                <div class="slide-course js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
                    <div class="slide-slick">
                        <?php foreach ( $related_courses as $course_item ) : ?>
                            <?php
                            $course      = LP_Course::get_course( $course_item->ID );
                            $is_required = $course->is_required_enroll();
                            $course_id   = $course_item->ID;
                            if ( class_exists( 'LP_Addon_Course_Review' ) ) {
                                $course_rate              = learn_press_get_course_rate( $course_id );
                                $course_number_vote       = learn_press_get_course_rate_total( $course_id );
                                $html_course_number_votes = $course_number_vote ? sprintf( _n( '(%1$s vote )', ' (%1$s votes)', $course_number_vote, 'ivy-school' ), number_format_i18n( $course_number_vote ) ) : esc_html__( '(0 vote)', 'ivy-school' );
                            }
                            ?>
                            <div class="item-slick">
                                <div class="course-item">
                                    <a href="<?php echo get_permalink($course->get_id());?>" class="link-item"></a>
                                    <div class="image">
                                        <?php
                                        echo thim_feature_image( get_post_thumbnail_id( $course->get_id()), 284, 200, false );
                                        ?>
                                    </div>

                                    <div class="content">
                                        <div class="ava">
                                            <?php echo ent2ncr($course->get_instructor()->get_profile_picture('',68)) ?>
                                        </div>

                                        <div class="name">
                                            <?php echo ent2ncr($course->get_instructor_html()); ?>
                                        </div>

                                        <?php
                                        if ( class_exists( 'LP_Addon_Course_Review' ) ) {
                                            $num_ratings = learn_press_get_course_rate_total( get_the_ID() ) ? learn_press_get_course_rate_total( get_the_ID() ) : 0;
                                            $course_rate   = learn_press_get_course_rate( get_the_ID() );
                                            $non_star = 5 - intval($course_rate);
                                            ?>
                                            <div class="star">
                                                <?php for ($i=0;$i<intval($course_rate);$i++) {?>
                                                    <i class="fa fa-star"></i>
                                                <?php }?>
                                                <?php for ($j=0;$j<intval($non_star);$j++) {?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php }?>
                                            </div>
                                        <?php }?>

                                        <h4 class="title">
                                            <a href="<?php echo get_permalink($course->get_id());?>">
                                                <?php echo get_the_title($course->get_id());?>
                                            </a>
                                        </h4>
                                    </div>

                                    <div class="info">
                                        <div class="price">
                                            <?php echo esc_html($course->get_price_html()); ?>
                                            <?php if ( $course->has_sale_price() ) { ?>
                                                <span class="old-price"> <?php echo esc_html($course->get_origin_price_html()); ?></span>
                                            <?php } ?>
                                        </div>

                                        <div class="numbers">
                                            <span class="contact">
                                                <i class="ion ion-android-contacts"></i>
                                                <?php echo intval($course->count_students());?>
                                            </span>
                                            <?php if ( class_exists( 'LP_Addon_Course_Review' ) ) {?>
                                            <span class="chat">
                                                <i class="ion ion-chatbubbles"></i>
                                                <?php echo esc_html($num_ratings);?>
                                            </span>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="courses-carousel archive-courses course-grid owl-carousel owl-theme" data-cols="3">

                </div>
            </div>
            <?php
        }
    }
}
if( !function_exists('thim_get_related_courses') ) {
    function thim_get_related_courses( $limit ) {
        if ( ! $limit ) {
            $limit = 3;
        }
        $course_id = get_the_ID();

        $tag_ids = array();
        $tags    = get_the_terms( $course_id, 'course_category' );

        if ( $tags ) {
            foreach ( $tags as $individual_tag ) {
                $tag_ids[] = $individual_tag->slug;
            }
        }

        $args = array(
            'posts_per_page'      => $limit,
            'paged'               => 1,
            'ignore_sticky_posts' => 1,
            'post__not_in'        => array( $course_id ),
            'post_type'           => 'lp_course'
        );

        if ( $tag_ids ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'course_category',
                    'field'    => 'slug',
                    'terms'    => $tag_ids
                )
            );
        }
        $related = array();
        if ( $posts = new WP_Query( $args ) ) {
            global $post;
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $related[] = $post;
            }
        }
        wp_reset_query();

        return $related;
    }
}

add_action( 'thim-info-bar-position', 'thim_info_bar_position_single', 71 );
function thim_info_bar_position_single() { ?>
    <div class="wrapper-info-bar infobar-single">
        <?php learn_press_get_template( 'single-course/info-bar.php' ); ?>
    </div>
    <?php
}

//Custom duration lesson, quiz
remove_action( 'learn-press/course-section-item/before-lp_quiz-meta', LP()->template( 'course' )->func( 'item_meta_duration' ), 20 );
remove_action( 'learn-press/course-section-item/before-lp_lesson-meta', LP()->template( 'course' )->func( 'item_meta_duration' ), 10 );

// 
add_action( 'learn-press/begin-section-loop-item', 'thim_add_format_icon', 10 );
if ( ! function_exists( 'thim_add_format_icon' ) ) {
    function thim_add_format_icon( $item ) {
        $format = get_post_format( $item->get_id() );
        if ( get_post_type( $item->get_id() ) == 'lp_quiz' ) {
            echo '<span class="course-format-icon"><i class="fa fa-clock-o"></i></span>';
        } elseif ( $format == 'video' ) {
            echo '<span class="course-format-icon"><i class="fa fa-play"></i></span>';
        } elseif ( $format == 'audio' ) {
            echo '<span class="course-format-icon"><i class="fa fa-music"></i></span>';
        } elseif ( $format == 'image' ) {
            echo '<span class="course-format-icon"><i class="fa fa-picture-o"></i></span>';
        } elseif ( $format == 'aside' ) {
            echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
        } elseif ( $format == 'quote' ) {
            echo '<span class="course-format-icon"><i class="fa fa-quote-left"></i></span>';
        } elseif ( $format == 'link' ) {
            echo '<span class="course-format-icon"><i class="fa fa-link"></i></span>';
        } else {
            echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
        }
    }
}

/**
 * Get course, lesson, ... duration in hours
 *
 * @param $id
 *
 * @param $post_type
 *
 * @return string
 */

if ( ! function_exists( 'thim_duration_time_calculator' ) ) {
    function thim_duration_time_calculator( $id, $post_type = 'lp_course' ) {
        if ( $post_type == 'lp_course' ) {
            $course_duration_meta = get_post_meta( $id, '_lp_duration', true );
            $course_duration_arr  = array_pad( explode( ' ', $course_duration_meta, 2 ), 2, 'minute' );

            list( $number, $time ) = $course_duration_arr;

            switch ( $time ) {
                case 'week':
                    $course_duration_text = sprintf( _n( "%s week", "%s weeks", $number, 'ivy-school' ), $number );
                    break;
                case 'day':
                    $course_duration_text = sprintf( _n( "%s day", "%s days", $number, 'ivy-school' ), $number );
                    break;
                case 'hour':
                    $course_duration_text = sprintf( _n( "%s hour", "%s hours", $number, 'ivy-school' ), $number );
                    break;
                default:
                    $course_duration_text = sprintf( _n( "%s minute", "%s minutes", $number, 'ivy-school' ), $number );
            }

            return $course_duration_text;
        } else { // lesson, quiz duration
            $duration = get_post_meta( $id, '_lp_duration', true );

            if ( ! $duration ) {
                return '';
            }
            $duration = ( strtotime( $duration ) - time() ) / 60;
            $hour     = floor( $duration / 60 );
            $minute   = $duration % 60;

            if ( $hour && $minute ) {
                $time = $hour . esc_html__( 'h', 'ivy-school' ) . ' ' . $minute . esc_html__( 'm', 'ivy-school' );
            } elseif ( ! $hour && $minute ) {
                $time = $minute . esc_html__( 'm', 'ivy-school' );
            } elseif ( ! $minute && $hour ) {
                $time = $hour . esc_html__( 'h', 'ivy-school' );
            } else {
                $time = '';
            }
            return $time;
        }
    }
}

/** * Add media meta data for a course
 *
 * @param $meta_box
 */
if ( ! function_exists( 'thim_add_course_meta' ) ) {
    function thim_add_course_meta( $meta_box ) {
        $fields             = $meta_box['fields'];
        $fields[]           = array(
            'name' => esc_html__( 'Media URL', 'ivy-school' ),
            'id'   => 'thim_course_media',
            'type' => 'text',
            'size' => 100,
            'desc' => esc_html__( 'Supports 3 types of video urls: Direct video link, Youtube link, Vimeo link.', 'ivy-school' ),
        );
        $fields[]           = array(
            'name' => esc_html__( 'Info Button Box', 'ivy-school' ),
            'id'   => 'thim_course_info_button',
            'type' => 'text',
            'size' => 100,
            'desc' => esc_html__( 'Add text info button', 'ivy-school' ),
        );
        $fields[]           = array(
            'name' => esc_html__( 'Includes', 'ivy-school' ),
            'id'   => 'thim_course_includes',
            'type' => 'wysiwyg',
            'desc' => esc_html__( 'Includes infomation of Courses', 'ivy-school' ),
        );
        $fields[]           = array(
            'name' => esc_html__( 'Time', 'ivy-school' ),
            'id'   => 'thim_course_time',
            'type' => 'text',
            'desc' => esc_html__( 'Show Time start and time end in course', 'ivy-school' ),
        );
        $fields[]           = array(
            'name' => esc_html__( 'Day of Week', 'ivy-school' ),
            'id'   => 'thim_course_day_of_week',
            'type' => 'text',
            'desc' => esc_html__( 'Show Day of Week Course', 'ivy-school' ),
        );
        $meta_box['fields'] = $fields;

        return $meta_box;
    }
}
add_filter( 'learn_press_course_settings_meta_box_args', 'thim_add_course_meta' );

/** BEGIN: Checkout page */
remove_action('learn-press/after-checkout-form',LP()->template( 'checkout' )->func( 'account_logged_in' ),20);
remove_action( 'learn-press/after-checkout-form', LP()->template( 'checkout' )->func( 'order_comment' ), 60 );
add_action('learn-press/before-checkout-form',LP()->template( 'checkout' )->func( 'account_logged_in' ),9);
add_action('learn-press/before-checkout-form',LP()->template( 'checkout' )->func( 'order_comment' ),11);

// Remove header profile
remove_action( 'learn-press/before-user-profile', LP()->template( 'profile' )->func( 'header' ), 10 );
// Add class for list course in profile page
add_filter( 'lp_item_course_class', 'add_item_course_class' );
if(!function_exists('add_item_course_class')){
    function add_item_course_class( $classes){
        $classes = array_merge(
            $classes,
            array( 'grid-courses', 'row')
        );
        return $classes;
    }
}

// add edit link in content course item
if ( ! function_exists( 'thim_content_item_edit_link' ) ) {
	function thim_content_item_edit_link() {
		$course      = LP_Global::course();
		if ( ! $course ) {
			return;
		}
		$course_item = LP_Global::course_item();
		$user        = LP_Global::user();
		if ( $user->can_edit_item( $course_item->get_id(), $course->get_id() ) ): ?>
            <p class="edit-course-item-link">
                <a href="<?php echo get_edit_post_link( $course_item->get_id() ); ?>"><i
                            class="fa fa-pencil-square-o"></i> <?php esc_html_e( 'Edit item', 'course-builder' ); ?>
                </a>
            </p>
		<?php endif;
	}
}
add_action( 'learn-press/after-course-item-content', 'thim_content_item_edit_link', 3 );

// Add media for only Lesson

if ( ! function_exists( 'thim_content_item_lesson_media' ) ) {
	function thim_content_item_lesson_media() {
        $item          = LP_Global::course_item();
        $user          = LP_Global::user();
        $course_item   = LP_Global::course_item();
        $course        = LP_Global::course();
        $can_view_item = $user->can_view_item( $course_item->get_id(), $course->get_id() );
        $media_intro   = get_post_meta( $item->get_id(), '_lp_lesson_video_intro', true );
        if ( ! empty( $media_intro ) && ! $course_item->is_blocked() && $can_view_item ) {
            ?>
            <div class="learn-press-video-intro thim-lesson-media">
                <div class="wrapper">
                    <?php echo $media_intro; ?>
                </div>
            </div>
            <?php
        }

	}
}
add_action( 'learn-press/before-course-item-content', 'thim_content_item_lesson_media', 5 );

/**
 * Add custom JS
 */
if ( ! function_exists( 'thim_add_custom_js' ) ) {
	function thim_add_custom_js() {
		//Add code js to open login-popup if not logged in.
		if ( thim_plugin_active( 'learnpress' ) ) {

            

			if ( is_singular( 'lp_course' ) ) {
				?>
				<script data-cfasync="true" type="text/javascript">

					(function ($) {
                        "use strict";
                        $(document).on('click touch', 'body:not(".logged-in") .enroll-course .button-enroll-course, body:not(".logged-in") form.purchase-course:not(".allow_guest_checkout") .btn-buy-course', function (e) {
                                e.preventDefault();
                                if ($('body').is(':not(.logged-in)')) {
                                    
                                    $('.bp-element-login-popup .login').trigger('click');
                                   
                                } else {
                                    window.location.href = $(this).parent().find('input[name=redirect_to]').val();
                                }
                                    
                            });
                                
						
					})(jQuery);
				</script>
				<?php
			}
		}
	}
}
add_action( 'wp_footer', 'thim_add_custom_js', 10000 );