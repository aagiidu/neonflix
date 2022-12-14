<?php include 'header_browse.php';?>
<!-- TOP LANDING SECTION -->
<div class="login-container" style="background-image: url(<?php echo base_url().'assets/frontend/'.$selected_theme;?>/images/login_bg.jpg)">
	<div class="login-form">
		<?php if ($this->session->flashdata('signin_result') == 'failed'): ?>
		<!-- ERROR MESSAGE -->
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Амжилтгүй! Мэдээллээ шалгаад дахиад оролдоод үзнэ үү.
		</div>
		<?php endif;?>
		<!-- <form method="post" action="<?php echo base_url();?>index.php?home/signin">
			<h3 class="black_text">Нэвтрэх</h3>
			<div class="black_text">
				Утасны дугаар
			</div>
			<div class="black_text">
				<input type="number" name="phone" style="padding: 10px; width:100%;" />
			</div>
			<div class="black_text" style="margin-top: 20px;">
				Нууц үг
			</div>
			<div class="black_text">
				<input type="password" name="password" style="padding: 10px; width:100%;" />
			</div>
			<button class="btn btn-danger" style=" width: 100%; margin: 20px 0px;"> Нэвтрэх </button>
		</form> -->
		<hr>
		<a href="#">Нууц үгээ мартсан?</a>
		|
		<a href="#" <?php echo $userdata == null ? 'onclick="openRegModal()"' : "" ?>>Бүртгүүлэх</a>
	</div>
</div>
<!-- MIDDLE TAB SECTION -->
<div class="container">
	<?php include 'footer.php';?>
</div>