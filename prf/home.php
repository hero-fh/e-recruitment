<style>
	.box {
		/* width: 400px; */
		/* height: 20px; */
		border: 2px solid #000;
		margin: 0 auto 15px;
		text-align: center;
		padding: 60px;
		font-weight: bold;
		border-radius: 10px;

	}

	.success {
		background-color: #B9FFAB;
		border-color: #116400;
		color: #116400;
	}
</style>
<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php
elseif (!isset($_SESSION['userdata'])) :
	echo '<div class="success box" style="font-family: Verdana; font-size: 25px;">
	Please log in to request or view personnel requests.
  </div>';
	exit;
endif; ?>
<!-- <div class="card card-outline card-success">
	<div class="card-header">
		<h3 class="card-title">List of Requests</h3>
		<div class="card-tools">
			<a href="<?php echo base_url . "prf/?p=apply" ?>" class="btn btn-flat btn-success rounded-pill px-3"><span class="fas fa-plus"></span> Request</a>
		</div>
	</div> -->
<div class="card card-outline card-success">

	<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
			<li class="pt-2 px-3">
				<h3 class="card-title">List of Requests</h3>
			</li>
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-all-tab" data-toggle="pill" href="#custom-tabs-one-all" role="tab" aria-controls="custom-tabs-one-all" aria-selected="true">All</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-pending-tab" data-toggle="pill" href="#custom-tabs-one-pending" role="tab" aria-controls="custom-tabs-one-pending" aria-selected="false">For Approval</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-signed-tab" data-toggle="pill" href="#custom-tabs-one-signed" role="tab" aria-controls="custom-tabs-one-signed" aria-selected="false">Approved</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-open-tab" data-toggle="pill" href="#custom-tabs-one-open" role="tab" aria-controls="custom-tabs-one-open" aria-selected="false">Open</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-closed-tab" data-toggle="pill" href="#custom-tabs-one-closed" role="tab" aria-controls="custom-tabs-one-closed" aria-selected="false">Closed</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-hold-tab" data-toggle="pill" href="#custom-tabs-one-hold" role="tab" aria-controls="custom-tabs-one-hold" aria-selected="false">Hold</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-cancelled-tab" data-toggle="pill" href="#custom-tabs-one-cancelled" role="tab" aria-controls="custom-tabs-one-cancelled" aria-selected="false">Cancelled</a>
			</li>
			<li class="nav-item ml-auto">
				<a href="<?php echo base_url . "prf/?p=apply" ?>" class="btn btn-flat btn-success rounded-pill px-3"><span class="fas fa-plus"></span> Request</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
			<div class="tab-pane fade show active" id="custom-tabs-one-all" role="tabpanel" aria-labelledby="custom-tabs-one-all-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$qry = $conn->query('SELECT * from `prf_request`  where acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-pending" role="tabpanel" aria-labelledby="custom-tabs-one-pending-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$qry = $conn->query('SELECT * from `prf_request` where (d_head=0 or a_sign=0 or noted_by=0) and status=4 and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-signed" role="tabpanel" aria-labelledby="custom-tabs-one-signed-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;

							$qry = $conn->query('SELECT * from `prf_request` where (d_head=1 and a_sign=1 and noted_by=1)  and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td>
										<?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?>
									</td>
									<td>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-open" role="tabpanel" aria-labelledby="custom-tabs-one-open-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;

							$qry = $conn->query('SELECT * from `prf_request` where status = 4 and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-closed" role="tabpanel" aria-labelledby="custom-tabs-one-closed-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;

							$qry = $conn->query('SELECT * from `prf_request` where status = 3 and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-hold" role="tabpanel" aria-labelledby="custom-tabs-one-hold-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;

							$qry = $conn->query('SELECT * from `prf_request` where status = 1 and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-cancelled" role="tabpanel" aria-labelledby="custom-tabs-one-cancelled-tab">
				<div class="container-fluid overflow-auto">
					<table class="table table-bordered table-stripped text-center">

						<thead>
							<tr class="bg-gradient-success">
								<th>#</th>
								<th>PRF No.</th>
								<th>Requestor</th>
								<th>Requested Personnel</th>
								<th>Date of Requisition</th>
								<th>Department</th>
								<th>Status</th>
								<th>Approved by</th>
								<th>Noted by</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;

							$qry = $conn->query('SELECT * from `prf_request` where status = 2 and acc_requestor = ' . $_settings->userdata('approver') . ' and acc_requestor_id = ' . $_settings->userdata('id') . ' order by requisition desc');
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><?php echo $row['prf_no'] ?></td>
									<td><?php echo $row['requestor'] ?></td>
									<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['position']}'")->fetch_array()[0]; ?>
									<?php $req = $conn->query("SELECT username FROM `prf_requestor` WHERE id = '{$row['acc_requestor_id']}'")->fetch_array()[0]; ?>
									<td><?php echo $pos ?></td>
									<td><?php echo $row['requisition'] ?></td>
									<td><?php echo $req ?></td>

									<td><?php echo isset($row['status']) && $row['status'] == 1 ? "<span class='badge  rounded-pill px-3 badge-info'>Hold</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 2 ? "<span class='badge  rounded-pill px-3 badge-warning'>Cancelled</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 3 ? "<span class='badge  rounded-pill px-3 badge-danger'>Closed</span>" : '' ?>
										<?php echo isset($row['status']) && $row['status'] == 4 ? "<span class='badge  rounded-pill px-3 badge-success'>Open</span>" : '' ?></td>
									<td> <?php echo isset($row['a_sign']) && $row['a_sign'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?>
										<?php echo isset($row['a_sign']) && $row['a_sign'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?>
									</td>

									<td>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 1 ? "<span class='badge  rounded-pill px-3 badge-success'>Approve</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 0 ? "<span class='badge  rounded-pill px-3 badge-secondary'>Pending</span>" : "" ?></small>
										<?php echo isset($row['noted_by']) && $row['noted_by'] == 2 ? "<span class='badge  rounded-pill px-3 badge-danger'>Disapprove</span>" : "" ?></small>

									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
											<a class="btn btn-sm  rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($row['prf_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>

											<!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
										</button>
										<!-- <div class="dropdown-menu" role="menu">
								</div> -->
										<!-- <div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div> -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		// $('.who').click(function() {
		// 	uni_modal('', _base_url_ + "prf/who.php?id=" + $(this).attr('data-id'))
		// })


		$('.edit_data').click(function() {
			uni_modal('Update Position', "prf_admin/manage_prf.php?id=" + $(this).attr('data-id'))
		})
		$('.view_data').click(function() {
			uni_modal('View Position Details', "prf_admin/view_exit.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this Position permanently?", "delete_position", [$(this).attr('data-id')])
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