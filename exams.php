<header class="bg-primary py-5" id="main-header">
    <div class="container h-100 d-flex align-items-end justify-content-center w-100">
        <div class="text-center text-white w-100">
            <h2 class="display-5 fw-bolder mx-6"><?php echo $_settings->info('name') ?></h2>
            <div class="col-auto mt-2">
            </div>
        </div>
    </div>
</header>

<section class="content py-5 mt-5">
    <div class="row justify-content-center " id="exam-list">

        <?php
        if (empty($_settings->userdata('recommended_pos'))) {
            // showing operator category
            $exams1 = $conn->query("SELECT * FROM `applicants` where application = 1 and id =" . $_settings->userdata('id'));
            while ($rows = $exams1->fetch_assoc()) :
                $exams = $conn->query("SELECT * FROM `category_list` where status=1 and id != 26");
                while ($row = $exams->fetch_assoc()) :
        ?>
                    <?php
                    if ($row['name'] == 'OPERATOR') :
                    ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- small card -->
                            <div class="small-box bg-primary custom-height">
                                <div class="inner" style="padding: 20px;">
                                    <h3> </h3>

                                    <p> </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <a class="small-box-footer exam-item text-reset text-decoration-none hover" style="padding: 60px 0px;" hraf="javascript:void(0)" data-id="<?= md5($row['id']) ?>">

                                    <h4 class="w-100 truncate-1 text-center" title='<?= $row['name'] ?>'><b><?= $row['name'] ?></b> <i class="fas fa-arrow-circle-right"></i></h4>
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- small card -->
                            <div class="small-box bg-secondary custom-height">
                                <div class="inner" style="padding: 20px;">
                                    <h3> </h3>

                                    <p> </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-times"></i>
                                </div>
                                <a class="small-box-footer exam-item-1 text-reset text-decoration-none hover1" style="padding: 60px 0px;" hraf="javascript:void(0)" data-id="<?= md5($row['id']) ?>">

                                    <h4 class="w-100 truncate-1 text-center" title='<?= $row['name'] ?>'><b><?= $row['name'] ?></b> <i class="fas fa-arrow-circle-right"></i></h4>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php
                endwhile;
            endwhile;
            ?>
            <?php
            // showing QA engineer category
            $exams1 = $conn->query("SELECT * FROM `applicants` where application > 1 and id =" . $_settings->userdata('id'));
            while ($rows = $exams1->fetch_assoc()) :
                $exams = $conn->query("SELECT * FROM `category_list` where status=1 and id != 26");
                while ($row = $exams->fetch_assoc()) :
            ?>
                    <?php
                    if ($row['name'] == 'NON - OPERATOR') :
                    ?>

                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <div class="small-box bg-primary custom-height">
                                <div class="inner" style="padding: 20px;">
                                    <h3> </h3>

                                    <p> </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <a class="small-box-footer exam-item text-reset text-decoration-none hover" style="padding: 60px 0px;" hraf="javascript:void(0)" data-id="<?= md5($row['id']) ?>">

                                    <h4 class="w-100 truncate-1 text-center " title='<?= $row['name'] ?>'><b><?= $row['name'] ?></b> <i class="fas fa-arrow-circle-right"></i></h4>
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="small-box bg-secondary custom-height">
                                <div class="inner" style="padding: 20px;">
                                    <h3> </h3>

                                    <p> </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-times"></i>
                                </div>
                                <a class="small-box-footer exam-item-1 text-reset text-decoration-none hover1" style="padding: 60px 0px;" hraf="javascript:void(0)" data-id="<?= md5($row['id']) ?>">

                                    <h4 class="w-100 truncate-1 text-center" title='<?= $row['name'] ?>'><b><?= $row['name'] ?></b> <i class="fas fa-arrow-circle-right"></i></h4>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php
                endwhile;
            endwhile;
            ?>
            <?php
        } else {
            // showing QA engineer category
            $exams1 = $conn->query("SELECT * FROM `applicants` where (recommended_pos != '' or recommended_pos != null) and id =" . $_settings->userdata('id'));
            while ($rows = $exams1->fetch_assoc()) :
                $exams = $conn->query("SELECT * FROM `category_list` where status = 1 and id = 26");
                while ($row = $exams->fetch_assoc()) :
            ?>
                    <?php
                    if ($row['id'] == 26) :
                    ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <div class="small-box bg-primary custom-height">
                                <div class="inner" style="padding: 20px;">
                                    <h3> </h3>

                                    <p> </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <a class="small-box-footer exam-item text-reset text-decoration-none hover" style="padding: 60px 0px;" hraf="javascript:void(0)" data-id="1f0e3dad99908345f7439f8ffabdffc4">

                                    <h4 class="w-100 truncate-1 text-center " title='<?= $row['name'] ?>'><b><?= $row['name'] ?></b> <i class="fas fa-arrow-circle-right"></i></h4>
                                </a>
                            </div>
                        </div>

                    <?php endif; ?>
        <?php
                endwhile;
            endwhile;
        }
        ?>

    </div>
    <div id="noData" class="d-none text-center">No result</div>
    </div>
</section>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    $(function() {
        $('#search').on('input', function() {
            var keyword = $(this).val().toLocaleString()
            $('#exam-list .exam-item').each(function() {

                if (($(this).text().toLowerCase()).includes(keyword) == true) {
                    $(this).toggle(true)
                } else {
                    $(this).toggle(false)
                }
            })
            if ($('#exam-list .exam-item:visible').length <= 0) {
                $('#noData').removeClass('d-none')
            } else {
                $('#noData').addClass('d-none')
            }
        })
        $('#exam-list .exam-item').click(function() {
            uni_modal("Exam Details", "view_exam.php?id=" + $(this).attr('data-id'), "")
            console.log($(this).attr('data-id'))
        })
    })
    $(function() {
        $(document).trigger('scroll')
    })
</script>