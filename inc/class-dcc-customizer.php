<?php 

if ( ! class_exists( 'DCC_CUSTOMIZER' ) ) {

	class DCC_Customizer {

		/**
		 * Member Varible
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			require_once dirname(__FILE__) . '/class-dcc-custonizer-sanitize.php';
			require_once dirname(__FILE__) . '/class-dcc-customizer-loader.php';
			require_once dirname(__FILE__) . '/class-dcc-customizer-markup.php';
		}

	}

	DCC_Customizer::get_instance();
}