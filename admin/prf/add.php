<?php
require_once('./../../config.php');
$hired = $conn->query("SELECT COUNT(id) FROM `prf_applicants` where prf_no = '{$_GET['prf']}' and training_status !=3 GROUP BY id")->num_rows;
$reqs = $_GET['req'];
$req = $reqs - $hired;
// echo $reqs;
$total = json_encode($req);

?>
<style>
	h6 {
		width: 100%;
		text-align: center;
		border-bottom: 1px solid #000;
		line-height: 0.1em;
		margin: 10px 0 20px;
	}

	h6 span {
		background: #fff;
		padding: 0 10px;
	}

	#uni_modal .modal-footer,
	.modal-footer {
		display: none;
	}
</style>
<!-- <h3 class="float-right">
	<div class="close" style="cursor: pointer;" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</div>

</h3> -->
<form action="" id="event-frm">

	<!-- <div id="msg" class="form-group"></div> -->
	<input type="hidden" name='id' value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
	<input type="hidden" name='prf_no' value="<?php echo isset($_GET['prf']) ? $_GET['prf'] : '' ?>">
	<input type="hidden" name='req_no' value="<?php echo isset($_GET['req']) ? $_GET['req'] : '' ?>">
	<p class="d-none" id="result"></p>
	<p class="d-none" id="xresult"></p>
	<div id="msg" class="text-danger"></div>
	<div class="form-group">
		<label for="applicant_name" class="control-label">Name of Successful Applicant : </label>
		<select name="applicant_name[]" id="applicant_name" class="form-control form-control-sm select2" required>
			<option value="" disabled selected>--Select Applicant--</option>
			<?php
			$application = $conn->query("SELECT asm.name,asm.id FROM assessment asm INNER JOIN applicants ap ON ap.id = asm.id WHERE asm.prf_no = '{$_GET['prf']}' AND (ap.job_offer = 1 OR ap.application = 1) AND ap.status = 1 AND ap.pdf = 1 AND asm.id NOT IN (SELECT applicant_name FROM prf_applicants WHERE prf_no = '{$_GET['prf']}')");
			// $application = $conn->query("SELECT asm.name,asm.id FROM assessment asm INNER JOIN applicants ap ON ap.id = asm.id WHERE asm.prf_no = '{$_GET['prf']}' AND (ap.job_offer = 1 OR ap.application = 1) AND ap.status = 1 AND ap.pdf = 1 AND asm.name NOT IN (SELECT applicant_name FROM prf_applicants WHERE prf_no = '{$_GET['prf']}')");

			// $count = $conn->query("SELECT COUNT(id) FROM `prf_applicants` WHERE prf_no = '{$_GET['prf']}' group by prf_no")->num_rows;
			// // echo $count;
			// if ($count > 0) {
			// 	$application = $conn->query("SELECT asm.name FROM assessment asm inner join applicants ap on ap.id=asm.id inner join prf_applicants prapp on asm.prf_no = prapp.prf_no where asm.prf_no = '{$_GET['prf']}' and (ap.job_offer=1 || ap.application=1) and ap.status=1 and ap.pdf=1 and  asm.name != prapp.applicant_name");
			// } else if ($count == 0) {
			// 	$application = $conn->query("SELECT asm.name FROM assessment asm inner join applicants ap on ap.id=asm.id  where asm.prf_no = '{$_GET['prf']}' and (ap.job_offer=1 || ap.application=1) and ap.status=1 and ap.pdf=1 ");
			// }
			while ($row = $application->fetch_assoc()) :
			?>
				<!-- <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option> -->
				<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
			<?php endwhile; ?>
		</select>
		<!-- <input type="text" class="form-control form-control-sm" name="applicant_name[]" id="applicant_name" value="<?php echo isset($applicant_name) ? $applicant_name : '' ?>" required> -->
	</div>
	<fieldset>
		<div id="option-list">
		</div>
		<div class="my-2 text-center">
			<button class="btn btn-primary btn-block-sm" id="add_option" type="button"><i class="fa fa-plus"></i> Add Applicant</button>
		</div>
	</fieldset>
	<noscript id="option-clone">
		<div class="item">
			<div class="list-group" id="option-list">
				<!-- <div class="row justify-content-end align-items-end form-group">

				</div> -->
				<label for="applicant_name" class="control-label">Name of Successful Applicant :<b style="color:#FF0000" ;>*</b></label>
				<div class="input-group mb-3">
					<!-- <input autocomplete="off" type="text" class="form-control" id="applicant_name" required name="applicant_name[]"> -->
					<select name="applicant_name[]" id="applicant_name" class="form-control select2" required>
						<option value="" disabled selected>--Select Applicant--</option>
						<?php
						$application = $conn->query("SELECT asm.name,asm.id FROM assessment asm INNER JOIN applicants ap ON ap.id = asm.id WHERE asm.prf_no = '{$_GET['prf']}' AND (ap.job_offer = 1 OR ap.application = 1) AND ap.status = 1 AND ap.pdf = 1 AND asm.id NOT IN (SELECT applicant_name FROM prf_applicants WHERE prf_no = '{$_GET['prf']}')");

						// $count = $conn->query("SELECT COUNT(id) FROM `prf_applicants` WHERE prf_no = '{$_GET['prf']}' group by prf_no")->num_rows;
						// // echo $count;
						// if ($count > 0) {
						// 	$application = $conn->query("SELECT asm.name FROM assessment asm inner join applicants ap on ap.id=asm.id inner join prf_applicants prapp on asm.prf_no = prapp.prf_no where asm.prf_no = '{$_GET['prf']}' and (ap.job_offer=1 || ap.application=1) and ap.status=1 and ap.pdf=1 and  asm.name != prapp.applicant_name");
						// } else if ($count == 0) {
						// 	$application = $conn->query("SELECT asm.name FROM assessment asm inner join applicants ap on ap.id=asm.id  where asm.prf_no = '{$_GET['prf']}' and (ap.job_offer=1 || ap.application=1) and ap.status=1 and ap.pdf=1 ");
						// }
						while ($row = $application->fetch_assoc()) :
						?>
							<!-- <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option> -->
							<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
						<?php endwhile; ?>
					</select>
					<div class="input-group-prepend">
						<a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option text-decoration-none text-reset btn btn-danger btn-block-sm" id="xbtn" title="Remove Option1"><i class="fa fa-times"></i></a>
					</div>
				</div>
			</div>
		</div>
	</noscript>
	<div class="form-group">
		<label for="date_commencement" class="control-label">Date of Commencement : </label>
		<input type="date" class="form-control form-control-sm" name="date_commencement" id="date_commencement" value="<?php echo isset($date_commencement) ? date("Y-m-d\\TH:i", strtotime($date_commencement)) : '' ?>" required>
	</div>
	<div class="text-right">
		<button class="btn btn-primary " type="submit">Submit</button>
		<button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	</div>
