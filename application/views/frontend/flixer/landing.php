<?php include 'header_browse.php';?>
<div style="height:100vh;background-image: url(<?php echo base_url().'assets/frontend/flixer/images/home_top_banner.jpg';?>)">
	<!-- logo -->
	<div class="land-center">
		<a href="#" class="btn btn-info land-btn" >Маркетинг</a>
		<a href="/index.php?home/landing2" class="btn btn-info land-btn" >Кино үзвэр</a>
		<a href="#" class="btn btn-info land-btn" >Комик</a>
		<?php if($userdata == null){ ?>
		<p class="text-center">
			<button type="buton" onclick="openRegModal()" class="btn btn-danger btn-lg reg-btn" >БҮРТГҮҮЛЭХ</button>
		</p>
		<?php } ?>
	</div>
</div>
<!-- MIDDLE TAB SECTION -->
<div class="container">
	<?php include 'footer.php';?>
</div>