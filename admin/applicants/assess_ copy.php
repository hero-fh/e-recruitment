<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<style>
	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
	}

	.hide {
		display: none;
	}

	.custom-button {
		/* Add your custom styles here */
		background-color: #28a745;
		color: white;
		border: none;
		padding: 10px;
		cursor: pointer;
		width: 300px;
	}

	.custom-button:hover {
		background-color: darkblue;
	}

	/* .dataTables_wrapper .dataTables_paginate {
		display: none;
	} */
</style>
<!-- <div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Applicant</h3>
	</div> -->
<div class="col-12 col-sm-12 lala">
	<div class="card card-primary card-tabs ">
		<div class="card-header p-0 pt-1">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="custom-tabs-one-dept-tab" data-toggle="pill" href="#custom-tabs-one-dept" role="tab" aria-controls="custom-tabs-one-dept" aria-selected="true">Department</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-one-all-tab" data-toggle="pill" href="#custom-tabs-one-all" role="tab" aria-controls="custom-tabs-one-all" aria-selected="false">All</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content" id="custom-tabs-one-tabContent">
				<div class="tab-pane fade show active" id="custom-tabs-one-dept" role="tabpanel" aria-labelledby="custom-tabs-one-dept-tab">
					<div class="container-fluid overflow-auto">
						<table class="table table-bordered table-stripped">
							<thead>
								<tr class="bg-gradient-primary">
									<th>#</th>
									<th>Date of Application</th>
									<th>Applicant name</th>
									<th>Position applied</th>
									<th>Department</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								// $qry = $conn->query("SELECT ap.*, concat(ap.surname,', ',ap.firstname,' ',ap.middlename) as fullname  from `applicants` ap inner join position pos on ap.position_name = pos.position where ap.assess = 1 and pos.department = '{$_settings->userdata('DEPARTMENT')}' order by ap.application_date desc ");
								// $qry1 = $conn->query("SELECT * FROM applicants");


								// while ($rows = $qry1->fetch_assoc()) :
								$sql = "SELECT ap.*, CONCAT(ap.surname, ', ', ap.firstname, ' ', ap.middlename) AS fullname FROM `applicants` ap ";

								if (empty($rows['recommended_pos'])) {
									$sql .= "INNER JOIN `position` pos ON ap.position_name = pos.position ";
								} else {
									$sql .= "INNER JOIN `position` pos ON ap.recommended_pos = pos.position ";
								}
								$sql .= "WHERE ap.assess = 1 AND pos.department = '{$_settings->userdata('DEPARTMENT')}' ORDER BY ap.application_date DESC";

								// Execute the query for this specific row
								$qry = $conn->query($sql);

								// Process the results or perform other actions here




								while ($row = $qry->fetch_assoc()) :
									$checks = $conn->query("SELECT recommended_pos FROM  `assessment` where id='{$row['id']}'");
									$rowscount = $checks->num_rows;
									if ($rowscount == 1) {
										$a_pos = $conn->query("SELECT recommended_pos FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
										$choose = $conn->query("SELECT choose FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
									} else {
										$a_pos = NULL;
									}
									$checks_dept = $conn->query("SELECT department FROM  `position` where position='{$row['position_name']}'");
									$rowscount_dept = $checks_dept->num_rows;
									if ($rowscount_dept == 1) {
										$dept = $conn->query("SELECT department FROM  `position` where position='{$row['position_name']}'")->fetch_array()[0];
									} else {
										$dept = NULL;
									}
									// echo $a_pos;
									// echo '<br>';
								?>
									<tr>
										<td class="text-center"><?php echo $i++; ?></td>
										<td class="text-center"><?php echo date("m-d-Y", strtotime($row['application_date'])) ?></td>
										<td><?php echo ucwords(strtolower($row['fullname']))  ?></td>
										<td class="text-left "><?php echo isset($a_pos) ? $a_pos : $row['position_name'] ?></td>
										<td class="text-left "><?php echo isset($dept) ? $dept : '' ?></td>
										<td align="center">
											<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu" role="menu">
												<?php if ($_settings->userdata('type') != 4) { ?>
													<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> Assess</a>
													<!-- <div class="dropdown-divider"></div> -->
												<?php } elseif ($_settings->userdata('type') == 4) { ?>
													<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/view_applicants_a&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> Assess</a>

													<?php }
												if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') {
													if ($row['application'] == 2) { ?>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/qa_test2&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Exam</a>
													<?php } elseif ($row['application'] == 4) { ?>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/test2&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Exam</a>
													<?php } elseif ($row['application'] == 3 || $row['application'] == 1) { ?>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/essay&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Exam</a>
													<?php } ?>
												<?php } ?>
											</div>
										</td>
									</tr>
								<?php endwhile; ?>
								<?php //endwhile; 
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade show" id="custom-tabs-one-all" role="tabpanel" aria-labelledby="custom-tabs-one-all-tab">
					<div class="container-fluid overflow-auto">
						<table class="table table-bordered table-stripped">
							<thead>
								<tr class="bg-gradient-primary">
									<th>#</th>
									<th>Date of Application</th>
									<th>Position</th>
									<th>Applicants</th>
									<th>Contact #</th>
									<th>Email</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname  from `applicants` where assess = 1  order by application_date desc ");
								while ($row = $qry->fetch_assoc()) :
									$checks = $conn->query("SELECT a_position FROM  `assessment` where id='{$row['id']}'");
									$rowscount = $checks->num_rows;
									if ($rowscount == 1) {
										$a_pos = $conn->query("SELECT a_position FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
										$checks1 = $conn->query("SELECT recommended_pos FROM  `assessment` where (recommended_pos != '' || recommended_pos != null ) and id='{$row['id']}'");
										$rowscount1 = $checks1->num_rows;
										if ($rowscount1 == 1) {
											$a_pos1 = $conn->query("SELECT recommended_pos FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
											$a_pos = $conn->query("SELECT position FROM position where position = '{$a_pos1}'")->fetch_array()[0];
										}
										$choose = $conn->query("SELECT choose FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
									} else {
										$a_pos = NULL;
									}
									$total = $conn->query("SELECT SUM(total_score) FROM  `applicant_score` where applicant_id='{$row['id']}'")->fetch_array()[0];
									$cid1 = $conn->query("SELECT `category_id` FROM `applicant_score` where applicant_id='{$row['id']}'")->fetch_array();
									$cid = isset($cid1[0]) ? $cid1[0] : '';
									$total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$cid}'")->fetch_array()[0];
									$orient = $conn->query("SELECT `applicant_name` FROM `prf_applicants` where applicant_name='{$row['fullname']}'")->num_rows;
									$prf_no = $conn->query("SELECT prf_no FROM  `assessment` where id='{$row['id']}'")->fetch_array();
								?>

									<tr>
										<td class="text-center"><?php echo $i++; ?></td>
										<td class="text-center"><?php echo date("m-d-Y", strtotime($row['application_date'])) ?></td>
										<td class="text-left "><?php echo isset($a_pos) ? $a_pos : $row['position_name'] ?></td>
										<td><?php echo ucwords(strtolower($row['fullname']))  ?></td>
										<td><?php echo ucwords($row['mobile_number']) ?></td>
										<td><?php echo strtolower($row['email']) ?></td>

										<td class="text-center">
											<?php if ($row['passed'] == 1) { ?>
												<?php echo isset($prf_no[0]) ? '<span class="badge  rounded-pill px-3 ">' . $prf_no[0] . '</span>' : '' ?>
												<?php if ($row['assess'] == 0 && $row['pdf'] == 0) : ?>
													<span class="badge  rounded-pill px-3 bg-navy">For interview</span>
												<?php elseif ($row['assess'] == 1 && $row['pdf'] == 0 && $choose == 2) : ?>
													<span class="badge  rounded-pill px-3 bg-danger">Failed in interview</span>
												<?php elseif ($row['assess'] == 1 && $row['pdf'] == 0 && $row['job_offer'] == 0 && $row['application'] != 1 && $choose == 1) : ?>
													<span class="badge  rounded-pill px-3 badge-secondary">For department interview</span>
												<?php elseif ($row['assess'] == 1 && $row['pdf'] == 0 && $row['job_offer'] == 0 && $row['application'] != 1 && $choose == 3) : ?>
													<span class="badge  rounded-pill px-3 badge-info">For job offer</span>
												<?php elseif ($row['assess'] == 1 && $row['pdf'] == 0 && $row['job_offer'] == 2 && $row['application'] != 1 && $choose != 2) : ?>
													<span class="badge  rounded-pill px-3 badge-danger">Job offer rejected</span>
												<?php elseif ($row['assess'] == 1 && $row['pdf'] == 0 && $choose != 2) : ?>
													<span class="badge  rounded-pill px-3 badge-warning">For requirement</span>
												<?php elseif ($row['status'] == 0 && $row['assess'] == 1 && $row['pdf'] != 0 && $choose != 2) : ?>
													<span class="badge  rounded-pill px-3 badge-primary">For medical</span>
												<?php elseif ($row['status'] == 1 && $row['assess'] == 1 && $row['pdf'] != 0 && $choose != 2) : ?>
													<span class="badge  rounded-pill px-3 badge-success">Fit to work</span>
												<?php elseif ($row['status'] == 1 && $row['assess'] == 1 && $row['pdf'] != 0 && $choose != 2) : ?>
													<span class="badge  rounded-pill px-3 badge-success">For Orientation</span>
												<?php endif; ?>
											<?php	} elseif ($row['passed'] == 2) { ?>
												<?php if ($total == $total_points) { ?>
													<span class="badge rounded-pill px-3 bg-pink">Check Test 2</span>
												<?php	} else { ?>
													<span class="badge rounded-pill px-3 badge-danger">Failed in exam</span>
												<?php	} ?>
											<?php	} else { ?>
												<span class="badge  rounded-pill px-3 ">For exam</span>
											<?php }; ?>
										</td>
										<td align="center">
											<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" <?php echo  $row['passed'] == 0 ? 'disabled' : '' ?> data-toggle="dropdown">
												Action
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu" role="menu">
												<?php if ($total != $total_points && $total != 1) { ?>
													<?php if ($_settings->userdata('type') != 4) { ?>
														<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
													<?php } elseif ($_settings->userdata('type') == 4) { ?>
														<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/view_applicants_a&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>

														<!-- user type = department section head / manager  -->
													<?php }
													?>
													<?php if (isset($choose)) { ?>
														<?php if ($_settings->userdata('type') != 4 && $choose == 3 && $row['passed'] == 1) { ?>
															<div class="dropdown-divider"></div>
															<!-- <div class="dropdown-divider"></div> -->
															<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-success"></span> Update</a>
															<!-- <div class="dropdown-divider"></div> -->
														<?php }
													}
												}
												if ($total == $total_points) {
													if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') {
														if ($row['application'] == 2) { ?>
															<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/qa_test2&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Test 2</a>
														<?php } elseif ($row['application'] == 4) { ?>
															<!-- <div class="dropdown-divider"></div> -->
															<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/test2&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Test 2</a>
														<?php } elseif ($row['application'] == 3 || $row['application'] == 1) { ?>
															<!-- <div class="dropdown-divider"></div> -->
															<a class="dropdown-item" href="<?php echo base_url . "admin?page=applicants/essay&id=" . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-warning"></span> Essay</a>
														<?php } ?>
													<?php } ?>
												<?php } ?>
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
	</div>
</div>

</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script>
	// $('.export').DataTable({
	// 	"lengthChange": true,
	// 	"paging": true,
	// 	"searching": true,
	// 	"ordering": true,
	// 	"info": true,
	// 	"autoWidth": true,
	// 	"responsive": true,
	// 	"buttons": [{
	// 		extend: 'excel',
	// 		className: 'custom-button',
	// 		text: 'Export'
	// 	}]
	// }).buttons().container().appendTo('#export_wrapper');
	// $('.export').DataTable({
	// 	"lengthChange": true,
	// 	"paging": true,
	// 	"searching": true,
	// 	"ordering": true,
	// 	"info": true,
	// 	"autoWidth": true,
	// 	"responsive": true,
	// 	"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
	// 		'<"row"<"col-sm-12"tr>>' +
	// 		'<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
	// 	"buttons": [{
	// 		extend: 'excel',
	// 		className: 'custom-button',
	// 		text: 'Export'
	// 	}]
	// }).buttons().container().appendTo('#export_wrapper');

	// // Add form-control and form-control-sm classes
	// $('.export_wrapper select').addClass('form-control form-control-sm');
	// $('.export_wrapper input').addClass('form-control form-control-sm');
	// $('.export').DataTable({
	// 	"lengthChange": true,
	// 	"paging": true,
	// 	"searching": true,
	// 	"ordering": true,
	// 	"info": true,
	// 	"autoWidth": true,
	// 	"responsive": true,
	// 	"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
	// 		'<"row"<"col-sm-12"tr>>' +
	// 		'<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
	// 	"buttons": [{
	// 		extend: 'excel',
	// 		className: 'custom-button',
	// 		text: 'Export'
	// 	}],
	// 	"pagingType": "full_numbers",
	// 	"language": {
	// 		"paginate": {
	// 			"previous": "Previous",
	// 			"next": "Next"
	// 		}
	// 	}
	// }).buttons().container().appendTo('#export_wrapper');


	$(document).ready(function() {
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this Applicant permanently?", "delete_client", [$(this).attr('data-id')])
		})

		$('.view_exam').click(function() {
			uni_modal("Client Details", "applicants/qa_test2.php?id=" + $(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})


	function delete_client($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=delete_client",
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