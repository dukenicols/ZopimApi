<?php

add_action('wp_head','zopimapi_ajax_url');
	function zopimapi_ajax_url() { ?>
		<script type="text/javascript">
		var zopimapi_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
	<?php
	}
	
/* save user data form */
	add_action('wp_ajax_nopriv_zopimapi_addclient', 'zopimapi_addclient');
	add_action('wp_ajax_zopimapi_addclient', 'zopimapi_addclient');
	function zopimapi_addclient(){
		global $zopimapi;
		extract($_POST);	
		
		if (!isset($_POST) || $_POST['action'] != 'zopimapi_addclient') 
			die();
		
		$error = array();
			
		if(empty($nombre)){
			$error[] = 'nombre';
			$error['error'] = "empty";
		} 
		if(empty($apellido)){
			$error[] = 'apellido';
			$error['error'] = "empty";
		}
		if(empty($empresa)){
			$error[] = 'empresa';
			$error['error'] = "empty";
		}
		if(empty($telefono)){
			$error[] = 'telefono';
			$error['error'] = "empty";
		}
		if(empty($email)){
			$error[] = 'email';
			$error['error'] = "empty";
		}
		if(empty($pass)){
			$error[] = 'pass';
			$error['error'] = "empty";
		}
		
		if(!empty($error)){
			$output = $error;
		} else {
			
			//$zopim_api_response = array();
			$zopim_api_response = zopimapi_api_addclient($_POST);
			
			//$zopim_api_response['status'] = 'active';
			//si la respuesta es active
			//continuamos
			if($zopim_api_response['status'] == 'active') { // Si ZOPIM API creo el usuario

				$whmcs_api_addclient_response = zopimapi_whmcs_api_addclient($_POST); //Retorna un client_id
				//$whmcs_api_addclient_response['status'] == 'active'
				if($whmcs_api_addclient_response['status'] == 'active'){
					$client_id = $whmcs_api_addclient_response['clientid'];
					$whmcs_api_addorder_response = zopimapi_whmcs_api_addorder($client_id);
					
					if($whmcs_api_addorder_response['status'] = 'active'){
						$order_id = $whmcs_api_addorder_response['orderid'];
						$whmcs_api_acceptorder_response = zopimapi_whmcs_api_acceptorder($order_id);
						
						if($whmcs_api_acceptorder_response['status'] == 'active') {

							$sso = zopimapi_api_sso_request($email); // Single Sign On ZOPIM
								
							$output = array('done'=> 'success', 'redirect' => $sso['redirect_uri']);
						
						} else { // No se acepto la orden
							$output = array('error' => "whmcs", "message" => $whmcs_api_acceptorder_response['error']);
						}
					} else { // No se creo la orden
						$output = array('error' => "whmcs", "message" => $whmcs_api_addoorder_response['error']);
					}
					
				} else { // No se creo el usuario
				
					$output = array('error' => "whmcs", "message" => $whmcs_api_addclient_response['error']);
				}	 

			} else { // Si ZOPIM API NO creo el usuario
				if($zopim_api_response["error"] == 'Validation Failed'){
					if(array_key_exists('email', $zopim_api_response)) {
						$array_response = array("status" => 'error', "error"=>"zopim", "message"=> zopimapi_get_option('zopim_api_user_exist'), "link" => zopimapi_get_option('zopim_api_user_exist_link'), "elemento" => 'email');
					}
					
				}
				$output = $array_response;
			}
		}

		$output=json_encode($output);
		if(is_array($output)){ print_r($output); }else{ echo $output; } die;

	
		 
	}
		