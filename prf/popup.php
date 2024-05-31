<?php
require_once('../config.php');

?>


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
	<h3 class="login-box-msg">PERSONNEL REQUISITION FORM SUCCESSFULLY PASSED</h3>



	<div class="row justify-content-center">
		<div class="col-6 ">
			<button class="btn btn-primary btn-block home">Home</button>
		</div>
		<div class="col-6 ">
			<button class="btn btn-secondary btn-block" id="cros" data-dismiss="modal" aria-label="Close">Close</button>

		</div>
	</div>


</div>





<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
	$('.home').click(function() {
		location.replace(_base_url_ + "prf");
	})
	$('#cros').click(function() {
		location.reload()
	})
</script>