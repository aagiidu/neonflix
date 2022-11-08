<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>User List</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Утас</th>
							<th>Багц</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$users = $this->db->get_where('user', array('type'=>0))->result_array();
							$counter = 1;
							foreach ($users as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td style="text-transform: uppercase;"><?php echo $row['phone'];?></td>
							<td>
								<?php
									$plan_id	=	$this->crud_model->get_active_plan_of_user($row['user_id']);
									if ($plan_id != false)
									{
										$plan_name	=	$this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;
										echo $plan_name;
									}
									?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>