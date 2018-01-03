<?php $user = get_user_by( 'id', get_current_user_id() ); ?>

 		<aside id="top"> 
			<div class="container">
				
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/Image-footer.png"  class="hidden-xs"  >
				</a> 
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/Image-footer.png"  class="hidden-sm hidden-md hidden-lg visible-xs" style="margin-left: -2%" >
				</a>		
				

		    	<ul class="option-menu list-unstyled list-inline col-xs-8 col-md-8 col-sm-9 pull-right text-right hidden-xs" style="margin-right: -3%;   margin-top: -5%;">
					<?php if ( is_user_logged_in() ){ ?>

						<li>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class="btn-kmibox-link-suscription">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="hidden-xs caviar">Quiero mi NutriHeroes</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs caviar"><?php echo $user->display_name; ?></span></a>
						</li> 
						<li>
							<a class="btn-kmibox-link-suscription" 
							href="<?php echo wp_logout_url( get_home_url() );?> " style="    margin-right: -60%;">
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Salir</span></a>
						</li>
					<?php }else{ ?>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class=" hidden-xs btn-kmibox-link caviar">Quiero mi NutriHeroes</a>

						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Iniciar Sesion</span></a>
						</li>
						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs  caviar">Registro</span></a>
						</li>
					<?php } ?>

				</ul>

				<ul class="option-menu list-unstyled list-inline col-xs-8 col-md-8 col-sm-9 pull-right text-right hidden-lg hidden-md hidden-sm" style="margin-right: -3%;   margin-top: -5%;">
					<?php if ( is_user_logged_in() ){ ?>

						<li>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class="btn-kmibox-link-suscription">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="hidden-xs caviar">Quiero mi NutriHeroes</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs caviar"><?php echo $user->display_name; ?></span></a>
						</li> 
						<li>
							<a class="btn-kmibox-link-suscription" 
							href="<?php echo wp_logout_url( get_home_url() );?> ">
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Salir</span></a>
						</li>
					<?php }else{ ?>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class=" hidden-xs btn-kmibox-link caviar">Quiero mi NutriHeroes</a>

						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Iniciar Sesion</span></a>
						</li>
						<li>
							<a class="btn-kmibox-link-suscription" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs  caviar">Registro</span></a>
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>