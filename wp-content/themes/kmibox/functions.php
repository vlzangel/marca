
<?php
add_action('admin_menu','kb_admin_menu');
function kb_admin_menu(){
	add_submenu_page( 
		'woocommerce', 
		'Despacho Kmibox',  
		'Despacho' , 
		'manage_woocommerce', 
		'wc_despacho', 
		'wc_despacho' 
	);
}
function wc_despacho(){
	get_template_part( 'template/parts/backpanel/despacho', 'page' ); 
}


add_action('admin_enqueue_scripts','bk_admin_script');
function bk_admin_script(){
	// ========================================
	// Paginas Permitiddas con este Estilos
	// ========================================
		$array_backpanel = [
			'wc_despacho',
		];
		if( in_array($_GET['page'], $array_backpanel) ){ 
		// ========================================
		// BEGIN Style Dashboard ( New backpanel )
		// ======================================== 
		wp_enqueue_style( 'kmimos_style2', get_home_url()."/plugins/bootstrap/css/bootstrap.min.css" );
		wp_enqueue_style( 'kmimos_style2', get_home_url()."/plugins/font-awesome/css/font-awesome.min.css" );
		wp_enqueue_style( 'kmimos_style3', get_home_url()."/plugins/nprogress/nprogress.css" );
		wp_enqueue_style( 'kmimos_style4', get_home_url()."/plugins/iCheck/skins/flat/green.css" );
		wp_enqueue_style( 'kmimos_style5', get_home_url()."/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" );
		wp_enqueue_style( 'kmimos_style6', get_home_url()."/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" );
		wp_enqueue_style( 'kmimos_style7', get_home_url()."/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" );
		wp_enqueue_style( 'kmimos_style8', get_home_url()."/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" );
		wp_enqueue_style( 'kmimos_style9', get_home_url()."/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" );
		
		
		// ========================================
		// BEGIN JS Dashboard ( New backpanel )
		// ========================================    
		wp_enqueue_script( 'sc1', get_home_url()."/plugins/jquery/jquery-3.2.1.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc1', get_home_url()."/plugins/bootstrap/js/bootstrap.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc2', get_home_url()."/plugins/datatables.net/js/jquery.dataTables.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc3', get_home_url()."/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc16', get_home_url()."/plugins/jszip.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc4', get_home_url()."/plugins/datatables.net-buttons/js/dataTables.buttons.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc5', get_home_url()."/plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc6', get_home_url()."/plugins/datatables.net-buttons/js/buttons.flash.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc7', get_home_url()."/plugins/datatables.net-buttons/js/buttons.html5.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc8', get_home_url()."/plugins/datatables.net-buttons/js/buttons.print.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc9', get_home_url()."/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc10', get_home_url()."/plugins/datatables.net-responsive/js/dataTables.responsive.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc11', get_home_url()."/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc12', get_home_url()."/plugins/datatables.net-scroller/js/dataTables.scroller.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc13', get_home_url()."/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc14', get_home_url()."/js/datatable_custom.js",
			array(), '1.0.0', true );
		wp_enqueue_script( 'sc20', get_home_url()."/js/backpanel.js",
			array(), '1.0.0', true );
	}
}

add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $content_type ) {
	return 'text/html';
}



