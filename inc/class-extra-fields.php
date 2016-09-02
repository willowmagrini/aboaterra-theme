<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	/**
	 * Brasa WooCommerce Extra fields
	 *
	 */
	class Brasa_WC_Extra_Fields {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin
		 */
		public function __construct() {
			add_action( 'woocommerce_after_checkout_billing_form', array( $this, 'add_checkout_billing_fields' ), 9999 );
			add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'add_checkout_billing_fields' ) );
		}

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
		/**
		 * Add fields to checkout billing section
		 * @param object $checkout
		 * @return null
		 */
		public function add_checkout_billing_fields( $checkout ) {
			if ( ! is_user_logged_in() ) {
				return;
			}
			$default_value = '';
			if ( $value = get_user_meta( get_current_user_id(), 'cpf', true ) ) {
				$default_value = $value;
			}
			woocommerce_form_field( 'cpf', array(
				'type'          => 'text',
				'class'         => array( 'form-row-wide' ),
				'label'         => __('CPF/CNPJ', 'odin' ),
				'required'		=> true
			), $default_value );
		}
		/**
		 * Save checkout fields
		 * @param int $order_id
		 * @return null
		 */
		public function save_checkout_fields( $order_id ) {
			if ( ! is_user_logged_in() ) {
				return;
			}
			if ( isset( $_POST[ 'cpf'] ) && ! empty( $_POST[ 'cpf'] ) ) {
				update_post_meta( get_current_user_id(), 'cpf', $_POST[ 'cpf' ] );
			}
		}
		public function get_billing_fields() {
			$fields = array();
			$fields[ 'billing_first_name' ] = __( 'Nome', 'odin' );
			$fields[ 'billing_last_name'] = __( 'Sobrenome', 'odin' );
			$fields[ 'email' ] = __( 'Email', 'odin' );
			$fields[ 'cpf' ] = __( 'CPF/CNPJ', 'odin' );
			$fields[ 'billing_phone' ] = __( 'Telefone', 'odin' );
			return $fields;
		}
	}
	new Brasa_WC_Extra_Fields();
