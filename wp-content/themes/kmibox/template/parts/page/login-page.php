<div class="clear"></div>
<aside class="col-md-6 col-xs-12 hidden col-md-offset-4 alert alert-danger" id="login-mensaje"></aside>
<article id="inicio-sesion" 
		class="col-md-6 col-xs-12 col-md-offset-4" 
		style=" background-color: #94d400">

	
		<div class="col-md-10 col-md-offset-1 form-horizontal">

			<aside class="col-md-12 text-center" style="margin-bottom:40px;">
				
				<h4 style="color: #ffffff; font-family: caviar_dreamsregular">Iniciar sesión para continuar</h4>
				<h1 style="color: #ffffff; font-family: caviar_dreamsregular; font-weight: bold;">Marca</h1>
			</aside>

			<form id='form-login' class="form-horizontal">
				<div class="clearfix"></div>
				<div class="form-group input-icon">
					<i class="fa fa-user inter-input"></i>
					<input type="text" name="usuario" class="form-control" id="inputEmail3" placeholder="Email">
				</div>
					
				<div class="form-group" style="margin-bottom: 0px; color: #ffffff">
					<a style="color: #ffffff;"class="pull-right" href="<?php echo get_home_url(); ?>/recuperar-clave">¿Olvidaste tu contraseña?</a>
				</div>

				<div class="form-group input-icon">
					<i class="fa fa-lock inter-input"></i>
					<input type="password" name="clave" class="form-control" id="inputPassword3" placeholder="Clave">
				</div>

				<div class="form-group ">
					<label style="color: #ffffff;">
						<input type="checkbox" name="rememberme"> Recordar mi perfil 	
					</label>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button id="btn-login" type="submit" class="btn btn-sm-kmibox">Iniciar sesion</button>
						<br>
						<br>
						<label>¿Aún no tienes perfil Marca? </label>
						<a href="<?php echo get_home_url().'/'; ?>registro" id='link-registro' data-target="inicio-sesion" >
							<span>Regístrate aquí</span>
						</a>
					</div>
				</div>

			</form>
		</div>
	
</article>
<div class="clear"></div>