<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();
$user    = $profile->get_user();
$custom_img   = $user->get_upload_profile_src();
$gravatar_img = $user->get_profile_picture( 'gravatar', 500 );

$user_meta = get_user_meta( $user->get_id() );
$user_meta = array_map( function ( $a ) {
	return $a[0];
}, $user_meta );

$lp_info = get_the_author_meta( 'lp_info', $user->get_id() );
?>


<div class="row thim-about-me-area">
    <div class="custom-col col-sm-10 col-md-5 col-xl-4">
        <!-- block teacher -->
        <div class="teacher">
            <?php if ( $custom_img ) { ?>
                <img src="<?php echo esc_url($custom_img); ?>" />
            <?php } else { ?>
                <?php echo ent2ncr($gravatar_img); ?>
            <?php } ?>

            <div class="content">
                <div class="social-link">
                    <?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['facebook']);?>" class="item">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['twitter']);?>" class="item">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['google']);?>" class="item">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( isset( $lp_info['instagram'] ) && $lp_info['instagram'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['instagram']);?>" class="item">
                            <i class="fa fa-instagram"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['linkedin']);?>" class="item">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
                        <a href="<?php echo esc_url($lp_info['youtube']);?>" class="item">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="info">
                    <a class="name" href=""><?php echo esc_html($user->get_display_name()); ?></a>

                    <?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
                        <span class="description"><?php echo esc_html($lp_info['major']);?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- end block teacher -->
    </div>

    <div class="custom-col col-sm-10 col-md-5 col-xl-5">
        <!-- shortcode heading-->
        <div class="title-area">
            <h3 class="title">
                <?php esc_html_e( 'About me', 'ivy-school' ) ?>
            </h3>

            <div class="line"></div>
        </div>
        <!-- end shortcode heading-->

        <!-- block text about me -->
        <div class="text-about-me">
            <p><?php echo esc_html($user->get_description());?></p>
        </div>
        <!-- end block text about me -->
    </div>

    <div class="custom-col col-sm-10 col-xl-3">
        <!-- shortcode heading-->
        <div class="title-area">
            <h3 class="title">
                <?php esc_html_e( 'Contact info', 'ivy-school' ) ?>
            </h3>

            <div class="line"></div>
        </div>
        <!-- end shortcode heading-->

        <!-- block contact info -->
        <ul class="contact-info">
            <?php if ( isset( $lp_info['address'] ) && $lp_info['address'] ) : ?>
                <li>
                    <span>
                        <i class="ion ion-ios-location-outline"></i>
                        <?php esc_html_e( 'Address', 'ivy-school' ) ?>:
                    </span>
                    <?php echo esc_html( $lp_info['address'] ); ?>
                </li>
            <?php endif; ?>
            <?php if ( isset( $lp_info['phone'] ) && $lp_info['phone'] ) : ?>
                <li>
                    <span>
                        <i class="ion ion-ios-telephone-outline"></i>
                        <?php esc_html_e( 'Phone', 'ivy-school' ) ?>:
                    </span>
                    <a href="tel:<?php echo esc_html( $lp_info['phone'] ); ?>"><?php echo esc_html( $lp_info['phone'] ); ?></a>
                </li>
            <?php endif; ?>
            <li>
                <span>
                    <i class="ion ion-ios-email-outline"></i>
                    <?php esc_html_e( 'Email', 'ivy-school' ) ?>:
                </span>
                <a href="mailto:<?php echo esc_attr( $user->get_email() ); ?>"><?php echo esc_html( $user->get_email() ); ?></a>
            </li>
        </ul>
        <!-- end block contact info -->
    </div>
</div>

