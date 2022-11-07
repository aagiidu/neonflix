<a href="<?php echo base_url();?>index.php?admin/anime_create/" class="btn btn-primary" style="margin-bottom: 20px;">
<i class="fa fa-plus"></i>
Шинээр үүсгэх
</a>
<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Tv Series List</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th></th>
							<th>Нэр</th>
							<th>Жанр</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$seriess = $this->db->get_where('series', array('type' => 1))->result_array();
							$counter = 1;
							foreach ($seriess as $row):
							  ?>
						<tr>
							<td style="vertical-align: middle;"><?php echo $counter++;?></td>
							<td><img src="<?php echo $this->crud_model->get_thumb_url('series' , $row['series_id']);?>" style="height: 60px;" /></td>
							<td style="vertical-align: middle;"><?php echo $row['title'];?></td>
							<td style="vertical-align: middle;">
								<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
							</td>
							<td style="vertical-align: middle;">
								<a href="<?php echo base_url();?>index.php?browse/playseries/<?php echo $row['series_id'];?>" 
									target="_blank" class="btn btn-default btn-xs btn-mini">
								<i class="fa fa-external-link"></i>Үзэх</a>
								<a href="<?php echo base_url();?>index.php?admin/anime_edit/<?php echo $row['series_id'];?>" class="btn btn-info btn-xs btn-mini">
								Засах</a>
								<a href="<?php echo base_url();?>index.php?admin/anime_delete/<?php echo $row['series_id'];?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Want to delete?')">
								Устгах</a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>