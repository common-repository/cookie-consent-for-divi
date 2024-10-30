<?php
/**
 * Divi Cookie Consent Customizer Sanitize
 *
 * @package     Divi Cookie Consent
 * @author      Divi People
 * @copyright   Copyright (c) 2019, Divi People
 * @link        https://divipeople.com/
 * @since       1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'DCC_Customizer_Sanitizes' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class DCC_Customizer_Sanitizes {

		/**
		 *  Member Varible
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * sanitize_hex_color
		 */
		static public function sanitize_hex_color( $color ) {

			if ( '' === $color ) {
				return '';
			}

			// 3 or 6 hex digits, or the empty string.
			if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
				return $color;
			}
			return '';
		}
	
	/**
	 * Sanitize Select choices
	 */
	static public function sanitize_choices( $input, $setting ) {

		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}


	}

}

DCC_Customizer_Sanitizes::get_instance();