<div class="clear"></div>
<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
<article id="inicio-sesion" 
		class="col-md-6 col-xs-12 col-md-offset-3" 
		style=" background-color: #ffffff; height: 600px; ">

	
		<div class="col-md-10 col-md-offset-1 form-horizontal">

			<aside class="col-md-12 text-center" style="margin-bottom:40px;">
				
				<h4 style="color: #000000; font-family: GothanMedium_regular">Inicia Sesión para continuar</h4>
				<img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive">
			</aside>

			<form id='form-login' class="form-horizontal">
				<div class="clearfix"></div>
				<div class="form-group input-icon">
					<i class="fa fa-user inter-input"></i>
					<input type="text" name="usuario" class="form-control" id="inputEmail3" placeholder="Email" maxlength="40">
				</div>
					
				

				<div class="form-group input-icon">
					<i class="fa fa-lock inter-input"></i>
					<input type="password" name="clave" class="form-control" id="inputPassword3" placeholder="Clave" maxlength="40">
				</div>

				<div class="form-group text-center">
					<label style="color: #000000; ">
						<input type="checkbox" name="rememberme"> Recuerdame 	
					</label>
				</div>

				<div class="form-group col-xs-10 text-center gothan" style="margin-bottom: 0px; color: #ffffff">
					<a style="color: #000000; margin-left: 24%"  href="<?php echo get_home_url(); ?>/recuperar-clave">¿Olvidaste tu contraseña?</a>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button id="btn-login" type="submit" class="btn btn-sm-kmibox gothan">Iniciar sesion</button>
						<br>
						<br>
						<label style="color: #878a87" class="gothan">¿Aún no tienes perfil Marca? </label>
						<a href="<?php echo get_home_url().'/'; ?>registro" id='link-registro' data-target="inicio-sesion" >
							<span style="color: #000000; font-weight: 900;" class="gothan">Regístrate aquí</span>
						</a>
					</div>
				</div>

			</form>
		</div>
	
</article>
<div class="clear"></div>