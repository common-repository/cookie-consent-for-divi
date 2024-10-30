<?php
/**
 * Divi Cookie Consent Customizer Loader
 *
 * @package     Divi Cookie Consent
 * @author      Divi People
 * @copyright   Copyright (c) 2019, Divi People
 * @link        https://divipeople.com/
 * @since       1.0.0
 */

if ( ! class_exists( 'DCC_Customizer_Loader' ) ) {

	class DCC_Customizer_Loader {

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
			add_action( 'customize_preview_init', array( $this, 'preview_init' ) );
			add_action( 'customize_register',    array( $this, 'dcc_customize_register' ) );
		}

		function dcc_customize_register( $wp_customize ) {

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				'dcc-customizer-panel', array(
					'priority' => 55,
					'title' => __( 'Divi Cookie Consent', 'divi-cookie-consent' ),
				)
			);

			/**
			 * Sections
			 */
			$wp_customize->add_section(
				'dcc-general-section', array(
					'title'    => __( 'General', 'divi-cookie-consent' ),
					'panel'    => 'dcc-customizer-panel',
				)
			);

			$wp_customize->add_section(
				'dcc-content-section', array(
					'title'    => __( 'Content', 'divi-cookie-consent' ),
					'panel'    => 'dcc-customizer-panel',
				)
			);

			$wp_customize->add_section(
				'dcc-popup-section', array(
					'title'    => __( 'Color', 'divi-cookie-consent' ),
					'panel'    => 'dcc-customizer-panel',
				)
			);

			/**
			 * Settings
			 */
			
			$wp_customize->add_setting(
				'dcc_position', array(
					'default' => 'bottom',
					'type'		=> 'option',
					'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_choices' ),
				)
			);

			$wp_customize->add_control(
				'dcc_position', array(
					'type'		=> 'select',
					'section'	=> 'dcc-general-section',
					'label'		=> __( 'Position', 'divi-cookie-consent' ),
					'choices'	=> array(
						'bottom'	=> __( 'Default', 'divi-cookie-consent' ),
						'top'	=> __( 'Topbar', 'divi-cookie-consent' ),
						'bottom-left'	=> __( 'Floating Left', 'divi-cookie-consent' ),
						'bottom-right' => __( 'Floating Right', 'divi-cookie-consent' ),
					),
				)
			);

			$wp_customize->add_setting(
				'dcc_layout', array(
					'default'   => 'classic',
					'type'			=> 'option',
					'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_choices' ),
				)
			);

			$wp_customize->add_control(
				'dcc_layout', array(
					'type'		=> 'select',
					'section'	=> 'dcc-general-section',
					'label'		=> __( 'Layout', 'divi-cookie-consent' ),
					'default'   => 'block',
					'choices'	=> array(
						'block'			=> __( 'Block', 'divi-cookie-consent' ),
						'edgeless'	=> __( 'Edgeless', 'divi-cookie-consent' ),
						'classic'		=> __( 'Classic', 'divi-cookie-consent' ),
					),
				)
			);
			
			// DCC: Content
			$wp_customize->add_setting( 'dcc_content', array(
				'default'   => __( 'This site uses cookies. By continuing to use this website, you agree to their use. For details, please check our <a href="http://divipeople.com" target="_blank">Privacy Policy</a>', 'divi-cookie-consent' ),
				'type'      => 'option'
				)
			);

			$wp_customize->add_control( 'dcc_content', array(
				'type'        => 'textarea',
				'section'     => 'dcc-content-section',
				'label'       => __( 'Cookie Message', 'divi-cookie-consent' ),
				)
			);

			// DCC: Button Text
			$wp_customize->add_setting( 'dcc_button_text', array(
				'default'   => 'Allow cookies',
				'type'      => 'option'
				)
			);

			$wp_customize->add_control( 'dcc_button_text', array(
				'type'        => 'text',
				'section'     => 'dcc-content-section',
				'label'       => __( 'Button Text', 'divi-cookie-consent' ),
				'description' => __( '' ),
				)
			);

			// DCC : Popup Background
			$wp_customize->add_setting( 'dcc_popup_bg_color', array(
			  'default' => '#525ddc',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_popup_bg_color', array(
			  'label' => __( 'Popup Background Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

			// DCC : Popup text
			$wp_customize->add_setting( 'dcc_popup_text_color', array(
			  'default' => '#ffffff',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_popup_text_color', array(
			  'label' => __( 'Popup Text Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

			// DCC : Popup text link
			$wp_customize->add_setting( 'dcc_popup_text_link_color', array(
			  'default' => '#fff',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_popup_text_link_color', array(
			  'label' => __( 'Popup Text Link Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

			// DCC : Button Background
			$wp_customize->add_setting( 'dcc_btn_bg_color', array(
			  'default' => '#ffffff',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_btn_bg_color', array(
			  'label' => __( 'Button Background Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

			// DCC : Button Border
			$wp_customize->add_setting( 'dcc_btn_border_color', array(
			  'default' => '#ffffff',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_btn_border_color', array(
			  'label' => __( 'Button Border Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

			// DCC : Buttom Text
			$wp_customize->add_setting( 'dcc_btn_text_color', array(
			  'default' => '#525ddc',
				'type'		=> 'option',
				'transport'	=> 'postMessage',
			  'sanitize_callback' => array( 'DCC_Customizer_Sanitizes', 'sanitize_hex_color' ),
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control( 
				$wp_customize, 'dcc_btn_text_color', array(
			  'label' => __( 'Button Text Color', 'divi-cookie-consent' ),
			  'section' => 'dcc-popup-section',
			) ) );

		}

		function preview_init() {
			wp_enqueue_script( 'dcc-customizer-preview-js', DCC_PLUGIN_URL .'assets/js/customizer-preview.js' , array( 'customize-preview' ), '1.0.0', null );
		}

	}

	DCC_Customizer_Loader::get_instance();
}