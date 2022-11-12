<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<!-- TV SERIAL LIST, GENRE WISE LISTING -->
<div style="margin-top:90px"></div>
<div class="row grid-row">
	<h4 class="genre_title">
		<?php echo $this->db->get_where('genre', array('genre_id' => $genre_id))->row()->name;?> <span class="float-right">(Нийт <?php echo $total_result;?> цуврал байна)</span>
	</h4>
	<div class="content">
		<div class="grid">
			<?php 
				foreach ($series as $row)
				{
					$title	=	$row['title'];
					$link	=	base_url().'index.php?browse/play' . $type . '/'.$row['series_id'];
					$thumb	=	$this->crud_model->get_thumb_url('series' , $row['series_id']);
					$intro	=	$row['description_long'];
					include 'thumb.php';
				}
				?>
		</div>
	</div>
	<div style="clear: both;"></div>
	<ul class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>
<div class="container" style="margin-top: 90px;">
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>