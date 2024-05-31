<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `prf_request` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}
?>

<style>
	#uni_modal .modal-header,
	#uni_modal .modal-footer {
		display: none;
	}
</style>

<form action="" id="disappr-frm">
	<input type="hidden" name='id' value="<?php echo isset($id) ? $id : '' ?>">
	<input type="hidden" name='sign' value="<?php echo $_GET['sign'] ?>">
	<input type="hidden" name='od' value="<?php echo $_GET['od'] ?>">
	<input type="hidden" name='val' value="2">
	<h4 class="text-center">Reason for disapproval</h4>
	<div class="row mb-3 mt-5">
		<div class="col-md-6">
			<div class="form-group ">
				<input class="form-control" required type="radio" id="customRadio5" name="disappr_reason" value="With excess manpower.">
				<label for="customRadio5" class="control-label" style="display: block; text-align: center;">With excess manpower.</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group ">
				<input class="form-control" required type="radio" id="customRadio4" name="disappr_reason" value="No manpower requirement.">
				<label for="customRadio4" class="control-label" style="display: block; text-align: center;">No manpower requirement.</label>
			</div>
		</div>
	</div>
	<div class="text-right">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	</div>
</form>
<script>
	$('#disappr-frm').submit(function(e) {
		e.preventDefault();
		var _this = $(this)
		$('.err-msg').remove();
		var el = $('<div>')
		el.addClass("alert err-msg")
		el.hide()
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=disappr_prf",
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
					alert_toast("Personnel request disapproved", 'success')
					location.reload();
					// location.replace(_base_url_ + 'admin/?page=prf/request')
				} else {
					el.text("An error occured");
					console.error(resp)
				}
				$("html, body").scrollTop(0);
				end_loader()

			}
		})
	})
</script>