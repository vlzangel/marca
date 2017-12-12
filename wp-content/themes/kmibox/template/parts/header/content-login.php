<?php $user = get_user_by( 'id', get_current_user_id() ); 
?>

 		<aside id="top"> 
			<div class="container">
								
			<ul class="option-menu list-unstyled list-inline col-xs-12 col-md-12 pull-right text-right">
					<div  class="col-sm-12 text-left" >
						<a class="btn-kmibox-white"
							id="btn-linkprev" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
							Atras
						</a>
					</div>

				</ul>
			</div>			
		</aside>
