
<?php 
/*$email="asdasdasda";
$tlf_fijo="1234565";
$tlf_movil="1254886";
$Precio_Total="28/08";
$Tiempo="1254886";	
$name="carlos";
$code="12548963";
$fecha="17/10/2017";
$hora="12:00:00";
$lugar="su casa";
$fec_ini="12/08";
$fec_fin="28/08";
$año="2017";
$name_acuidar="jose peralez";
$Tamaño="aaaaaaaaaaaaaaa";
$Nombre="aaaaaaaaaaaaaa";
$Raza="aaaaaaaaaaaaaa";
$Edad="aaaaaaaaaaaaa";
$Comportamiento="aaaaaaaaa";
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
<style type=\"text/css\">

.Rectangle-6 {
  width: 158.8px;
  height: 50.3px;
  border-radius: 2.8px;
  background-color: #f4f4f4;
}
.Solicitud-para-conocer-ciudador {
  width: 769px;
  height: 1202px;
  background-color: #ffffff;
}

.Recibimos-tu-solicit {
  width: 435px;
  height: 30px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1.07;
  letter-spacing: 0.3px;
  color: #000000;
}
.Path-4 {
  width: 97px;
  height: 33px;
  background-color: #98e8e1;
  background-color: var(--light-teal);
}

.Group-29 {
  width: 494px;
  height: 30px;
  object-fit: contain;
}

.Rectangle-32 {
  width: 600px;
  height: 62px;
  background-color: #000000;
}

.wwwkmimoscommx {
  width: 111px;
  height: 12px;
  font-family: Arial;
  font-size: 11px;
  letter-spacing: 0.2px;
  color: #ffffff;
}
.Hilda-M {
  width: 85px;
  height: 22px;
  font-family: Arial;
  font-size: 20px;
  font-weight: bold;
  color: #000000;
}
.layer {
  width: 175px;
  height: 16px;
  font-family: Arial;
  font-size: 14px;
  letter-spacing: 0.3px;
  color: #000000;
}

.hildalilayahooocom {
  width: 146px;
  height: 16px;
  font-family: Arial;
  font-size: 14px;
  letter-spacing: 0.3px;
  color: #000000;
}

.DATOS-DEL-CUIDADOR {
  width: 190px;
  height: 12px;
  font-family: Arial;
  font-size: 11px;
  font-weight: bold;
  letter-spacing: -0.1px;
  color: #0d7ad9;
}

.layer1 {
  width: 85px;
  height: 17px;
  font-family: Arial;
  font-size: 15px;
  font-weight: bold;
  letter-spacing: 0.3px;
  color: #000000;
}

.horas {
  width: 98px;
  height: 16px;
  font-family: Arial;
  font-size: 14px;
  letter-spacing: 0.3px;
  color: #000000;
}

.lugar {
  width: 73px;
  height: 16px;
  font-family: Arial;
  font-size: 14px;
  letter-spacing: 0.3px;
  color: #000000;
}

.Tu-cdigo-de-solicit {
  width: 142px;
  height: 14px;
  font-family: Arial;
  font-size: 12px;
  letter-spacing: 0.3px;
  color: #000000;
}
.Hola {
  width: 250px;
  height: 22px;
  font-family: Arial;
  font-size: 20px;
  font-weight: bold;
  letter-spacing: 0.4px;
  color: #6b1c9b;
}
table {
  border-collapse: collapse;
  margin: 15px;
  padding: 15px;
}

.Bitmap {
  width: 127px;
  height: 39px;
  object-fit: contain;
}
p{
	margin:0px!important;
}
.row{
	margin-bottom:10px;
}
</style>

<div class='Solicitud-para-conocer-ciudador'>
				<div style=\"text-align:center;	\">
			<img src=\"".get_home_url()."/img/Maquetacion_Correo/bitmap.png\">
			<br>
					
		
			<img src=\"".get_home_url()."/img/Maquetacion_Correo/header_nueva_reserva.png\"  >
			</div>
			<br>
		
		<div style=\"margin-left: 200px;width:600px;\">

			<p style=\" color: #6b1c9b; text-align: left\"><B>Hospedaje por  ".$name."</B></p>	
			
			<p style\" font-family: Arial; font-size: 20px;\">¡Hola <B>Cuidador!</B></p>		
			
		    <p class='Recibimos-tu-solicit'>El cliente <B>".$name."</B> ha enviado una solicitud de reserva</p>
		    <br>
		    
			

		    <div style=\"text-align:center;\">
					<p><B>¿Aceptas la solicitud?</B></p>
					<a href=#><img src=\"".get_home_url()."/img/Maquetacion_Correo/btn_aceptar.png\" ></a>
					<br>
					<p style=\" color: #6b1c9b;  \">AHORA NO PUEDO <a href=#>RECHAZAR</a></p>
					<br><br>
</div>
			<div>
				<div class='row' >
						<div style=\"text-align:justify;\">
				    <div style=\"float:left;width:30%; text-align: right\">    
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/identificacion.png\" >
					</div>
				    <div style=\"float:left;width:40%;\">    
				        <p class='DATOS-DEL-CUIDADOR'>DATOS DEL CLIENTE</p>					    
						<p style=\"font-family: Arial; font-size: 20px; font-weight: bold;\"><B>".$name."</B></p>
						<p style=\"font-family: Arial; font-size: 14px; \"><img src=\"".get_home_url()."/img/Maquetacion_Correo/mobile.png\" >".$tlf_fijo."/".$tlf_movil."</p>
					    <p style=\"font-family: Arial; font-size: 14px; \"><img src=\"".get_home_url()."/img/Maquetacion_Correo/mail.png\" >".$email."</p>
					</div>
				    <div style=\"float:left;width:30%; background-color:#f4f4f4\">    
						<p class='Tu-cdigo-de-solicit'>tu codigo de solicitud es:</p>
						<p class='layer'><B>".$code."</B></p>
					</div>		
					<div  style='clear:both;'></div>
						</div>
				</div>
			</div>
		

			
<br><br>
			 
<h4 style=\" color:#0d7ad9 \">Detalle de las mascotas</h4>


<div>
				<div class='row' >
				    <div style=\"float:left;width:20%; background-color:#f4f4f4\">    
						<p style=\"text-align: center\"><img src=\"".get_home_url()."/img/Maquetacion_Correo/dog.png\"  ></p>
						<p style=\"text-align: center\" >Nombre</p>					    
					</div>
				    <div style=\"float:left;width:20%;text-align: center;background-color:#f4f4f4\">
				    	<p >Raza</p>    
				        <p >".$Raza."</p>
					</div>
				    <div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	<p >Edad</p>				    	
						<p >".$Edad."</p>    
					</div>
					<div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	 <p >Tamaño</p> 
					    <p '>".$Tamaño."</p>  
					</div>	
					<div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	<p >Comportamiento</p>
					    <p>".$Comportamiento."</p> 
					</div>			
					<div  style='clear:both;'></div>
				</div>
				
		

	
			

<br><br>

<h4 style=\" color:#0d7ad9; font-size:11px;\">DETALLE DEL SERVICIO</h4>
			
	
			<div class='row' >				
				    <div style=\"float:left;width:10%;\">    
						<p class='Tu-cdigo-de-solicit'><B>Servicio</B><br>
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/min_calendar.png\"  ><br>
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/min_clock.png\"  ><br>
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/min_cash.png\"  >
					</div>					
				    <div style=\"float:left;width:50%;\">    
						<p style=\"font-size:12px;\">".$Servicio."</p>
						<p style=\"font-size:12px;\">Del ".$fec_ini." al ".$fec_fin."</B> del ".$año."</p>
						<p style=\"font-size:12px;\">".$Estadia."</p>
						<p style=\"font-size:12px;\">".$Tipo_Pago."</p>
					</div>
					<div  style='clear:both;'></div>
				</div>
<br><br>
			<div>
				<div class='row' >
				    <div style=\"float:left;width:20%; background-color:#f4f4f4\">    
						<p style=\"text-align: center\"><img src=\"".get_home_url()."/img/Maquetacion_Correo/dog.png\"></p>
			       <p ><B>".$Mascota."</B></p>				    
					</div>
				    <div style=\"float:left;width:20%;text-align: center;background-color:#f4f4f4\">
				    	<p >Cantidad</p>    
				        <p >".$Cantidad."</p>
					</div>
				    <div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	<p >Tiempo</p>				    	
						<p >".$Tiempo."</p>    
					</div>
					<div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	 <p >Precio Unitario</p> 
					     <p >".$Precio_Unitario."</p>  
					</div>	
					<div style=\"float:left;width:20%; text-align: center; background-color:#f4f4f4\">
				    	<p >Precio Total</p>
					    <p>".$Precio_Total."</p> 
					</div>			
					<div  style='clear:both;'></div>
				</div>
				
			</div> 
		
			 <br>
			
				<div class='row' >				
				    <div style=\"float:right;width:30%; background-color:#f4f4f4\">    
						<p class='Tu-cdigo-de-solicit'>".$TOTAL."</p>
						<p class='layer'><B>".$TIENDA."</B></p>
						<p class='layer'><B>".$EFECTIVO."</B></p>
					</div>					
				    <div style=\"float:right;width:20%;\">    
						<p style=\"font-size:10px;\">TOTAL</p>
						<p style=\"font-size:10px;\"><B>PAGO EN TIENDA</B></p>
						<p style=\"font-size:10px;\">PAGO EN EFECTIVO</p>
						<p style=\"font-size:9px;\"><B>CLIENTE-CUIDADOR</B></p>
					</div>
					<div  style='clear:both;'></div>
				</div>
				<br>
<div>
				<div class='row' >
				    <div style=\" float:left;width:20%; background-color: #98e8e1; color: #6b1c9b;\">    
						<p ><B>IMPORTANTE</B></p>				    
					</div>
				    <div style=\"float:left;width:60%;text-align: center;background-color:#f4f4f4\">
				    	<p >Siguientes pasos, puntos a considerar</p>
					</div>
				    			
					<div  style='clear:both;'></div>
				</div>
				
			</div> 
			
				 </div>	
				 <br><br>		
<div>
				<div class='row' >
				    <div style=\"float:left;width:10%;\">    
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/presentate.png\">
					</div>
				    <div style=\"float:left;width:40%;\">    
				        <p>Preséntate con el cliente cordial y  formalmente.</p>
						<p><B>Tip: Cuida tu imagen</B> (Vestimenta casual)</p>
					</div>
					<div style=\"float:left;width:10%;\">    
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/camara.png\">
					</div>
				    <div style=\"float:left;width:30%; \">    
						<p>En caso de no conocerse en persona,<B> pide que te envíen fotos del perro</B>que llegará a tu casa para confirmar que sea tal cual lo describió su dueño. </p>
					</div>		
					<div  style='clear:both;'></div>
				</div>
				<div class='row' style='clear:both;' >
				    <div style=\"float:left;width:10%;\">    
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/requisito.png\">
					</div>
				    <div style=\"float:left;width:40%;\">    
						<p> <B>Solicita</B> que te compartan la cartilla de vacunación del perrito y verifica que <B>sus vacunas</B> estén al día.</p>
						<p><B>Tip: Sin cartilla no se harán efectivos</B> los beneficios veterinarios de Kmimos.</p>	
					</div>
					<div style=\"float:left;width:10%;\">    
						<img src=\"".get_home_url()."/img/Maquetacion_Correo/revision.png\">
					</div>
				    <div style=\"float:left;width:30%;\">    
						<p ><B>Revisa al perrito</B> y detecta si hubiese algún rasguño o golpe que pueda traer antes recibirlo, si detectas algo coméntale cordialmente al cliente y envíanos fotos vía whatsapp o correo.</p>	
					</div>
					<div  style='clear:both;'></div>
				</div>
			


	
				
				
					<br>
					<p style=\" font-size: 12px; font-family:Arial-BoldMT; \">En caso de dudas, puedes contactarte con nuestro equipo de atención al cliente al teléfono (01) 55 4742 3162, Whatsapp +52 (55) 6892 2182, o al correo contactomex@kmimos.la</p>
						
<br><br>
<div style=\"text-align:center;\">		
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					PRESÉNTATE Y CONOCE A TU KMIAMIGO
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/huesito.png\" >
					<br><br>
					<p>Recuerda que cada perro tiene un comportamiento diferente, por lo que deberás tener la mayor información posible sobre sus comportamientos.</p>

<br><br>


<div>
				<div class='row' >
				    <div style=\"float:left;width:30%; \">    
						<p><B>Sobre su rutina diaria</B></p>
						<p>Por ejemplo:</p>
				 		<p>¿Sale a pasear?</p>		
				 		<p>¿A qué hora come y hace del baño?</p>			    
					</div>
				    <div style=\"float:left;width:30%;text-align: center;\">
				    	<p><B>Sobre su comportamiento</B></p>
				    	<p>Por ejemplo:</p>
				  		<p>¿Cómo interactúa con otros perros y personas?</p>
				  		<p>¿Cómo reacciona con un extraño?</p> 
					</div>
				    <div style=\"float:left;width:30%; text-align: center; \">
				    	 <p><B>Sobre su ánimo</B></p>  
				    	 <p>Por ejemplo:</p>
				  		 <p>¿Cómo se comporta cuando está triste o estresado?</p> 
				  		 <p>¿Qué hace su dueño cuando está triste o estresado?</p>
					</div>
					<div  style='clear:both;'></div>
				</div>
				
			</div> 
	
</div>	
		<div style=\"text-align:center;\">		

					<br>
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/caracteristicas.png\" >
					<br>
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/dog_footer.png\" >
					<br>
					
					<br>


					<div style=\"					
							background-color:#000000;
							color: #fff;
							padding: 10px 10px;
						\">

					<p><img src=\"".get_home_url()."/img/Maquetacion_Correo/kamimos_footer.png\" > 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					www.kmimos.com.mx &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					Síguenos en 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src=\"".get_home_url()."/img/Maquetacion_Correo/icono_facebook.png\"></p>
					
				</div>

			<p style=\" text-align: center;\">¿Tienes dudas?   |   Contáctanos</p>
			</div>	
			</div>
			<br>
					
		</div>
";
/*print_r($HTML);
function get_home_url(){
	return "http://kmibox.git/";
}*/