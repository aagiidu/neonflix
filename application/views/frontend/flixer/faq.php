
 
 <?php include 'header_browse.php';?>

<div class="container faq">
	<div class="row">
		<div class="col-lg-12">
			<h4>Түгээмэл асуултууд</h4>
		</div>
		<?php 
		$faqs	=	$this->db->get('faq')->result_array();
		foreach ($faqs as $row):
		?>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-1">
					<img src="<?php echo base_url().'assets/frontend/'.$selected_theme;?>/images/faq_icon.png" style="margin-top: 18px; width:40px;" />
				</div>
				<div class="col-lg-11">
					<h3 class="black_text">
						<?php echo $row['question'];?>
					</h3>
					<?php echo $row['answer'];?> 
					<hr>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	<?php include 'footer.php';?>
</div>


