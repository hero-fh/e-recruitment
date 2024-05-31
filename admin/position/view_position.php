<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `position` where id = '{$_GET['id']}'  ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
?>
		<center>Unknown position</center>
		<style>
			#uni_modal {
				display: none
			}
		</style>
		<div class="text-right">
			<button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
		</div>
<?php
	}
}
?>
<style>
	#uni_modal .modal-footer {
		display: none
	}
</style>

<div class="container-fluid">
	<dl>
		<dt class="text-muted">Job title</dt>
		<dd class="pl-3"><?= isset($position) ? $position : "" ?></dd>
		<dt class="text-muted">Department</dt>
		<dd class="pl-3"><?= isset($department) ? $department : "" ?></dd>
		<dt class="text-muted">Job description</dt>
		<dd class="pl-3"><?= isset($job_desc) ? $job_desc : "" ?></dd>
		<dt class="text-muted">Job qualification</dt>
		<dd class="pl-3"><?= isset($job_quali) ? $job_quali : "" ?></dd>
		<dt class="text-muted">Exam type</dt>

		<dd class="pl-3">



			<?= isset($application_id) ? $application_id : "" ?>


		</dd>
		<dt class="text-muted">Status</dt>
		<dd class="pl-3">
			<?php if ($status == 1) : ?>
				<span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
			<?php else : ?>
				<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
			<?php endif; ?>
		</dd>
	</dl>
	<div class="text-right">
		<button class="btn btn-dark btn-flat px-3 rounded-pill" data-dismiss="modal">Close</button>
	</div>
</div>
<script>
	$(document).ready(function() {
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