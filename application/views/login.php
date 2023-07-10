<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<title>Login - Blog</title>
	<?php $this->load->view(COMMON.'head'); ?>

	<body>
		<?php $this->load->view(COMMON.'navbar'); ?>

			<div class="section pt-5 pb-0">
				<div class="container">
					<div class="row mb-5 justify-content-center">
						<div class="col-lg-9">
							<h2 class="heading">Login</h2>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<form action="login-authenticate" method="post" id="login-form-id">
								<div class="form-group mb-3">
									<input type="text" name="username" class="form-control" placeholder="Enter your username">
								</div>
								<div class="form-group mb-3">
									<input type="password" name="userpassword" class="form-control" placeholder="Enter your password">
								</div>
								<div id="login_resp" class="mb-3"></div>
								<div class="form-group mb-3 text-center">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		<?php $this->load->view(COMMON.'footer'); ?>
		<?php $this->load->view(COMMON.'js'); ?>
    	<script src="<?= base_url() ?>assets/js/login.js"></script>
	</body>
</html>
