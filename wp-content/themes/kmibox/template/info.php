<?php
	$donde_conociste = array(
		"redes sociales" => "Redes Sociales",
		"google" => "Google",
		"amigos/familiares" => "Amigos / Familiares",
		"otros" => "Otros"
	);
	$donde_conociste_str = "";
	foreach ($donde_conociste as $key => $value) {
		$donde_conociste_str .= '<option value="'.$key.'" '.selected($key, $user['dondo_conociste'], false).' >'.$value.'</option>';
	}


	$HTML .= '
		<section id="tab_1">
			<form id="form-registro_2">
				<div id="register" 
					class="col-md-8 col-xs-12 col-md-offset-2" 
					style="border-radius:10px; border:1px solid #ccc; margin-top:20px;">
					<div class="row form-horizontal">

						<div class="col-sm-12">
							<div class="row">
								<h2 class="col-sm-6 gothan">Información del usuario</h2>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="nombre" class="form-control profile-content-input"  placeholder="Nombre y Apellido"
									value="'.$user['first_name'].'">
							</div>
							<!--div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="apellido" class="form-control profile-content-input"  placeholder="Apellido"
									value="'.$user['last_name'].'"-->
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
												<input ';
													$HTML .= ($user['sexo']=='m') ? 'checked': '' ;
													$HTML .= ' type="radio" name="sexo" value="m"> M
											</label>
											<label>
												<input  ';
													$HTML .= ($user['sexo']=='f') ? 'checked': '' ;
													$HTML .= ' type="radio" name="sexo" value="f"> F
											</label>
										</div>		
									</div>		
						          </div>
									<div class="col-md-5 form-group">
										<select class="form-control profile-content-input col-md-6" name="edad">';
											for ($i=18; $i < 100; $i++) {
												$HTML .= '<option value="'.$i.'" '.selected($i, $user['edad'], false).' >'.$i.'</option>';
											} $HTML .= '
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="mascota" class="form-control profile-content-input "  placeholder="Nombre de la Mascota"
									value="'.$user['mascota'].'">				
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="telef_movil" class="form-control profile-content-input "  placeholder="Teléfono móvil" maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
									value="'.$user['telef_movil'].'">
							</div>
							<div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="telef_fijo" class="form-control profile-content-input "  placeholder="Teléfono fijo" maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
									value="'.$user['telef_fijo'].'">
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12 form-group">
								<select class="has-error form-control profile-content-input" name="dondo_conociste">
									'.$donde_conociste_str.'
								</select>
								
							</div>	
						</div>

							<div class="row">
								<h2 class="col-sm-6 gothan" style="margin-left: 3%; font-size: 18px; color: #000000">Información de cuenta</h2>
							</div>

						<div class="col-md-12">
							<div class="col-md-12">
								<input readonly class="readonly form-control profile-content-input col-md-12" name="r_usuario" placeholder="Email"
									value="'.$user['email'].'">				
							</div>
						</div>
						 			
						<div class="col-sm-12 ">
							<div class="row">
								<h2 class="col-sm-6 gothan" style="margin-left: 1%; font-size: 18px; color: #000000">Dirección</h2>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 form-group">
								<input type="text" name="dir_calle" class="form-control profile-content-input"  placeholder="Calle"
									value="'.$user['calle'].'">
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="col-md-6 col-sm-6 form-group">
										<input type="text" name="dir_numext" class="has-error form-control profile-content-input"   maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
											placeholder="Número exterior" value="'.$user['dir_numext'].'">
									</div>
									<div class="col-md-6 col-sm-6  form-group">
										<input type="text" name="dir_numint" class="has-error form-control profile-content-input"  maxlength="13" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
											placeholder="Número interior" value="'.$user['dir_numint'].'">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 form-group ">
								<select class="form-control profile-content-input" name="dir_estado">
									<option>Estado</option>';
										$estados = get_estados();
										if( count($estados) > 0 ){ 
											foreach ($estados as $estado) {
												$select_estado = ($estado->id == $user['estado']) ? 'selected' : '';
												$HTML .= '<option '.$select_estado.' value="'.utf8_decode($estado->id).'">
													'.utf8_decode($estado->name).'
												</option>';
										}
									} $HTML .= '
								</select>
							</div>
							<div class="col-md-6 col-sm-6  form-group">
								<select class="form-control profile-content-input" name="dir_ciudad">
									<option>Ciudad</option>';
										$municipios  = get_municipios($user['estado']);
										if( count($municipios) > 0 ){ 
											foreach ($municipios as $municipio) {
												$select_estado = ($municipio->id == $user['city'])? 'selected' : '';
												$HTML .= '<option '.$select_estado.' value="'.utf8_decode($municipio->id).'">
													'.utf8_decode($municipio->name).'
												</option>';
										}
									} $HTML .= '
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6 col-sm-6  form-group">
								<input type="text" name="dir_colonia" class="form-control profile-content-input"  placeholder="Colonia"
									value="'.$user['colonia'].'">				
							</div>
							<div class="col-md-6 col-sm-6 form-group ">
								<input type="text" name="dir_codigo_postal" class="form-control profile-content-input"  placeholder="Código postal"
									value="'.$user['codigo_postal'].'">
							</div> 
						</div>
						
						<div class="col-md-12">
							<div class="col-sm-12 text-center" style="padding-bottom:20px;">
								<button id="btn-register_" class="btn-register_ btn btn-sm-kmibox">Guardar</button>
							</div>
						</div>

					</div>
					<br>
				</div>
				
			</form>

		</section>';
?>