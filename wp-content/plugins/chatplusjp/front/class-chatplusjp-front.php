<?php
class CHATPLUSJP_Front {
	protected static $instance = null;

	private function __construct() {
		$plugin = CHATPLUSJP::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->cpj_system_setting = get_option('cpj_system_setting');

		add_action('wp_print_styles', array($this, 'wp_print_styles') );
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts') );
		add_action('wp_print_scripts', array($this, 'wp_print_scripts') );
		add_action('wp_print_footer_scripts', array($this, 'print_footer_scripts'), 99 );
	}
 
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}


	function wp_print_styles(){

	}

	function enqueue_scripts(){
		//wp_enqueue_style( 'front-css', CHATPLUSJP_PLUGIN_URL.'/front/assets/css/front.css' );
	}

	function wp_print_scripts(){

	}

	function print_footer_scripts(){
?>
		<script>
		(function(){
			var w=window,d=document;
			s=('https:' == document.location.protocol ? 'https://' : 'http://') + "app.chatplus.jp/cp.js";
			d["__cp_d"] = ('https:' == document.location.protocol ? 'https://' : 'http://') + "app.chatplus.jp";
			d["__cp_c"] = "<?php echo esc_html($this->cpj_system_setting['sitecode']); ?>";
			var a =d.createElement("script"), m=d.getElementsByTagName("script")[0];
			a.async=true,a.src=s,m.parentNode.insertBefore(a,m);
		})();
		</script>
<?php
	}

	
}