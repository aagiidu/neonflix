<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
</style>
<div style="margin-top:90px"></div>
<?php 
	$genres		=	$this->crud_model->get_genres();
	foreach ($genres as $row):
        $movies	= $this->crud_model->get_series($row['genre_id'] , 8, 0);
        if(count($movies) > 0){
	?>
<div class="row grid-row">
	<h4 class="genre_title"><?php echo $row['name'];?> <span class="float-right"><a href="/index.php?browse/series/<?php echo $row['genre_id'] ?>">Бүгдийг үзэх</a></span></h4>
	<div class="content">
		<div class="grid">
			<?php 
				
				foreach ($movies as $row)
				{
					$title	=	$row['title'];
					$link	=	base_url().'index.php?browse/playseries/'.$row['series_id'];
					$thumb	=	$this->crud_model->get_thumb_url('series' , $row['series_id']);
					$intro	=	$row['description_long'];
					include 'thumb.php';
				}
				?>
		</div>
	</div>
</div>
<?php } endforeach;?>
<div class="container" style="margin-top: 90px;">
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>