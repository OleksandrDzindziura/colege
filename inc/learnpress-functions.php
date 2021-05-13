<?php
/**
 * Add or remove action
 */
remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );
remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );
remove_action( 'learn-press/courses-loop-item-title', 'learn_press_courses_loop_item_thumbnail', 10 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_instructor', 25 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_begin_meta', 10 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_price', 20 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_end_meta', 30 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_buttons', 35 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_user_progress', 40 );
remove_filter('learn_press_course_price_html_free', 'lp_pmpro_course_price_html_free_filter_callback', 10, 2 );

// add action show loop thumbnail
add_action( 'thim-courses-loop-item-thumbnail', 'learn_press_courses_loop_item_thumbnail', 10 );
// add action show loop instructor
add_action( 'thim-before-courses-loop-item-title', 'learn_press_courses_loop_item_instructor', 5 );
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
 * Add some meta data for a colection
 *
 * @param $meta_box
 */
if ( ! function_exists( 'thim_add_course_collection_meta' ) ) {
    function thim_add_course_collection_meta($meta_box)
    {
        $fields             = $meta_box['fields'];
        $fields[]           = array(
            'name' => esc_html__( 'Sub title', 'ivy-school' ),
            'id'   => '_thim_course_collection_sub_title',
            'type' => 'text',
            'desc' => esc_html__( 'Add sub title for Collection', 'ivy-school' ),
        );
        $fields[]           = array(
            'name' => esc_html__( 'Icon', 'ivy-school' ),
            'id'   => '_thim_course_collection_icon',
            'type' => 'file',
            'max_file_uploads' => 1,
            'desc' => esc_html__( 'Add an icon image for Collection', 'ivy-school' ),
        );
        $meta_box['fields'] = $fields;

        return $meta_box;
    }
}
add_filter( 'learn-press/collection-meta-box-args', 'thim_add_course_collection_meta' );

/** * Add media meta data for a course
 *
 * @param $meta_box
 */
