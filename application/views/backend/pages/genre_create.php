<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<form method="post" action="<?php echo base_url();?>index.php?admin/genre_create">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="form-group">
								<label class="form-label">Нэр</label>
								<span class="help">"Action, Romantic" гэх мэт</span>
								<div class="controls">
									<input type="text" class="form-control" name="name">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Хадгалах">
								<a href="<?php echo base_url();?>index.php?admin/genre_list" class="btn btn-default">Буцах</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>