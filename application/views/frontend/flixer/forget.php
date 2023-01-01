<!-- TOP LANDING SECTION -->
<div style="height:93vh;width:100%;background-image: url(<?php echo base_url().'assets/frontend/'.$selected_theme;?>/images/login_bg.jpg)">
	
	<!-- logo -->
	<div style="float: left;">
		<a href="<?php echo base_url();?>index.php?home">
			<img src="<?php echo base_url();?>/assets/global/logo.png" style="margin: 18px 40px; height: 50px;" />
		</a>
	</div>
    <div style="float: right;margin: 18px 40px; height: 50px;">
        <a href="#" class="" style="color: #e50914;font-weight: 700;font-size: 20px;" onclick="openLoginModal()">Нэвтрэх</a>
    </div>
	<form action="<?php echo base_url();?>index.php?home/forget" method="post">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4" style="clear: both;">
				<div style="background-color: #f3f3f3; padding: 30px;">
					<h3 class="black_text">Имэйл хаяг/нууц үг мартсан</h3>
					Имэйл хаягаа оруулна уу. Нэг удаагийн нууц үгийг имэйлээр илгээх болно. 
					<div class="black_text" style="margin-top: 20px;">
					Имэйл 
					</div>
					<div class="black_text">
						<input type="email" name="email" style="padding: 10px; width:100%;" />
					</div>
					<button type="submit" class="btn btn-primary" style=" width: 100%; margin: 20px 0px;">Илгээх</button>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- MIDDLE TAB SECTION -->
<div class="container">
	<?php include 'footer.php';?>
</div>
