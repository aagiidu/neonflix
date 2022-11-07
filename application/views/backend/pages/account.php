<div class="row">
	<!-- ADMIN PROFILE INFORMATION UPDATE -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="grid simple ">
			<div class="grid-title ">
				<h4>Update profile</h4>
			</div>
			<div class="grid-body ">
				<?php
					$user_id	=	$this->session->userdata('user_id');
					$user_detail = $this->db->get_where('user',array('user_id'=>$user_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/account" enctype="multipart/form-data">
					<input type="hidden" name="task" value="update_profile" />
					<div class="form-group">
						<label class="form-label">Your name</label>
						<span class="help"></span>
						<div class="controls">
							<input type="text" class="form-control" name="name" value="<?php echo $user_detail->name;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Your email</label>
						<span class="help"></span>
						<div class="controls">
							<input type="text" class="form-control" name="email" value="<?php echo $user_detail->email;?>">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Update profile">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ADMIN PASSWORD UPDATE -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="grid simple ">
			<div class="grid-title ">
				<h4>Change password</h4>
			</div>
			<div class="grid-body ">
				<?php
					$user_id	=	$this->session->userdata('user_id');
					$user_detail = $this->db->get_where('user',array('user_id'=>$user_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/account" enctype="multipart/form-data">
					<input type="hidden" name="task" value="update_password" />
					<div class="form-group">
						<label class="form-label">New password</label>
						<span class="help"></span>
						<div class="controls">
							<input type="password" class="form-control" name="new_password" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Current password</label>
						<span class="help"></span>
						<div class="controls">
							<input type="password" class="form-control" name="old_password" value="">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Update password">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>