<?php 	
	 

	if(!function_exists('marca_menu_reportes')){
        function marca_menu_reportes(){

            $opciones_menu_reporte = array(
                array(
                    'title'         =>  'Reportes',
                    'short-title'   =>  'Reportes',
                    'parent'        =>  '',
                    'slug'          =>  'organigrama',
                    'access'        =>  'manage_options',
                    'page'          =>  'organigrama',
                    'icon'          =>  '',
                    'position'      =>  4,
                    'add-menu-to'   =>  ['administrator','asesor', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Clientes'),
                    'short-title'   =>  __('Clientes'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'clientes',
                    'access'        =>  'manage_options',
                    'page'          =>  'clientes',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator', 'asesor', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Marcas'),
                    'short-title'   =>  __('Marcas'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'marcas',
                    'access'        =>  'manage_options',
                    'page'          =>  'marcas',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],
                ),
                array(
                    'title'         =>  __('Presentaciones'),
                    'short-title'   =>  __('Presentaciones'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'productos',
                    'access'        =>  'manage_options',
                    'page'          =>  'productos',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],
                ),
                array(
                    'title'         =>  __('Suscripciones'),
                    'short-title'   =>  __('Suscripciones'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'suscripciones',
                    'access'        =>  'manage_options',
                    'page'          =>  'suscripciones',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator','asesor', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Despacho'),
                    'short-title'   =>  __('Despacho'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'despacho',
                    'access'        =>  'manage_options',
                    'page'          =>  'despacho',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator','asesor', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Tipo de mascotas'),
                    'short-title'   =>  __('Tipo de mascotas'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'tipos',
                    'access'        =>  'manage_options',
                    'page'          =>  'tipos',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],
                ),
                array(
                    'title'         =>  __('Lista y Suscriptores'),
                    'short-title'   =>  __('Lista y Suscriptores'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'subscribers',
                    'access'        =>  'manage_options',
                    'page'          =>  'subscribers',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Asesores Niveles'),
                    'short-title'   =>  __('Asesores Niveles'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'asesores_niveles',
                    'access'        =>  'manage_options',
                    'page'          =>  'asesores_niveles',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],
                ),
                array(
                    'title'         =>  __('Asesores'),
                    'short-title'   =>  __('Asesores'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'asesores',
                    'access'        =>  'manage_options',
                    'page'          =>  'asesores',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],
                ),
                array(
                    'title'         =>  __('Detalle de Puntos'),
                    'short-title'   =>  __('Detalle de Puntos'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'asesores_puntos',
                    'access'        =>  'manage_options',
                    'page'          =>  'asesores_puntos',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator','asesor', 'asesor-wlabel'],
                ),
                array(
                    'title'         =>  __('Estructura de los Asesores'),
                    'short-title'   =>  __('Estructura'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'organigrama',
                    'access'        =>  'manage_options',
                    'page'          =>  'organigrama',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator','asesor', 'asesor-wlabel'],
                )

            );
            $activar_cupon = getConfig("cupones");

            if( $activar_cupon == "1" ){
                $opciones_menu_reporte[] = array(
                    'title'         =>  __('Cupones'),
                    'short-title'   =>  __('Cupones'),
                    'parent'        =>  'organigrama',
                    'slug'          =>  'cupones',
                    'access'        =>  'manage_options',
                    'page'          =>  'cupones',
                    'icon'          =>  '',
                    'add-menu-to'   =>  ['administrator'],                    
                );
            }

            $type = get_current_user_role();
            foreach($opciones_menu_reporte as $opcion){

                if( $opcion['parent'] == '' ){
                    if( in_array($type, $opcion['add-menu-to']) ){
                        add_menu_page(
                            $opcion['title'],
                            $opcion['short-title'],
                            $opcion['access'],
                            $opcion['slug'],
                            $opcion['page'],
                            $opcion['icon'],
                            $opcion['position']
                        );
                    }
                } else{
                    if( in_array($type, $opcion['add-menu-to']) ){
                        add_submenu_page(
                            $opcion['parent'],
                            $opcion['title'],
                            $opcion['short-title'],
                            $opcion['access'],
                            $opcion['slug'],
                            $opcion['page']
                        );
                    }
                }
            }
        }

        add_action('admin_menu','marca_menu_reportes');
    }



    if(!function_exists('get_current_codigo_asesor')){
        function get_current_codigo_asesor(){
            global $wpdb;
            $user = get_userdata( get_current_user_id() );
       
            $existe = $wpdb->get_var("SELECT codigo_asesor FROM asesores WHERE email = '{$user->user_email}' ");
            if ( !empty($existe) ){
                return $existe;
            }
            return '';
        }
    }

    if(!function_exists('get_current_user_role')){
        function get_current_user_role(){
            global $wpdb;
            $user_info = get_userdata( get_current_user_id() );
            $type = 'usuario';

            //verificar si es usuario momsweb
            $wlabel = get_user_meta( $user_info->ID, 'user_wlabel', true );
            

            switch( $user_info->roles[0] ){
                case 'administrator':
                    $type = $user_info->roles[0];
                    break;
                default:
                    $existe = get_current_codigo_asesor();
                    $role_object = get_role($user_info->roles[0]);

                    if(!empty($role_object)){ 
                        $role_object->remove_cap( 'manage_options' );
                        if ( !empty($existe) ){
                            $role_object->add_cap( 'manage_options' );
                            $type = 'asesor';
                            if( !empty($wlabel) ){
                                $type = 'asesor-wlabel';
                            }
                        }
                    }

                    remove_menu_page( "options-general.php" );
                    remove_menu_page( "profile.php" );
                    break;
            }
            return $type;
        }
    }

    /* Inclucion de paginas */

    if(!function_exists('marcas')){
        function marcas(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/marcas/marcas.php');
        }
    }

    if(!function_exists('productos')){
        function productos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/productos/productos.php');
        }
    }

    if(!function_exists('despacho')){
        function despacho(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/despacho/reporte_despacho.php');
        }
    }

    if(!function_exists('clientes')){
        function clientes(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/clientes/clientes.php');
        }
    }

    if(!function_exists('suscripciones')){
        function suscripciones(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/suscripciones/suscripciones.php');
        }
    }

    if(!function_exists('tipos')){
        function tipos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/tipos/tipos.php');
        }
    }

    if(!function_exists('subscribers')){
        function subscribers(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/subscribers/subscribers.php');
        }
    }

    if(!function_exists('cupones')){
        function cupones(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/cupones/cupones.php');
        }
    }

    if(!function_exists('asesores')){
        function asesores(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/asesores/asesores.php');
        }
    }

    if(!function_exists('asesores_niveles')){
        function asesores_niveles(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/asesores_niveles/asesores_niveles.php');
        }
    }

    if(!function_exists('asesores_puntos')){
        function asesores_puntos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/asesores_puntos/asesores_puntos.php');
        }
    }

    if(!function_exists('organigrama')){
        function organigrama(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/organigrama/organigrama.php');
        }
    }



    if(!function_exists('guardarImg')){

        function guardarImg($path, $_img, $medidas = array( 600, 450) ){
        	$imgx = explode(',', $_img);
			$img = end($imgx);
		    $sImagen = base64_decode($img);
		    if( !file_exists($path) ){ @mkdir($path); }
		    $name = time().".png";
		    $path = $path.$name;
		    @file_put_contents($path, $sImagen);
		    /*$sExt = @mime_content_type( $path );
		    switch( $sExt ) {
		        case 'image/jpeg':
		            $aImage = @imageCreateFromJpeg( $path );
		        break;
		        case 'image/gif':
		            $aImage = @imageCreateFromGif( $path );
		        break;
		        case 'image/png':
		            $aImage = @imageCreateFromPng( $path );
		        break;
		        case 'image/wbmp':
		            $aImage = @imageCreateFromWbmp( $path );
		        break;
		    }
		    $nWidth  = $medidas[0];
		    $nHeight = $medidas[1];
		    $aSize = @getImageSize( $path );
		    if( $aSize[0] > $aSize[1] ){
		        $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
		    }else{
		        $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
		    }
		    $aThumb = @imageCreateTrueColor( $nWidth, $nHeight );
		    @imageCopyResampled( $aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1] );
		    @imagepng( $aThumb, $path );
		    @imageDestroy( $aImage ); 
		    @imageDestroy( $aThumb );*/

		    return $name;
        }

    }

?>