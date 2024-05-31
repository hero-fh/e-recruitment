<?php
require_once('../config.php');

// if (isset($_GET['id']) && $_GET['id'] > 0) {
// $qry = $conn->query("SELECT * from `exit_employee` where employee_id =  " . $_settings->userdata('employee_id'));
// if ($qry->num_rows > 0) {
// 	foreach ($qry->fetch_assoc() as $k => $v) {
// 		$$k = $v;
// 	}
// 	// echo $_settings->userdata('employee_id');
// }
// }
?>
<!-- <center>Requirement Deleted.</center>
<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>
<div class="text-right">
	<button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
</div> -->


<style>
	#uni_modal .modal-header,
	#uni_modal .modal-footer {
		display: none;
	}

	#sig-canvas {
		border: 2px dotted #CCCCCC;
		border-radius: 15px;
		cursor: crosshair;
	}
</style>
<h1 class="float-right">
	<button type="button" class="close" id="cros" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</h1>

<div class="card-body">
	<h4 class="login-box-msg">VIEW AS</h4>
	<form id="approver-frm" action="">
		<div class="row">
			<div class="col-6">
				<a class="btn btn-lg btn-block btn-primary rounded-pill px-3" href="<?php echo base_url . "prf/?p=view_prf&id=" . md5($_GET['id']) ?>"><span class="fa fa-eye"></span> Requestor</a>

			</div>
			<div class="col-6">
				<a class="btn btn-lg btn-block btn-success rounded-pill px-3" href="<?php echo base_url . "prf/?p=sign_prf&id=" . md5($_GET['id']) ?>"><span class="fa fa-eye"></span> Approver</a>
			</div>
		</div>

	</form>
</div>

</form>




<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
	$('.cp').click(function() {
		uni_modal('', _base_url_ + "prf/?p=sign_prf&id=" + $(this).attr('data-id'));
	})
	$('#approver-frm').submit(function(e) {
		e.preventDefault()
		var _this = $(this)
		if ($('.err_msg').length > 0)
			$('.err_msg').remove()
		var el = $('<div class="alert err_msg">')
		el.hide()
		timerActive = false;
		start_loader()
		$.ajax({
			url: _base_url_ + 'classes/Users.php?f=prf_sign',
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
				} else if (!!resp.msg) {
					el.text(resp.msg)
					el.addClass('alert-danger')
					_this.append(el)
					el.show('slow')
					_this.find('input').addClass('is-invalid')
					$('[name="username"]').focus()
				} else if (resp.status == 'wrong') {
					el.text('You can\'t sign different department.')
					el.addClass('alert-danger')
					_this.append(el)
					el.show('slow')
					_this.find('input').addClass('is-invalid')
					$('[name="username"]').focus()
				} else if (resp.status == 'userpass') {
					el.text('Invalid credentials. Check your username and password.')
					el.addClass('alert-danger')
					_this.append(el)
					el.show('slow')
					_this.find('input').addClass('is-invalid')
					$('[name="username"]').focus()
				} else if (resp.status == 'good') {
					location.reload();
					// var submitButton = document.getElementById('cros');
					// submitButton.click();

				} else {
					el.text('Incorrect username or password')
					el.addClass('alert-danger')
					_this.append(el)
					el.show('slow')
					_this.find('input').addClass('is-invalid')
					$('[name="username"]').focus()
				}
				end_loader()
			}
		})
	})
</script>