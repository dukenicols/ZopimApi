<?php
   /*
      Plugin Name: Zopim Reseller API
      Plugin URI: 
      Description: Zopim Reseller, permite crear usuarios usando el API de Zopim y WHMCS
      Version: 2.1
      Author: Nicolas Duke <nduque@dodable.com>
      Author URI: http://dodable.com
   */

define('zopimapi_url',plugin_dir_url(__FILE__ ));
define('zopimapi_path',plugin_dir_path(__FILE__ ));

   /* init */
   function zopimapi_init() {
      
      if(!isset($_SESSION))
      {
         session_start();
      }
      
  
   }
   add_action('init', 'zopimapi_init');

   /* functions */
    //TODO custom functions list
      require_once zopimapi_path . "functions/ajax.php";
	  require_once zopimapi_path . "functions/defaults.php";
	  require_once zopimapi_path . "functions/hooks-action.php";

	  require_once zopimapi_path . "functions/shortcode-main.php";
	  require_once zopimapi_path . "functions/zopim_api.php";
	  require_once zopimapi_path . "functions/whmcs_api.php";
	
	
   /* administration */
   if (is_admin()){
      foreach (glob(zopimapi_path . 'admin/*.php') as $filename) { include $filename; }
   }
   

   
 