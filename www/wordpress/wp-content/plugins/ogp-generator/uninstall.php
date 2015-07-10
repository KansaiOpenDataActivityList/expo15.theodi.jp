<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$options = array(
	'nskw_ogp_img',
	'nskw_ogp_app_id',
	'nskw_ogp_id_select',
);

foreach ( $options as $o ) {
	delete_option( $o );
}
