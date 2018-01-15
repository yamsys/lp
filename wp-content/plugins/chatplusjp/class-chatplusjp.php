<?php
class CHATPLUSJP {
	protected $plugin_slug = 'chatplusjp';

	protected static $instance = null;

	private function __construct() {
		add_action('wp_print_styles', array($this, 'wp_print_styles') );
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts') );
		add_action('wp_print_scripts', array($this, 'wp_print_scripts') );
	//	add_action('wp_print_footer_scripts', array($this, 'print_footer_scripts') );
	}
 
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	public static function load_textdomain(){

	}

	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide  ) {
				$blog_ids = self::get_blog_ids();
				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();

					restore_current_blog();
				}
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	public static function deactivate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				$blog_ids = self::get_blog_ids();
				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_deactivate();
					restore_current_blog();
				}
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	public function activate_new_site( $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}
		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	private static function get_blog_ids() {
		global $wpdb;

		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );
	}


	private static function single_activate() {
		$old = get_option('cpj_system_setting');
		$new['sitecode'] = isset($old['sitecode']) ? $old['sitecode']: '';
		
		$res = update_option('cpj_system_setting', $new);
	}

	private static function single_deactivate() {
	}

	function wp_print_styles(){

	}

	function enqueue_scripts(){
		//wp_enqueue_style( 'cs-css', CHATPLUSJP_PLUGIN_URL.'/common/css/custom.css' );
	}

	function wp_print_scripts(){
		
	}
}