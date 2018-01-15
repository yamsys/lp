<?php
class CHATPLUSJP_Admin_Page {
	public $action_status, $action_message;
	public $error_message = array();

	protected $menu_slug = array();
	protected $submenu_slug = array();

	protected $plugin_screen_hook_suffix = null;

	public function __construct() {
		$plugin = CHATPLUSJP::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$admin = CHATPLUSJP_Admin::get_instance();
		$this->menu_slug = $admin->get_toplevel_menu_slug();
		$this->submenu_slug = $admin->get_submenu_slug();
//		$this->clear_action_status();
		/*******************************************/

		add_action( 'admin_head', array( $this, 'add_admin_head' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_print_styles', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

		//スクリーン自体の表示・非表示
		add_filter( 'screen_options_show_screen', array( $this, 'admin_show_screen' ), 10, 2 );

		//スクリーンの表示件数取得
		add_filter( 'set-screen-option', array( $this, 'admin_set_screen_options' ), 10, 3 );

		add_filter( 'contextual_help', array( $this, 'admin_help_setting' ), 900, 3 );
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_page_scripts' ) );
		add_action( 'admin_footer', array( $this, 'clear_action_status' ) );
	}

	/***********************************
	 * Initial setting.
	 *
	 * @since     1.0.0
	 ***********************************/


	/***********************************
	 * Add a tab to the Contextual Help menu in an admin page.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function admin_help_setting( $help, $screen_id, $screen ) {

	}

	/***********************************
	 * Register and enqueue admin-specific header processing.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function add_admin_head() {
		//if( $this->action_status == 'edit' || $this->action_status == 'editpost' ) {
	//		add_thickbox();
		//}
	}

	/***********************************
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function enqueue_admin_styles() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		global $wp_scripts;
		$screen = get_current_screen();

		if( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', CHATPLUSJP_PLUGIN_URL.'/admin/assets/css/admin.css', array(), CHATPLUSJP_VERSION );

			$ui = $wp_scripts->query( 'jquery-ui-core' );
			$url = "//ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/redmond/jquery-ui.min.css";
			wp_enqueue_style( 'jquery-ui-redmond', $url, false, null );
		}
	}

	/***********************************
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function enqueue_admin_scripts() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		$screen = get_current_screen();

		if( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( 'jquery-color' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'jquery-ui-dialog' );
		}
	}

	/***********************************
	 * 表示オプションの表示制御
	 * @since    1.0.0
	 *
	 * NOTE:  $show_screen = 1は表示オプションを表示、0は非表示
	 ***********************************/
	public function admin_show_screen( $show_screen, $screen ) {
		return $show_screen;
	}

	/***********************************
	 * リストの表示件数取得
	 * @since    1.0.0
	 *
	 * NOTE:  screen_options_show_screen にフックして、保存されたリストの表示件数を適用
	 ***********************************/
	public function admin_set_screen_options( $result, $option, $value ) {
//		$screens = array( self::$per_page_slug );
//		if( in_array( $option, $screens ) )
//			$result = $value;
//
		return $result;
	}

	/***********************************
	 * Add a sub menu page.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function add_admin_menu() {

	}

	/***********************************
	 * Setting of action status.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function set_action_status( $status, $message ) {
		$this->action_status = $status;
		$this->action_message = $message;
		$_SESSION[$this->plugin_slug]['action_status'] = $status;
		$_SESSION[$this->plugin_slug]['action_message'] = $message;
	}

	/***********************************
	 * Initialization of action status.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function clear_action_status() {
		$this->action_status = 'none';
		$this->action_message = '';
		$_SESSION[$this->plugin_slug]['action_status'] = 'none';
		$_SESSION[$this->plugin_slug]['action_message'] = '';
	}

	/*******************************
	 * The function to be called to output the common script source for this page.
	 *
	 * @since    1.0.0
	 *******************************/
	public function admin_scripts() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		$screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix != $screen->id )
			return;
?>
<script type="text/javascript">

</script>
<?php
	}

	/*******************************
	 * The function to be called to output the script source for this page.
	 *
	 * @since    1.0.0
	 *******************************/
	public function admin_page_scripts() {

	}
}