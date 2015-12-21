<?php

function zopimapi_game_id(){
    $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-)(.:,;";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}


function zopimapi_get_option( $option ) {
		$zopimapi_default_options = zopimapi_default_options();

		//Each game has the 
		$settings = get_option('zopimapi');
		switch($option){
		
			default:
				if (isset($settings[$option])){
					return $settings[$option];
				} else {
					if (isset($zopimapi_default_options[$option])){
					return $zopimapi_default_options[$option];
					}
				}
				break;
	
		}
	}

/* set a global option */
	function zopimapi_set_option($option, $newvalue){
		$settings = get_option('zopimapi');
		$settings[$option] = $newvalue;
		update_option('zopimapi', $settings);
	}

/* default options */
	function zopimapi_default_options(){
	
		$array['zopim_api_key'] = '';
		$array['zopim_api_secret'] = '';
		$array['zopim_api_trial_days'] = 14;
		$array['zopim_api_trial_plan'] = 'trial';
		$array['zopim_api_num_agents'] = 30;
		$array['zopim_api_user_exists'] = 'Ups, este usuario ya existe';
		$array['zopim_api_user_exists_link'] = '#';
		$array['admin_user'] = 'user';
		$array['admin_pass'] = '123456';
		$array['whcms_url'] = 'http://example.com';	
		
		return $array;
	}
	

	?>