<?php $user = get_user_by( 'id', get_current_user_id() ); ?>

 		<aside id="top"> 
			<div class="container">
				
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/marca-logo.png"  >
				</a> 		
				

		    	<ul class="option-menu list-unstyled list-inline col-xs-6 col-md-6 pull-right text-right">
					<?php if ( is_user_logged_in() ){ ?>

						<li>

						<a href="http://kmibox.git/quiero-mi-kmibox/?source="  class="btn-kmibox-link-suscription">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="hidden-xs hidden-sm">Quiero mi marca</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm"><?php echo $user->display_name; ?></span></a>
						</li>
						<li>
							<a class="btn-kmibox-link" 
							href="<?php echo wp_logout_url( get_home_url() );?> ">
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm">Salir</span></a>
						</li>
					<?php }else{ ?>

						<a href="http://kmibox.git/quiero-mi-kmibox/?source="  class="btn-kmibox-link">Quiero mi marca</a>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm">Iniciar Sesion</span></a>
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Registro</span></a>
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>