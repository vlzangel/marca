<?php 	
	
	    if(!function_exists('marca_menu_reportes')){
        function marca_menu_reportes(){

            $opciones_menu_reporte = array(
                array(
                    'title'         =>  'Reportes',
                    'short-title'   =>  'Reportes',
                    'parent'        =>  '',
                    'slug'          =>  'productos',
                    'access'        =>  'manage_options',
                    'page'          =>  'productos',
                    'icon'          =>  '',
                    'position'      =>  4,
                ),
                array(
                    'title'         =>  __('Productos'),
                    'short-title'   =>  __('Productos'),
                    'parent'        =>  'productos',
                    'slug'          =>  'productos',
                    'access'        =>  'manage_options',
                    'page'          =>  'productos',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Reporte despacho'),
                    'short-title'   =>  __('Reporte despacho'),
                    'parent'        =>  'productos',
                    'slug'          =>  'reporte_despacho',
                    'access'        =>  'manage_options',
                    'page'          =>  'reporte_despacho',
                    'icon'          =>  '',
                )
            );

            foreach($opciones_menu_reporte as $opcion){
                if( $opcion['parent'] == '' ){
                    add_menu_page(
                        $opcion['title'],
                        $opcion['short-title'],
                        $opcion['access'],
                        $opcion['slug'],
                        $opcion['page'],
                        $opcion['icon'],
                        $opcion['position']
                    );
                } else{
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

        add_action('admin_menu','marca_menu_reportes');
    }

    /* Inclucion de paginas */

    if(!function_exists('productos')){

        function productos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/productos/productos.php');
        }

    }

    if(!function_exists('reporte_despacho')){

        function reporte_despacho(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/despacho/reporte_despacho.php');
        }

    }

	/*add_action('admin_menu','kb_admin_menu');
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
	} */
?>