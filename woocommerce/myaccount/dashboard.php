<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account-dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );
	$user = wp_get_current_user();
	$fields = Brasa_WC_Extra_Fields::get_instance()->get_billing_fields();
?>
<section class="col-md-10 pull-left billing-data">
	<h4>
		<?php _e( 'Dados Pessoais', 'odin' );?>
	</h4>
	<?php foreach( $fields as $key => $name ) : ?>
		<div class="each-item">
			<div class="col-md-5 pull-left title">
				<?php echo $name;?>
			</div><!-- .col-md-5 pull-left title -->
			<div class="col-md-5 pull-right data">
				<?php if ( $key == 'email' ) : ?>
					<?php $value = $user->user_email;?>
				<?php else : ?>
					<?php $value = get_user_meta( $user->ID, $key, true );?>
					<?php if ( ! $value ) $value = '';?>
				<?php endif;?>
				<?php echo apply_filters( 'the_title', $value );?>
			</div><!-- .col-md-5 pull-right data -->
		</div><!-- .each-item -->
	<?php endforeach;?>
	<div class="text-right">
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/edit-account" class="btn btn-primary btn-cart-link">
			<?php _e( 'Editar', 'odin' );?>
		</a>
	</div><!-- .text-right -->
</section><!-- .col-md-10 pull-left billing-data -->
