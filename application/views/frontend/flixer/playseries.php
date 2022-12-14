<?php include 'header_browse.php';?>
<?php
	$series_details	=	$this->db->get_where('series' , array('series_id' => $series_id))->result_array();
	foreach ($series_details as $row):
		$thumburl = $this->crud_model->get_thumb_url('series' , $row['series_id']);
	?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dplayer/1.27.0/DPlayer.min.js"></script>

<style>
	.video_cover {
		position: relative;padding-bottom: 30px;
		color: #ccc
	}
	.video_cover:after {
		content : "";
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		background-image: url(<?php echo $this->crud_model->get_poster_url('series' , $row['series_id']);?>); 
		width: 100%;
		height: 100%;
		opacity : 0.2;
		z-index: -1;
		background-size:cover;
	}
	/* .select_black{background-color: #000;height: 45px;padding: 12px;font-weight: bold;color: #fff;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;} */	
</style>
<!-- VIDEO PLAYER -->
<div class="video_cover">
	<div class="container-fluid" style="padding-top:100px; text-align: center;">
		<div class="row" id="mainrow">
			<div class="col-lg-8">
				<div id="dplayer"></div>
				<script src="/assets/frontend/flixer/neon.js"></script>
				<script>
					const data = JSON.parse('<?php echo $epison; ?>');
					$(function() {
						let w = $(window).width()
						console.log('w', w)
						let h = $('#mainrow').height()
						console.log('w', w, 'h', h)
						if(w > 1199){
							$('#episodeList').css('max-height', '300px')
						}else{
							$('#episodeList').css('max-height', '500px')
						}
						let type = '<?php echo $type ?>';
						let poster = '<?php echo $this->crud_model->get_poster_url('series' , $row['series_id']);?>';
						initNeonPlayer(data, type, poster);
					});
				</script>
			</div>
			<div class="col-lg-4 text-left">
				<h4 class="movie-title">
					<span id="mylist_button_holder">
					</span>
					<span id="mylist_add_button" style="display:none;">
					<a href="#" style="font-size: 16px; margin-top: 20px;" title='Хадгалах'
						onclick="process_list('series' , 'add', <?php echo $row['series_id'];?>)"> 
					<i class="fa fa-heart-o text-danger"></i>
					</a>
					</span>
					<span id="mylist_delete_button" style="display:none;">
					<a href="#" style="font-size: 16px; margin-top: 20px;" title='Хадгалсан'
						onclick="process_list('series' , 'delete', <?php echo $row['series_id'];?>)"> 
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
				<a href="<?php echo base_url();?>index.php?browse/series/<?php echo $row['genre_id'];?>">
					<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
				</a>
				<p><?php echo $row['description_long'] ?></p>
				<div class="row movie-list">
					<div class="col-sm-6">
						<h5>Бүлэг (Seasons)</h5>
						<ul id="seasons">
							<?php
								$seasons	=	$this->db->get_where('season', array('series_id'=>$series_id))->result_array();
								foreach ($seasons as $row2):
								?>
							<li class="<?php echo $season_id == $row2['season_id'] ? 'active' : '' ?>"><a href="<?php echo base_url();?>index.php?browse/playseries/<?php echo $series_id.'/'.$row2['season_id'];?>">
								<?php echo $row2['name'];?></a>
							</li>
							<?php
								endforeach;?>
						</ul>
					</div>
					<div class="col-sm-6">
						<h5>Ангиуд (Episodes)</h5>
						<div style="overflow-X:hidden">
						<div id="episodeList" style="overflow-Y:scroll;padding: 0 15px; width: Calc(100% + 14px)">
						<ul id="episodes">
							<?php
								$counter	=	1;
								$episodes	=	$this->crud_model->get_episodes_of_season($season_id);							
								foreach ($episodes as $row2):
								?>
								<li class="<?php echo $row2['episode_id'];?>">
									
									<a href="#" onclick="playEpisode(<?php echo $row2['episode_id'];?>)">
										<?php echo $row2['title'];?>
									</a>
									<span class="counter"><?php echo $counter++ ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	
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
	
	$( document ).ready(function() {
		// Checking if this movie_id exist in the active user's wishlist
		mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('series' , $row['series_id']);?>";
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
<!-- SIMILAR VIDEOS HERE -->
<div class="container" style="margin-top: 30px;">
	<div class="row" style="margin-top:20px;">
		<div class="col-lg-12">
			<div class="bs-component">
				
				<div class="content">
					<div class="grid onerow">
						<?php 
							if($type == 'anime'){
								$series = $this->crud_model->get_animes($row['genre_id'] , 10, 0);
							}else{
								$series = $this->crud_model->get_series($row['genre_id'] , 10, 0);
							}
							
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
					
			</div>
		</div>
	</div>
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>
<?php endforeach;?>