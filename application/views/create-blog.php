<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<title>Create blog</title>
	<?php $this->load->view(COMMON.'head'); ?>

	<body>
		<?php $this->load->view(COMMON.'navbar'); ?>

			<div class="section pt-5 pb-0">
				<div class="container">
					<div class="row mb-5 justify-content-center">
						<div class="col-lg-9">
							<h2 class="heading"><?=(isset($blog['blog_id']) ? 'Edit' : "Create")?> Blog <?=(isset($blog['blog_id']) ? ' - '. $blog['title'] : "")?></h2>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<form action="<?=base_url()?>save-blog" enctype="multipart/form-data" method="post" id="create-blog-form">
							<input type="hidden" name="blog_id" value="<?=(isset($blog['blog_id']) ? $blog['blog_id'] : "")?>">
							<div class="form-group mb-3">
								<input type="text" name="title" class="form-control" placeholder="Enter your title" value="<?=(isset($blog['title']) ? $blog['title'] : "")?>">
							</div>
							<div class="form-group mb-3">
								<textarea name="description" class="form-control" placeholder="Enter your blog description"><?=(isset($blog['description']) ? $blog['description'] : "")?></textarea>
							</div>
							<div class="form-group mb-3">
								<input type="file" name="thumbnail" class="form-control mb-3" accept="image/png, image/gif, image/jpeg" value="<?=(isset($blog['thumbnail']) ? $blog['thumbnail'] : "")?>" />
								<img width="50%" id="thumbnail-view" src="<?=(isset($blog['thumbnail']) ? base_url().'assets/images/blog/'.$blog['thumbnail'] : "")?>">
								<input type="hidden" name="thumbnailimage" value="<?=(isset($blog['thumbnail']) ? $blog['thumbnail'] : "")?>">
							</div>
							<div id="resp" class="text-primary mb-3"></div>
							<div class="form-group mb-3">
								<button type="submit" class="form-control btn btn-primary"><?=(isset($blog['blog_id']) ? 'Update' : "Save")?> Blog</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		<?php $this->load->view(COMMON.'footer'); ?>
		<?php $this->load->view(COMMON.'js'); ?>
    	<script src="<?= base_url() ?>assets/js/custom/blog.js"></script>
	</body>
</html>
