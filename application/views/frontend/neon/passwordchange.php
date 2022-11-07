<?php include 'header_browse.php';?>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<?php
			if ($this->session->flashdata('status') == 'password_change_failed'):
			?>
		<!-- ERROR MESSAGE --> 
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Current password given wrong or New password must be at least 6 character long. Please try again.
		</div>
		<?php endif;?>
		<div class="col-lg-12">
			<h3 class="black_text">Change Password</h3>
			<hr>
		</div>
		<div class="col-lg-5">
			<form method="post" action="<?php echo base_url();?>index.php?browse/passwordchange">
				<div class="">
					Current Password
				</div>
				<div class="black_text">
					<input type="password" name="old_password" style="padding: 10px; width:100%;" />
				</div>
				<div class="" style="margin-top: 20px;">
					New Password
				</div>
				<div class="black_text">
					<input type="password" name="new_password" style="padding: 10px; width:100%;" />
				</div>
				<br>
				<button class="btn btn-primary" type="submit"> Save </button>
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Cancel</a>
			</form>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>