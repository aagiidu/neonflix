<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title; ?> | Neontoon</title>
		<!-- all the meta tags -->
		<?php include 'metas.php'; ?>
		<!-- all the css files -->
		<?php include 'css.php'; ?>
	</head>
	<body class="">
		<!-- HEADER -->
		<?php include 'header.php'; ?>
		<!-- BEGIN CONTENT -->
		<div class="page-container row-fluid">
			<!-- SIDEBAR -->
			<?php include 'menu.php'; ?>
			<!-- PAGE CONTAINER-->
			<div class="page-content">
				<div class="content">
					<!--  PAGE TITLE -->
					<div class="page-title">
						<i class="icon-custom-right"></i>
						<h3>
							<?php echo $page_title;?>
						</h3>
					</div>
					<!-- BEGIN PlACE PAGE CONTENT HERE -->
					<?php include 'pages/'.$page_name.'.php';?>
					<!-- END PLACE PAGE CONTENT HERE -->
				</div>
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- all the js files -->
		<?php include 'js.php';?>
	</body>
</html>