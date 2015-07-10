<?php
/*
Plugin Name: OGP Generator
Version: 0.5.2
Description: Generates your OGP with simple configurations.
Author: Shinichi Nishikawa
Author URI: http://th-daily.shinichi.me
Plugin URI: http://th-daily.shinichi.me
Text Domain: ogp-generator
Domain Path: /languages
*/

load_plugin_textdomain( 'ogp-generator', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

// Setting API
add_action( 'admin_init', 'nskw_ogp_settings' );
function nskw_ogp_settings() {

	// Add section to /wp-admin/options-reading.php
	add_settings_section(
		'ogp_settings', 
		__( 'OGP Settings', 'ogp-generator' ), 
		'nskw_add_settings_section', 
		'reading' 
	);

	// Add OGP image field
	add_settings_field(
		'nskw_ogp_img',
		__( 'Default Image', 'ogp-generator' ),
		'nskw_ogp_img_field',
		'reading',
		'ogp_settings'
	);

	// Add App ID field
	add_settings_field(
		'nskw_ogp_app_id',
		__( 'App ID/fb:admins ID', 'ogp-generator' ),
		'nskw_app_id_field',
		'reading',
		'ogp_settings'
	);
	
	// Add a select box
	add_settings_field(
		'nskw_ogp_id_select',
		__( 'App ID/fb:admins ID', 'ogp-generator' ),
		'nskw_ogp_id_select_field',
		'reading',
		'ogp_settings'
	);

	// Register ids
	register_setting( 'reading', 'nskw_ogp_img',       'esc_url' );
	register_setting( 'reading', 'nskw_ogp_app_id',    'nskw_intval' );
	register_setting( 'reading', 'nskw_ogp_id_select', 'nskw_white_list' );
	
}

// Section function.
function nskw_add_settings_section() {
	_e( 'Upload a default image and set facebook id.', 'ogp-generator' );
}

// input for img url
function nskw_ogp_img_field() {
	?>
	<input name="nskw_ogp_img" id="nskw_ogp_img" type="text" value="<?php form_option('nskw_ogp_img'); ?>" /><br />
	<?php
	printf( 
		__( 'Url of the default image.<br />This image will be used in all pages except posts/pages/cutom posts with post thumbnails.<br />At least 600x315 pixels, but it\'s better to have a bigger one. Recommendation is 1200×630 pixels.<br />You can upload your image <a target="_blank" href="%s" target="_blank">at your "add new media" page</a>.', 'ogp-generator' ), 
		admin_url( 'media-new.php' )
	);
	
}

// input for id url
function nskw_app_id_field() {
	?>
	<input name="nskw_ogp_app_id" id="nskw_ogp_app_id" type="text" value="<?php form_option('nskw_ogp_app_id'); ?>" /><br />
	<?php
	_e( 'Input your facebook App ID. Your App ID can be found <a href="https://www.facebook.com/help/community/question/?id=372967692803654">here.</a>', 'ogp-generator' );
}

// select box
function nskw_ogp_id_select_field() {
	$options = get_nskw_white_list();
	$value   = get_option( 'nskw_ogp_id_select' );
	echo '<select name="nskw_ogp_id_select" id="nskw_ogp_id_select">';	
	foreach ( $options as $o ) {
		$selected = ( $o == $value ) ? ' selected="selected"' : '';
		?>
		<option value="<?php echo esc_attr($o); ?>"<?php echo $selected; ?>><?php echo esc_html($o); ?></option>
		<?php
	}
	echo '</select>';
}


// intval and if false returns false, not 0.
function nskw_intval( $id ) {
	
	if ( $sanitized = intval($id) ) {
		return $sanitized;
	} else {
		return false;
	}
	
}

// white list of app/fb
function nskw_white_list( $text ) {
	
	$fff = get_nskw_white_list();
	
	return in_array( $text, $fff ) ? $text: false;
	
}

function get_nskw_white_list() {
	$array = array( 'fb:app_id', 'fb:admins' );
	return $array;
}

require_once( 'inc/output.php' );
