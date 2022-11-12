<?php 
	if ($page_name == 'home' || $page_name == 'playmovie') 
		$nav_type = 'nav_transparent';
	else 
		$nav_type = 'nav_dark';
	?>

<?php if($page_name != 'landing'){ ?>
<div class="sidecol">
<div class="sidebar">
    <ul>
        <li>
            <a href="/index.php?home/landing2" >
                <i class="fa fa-home"></i>
                <span>Эхлэл</span>
            </a>
        </li>
        <li>
            <a href="/index.php?home/seriesgrid">
                <i class="fa fa-desktop"></i>
                <span>Олон ангит</span>
            </a>
        </li>
        <li>
            <a href="/index.php?home/animegrid">
                <i class="fa fa-file-video-o"></i>
                <span>Анимэ</span>
            </a>
        </li>
        <li>
            <a href="/index.php?home/moviegrid">
                <i class="fa fa-film"></i>
                <span>Кино</span>
            </a>
        </li>
        <?php if($userdata != null){ ?>
        <li>
            <a href="<?php echo base_url();?>index.php?browse/mylist">
            <i class="fa fa-heart-o"></i>
                <span>Миний жагсаалт</span>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
</div>
<?php } ?>