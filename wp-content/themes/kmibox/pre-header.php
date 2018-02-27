<?php

	if( isset($_GET['i'])){
		if( !isset($_SESSION) ){ session_start(); }
		global $current_user;
        $_SESSION['id_admin'] = $current_user->ID;
        $_SESSION['admin_sub_login'] = "YES";
		global $wpdb;
		$sql = "SELECT ID FROM wp_users WHERE md5(ID) = '{$_GET['i']}'";
		$data = $wpdb->get_row($sql);
	    $user_id = $data->ID;
		$user = get_user_by( 'id', $user_id ); 
		if( $user ) {
		    wp_set_current_user( $user_id, $user->user_login );
		    wp_set_auth_cookie( $user_id );
		}
		if( isset($_GET['admin']) ){
	        $_SESSION['id_admin'] 		 = "";
	        $_SESSION['admin_sub_login'] = "";
	   		echo "
	   			<script>
	   				location.href = '".get_home_url()."/wp-admin/admin.php?page=clientes';
	   			</script>
	   		";
		}else{
	   		echo "
	   			<script>
	   				location.href = '".get_home_url()."/perfil/';
	   			</script>
	   		";
		}
	}

?>