<?php include 'header_browse.php';?>
<div style="padding-top: 90px">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h4>Нууцлалын бодлого</h4>
		</div>
		<div class="col-lg-12" style="margin:20px;">
			<div class="row">
				<?php
					echo $this->db->get_where('settings',array('type'=>'privacy_policy'))->row()->description;
					?>
			</div>
		</div>
	</div>
	<?php include 'footer.php';?>
</div>
</div>