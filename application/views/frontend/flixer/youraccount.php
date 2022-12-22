<?php include 'header_browse.php';?>

<style>
	.card{padding:25px 15px;background: #fff;margin-bottom:15px;text-align:center;border-radius:4px;}
	.plans{margin-bottom:15px;}
	.plans>div{display: flex; flex-direction: row;justify-content: center;}
	.plans>div>div{width: 250px;padding:10px}
	.item{background:#fff;padding: 50px 15px 0; overflow:hidden;box-shadow: 1px 2px 3px rgba(0,0,0,.25); border-radius:8px;transition: All .3s ease;}
	.item:hover{box-shadow: 1px 3px 5px rgba(0,0,0,.5);}
	.item .name{color:#242424}
	.item .price{color:#9966ff;margin-bottom:40px}
	.item:hover .price{color:#2eb82e;margin-bottom:40px}
	.plans .item h4, .plans .item h2{text-align:center}
	.plans button{margin-left: -15px; width:Calc(100% + 30px);background:#aa80ff;padding: 20px;transition: All .3s ease;}
	.plans button:hover, .item:hover button{background: #33cc33}
	@media screen and (max-width: 900px) {
		.plans{margin-top:70px}
		.plans>div>div{width:200px}
		.item .price{font-size:32px}
	}
	@media screen and (max-width: 767px) {
		.plans>div{flex-direction: column;align-items: center;}
		.plans>div>div{width:Calc(100% - 30px)}
		.item{padding-top:20px}
		.item .price{margin:10px 0 20px;}
		.main-title{width: Calc(100% - 50px); margin: auto;font-size:22px}
	}
	.btn-success:focus, .btn-success.focus {
		color: #ffffff;
		background-color: #558000;
		border-color: #558000;
		outline: none; 
	}
	#payModal{text-align:center;color: #242424; background: #9933ff;}
	#payModal p{color:#fff} 
	#payModal .close{color:#fff;opacity: 1;position: absolute;top: 15px;right: 15px;}
	#payModal ul li span{display:inline-block;font-size:17px;width: 150px;}
	#payModal ul li span:nth-child(1){text-align:right}
	#payModal ul li span:nth-child(2){text-align:left; padding-left:20px}
	#payModal ul{margin:0;padding:0}
	#payModal ul li{list-style: none;}
</style>
<div>
<div class="container mt-md-container">
	<div class="row" style="min-height: 55vh">
		<?php
			if ($this->session->flashdata('status') == 'phone_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Утасны дугаар амжилттай солигдлоо.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'password_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Нууц үг амжилттай солигдлоо.
		</div>
		<?php endif;?>
		
		<!-- NOTIFICATION MESSAGES ENDS -->
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-sm-6">
						<h4 class="black_text">Миний мэдээлэл</h4>
						<div class="card bg-white black_text">
							<div class="card-body">
								Утас: <?php echo $userdata->phone;?> 
								<br />
								<a href="<?php echo base_url();?>index.php?browse/phonechange" class="blue_text">(Утасны дугаар солих)</a>
							</div>
						</div>

						<div class="card bg-white black_text">
							<div class="card-body">
								Нууц үг : ****** 
								<br />
								<a href="<?php echo base_url();?>index.php?browse/passwordchange" class="blue_text">(Нууц үг солих)</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<h4 class="black_text">
							Гишүүнчлэл
							<span class="pull-right" style="font-size:14px">
								<a href="<?php echo base_url();?>index.php?browse/billinghistory" class="blue_text">Төлбөрийн түүх</a>
							</span>
						</h4>
						<div class="card bg-white black_text">
							<div class="card-body">
							<?php if ( $this->crud_model->validate_subscription() != false): ?>
								<a href="#" class="btn btn-default" style="margin:10px 0px;background: #5cd65c"> Гишүүнчлэл идэвхитэй </a>
							<?php endif;?>
							<?php
									if ( $this->crud_model->validate_subscription() != false):
										$current_plan_id			=	$this->crud_model->get_current_plan_id();
										$current_plan_name			=	$this->db->get_where('plan', array('plan_id'=> $current_plan_id))->row()->name;
										// $current_plan_screens		=	$this->db->get_where('plan', array('plan_id'=> $current_plan_id))->row()->screens;
										$current_subscription_upto_timestamp
																	=	$this->db->get_where('subscription', array('plan_id'=> $current_plan_id))->row()->timestamp_to;
									?>
									<b class="black_text" style="text-transform: capitalize;">
									<?php echo $current_plan_name; ?>
									</b>
									<br>
									Хугацаа: <b><?php echo date('Y-m-d', $current_subscription_upto_timestamp);?></b> хүртэл хүчинтэй
									<br>
									<?php endif;?>
									<!-- IF ANY ACTIVE SUBSCRIPTION IS NOT FOUND -->
									<?php
										if ( $this->crud_model->validate_subscription() == false):
										?>
										Танд одоогоор идэвхитэй гишүүнчлэлийн багц байхгүй байна. <br /> Доорх багцуудаас сонгож идэвхижүүлнэ үү.

									<!-- <a href="<?php echo base_url();?>index.php?browse/purchaseplan" 
										class="btn btn-primary" style="margin:10px 0px;"> Гишүүнчлэлийн эрх авах </a> -->
								<?php endif;?>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="plans">
					<h4 class="black_text main-title" style="text-align:center">Гишүүнчлэлийн багцаа сонгоно уу</h4>
					<div>
						<?php $plans = $this->crud_model->get_active_plans(); 
							foreach ($plans as $row): ?>
							<div>
								<div class="item">
									<h4 class="name"><?php echo $row["name"] ?></h4>
									<h2 class="price">₮<?php echo number_format($row["price"]) ?></h2>
									<button type="button" class="btn btn-success w-100" onclick="openPaymentModal('<?php echo number_format($row["price"]) ?>')">СОНГОХ</button>
								</div>
							</div>
						<?php endforeach;?>
					</div>		
					
				</div>
			</div>
		</div>
	</div>
	<hr>
	</div>
	<?php include 'footer.php';?>
</div>
							
<div id="customModal" class="modal-bg">
	<div id="payModal" class="modal modal-md">
		
		<div class="modal-body">
			<h4>Төлбөр төлөх заавар</h4>
			<p>Та дараах зааврын дагуу төлбөрөө шилжүүлснээр таны гишүүнчлэлийн эрх автоматаар үүснэ. Та гүйлгээ хийхдээ төлбөрийн утга дээр нь доорх кодыг бичихэд л болно.</p>
			<div class="card bg-white black_text">
				<div class="card-body">
				<ul>
					<li><span>Банк:</span><span>Хаан банк</span></li>
					<li><span>Дансны дугаар:</span><span>5000 799 719</span></li>
					<li><span>Хүлээн авагч:</span><span>Б.Ач-Эрдэнэ</span></li>
					<li><span>Гүйлгээний дүн:</span><span id="price"></span></li>
					<li><span>Гүйлгээний утга:</span><span><?php echo $userdata->user_id ?></span></li>
				</ul>
				</div>
			</div>
		</div>
		<button class="close" onclick="closePaymentModal()">&times;</button>
	</div>
</div>
<script>
	function openPaymentModal(price){
		console.log(price)
		$('#price').text('₮' + price)
		$('#customModal').addClass('show');
	}

	function closePaymentModal(){
		console.log('sldkjslkjl')
		// showLoginForm();
		$('#customModal').removeClass('show');
	}
</script>
</div>