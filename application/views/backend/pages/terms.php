<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<form method="post" action="<?php echo base_url();?>index.php?admin/terms" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="form-label">Нууцлалын бодлого</label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="privacy_policy" rows="6"><?php echo $privacy_policy;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Үйлчилгээний нөхцөл</label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="terms" rows="6"><?php echo $terms;?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Хадгалах">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>