<?php include 'header_browse.php';?>

<div class="landing-poster">
	<div class="land-center">
        <div>
            <a href="/index.php?home/seriesgrid" class="btn img-btn" >
                <img src="/assets/global/btn-drama.png" />
            </a>
            <a href="/index.php?home/animegrid" class="btn img-btn" >
                <img src="/assets/global/btn-anime.png" />
            </a>
            <a href="/index.php?home/moviegrid" class="btn img-btn" >
                <img src="/assets/global/btn-movie.png" />
            </a>
            <?php if($userdata == null){ ?>
            <p class="text-center">
                <a href="<?php echo base_url();?>index.php?home/signup" class="btn btn-danger btn-lg reg-btn" >БҮРТГҮҮЛЭХ</a>
            </p>
            <?php } ?>
	    </div>
    </div>
	
</div>
<!-- MIDDLE TAB SECTION -->
<div class="container">
	<?php include 'footer.php';?>
</div>