<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<title>Home</title>
	<?php $this->load->view(COMMON.'head'); ?>

	<body>
		<?php $this->load->view(COMMON.'navbar'); ?>

			<div class="section pt-5 pb-0">
				<div class="container">
					<div class="row mb-5 justify-content-center">
						<div class="col-lg-9">
							<h2 class="heading">Blog</h2>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-9">
							<?php
								if(isset($blogs) && $blogs != ''){
									foreach($blogs as $brow){
									$image = ($brow['thumbnail']) ? base_url()."assets/images/blog/".$brow['thumbnail'] : "assets/images/no-image.jpg";
									?>
									<div class="card post-entry d-md-flex small-horizontal mb-5">
										<div class="thumbnail mb-3">
											<img width="70%" src="<?=$image?>" alt="<?=$brow['title']?>" class="img-fluid">
										</div>
										<div class="content">
											<div class="post-meta mb-3">
												<span class="date"><?=date("M d, Y",strtotime($brow['created_date']))?></span>
												<a href="create-blog/<?=$brow['blog_id'];?>" class="float-end">Edit</a>
												<a href="delete-blog/<?=$brow['blog_id'];?>" class="text-danger float-end me-md-3">Delete</a>
											</div>
											<h2 class="heading"><a href="#"><?=$brow['title']?></a></h2>
											<p><?=$brow['description']?></p>
										</div>
									</div>
									<?php
									}
								}
								else{
									echo '<div class="card"><h3 class="mb-3 text-center">No Blog Found....</h3></div>';
								}

								echo ((isset($message)) ? '<h2 class="mb-3 text-center text-danger">'.$message.'</h2>' : ""); 
							?>
						</div>
					</div>
				</div>
			</div>

		<?php $this->load->view(COMMON.'footer'); ?>
		<?php $this->load->view(COMMON.'js'); ?>
    	<script src="<?= base_url() ?>assets/js/user-registration.js"></script>
	</body>
</html>
