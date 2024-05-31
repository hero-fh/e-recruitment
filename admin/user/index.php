<?php
if (!empty($_settings->userdata('firstname'))) {
	$user = $conn->query("SELECT * FROM users where id ='" . $_settings->userdata('id') . "'");
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
} else {
	$user = $conn->query("SELECT * FROM employee_masterlist where EMPID ='" . $_settings->userdata('EMPID') . "'");
	foreach ($user->fetch_array() as $k => $v) {
		$em[$k] = $v;
	}
}
?>
<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid overflow-auto">
			<div id="msg"></div>
			<?php if (!empty($_settings->userdata('firstname'))) { ?>
				<form action="" id="manage-user">
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
					<div class="form-group">
						<label for="name">First Name</label>
						<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="name">Last Name</label>
						<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
						<small><i>Leave this blank if you dont want to change the password.</i></small>
					</div>
				</form>
			<?php } else { ?>
				<form action="" id="manage-user">
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('EMPID') ?>">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="EMPNAME" id="EMPNAME" class="form-control" value="<?php echo isset($em['EMPNAME']) ? $em['EMPNAME'] : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($em['USERNAME']) ? $em['USERNAME'] : '' ?>" required autocomplete="off">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
						<small><i>Leave this blank if you dont want to change the password.</i></small>
					</div>
				</form>
			<?php } ?>
		</div>
	</div>
	<div class="card-footer">
		<div class="col-md-12">
			<div class="row">
				<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
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
			url: _base_url_ + 'classes/Users.php?f=save',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					location.reload()
				} else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
			}
		})
	})
</script>