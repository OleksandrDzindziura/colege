<?php
/**
 * Template for displaying payment form for checkout page.
 *
 * Edit by Nhamdv
 *
 * This template can be overridden by copying it to yourtheme/learnpress/checkout/payment.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();

$available_gateways = LP_Gateways::instance()->get_available_payment_gateways();
?>

<div id="checkout-payment" class="lp-checkout-block left">
	<?php
	do_action( 'learn-press/before-payment-methods' );

	// Show payments if cart total > 0 and have at least one payment method.
	if ( LP()->cart->needs_payment() && $available_gateways ) {
		?>
		<h4>
			<?php esc_html_e( 'PAYMENT METHOD', 'course-builder' ); ?>
		</h4>

		<ul class="payment-methods">
			<?php
			$order = 1;

			foreach ( $available_gateways as $gateway ) {
				if ( $order == 1 ) {
					learn_press_get_template(
						'checkout/payment-method.php',
						array(
							'gateway'  => $gateway,
							'selected' => $gateway->id,
						)
					);
				} else {
					learn_press_get_template(
						'checkout/payment-method.php',
						array(
							'gateway'  => $gateway,
							'selected' => '',
						)
					);
				}
				$order ++;
			}
			?>
		</ul>
		<div id="checkout-order-action" class="place-order-action">

			<?php do_action( 'learn-press/before-checkout-submit-button' ); ?>

			<button type="submit" class="lp-button button alt" name="learn_press_checkout_place_order" id="learn-press-checkout-place-order">
				<?php echo apply_filters( 'learn-press/checkout-proceed-button-text', esc_html__( 'Place order', 'course-builder' ) ); ?>
			</button>

			<?php
			if ( is_user_logged_in() ) {
				wp_nonce_field( 'learn-press-user-logged', 'learn-press-checkout-nonce' );
			}

			do_action( 'learn-press/after-checkout-submit-button' );
			?>
		</div>
		<?php
	}

	do_action( 'learn-press/payment-form' );
	?>

	

	<?php do_action( 'learn-press/after-payment-form' ); ?>
</div>
