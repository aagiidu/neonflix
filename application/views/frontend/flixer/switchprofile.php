<style>
	.profile_switcher{font-size:25px; color: gray !important; position: relative; }
	.profile_switcher:hover{font-size:25px;color: #fff !important;}
	.profile_switcher_img{height:180px; border: 6px solid #3a3a3a;}
	.profile_switcher img:hover{ border: 6px solid #fff;}
	td{padding:30px;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;}
</style>
<!-- TOP LANDING SECTION -->
<div style="height:100vh;width:100%; background-color: #141414;">
	<!-- logo -->
	<div style="float: left;">
		<a href="<?php echo base_url();?>">
		<img src="<?php echo base_url();?>/assets/global/logo.png" style="margin: 18px 40px; height: 35px;" />
		</a>
	</div>
	<div style="clear: both; text-align: center; padding-top: 100px;">
		<h1>Өө, сорри!</h1>
		<h5>Яг одоо энэ аккаунтаар өөр төхөөрөмжөөс холбогдсон байна. Давхар үзэх боломжгүй.</h5>
		<table align="center" style="background-color: #141414;">
			<tr>
				<td>
					<img src="<?php echo base_url();?>/assets/global/thumb1.png" class="profile_switcher_img" />
				</td>
			</tr>
		</table>
		<br>
		<a href="<?php echo base_url();?>index.php?home/landing2" class="profile_manage">Буцах</a>
	</div>
</div>