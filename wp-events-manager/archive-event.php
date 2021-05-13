<?php
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-event/templates/archive-event.php
 *
 * @author 		ThimPress
 * @package 	tp-event/template
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="thim-all-events">

    <?php
    /**
     * tp_event_before_main_content hook
     *
     * @hooked tp_event_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked tp_event_breadcrumb - 20
     */
    do_action( 'tp_event_before_main_content' );
    ?>

    <?php
    /**
     * tp_event_archive_description hook
     *
     * @hooked tp_event_taxonomy_archive_description - 10
     * @hooked tp_event_room_archive_description - 10
     */
    do_action( 'tp_event_archive_description' );
    ?>

    <?php if ( have_posts() ) : ?>

        <?php
        /**
         * tp_event_before_event_loop hook
         *
         * @hooked tp_event_result_count - 20
         * @hooked tp_event_catalog_ordering - 30
         */
        do_action( 'tp_event_before_event_loop' );
        ?>

        <?php
        $_upcoming_query = thim_get_upcoming_events(3);
        if ( $_upcoming_query->have_posts() ) {
            ?>
            <div class="archive-events">
                <div class="item-featured">
                    <div class="slide-item-featured js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
                        <div class="slide-slick">
                            <?php
                            while ( $_upcoming_query->have_posts() ) :
                                $_upcoming_query->the_post();
                                ?>
                                <div class="item-event-slide">
                                    <?php echo thim_feature_image( get_post_thumbnail_id( get_the_ID()), 1329, 459, false );?>

                                    <div class="info-event">
                                        <?php
                                        $time         = wpems_get_time( 'Y-m-d H:i', null, false );
                                        $date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) );
                                        ?>
                                        <div class="tp_event_counter" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>"></div>

                                        <div class="title-event">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>

                                        <div class="meta-event">
                                    <span>
                                        <i class="ion ion-android-alarm-clock"></i>
                                        <?php echo wpems_event_start( 'H:i', null, false );?> -  <?php echo wpems_event_end( 'H:i', null, false );?>
                                    </span>

                                            <span>
														<i class="ion ion-android-calendar"></i>
                                                <?php echo wpems_event_start( 'M d, Y', null );?>
													</span>

                                            <span>
                                        <i class="ion ion-ios-location-outline"></i>
                                                <?php echo wpems_event_location();?>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php wp_reset_postdata(); ?>

        <div class="archive-events row">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php wpems_get_template_part( 'content', 'event' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div>

        <?php
        /**
         * tp_event_after_event_loop hook
         *
         * @hooked tp_event_pagination - 10
         */
        do_action( 'tp_event_after_event_loop' );
        ?>

    <?php endif; ?>

    <?php
    /**
     * tp_event_after_main_content hook
     *
     * @hooked tp_event_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'tp_event_after_main_content' );
    ?>

    <?php
    /**
     * tp_event_sidebar hook
     *
     * @hooked tp_event_get_sidebar - 10
     */
    do_action( 'tp_event_sidebar' );
    ?>

</div>