if ( ! function_exists( 'thim_add_course_metas' ) ) {
    function thim_add_course_metas( $meta_box ) {
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
add_filter( 'learn_press_course_settings_meta_box_args', 'thim_add_course_metas' );


if ( ! function_exists( 'thim_add_lesson_meta' ) ) {
    function thim_add_lesson_meta( $meta_box ) {
        $fields             = $meta_box['fields'];
        $fields[]           = array(
            'name' => esc_html__( 'Media', 'ivy-school' ),
            'id'   => '_lp_lesson_video_intro',
            'type' => 'textarea',
            'desc' => esc_html__( 'Add an embed link like video, PDF, slider...', 'ivy-school' ),
        );
        $meta_box['fields'] = $fields;

        return $meta_box;
    }
}
add_filter( 'learn_press_lesson_meta_box_args', 'thim_add_lesson_meta' );

/**
 * @param $user
 */
if ( !function_exists( 'thim_extra_user_profile_fields' ) ) {
    function thim_extra_user_profile_fields( $user ) {
        $user_info = get_the_author_meta( 'lp_info', $user->ID );
        ?>
        <h3><?php esc_html_e( 'LearnPress Profile', 'ivy-school' ); ?></h3>

        <table class="form-table">
            <tbody>
            <tr>
                <th>
                    <label for="lp_major"><?php esc_html_e( 'Major', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_major" class="regular-text" type="text" value="<?php echo isset( $user_info['major'] ) ? $user_info['major'] : ''; ?>" name="lp_info[major]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_phone"><?php esc_html_e( 'Phone', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_phone" class="regular-text" type="text" value="<?php echo isset( $user_info['phone'] ) ? $user_info['phone'] : ''; ?>" name="lp_info[phone]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_address"><?php esc_html_e( 'Address', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_address" class="regular-text" type="text" value="<?php echo isset( $user_info['address'] ) ? $user_info['address'] : ''; ?>" name="lp_info[address]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_skype"><?php esc_html_e( 'Skype', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_skype" class="regular-text" type="text" value="<?php echo isset( $user_info['skype'] ) ? $user_info['skype'] : ''; ?>" name="lp_info[skype]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_facebook"><?php esc_html_e( 'Facebook Account', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_facebook" class="regular-text" type="text" value="<?php echo isset( $user_info['facebook'] ) ? $user_info['facebook'] : ''; ?>" name="lp_info[facebook]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_twitter"><?php esc_html_e( 'Twitter Account', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_twitter" class="regular-text" type="text" value="<?php echo isset( $user_info['twitter'] ) ? $user_info['twitter'] : ''; ?>" name="lp_info[twitter]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_google"><?php esc_html_e( 'Google Plus Account', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_google" class="regular-text" type="text" value="<?php echo isset( $user_info['google'] ) ? $user_info['google'] : ''; ?>" name="lp_info[google]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_linkedin"><?php esc_html_e( 'LinkedIn Plus Account', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_linkedin" class="regular-text" type="text" value="<?php echo isset( $user_info['linkedin'] ) ? $user_info['linkedin'] : ''; ?>" name="lp_info[linkedin]">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="lp_youtube"><?php esc_html_e( 'Youtube Account', 'ivy-school' ); ?></label>
                </th>
                <td>
                    <input id="lp_youtube" class="regular-text" type="text" value="<?php echo isset( $user_info['youtube'] ) ? $user_info['youtube'] : ''; ?>" name="lp_info[youtube]">
                </td>
            </tr>
            </tbody>
        </table>
        <?php
    }
}

add_action( 'show_user_profile', 'thim_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'thim_extra_user_profile_fields' );

function thim_save_extra_user_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    update_user_meta( $user_id, 'lp_info', $_POST['lp_info'] );
}

add_action( 'personal_options_update', 'thim_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'thim_save_extra_user_profile_fields' );

/**
 * Add custom JS
 */
if ( ! function_exists( 'thim_learn_press_add_custom_js' ) ) {
    function thim_learn_press_add_custom_js() {
        if( is_singular( 'lp_course' ) ) {
            global $post;
            $redirect_url = '';
            if ( ! empty( $post->ID ) && get_option( 'permalink_structure' ) ) {
                $redirect_url = add_query_arg( array(
                    'enroll-course' => $post->ID,
                ), get_the_permalink( $post->ID ) );
            }
            $account_url = thim_get_login_page_url();

            //Add custom js for LP
            $add_custom_js = "
                (function ($) {
                    \"use strict\";
                    $(document).on('click', 'body:not(\".logged-in\") form.purchase-course:not(\".allow_guest_checkout\") .button', function (e) {

                        e.preventDefault();
                        var redirect = $(this).parent().find('input[name=\"redirect_to\"]');
                        redirect.val('{$account_url}?redirect_to={$redirect_url}');
                        window.location = redirect.val();
                    });
                })(jQuery);
            ";
            wp_add_inline_script( 'learnpress-add-custom-js', $add_custom_js );

        }
    }
}
add_action( 'wp_footer', 'thim_learn_press_add_custom_js' );

/**
 * Modifile tab Profile
 */
add_filter( 'learn-press/profile-tabs', 'thim_modify_profile_tab' );
if ( ! function_exists( 'thim_modify_profile_tab' ) ) {
    function thim_modify_profile_tab( $defaults ) {
        $defaults['settings']['sections']['additional-information'] = array(
            'title'    => esc_html__( 'Additional Information', 'ivy-school' ),
            'slug'     => 'additional-information',
            'priority' => 50
        );

        return $defaults;
    }
}

/**
 * Add Class for body
 */
function thim_learnpress_body_classes( $classes ) {

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

add_filter( 'learn-press/update-profile-basic-information-data', function ( $update_data ) {
    $update_data['lp_info_status'] = filter_input( INPUT_POST, 'lp_info_status', FILTER_SANITIZE_STRING );

    return $update_data;
} );

add_action('init', function (){
    if ( function_exists( 'learn_press_is_profile' ) && learn_press_is_profile() == true ) {
        $profile = LP_Profile::instance();
        $hooks = array('avatar',
            'password',
            'publicity',  'basic-information' );

        foreach($hooks as $hook) {
            remove_action('learn_press_request_handler_save-profile-'.$hook, array($profile, 'save'), 5);
        }
    }
});

/**
 * Update user profile settings via AJAX call
 */
function thim_update_user_profile_settings() {

	$user_id = get_current_user_id();

	if ( ! empty( $_POST['save-profile-addition-information-nonce'] ) ) {
		if ( wp_verify_nonce( $_POST['save-profile-addition-information-nonce'], 'save-profile-addition-information' ) ) {

			$update_data = array(
				'ID'         => $user_id,
                'first_name'   => filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ),
                'last_name'    => filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ),
                'display_name' => filter_input( INPUT_POST, 'display_name', FILTER_SANITIZE_STRING ),
                'nickname'     => filter_input( INPUT_POST, 'nickname', FILTER_SANITIZE_STRING ),
                'description'  => filter_input( INPUT_POST, 'description', FILTER_SANITIZE_STRING ),
			);
            # check and update pass word
            if ( ! empty( $_POST['pass0'] ) && ! empty( $_POST['pass1'] ) ) {
                $message = 'ffeeee';
                // check old pass
                $old_pass       = filter_input( INPUT_POST, 'pass0' );
                $check_old_pass = false;
                if ( ! $old_pass ) {
                    $check_old_pass = false;
                } else {
                    $cuser = wp_get_current_user();
                    require_once( ABSPATH . 'wp-includes/class-phpass.php' );
                    $wp_hasher = new PasswordHash( 8, true );
                    if ( $wp_hasher->CheckPassword( $old_pass, $cuser->data->user_pass ) ) {
                        $check_old_pass = true;
                    }
                }
                if ( ! $check_old_pass ) {
                    $_message               = __( 'Old password incorrect!', 'ivy-school' );
                    learn_press_add_message( $_message, 'error' );
                    return;
                } else {
                    // check new pass
                    $new_pass  = filter_input( INPUT_POST, 'pass1' );
                    $new_pass2 = filter_input( INPUT_POST, 'pass2' );
                    if ( $new_pass != $new_pass2 ) {
                        $_message               = __( 'Confirmation password incorrect!', 'ivy-school' );
                        learn_press_add_message( $_message, 'error' );
                        return;
                    } else {
                        $update_data['user_pass'] = $new_pass;
                    }
                }
            }

            /* Update avata */
            $upload_dir = learn_press_user_profile_picture_upload_dir();
            if ( learn_press_get_request( 'lp-user-avatar-custom' ) != 'yes' ) {
                delete_user_meta( $user_id, '_lp_profile_picture' );
            } else {
                $data = learn_press_get_request( 'lp-user-avatar-crop' );
                if ( $data && ( $path = $upload_dir['basedir'] . $data['name'] ) && file_exists( $path ) ) {
                    $filetype = wp_check_filetype( $path );
                    if ( 'jpg' == $filetype['ext'] ) {
                        $im = imagecreatefromjpeg( $path );
                    } elseif ( 'png' == $filetype['ext'] ) {
                        $im = imagecreatefrompng( $path );
                    } else {
                        return;
                    }
                    $points  = explode( ',', $data['points'] );
                    $im_crop = imagecreatetruecolor( $data['width'], $data['height'] );
                    if ( $im !== false ) {
                        $user  = wp_get_current_user();
                        $dst_x = 0;
                        $dst_y = 0;
                        $dst_w = $data['width'];
                        $dst_h = $data['height'];
                        $src_x = $points[0];
                        $src_y = $points[1];
                        $src_w = $points[2] - $points[0];
                        $src_h = $points[3] - $points[1];
                        imagecopyresampled( $im_crop, $im, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h );
                        $newname = md5( $user->user_login );
                        $output  = dirname( $path );
                        if ( 'jpg' == $filetype['ext'] ) {
                            $newname .= '.jpg';
                            $output  .= '/' . $newname;
                            imagejpeg( $im_crop, $output );
                        } elseif ( 'png' == $filetype['ext'] ) {
                            $newname .= '.png';
                            $output  .= '/' . $newname;
                            imagepng( $im_crop, $output );
                        }
                        if ( file_exists( $output ) ) {
                            update_user_meta( $user_id, '_lp_profile_picture', preg_replace( '!^/!', '', $upload_dir['subdir'] ) . '/' . $newname );
                            update_user_meta( $user_id, '_lp_profile_picture_changed', 'yes' );
                        }

                    }
                    @unlink( $path );
                }
            }

			wp_update_user( $update_data );

            update_user_meta( $user_id, 'lp_info', $_POST['lp_info'] );
            update_user_meta( $user_id, '_lp_profile_publicity', $_POST['_lp_profile_publicity'] );
            $_message = __( 'Update success!', 'ivy-school' );
            learn_press_add_message( $_message );
			return;
		}
	}

	if ( empty( $_REQUEST['thim-update-user-profile'] ) ) {
		return;
	}

	if ( 'yes' !== $_REQUEST['thim-update-user-profile'] ) {
		return;
	}

	// Prevent redirection
	add_filter( 'learn-press/profile-updated-redirect', '__return_false' );
	$profile  = LP_Profile::instance();
	$postdata = $_POST;
	$nonce    = '';

	// Find the nonce
	foreach ( $postdata as $prop => $val ) {
		if ( preg_match( '~^save-profile-~', $prop ) ) {
			$nonce = $val;
			break;
		}
	}

	if ( ! $nonce ) {
		return;
	}

	// Save
	$profile->save( $nonce );

	die();
}

add_action( 'init', 'thim_update_user_profile_settings' );

if ( ! function_exists( 'thim_update_lp_info_major' ) ) {
    function thim_update_lp_info_major( $data ) {
        $data['lp_info_major'] = filter_input( INPUT_POST, 'lp_info_major', FILTER_SANITIZE_STRING );

        return $data;
    }
}
add_filter( 'learn-press/update-profile-basic-information-data', 'thim_update_lp_info_major' );

/**
 * Update user profile settings via AJAX call
 */
function thim_update_user_profile_settings_xxx() {

    if ( empty( $_REQUEST['thim-update-user-profile'] ) ) {
        return;
    }

    if ( 'yes' !== $_REQUEST['thim-update-user-profile'] ) {
        return;
    }

    // Prevent redirection
    add_filter( 'learn-press/profile-updated-redirect', '__return_false' );

    $profile  = LP_Profile::instance();
    $postdata = $_POST;
    $nonce    = '';

    // Find the nonce
    foreach ( $postdata as $prop => $val ) {
        if ( preg_match( '~^save-profile-~', $prop ) ) {
            $nonce = $val;
            break;
        }
    }

    if ( ! $nonce ) {
        return;
    }

    // Save
    $profile->save( $nonce );
    die();
}

add_action( 'init', 'thim_update_user_profile_settings_xxx' );

/**
 * Change url login
 */
add_filter( 'learn-press/login-url', 'thim_change_url_login_page', 1, 10 );
if( !function_exists( 'thim_change_url_login_page' ) ) {
    function thim_change_url_login_page( $url ) {
        return thim_get_login_page_url();
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

remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );
remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );


/**
 * Landing
 */
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_tabs', 20 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );

add_action( 'learn-press/content-landing-summary', 'thim_landing_tabs', 22 );
if ( ! function_exists( 'thim_landing_tabs' ) ) {
    function thim_landing_tabs() {
        learn_press_get_template( 'single-course/tabs/tabs-landing.php' );
    }
}
add_action( 'learn-press/content-landing-summary', 'learn_press_course_overview_tab', 51 );
add_action( 'learn-press/content-landing-summary', 'learn_press_course_curriculum_tab', 60 );
add_action( 'learn-press/content-landing-summary', 'learn_press_course_instructor', 65 );

if ( class_exists( 'LP_Addon_Course_Review' ) ) {
    add_action( 'learn-press/content-landing-summary', 'thim_course_rate', 70 );
}

add_action( 'learn-press/content-landing-summary', 'thim_related_courses', 75 );
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

/*
 * Landing course navigation tab
 * */
add_action( 'thim_lp_landing_course_tab', 'learn_press_course_price', 10 );
add_action( 'thim_lp_landing_course_tab', 'learn_press_course_buttons', 15 );


/**
 * Learning
 */
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_progress', 25 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_remaining_time', 30 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 40 );

add_action( 'thim_learning_after_tabs_wrapper', 'learn_press_course_remaining_time', 10 );
add_action( 'thim_learning_end_tab_curriculum', 'learn_press_course_buttons', 65 );
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

//Custom duration lesson, quiz
remove_action( 'learn-press/course-section-item/before-lp_quiz-meta', 'learn_press_item_meta_duration', 10 );
remove_action( 'learn-press/course-section-item/before-lp_lesson-meta', 'learn_press_item_meta_duration', 5 );

//remove tab instructor learning page
add_filter( 'learn_press_course_tabs', function ( $tabs ) {
    if ( ! empty( $tabs['co-instructor'] ) ) {
        unset( $tabs['co-instructor'] );
    }

    return $tabs;
}, 10 );


//Remove Wishlist
if ( thim_plugin_active( 'learnpress-wishlist/learnpress-wishlist.php' ) || class_exists( 'LP_Addon_Wishlist' ) ) {
    $addon_wishlist = LP_Addon_Wishlist::instance();
    remove_action( 'learn-press/content-learning-summary', array( $addon_wishlist, 'wishlist_button' ), 100 );
}

// Remove default forum link in single course
if ( thim_plugin_active( 'learnpress-bbpress/learnpress-bbpress.php' ) || class_exists( 'LP_Addon_BBPress_Course_Forum' ) ) {
    $addon_bbpress = LP_Addon_BBPress_Course_Forum::instance();
    remove_action( 'learn_press_after_single_course_summary', array( $addon_bbpress, 'forum_link' ) );
}

//Profile Page
remove_action( 'learn_press_after_profile_loop_course', 'learn_press_after_profile_tab_loop_course', 5, 2 );
if ( thim_plugin_active( 'learnpress-co-instructor/learnpress-co-instructor.php' ) || class_exists( 'LP_Addon_Co_Instructor' ) ) {
    $addon_co_instructor = LP_Addon_Co_Instructor::instance();
    add_filter( 'learn_press_user_profile_tabs', '__return_false', 999999, 2 );
}

// Change finished purchased courses tab to in progress tab
add_filter( 'learn-press/profile/purchased-courses-filters', 'thim_change_profile_purchased_course_tab', 10 );
if ( ! function_exists( 'thim_change_profile_purchased_course_tab' ) ) {
    function thim_change_profile_purchased_course_tab( $defaults ) {
        $profile = LP_Global::profile();
        $url     = $profile->get_current_url( false );

        $has_finished_tab = array_key_exists( 'finished', $defaults );

        if ( $has_finished_tab ) {
            unset( $defaults['finished'] );
        }

        // TODO look like hard code
        $defaults['all']         = sprintf( '<a href="%s">%s</a>', esc_url( $url ), esc_html__( 'All', 'ivy-school' ) );
        $defaults['finished']    = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'finished', $url ) ), esc_html__( 'Finished', 'ivy-school' ) );
        $defaults['passed']      = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'passed', $url ) ), esc_html__( 'Passed', 'ivy-school' ) );
        $defaults['failed']      = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'failed', $url ) ), esc_html__( 'Failed', 'ivy-school' ) );
        $defaults['in_progress'] = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'in_progress', $url ) ), esc_html__( 'In Progress', 'ivy-school' ) );

        return $defaults;
    }
}

