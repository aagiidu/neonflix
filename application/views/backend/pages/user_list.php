<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-body ">
				<h4>Админууд</h4>
			<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Нэр</th>
							<th>И-мэйл</th>
							<th>Утас</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$admins = $this->db->get_where('user', array('type'=>1))->result_array();
							$counter = 1;
							foreach ($admins as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td style="text-transform: uppercase;"><?php echo $row['name'];?></td>
							<td><?php echo $row['email'];?></td>
							<td style="text-transform: uppercase;"><?php echo $row['phone'];?></td>
							<td style="width:150px">
							<a href="<?php echo base_url();?>index.php?admin/noadmin/<?php echo $row['user_id'] ?>" class="btn btn-primary">
							<i class="fa fa-remove"></i>
							Админаас хасах
							</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<h4>Хэрэглэгчид</h4>
				<table class="table table-hover table-condensed" id="example2">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Нэр</th>
							<th>И-мэйл</th>
							<th>Утас</th>
							<th>Багц</th>
							<th></th>
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
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['phone'];?></td>
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
							<td style="width:150px">
							<a href="<?php echo base_url();?>index.php?admin/makeadmin/<?php echo $row['user_id'] ?>" class="btn btn-primary">
							<i class="fa fa-plus"></i>
							Админ болгох
							</a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>