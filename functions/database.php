<?php

function iq_juegos_set_database() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'iq_juegos';
	
	$charset_collate = '';

	if ( ! empty( $wpdb->charset ) ) {
	  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
	}
	
	if ( ! empty( $wpdb->collate ) ) {
	  $charset_collate .= " COLLATE {$wpdb->collate}";
	}
	
	$sql = "CREATE TABLE $table_name (
 				 id int(9) NOT NULL AUTO_INCREMENT, 
 				 hashid VARCHAR(32) DEFAULT NULL, 
 				 user_id int(11) NOT NULL,
 				 juego int(11) NOT NULL, 
 				 puntaje int(11) NOT NULL, 
 				 porcentaje int(11) NOT NULL, 
 				 nivel int(11) NOT NULL,
 				 time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
 				 UNIQUE KEY id (id) 
			) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function iq_juegos_save_game($game, $data = array()) {
	global $wpdb;
		
	$table_name = $wpdb->prefix . 'iq_juegos';

	$wpdb->insert( 
		$table_name, 
		array( 
			'hashid' => iq_juegos_game_id(), 
			'user_id' => get_current_user_id(), 
			'juego' => $game,
			'puntaje' => $data['puntaje'],
			'porcentaje' => $data['porcentaje'],
			'nivel' => $data['nivel'],
			'time' => date('Y-m-d h:i:s'), 
		)
	);
		 
}
