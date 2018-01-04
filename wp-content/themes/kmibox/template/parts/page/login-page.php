<div class="clear"></div>
<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
<div class="col-md-6"><img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive" style="margin-top: 20%;margin-left: 7%;width: 78%;"></div>
<article id="inicio-sesion" 
		class="col-md-6 col-xs-12 col-md-offset-6" 
		style="background-color: #000000;height: 636px;margin-top: -31%;">

	
		<div class="col-md-10 col-md-offset-1 form-horizontal">

			<aside class="col-md-12 text-center" style="margin-bottom:40px;">
				
				<h4 style="color: #ffffff; font-family: GothanMedium_regular;    margin-top: 20%;">Inicia Sesión para continuar</h4>
			</aside>

			<form id='form-login' class="form-horizontal">
				<div class="clearfix"></div>
				<div class="form-group input-icon" style="color:#000000; margin-left:20%; width: 60%;">
					<i class="fa fa-user inter-input"></i>
					<input type="text" name="usuario" class="form-control" id="inputEmail3" placeholder="Email" maxlength="40">
				</div>
					
				

				<div class="form-group input-icon" style="color:#000000; margin-left:20%; width: 60%;">
					<i class="fa fa-lock inter-input"></i>
					<input type="password" name="clave" class="form-control" id="inputPassword3" placeholder="Clave" maxlength="40">
				</div>

				<div class="form-group text-center">
					<label style="color: #ffffff; ">
						<input type="checkbox" name="rememberme"> Recordarme	
					</label>
				</div>

				<div class="form-group col-xs-10 text-center gothan" style="margin-bottom: 0px; color: #ffffff">
					<a style="color: #ffffff; margin-left: 24%; font-size: 12px"  href="<?php echo get_home_url(); ?>/recuperar-clave">¿Olvidaste tu contraseña?</a>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button id="btn-login" type="submit" class="btn btn-sm-kmibox gothan">Iniciar sesion</button>
						<br>
						<br>
						<label style="color: #ffffff; font-size: 12px" class="gothan">Ya tengo una cuenta </label>
						<a href="<?php echo get_home_url().'/'; ?>registro" id='link-registro' data-target="inicio-sesion" >
							
						</a>
					</div>
				</div>

			</form>
		</div>
	
</article>
<div class="clear"></div>