<?php $user = get_user_by( 'id', get_current_user_id() ); 
?>

 		<aside id="top"> 
			<div class="container">
				
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/km-logo.png">
				</a> 		
				

		    	<ul class="option-menu list-unstyled list-inline col-xs-8 col-md-6 pull-right text-right">
					<?php if ( is_user_logged_in() ){ ?>

						<li>
						<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/quiero-mi-marca">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="caviar" style="font-family: caviar_dremasregular">comprar</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/perfil-usuario">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="caviar" style="font-family: caviar_dremasregular"><?php echo $user->user_email; ?></span></a>
						</li>
						
						<li>
							<a class="btn-kmibox-link" 
							href="<?php echo wp_logout_url( get_home_url() );?> ">
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="caviar" style="font-family: caviar_dremasregular">Salir</span></a>
						</li>
					<?php }else{ ?>

						<li>
						<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/quiero-mi-marca"  >
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="caviar" style="font-family: caviar_dremasregular">Comprar</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key" aria-hidden="true"></i>
							<span class="caviar" style="font-family: caviar_dremasregular">Iniciar Sesion</span></a>
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs hidden-sm caviar" style="font-family: caviar_dremasregular">Registro</span></a>
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>