<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" /> -->
<div style="margin-top:90px"></div>
<?php 
	$genres		=	$this->crud_model->get_genres();
	foreach ($genres as $row):
        $movies	= $this->crud_model->get_animes($row['genre_id'] , 10, 0);
        if(count($movies) > 0){
	?>
<div class="row grid-row">
	<h4 class="genre_title"><?php echo $row['name'];?> <span class="float-right"><a href="/index.php?browse/animes/<?php echo $row['genre_id'] ?>">Бүгдийг үзэх</a></span></h4>
	<div class="content">
		<div class="grid onerow">
			<!-- <div class="swiper mySwiper">
				<div class="swiper-wrapper"> -->
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
				<!-- </div>
				<div class="swiper-button-next"></div>
      			<div class="swiper-button-prev"></div>
				<div class="swiper-pagination"></div>
			</div> -->
		</div>
	</div>
</div>
<?php } endforeach;?>
<div class="container" style="margin-top: 90px;">
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> -->

    <!-- Initialize Swiper -->
    <script>
      /* var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 15,
		navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
		freeMode: true,
		loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {
			480: {
            slidesPerView: 2,
            spaceBetween: 15,
          },
          640: {
            slidesPerView: 4,
            spaceBetween: 15,
          },
          768: {
            slidesPerView: 6,
            spaceBetween: 15,
          },
		  1200: {
            slidesPerView: 8,
            spaceBetween: 15,
          },
        },
      }); */
    </script>