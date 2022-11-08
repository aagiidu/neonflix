<div class="row">
	<!-- TOTAL VIDEO NUMBER -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles blue weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Нийт кинонууд </div>
					<div class="pull-right">
						<?php echo $this->db->from('movie')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">video_library</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- TOTAL TV SERIES NUMBER -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles purple weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Цувралууд </div>
					<div class="pull-right"> 
						<?php echo $this->db->from('series')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">ondemand_video</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles purple weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Анимэ </div>
					<div class="pull-right"> 
						<?php echo $this->db->from('series')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">ondemand_video</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- TOTAL EPISODE NUMBER -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles green weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Нийт Episodes </div>
					<div class="pull-right"> 
						<?php echo $this->db->from('episode')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">subscriptions</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
</div>
<div style="margin: 20px;"></div>
<div class="row">
	<!-- TOTAL USER NUMBER -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles black  weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Хэрэглэгчдийн тоо </div>
					<div class="pull-right">
						<?php echo $this->db->from('user')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">people</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- TOTAL ACTIVE SUBSCRIPTION -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles dark-blue weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Идэвхтэй хэрэглэгчид </div>
					<div class="pull-right">
						<?php
							$total_active_subscription	=	0;
							$users	=	$this->db->get('user')->result_array();
							foreach ($users as $row)
							{
								$plan_id	=	$this->crud_model->get_active_plan_of_user($row['user_id']);
								if ($plan_id != false)
									$total_active_subscription++;
							}
							echo $total_active_subscription;
							?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">loyalty</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- REVENUE THIS MONTH -->
	<div class="col-md-3 col-sm-6 ">
		<div class="tiles red weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Энэ сарын борлуулалт </div>
					<div class="pull-right">
						<?php
							$total_sale	=	0;
							$month			=	date("F");
							$year 			=	date("Y");
							$subscriptions	=	$this->crud_model->get_subscription_report($month, $year);
							foreach ($subscriptions as $row)
								$total_sale	+=	$row['paid_amount'];
							echo '₮'.$total_sale;
							?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">payment</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
</div>