</form>
<script>
	$(function() {
		$('.select2').select2({
			width: 'resolve'
		})
	})
	var dis = <?php echo $req ?>;
	if (dis <= 1) {
		$('#add_option').attr('disabled', true)
	}
	if (dis <= 0) {
		$('input').prop('disabled', true);
	}
	// $('.close').click(function() {
	// 	location.reload()
	// })
	var btncount = 0;
	var buttona = document.getElementById("add_option");
	var resultb = document.getElementById("result");


	$('.remove-option').click(function() {
		$(this).closest('.item').remove()
	})
	// Add Option button click event
	$('#add_option').click(function() {
		btncount++;
		resultb.innerHTML = btncount;
		console.log(btncount)
		// console.log(dis)
		if (btncount == (dis - 1)) {
			$('#add_option').attr('disabled', true)
		} else {
			$('#add_option').removeAttr('disabled')
		}
		// Clone the template option and convert it into a jQuery object
		var item = $($('#option-clone').html()).clone();

		// Append the modified item to the option list
		$('#option-list').append(item);

		// Attach event handlers to the cloned item

		item.find('.remove-option').click(function() {
			$(this).closest('.item').remove();
			btncount--;
			console.log(btncount)
			if (btncount == (dis - 1)) {
				$('#add_option').attr('disabled', true)
			} else {
				$('#add_option').removeAttr('disabled')
			}
		});
		item.find('.select2').select2({
			width: 'resolve'
		})
	});
	$(document).ready(function() {
		$('#event-frm').submit(function(e) {
			e.preventDefault()
			start_loader()
			if ($('.err_msg').length > 0)
				$('.err_msg').remove()
			$.ajax({
				url: _base_url_ + 'classes/Master.php?f=request_personnel',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err)
					alert_toast(err, "error")
					end_loader()
				},
				success: function(resp) {
					if (resp.status == 'success') {
						location.reload();
						// location.replace(_base_url_ + "admin/?page=prf/all")
					} else if (resp.status == 'duplicate') {
						var _frm = $('#event-frm #msg')
						var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Applicant name already exists.</div>"
						_frm.prepend(_msg)
						_frm.find('input#applicant_name').addClass('is-invalid')
						$('[name="applicant_name"]').focus()
					} else if (resp.status == 'empty') {
						var _frm = $('#event-frm #msg')
						var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Complete the form.</div>"
						_frm.prepend(_msg)
						_frm.find('input#applicant_name').addClass('is-invalid')
						_frm.find('input#date_commencement').addClass('is-invalid')
					} else {
						alert_toast("An error occured.", 'error');
					}
					end_loader()
				}
			})
		})
	})
</script>