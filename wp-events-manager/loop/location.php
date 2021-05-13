<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( wpems_event_location() ): ?>
    <div class="map">
		<?php wpems_get_location_map(); ?>
    </div>
<?php endif; ?>