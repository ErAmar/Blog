<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<title>User Registration</title>
	<?php $this->load->view(COMMON.'head'); ?>

	<body>
		<?php $this->load->view(COMMON.'navbar'); ?>

			<div class="section pt-5 pb-0">
				<div class="container">
					<div class="row mb-5 justify-content-center">
						<div class="col-lg-9">
							<h2 class="heading">User Registration</h2>
						</div>
					</div>
					<div class="row justify-content-center">
         				<?php echo validation_errors(); ?>  
						<div class="col-lg-6">
							<form action="user-registration" method="post" id="user-registration-form">
							<div class="form-group mb-3">
								<input type="text" name="firstname" class="form-control" placeholder="Enter your first name" maxlength="50">
							</div>
							<div class="form-group mb-3">
								<input type="text" name="lastname" class="form-control" placeholder="Enter your last name" maxlength="50">
							</div>
							<div class="form-group mb-3">
								<input type="text" name="mobile" class="form-control" placeholder="Enter your mobile" maxlength="10">
							</div>
							<div class="form-group mb-3">
								<input type="email" name="email" class="form-control" placeholder="Enter your email">
							</div>
							<div class="form-group mb-3">
								<input type="password" name="userpassword" class="form-control" placeholder="Enter your password">
							</div>
							<div id="resp" class="text-danger mb-3"></div>
							<div class="form-group mb-3">
								<button type="submit" class="form-control btn btn-primary">Submit</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		<?php $this->load->view(COMMON.'footer'); ?>
		<?php $this->load->view(COMMON.'js'); ?>
    	<script src="<?= base_url() ?>assets/js/user-registration.js"></script>
	</body>
</html>
