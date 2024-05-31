<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Exams</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">

		<div class="container-fluid overflow-auto">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary">
						<th>#</th>
						<th>Date Created</th>
						<th>Code</th>
						<th>Title</th>
						<th>Passing Score</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT e.*,c.name from `exam_list` e inner join category_list c on c.id = e.category_id order by e.code asc ");
					while ($row = $qry->fetch_assoc()) :
						foreach ($row as $k => $v) {
							$row[$k] = trim(stripslashes($v));
						}
					?>
						<tr>
							<!-- <td class="text-center"><?php echo $i++; ?></td> -->
							<td class="text-center"><?php echo ($row['id']) ?></td>
							<td><?php echo date("m-d-Y H:i", strtotime($row['date_created'])) ?></td>
							<td><?php echo ucwords($row['code']) ?></td>
							<td>
								<p class="m-0 truncate-1" title="<?= $row['title'] ?>"><?php echo ucwords($row['title']) ?></p>
								<small class="text-success">Category: <?= $row['name'] ?></small>
							</td>
							<td class="text-right"><?php echo ($row['passing_score']) ?></td>
							<td class="text-center">
								<?php if ($row['status'] == 1) : ?>
									<span class="badge badge-success bg-gradient-success rounded-pill px-3">Active</span>
								<?php else : ?>
									<span class="badge badge-danger bg-gradient-danger rounded-pill px-3">Inactive</span>
								<?php endif; ?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="./?page=exams/view_exam&id=<?= $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<?php if ($_settings->userdata('type') == 10000) : ?>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div>
							</td>
						</tr>
				<?php endif;
								endwhile; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>
<script>
	$(document).ready(function() {
		$('#create_new').click(function() {
			uni_modal('Add New Exam', "exams/manage_exam.php", 'mid-large')
		})
		$('.edit_data').click(function() {
			uni_modal('Update Exam Details - <b>' + $(this).attr('data-code') + '</b>', "exams/manage_exam.php?id=" + $(this).attr('data-id'), 'mid-large')
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete <b>" + $(this).attr('data-code') + "</b> Exam permanently?", "delete_exam", [$(this).attr('data-id')])
		})
		$('table th, table td').addClass('align-middle px-2 py-1')
		$('.table').dataTable();
	})

	function delete_exam($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_exam",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>