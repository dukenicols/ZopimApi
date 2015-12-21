<?php

	/* Registers and display the shortcode */
	add_shortcode('zopimapi', 'zopimapi' );
	function zopimapi( $args=array() ) {
		global $post, $wp, $zopimapi_admin, $zopimapi;

		if (is_home()){
			$permalink = home_url();
		} else {
			if (isset($post->ID)){
				$permalink = get_permalink($post->ID);
			} else {
				$permalink = '';
			}
		}

		/* arguments */
		$defaults = apply_filters('zopimapi_shortcode_args', array(
		
			'plantilla' => null
			
		) );
		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );
		
		if ($plantilla) :
		
		STATIC $i = 0;
	
		ob_start();

		/* increment wall */
		$i = rand(1, 1000);

		/* user template */
		
		
		switch($plantilla) {
			
			case 'formulario':
				zopimapi_form_style();
				include zopimapi_path . "paneles/formulario.php";
				break;
				
		}
		
		
		
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;
		endif;
	}