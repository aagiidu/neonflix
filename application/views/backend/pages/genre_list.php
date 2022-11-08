<a href="<?php echo base_url();?>index.php?admin/genre_create/" class="btn btn-primary" style="margin-bottom: 20px;">
<i class="fa fa-plus"></i>
Create genre
</a>
<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Жанрууд</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>Жанр</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$genres = $this->crud_model->get_genres();
							$counter = 1;
							foreach ($genres as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td style="text-transform: uppercase;"><?php echo $row['name'];?></td>
							<td>
								<a href="<?php echo base_url();?>index.php?admin/genre_edit/<?php echo $row['genre_id'];?>" class="btn btn-info btn-xs btn-mini">
								засах</a>
								<a href="<?php echo base_url();?>index.php?admin/genre_delete/<?php echo $row['genre_id'];?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Устгах уу?')">
								устгах</a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>