// Get in progress tab content
add_filter( 'learn-press/query/user-purchased-courses', 'thim_add_profile_in_progress_tab', 10, 3 );
if ( ! function_exists( 'thim_add_profile_in_progress_tab' ) ) {
    function thim_add_profile_in_progress_tab( $sql, $user_id, $args ) {
        if ( $args['status'] == 'in_progress' ) {
            $sql['where'] .= ' AND ui.status = "enrolled"';
        }

        return $sql;
    }
}

add_filter( 'learn-press/profile-tabs', 'thim_modify_profile_tab' );
if ( ! function_exists( 'thim_modify_profile_tab' ) ) {
    function thim_modify_profile_tab( $defaults ) {
        $defaults['settings']['sections']['additional-information'] = array(
            'title'    => esc_html__( 'Additional Information', 'ivy-school' ),
            'slug'     => 'additional-information',
            'priority' => 50
        );

        return $defaults;
    }
}

//Collections
remove_action( 'learn_press_collections_before_single_summary', 'learn_press_collections_title', 5 );

//Lesson Quiz
remove_action( 'learn_press/after_course_item_content', 'learn_press_lesson_comment_form', 10 );

// Add media for only Lesson
add_action( 'learn-press/course-item-content-header', 'thim_add_media_lesson_content',1 );
if ( ! function_exists( 'thim_add_media_lesson_content' ) ) {
    function thim_add_media_lesson_content() {
        $course_item      = LP_Global::course_item();
        $user          = LP_Global::user();
        $course        = LP_Global::course();
        $can_view_item = $user->can_view_item( $course_item->get_id(), $course->get_id() );
        $lesson_media_meta = get_post_meta( $course_item->get_id(), '_lp_lesson_video_intro', true );

        if ( !empty( $lesson_media_meta ) && $can_view_item && !$course_item->is_blocked() ) {
            echo '<div class="thim-lesson-media"><div class="wrapper">' . ( $lesson_media_meta ) . '</div></div>';
        }

    }
}
// Certificates
if ( ! is_user_logged_in() ) {
    if ( thim_plugin_active( 'learnpress-certificates/learnpress-certificates.php' ) || class_exists( 'LP_Addon_Certificates' ) ) {
        $addon_certificates = LP_Addon_Certificates::instance();
        add_filter( 'learn_press_user_profile_tabs', '__return_false', 99999 );
    }
}

