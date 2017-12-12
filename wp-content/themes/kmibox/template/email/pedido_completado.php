<?php 
/*$email="asdasdasda";
$tlf_fijo="1234565";
$Tiempo="1254886";
$fec_ini="12/08";
$fec_fin="12/08";
$name="carlos";
$pedido="12548963";
$fecha="17/10/2017";
$hora="12:00:00";
$lugar="su casa";
$fec_ini="12/08";
$Precio_Total="28/08";
$año="2017";
$name_cuidador="jose peralez";
$Cantidad="aaaaaaaaaaaaaaa";
$TOTAL="aaaaaaaaaaaaaa";
$TIENDA="aaaaaaaaaaaaaa";
$EFECTIVO="aaaaaaaaaaaaa";
$Precio_Unitario="aaaaaaaaa";
$tlf_fijo="123546";
$tlf_movil="123546";
$Tamaño="aaaaaaaaaaaaaaa";
$Nombre="aaaaaaaaaaaaaa";
$Raza="aaaaaaaaaaaaaa";
$Edad="aaaaaaaaaaaaa";
$Comportamiento="aaaaaaaaa";
$Mascota="aaaaaaaaaaaaa";
$direccion="los chorros";
$Tipo_Pago="Pago en efectivo en tiendas de conveniencia";
$Estadia="1 noche(s)";
$Servicio="Hospedaje";
$PAGO_EN_TIENDA="-35";*/
$HTML = "
<div style=\"margin-left: 120px;width:600px;\">	
		<div style=\"
			padding: 10px 20px;
			background-color:#BF00FF;
			margin-bottom:20px;
			text-align:center;
		\">
			<p style=\" color:#ffffff; font-size: 24px\">¡Tu pedido está en camino!</p>
		</div>

	
		<div style=\"border: 1px solid #ccc; padding: 15px; text-align:left;\">

					<p>¡Hola hola! Ya terminamos de procesar tu pedido de kmibox. A continuación puedes encontrar los detalles de tu pedido:</p>
					<p style=\" color:#BF00FF\"><B>Pedido #".$order_id."</B></p>
			
			<br>
			<div style=\"text-align: center\">
				<div class='row' >
				    
				    <div style=\"float:left;width:30%;text-align: center; border: 1px solid #000000;\">
				    		<p>producto</p> 
					</div>
				    <div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000; \">
				    		<p>Cantidad</p>    
					</div>
					<div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000;\">
				    	 	<p>Precio</p>   
					</div>			
					<div  style='clear:both;'></div>
				</div>
				<div class='row' >
				    
				    <div style=\"float:left;width:30%;text-align: center; border: 1px solid #000000;\">
				    		  
				        	<p>".$producto."</p>
					</div>
				    <div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000; \">
				    				    	
							<p>".$cantidad."</p>    
					</div>
					<div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000;\">
				    	 	 
					    	<p>$".$precio."</p>  
					</div>			
					<div  style='clear:both;'></div>
				</div>
				<div class='row' >
				    
				    <div style=\"float:left;width:60.4%;text-align: center; border: 1px solid #000000;\">
				    		  
				        	<p  style=\" text-align: left\">Subtotal</p>
					</div>
				    
					<div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000;\">
				    	 	 
					    	<p>$".$subtotal."</p>  
					</div>			
					<div  style='clear:both;'></div>
				</div>
				<div class='row' >
				    
				    <div style=\"float:left;width:60.4%;text-align: center; border: 1px solid #000000;\">
				    		  
				        	<p  style=\" text-align: left\">Total</p>
					</div>
				    
					<div style=\"float:left;width:30%; text-align: center; border: 1px solid #000000;\">
				    	 	 
					    	<p>$".$total."</p>  
					</div>			
					<div  style='clear:both;'></div>
				</div>
				
			</div> 
			</div>
			<br>

			<div> 
			<h3 style=\" color:#BF00FF\">Datos de cliente</h3>
				<ul>
					<li>Dirección de correo electrónico: ".$email."</li>
					<li>Teléfono: ".$telefono."</li>
				</ul>
			</div> 

			<br>
			<div style=\"
				border: 1px solid #000000;\">
				<div tyle=\"margin-left: 50px\">
					<h3 style=\" color:#BF00FF\">Dirección Principal</h3>
						<p>".$direccion."</p>
				</div>
			</div> 
			</div>
		
"; 
/*print_r($HTML);
function get_home_url(){
	return "http://kmibox.git/";
}*/
?>