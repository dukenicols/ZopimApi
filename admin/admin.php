<?php

class zopimapi_admin {

	var $options;

	function __construct() {
	
		/* Plugin slug and version */
		$this->slug = 'zopimapi';
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$this->plugin_data = get_plugin_data( zopimapi_path . 'index.php', false, false);
		$this->version = $this->plugin_data['Version'];
		
		/* Priority actions */
		add_action('admin_menu', array(&$this, 'add_menu'), 10);
		add_action('admin_enqueue_scripts', array(&$this, 'add_styles'), 10);
		add_action('admin_head', array(&$this, 'admin_head'), 10 );
		add_action('admin_init', array(&$this, 'admin_init'), 10);
		
	}

	
	function admin_init() {
		
		
		
		$this->tabs = array();
		
		
			$this->tabs['zopimapi'] = 'Opciones';
		
		$this->default_tab = 'zopimapi';
		
		$this->options = get_option('zopimapi');
		if (!get_option('zopimapi')) {
			update_option('zopimapi', zopimapi_default_options() );
		}
		
	}
	
	
	
	function admin_head(){
		$screen = get_current_screen();
		$slug = $this->slug;
		$icon = zopimapi_url . "admin/images/$slug-32.png";
		echo '<style type="text/css">';
			if (in_array( $screen->id, array( $slug ) ) || strstr($screen->id, $slug) ) {
				print "#icon-$slug {background: url('{$icon}') no-repeat left;}";
			}
		echo '</style>';
	}

	function add_styles(){
	
		wp_register_style('zopimapi_admin', zopimapi_url.'admin/css/admin.css');
		wp_enqueue_style('zopimapi_admin');
		
		
		wp_register_style('zopimapi_admin_fa', zopimapi_url . $css);
		wp_enqueue_style('zopimapi_admin_fa');
		
		
		
		wp_register_script('zopimapi_chosen', zopimapi_url . 'admin/scripts/admin-chosen.js');
		wp_enqueue_script('zopimapi_chosen');
		
		
		
		wp_register_script( 'zopimapi_admin', zopimapi_url.'admin/scripts/admin.js', array( 
			'jquery',
			'jquery-ui-core',
			'jquery-ui-draggable',
			'jquery-ui-droppable',
			'jquery-ui-sortable'
		) );
		wp_enqueue_script( 'zopimapi_admin' );
		
	}
	
	function add_menu() {
	
		$menu_label = __('Zopim API','zopimapi');
		
		
		add_menu_page( __('Zopim API','zopimapi'), $menu_label, 'manage_options', $this->slug, array(&$this, 'admin_page'), zopimapi_url .'admin/images/'.$this->slug.'-16.png');
		
		
	
	}

	function admin_tabs( $current = null ) {
			$tabs = $this->tabs;
			$links = array();
			if ( isset ( $_GET['tab'] ) ) {
				$current = $_GET['tab'];
			} else {
				$current = $this->default_tab;
			}
			foreach( $tabs as $tab => $name ) :
				if ( $tab == $current ) :
					$links[] = "<a class='nav-tab nav-tab-active' href='?page=".$this->slug."&tab=$tab'>$name</a>";
				else :
					$links[] = "<a class='nav-tab' href='?page=".$this->slug."&tab=$tab'>$name</a>";
				endif;
			endforeach;
			foreach ( $links as $link )
				echo $link;
	}

	function get_tab_content() {
		$screen = get_current_screen();
		if( strstr($screen->id, $this->slug ) ) {
			if ( isset ( $_GET['tab'] ) ) {
				$tab = $_GET['tab'];
			} else {
				$tab = $this->default_tab;
			}
			require_once zopimapi_path.'admin/panels/'.$tab.'.php';
		}
	}
	

		
	
	/* Guarda la configuracion */
	function save() {
		
		
		/* other post fields */
		foreach($_POST as $key => $value) {
			if ($key != 'submit') {
				if (!is_array($_POST[$key])) {
					$this->options[$key] = stripslashes( esc_attr($_POST[$key]) );
				} else {
					$this->options[$key] = $_POST[$key];
				}
			}
		}
		
		update_option('zopimapi', $this->options);
		echo '<div class="updated"><p><strong>'.__('Cambios guardados.','zopimapi').'</strong></p></div>';
	}

	function reset() {
		update_option('zopimapi', zopim_default_options() );
		$this->options = array_merge( $this->options, zopimapi_default_options() );
		echo '<div class="updated"><p><strong>'.__('Se ha reestablecido la configuraci&oacute;n.','zopimapi').'</strong></p></div>';
	}
	
	

	function admin_page() {
	
		
		
		if (isset($_POST['submit'])) {
			$this->save();
		}
		
		
		if (isset($_POST['reset-options'])) {
			$this->reset();
		}
		
	
		
	?>
	
		<div class="wrap <?php echo $this->slug; ?>-admin">
		
			<?php zopimapi_admin_bar(); ?>
			
			<h2 class="nav-tab-wrapper"><?php $this->admin_tabs(); ?></h2>

			<div class="<?php echo $this->slug; ?>-admin-contain">
				
				<?php $this->get_tab_content(); ?>
				
				<div class="clear"></div>
				
			</div>
			
		</div>

	<?php }

}

$zopimapi_admin = new zopimapi_admin();