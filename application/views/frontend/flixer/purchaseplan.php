<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	/* .plans{max-width:800px;margin:auto} */
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
</style>
<div class="container" style="margin-top: 90px;">
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
								<button type="button" class="btn btn-success w-100">СОНГОХ</button>
							</div>
						</div>
					<?php endforeach;?>
				</div>		
				
			</div>
			
			<div class="text-center">
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default" style="margin-bottom:15px">Буцах</a>
				<button id="payment" class="btn btn-primary" type="button"> Шилжүүлсэн бол энд дарж шалгана уу </button>
			</div>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>