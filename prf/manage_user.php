<?php
$user = $conn->query("SELECT * FROM prf_requestor where id =" . $_settings->userdata('id'));
foreach ($user->fetch_array() as $k => $v) {
	$meta[$k] = $v;
}

?>
<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-success container">
	<div class="card-body">
		<div class="container-fluid overflow-auto">
			<div id="msg"></div>
			<form action="" id="manage-user">
				<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
					<small class="text-danger"><i>Please do not use employee number as username.</i></small>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
					<small><i>Leave this blank if you dont want to change the password.</i></small>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-block btn-success" form="manage-user">Update</button>
			</div>
			<div class="col-md-6">
				<a class="btn btn-block btn-secondary" href="<?php echo base_url . 'prf/' ?>">Back</a>
			</div>
		</div>
	</div>
</div>
<style>
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-user').submit(function(e) {
		e.preventDefault();
		var _this = $(this)
		start_loader()
		$.ajax({
			url: _base_url_ + 'classes/Users.php?f=prf_pass',
			method: 'POST',
			data: $(this).serialize(),
			dataType: 'json',
			error: err => {
				console.log(err)
				el.text('An error occured')
				el.addClass('alert-danger')
				_this.append(el)
				el.show('slow')
				end_loader()
			},
			success: function(resp) {
				if (resp.status == 'success') {
					location.reload();
				} else if (resp.status == 'failed') {
					$('#msg').html('<div class="alert alert-danger">Error Occured</div>')
					end_loader()
				}
			}
		})
	})
</script>