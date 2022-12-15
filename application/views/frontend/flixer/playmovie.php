<?php include 'header_browse.php';?>
<?php
	$movie_details	=	$this->db->get_where('movie' , array('movie_id' => $movie_id))->result_array();
	foreach ($movie_details as $row):
	?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dplayer/1.27.0/DPlayer.min.js"></script>
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
	.video_cover {
	position: relative;padding-bottom: 30px;
	}
	.video_cover:after {
	content : "";
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	background-image: url(<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>); 
	width: 100%;
	height: 100%;
	opacity : 0.2;
	z-index: -1;
	background-size:cover;
	}
	.select_black{background-color: #000;height: 45px;padding: 12px;font-weight: bold;color: #fff;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;}
</style>
<!-- VIDEO PLAYER -->
<div class="video_cover">
	<div class="container-fluid" style="padding-top:100px; text-align: center;">
		<div class="row">
			<div class="col-lg-8">
				<div id="dplayer"></div>
				<script src="/assets/frontend/flixer/neon.js"></script>
				<script>
					$(function() {
						let url = '<?php echo $row['url'] ?>'
						let poster = '<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>';
						console.log('poster', poster)
						setMovie(url, poster, JSON.parse($row['qlt']));
					});
				</script>
			</div>
			<div class="col-lg-4 text-left">
				<h4 class="movie-title">
					<span id="mylist_button_holder">
					</span>
					<span id="mylist_add_button" style="display:none;">
					<a href="#" style="font-size: 16px; margin-top: 20px;" title='Хадгалах'
						onclick="process_list('movie' , 'add', <?php echo $row['movie_id'];?>)"> 
					<i class="fa fa-heart-o text-danger"></i>
					</a>
					</span>
					<span id="mylist_delete_button" style="display:none;">
					<a href="#" style="font-size: 16px; margin-top: 20px;" title='Хадгалсан'
						onclick="process_list('movie' , 'delete', <?php echo $row['movie_id'];?>)"> 
					<i class="fa fa-heart text-danger"></i>
					</a>
					</span>
					<?php echo $row['title'];?> (<?php echo $row['year'];?>)
				</h4>
				<div>
					<?php
						for($i = 1 ; $i <= $row['rating'] ; $i++):
						?>
					<i class="fa fa-star" aria-hidden="true"></i>
					<?php endfor;?>
					<?php
						for($i = 5 ; $i > $row['rating'] ; $i--):
						?>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<?php endfor;?>
				</div>
				<a href="<?php echo base_url();?>index.php?browse/movie/<?php echo $row['genre_id'];?>">
					<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
				</a>
				<p><?php echo $row['description_long'] ?></p>
			</div>
		</div>
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
		mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('movie' , $row['movie_id']);?>";
	
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
	
	<div class="row" style="margin-top:20px;">
		<div class="col-lg-12">
			<div class="bs-component">
				<div class="content">
					<div class="grid onerow">
						<?php 
							$movies = $this->crud_model->get_movies($row['genre_id'] , 10, 0);
							foreach ($movies as $row)
							{
								if($row['movie_id'] != $movie_id){
									$title	=	$row['title'];
									$link	=	base_url().'index.php?browse/playmovie/'.$row['movie_id'];
									$thumb	=	$this->crud_model->get_thumb_url('movie' , $row['movie_id']);
									include 'thumb.php';
								}
							}
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>
<?php endforeach;?>