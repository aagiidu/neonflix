<?php include 'header_browse.php';?>
<style>
	.plans{max-width:800px;margin:auto}
	.plans>div{display: flex; flex-direction: row;align-items: stretch;}
	.item{background:#eee}
	.plans .item h4, .plans .item h2{text-align:center}
	.plans button{width:100%}
</style>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">Эрх нээх</h3>
			<hr>
		</div>
		<div class="col-lg-12">
			<div class="plans">
				<h4 class="black_text">Гишүүнчлэлийн багцаа сонгоно уу</h4>
				<div>
					<?php $plans = $this->crud_model->get_active_plans(); 
						foreach ($plans as $row): ?>
						<div style="width: <?php echo 100 / count($plans) ?>%;padding:10px">
							<div class="item">
								<h4><?php echo $row["name"] ?></h4>
								<h2><?php echo $row["price"] ?></h2>
								<button type="button" class="btn btn-success w-100">СОНГОХ</button>
							</div>
						</div>
					<?php endforeach;?>
				</div>
					
					<!-- <pre>
						<?php
							// var_dump($userdata);
						?>
					</pre> -->
					
				
			</div>
			
			<!-- <div class="pull-right">
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Буцах</a>
				<button id="payment" class="btn btn-primary" type="button"> Шилжүүлсэн </button>
			</div> -->
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>