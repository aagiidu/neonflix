<style>
	.checkbox{width: 40px}
	.qlt label{float:left}
</style>
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
								<label class="form-label">Киноны нэр</label>
								<span class="help"></span>
								<div class="controls">
									<input type="text" class="form-control" name="title" value="<?php echo $movie_detail->title;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Файлын холбоос</label>
								<div class="controls">
									<input type="text" class="form-control" name="url" id="url" onBlur="load_player()" 
										value="<?php echo $movie_detail->url;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Жижиг зураг</label>
								<div class="controls">
									<input type="file" class="form-control" name="thumb">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Постер</label>
								<!-- <span class="help">- large banner image of the movie</span> -->
								<div class="controls">
									<input type="file" class="form-control" name="poster">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Товч агуулга </label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="description_long"><?php echo $movie_detail->description_long;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Жанр </label>
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
								<label class="form-label">Гарсан он </label>
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
							<!-- <div class="form-group">
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
							</div> -->
							<div class="form-group">
								<label class="form-label">Онцлох кино </label>
								<div class="controls">
									<select class="select2" name="featured" style="width:150px;">
										<option value="0" <?php if ( $movie_detail->featured == 0) echo 'selected';?>>Үгүй</option>
										<option value="1" <?php if ( $movie_detail->featured == 1) echo 'selected';?>>Тийм</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Нягтшил </label>
								<div class="controls qlt">
									<label>
										<input type="checkbox" class="form-control checkbox" name="qlt[]" value="1080" <?php if ( strpos($movie_detail->qlt, '1080') > -1 ) echo 'checked';?>/> 1080p
									</label>
									<label>
										<input type="checkbox" class="form-control checkbox" name="qlt[]" value="720" <?php if ( strpos($movie_detail->qlt, '720') > -1 ) echo 'checked';?>/> 720p
									</label>
									<label>
										<input type="checkbox" class="form-control checkbox" name="qlt[]" value="480" <?php if ( strpos($movie_detail->qlt, '480') > -1 ) echo 'checked';?>/> 480p
									</label>
									<label>
										<input type="checkbox" class="form-control checkbox" name="qlt[]" value="360" <?php if ( strpos($movie_detail->qlt, '360') > -1 ) echo 'checked';?>/> 360p
									</label>
								</div>
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
						<input type="submit" class="btn btn-success col-md-3 col-sm-12 col-xs-12" value="Хадгалах" style="margin:0px 5px 5px 0px;">
						<a href="<?php echo base_url();?>index.php?admin/movie_list" class="btn btn-default col-md-3 col-sm-12 col-xs-12">Буцах</a>
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