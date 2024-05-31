<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Holidays</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" class="btn btn-flat btn-primary holi"><span class="fas fa-plus"></span> Add Holiday</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid overflow-auto">
				<table class="table table-bordered table-stripped">
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="20%">
						<!-- <col width="35%"> -->
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr class="bg-gradient-primary">
							<th>#</th>
							<th>Holiday</th>
							<th>Date</th>
							<!-- <th>Description</th> -->
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `holiday_list` order by `holi_date` asc ");
						while ($row = $qry->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo $row['holiday'] ?></td>
								<td><?php echo date("m-d-Y", strtotime($row['holi_date'])) ?></td>
								<!-- <td>
									<p class="m-0 truncate-1"><?= $row['description'] ?></p>
								</td> -->
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
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		$('.holi').click(function() {
			uni_modal('Add New Holiday', "holidays/add_holidays.php")

		})
		$('.edit_data').click(function() {
			uni_modal('Update Holiday', "holidays/manage_holiday.php?id=" + $(this).attr('data-id'))
		})
		$('.view_data').click(function() {
			uni_modal('View holiday Details', "holidays/view_holiday.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this holiday permanently?", "delete_holiday", [$(this).attr('data-id')])
		})
		$('table .th,table .td').addClass('align-middle px-2 py-1')
		$('.table').dataTable();
	})

	function delete_holiday($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_holiday",
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