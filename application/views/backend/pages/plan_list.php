<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Package List</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Package Name</th>
							<th>Available Screen</th>
							<th>Price</th>
							<th>Status</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$plans = $this->db->get('plan')->result_array();
							$counter = 1;
							foreach ($plans as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td style="text-transform: uppercase;"><?php echo $row['name'];?></td>
							<td style="text-transform: uppercase;"><?php echo $row['screens'];?></td>
							<td style="text-transform: uppercase;">USD <?php echo $row['price'];?></td>
							<td style="text-transform: uppercase;">
								<?php 
									if ($row['status'] == 1)
									{
										echo 'active';
									}
									else 
									{
										echo 'inactive';
									}
									?>
							</td>
							<td>
								<a href="<?php echo base_url();?>index.php?admin/plan_edit/<?php echo $row['plan_id'];?>" class="btn btn-info btn-xs btn-mini">
								edit</a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>