<?php include 'header_browse.php';?>
<div class="container" style="margin-top: 90px;">
	<div class="row" style="min-height: 55vh">
		<!-- NOTIFICATION MESSAGES HERE -->
		<?php
			if ($this->session->flashdata('payment_status') == 'cancelled'):
			?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Payment cancelled.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('payment_status') == 'success'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Payment completed successfully.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'email_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Email changed successfully.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'password_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Password changed successfully.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'subscription_cancelled'):
			?>
		<!-- ERROR MESSAGE --> 
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Membership cancelled successfully. You can purchase or renew it anytime.
		</div>
		<?php endif;?>
		<!-- NOTIFICATION MESSAGES ENDS -->
		<div class="col-lg-12">
			<h3 class="black_text">Профайл</h3>
			<hr>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-5">
					<span style="font-size: 20px;">ХУВИЙН МЭДЭЭЛЭЛ</span>
				</div>
				<div class="col-lg-7">
					<div class="row" style="margin: 5px;">
						<div class="pull-left black_text">
							<b><?php echo $this->crud_model->get_current_user_detail()->email;?></b>
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url();?>index.php?browse/emailchange" class="blue_text">Мэйл хаягаа солих</a>
						</div>
					</div>
					<div class="row" style="margin: 5px;">
						<div class="pull-left">Нууц үг : ******</div>
						<div class="pull-right">
							<a href="<?php echo base_url();?>index.php?browse/passwordchange" class="blue_text">Нууц үг солих</a>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-5">
					<span style="font-size: 20px;">ГИШҮҮНЧЛЭЛ</span>
					<br>
					<?php
						if ( $this->crud_model->validate_subscription() != false):
						?>
					<a href="#" 
						class="btn btn-default" style="margin:10px 0px;background: #5cd65c"> Гишүүнчлэл идэвхитэй </a>
					<?php endif;?>
				</div>
				<div class="col-lg-7">
					<div class="row" style="margin: 5px;">
						<div class="pull-left">
							<!-- IF ANY ACTIVE SUBSCRIPTION IS FOUND -->
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
							<a href="<?php echo base_url();?>index.php?browse/purchaseplan" 
								class="btn btn-primary" style="margin:10px 0px;"> Гишүүнчлэлийн эрх авах </a>
							<?php endif;?>
						</div>
						<div class="pull-right" style="text-align: right;">
							<a href="<?php echo base_url();?>index.php?browse/billinghistory" class="blue_text">Төлбөрийн түүх</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>