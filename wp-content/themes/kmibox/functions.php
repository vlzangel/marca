<?php

	include( __DIR__."/funciones/generales.php" );
	include( __DIR__."/funciones/db.php" );
	include( __DIR__."/funciones/emails.php" );
	include( __DIR__."/funciones/suscripcion.php" );
	include( __DIR__."/funciones/unico_uso.php" );

	include( __DIR__."/funciones/backpanel.php" );
    
	add_filter( 'show_admin_bar', '__return_false' );

	function _remove_script_version( $src ){
	    $parts = explode( '?ver', $src );
	    return $parts[0]."?ver=".time();
	    // return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

	add_filter( 'wp_mail_content_type', 'set_content_type' );
	function set_content_type( $content_type ) {
		return 'text/html';
	}

	add_action( 'admin_head', 'remove_update_nag' );
	function remove_update_nag() {
	    //if ( ! current_user_can( 'update_core' ) ) {
	        remove_action( 'admin_notices', 'update_nag', 3 );
	    //}
	}

	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
	   wp_deregister_script('jquery');
	   //wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
	   //wp_enqueue_script('jquery');
	}

	add_action('get_header', 'remove_admin_login_header');
	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}

	
	// ************************************
	// Procesos
	// ************************************

	function reset_password_confirm(){
		$sts = ['code'=>'0', 'sts'=>''];
		if( $_GET ){
			$sts = ['code'=>'0', 'sts'=>'Faltan parametros'];
			if( array_key_exists('confirmar', $_GET) ){
				if( array_key_exists('e', $_GET) ){
					$user = get_user_by( "email", $_GET['e'] );
					if( $user ){
						$token = get_user_meta( $user->ID, 'reset_pass_token', true );	
						if( !empty( $token ) ){
							if( $token == $_GET['confirmar'] ){
								$sts = ['code'=>'1', 'sts'=>'Autorizado'];
							}else{
								$sts = ['code'=>'0', 'sts'=>'Token invalido'];
							}
						}else{
							$sts = ['code'=>'0', 'sts'=>'Token invalido'];
						}		
					}else{
						$sts = ['code'=>'0', 'sts'=>'Usuario invalido'];
					}		
				}
			}
		}
		return $sts;
	}

	function get_estatus_envio(){
		return [
			'pendiente' => 'Pendiente',
			'armada' => 'Armada',
			'enviada' => 'Enviada',
			'recibida' => 'Recibida',
			'devuelta' => 'Devuelta',
			'cancelada' => 'Cancelado',
		];
	}
	function get_estatus_pago(){
		return [
			'pendiente' => 'Pendiente',
			'pagado' => 'Pagado',
			'proceso' => 'Por Pagar',
			'cancelada' => 'Cancelado',
		];
	}

	function get_tipo_pago(){
		return [
			'tarjeta' => 'Tarjeta de Credito',
			'efectivo' => 'Tienda por conveniencia',
		];
	}

	function get_transacciones( $id=0 ){
		global $wpdb;
		$data = [
			'envio_estatus' => '',
			'entrega' => '',
		];
		if( $id>0){
			$sql = "select * from wp_suscripcion_transacciones where post_id = ".$id." order by id desc limit 1";
			$result = $wpdb->get_results($sql);
			foreach ($result as $row) {
				$data['envio_estatus'] = $row->estatus;
				$date = date("d / M", strtotime( $row->entrega_mes) );
				$data['fecha_entrega'] = $date;
				$data['code'] = $row->id;
			}
		}
		return $data;
	}

	function get_user_info(){
		$data = [];
		if(get_current_user_id()>0){

			$user = get_user_by('id', get_current_user_id());

			$data['email'] = $user->user_email;
			$data['display_name'] = $user->display_name;

			$d = get_user_meta( get_current_user_id(), 'first_name' );
			$data['first_name'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'last_name' );
			$data['last_name'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'telef_movil' );
			$data['telef_movil'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'telef_fijo' );
			$data['telef_fijo'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'dir_ciudad' );
			$data['city'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'dir_codigo_postal' );
			$data['codigo_postal'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'dir_estado' );
			$data['estado'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'dir_calle' );
			$data['calle'] = $d[0];

			$d = get_user_meta( get_current_user_id(), 'dir_colonia' );
			$data['colonia'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'edad' );
			$data['edad'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'sexo' );
			$data['sexo'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'mascota' );
			$data['mascota'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'dir_numint' );
			$data['dir_numint'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'dir_numext' );
			$data['dir_numext'] = $d[0];

			$d =  get_user_meta( get_current_user_id(), 'dondo_conociste' );
			$data['dondo_conociste'] = $d[0];


		}
		return $data;
	}

	function get_source_url(){
		return ( array_key_exists('source', $_GET) ) ? "?source=".$_GET['source'] : '' ;
	}

	function get_cart(){
	   	return $_SESSION['carrito'];
	}

	add_action('init', 'myStartSession', 1);
	function myStartSession() {
	    if(!session_id()) {
	        session_start();
	    }
	}

	function kmibox_login( $info = [] ){
		$dat = 0;
		if( !empty($info) ){
			$user_signon = wp_signon( $info, true );
			if ( is_wp_error( $user_signon )) {
				$dat = 0;
			} else {
			    wp_set_auth_cookie($user_signon->ID);
				$dat = 1;
			}
		}
		return $dat;
	}

	function get_estados( $country = 1 ){
		global $wpdb;
		$estados = $wpdb->get_results( "select * from wp_estados where country_id = ". $country ." order by name asc");
		return $estados;
	}

	function get_municipios( $estado_id ){
		global $wpdb;
		$municipios=[];
		if( $estado_id > 0 ){
			$municipios = $wpdb->get_results( "select * from wp_municipios where state_id = ".$estado_id." order by name asc" );
		}
		return $municipios;
	}

	add_action('phpmailer_init','send_smtp_email');
	function send_smtp_email( $phpmailer ){
	    $phpmailer->isSMTP();
	    $phpmailer->Host = "smtp.gmail.com";
	    $phpmailer->SMTPAuth = true;
	    $phpmailer->Port = "465";
	    $phpmailer->Username = "loaiza2610@gmail.com";
	    $phpmailer->Password = "1a2b3c4d5e6f$$";
	    $phpmailer->SMTPSecure = "tls";
	    $phpmailer->From = "marca@kmimos.la";
	    $phpmailer->FromName = "Nutriheroes";
	}

	function get_form_busqueda(){
		return '
			<article class="busqueda">
				<form data-target="busqueda" action="" method="post">
					<div class="input-group">
						<input type="text" data-target="search" class="form-control" placeholder="Buscar productos">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit" data-target="filtrar"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</article>
		';
	}