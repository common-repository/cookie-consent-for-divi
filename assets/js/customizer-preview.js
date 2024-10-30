/**
 * Add F
 */
function dcc_add_dynamic_css( control, style ) {

	control = control.replace( '[', '-' );
	control = control.replace( ']', '' );

	jQuery( 'style#' + control ).remove();

	jQuery( 'head' ).append(
		'<style id="' + control + '">' + style + '</style>'
	);

}

/*
 * Popup Background Color
 */
wp.customize( 'dcc_popup_bg_color', function( setting ) {
	setting.bind( function( popup_bg_color ){
	if ( popup_bg_color != '') {
		var dynamicStyle = '.cc-window { background-color: ' + popup_bg_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_popup_bg_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );


/*
 * Popup Text Color
 */
wp.customize( 'dcc_popup_text_color', function( setting ) {
	setting.bind( function( popup_text_color ){
	if ( popup_text_color != '') {
		var dynamicStyle = '.cc-window { color: ' + popup_text_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_popup_text_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );

/*
 * Popup Text Color
 */
wp.customize( 'dcc_popup_text_link_color', function( setting ) {
	setting.bind( function( popup_text_link_color ){
	if ( popup_text_link_color != '') {
		var dynamicStyle = '.cc-message a { color: ' + popup_text_link_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_popup_text_link_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );

/*
 * Button Background Color
 */
wp.customize( 'dcc_btn_bg_color', function( setting ) {
	setting.bind( function( btn_bg_color ){
	if ( btn_bg_color != '') {
		var dynamicStyle = '.cc-btn { background-color: ' + btn_bg_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_btn_bg_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );

/*
 * Button Background Color
 */
wp.customize( 'dcc_btn_border_color', function( setting ) {
	setting.bind( function( btn_border_color ){
	if ( btn_border_color != '') {
		var dynamicStyle = '.cc-btn { border-color: ' + btn_border_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_btn_border_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );


/*
 * Button Text Color
 */
wp.customize( 'dcc_btn_text_color', function( setting ) {
	setting.bind( function( btn_text_color ){
	if ( btn_text_color != '') {
		var dynamicStyle = '.cc-btn { color: ' + btn_text_color + ' !important }';
		dcc_add_dynamic_css( 'dcc_btn_text_color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	});
} );