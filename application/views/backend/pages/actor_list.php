<a href="<?php echo base_url();?>index.php?admin/actor_create/" class="btn btn-primary" style="margin-bottom: 20px;">
<i class="fa fa-plus"></i>
Create actor
</a>
<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Actor List</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th></th>
							<th>Actor Name</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$actors = $this->db->get('actor')->result_array();
							$counter = 1;
							foreach ($actors as $row):
							  ?>
						<tr>
							<td style="vertical-align: middle;"><?php echo $counter++;?></td>
							<td><img src="<?php echo $this->crud_model->get_actor_image_url($row['actor_id']);?>" style="height: 60px;" /></td>
							<td style="vertical-align: middle;"><?php echo $row['name'];?></td>
							<td style="vertical-align: middle;">
								<a href="<?php echo base_url();?>index.php?admin/actor_edit/<?php echo $row['actor_id'];?>" class="btn btn-info btn-xs btn-mini">
								edit</a>
								<a href="<?php echo base_url();?>index.php?admin/actor_delete/<?php echo $row['actor_id'];?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Want to delete?')">
								delete</a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>