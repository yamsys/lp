<?php
class CHATPLUSJP_Setting extends CHATPLUSJP_Admin_Page {

	protected static $instance = null;

	//screen_optionに設定
	public static $per_page_slug = 'system_setting_page';

	protected $mode = '';
	protected $page = '';
	protected $title = '';

	private $file = '';
	private $id = '';
	private $encode_type = 0;
	private $values = array();
	private $log = '';
	private $log_line = '';
	private $data_rows = 0;
	private $success = 0;
	private $false = 0;

	/***********************************
	 * Constructor
	 *
	 * @since     1.0.0
	 ***********************************/
	public function __construct() {
		parent::__construct();
	}

	/***********************************
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 ***********************************/
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/***********************************
	 * Initial setting.
	 *
	 * @since     1.0.0
	 ***********************************/
	protected function init() {
		$this->title = '';
	}

	/***********************************
	 * Add a tab to the Contextual Help menu in an admin page.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function admin_help_setting( $help, $screen_id, $screen ) {
	}

	/***********************************
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 ***********************************/
	public function enqueue_admin_styles() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		parent::enqueue_admin_styles();
		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			//wp_enqueue_style( $this->plugin_slug .'_admin_coupon_styles', plugins_url( 'assets/css/admin-setting.css', __FILE__ ), array(), CHATPLUSJP_VERSION );
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

		parent::enqueue_admin_scripts();
		//wp_enqueue_script( 'jquery-ui-datepicker' );

	}

	/***********************************
	 * 表示オプションの表示制御
	 * @since    1.0.0
	 *
	 * NOTE:  $show_screen = 1は表示オプションを表示、0は非表示
	 ***********************************/
/*
	public function admin_show_screen( $show_screen, $screen ){
		if( !isset( $screen->id ) || false === strpos( $screen->id,  $this->plugin_slug .'_management' ) )
			return $show_screen;

		if( isset($_REQUEST['action']) && '-1' != $_REQUEST['action'] ){
			$action = $_REQUEST['action'];
		}elseif( isset($_REQUEST['action2']) && '-1' != $_REQUEST['action2'] ){
			$action = $_REQUEST['action2'];
		}else{
			$action = 'list';
		}

		switch( $action ){
			case 'new' :
			case 'edit':
				$show_screen = 0;
				break;
			case '-1':
			case 'list':
			case 'delete':
			case 'delete_batch':
			default :
				$show_screen = 1;
				break;
		}
		return $show_screen;
	}
*/

	/***********************************
	 * リストの表示件数取得
	 * @since    1.0.0
	 *
	 * NOTE:  screen_options_show_screen にフックして、保存されたリストの表示件数を適用
	 ***********************************/
	public function admin_set_screen_options( $result, $option, $value ){
		$list_screens = array( self::$per_page_slug );

		if( in_array( $option, $list_screens ) )
			$result = $value;

		return $result;
	}

	/***********************************
	 * Add a sub menu page.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function add_admin_menu() {
		$menu1_slug = $this->menu_slug['menu1'];
		$this->plugin_screen_hook_suffix = add_menu_page(__( 'CHATPLUSJP', 'cpj' ), __( 'CHATPLUSJP', 'cpj' ), 'activate_plugins', $menu1_slug, array( $this, 'read_plugin_page'), 'dashicons-tickets', '3.5' );
		add_action( 'load-' . $this->plugin_screen_hook_suffix, array( $this, 'load_plugin_action' ) );
	}

	/***********************************
	 * Runs when an administration menu page is loaded.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function load_plugin_action() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		$current_screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix != $current_screen->id )
			return;

		if( isset($_REQUEST['action']) && '-1' != $_REQUEST['action'] ) {
			$this->mode = $_REQUEST['action'];
		} elseif( isset($_REQUEST['action2']) && '-1' != $_REQUEST['action2'] ) {
			$this->mode = $_REQUEST['action2'];
		} else {
			$this->mode = 'view';
		}

		//set_action
		if( isset($_SESSION[$this->plugin_slug]['action_status']) && isset($_SESSION[$this->plugin_slug]['action_message']) ){
			$action_status = $_SESSION[$this->plugin_slug]['action_status'];
			$action_message = $_SESSION[$this->plugin_slug]['action_message'];

			$this->set_action_status($action_status, $action_message );
		}

		switch( $this->mode ) {
		case 'up':
			if( isset($_POST['cpj_save']) ){
				check_admin_referer( 'cpj_setting', 'cpj_nonce' );

				$this->error_message = array();

				$sitecode = isset($_POST['sitecode']) ? $_POST['sitecode']: '';

/*
				if( strlen($ref_url) == 0 ){
					$this->error_message[] = __('Javascriptが未入力です。', 'cpj');
				}
*/

				if( array() == $this->error_message ){
					$cpj_system_setting = array(
												'sitecode' => $sitecode
											);

					$res = update_option('cpj_system_setting', $cpj_system_setting);

					if ( $res ) {
						$this->set_action_status('success', __('保存が完了しました。','cpj'));

					}else{
						$this->set_action_status('error', __('保存に失敗しました。','cpj'));
					}
				}else{
					$this->set_action_status('error', __('保存に失敗しました。','cpj'));
				}
			}
			$this->page = 'system-setting';
			break;
		case 'view':
		default:
			$this->page = 'system-setting';
			break;
		}
	}

	/***********************************
	 * The function to be called to output the content for this page.
	 *
	 * @since    1.0.0
	 ***********************************/
	public function read_plugin_page() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		$screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix != $screen->id )
			return;

		if( !empty($this->page) ) {
			if( $this->page == 'system-setting' ) {
				$status = $this->action_status;
				$message = $this->action_message;
				$error_message = $this->error_message;
				$this->clear_action_status();
				$this->error_message = array();

				$cpj_system_setting = get_option('cpj_system_setting');
			}else{
				$status = $this->action_status;
				$message = $this->action_message;
				$error_message = $this->error_message;
				$this->clear_action_status();
				$this->error_message = array();
			}
			require_once( CHATPLUSJP_PLUGIN_DIR.'/admin/views/'.$this->page.'.php' );
		}
	}

	public function error_message_e($error_message){
		$res ='';
		if(!empty($error_message)){
			$res = '<ul class="error_message_list">';
			foreach($error_message as $mes){
				$res .= '<li>'.esc_html($mes).'</li>';
			}
			$res .= '</ul>';
		}
		echo $res;
	}
	
	public function admin_page_scripts() {
		if( !isset( $this->plugin_screen_hook_suffix ) )
			return;

		$screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix != $screen->id )
			return;

		ob_start();
?>
<script type="text/javascript">
jQuery(function($){
<?php if('system-setting' === $this->page) : ?>



<?php endif; ?>
});
</script>
<?php
		$html = ob_get_contents();
		ob_end_clean();
		echo $html;
	}

}
