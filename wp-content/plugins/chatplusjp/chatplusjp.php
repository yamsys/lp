<?php
/*
Plugin Name: CHATPLUSJP
Plugin URI:
Description: This plugin add chatplus your page.
Version: 1.0.0
Author: chatplusjp
Author URI:https://chatplus.jp/
*/

define( 'CHATPLUSJP_VERSION', "1.0.0.201702181");
define( 'CHATPLUSJP_SLUG', 'chatplusjp' );
define( 'CHATPLUSJP_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)) );
define( 'CHATPLUSJP_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) );
define( 'CHATPLUSJP_PLUGIN_FOLDER', dirname(plugin_basename(__FILE__)) );
define( 'CHATPLUSJP_PLUGIN_BASENAME', plugin_basename(__FILE__) );

require_once( CHATPLUSJP_PLUGIN_DIR . '/class-chatplusjp.php' );
require_once( CHATPLUSJP_PLUGIN_DIR . '/common/function.php' );

CHATPLUSJP::load_textdomain();

register_activation_hook( __FILE__, array( 'CHATPLUSJP', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CHATPLUSJP', 'deactivate' ) );

add_action( 'plugins_loaded', array('CHATPLUSJP', 'get_instance') );

if( is_admin() ){
	require_once( CHATPLUSJP_PLUGIN_DIR . '/admin/class-chatplusjp-admin.php' );
	add_action('plugins_loaded', array('CHATPLUSJP_Admin', 'get_instance'));

	require_once( CHATPLUSJP_PLUGIN_DIR . '/admin/class-admin-page.php' );

	require_once( CHATPLUSJP_PLUGIN_DIR . '/admin/class-admin-setting.php' );
	add_action('plugins_loaded', array('CHATPLUSJP_Setting', 'get_instance'));

}else{
	require_once( CHATPLUSJP_PLUGIN_DIR . '/front/class-chatplusjp-front.php' );
	add_action('plugins_loaded', array('CHATPLUSJP_Front', 'get_instance'));

}
