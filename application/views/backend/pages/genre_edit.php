<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<?php
					$genre_detail = $this->db->get_where('genre',array('genre_id'=>$genre_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/genre_edit/<?php echo $genre_id;?>">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="form-group">
								<label class="form-label">Genre Name</label>
								<span class="help">e.g. "Action, Romantic"</span>
								<div class="controls">
									<input type="text" class="form-control" name="name" value="<?php echo $genre_detail->name;?>">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Update">
								<a href="<?php echo base_url();?>index.php?admin/genre_list" class="btn btn-default">Go back</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>