<?php
/**
 * Template for displaying rating stars.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/rating-stars.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
$non_star = 5 - intval($rated);
?>
<div class="star">
    <?php for ($i=0;$i<intval($rated);$i++) {?>
        <i class="fa fa-star"></i>
    <?php }?>
    <?php for ($j=0;$j<intval($non_star);$j++) {?>
        <i class="fa fa-star-o"></i>
    <?php }?>
</div>