<?php
/**
 * Template for displaying loop course of section.
 *
 * @author  ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$cls_active = $active;
if($current_item = LP_Global::course_item()) {
    $items    = $section->get_items_array();
    $item_ids = wp_list_pluck( $items, 'id' );
    $cls_active = in_array( $current_item->get_id(), $item_ids ) ? "active-accordion" : "";
}
if ( ! isset( $section ) ) {
	return;
}
?>

<div class="section js-call-accordion <?php if($cls_active) echo 'active-accordion';?>" id="section-<?php echo esc_attr( $section->get_id() ); ?>"
    data-id="<?php echo esc_attr( $section->get_id() ); ?>">

	<?php
	/**
	 * @since  3.0.0
	 *
	 * @see learn_press_curriculum_section_title - 5
	 * @see learn_press_curriculum_section_content - 10
	 */
	do_action( 'learn-press/section-summary', $section ); ?>

</div>