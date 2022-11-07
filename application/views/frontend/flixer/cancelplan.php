<?php include 'header_browse.php';?>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">Cancel Your Membership?</h3>
			<hr>
		</div>
		<div class="col-lg-8">
			<h4 class="black_text">Click "Finish Cancellation" below to cancel your membership.</h4>
			<ul class="black_text">
				<li>
					Cancellation will be effective immedietly after your confirmation.
				</li>
				<li>
					Restart your membership anytime. Your viewing preferences will be saved always.
				</li>
			</ul>
			<form method="post" action="<?php echo base_url();?>index.php?browse/cancelplan">
				<input type="hidden" name="task" value="cancel_plan" />
				<button class="btn btn-primary" type="submit"> Finish Cancellation </button>
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Go Back</a>
			</form>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>


