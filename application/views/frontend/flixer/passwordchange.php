<?php include 'header_browse.php';?>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<?php
			if ($this->session->flashdata('status') == 'password_change_failed'):
			?>
		<!-- ERROR MESSAGE --> 
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Нууц үг 5-аас олон тэмдэгт байх ёстой.
		</div>
		<?php endif;?>
		<div class="container">
		<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">Нууц үг солих</h3>
			<hr>
		</div>
		<div class="col-lg-5">
			<form method="post" action="<?php echo base_url();?>index.php?browse/passwordchange">
				<div class="">
					Одоогийн нууц үг
				</div>
				<div class="black_text">
					<input type="password" name="old_password" style="padding: 10px; width:100%;" />
				</div>
				<div class="" style="margin-top: 20px;">
					Шинэ нууц үг
				</div>
				<div class="black_text">
					<input type="password" name="new_password" style="padding: 10px; width:100%;" />
				</div>
				<br>
				<button class="btn btn-primary" type="submit"> Хадгалах </button>
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Буцах</a>
			</form>
		</div>
		</div>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>