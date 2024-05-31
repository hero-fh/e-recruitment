<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `applicants` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
?>
		<center>Unknown Category</center>
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
<style>
	.select2-container--default .select2-selection--single {
		border-radius: 0;
	}
</style>
<div class="card-header">
	<h5 class="card-title"><?php echo isset($id) ? "Update Applicant's Information" : 'Add New Applicant' ?></h5>
</div>
<form action="" id="client-form">
	<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
	<div class="col-md-12">
		<fieldset class="border-bottom border-info">
			<legend class="">Applicant Requirements</legend>
			<div class="form-group col-sm-4">
				<!-- <label for="surname" class="control-label ">Last Name</label> -->
				<input type="hidden" class="form-control form-control-sm rounded-0" id="surname" name="surname" value="<?php echo isset($surname) ? $surname : '' ?>">
			</div>
			<div class="form-group col-sm-4">
				<label for="" class="control-label">Requirements</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" accept=".pdf" onchange="displayImg(this,$(this))">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			</div>
		</fieldset>
		<div class="form-group col-sm-4">
			<label for="" class="control-label">Status</label>
			<select name="status" id="" class="select custom-select">
				<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Pending</option>
				<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Confimed</option>
			</select>
		</div>
	</div>
</form>
<div class="card-footer text-center">
	<button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Save</button>
	<a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Cancel</a>
</div>
<script>
	// responsible for displaying the chosen file to upload
	function displayImg(input, _this) {
		console.log(input.files)
		var fnames = []
		Object.keys(input.files).map(k => {
			fnames.push(input.files[k].name)
		})
		_this.siblings('.custom-file-label').html(JSON.stringify(fnames))

	}
	//condition for accepting specific type of files
	$("#file").change(function() {
		var file = this.files[0];
		var fileType = file.type;
		var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
		if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
			alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
			$("#file").val('');
			return false;
		}
	});
	$(function() {
		$('.select2').select2({
			width: 'resolve'
		})
		// client form fucntion
		$('#client-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Users.php?f=save_client",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err)
					alert_toast("An error occured", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						alert_toast("Application Successful", 'success')
						setTimeout(function() {
							location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
						}, 1000)

					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						end_loader()
					} else {
						alert_toast("An error occured", 'error');
						end_loader();
						console.log(resp)
					}
				}
			})
		})
	})

	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
				_this.siblings('label').text(input.files[0].name)
			}
			reader.readAsDataURL(input.files[0]);
		} else {
			$('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
			_this.siblings('label').text('Choose file')
		}
	}
</script>