<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT e.*,c.*,c.name as `category` from `exam_list` e inner join category_list c on e.category_id = c.id where md5(c.id) = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
        // if (empty($_settings->userdata('recommended_pos'))) {
        //     $total_items = $conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->num_rows;
        //     $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->fetch_array()[0];
        //     // $total_points = $conn->query("SELECT SUM(points) FROM  `question_list` where exam_id = '{$id}'")->fetch_array()[0];
        //     $total_points = $total_points > 0 ? $total_points : 0;
        //     $passing_score = $conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$id}'")->fetch_array()[0];
        //     $passing_score = $passing_score > 0 ? $passing_score : 0;
        // } else {
        //     $total_items = $conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->num_rows;
        //     $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->fetch_array()[0];
        //     $total_points = $total_points > 0 ? $total_points : 0;
        //     $passing_score = $conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$id}'")->fetch_array()[0];
        //     $passing_score = $passing_score > 0 ? $passing_score : 0;
        // }
    }
    //  else {
    //     echo '<script> alert("Unable to access this page."); location.replace("./");</script>';
    //     exit;
    // }
}


// Check if the score is set in the session
// if (isset($_GET['107844'])) {

//     if (empty($_settings->userdata('recommended_pos'))) {
//         $score = $_GET['107844'];
//     } else {
//         $re_exam = $conn->query("UPDATE `applicants` set re_exam = 1 where id = "  . $_settings->userdata('id'));
//         $set = $conn->query("SELECT score FROM  `applicant_score` where applicant_id = " . $_settings->userdata('id'))->fetch_array()[0];
//         $score = $_GET['107844'] + $set;
//     }
//     // echo 'this is your score ' . $score;
// } else {
//     $set = $conn->query("SELECT score FROM  `applicant_score` where applicant_id = " . $_settings->userdata('id'))->fetch_array()[0];
//     $score = $set;
// }

// $score = $_settings->info('score');
// $score = $score > 0 ?  $score : 0;
?>

<section class="content mt-5 py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card card-outline card-navy shadow rounded">
                    <div class="card-header">
                        <h4 class="text-center"><b><?= isset($category) ? $category : 'N/A' ?></b></h4>
                    </div>
                    <div class="card-body">
                        <div class="container" style="position: relative;">
                            <!--<dl>
                                 <dt class="text-muted">Title</dt>
                                <dd class="pl-3"><b><?= isset($title) ? $title : 'N/A' ?></b></dd> -->
                            <!-- <dt class="text-center">Exam For:</dt> -->
                            <h1 class=" text-center">Congratulations on successfully completing your examination! </h1>
                            <!-- <p class="text-center"><b>Congratulations of finishing your exam! <br> Please procceed to the next step</b></p> -->
                            <!-- <dd class="pl-3"><b><?= isset($category) ? $category : 'N/A' ?></b></dd> -->
                            <!-- <dt class="text-muted">Passing Score</dt>
                                <dd class="pl-3"><b><?= isset($passing_score) ? ($passing_score) : 'N/A' ?></b></dd>
                                <dt class="text-muted">Total Items</dt>
                                <dd class="pl-3"><b><?= isset($total_items) ? ($total_items) : 'N/A' ?></b></dd>
                                <dt class="text-muted">Total Points</dt>
                                <dd class="pl-3"><b><?= isset($total_points) ? ($total_points) : 'N/A' ?></b></dd>
                            </dl>
                            <div class="text-muted text-center"><small>Your Score is:</small></div>
                            <h2 class="font-weight-bolder text-center"><?= ($score) ?></h2> -->

                            <?php //if (isset($passing_score)) : 
                            ?>
                            <?php //if ($score >= $passing_score) :
                            // $save1 = $conn->query("UPDATE `applicants` set passed = 1 where id = "  . $_settings->userdata('id'));
                            ?>
                            <!-- <center><span class=" btn-primary btn-large bg-gradient-teal px-4 rounded-pill">PASSED</span></center> -->
                            <?php // else :
                            // $save1 = $conn->query("UPDATE `applicants` set passed = 2 where id = "  . $_settings->userdata('id'));
                            ?>
                            <!-- <center><span class="btn-danger btn-large bg-gradient-danger px-4 rounded-pill">FAILED</span></center> -->
                            <?php //endif; 
                            ?>
                            <?php //endif;

                            // $check = $conn->query("SELECT * FROM  `applicant_score` where applicant_id = " . $_settings->userdata('id'));
                            // $application_id = $conn->query("SELECT application_id FROM `position` where position=" . $_settings->userdata('id'))->fetch_array();
                            // if (isset($application_id[0]) && $application_id[0] != 3) {
                            //     $del_enum_score = $conn->query("DELETE FROM `enumeration_score` where applicant_id = " . $_settings->userdata('id'));
                            // }

                            // if ($check->num_rows == 0) {
                            //     $save = $conn->query("INSERT INTO `applicant_score` SET total_score=$total_points, score = $score, category_id = '{$id}', applicant_id = " . $_settings->userdata('id'));
                            // } else {
                            //     $save = $conn->query("UPDATE `applicant_score` set total_score=$total_points, score = $score, category_id = '{$id}' where applicant_id = " . $_settings->userdata('id'));
                            // }
                            // if ($save) {
                            //     unset($_GET['score']);
                            // }
                            ?>
                            <div class="text-center">
                                <a class="btn btn-light border btn-flat btn-lg " id="close-button" href="javascript:void(0)" onclick="delete_user()"><i class="fa fa-sign-out-alt"></i> EXIT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: left; align-items: left;">
            <img src="./dist/img/grats.gif" alt="Preloader Image" title="Loading..." style="max-height:100%; max-width:100%; position: absolute; bottom: 0; left: 0;">

        </div>
        <div style="display: flex; justify-content: right; align-items: right;">
            <img src="./dist/img/grats1.gif" alt="Preloader Image" title="Loading..." style="max-height:100%; max-width:100%; position: absolute; bottom: 0; right: 0;">

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
    function delete_user() {
        $.ajax({
            url: _base_url_ + "logout.php",
            success: function() {
                alert_toast("Thank you!", 'success');
                setTimeout(() => {
                    location.replace('./')
                }, 2000);
            }
        })
    }
</script>