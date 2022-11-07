<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<form method="post" action="<?php echo base_url();?>index.php?admin/faq_create">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="form-group">
								<label class="form-label">Faq Question</label>
								<div class="controls">
									<input type="text" class="form-control" name="question">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Faq Answer</label>
								<div class="controls">
									<textarea class="form-control" name="answer"></textarea>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Create">
								<a href="<?php echo base_url();?>index.php?admin/faq_list" class="btn btn-default">Go back</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>