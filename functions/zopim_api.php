<?php

function zopimapi_api_addclient($data = array()){
		
	date_default_timezone_set('GMT'); 
	$date = date('D, d M Y H:i:s e');
	
	$api_token   = zopimapi_get_option('zopim_api_key');
	$api_secret  = zopimapi_get_option('zopim_api_secret');
	$trialPlan   = zopimapi_get_option('zopim_api_trial_plan');
	$trialAgents = zopimapi_get_option('zopim_api_num_agents');
	
	extract($data);
	
	// Some paramters
	$method = 'POST';
	$host   = 'reseller.zopim.com';
	$uri    = '/api/accounts';
	
	$content = json_encode(
					array(
						'first_name' => $nombre, 
						'last_name'  => $apellido, 
						'email' 	 => $email, 
						'plan'	 	 => $trialPlan, 
						'agents' 	 => $trialAgents, 
						'password'   => $pass
						)
				);
	$md5_content = base64_encode(md5($content,true));

	$string_to_sign = $method . "\n" . $md5_content . "\n" . $date  . "\n" . $uri;
		
	// Calculate HMAC with SHA1 and base64-encoding
	$signature = base64_encode( hash_hmac( 'sha1', utf8_encode($string_to_sign), $api_secret, TRUE ) );
		
	
	// Create request
	$request = 'https://' . $host . $uri;  
		
    $headr = array();
	$headr[] = 'Authorization: Zopim-Reseller-API ' .$api_token.':'.$signature;
	$headr[] = 'API-Date: ' . $date;
	     
	    
    // Do request
    $ch = curl_init( $request );
	curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);  
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
	
    $response = curl_exec( $ch );
    curl_close( $ch );
	
	return json_decode($response, true);
}

function zopimapi_api_sso_request($email){
	date_default_timezone_set('GMT'); 
	$date = date('D, d M Y H:i:s e');
	
	$api_token   = zopimapi_get_option('zopim_api_key');
	$api_secret  = zopimapi_get_option('zopim_api_secret');
	
	// Some paramters
	$method = 'POST';
	$host   = 'reseller.zopim.com';
	$uri    = '/api/sso/request';
	
	$content = json_encode(
					array(
						'email' => $email, 
						)
				);
	$md5_content = base64_encode(md5($content,true));

	$string_to_sign = $method . "\n" . $md5_content . "\n" . $date  . "\n" . $uri;
		
	// Calculate HMAC with SHA1 and base64-encoding
	$signature = base64_encode( hash_hmac( 'sha1', utf8_encode($string_to_sign), $api_secret, TRUE ) );
		
	
	// Create request
	$request = 'https://' . $host . $uri;  
		
    $headr = array();
	$headr[] = 'Authorization: Zopim-Reseller-API ' .$api_token.':'.$signature;
	$headr[] = 'API-Date: ' . $date;
	     
	    
    // Do request
    $ch = curl_init( $request );
	curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);  
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
	
    $response = curl_exec( $ch );
    curl_close( $ch );
	
	return json_decode($response, true);
}
