<?php include 'header_browse.php';?>
<style>
	table{
	background-color: rgb(243, 243, 243);
	}
</style>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">Эрх нээх</h3>
			<hr>
		</div>
		<div class="col-lg-8">
			<h4 class="black_text">Гишүүнчлэлийн хугацаагаа сонгоно уу.</h4>
			<!-- <form method="post" action="#"> -->
				<table class="table table-striped table-hover" style="color: #000;">
					<tbody>
						<tr>
							<td>
								<h6>Багц</h6>
							</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">
								<h5 style="text-transform: uppercase;"><?php echo $row['name'];?></h5>
							</td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td>Сарын төлбөр</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">₮<?php echo number_format($row['price']);?></td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td></td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">
								<input type="radio" name="plan_id" value="<?php echo $row['plan_id'];?>" onChange="enable_payment()" />
							</td>
							<?php endforeach;?>
						</tr>
					</tbody>
				</table>
				<div class="pull-right">
					<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Буцах</a>
					<button id="payment" class="btn btn-primary" type="submit"> Сонгох </button>
				</div>
			<!-- </form> -->
			<!-- <div class="pull-right">
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Буцах</a>
				<button id="payment" class="btn btn-primary" type="button"> Шилжүүлсэн </button>
			</div> -->
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>