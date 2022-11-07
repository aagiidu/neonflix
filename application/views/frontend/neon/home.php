<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
</style>
<!-- TOP FEATURED SECTION -->
<?php
	$featured_movie		=	$this->db->get_where('movie', array('featured'=>1))->row();	
?>
<div style="height:85vh;width:100%;background-image: url(<?php echo $this->crud_model->get_poster_url('movie' , $featured_movie->movie_id);?>); background-size:cover;">
	<div style="font-size: 85px;font-weight: bold;clear: both;padding: 200px 0px 0px 50px;color: #fff;">
		<?php echo $featured_movie->title;?>
		<div style="font-size: 30px; letter-spacing: .2px; color: #fff; font-weight: 400;">
			<?php echo $featured_movie->description_short;?>
		</div>
		<a href="<?php echo base_url();?>index.php?browse/playmovie/<?php echo $featured_movie->movie_id;?>" 
			class="btn btn-danger btn-lg" style="font-size: 20px;"> 
		<b><i class="fa fa-play"></i> PLAY</b>
		</a>
		<!-- ADD OR DELETE FROM PLAYLIST -->
	</div>
</div>
<script>
	// submit the add/delete request for mylist
	// type = movie/series, task = add/delete, id = movie_id/series_id
	function process_list(type, task, id)
	{
		$.ajax({
			url: "<?php echo base_url();?>index.php?browse/process_list/" + type + "/" + task + "/" + id, 
			success: function(result){
			//alert(result);
			if (task == 'add')
			{
				$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
			}
			else if (task == 'delete')
			{
				$("#mylist_button_holder").html( $("#mylist_add_button").html() );
			}
		}});
	}
	
	// Show the add/delete wishlist button on page load
	$( document ).ready(function() {
	
		// Checking if this movie_id exist in the active user's wishlist
		mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('movie' , $featured_movie->movie_id);?>";
	
		if (mylist_exist_status == 'true')
		{
			$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
		}
		else if (mylist_exist_status == 'false')
		{
			$("#mylist_button_holder").html( $("#mylist_add_button").html() );
		}
	});
</script>
<!-- MY LIST, GENRE WISE LISTING & SLIDER -->
<?php 
	$genres		=	$this->crud_model->get_genres();
	foreach ($genres as $row):
	?>
<div class="row" style="margin:20px 60px;">
	<h4 class="genre_title"><?php echo $row['name'];?></h4>
	<div class="content">
		<div class="grid">
			<?php 
				$movies	= $this->crud_model->get_movies($row['genre_id'] , 5, 0);
				foreach ($movies as $row)
				{
					$title	=	$row['title'];
					$link	=	base_url().'index.php?browse/playmovie/'.$row['movie_id'];
					$thumb	=	$this->crud_model->get_thumb_url('movie' , $row['movie_id']);
					include 'thumb.php';
				}
				?>
		</div>
	</div>
</div>
<?php endforeach;?>
<div class="container" style="margin-top: 90px;">
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>