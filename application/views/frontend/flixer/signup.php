<?php include 'header_browse.php'; ?>
<!-- ERROR MESSAGE -->
<style>
	td{padding: 12px 15px; border-bottom: 1px solid #ccc;}
</style>
<div class="container">
	<div class="row" style="padding-top: 10vh">
		<!-- ERROR MESSAGE SHOWING IF DUPLICATE EMAIL FOUND -->
		<?php 
			if ($this->session->flashdata('signup_result') == 'failed'):
			?>
		<div class="alert alert-dismissible alert-danger" style="margin: 30px;">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Энэ имэйл хаяг бүртгэлтэй байна.
		</div>
		<?php endif;?>
		
		<div class="col-lg-12" style="margin: 0px 20px;">
			<h4 class="black_text">Бүртгүүлэх</h4>
		</div>
		<div class="col-lg-12" style="margin: 0px 20px;min-height: 50vh">
			<form method="post" action="<?php echo base_url();?>index.php?home/signup">
				<div style="margin:10px 0px 5px;">
					Имэйл хаяг
				</div>
				<div class="black_text">
					<input type="email" name="email" style="padding: 10px; width:400px;" autocomplete="off" />
				</div>
				<div style="margin:10px 0px 5px;">
					Нууц үг
				</div>
				<div class="black_text">
					<input type="password" name="password" style="padding: 10px; width:400px;" />
				</div>
				<button type="submit"  class="btn btn-primary" style=" width: 150px; margin: 20px 0px;">Бүртгүүлэх</button>
			</form>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>