<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<?php
					$movie_detail = $this->db->get_where('movie',array('movie_id'=>$movie_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/movie_edit/<?php echo $movie_id;?>" 
					enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="form-label">Movie Title</label>
								<span class="help"></span>
								<div class="controls">
									<input type="text" class="form-control" name="title" value="<?php echo $movie_detail->title;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Video Url</label>
								<span class="help">- youtube or any hosted video</span>
								<div class="controls">
									<input type="text" class="form-control" name="url" id="url" onBlur="load_player()" 
										value="<?php echo $movie_detail->url;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Thumbnail</label>
								<span class="help">- icon image of the movie</span>
								<div class="controls">
									<input type="file" class="form-control" name="thumb">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Poster</label>
								<span class="help">- large banner image of the movie</span>
								<div class="controls">
									<input type="file" class="form-control" name="poster">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Short description </label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="description_short"><?php echo $movie_detail->description_short;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Long description </label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="description_long"><?php echo $movie_detail->description_long;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Actors </label>
								<span class="help">- select multiple actors</span>
								<div class="controls">
									<select class="select2"  multiple name="actors[]" style="width:100%;">
										<?php 
											$actors	=	$this->db->get('actor')->result_array();
											foreach ($actors as $row2):?>
										<option
											<?php 
												$actors	=	$movie_detail->actors;
												if ($actors != '')
												{
													$actor_array	=	json_decode($actors);
													if (in_array($row2['actor_id'], $actor_array))
														echo 'selected';
												}
												?>
											value="<?php echo $row2['actor_id'];?>">
											<?php echo $row2['name'];?>
										</option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Genre </label>
								<span class="help">- genre must be selected</span>
								<div class="controls">
									<select class="select2" name="genre_id" style="width:150px;">
										<?php 
											$genres	=	$this->crud_model->get_genres();
											foreach ($genres as $row2):?>
										<option 
											<?php if ( $movie_detail->genre_id == $row2['genre_id']) echo 'selected';?>
											value="<?php echo $row2['genre_id'];?>">
											<?php echo $row2['name'];?>
										</option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Publishing Year </label>
								<span class="help">- year of publishing time</span>
								<div class="controls">
									<select class="select2" name="year" style="width:150px;">
										<?php for ($i = date("Y"); $i > 2000 ; $i--):?>
										<option
											<?php if ( $movie_detail->year == $i) echo 'selected';?>
											value="<?php echo $i;?>">
											<?php echo $i;?>
										</option>
										<?php endfor;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Rating </label>
								<span class="help">- star rating of the movie</span>
								<div class="controls">
									<select class="select2" name="rating" style="width:150px;">
										<?php for ($i = 0; $i <= 5 ; $i++):?>
										<option 
											<?php if ( $movie_detail->rating == $i) echo 'selected';?>
											value="<?php echo $i;?>">
											<?php echo $i;?>
										</option>
										<?php endfor;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Featured </label>
								<span class="help">- featured movie will be shown in home page</span>
								<div class="controls">
									<select class="select2" name="featured" style="width:150px;">
										<option value="0" <?php if ( $movie_detail->featured == 0) echo 'selected';?>>No</option>
										<option value="1" <?php if ( $movie_detail->featured == 1) echo 'selected';?>>Yes</option>
									</select>
								</div>
							</div>
						</div>
						<!-- PREVIEW OF THE VIDEO FILE -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="form-label">Preview:</label>
								<div id="video_player_div"></div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<input type="submit" class="btn btn-success col-md-3 col-sm-12 col-xs-12" value="Update Movie" style="margin:0px 5px 5px 0px;">
						<a href="<?php echo base_url();?>index.php?admin/movie_list" class="btn btn-default col-md-3 col-sm-12 col-xs-12">Go back</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- LOAD THE PREVIEW OF THE VIDEO USING GIVEN URL -->
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>  
<script>
	window.onload = function()
	{
		load_player();
	}
	function load_player()
	{
		
		url	=	document.getElementById("url").value;
		
		jwplayer("video_player_div").setup({
			"file": url,
			"image": "<?php echo $this->crud_model->get_poster_url('movie' , $movie_id);?>",
			"width": "100%",
			aspectratio: "16:9",
			listbar: {
				position: 'right',
				size: 260
			},
		});
	}
</script>