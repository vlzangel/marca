<?php
    $url = realpath( __DIR__ . '/../../../../../wp-load.php' );
    include_once( $url );
    
    global $wpdb;

    extract($_POST);

    $cliente = $wpdb->get_row("SELECT id, user_email FROM wp_users WHERE user_email = '{$email}'");

    if ($cliente->id !== null) {

        $telef_movil = get_user_meta($cliente->id, 'telef_movil', true);
        $first_name =  get_user_meta($cliente->id, 'first_name', true);
        $last_name =  get_user_meta($cliente->id, 'last_name', true);

        echo json_encode(
            [
                'id' => $cliente->id, 
                'email' => $cliente->user_email,
                'telefono' => $telef_movil,
                'nombre' => $first_name,
                'apellido' => $last_name,
            ] 
        );
    }else{
        echo json_encode(
            [
                'id'=> 0,
                'msg'=> "El Cliente no existe"
            ]
        );
    }

    exit();
?>