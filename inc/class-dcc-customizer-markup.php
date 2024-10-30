<?php
/**
 * Divi Cookie Consent Customizer Markup
 *
 * @package     Divi Cookie Consent
 * @author      Divi People
 * @copyright   Copyright (c) 2019, Divi People
 * @link        https://divipeople.com/
 * @since       1.0.0
 */

if ( ! class_exists( 'DCC_Markup' ) ) {

	class DCC_Markup {

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
			add_action( 'wp_head', array( $this, 'dcc_custom_style' ) );
			add_action( 'wp_footer', array( $this, 'dcc_custom_script' ), 99999);
		}

		public function dcc_custom_style() {

			$dcc_popup_text_link_color = get_option( 'dcc_popup_text_link_color' );

		?>

			<style type="text/css" id="dcc-cookies-css">
				.cc-message a {
					color: <?php echo $dcc_popup_text_link_color; ?> !important;
				}
			</style>

		<?php

	}

		public function dcc_custom_script() {

			$dcc_position =	get_option( 'dcc_position' );
			$dcc_layout	=	get_option( 'dcc_layout' );
			$dcc_content	=	get_option( 'dcc_content', 'This site uses cookies. By continuing to use this website, you agree to their use. For details, please check our <a href="http://divipeople.com" target="_blank">Privacy Policy</a>');
			$dcc_button_text = get_option( 'dcc_button_text', 'Got it');
			$dcc_popup_bg_color = get_option( 'dcc_popup_bg_color' );
			$dcc_popup_text_color = get_option( 'dcc_popup_text_color' );
			$dcc_btn_bg_color = get_option( 'dcc_btn_bg_color' );
			$dcc_btn_border_color = get_option( 'dcc_btn_border_color' );
			$dcc_btn_text_color = get_option( 'dcc_btn_text_color' );

			// If top then bar static
			$dcc_static = ( 'top' === $dcc_position ) ? 'true' : 'false';

		?>
			<script type="text/javascript" id="dcc-cookies-js">
				window.addEventListener("load", function(){
				window.cookieconsent.initialise({
				  "palette": {

				    "popup": {
				      "background": "<?php echo $dcc_popup_bg_color; ?>",
				      "text": "<?php echo $dcc_popup_text_color; ?>"
				    },

				    "button": {
				      "background": "<?php echo $dcc_btn_bg_color; ?>",
				      "text": "<?php echo $dcc_btn_text_color; ?>",
				      "border": "<?php echo $dcc_btn_border_color; ?>",
				    }
				  },
 					"theme": "<?php echo $dcc_layout; ?>",
  				"position": "<?php echo $dcc_position; ?>",
  				"static": <?php echo $dcc_static; ?>,
				  "content": {
				    "message": '<?php echo $dcc_content; ?>',
				    "dismiss": '<?php echo $dcc_button_text; ?>',
				    "link": false,
				  },
				})
			});
			</script>

		<?php

		}
	}
	
	DCC_Markup::get_instance();

}
