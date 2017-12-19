<?php $user = get_user_by( 'id', get_current_user_id() ); 
?>

 		<aside id="top"> 
			<div class="container">
				<a href="<?php echo get_home_url(); ?>">
				<img src="<?php echo get_home_url(); ?>/img/km-logo.png" style="margin-left:-17px; width:30%;" >
				</a>
				
			<ul class="option-menu list-unstyled list-inline col-xs-8 col-md-6 pull-right text-right" style="    font-size: 10px;">
					<?php if ( is_user_logged_in() ){ ?>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/perfil-usuario">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm"><?php echo $user->user_email; ?></span></a><!--href="<?php echo get_home_url(); ?>/perfil-usuario">-->
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo wp_logout_url( get_home_url() );?>">
							
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm">Salir</span></a><!--href="<?php echo wp_logout_url( get_home_url() );?> ">-->
						</li> 
					<?php }else{ ?>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key fa-lg" aria-hidden="true"></i>
							<span >Iniciar Sesion</span></a><!--href="<?php echo get_home_url(); ?>/iniciar-sesion">-->
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> <span >Registro</span></a><!--href="<?php echo get_home_url(); ?>/registro">-->
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>