<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `exam_list` where id = '{$_GET['id']}'  ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
?>
		<center>Unknown Exam ID</center>
		<style>
			#uni_modal {
				display: none
			}
		</style>
		<div class="text-right">
			<button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
		</div>
<?php
		exit;
	}
}
?>

<div class="container-fluid">
	<form action="" id="exam-form">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="title" class="control-label">Title</label>
			<input name="title" id="title" type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($title) ? $title : ''; ?>" required>
		</div>
		<div class="form-group">
			<label for="category_id" class="control-label">Category</label>
			<select name="category_id" id="category_id" class="form-control form-control-sm rounded-0 select2" required>
				<option value="" disabled <?= !isset($category_id) ? "selected" : "" ?>></option>
				<?php
				$category = $conn->query("SELECT * FROM `category_list` where  `status` = 1 " . (isset($category_id) ? " or id = '{$category_id}'" : "") . " order by `name` asc");
				while ($row = $category->fetch_assoc()) :
				?>
					<option value="<?= $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Instructions</label>
			<textarea name="description" id="description" rows="3" class="form-control form-control-sm rounded-0 no-resize" required><?php echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="passing_score" class="control-label">Passing Score</label>
			<input name="passing_score" id="passing_score" type="number" min="0" class="form-control form-control-sm rounded-0 " value="<?php echo isset($passing_score) ? $passing_score : 0; ?>" required>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="custom-select selevt" required>
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>

	</form>
</div>
<script>
	$(document).ready(function() {
		$('#uni_modal').on('shown.modal.bs', function() {
			$('.select2').select2({
				placeholder: 'Please Select Here',
				width: '100%',
				dropdownParent: $('#uni_modal')
			})
		})
		$('#uni_modal #exam-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			var el = $('<div>')
			el.addClass("alert err-msg")
			el.hide()
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_exam",
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
						location.href = "./?page=exams/view_exam&id=" + resp.eid;
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