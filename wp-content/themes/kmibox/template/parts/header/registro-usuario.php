<?php $user = get_user_by( 'id', get_current_user_id() ); 
?>

 		<aside id="top"> 
			<div class="container">							
			<ul class="option-menu list-unstyled list-inline col-xs-6 col-md-6 pull-right text-left">
					<div  class="col-sm-12 text-left" >
						<a class="btn-kmibox-white"
							id="btn-linkprev" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
							Atras
						</a>
					</div>

					<div style="float:left;width:75%;">    
						<label style="text-align: right;color: #ffffff; font-size: 18px;margin-left: 380px; font-family: caviar_dreamsregular;">Registro de Usuario
					    </label>
					</div>  
				</ul>
			</div>			
		</aside>



