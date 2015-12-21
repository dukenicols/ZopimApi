<?php

function zopimapi_whmcs_api_addclient($data = array()) {
	
	$url = zopimapi_get_option('whmcs_url'); # URL to WHMCS API file
	$username = zopimapi_get_option('admin_user'); # Admin username goes here
	$password = zopimapi_get_option('admin_pass'); # Admin password goes here
	 

	extract($data); 

	
	$postfields["username"] = $username;
	$postfields["password"] = md5($password);
	$postfields["action"] = "addclient"; #action performed by the [[API:Functions]]
	$postfields["firstname"] = $nombre;
	$postfields["lastname"] = $apellido;
	$postfields["email"] = $email;
	$postfields["address1"] = 'Direccion';
	$postfields["city"] = 'Unknown';
	$postfields["state"] = "Unknown";
	$postfields["postcode"] = "00";
	$postfields["country"] = 'AR';
	$postfields["phonenumber"] = "000";
	$postfields["password2"] = $pass;
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$data = curl_exec($ch);
	curl_close($ch);
	 
	
	$data = explode(";",$data);
	
	$results = array();
	foreach ($data AS $temp) {
		$temp = explode("=",$temp);
		$results[$temp[0]] = $temp[1];
	}
	 
	
	 
	if ($results["result"]=="success") {
	   	
	   $response =  array("status" => "active", "clientid" => $results["clientid"]);
	   return $response;
	   exit;
	} else {
	  
	   $response = array("error" => $results["message"]);
	   return $response;
	   exit;
	}
}

function zopimapi_whmcs_api_addorder($client_id) {
	
	$url = zopimapi_get_option('whmcs_url'); # URL to WHMCS API file
	$username = zopimapi_get_option('admin_user'); # Admin username goes here
	$password = zopimapi_get_option('admin_pass'); # Admin password goes here
	 

	$postfields["username"] = $username;
	$postfields["password"] = md5($password);
	$postfields["action"] = "addorder"; #action performed by the [[API:Functions]]
	$postfields["clientid"] = $client_id;
	$postfields["pid"] = "1";
	$postfields["paymentmethod"] = "banktransfer";
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$data = curl_exec($ch);
	curl_close($ch);
	 
	
	$data = explode(";",$data);
	
	$results = array();
	foreach ($data AS $temp) {
		$temp = explode("=",$temp);
		$results[$temp[0]] = $temp[1];
	}
	 
	
	 
	if ($results["result"]=="success") {
	   	
	   $response =  array("status" => "active", "orderid" => $results["orderid"]);
	   return $response;
	   exit;
	} else {
	  
	   $response = array("error" => $results["message"]);
	   return $response;
	   exit;
	}
}

function zopimapi_whmcs_api_acceptorder($order_id){
	$url = zopimapi_get_option('whmcs_url'); # URL to WHMCS API file
	$username = zopimapi_get_option('admin_user'); # Admin username goes here
	$password = zopimapi_get_option('admin_pass'); # Admin password goes here
	 

	$postfields["username"] = $username;
	$postfields["password"] = md5($password);
	$postfields["action"] = "acceptorder"; #action performed by the [[API:Functions]]
	$postfields["orderid"] = $order_id;
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$data = curl_exec($ch);
	curl_close($ch);
	 
	
	$data = explode(";",$data);
	
	$results = array();
	foreach ($data AS $temp) {
		$temp = explode("=",$temp);
		$results[$temp[0]] = $temp[1];
	}
	 
	
	 
	if ($results["result"]=="success") {
	   	
	   $response =  array("status" => "active");
	   return $response;
	   exit;
	} else {
	  
	   $response = array("error" => $results["message"]);
	   return $response;
	   exit;
	}
}
