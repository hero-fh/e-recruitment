<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT e.*,c.name as `category` from `exam_list` e inner join category_list c on e.category_id = c.id where e.id = '{$_GET['id']}'  ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
        $total_items = $conn->query("SELECT * FROM  `question_list` where exam_id = '{$id}'")->num_rows;
        $total_points = $conn->query("SELECT SUM(points) FROM  `question_list` where exam_id = '{$id}'")->fetch_array()[0];
        $total_points = $total_points > 0 ? $total_points : 0;
    } else {
?>
        <center>Unknown Exam ID</center>
        <style>
            #uni_modal {
                display: none
            }
        </style>
        <div class="text-right">
            <button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
        </div>
<?php
        exit;
    }
}
?>
<style>
    .question_text p {
        margin: unset !important;
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h5 class="card-title">Exam Detais - <?= isset($code) ? $code : "" ?></h5>
            <div class="card-tools">
                <button class="btn btn-flat btn-sm btn-primary" id="edit_data"><i class="fa fa-edit"></i> Edit</button>
                <?php if ($_settings->userdata('type') == 10000) : ?>
                    <button class="btn btn-flat btn-sm btn-danger" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
                <?php endif; ?>
                <a class="btn btn-flat btn-sm btn-light border" href="./?page=exams"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="containder-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="callout callout-info rounded-0 shadow">
                            <dl>
                                <dt class="text-muted">Title</dt>
                                <dd class="pl-3"><b><?= isset($title) ? $title : 'N/A' ?></b></dd>
                                <dt class="text-muted">Category</dt>
                                <dd class="pl-3"><b><?= isset($category) ? $category : 'N/A' ?></b></dd>
                                <dt class="text-muted">Instructions</dt>
                                <dd class="pl-3"><small><?= isset($description) ? html_entity_decode($description) : 'N/A' ?></small></dd>
                                <dt class="text-muted">Passing Score</dt>
                                <dd class="pl-3"><b><?= isset($passing_score) ? ($passing_score) : 'N/A' ?></b></dd>
                                <dt class="text-muted">Total Items</dt>
                                <dd class="pl-3"><b><?= isset($total_items) ? ($total_items) : 'N/A' ?></b></dd>
                                <dt class="text-muted">Total Points</dt>
                                <dd class="pl-3"><b><?= isset($total_points) ? ($total_points) : 'N/A' ?></b></dd>
                                <dt class="text-muted">Status</dt>
                                <dd class="pl-3">
                                    <?php if ($status == 1) : ?>
                                        <span class="badge badge-success bg-gradient-success rounded-pill px-3">Active</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger bg-gradient-danger rounded-pill px-3">Inactive</span>
                                    <?php endif; ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="d-flex mb-2 align-items-end">
                            <div class="col-auto flex-shrink-1 flex-grow-1">
                                <h4>Question(s)</h4>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-flat btn-sm btn-default bg-navy" id="new_question"><i class="fa fa-plus"></i> Add Question</button>
                            </div>
                        </div>
                        <hr>
                        <div class="list-group" id="question-list">
                            <?php
                            if (isset($id)) :
                                $qi = 1;
                                $question = $conn->query("SELECT * FROM `question_list` where exam_id = '{$id}'");
                                while ($row = $question->fetch_assoc()) :
                            ?>
                                    <div class="list-group-item question-item <?= $qi != 1 ? "" : '' ?>">
                                        <div class="d-flex align-items-top">
                                            <div class="col-auto">
                                                <?= $qi++; ?>.
                                            </div>
                                            <div class="col-auto flex-shrink-1 flex-grow-1">
                                                <div class="question_text"><?= html_entity_decode($row['question']) ?><b>[<?= ($row['points']) . ($row['points'] > 1 ? "pts." : "pt.") ?>]</b></div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="dropleft">
                                                    <a class="text-reset text-decoration-one" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item edit_question" href="javascript:void(0)" data-id="<?= isset($row['id']) ? $row['id']  : '' ?>">Edit</a>
                                                        <?php if ($_settings->userdata('type') == 1) : ?>
                                                            <a class="dropdown-item delete_question" href="javascript:void(0)" data-id="<?= isset($row['id']) ? $row['id']  : '' ?>">Delete</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $options = $conn->query("SELECT * FROM `option_list` where question_id = '{$row['id']}'");
                                            while ($orow = $options->fetch_assoc()) :
                                            ?>
                                                <div class="col-sm-2">
                                                    <span class="mx-2 text-center"><i class="nav-icon fa fa-<?= $orow['is_right'] == 1 ? "check text-success" : 'times text-danger' ?>"></i></span><span><?= html_entity_decode($orow['option']) ?></span>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#edit_data').click(function() {
            uni_modal('Update Exam Details - <b><?= isset($code) ? $code : "" ?></b>', "exams/manage_exam.php?id=<?= isset($id) ? $id : '' ?>", 'mid-large')
        })
        $('#delete_data').click(function() {
            _conf("Are you sure to delete <b><?= isset($code) ? $code : "" ?></b> Exam permanently?", "delete_exam", ['<?= isset($id) ? $id : '' ?>'])
        })
        $('#new_question').click(function() {
            uni_modal('New Question', "exams/manage_question.php?eid=<?= isset($id) ? $id : '' ?>", 'large')
        })
        $('.edit_question').click(function() {
            uni_modal('Edit Question', "exams/manage_question.php?eid=<?= isset($id) ? $id : '' ?>&id=" + $(this).attr('data-id'), 'large')
        })
        $('.delete_question').click(function() {
            _conf("Are you sure to delete this question permanently?", "delete_question", [$(this).attr('data-id')])
        })
    })

    function delete_exam($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_exam",
            method: "POST",
            data: {
                id: $id
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = './?page=exams';
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_question($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_question",
            method: "POST",
            data: {
                id: $id
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>