<div class="site-mobile-menu site-navbar-target">
	<div class="site-mobile-menu-header">
		<div class="site-mobile-menu-close">
		<span class="icofont-close js-menu-toggle"></span>
		</div>
	</div>
	<div class="site-mobile-menu-body"></div>
</div>
<nav class="site-nav">
	<div class="container">
		<div class="site-navigation">
			<div class="row">
				<div class="col-md-6 text-left order-1 order-md-2 mb-3 mb-md-0">
					<a href="#" class="logo m-0 text-uppercase">Blog</a>
				</div>
				<div class="col-md-6 text-end order-2 order-md-3 mb-3 mb-md-0">
					<ul class="list-unstyled social me-auto float-end">
						<?php 
			            	if( isset($_SESSION['user_id']) && $_SESSION['user_id'] != '' ){
								echo '<li><a href="'.base_url().'home">Home</a></li>';
								echo '<li><a href="'.base_url().'create-blog">Create Blog</a></li>';
								echo '<li><a href="'.base_url().'logout">Logout</a></li>';
							}
							else{
								echo '<li><a href="login">Login</a></li>';
								echo '<li><a href="register">Register</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>