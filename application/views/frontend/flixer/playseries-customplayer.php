<?php include 'header_browse.php';?>
<?php
	$series_details	=	$this->db->get_where('series' , array('series_id' => $series_id))->result_array();
	foreach ($series_details as $row):
		$thumburl = $this->crud_model->get_thumb_url('series' , $row['series_id']);
	?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
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
		<div class="row">
			<div class="col-lg-8">
				<div id="neon-player">
					<div id="wrapper">
						<video id="videoPlayer" controlsList="nodownload"></video>
						<img src="<?php echo $this->crud_model->get_poster_url('series' , $row['series_id']);?>" class="player-poster">
						<h4 id="movieTitle" class="initial"></h4>
						<div id="ctrl" class="initial">
							<img src="/assets/global/logo.png" class="player-logo">
							<div class="player-progress">
								<label id="timer" for="progress" role="timer"></label>
								<progress id="progress" max="100" value="0">Progress</progress>
								<input class="seek progress" id="seek" value="0" min="0" type="range" step="1"> 
							</div>
							<div id="buttons">
								<button type="button" class="btn btn-player btn-sm" onclick="back()"><i class="fa fa-step-backward"></i> 10сек</button>
								<button type="button" class="btn btn-player btn-sm play" id="play"><i class="fa fa-play"></i></button>
								<button type="button" class="btn btn-player btn-sm" onclick="skip()">10сек <i class="fa fa-step-forward"></i></button>
							</div>
							<span id="qlyChooser" class="ctrl-btn">
								<span class="chosen btn btn-player btn-sm"></span>
								<ul>
									<li onclick="changeQ(1080)">1080p</li>
									<li onclick="changeQ(720)">720p</li>
									<li onclick="changeQ(640)">640p</li>
								</ul>
							</span>
							<button type="button" class="btn btn-player btn-sm" id="fullscreen">
								<i class="fa fa-arrows-alt"></i>
							</button>
						</div>
					</div>
				</div>

				<script>
					const episodes = JSON.parse('<?php echo $epison; ?>');
					console.log('episodes', episodes);
					let episode = episodes[0];

					function playEpisode(episodeId){
						const episode = episodes.find(e => e.episode_id === episodeId.toString());
						console.log('episode chosen', episode)
						setMedia(episode);
					}

					function setMedia(episode){
						$(`#episodes li`).removeClass('selected');
						$(`#episodes .${episode.episode_id}`).addClass('selected');
						$('#movieTitle').text(episode.title)
						const q = [1080, 720, 640];
						$('.chosen').text(q[0] + 'p');
						for (let i = 0; i < q.length; i++) {
							var src = document.createElement('source');
							src.setAttribute('id', q[i]);
							src.setAttribute('src', `http://localhost:8000/video/anime/${episode.url}/${q[i]}`);
							// src.setAttribute('src', `https://stream.neontoon.mn/video/anime/${episode.url}/${q[i]}`);
							$('#videoPlayer').append(src);
						}
					}
					
					$(function() {
						setMedia(episodes[0]);	
					});

					/* progress */
					function progressLoop() {
						let video = document.getElementById('videoPlayer');
						setInterval(function () {
							let current = formatTime(parseInt(video.currentTime))
							let duration = formatTime(parseInt(video.duration))
							$('#timer').text(current + '/' + duration)
							document.getElementById("progress").value = Math.round(
								(video.currentTime / video.duration) * 100
							);
							document.getElementById('seek').value = Math.round(
								(video.currentTime / video.duration) * 100
							);
						}, 1000);
					}

					progressLoop();

					$('#seek').on('change', function(){
						let val = $(this).val()
						let video = document.getElementById('videoPlayer');
						console.log(val)
						/* (x / video.duration) * 100 = val
						x / video.duration = val / 100
						x = val/100 * video.duration */
						let time = val / 100 * video.duration;
						console.log(time)
						video.currentTime = time;
					});

					function changeQ(size){
						$('.chosen').text(size + 'p');
						let video = document.getElementById('videoPlayer');
						let curtime = video.currentTime;
						let source = $(`#${size}`).detach();
						video.prepend(source.get(0));
						video.load();
						video.currentTime = curtime;
						if(!video.paused){
							video.play();
						}
					}

					function back(){
						let video = document.getElementById('videoPlayer');
						let curtime = video.currentTime >= 10 ? video.currentTime - 10 : 0;
						video.currentTime = curtime;
					}

					function skip(){
						let video = document.getElementById('videoPlayer');
						let curtime = video.currentTime + 10;
						video.currentTime = curtime;
					}
	
					$('#fullscreen').on('click', function(){
						fullScr();
					})
					function fullScr() {
						const fullscreenElement =
						document.fullscreenElement ||
						document.mozFullScreenElement ||
						document.webkitFullscreenElement ||
						document.msFullscreenElement;
						if (fullscreenElement) {
						exitFullscreen();
						} else {
						launchIntoFullscreen(document.getElementById('neon-player'));
						}
					};

					function launchIntoFullscreen(element) {
						if (element.requestFullscreen) {
						element.requestFullscreen();
						} else if (element.mozRequestFullScreen) {
						element.mozRequestFullScreen();
						} else if (element.webkitRequestFullscreen) {
						element.webkitRequestFullscreen();
						} else if (element.msRequestFullscreen) {
						element.msRequestFullscreen();
						} else {
						element.classList.toggle('fullscreen');
						}
					}

					function exitFullscreen() {
						if (document.exitFullscreen) {
						document.exitFullscreen();
						} else if (document.mozCancelFullScreen) {
						document.mozCancelFullScreen();
						} else if (document.webkitExitFullscreen) {
						document.webkitExitFullscreen();
						}
					}

					let started = 0;
					$('#play, #videoPlayer').on('click', function(){
						$('.player-poster').hide();
						let video = document.getElementById('videoPlayer');
						if(video.paused){
							video.play();
							$('#play').removeClass('play').find('.fa').removeClass('fa-play').addClass('fa-pause');
						}else{
							video.pause();
							$('#play').addClass('play').find('.fa').removeClass('fa-pause').addClass('fa-play');
						}
						if(started == 0){
							$('#ctrl, #movieTitle').removeClass('initial');
							let timer
							document.getElementById('wrapper').addEventListener(`mousemove`, () => {
								if($('#ctrl').hasClass('invisible')){
									$('#ctrl').removeClass('invisible')
									$('#movieTitle').removeClass('invisible')
								}
								clearTimeout(timer)
								timer = setTimeout(onMouseStopped, 4000)
							})

							function onMouseStopped(){
								console.log('Mouse Stopped');
								$('#ctrl').addClass('invisible');
								$('#movieTitle').addClass('invisible')
							}
							started = 1;
						}
					})

					function formatTime(timeInSeconds) {
						const result = new Date(timeInSeconds * 1000).toISOString().substr(11, 8);
						const t = {
							hours: result.substr(0, 2),
							minutes: result.substr(3, 2),
							seconds: result.substr(6, 2),
						};
						return t.hours + ':' + t.minutes + ':' + t.seconds;
					};

					
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
									<!-- <div>
										<pre>
											<?php var_dump($row2) ?>
										</pre>
									</div> -->
								</li>
							<?php endforeach;?>
						</ul>
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