// ************************************
// Consultas
// ************************************
function query_products_extra(){
	global $wpdb;
	$result = $wpdb->get_results("
		SELECT 
			t.name as category,  
			p.ID,
			p.post_title as product_name,
			pr.meta_value as price
		FROM wp_posts as p 
			inner join wp_postmeta as pr ON pr.post_id = p.ID and pr.meta_key = '_price'
			inner join wp_term_relationships as tr ON tr.object_id = p.ID
			inner join wp_term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
			inner join wp_terms as t ON t.term_id = tt.term_id
		WHERE 
			t.name = 'extra' 
			and p.post_type = 'product' 
			and post_status = 'publish'
	", ARRAY_A);

	$extra = [];
	foreach ($result as $row) {
		$extra[] = [
			'ID' => $row['ID'],
			'price' => $row['price'],
			'name' => $row['product_name'],
			'thumnbnail' => get_the_post_thumbnail_url( $row['ID'] )
		];
	}

	return $extra;
}
function query_products(){
	global $wpdb;
	$result = $wpdb->get_results("
		SELECT 
			p.ID,
			mt.meta_value as size, 
			t.name as category,  
			pa.post_title as product_name, 
			mp.meta_value as plan, 
			pr.meta_value as price,			
			case when pro.meta_value > 0 THEN pro.meta_value ELSE 0 END as regular_price,
			(pro.meta_value - pr.meta_value) as ahorro,
			FORMAT( ( ( pr.meta_value * 100 ) / pro.meta_value ), 2) as ahorro_porcent,
			p.post_parent as parent,
			ga.meta_value as gallery
		FROM wp_posts as p 
			left  join wp_postmeta as ga ON ga.post_id = p.post_parent and ga.meta_key = '_product_image_gallery'
			inner join wp_postmeta as mp ON mp.post_id = p.ID and mp.meta_key = 'attribute_plan'
			inner join wp_postmeta as mt ON mt.post_id = p.ID and mt.meta_key = 'attribute_tamano'
			inner join wp_postmeta as pr ON pr.post_id = p.ID and pr.meta_key = '_price'
			inner join wp_postmeta as pro ON pro.post_id = p.ID and pro.meta_key = '_regular_price'
			inner join wp_posts as pa ON pa.ID = p.post_parent
			inner join wp_term_relationships as tr ON tr.object_id = p.post_parent
			inner join wp_term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
			inner join wp_terms as t ON t.term_id = tt.term_id
		WHERE p.post_type = 'product_variation' AND t.name <> 'variable'
		ORDER BY size, category, product_name, plan ASC
	", ARRAY_A);
	
	$posts = [];
	$service = [];

	foreach ($result as $row) {

		$row['product_name'] = ucfirst($row['product_name']);
		$row['category'] = strtolower($row['category']);
		$row['size'] =  ucfirst($row['size']);
		$row['plan'] = ucfirst($row['plan']);

		$min_price = '';
		if( isset($service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['price-min']) ){
			$min_price = $service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['price-min'];
		}
		if( $min_price > $row['price'] || $min_price == '' ){
			$min_price = $row['price'] ;
		}
	
		$post;
		$color_base_items = get_post_meta($row['parent'], 'color_base');
		$color_base = ( count($color_base_items)>0 )? $color_base_items[0] : '' ;
		if(array_key_exists($row['parent'], $posts)){
			$post = $posts[$row['parent']];
		}else{
			$post = get_post($row['parent']);
			$posts[$row['parent']] = $post;
		}

		// Buscar imagenes del producto
		// **********************************
		$gallery['other'] = get_product_gallery( $row['gallery'] );
		$gallery['thumnbnail'] = get_the_post_thumbnail_url( $post->ID );

		$service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['gallery'] = $gallery;
		$service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['plan'][ $row['plan'] ] = $row;
		$service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['content'] = $post;
		$service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['price-min'] = $min_price;
		$service[ $row['category'] ][ $row['size'] ][ $row['product_name'] ]['color'] = $color_base;
	}

	return $service;
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

function get_status( $wp_status ){
	$status = '';
	if( $wp_status != '' ){
		switch ($wp_status) {
			case 'wc-pending':
				$status = 'Pendiente';
				break;
			case 'wc-completed':
				$status = 'Activo';
				break;
			case 'wc-cancelled':
				$status = 'Inactivo';
				break;
			default:
				$status = $wp_status;
				break;
		}
	}
	return $status;
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

function get_suscripciones( $user_id = 0, $is_admin = false ){

	global $wpdb;
	$result = [];

	if( $user_id < 1 ){
		$user_id = get_current_user_id();
	}

	$sql = "select * from wp_posts where post_type = 'shop_order' and post_status <> 'trash' ";
	if( $is_admin ){
		$sql .= " and post_author = ".$user_id; 
	}
	$orders = $wpdb->get_results( $sql );

	foreach ($orders as $row) {
		$order = new WC_Order( $row->ID );

		$detalle = $order->get_data();
		$metas = order_items_to_array( $detalle );
		$result[ $row->ID ] = [
			'estatus' => get_status( 'wc-completed' ),
			'meta' => get_suscripcion_metadata($row->ID),
			'items_count'=>count($detalle['line_items']),
			'items'=> $metas,
			'name'=> $metas[0],
			'total'=> $order->total,
			'entrega'=> get_transacciones( $row->ID ),
		];
	}	

	return $result;
}

function get_suscripcion( $user_id = 0, $is_admin = false ){

	global $wpdb;
	$result = [];

	if( $user_id < 1 ){
		$user_id = get_current_user_id();
	}

	$sql = "select * from wp_posts where post_type = 'shop_order' and post_status <> 'trash' ";
	if( !$is_admin ){
		$sql .= " and post_author = ".$user_id; 
	}
	$orders = $wpdb->get_results( $sql );

	foreach ($orders as $row) {
		$order = new WC_Order( $row->ID );

		$detalle = $order->get_data();
		$metas = order_items_to_array( $detalle );
		$result[ $row->ID ] = [
			'estatus' => get_status( 'wc-completed' ),
			'meta' => get_suscripcion_metadata($row->ID),
			'items_count'=>count($detalle['line_items']),
			'items'=> $metas,
			'name'=> $metas[0],
			'total'=> $order->total,
			'entrega'=> get_transacciones( $row->ID ),
		];
	}	

	return $result;
}



function get_suscripcion_metadata( $id ){
	$result = [];
	if( $id > 0){
		$order = new WC_Order( $id );
		foreach ($order->meta_data as $meta) {
			$result[ $meta->key ] = $meta->value;
		}
	}
	return $result;
}

function order_items_to_array( $order ){
	$d = $order['line_items'];
	$result = [];
	foreach ($d as $key => $q) {
		$result[] = $q->get_product()->get_name();
	}
	return $result;
}

function get_suscripciones_detalle( $id = 0 ){
	if( $id > 0){
		$order = new WC_Order( $id );
		$detalle = $order->get_data();
	}
}

function get_products(){

	$service = query_products();
	
	$product = json_encode( $service, JSON_UNESCAPED_UNICODE );
	$extra = json_encode( query_products_extra(), JSON_UNESCAPED_UNICODE );

	$source = 'default';
	if( array_key_exists('source', $_GET) ){
		if(array_key_exists($_GET['source'], $service)){
			if(!empty($_GET['source'])){
				$source = strtolower($_GET['source']); 
			}
		}
	}

	return [
		'product' => $product,
		'extra' => $extra,
		'source' => $source,
	];
}

function get_product_gallery( $ids = 0 ){
	global $wpdb;
	$result = $wpdb->get_results("
		SELECT
			guid as url
		FROM wp_posts
		WHERE post_type = 'attachment' and ID in ( {$ids} )
	");
	return $result;
}

function get_user_info2(){
		
		global $wpdb;
		$result = $wpdb->get_results("
		SELECT * FROM 'wp_usermeta' WHERE 'user_id'= 122");

		
	return $result;
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
	return ( array_key_exists('source', $_GET) )? $_GET['source'] : '' ;
}

function get_resumen(){
	$cart = get_cart();

	$result = [
		'subtotal' => 0,
		'iva'=> 0,
		'total' => 0,
		'cant_item' => 0,
		'kmibox' => [
			'thumnbnail' => '',
			'size' => '',
			'periodo'=> '',
		]
	];
	if( !empty($cart)){
		if( array_key_exists('items', $cart) ){
			foreach ($cart['items'] as $key => $value) { 
				$value['price'] = ( $value['price']>=0 )? $value['price'] : 0 ;
				$result['subtotal'] = $result['subtotal'] + $value['total'];
				$result['iva'] = $result['subtotal'] * 0.12;
				$result['total'] = $result['subtotal'] + $result['iva'] ;
				

				$result['cant_item'] += $value['cant_item']; //italo 
				$result['cant_item']  = $result['cant_item'] + 1; //italo cantidad de articulos

				if( $key == 0 ){
					$result['kmibox']['thumnbnail'] = $value['thumnbnail'];
					$result['kmibox']['size'] = $value['size'];
					$result['kmibox']['plan'] = $value['plan'];
				}
			}
		}
	}
	
	return $result;
}


function get_vat(){
   	global $wpdb;
	$result = $wpdb->get_results("
		SELECT
			guid as url
		FROM wp_posts
		WHERE post_type = 'attachment' and ID in ( {$ids} )
	");
	return $result;
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

function create_order(){
	global $woocommerce;

	$user = get_user_by('id', get_current_user_id());
	$items = $_SESSION['carrito']['items'];
	$resumen = get_resumen();

	if( !empty($user) && !empty($items) ){  
		$first_name = get_user_meta( get_current_user_id(), 'first_name' );
		$last_name = get_user_meta( get_current_user_id(), 'last_name' );
		$phone = get_user_meta( get_current_user_id(), 'telef_movil' );
		$phone2 =  get_user_meta( get_current_user_id(), 'telef_fijo' );
		if( !empty($phone)){
			$phone .= ( !empty($phone2) )? ' / '.$phone2 : '';
		}else{
			$phone = $phone2;
		}
		$city = get_user_meta( get_current_user_id(), 'dir_ciudad' );
		$calle = get_user_meta( get_current_user_id(), 'dir_calle' );
		$estado = get_user_meta( get_current_user_id(), 'dir_estado' );
		$codigo_postal = get_user_meta( get_current_user_id(), 'dir_codigo_postal' );

		$address = array(
			'first_name' => (!empty($first_name[0])) ? $first_name[0] : 'no-asignado',
			'last_name'  => (!empty($last_name[0])) ? $last_name[0] : 'no-asignado',
			'company'    => "USERID ".get_current_user_id(),
			'email'      => (!empty($user->user_email)) ? $user->user_email : 'no-asignado',
			'phone'      => (!empty($phone[0])) ? $phone[0] : 'no-asignado',
			'address_1'  => (!empty($calle[0])) ? $calle[0] : 'no-asignado',
			'address_2'  => '',
			'city'       => (!empty($city[0])) ? $city[0] : 'no-asignado',
			'state'      => (!empty($estado[0])) ? $estado[0] : 'no-asignado',
			'postcode'   => (!empty($codigo_postal[0])) ? $codigo_postal[0] : 'no-asignado',
			'country'    => 'MX'
		);

		// Crear pedido
		$order = wc_create_order( ['customer_id' => $user->ID] );

		// Agregar Productos
		foreach ($items as $producto) {
		  $order->add_product( get_product( $producto['ID'] ), $producto['cant']);
		}

		// Agregar informacion adicional
		$order->set_address( $address, 'billing' );

		// Calcular montos
		$order->calculate_totals();

		// Agregar cupon de descuento
		// $order->add_coupon('Fresher','10','2');

		// Actualizar Estatus de Pedido
		$order = new WC_Order($order->id);
		$order->update_status('wc-pending');

		$arg = array(
		    'ID' => $order->id,
		    'post_author' => $user->ID,
		);

		wp_update_post( $arg );

		update_post_meta($order->id, '_order_tax', 16);
		update_post_meta($order->id, 'kmibox_size', $resumen['kmibox']['size']);
		update_post_meta($order->id, 'kmibox_thumnbnail', $resumen['kmibox']['thumnbnail']);
		update_post_meta($order->id, 'kmibox_periodo', $resumen['kmibox']['plan']);
		update_post_meta($order->id, 'kmibox_estatus', 'pendiente');

		return $order;
	}

	return null;
}

function procesar_pago( $param=[] ){
	global $wpdb;
	require_once( __DIR__.'/assets/plugins/Openpay/Openpay_kmibox.php' );
	$visible = false;
	$resumen = get_resumen();
	$cart = get_cart();
	$user = get_user_info();

	if( !empty($param) ){

		$sts = true;
		$msg = '';
		foreach ($param as $key => $value) {
			if( empty($value) ){
				$msg = 'Faltan datos, por favor complete el formulario ('.$key.")";
				$sts = false;
				break;
			}
		}

		if( $sts ){
			$data = [
				'customer' => [
					'ID' => get_current_user_id(),
					'name' => $user['first_name'],
					'apellido' => $user['last_name'],
					'email' => $user['email'],
					'phone' => $user['telef_movil'],
					'calle' => $user['calle'],


					'state' => 'mexico', //$user['state'],
					'city'  => 'city', // $user['city'],
					'codigo_postal' => '10001',//$user['codigo_postal'],
				],
				'plan' => [
				    'amount' => $resumen['total'],
				    'status_after_retry' => 'CANCELLED',
				    'retry_times' => 2,
				    'name' => $cart['items'][0]['name'],
				    'repeat_unit' => 'month', // Periodo Semanal, mensual, anual
				    'repeat_every' => '1', // repetir mensual
				    'trial_days' => '0', 
				    'currency' => 'MXN'
				],
				'suscripcion' => [
				    'trial_end_date' => '2010-01-01', 
				    'plan_id' => '',
				    'card' => [
				         'card_number' => $param['num_cart'],  //'4111111111111111',
				         'holder_name' => $param['holder_name'],
				         'expiration_year' => $param['exp_year'],
				         'expiration_month' => $param['exp_month'],
				         'cvv2' => $param['cvv'],
				         'device_session_id' => session_id()
					]
				]
			];

			$result = kmibox_create( $data );

			// Agregar id de usuario openpay
			if( array_key_exists('customer', $result) ){
				if( !empty($result['customer']) ){
					update_user_meta( get_current_user_id(), 'openpay_customer_id', $result['customer']->id );
				}
			}

			if( $param['order_id'] > 0 )
			{
				// Agregar id plan a pedido
				if( array_key_exists('plan', $result) ){
					if( !empty($result['plan']) ){
						update_post_meta( $param['order_id'], 'openpay_plan_id', $result['plan']->id );
					}
				}

				// Agregar id suscripcion a pedido
				if( array_key_exists('suscripcion', $result) ){
					if( !empty($result['suscripcion']) ){
						update_post_meta( $param['order_id'], 'openpay_suscripcion_id', $result['suscripcion']->id );
						if($result['suscripcion']->id != ""){
							$order = new WC_Order($param['order_id']);
							$order->update_status('wc-completed');
							update_post_meta( $param['order_id'], 'kmibox_estatus', 'Activo');
							

							$wpdb->get_results("insert into wp_suscripcion_transacciones(
									post_id,
									fecha_cobro,
									entrega_mes,
									entrega_dia,
									estatus,
									openpay_transaccion_id
								)values(
									'{$param['order_id']}',
									now(),
									0,
									0,
									'pendiente',
									'0'
								)");
						}
					}
				}
			}

			if( $result['code'] == 1 )
			{
				$msg = '';
				$visible = true;
				$_SESSION = [];
				$sts = 1;
			}else{
				$msg = $result['msg'];
				$sts = 0;
			}
		}
	}
	return [ 
		'msg' => $msg, 
		'sts' => $sts, 
		'visible' => $visible, 
		'result' => $result 
	];
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

/*function paramters(){
	$dato = [];
	$dato ['id'] = 'mbkjg8ctidvv84gb8gan' ;
	$dato ['password'] ='sk_883157978fc44604996f264016e6fcb7';

	return $dato;
}*/

function km_session_reset(){
	if( array_key_exists('kmibox_param', $_SESSION) ){
		unset($_SESSION['kmibox_param']);
	}
}

function get_faseID(){
	$c = get_param_purchase('fase1', false);
	$fase = 1;
	if( !empty($c) ){
		$fase = 5;
	}
	return $fase;
}

function get_var($sql, $campo = ""){
			$result = $this->query($sql);
			if( $result->num_rows > 0 ){
				if($campo == ""){
					$temp = $result->fetch_array(MYSQLI_NUM);
		            return $temp[0];
				}else{
		            $temp = $result->fetch_assoc();
		            return $temp[$campo];
				}
	        }else{
	        	return false;
	        }
		}


function get_param_purchase( $key = '', $echo = true ){
	$result = '';

//print_r($_GET);	

	if( array_key_exists('kmibox_param', $_SESSION) ){
		$kmibox_param = $_SESSION['kmibox_param'];

		switch ($key) {
			case 'fase1':
				if( array_key_exists($key, $kmibox_param) ){
					$result = $kmibox_param[$key];
				}else{
					if( array_key_exists('tipo', $_GET) ){
						$result = $_GET['tipo'];
					}
				}
				break;				
			case 'fase2':
			case 'fase3':
				if( array_key_exists($key, $kmibox_param) ){
					$result = $kmibox_param[$key];
				}
				break;
			case 'code':
				if( array_key_exists('cart', $kmibox_param) ){
					if( array_key_exists($key, $kmibox_param['cart']) ){
						$result = $kmibox_param['cart'][$key];
					}
				}
				break;		
			case 'extra':
				$result = json_encode([]);
				if( array_key_exists('cart', $kmibox_param) ){
					if( array_key_exists($key, $kmibox_param['cart']) ){
						if(!empty($kmibox_param['cart'][$key])){
							$result = $kmibox_param['cart'][$key];
						}
					}
				}
				break;
		}
	}else{
		if( $key == 'fase1' ){
			if( array_key_exists('tipo', $_GET) ){
				$result = $_GET['tipo'];
			}
		}
	}
	if( $echo ){
		print_r( $result );
	}else{
		return $result;
	}
}

add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
/*require_once  ' /PHPMailer-master/PHPMailerAutoload.php ';


$mail  =  new  PHPMailer (); // crea un nuevo objeto 
$mail->IsSMTP ( false ); // enable SMTP 
$mail->SMTPDebug =1; // depuración: 1 = errores y mensajes, 2 = sólo mensajes 
$mail->SMTPAuth =true; // autenticación habilitada 
$mail->SMTPSecure =' ssl'; // Transferencia segura habilitada REQUIRED for Gmail 
$mail->Host = "tls: //smtp.gmail.com: 465"; 
$mail->Puerto = 465; // or 587 
$mail->IsHTML( true ); 
$mail->Username= "loaiza2610@gmail.com"; 
$mail->Contraseña = "1a2b3c4d5e6f$$"; 
$mail->SetFrom ("contactomex@kmimos.la"); 
$mail->Asunto =  "Prueba "; 
$correo->Cuerpo=  "hola"; 
$mail-> AddAddress ("loaiza2610@gmail.com");*/

    // Define que estamos enviando por SMTPAuth	
    $phpmailer->isSMTP();
 
    // La dirección del HOST del servidor de correo SMTP p.e. smtp.midominio.com
    $phpmailer->Host = "smtp.gmail.com";
 
    // Uso autenticación por SMTP (true|false)
    $phpmailer->SMTPAuth = true;
 
    // Puerto SMTP - Suele ser el 25, 465 o 587
    $phpmailer->Port = "465";
 
    // Usuario de la cuenta de correos
    $phpmailer->Username = "loaiza2610@gmail.com";
 
    // Contraseña para la autenticación SMTP
    $phpmailer->Password = "1a2b3c4d5e6f$$";
 
    // El tipo de encriptación que usamos al conectar - ssl (deprecated) o tls
    $phpmailer->SMTPSecure = "tls";
 
    $phpmailer->From = "contactomex@kmimos.la";
    $phpmailer->FromName = "Kmibox";
    
}







