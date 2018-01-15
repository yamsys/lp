<?php
class CHATPLUSJP_Admin {
	protected static $instance = null;

	protected $menu_slug = array();
	protected $submenu_slug = array();

	private function __construct() {
		$plugin = CHATPLUSJP::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Set the Top-level menu slug.
		$this->menu_slug['menu1'] = $this->plugin_slug . '_management';
		$this->submenu_slug['menu1']['sub1'] = $this->plugin_slug . '_setting';
		//$this->submenu_slug['menu1']['sub2'] = $this->plugin_slug . '_list';
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function get_toplevel_menu_slug() {
		return $this->menu_slug;
	}

	public function get_submenu_slug(){
		return $this->submenu_slug;
	}
}