function thim_course_instructor() {
    learn_press_get_template( 'single-course/instructor.php' );
}

function thim_course_rate() {
    echo '<div class="landing-review">';
    echo '<h3 class="title-rating">' . esc_html__( 'Reviews', 'ivy-school' ) . '</h3>';
    learn_press_course_review_template( 'course-rate.php' );
    learn_press_course_review_template( 'course-review.php' );
    echo '</div>';
}

function thim_course_review() {
    learn_press_course_review_template( 'course-review.php' );
}


function add_review_button() {
    learn_press_course_review_template( 'review-form.php' );
}

// Change redirect enroll to theme's account page
add_filter( 'learn-press/enroll-course-redirect-login', 'thim_modify_redirect_enroll' );
if ( ! function_exists( 'thim_modify_redirect_enroll' ) ) {
    function thim_modify_redirect_enroll( $url ) {
        $current_course_id = $_REQUEST['enroll-course'];
        if ( empty( $current_course_id ) ) {
            return false;
        }
        $url = add_query_arg( 'redirect_to', get_the_permalink( $current_course_id ), thim_get_login_page_url() );

        return $url;
    }
}

// No require password strength in LearnPress's register form (Checkout page)
add_filter( 'learn-press/register-fields', 'thim_lp_modify_password_field' );
if ( ! function_exists( 'thim_lp_modify_password_field' ) ) {
    function thim_lp_modify_password_field( $fields ) {
        if ( isset( $fields['reg_password']['desc'] ) ) {
            unset( $fields['reg_password']['desc'] );
        }

        remove_filter( 'learn-press/register-validate-field', array(
            'LP_Forms_Handler',
            'register_validate_field'
        ), 10 );

        return $fields;
    }
}


