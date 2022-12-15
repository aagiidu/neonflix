<!doctype html>
<html lang="mn">
<head>
	<title><?php echo $page_title;?> | NeonToon</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/global/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/bootstrap.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/style.css">
    <script src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/jquery-1.10.2.min.js" ></script>
    <script src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/bootstrap.min.js" ></script>

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

	<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <style>
		.black_text{color:#000; background-color: #f3f3f3;}
		.blue_text{color: #0080ff;}
	</style>
</head>
<?php
$bg_color = "#1d1b24";
if (/* $page_name == 'signup' || $page_name == 'signin' || $page_name == 'faq' || 
		$page_name == 'termsofuse' || $page_name == 'privacypolicy' || $page_name == 'refundpolicy' ||*/
   			$page_name == 'youraccount' || $page_name == 'billinghistory'||
   				$page_name == 'emailchange' || $page_name == 'passwordchange'|| $page_name == 'phonechange' ||
   					$page_name == 'cancelplan' || $page_name == 'purchaseplan')
    $bg_color = "#f3f3f3";
?>
<body style="background-color:<?php echo $bg_color;?>;">

	<?php include ($page_name . '.php');?>
</body>
</html>






