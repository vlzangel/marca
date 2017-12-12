<?php $user = get_user_info(); //get_user_info2
	/*$user1 = get_user_info2();*/ 
/*print_r($user);*/
/*print_r($user1);*/
?>

<article class="row">
<form id="form-registro">
	<div id="register" 
		class="col-md-8 col-xs-12 col-md-offset-2" 
		style="border-radius:10px; border:1px solid #ccc; margin-top:20px;">
		<div class="row form-horizontal">

			<div class="col-sm-12">
				<div class="row">
					<h2 class="col-sm-6">Información del usuario</h2>
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-12">
					<input readonly class="readonly form-control profile-content-input col-md-12" name="r_usuario" placeholder="Email"
						value="<?php echo $user['email']; ?>">				
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="nombre" class="form-control profile-content-input"  placeholder="Nombre"
						value="<?php echo $user['first_name']; ?>">
				</div>
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="apellido" class="form-control profile-content-input"  placeholder="Apellido"
						value="<?php echo $user['last_name']; ?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6">
					<div class="row">
					  <div class="col-md-7">
						<div class="list-inline form-group list-unstiled">
							
								
									<div class="checkbox" style="margin-left: 40px">
										<label>Sexo</label>
										<label>
											<input <?php echo ($user['sexo']=='m')? 'checked': '' ; ?> 
												type="radio" name="sexo" value="m">M
										</label>
									
										<label>
											<input <?php echo ($user['sexo']=='f')? 'checked': '' ; ?> 
												type="radio" name="sexo" value="f"> F
										</label>
									</div>		
						</div>							
							
			          </div>
						<div class="col-md-5 form-group">
							<select class="form-control profile-content-input col-md-6" name="edad">
								<option value="<?php echo $user['edad']; ?>"><?php echo $user['edad']; ?></option>
								<?php for ($i=18; $i < 100; $i++) { ?> 
									<?php if( $i != $user['edad'] ){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="mascota" class="form-control profile-content-input "  placeholder="Nombre de la Mascota"
						value="<?php echo $user['mascota']; ?>">				
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="telef_movil" class="form-control profile-content-input "  placeholder="Teléfono móvil" maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
							value="<?php echo $user['telef_movil']; ?>">
				</div>
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="telef_fijo" class="form-control profile-content-input "  placeholder="Teléfono fijo" maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
							value="<?php echo $user['telef_fijo']; ?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-12 form-group">


					<select class="has-error form-control profile-content-input" name="dondo_conociste" value="<?php echo $user['dondo_conociste']; ?>">	

						<option value=""><?php echo $user['dondo_conociste']; ?></option>
						<option value="redes sociales">Redes Sociales</option>
						<option value="google">Google</option>
						<option value="amigos/familiares">Amigos/Familiares</option>
						<option value="otros">Otros</option>
					</select>
					
				</div>	
			</div>
			 			
			<div class="col-sm-12 hidden">
				<div class="row">
					<h2 class="col-sm-6">Dirección</h2>
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 form-group">
					<input type="text" name="dir_calle" class="form-control profile-content-input"  placeholder="Calle"
						value="<?php echo $user['calle']; ?>">
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="row">
						<div class="col-md-6 col-sm-6 form-group">
							<input type="text" name="dir_numext" class="has-error form-control profile-content-input"   maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
								placeholder="Número exterior" value="<?php echo $user['dir_numext']; ?>">
						</div>
						<div class="col-md-6 col-sm-6  form-group">
							<input type="text" name="dir_numint" class="has-error form-control profile-content-input"  maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
								placeholder="Número interior" value="<?php echo $user['dir_numint']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 form-group ">
					<select class="form-control profile-content-input" name="dir_estado">
						<option>Estado</option>
						<?php
							$estados = get_estados();
							if( count($estados) > 0 ){ 
								foreach ($estados as $estado) { ?>
									<?php $select_estado = ($estado->id == $user['estado'])? 'selected' : '';?>
									<option <?php echo $select_estado; ?> value="<?php echo utf8_decode($estado->id);?>">
										<?php echo utf8_decode($estado->name);?>
									</option>	
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-6 col-sm-6  form-group">
					<select class="form-control profile-content-input" name="dir_ciudad">
						<option>Ciudad</option>
						<?php
							$municipios  = get_municipios($user['estado']);
							if( count($municipios) > 0 ){ 
								foreach ($municipios as $municipio) { ?>
									<?php $select_estado = ($municipio->id == $user['city'])? 'selected' : '';?>
									<option <?php echo $select_estado; ?> value="<?php echo utf8_decode($municipio->id);?>">
										<?php echo utf8_decode($municipio->name);?>
									</option>	
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6  form-group">
					<input type="text" name="dir_colonia" class="form-control profile-content-input"  placeholder="Colonia"
						value="<?php echo $user['colonia']; ?>">				
				</div>
				<div class="col-md-6 col-sm-6 form-group ">
					<input type="text" name="dir_codigo_postal" class="form-control profile-content-input"  placeholder="Código postal"
						value="<?php echo $user['codigo_postal'];?>">
				</div> 
			</div>

			<div class="col-sm-12 hidden">
				<div class="row">
					<h2 class="col-sm-6">Información de la cuenta</h2>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6  form-group">
					<input type="password" name="r_clave" class="hidden has-error form-control profile-content-input" id="inputPassword3" placeholder="Clave">
				</div>
				<div class="col-md-6 col-sm-6  form-group">
					<input type="password" name="r_clave_c" class="hidden has-error form-control profile-content-input" id="inputPassword3" placeholder="Confirmar clave">
				</div>
				<div class="col-sm-12 text-center" style="padding-bottom:20px;">
					<button id="btn-register_" class="btn btn-sm-kmibox">Guardar</button>
				</div>
			</div>

		</div>
		<br>
	</div>
	
</form>
</article>