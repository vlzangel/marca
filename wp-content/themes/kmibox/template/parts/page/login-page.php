<div class="clear"></div>
<!--aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger hidden-lg hidden-md" id="login-mensaje"></aside-->

<div id="imgclick" class="col-md-6 hidden-xs hidden-sm " style="background-color: #ffffff;padding-top: 60px;
    margin-top: -9%;"> 
	<ul class="option-menu list-unstyled list-inline col-xs-4 col-md-12  text-left" style="margin-bottom: 25%;">
					<div class="col-sm-12 text-left">
						<a class="btn-kmibox-white gothan" id="btn-linkprev" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
							Atras
						</a>
					</div>

				</ul>

	<img src="<?php echo get_home_url(); ?>/img/LOGO.svg" class="img-responsive" style="margin-top: 20%;margin-left: 7%;width: 78%;">
				</div>
			

<article id="inicio-sesion" 
		class="col-md-6 col-xs-12 col-md-offset-6 LoginNuevo" style="    padding-left: 0px !important;">
			<aside class="col-md-8 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
		<div class="col-md-10 col-md-offset-1 form-horizontal text-center">

			<aside class="col-md-12 text-center" style="margin-bottom:40px;">
				
				<h4 style="color: #ffffff; font-family: GothanMedium_regular;    margin-top: 20%;">Inicia Sesión para continuar</h4>
				<img src="<?php echo get_home_url(); ?>/img/logo-responsive1.svg" class="img-responsive  hidden-ms hidden-lg" style="margin-top: 15%;">
			</aside>

			<form id='form-login' class="form-horizontal">
				<div class="clearfix"></div>
				<div class="form-group input-icon inputlogin"  style="color:#000000; margin-left:20%; width: 60%;">
					<i class="fa fa-user inter-input" ></i>
					<input type="text" name="usuario" class="form-control" id="inputEmail3" placeholder="Email" maxlength="40" style="    border-radius: 50px;">
				</div>					
				

				<div class="form-group input-icon inputlogin" style="color:#000000; margin-left:20%; width: 60%;" >
					<i class="fa fa-lock inter-input" ></i>
					<input type="password" name="clave" class="form-control" id="inputPassword3" placeholder="Clave" maxlength="40" style="    border-radius: 50px;">
				</div>

				

				<div class="form-group text-center">
					<label style="color: #ffffff; ">
						<input type="checkbox" name="rememberme"> Recordarme	
					</label>
				</div>	

				<div class="form-group col-xs-10 text-center gothan" style="margin-bottom: 0px; color: #ffffff">
					<a style="color: #ffffff; margin-right: -35%; font-size: 12px"  href="<?php echo get_home_url(); ?>/recuperar-clave">¿Olvidaste tu contraseña?</a>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button id="btn-login" type="submit" class="btn btn-sm-kmibox gothan">Iniciar sesion</button>
						<br>
						<br>
						<label style="color: #ffffff; font-size: 10px" class="gothan">¿Aún no tienes perfil Nutriheroes? </label>
						
						<a href="<?php echo get_home_url().'/'; ?>registro" id="link-registro" data-target="inicio-sesion" style="color: #ffffff; font-size: 10px" class="gothan">Registrate aquí						
						</a>
					</div>
				</div>

			</form>
		</div>
	
</article>


<div class="clear"></div>