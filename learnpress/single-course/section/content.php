<?php
/**
 * Template for displaying content and items of section in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/content.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $section ) ) {
	return;
}

$user = LP_Global::user();

?>

<?php if ( $items = $section->get_items() ) { ?>

    <ul class="section-content">

		<?php foreach ( $items as $item ) { ?>

            <li class="<?php echo join( ' ', $item->get_class() ); ?>">
				<?php
				if ( $item->is_visible() ) {
                    $post_type = 'item';
                    if ( empty( $count[ $post_type ] ) ) {
                        $count[ $post_type ] = 1;
                    } else {
                        $count[ $post_type ] ++;
                    }
				    ?>

                    <div class="meta-rank">
                        <div class="rank">
                            <span class="label"><?php echo esc_html($count[ $post_type ]);?>.</span>
                        </div>
                    </div>

                    <?php
					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/begin-section-loop-item', $item );

					if ( $user->can_view_item( $item->get_id() ) ) {
						?>
                        <a class="section-item-link" href="<?php echo esc_url($item->get_permalink()); ?>">
							<?php learn_press_get_template( 'single-course/section/content-item.php', array(
								'item'    => $item,
								'section' => $section
							) ); ?>
                        </a>
					<?php } else { ?>
                        <div class="section-item-link">
							<?php learn_press_get_template( 'single-course/section/content-item.php', array(
								'item'    => $item,
								'section' => $section
							) ); ?>
                        </div>
					<?php } ?>

					<?php
					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/end-section-loop-item', $item );
				}
				?>

            </li>

		<?php } ?>

    </ul>

<?php } else { ?>

	<?php learn_press_display_message( esc_html__( 'No items in this section', 'ivy-school' ) ); ?>

<?php } ?>