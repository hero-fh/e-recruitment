<?php require_once('./config.php') ?>

<style>
    #uni_modal .modal-header,
    .modal-footer.modal-header {
        display: none;
    }
</style>
<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<h1 class="float-right">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h1>
<div class=" text-center">
    <a href="./" class="h1"><b>Login</b></a>
</div>
<div class="card-body">
    <p class="login-box-msg">Input your Email</p>

    <form id="clogin-frm" action="">
        <div class="input-group mb-3">
            <input type="email" class="form-control" autofocus name="email" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
    $('#clogin-frm').submit(function(e) {
        e.preventDefault()
        var _this = $(this)
        if ($('.err_msg').length > 0)
            $('.err_msg').remove()
        var el = $('<div class="alert err_msg">')
        el.hide()
        timerActive = false;
        start_loader()
        $.ajax({
            url: _base_url_ + 'classes/Login.php?f=clogin',
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
                    location.replace(_base_url_ + '?p=exams');
                } else if (!!resp.msg) {
                    el.text(resp.msg)
                    el.addClass('alert-danger')
                    _this.append(el)
                    el.show('slow')
                    _this.find('input').addClass('is-invalid')
                    $('[name="username"]').focus()
                } else {
                    el.text('An error occured')
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