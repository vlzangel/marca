<article class="row">
	
	<div id="register"	class="col-md-12 col-xs-12 col-md-offset-0" style="border-radius:10px; border:1px solid #ccc; margin-bottom: 2%; padding-bottom: 15px;">
		<div class="row">

			<form class="form-horizontal" id="form-registro" method="post">

				<div class="row">					
					<h2 class="col-sm-6">INFORMACIÓN DEL USUARIO</h2>
				</div>

				<div class="row row-special campos-obligatorios">
					<span class="fa fa-asterisk" aria-hidden="true"></span>
					<small> Campos obligatorios</small>
				</div>

				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input data-charset="xlf" type="text" name="nombre" class="form-control col-md-6" id="inputEmail3" placeholder="Nombre y Apellido"  maxlength="40" >
					</div>
					<div class="col-md-8">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<div class="col-md-4 label-group form-group">
							<label>Sexo: </label>
							<label>
								<input type="radio" name="sexo" value="m"> M
							</label>
							<label>
								<input type="radio" name="sexo" value="f"> F
							</label>
						</div>
						<div class="col-md-4 form-group">
							<i class="fa fa-asterisk fa-especial fa-especial" aria-hidden="true"></i>
							<select class="form-control" name="edad">
								<option>Edad</option>
								<?php for ($i=18; $i < 100; $i++) { ?> 
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<input type="text" name="mascota" data-charset="alf" class="form-control col-md-6" id="mascota" placeholder="Nombre de la Mascota"  maxlength="50">
						</div>
					</div>
				</div>

				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="telef_movil" data-charset="num" class="form-control col-md-6" id="telef_movil" placeholder="Teléfono móvil" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  maxlength="13">
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="telef_fijo" data-charset="num" class="form-control col-md-6" id="telef_fijo" placeholder="Teléfono fijo"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="13">
					</div>
				</div>

				<div class="row row-special">					
					<div class="col-md-10 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-6" name="dondo_conociste">
							<option value="">Cuéntanos, dónde nos conociste</option>
							<option value="redes sociales">Redes Sociales</option>
							<option value="google">Google</option>
							<option value="amigos/familiares">Amigos/Familiares</option>
							<option value="otros">Otros</option>
						</select>
					</div>
				</div>
					
				<div class="row">					
					<h2 class="col-sm-6">INFORMACIÓN DE LA CUENTA</h2>
				</div>

				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="email" name="r_usuario" data-charset="xlfnumesp" class="form-control col-md-6" id="r_usuario" placeholder="Email"  maxlength="40">
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="email" name="r_usuario_c" data-charset="xlfnumesp" class="form-control col-md-6" id="r_usuario_c" placeholder="Confirmar email"  maxlength="40">
					</div>
				</div>
				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="password" name="r_clave" data-charset="xlfnumesp" class="form-control col-md-6" id="r_clave" placeholder="Clave"  maxlength="20">
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="password" name="r_clave_c" data-charset="xlfnumesp" class="form-control col-md-6" id="r_clave_c" placeholder="Confirmar clave" maxlength="20">
					</div>
				</div>

				<div class="row">					
					<h2 class="col-sm-6">DIRECCIÓN</h2>
				</div>
		 
				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="dir_calle" class="form-control col-md-6" data-charset="xlfnumesp" id="dir_calle" placeholder="Calle" maxlength="50">
					</div>
					<div class="col-md-8 form-group">
						<div class="row">
							<div class="col-md-4">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<input type="text" name="dir_numext" data-charset="xlfnumesp" class="form-control col-md-6" id="dir_numext" placeholder="Número exterior"  minlength="1" maxlength="20">
							</div>
							<div class="col-md-4">
								<input type="text" name="dir_numint" data-charset="xlfnumesp" class="form-control col-md-6" id="dir_numint" placeholder="Número interior"  minlength="1" maxlength="20">
							</div>
						</div>
					</div>
				</div>

				
				<div class="row row-special">					
					
					<div class="col-md-8" style="padding: 0px 15px 0px 0px !important;">

						<div class="row row-special">					
							<div class="col-md-6 form-group">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<input type="text" name="dir_colonia" data-charset="xlfnumesp" class="form-control col-md-6" id="dir_colonia" placeholder="Colonia"  maxlength="50">
							</div>
							<div class="col-md-6 form-group">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<input type="text" name="dir_codigo_postal" data-charset="numalf" class="form-control col-md-6" id="dir_codigo_postal" placeholder="Código postal" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="15">
							</div>
						</div>

						<div class="row row-special">					

							<div class="col-md-6 form-group">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>					
								<select class="form-control col-md-4" name="dir_estado">
									<option>Estado</option>
									<?php
										$estados = get_estados();
										if( count($estados) > 0 ){ 
											foreach ($estados as $estado) { ?>
												<option value="<?php echo utf8_decode($estado->id);?>">
													<?php echo utf8_decode($estado->name);?>
												</option>	
										<?php } ?>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
								<select class="form-control col-md-4" id="dir_ciudad" name="dir_ciudad">
									<option>Delegación</option>							
								</select>
							</div>
						</div>

					</div>

				</div>

					<div class="row">					
						<h2 class="col-sm-6">INFORMACIÓN DEL ASESOR</h2>
						
					</div>

						<div class="row row-special">	
						
							<div class="col-md-3 form-group" style="padding-top: 15px;">
								<input data-charset="num" type="text" name="codidoasesor" class="form-control col-md-6" id="codidoasesor" placeholder="Código del asesor"  maxlength="40" />
							</div>
							<div class="col-md-3 form-group" style="padding-top: 15px;">
								<input data-charset="xlfnumesp" type="email" name="emailasesor" class="form-control col-md-6" id="emailasesor" placeholder="Correo del asesor"  maxlength="40" >
							</div>
						<div class="col-md-4" >	
							<div class="col-sm-offset-1	col-sm-11 text-center">
								<button id="btn-register_" class="btn-register_ btn btn-sm-kmibox" style="color: #94d400; border: 2px solid #091705;">Registrarme</button>
								<div id="error_registrando"> Por favor revisar tus datos arriba, hay algún campo incompleto </div> 
								<div id="success_registrando"> Registro Exitoso </div>
		 					</div>
		 					<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje">Prueba</aside>
						</div>

						
					</div>
				

			</form>
		</div>
	</div>

</article>

