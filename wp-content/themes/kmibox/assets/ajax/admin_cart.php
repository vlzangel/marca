<?php
 
if(!session_id()){session_start();}


// Service Response
if($_POST){
	if( array_key_exists('key', $_POST['xdata']) ){
		$key = $_POST['xdata']['key'];
		$data = $_POST['xdata'];

		switch ($key) {
			case 'save_session_cart':
				$_SESSION['kmibox_param'] = $data['param'];
				break;
			case 'create':
				create_cart();
				break;
			case 'get_cart':
				$cart = (array_key_exists('carrito', $_SESSION))? $_SESSION['carrito'] : [] ;
				print_r(json_encode($cart));
				break;
			case 'update_cant':
				if( $data['cant']>0 ){
					print_r (update_cantidad( $data[ 'ID' ] , $data[ 'cant' ] ));
				}
				break;
			case 'delete':
				if( $data['id']>0 ){
					print_r(  delete_item( $data['id'] )  );
				}
				break;
			default:
				print_r("error");
				break;
		}
	}
}


function delete_item( $id ){
	$cart = $_SESSION['carrito'];
	foreach ($cart['items'] as $key => $row) {
		if( $row['ID'] == $id ){
			unset( $_SESSION['carrito']['items'][$key] );
			return $row['ID'];
		}
	}	
}

function update_cantidad( $id, $cant ){
	$cart = $_SESSION['carrito'];
	$total = 0;
	$n =0;
	foreach ($cart['items'] as $key => $row) {
		if( $row['ID'] == $id ){
			$row['cant'] = $cant;
			$n = $cant;
			$row['total']= $row['price'] * $cant;
			$cart['items'][$key] = $row;		
			$_SESSION['carrito'] = $cart;
		}
		$total += $row['total'];
	}

	return $n;
}

function create_cart(){
	$sts = "metodo invalido";
	if( $_POST ){
		$sts = "faltan parametros";
		if( !empty($_POST) ){
			$_SESSION['carrito'] = $_POST['xdata'];
			cart_constructor();
			$sts = "correcto";
		}
	}
}



function cart_constructor(){

	$data = [];
	$data['items'] = [];
	$data['cant_item']= 0;
	$data['iva']=0;		

	if( $_SESSION ){
		if( array_key_exists('carrito', $_SESSION) ){

			// *************************
			// kmibox
			// *************************
			$_item['thumnbnail'] = "";
			$_item['name']  = "";
			$_item['price'] = 0;
			$_item['cant']  = 1;
			$_item['total'] = 0;
			$_item['iva'] = 0;
			$_item['type'] = 'primary';
			
			$_item['plan'] = '';
			$_item['size'] = '';
			$_item['title'] = '';



			if( array_key_exists( 'kmibox', $_SESSION['carrito'] )) {

				$kmibox = $_SESSION['carrito']['kmibox'];
				$plan = $kmibox['plan'][ $_SESSION['carrito']['plan'] ];

				// Imagen
				if( array_key_exists( 'gallery', $kmibox ) ){	
					$gallery = $kmibox['gallery'];
					if( array_key_exists( 'thumnbnail', $gallery ) ){
						$_item['thumnbnail'] = $gallery['thumnbnail'];
					}
				}
				// Contenido
				if( array_key_exists( 'content', $kmibox ) ){
					$content = $kmibox['content'];

					if( array_key_exists( 'ID', $content ) ){
						$_item['ID'] = $content['ID'];
					}
					if( array_key_exists( 'post_content', $content ) ){
						$_item['name'] = "{$content['post_title']} - {$plan['size']}, {$plan['plan']} ";
						
						$_item['title'] = $content['post_title'];
						$_item['size'] = $plan['size'];
						$_item['plan'] = $plan['plan'];
						
						$data['kmibox']['title'] = $content['post_title'];
						$data['kmibox']['size'] = $plan['size'];
						$data['kmibox']['plan'] = $plan['plan'];

					}
				}
				// Precio
				if( array_key_exists( 'price', $plan ) ){
					$_item['price'] = $plan['price'];
				}
				// total
				//$_item['iva'] = $_item['price'] * 0.12;

				$_item['total'] = $_item['price'] + $_item['iva'];

				// Agregar item kmibox
				if( !empty($_item) ){ 
					$data['items'][] = $_item;
				}
			}

			// *************************
			// extras
			// *************************
			if( array_key_exists('extras', $_SESSION['carrito']) ){
				foreach ($_SESSION['carrito']['extras'] as $key => $value) {
					$_item = [];
					$_item = $value;
					$_item['cant'] = 1;
					$_item['type'] = 'extra';
					$_item['total'] = $_item['price'] * $_item['cant'];

					$data['items'][] = $_item;

				}	
			}
		}
	}
	$_SESSION['carrito'] = $data;


}
