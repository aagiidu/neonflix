<a href="<?php echo base_url();?>index.php?admin/faq_create/" class="btn btn-primary" style="margin-bottom: 20px;">
<i class="fa fa-plus"></i>
Асуулт үүсгэх
</a>
<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Асуулт хариултын жагсаалт</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>FAQ асуултууд</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$faqs = $this->db->get('faq')->result_array();
							$counter = 1;
							foreach ($faqs as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td style="text-transform: uppercase;"><?php echo $row['question'];?></td>
							<td>
								<a href="<?php echo base_url();?>index.php?admin/faq_edit/<?php echo $row['faq_id'];?>" class="btn btn-info btn-xs btn-mini">
								засах</a>
								<a href="<?php echo base_url();?>index.php?admin/faq_delete/<?php echo $row['faq_id'];?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Устгах уу?')">
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