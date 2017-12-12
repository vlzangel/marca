<pre>
<?php
if(!session_id()){session_start();}
print_r($_SESSION);
?>
</pre>


<?php
unset( $_SESSION['kmibox_param'] );
$key = $_GET['key'];

	$kmibox_param = $_SESSION['kmibox_param'];

	$result = '';
	switch ($key) {
		case 'fase1':
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
					$result = $kmibox_param['cart'][$key];
				}
			}
			break;
	}
	print_r( $kmibox_param );
	print_r( $result );
