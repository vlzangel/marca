<?php
    $url = realpath( __DIR__ . '/../../../../../wp-load.php' );
    include_once( $url );
    
    global $wpdb;

    extract($_POST);

    $asesor = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '{$codasesor}'");

    if ($asesor->id !== null) {
        foreach ($asesor as $data) {
            if ($data->codigo_asesor !== false) {
                $existe = "SI";     
            }else{
                $existe = "NO";
            }
        }
    }

    if( $existe !== "SI" ){
       $asesor = [
            'id' => "NO_ASESOR",
            'msg' => "No existe el asesor!"
        ];
    }

    echo json_encode($asesor);

    exit();
?>