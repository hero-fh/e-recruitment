<?php
require_once("./config.php");
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT e.*,c.*,c.name as `category` from `exam_list` e inner join category_list c on e.category_id = c.id where md5(c.id) = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
        if (empty($_settings->userdata('recommended_pos'))) {
            $total_items = $conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->num_rows;
            $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$id}'")->fetch_array()[0];
            // $total_points = $conn->query("SELECT SUM(points) FROM  `question_list` where exam_id = '{$id}'")->fetch_array()[0];
            $total_points = $total_points > 0 ? $total_points : 0;
            $passing_score = $conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$id}'")->fetch_array()[0];
            $passing_score = $passing_score > 0 ? $passing_score : 0;
        } else {
            $total_items = $conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.id = '{$id}' and e.id>=39 and e.id<=41 ")->num_rows;
            $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.id = '{$id}' and e.id>=39 and e.id<=41 ")->fetch_array()[0];
            $total_points = $total_points > 0 ? $total_points : 0;
            $passing_score = $conn->query("SELECT SUM(passing_score) FROM  `exam_list` where status = 1 and category_id= '{$id}' and id>=39 and id<=41 ")->fetch_array()[0];
            $passing_score = $passing_score > 0 ? $passing_score : 0;
        }
    } else {
        echo '<script> alert("Unable to access this page."); location.replace("./");</script>';
        exit;
    }
}
?>
<style>
    #uni_modal .modal-footer {
        display: none;
    }
</style>
<div class="container-fluid">
    <dl>
        <!-- <dt class="text-navy">Title</dt>
        <b><?= isset($title) ? $title : 'N/A' ?></b></dd> -->
        <!-- <dt class="text-navy">For</dt> -->
        <dd class="text-center h3"><b><?= isset($category) ? $category : 'N/A' ?></b></dd><br>
        <!-- <dt class="text-navy">Instructions</dt>
        <?= isset($description) ? $description : 'N/A' ?></dd> -->
        <dt class="text-navy">Passing Score: <b><?= isset($passing_score) ? ($passing_score) : 'N/A' ?></b></dt><br>

        <dt class="text-navy">Total Items: <b><?= isset($total_items) ? ($total_items) : 'N/A' ?></b></dt><br>

        <dt class="text-navy">Total Points: <b><?= isset($total_points) ? ($total_points) : 'N/A' ?></b></dt>

    </dl>
    <div class="clear-fix my-2"></div>
    <div class="text-center">
        <?php if (empty($_settings->userdata('recommended_pos'))) { ?>
            <a class="btn btn-light border btn-flat btn-m" href="./?p=take_exam&id=<?= isset($id) ? md5($id) : "" ?>"><i class="fa fa-external-link-alt"></i> Take Exam</a>
        <?php } else { ?>
            <a class="btn btn-light border btn-flat btn-m" href="./?p=re_exam&id=<?= isset($id) ? md5($id) : "" ?>"><i class="fa fa-external-link-alt"></i> Take Exam</a>
        <?php } ?>
        <button class="btn btn-dark btn-flat btn-m" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>