/**
 * Custom Become a teacher form
 */
remove_action( 'learn-press/before-become-teacher-form', 'learn_press_become_teacher_heading', 10 );
remove_action( 'learn-press/become-teacher-form', 'learn_press_become_teacher_form_fields', 5 );
add_action( 'learn-press/become-teacher-form', 'thim_become_teacher_form_fields', 5 );
if ( ! function_exists( 'thim_become_teacher_form_fields' ) ) {
    function thim_become_teacher_form_fields() {
        learn_press_get_template( 'global/become-teacher-form/form-fields.php', array( 'fields' => learn_press_get_become_a_teacher_form_fields() ) );
    }
}
remove_action( 'learn-press/after-become-teacher-form', 'learn_press_become_teacher_button', 10 );
add_action( 'learn-press/after-become-teacher-form', 'thim_become_teacher_button', 10 );
if ( ! function_exists( 'thim_become_teacher_button' ) ) {
    function thim_become_teacher_button() {
        learn_press_get_template( 'global/become-teacher-form/button.php' );
    }
}

// become teacher fields
function _x_add_become_teacher_fields( $fields ) {
    $fields['bat_message']['type']          = 'textarea';
    $fields['bat_name']['placeholder']      = esc_html__( 'First name *', 'ivy-school' );
    $fields['bat_email']['placeholder']     = esc_html__( 'Email *', 'ivy-school' );
    $fields['bat_phone']['placeholder']     = esc_html__( 'Your phone number *', 'ivy-school' );
    return $fields;
}

add_filter( 'learn_press_become_teacher_form_fields', '_x_add_become_teacher_fields' );

/**
 * Update last name to user meta
 */
function _x_process_become_teacher_fields() {
    if ( isset( $_REQUEST['bat_name'] ) && isset( $_REQUEST['bat_email'] ) ) {
        update_user_meta( get_current_user_id(), 'last_name', $_REQUEST['bat_lastname'] );
    }
}
add_filter( 'init', '_x_process_become_teacher_fields' );

if ( !function_exists( 'thim_content_item_edit_link' ) ) {
	function thim_content_item_edit_link() {
		$course      = LP_Global::course();
		$course_item = LP_Global::course_item();
		$user        = LP_Global::user();
		if ( $user->can_edit_item( $course_item->get_id(), $course->get_id() ) ): ?>
			<p class="edit-course-item-link">
				<a href="<?php echo get_edit_post_link( $course_item->get_id() ); ?>"><i
						class="fa fa-pencil-square-o"></i> <?php _e( 'Edit item', 'ivy-school' ); ?>
				</a>
			</p>
		<?php endif;
	}
}
add_action( 'learn-press/after-course-item-content', 'thim_content_item_edit_link', 3 );