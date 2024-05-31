<header class="bg-success py-5" id="main-header">
    <div class="container h-100 d-flex align-items-end justify-content-center w-100">
        <div class="text-center text-white w-100">
            <h2 class="display-5 fw-bolder mx-6"><?php echo $_settings->info('name') ?></h2>
            <div class="col-auto mt-2">
                <!-- <a class="btn btn-primary btn-lg rounded-0" href="./?p=exams">Explore Exams</a> -->
            </div>
        </div>
    </div>
</header>

<?php $apply = $conn->query("SELECT `application` FROM `applicants` where  id =" . $_settings->userdata('id'))->fetch_array()[0]; ?>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="card card-outline card-success rounded-0">
            <div class="card-body">
                <h2 class="text-center"><b>Welcome</b></h2>
                <center>
                    <hr class="w-25 bg-success border-success">
                </center>
                <?php include('welcome.html') ?>
            </div>
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    // $(document).scroll(function() {
    //     $('#topNavBar').removeClass('bg-transparent navbar-dark bg-success')
    //     if ($(window).scrollTop() === 0) {
    //         $('#topNavBar').addClass('navbar-dark bg-transparent')
    //     } else {
    //         $('#topNavBar').addClass('navbar-dark bg-success')
    //     }
    // });
    $(function() {
        $(document).trigger('scroll')
    })
</script>