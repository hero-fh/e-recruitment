<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Job title</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" class="btn btn-flat btn-primary" id="create_new"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">

		<div class="container-fluid overflow-auto">
			<table class="table table-bordered table-stripped">

				<thead>
					<tr class="bg-gradient-primary">
						<th>#</th>
						<th>Job title</th>
						<!-- <th>Job description</th>
						<th>Job qualification</th> -->
						<th>Department</th>
						<!-- <th>Exam type</th> -->
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * from `position`  ORDER BY position");
					while ($row = $qry->fetch_assoc()) :
						if ($row['application_id'] == 1) {
							$pos = 'Operator';
						} elseif ($row['application_id']  == 2) {
							$pos = 'QA Engineer';
						} elseif ($row['application_id']  == 3) {
							$pos = 'Staff';
						} elseif ($row['application_id']  == 4) {
							$pos = 'Technician / Engineer';
						}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['position'] ?></td>
							<!-- <td><?php echo $row['job_desc'] ?></td>
							<td><?php echo $row['job_quali'] ?></td> -->
							<td><?php echo $row['department'] ?></td>
							<!-- <td><?php echo $pos ?></td> -->

							<td class="text-center">
								<?php if ($row['status'] == 1) : ?>
									<span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
								<?php else : ?>
									<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
								<?php endif; ?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<!-- <div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>
<script>
	$(document).ready(function() {
		$('#create_new').click(function() {
			uni_modal('Add New job', "position/manage_position.php", 'large')
		})
		$('.edit_data').click(function() {
			uni_modal('Update job', "position/manage_position.php?id=" + $(this).attr('data-id'), 'large')
		})
		$('.view_data').click(function() {
			uni_modal('View job Details', "position/view_position.php?id=" + $(this).attr('data-id'), 'small')
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this job permanently?", "delete_position", [$(this).attr('data-id')])
		})
		$('table .th,table .td').addClass('align-middle px-2 py-1')
		$('.table').dataTable();
	})

	function delete_position($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_position",
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