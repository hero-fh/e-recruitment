<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `position` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
?><div class="text-right">
			<button class="btn btn-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i></button>
		</div>
		<center>Unknown position</center>
		<style>
			#uni_modal #modal-footer {
				display: none
			}
		</style>

<?php
		exit;
	}
}
?>
<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>
<div class="container-fluid">
	<form action="" id="category-form">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="position" class="control-label">Job title</label>
			<input name="position" id="position" type="text" class="form-control form-control-sm" value="<?php echo isset($position) ? $position : ''; ?>" required>
			<!-- <select name="position" id="position" class="form-control form-control-sm rounded-0 select2" required>
				<option value="" disabled <?= !isset($position) ? "selected" : "" ?>></option>
				<?php
				$category = $conn->query("SELECT DISTINCT JOB_TITLE FROM `employee_masterlist` where JOB_TITLE!=''");
				while ($row = $category->fetch_assoc()) :
				?>
					<option value="<?= $row['JOB_TITLE'] ?>" <?php echo isset($position) && $position == $row['JOB_TITLE'] ? 'selected' : '' ?>><?= $row['JOB_TITLE'] ?></option>
				<?php endwhile; ?>
			</select> -->
		</div>
		<div class="form-group">
			<label for="job_desc" class="control-label">Job description</label>
			<textarea name="job_desc" id="job_desc" type="text" class="form-control form-control-sm" required><?php echo isset($job_desc) ? $job_desc : '' ?></textarea>

		</div>
		<div class="form-group">
			<label for="job_quali" class="control-label">Job qualification</label>
			<textarea name="job_quali" id="job_quali" type="text" class="form-control form-control-sm" required><?php echo isset($job_quali) ? $job_quali : '' ?></textarea>

		</div>
		<div class="form-group">
			<label for="department" class="control-label">Department</label>
			<select name="department" id="department" class="form-control form-control-sm rounded-0 select2" required>
				<option value="" disabled <?= !isset($department) ? "selected" : "" ?>></option>
				<?php
				$category = $conn->query("SELECT DISTINCT DEPARTMENT FROM `employee_masterlist`");
				while ($row = $category->fetch_assoc()) :
				?>
					<option value="<?= $row['DEPARTMENT'] ?>" <?php echo isset($department) && $department == $row['DEPARTMENT'] ? 'selected' : '' ?>><?= $row['DEPARTMENT'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="application_id" class="control-label">Exam Type</label>
			<select name="application_id" id="application_id" required class="custom-select selevt">
				<option value="1" <?php echo isset($application_id) && $application_id == 1 ? 'selected' : '' ?>>Operator</option>
				<option value="3" <?php echo isset($application_id) && $application_id == 3 ? 'selected' : '' ?>>Staff/Other Position</option>
				<option value="2" <?php echo isset($application_id) && $application_id == 2 ? 'selected' : '' ?>>QA Engineer</option>
				<option value="4" <?php echo isset($application_id) && $application_id == 4 ? 'selected' : '' ?>>Technician / Engineer</option>
			</select>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" required class="custom-select selevt">
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
		<div class="text-right">
			<button class="btn btn-flat btn-sn btn-primary" type="submit" form="category-form">Save</button>
			<button class="btn btn-flat btn-sn btn-dark" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			width: 'resolve'
		})
		$('#uni_modal #category-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			var el = $('<div>')
			el.addClass("alert err-msg")
			el.hide()
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_position",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.error(err)
					el.addClass('alert-danger').text("An error occured");
					_this.prepend(el)
					el.show('.modal')
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.reload();
					} else if (resp.status == 'failed' && !!resp.msg) {
						el.addClass('alert-danger').text(resp.msg);
						_this.prepend(el)
						el.show('.modal')
					} else {
						el.text("An error occured");
						console.error(resp)
					}
					$("html, body").scrollTop(0);
					end_loader()

				}
			})
		})

		$('.summernote').summernote({
			height: 200,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				['table', ['table']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		})
	})
</script>