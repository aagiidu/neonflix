<?php include 'header_browse.php';?>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<?php
		if ($this->session->flashdata('status') == 'email_change_failed'):
		?>
			<!-- ERROR MESSAGE --> 
			<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  Имэйл хаяг бүртгэлтэй байна. Та өөр имэйл ашиглана уу.
			</div>
		<?php endif;?>
		<div class="col-lg-12">
			<h3 class="black_text">Имэйл хаягаа солих</h3>
			<hr>
		</div>
		<div class="col-lg-5">
			<form method="post" action="<?php echo base_url();?>index.php?browse/emailchange">
				<div class="">
					Одоогийн имэйл
				</div>
				<div class="black_text">
					<?php echo $this->crud_model->get_current_user_detail()->email;?>
				</div>
				<br>
				<div class="">
					Шинэ имэйл
				</div>
				<div class="black_text">
					<input type="email" name="new_email" style="padding: 10px; width:100%;" />
				</div>
				<div class="" style="margin-top: 20px;">
					Одоогийн нууц үг
				</div>
				<div class="black_text">
					<input type="password" name="old_password" style="padding: 10px; width:100%;" />
				</div>
				<br>
					<button class="btn btn-primary" type="submit"> Хадгалах </button>
					<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Болих</a>
			</form>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>


