<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT e.*,c.*,c.name as `category` from `exam_list` e inner join category_list c on e.category_id = c.id where md5(c.id) = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
        $total_items = $conn->query("SELECT q.*,e.*,c.* FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.id = '{$id}'")->num_rows;
        $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.id = '{$id}'")->fetch_array()[0];
        // $total_points = $conn->query("SELECT SUM(points) FROM  `question_list` where exam_id = '{$id}'")->fetch_array()[0];
        $total_points = $total_points > 0 ? $total_points : 0;
    } else {
        echo '<script> alert("Unable to access this page."); location.replace("./");</script>';
        exit;
    }
}

?>
<?php $apply = $conn->query("SELECT `application` FROM `applicants` where  id =" . $_settings->userdata('id'))->fetch_array()[0]; ?>
<link rel="stylesheet" href="<?php echo base_url ?>dist/css/countdown_styles.css">
<link rel="stylesheet" href="<?php echo base_url ?>build/scss/calendar.scss">

<link rel="stylesheet" href="<?php echo base_url ?>dist/css/assessment.css">
<!-- <script src="dist/js/countdown_script.js"></script> -->
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

    .indented {
        margin-left: 30px;
        /* Adjust the indentation size as needed */
    }

    .notes {
        background-attachment: local;
        background-image:
            linear-gradient(to right, white 10px, transparent 10px),
            linear-gradient(to left, white 10px, transparent 10px),
            repeating-linear-gradient(white, white 30px, #ccc 30px, #ccc 31px, white 31px);
        line-height: 31px;
        padding: 8px 10px;
        width: 100%;
    }
</style>
<div class="col-1 text-left fixed-top" style="margin-top: 6%;">
    <button href="#" class="to_click btn btn-primary ">Time</button>
</div>
<div class="container1 fixed-top to_hide" style="pointer-events: none;">
    <div class="col-6 text-left m-3">
    </div>

    <?php if ($apply == 1) { ?>
        <div class="container-segment">
            <div class="segment-title">Hours</div>
            <div class="segment">
                <div class="flip-card" data-hours-tens>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
                <div class="flip-card" data-hours-ones>
                    <div class="top">2</div>
                    <div class="bottom">2</div>
                </div>
            </div>
        </div>
        <div class="container-segment">
            <div class="segment-title">Minutes</div>
            <div class="segment">
                <div class="flip-card" data-minutes-tens>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
                <div class="flip-card" data-minutes-ones>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
            </div>
        </div>
        <div class="container-segment">
            <div class="segment-title">Seconds</div>
            <div class="segment">
                <div class="flip-card" data-seconds-tens>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
                <div class="flip-card" data-seconds-ones>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container-segment">
            <div class="segment-title">Hours</div>
            <div class="segment">
                <div class="flip-card" data-hours-tens>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
                <div class="flip-card" data-hours-ones>
                    <div class="top">2</div>
                    <div class="bottom">2</div>
                </div>
            </div>
        </div>
        <div class="container-segment">
            <div class="segment-title">Minutes</div>
            <div class="segment">
                <div class="flip-card" data-minutes-tens>
                    <div class="top">3</div>
                    <div class="bottom">3</div>
                </div>
                <div class="flip-card" data-minutes-ones>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
            </div>
        </div>
        <div class="container-segment">
            <div class="segment-title">Seconds</div>
            <div class="segment">
                <div class="flip-card" data-seconds-tens>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
                <div class="flip-card" data-seconds-ones>
                    <div class="top">0</div>
                    <div class="bottom">0</div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- <div class="container2 bg-transparent fixed-top">
    <div class="signboard outer">
        <div class="signboard front inner anim04c">
            <li class="year anim04c">
                <span></span>
            </li>
            <ul class="calendarMain anim04c">

                <li class="second anim04c">
                    <span>00</span>
                </li>

            </ul>
            <li class="clock minute anim04c">
                <span>30</span>
            </li>

        </div>
        <div class="signboard left inner anim04c">
            <li class="clock hour anim04c">
                <span>01</span>
            </li>

        </div>
        <div class="signboard right inner anim04c">
            <li class="clock second anim04c">
                <span>00</span>
            </li>

        </div>
    </div>
</div> -->
<section class="mt-5 py-3">
    <div class="container">
        <form action="" id="take-exam">
            <div class="align-items-top mb-3">
                <input type="hidden" name="c_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="client_id" value="<?php echo $_settings->userdata('id') ?>">
                <input type="hidden" name="exam_id" value="<?= $exam_id['id'] ?>">
                <div class="card card-outline card-primary shadow rounded-0">
                    <?php
                    $exam_ids = $conn->query("SELECT * FROM `exam_list` WHERE category_id = '{$id}' and status=1");
                    while ($exam_id = $exam_ids->fetch_assoc()) :
                        if (($exam_id['id']) == 43 || ($exam_id['id']) == 35 || ($exam_id['id']) == 36 || ($exam_id['id']) == 46) :
                    ?>
                            <div class="toggle-accordion accordion hover" id="toggle-<?= $exam_id['id'] ?>" data-toggle-id="<?= $exam_id['id'] ?>" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                                <label class="h4" id="toggle-<?= $exam_id['id'] ?>" data-toggle-id="<?= $exam_id['id'] ?>">
                                    <?= $exam_id['title'] ?>
                                </label>
                            </div>
                            <div class="card-body address-holder<?= $exam_id['id'] ?> hidden lala" data-exam-id="<?= $exam_id['id'] ?>">
                                <div><?= $exam_id['description'] ?></div>
                                <div class="" id="question-list">
                                    <?php
                                    if (isset($id)) :
                                        $qi = 1;
                                        $question = $conn->query("SELECT q.*,e.status FROM `question_list` q inner join exam_list e on q.exam_id = e.id WHERE e.status = 1 and e.id = '{$exam_id['id']}'");
                                        while ($row = $question->fetch_assoc()) :
                                    ?>
                                            <div class=" question-item py-4 <?= $qi != 1 ? "" : '' ?>">
                                                <div class="d-flex align-items-top mb-3">
                                                    <div class="col-auto">
                                                        <?= $qi++; ?>.
                                                    </div>
                                                    <div class="col-auto flex-shrink-1 flex-grow-1">
                                                        <div class="question_text "><?= html_entity_decode($row['question']) ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="text-muted"><b>[<?= ($row['points']) . ($row['points'] > 1 ? "pts." : "pt.") ?>]</b></span>
                                                    </div>
                                                </div>
                                                <div class="mx-3">
                                                    <div class="row">
                                                        <?php
                                                        $options = $conn->query("SELECT * FROM `option_list` WHERE question_id = '{$row['id']}'");
                                                        $counter = 0; // Counter to keep track of checked checkboxes
                                                        while ($orow = $options->fetch_assoc()) :
                                                            $counter++;


                                                            if ($exam_id['id'] == 36 || $exam_id['id'] == 46) {
                                                                $isRequired1 = ($counter <= 1) ? "required" : ""; // Add "required" attribute for the first 2 checkboxes
                                                                // $isRequired = "required";

                                                            } else {
                                                                // $isRequired1 = "required";
                                                                $isRequired = ($counter <= 2) ? "required" : ""; // Add "required" attribute for the first 2 checkboxes

                                                            }

                                                        ?>
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <div class="custom-control custom-checkbox">

                                                                        <input class="custom-control-input" type="checkbox" id="option_<?= $orow['id'] ?>" name="answer[<?= $row['id'] ?>][]" value="<?= $orow['id'] ?>" <?= isset($isRequired) ? $isRequired : $isRequired1 ?>>
                                                                        <label for="option_<?= $orow['id'] ?>" class="custom-control-label font-weight-normal"><?= $orow['option'] ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        endwhile;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endwhile; ?>

                                    <?php endif; ?>
                                </div>

                                <div class="h4 text-center ">
                                    End of <?= $exam_id['title'] ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="toggle-accordion accordion hover" id="toggle-<?= $exam_id['id'] ?>" data-toggle-id="<?= $exam_id['id'] ?>" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                                <label class="h4" id="toggle-<?= $exam_id['id'] ?>" data-toggle-id="<?= $exam_id['id'] ?>">
                                    <?= $exam_id['title'] ?>
                                </label>
                            </div>
                            <div class="card-body address-holder<?= $exam_id['id'] ?> hidden">

                                <div><?= $exam_id['description'] ?></div>
                                <div class="" id="question-list">
                                    <?php
                                    if (isset($id)) :
                                        $qi = 1;
                                        $question = $conn->query("SELECT q.*,e.status FROM `question_list` q inner join exam_list e on q.exam_id = e.id WHERE e.status = 1 and e.id = '{$exam_id['id']}'  ");
                                        while ($row = $question->fetch_assoc()) :
                                    ?>
                                            <div class=" question-item py-4 <?= $qi != 1 ? "" : '' ?>">
                                                <div class="d-flex align-items-top mb-3">
                                                    <div class="col-auto">
                                                        <?= $qi++; ?>.
                                                    </div>
                                                    <div class="col-auto flex-shrink-1 flex-grow-1">
                                                        <div class="question_text "><?= html_entity_decode($row['question']) ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="text-muted"><b>[<?= ($row['points']) . ($row['points'] > 1 ? "pts." : "pt.") ?>]</b></span>
                                                    </div>
                                                </div>
                                                <div class="mx-3">
                                                    <div class="row">
                                                        <?php
                                                        $options = $conn->query("SELECT * FROM `option_list` WHERE question_id = '{$row['id']}'");
                                                        $i = 0;
                                                        while ($orow = $options->fetch_assoc()) :
                                                        ?>
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <div class="custom-control custom-radio">
                                                                        <input class="custom-control-input " type="radio" id="option_<?= $orow['id'] ?>" name="answer[<?= $row['id'] ?>]" value="<?= $orow['id'] ?>" <?= $i == 1 ? "required" : "" ?>>
                                                                        <!-- <input class="custom-control-input" type="radio" id="option_<?= $orow['id'] ?>" name="answer[<?= $row['id'] ?>]" value="<?= $orow['id'] ?>" <?= $i == 1 ? "required" : "" ?>> -->
                                                                        <label for="option_<?= $orow['id'] ?>" class="custom-control-label font-weight-normal"><?= html_entity_decode($orow['option']) ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            $i++;
                                                        endwhile;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="h4 text-center ">
                                    End of <?= $exam_id['title'] ?>
                                </div>
                            </div>
                    <?php
                        endif;
                    endwhile;
                    ?>
                </div>
            </div>
        </form>
        <?php $exams1 = $conn->query("SELECT * FROM `applicants` where  id =" . $_settings->userdata('id'));
        while ($rows = $exams1->fetch_assoc()) :
            $has_app_id = $conn->query("SELECT * FROM `essay` where  applicant_id =" . $_settings->userdata('id'))->fetch_array();
        ?>
            <form action="" id="take-exam2" autocomplete="off">
                <input type="hidden" name="has_id" value="<?php echo isset($has_app_id[0]) ? $has_app_id[0] : '' ?>">
                <input type="hidden" name="applicant_id" value="<?= $_settings->userdata('id') ?>">
                <div class="align-items-top mb-3">
                    <div class="shadow rounded-0">
                        <div class="toggle-accordion accordion hover" id="toggle-003" data-toggle-id="003" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                            <label class="h4" id="toggle-003" data-toggle-id="003">
                                Essay and Typing Test
                            </label>
                        </div>
                        <div class="card-body address-holder003 hidden lala" data-exam-id="003">
                            <h3><b>PART I. ESSAY & TYPING TEST (100 words within 5 minutes)</b></h3><br>
                            <h6><b> 1. What does work mean to you? <B>(5 POINTS)</B><BR>
                                    (Ano ang kahulugan ng trabaho sa iyo?)
                                </b></h6><br>
                            <textarea rows="10" name="essayq1" required class="notes"></textarea>
                            <h6><b> 2. How do you value work? <B>(5 POINTS)</B><BR>
                                    (Paano mo pinahahalagahan ang iyong trabaho?)
                                </b></h6><br>
                            <textarea rows="10" name="essayq2" required class="notes"></textarea>
                            <div class="h4 text-center ">
                                End of Essay and Typing Test
                            </div>
                        </div>
                    </div>
                    <div class="shadow rounded-0">
                        <div class="toggle-accordion accordion hover" id="toggle-004" data-toggle-id="004" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                            <label class="h4" id="toggle-004" data-toggle-id="004">
                                Visual Inspection Test
                            </label>
                        </div>
                        <div class="card-body address-holder004 hidden lala" data-exam-id="004">
                            <h3><b>PART II. VISUAL INSPECTION TEST</b></h3><br>
                            <div class="row justify-content-end">

                                <div class="col-md-10">
                                    <div class="form-group" style="text-align: center;">
                                        <label for="unit1">UNIT MARK</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-5">
                                    <div class="form-group" style="text-align: center;">
                                        <label for="unit2">EVALUATION</label>
                                    </div>
                                </div> -->
                            </div><br>
                            <div class="row ">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">1. Dummy Unit # 1:</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">

                                        <input style="width: 95%;" type="text" required name="unit1" id="unit1">;
                                    </div>
                                </div>
                                <!-- <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" style="width:100%;" required name="unit2" id="unit2">
                                    </div>
                                </div> -->
                            </div><br>
                            <div class="row ">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">2. Dummy Unit # 2:</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input style="width: 95%;" type="text" required name="unit3" id="unit3">;
                                    </div>
                                </div>
                                <!-- <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" style="width:100%;" required name="unit4" id="unit4">
                                    </div>
                                </div> -->
                            </div><br>
                            <div class="h4 text-center ">
                                End of Visual Inspection Test
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if ($rows['application'] == 2) { ?>
                <form action="" id="take-exam1" autocomplete="off">
                    <div class="align-items-top mb-3">
                        <?php
                        $test = $conn->query("SELECT * FROM `enumeration` WHERE applicant_id = " . $_settings->userdata('id'));
                        while ($row = $test->fetch_assoc()) :
                        ?>
                            <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>">
                        <?php endwhile; ?>
                        <input type="hidden" name="applicant_id" value="<?= $_settings->userdata('id') ?>">
                        <div class="shadow rounded-0">
                            <div class="toggle-accordion accordion hover" id="toggle-001" data-toggle-id="001" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                                <label class="h4" id="toggle-001" data-toggle-id="001">
                                    TEST II.
                                </label>
                            </div>
                            <div class="card-body address-holder001 hidden lala" data-exam-id="001">
                                <h6><b> A. Identification. Write the best answer on the blank. Choose among the available choices below the questions.</b></h6><br>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q1" name="q1">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q1" class="control-label">1. A designation given to a fixed set of graphical techniques identified as being most helpful in trouble shooting issues related to quality. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q2" name="q2">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q2" class="control-label">2. Is a method of quality control which uses statistical methods in order to monitor and control a process. It answers the question if the process is functioning properly or not.</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q3" name="q3">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q3" class="control-label">3. Action to eliminate the cause of detected nonconformity.</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q4" name="q4">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q4" class="control-label"> 4. Action to eliminate the cause of potential non conformity. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q5" name="q5">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q5" class="control-label">5. This procedure sets forth the method for periodically and randomly examining systems to identify non-conforming conditions to bring to attention of those responsible for the condition and if appropriate, a corrective and preventive actions are required. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q6" name="q6">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q6" class="control-label">6. An international agreement on SMART management practices, the organizational structure, procedures, processes and resources needed to implement quality management. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q7" name="q7">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q7" class="control-label">7. Refers to the management of an organization’s environmental programs in a comprehensive, systematic, planned and documented manner. It includes the organizational structure, planning and resources for developing implementing and maintaining policy for environmental protection. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q8" name="q8">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q8" class="control-label">8. It is a simple vertical bar chart that shows the frequency of various categories of a problem. The bars are arranged in a descending magnitude, from left to right, accompanied by cumulative percentage line. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q9" name="q9">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q9" class="control-label">9. Tool used to check if processes are in the stable condition or maintain processes in stable condition. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q10" name="q10">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q10" class="control-label">10. The Ability of a process to meet design specification, which are set by engineering or customer requirements. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q11" name="q11">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q11" class="control-label">11. Products or services that meet or exceed customers satisfaction, the totality of feature and characteristic of the product and service that bear on its ability to satisfy stated or implied needs. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q12" name="q12">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q12" class="control-label">12. A method of measuring random samples of lots or batches of products against predetermined standards. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q13" name="q13">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q13" class="control-label">13. An interconnection of circuit components inseparably associated on or within a single substrate. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q14" name="q14">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q14" class="control-label">14. The general term for completely processed printed circuit or wiring configuration which maybe single, double or multi-layered. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q15" name="q15">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q15" class="control-label">15. A device that produces mechanical motions. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q16" name="q16">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q16" class="control-label">16. A type of actuator that uses air pressure to produce mechanical motions. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q17" name="q17">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q17" class="control-label">17. A device that uses high voltage to neutralize static charge in a surface of a material. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q18" name="q18">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q18" class="control-label">18. The moisture content of the air. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q19" name="q19">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q19" class="control-label">19. Is a process by which entitles review the quality pf all the factors involved in production. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required id="q20" name="q20">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="q20" class="control-label">20. refers to the engineering activities implemented in a quality system so that requirements for a product or services will be fulfilled </label>
                                        </div>
                                    </div>
                                </div>
                                <h4>Possible Answer for Part A:</h4>
                                <table style="width:100%">
                                    <tr>
                                        <td>Process Capability</td>
                                        <td>Productivity</td>
                                        <td>Statistical Process Control</td>
                                        <td>Integrated Circuit</td>
                                        <td>Quality Control</td>

                                    </tr>
                                    <tr>
                                        <td>Control Charts </td>
                                        <td>Containment Action </td>
                                        <td> Preventive Action</td>
                                        <td> Printed Circuit Board</td>
                                        <td> Quality Assurance</td>

                                    </tr>
                                    <tr>
                                        <td>Pareto Diagram </td>
                                        <td>Interim Action </td>
                                        <td> Planning</td>
                                        <td>Actuator </td>
                                        <td> Corrective Action</td>

                                    </tr>
                                    <tr>
                                        <td> Acceptance Sampling </td>
                                        <td> Final Inspection</td>
                                        <td>Semiconductors </td>
                                        <td> Audit</td>
                                        <td> Pneumatic Actuator</td>

                                    </tr>
                                    <tr>
                                        <td> Scatter Diagram</td>
                                        <td> Quality management system</td>
                                        <td>7 Basic qc Tools </td>
                                        <td> Ionizer</td>
                                        <td> Just-in-time</td>

                                    </tr>
                                    <tr>
                                        <td>Statistic </td>
                                        <td> Environmental Management System</td>
                                        <td> Quality</td>
                                        <td> Humidity</td>
                                        <td> Taguchi Principle</td>

                                    </tr>
                                </table>
                                <br><br>
                                <h6><b> B. Enumeration</b></h6><br>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">I. Enumerate the Basic 7 QC Tools </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>1.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b1" name="b1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>2.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b2" name="b2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>3.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b3" name="b3">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>4.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b4" name="b4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>5.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b5" name="b5">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>6.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b6" name="b6">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>7.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="b7" name="b7">
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">II. What are the 8 Disciples of Problem solving. </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>1.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c1" name="c1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>2.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c2" name="c2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>3.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c3" name="c3">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>4.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c4" name="c4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>5.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c5" name="c5">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>6.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c6" name="c6">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>7.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c7" name="c7">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span>8.</span>
                                            </div>
                                            <input type="text" class="form-control" required id="c8" name="c8">
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">III. State the Mathematical representation of Ohm's Law (5pts) </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="o1" class="control-label">Answer: </label>
                                        <textarea rows="4" class="form-control" required id="o1" name="o1"></textarea>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">IV. Basic Electronics </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-right text-info">
                                            <label class="control-label">Symbols: &#937; | &#x192; | &#x3A5; | &Alpha; | &#956; </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">1. Identify the Current (I) </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img src="./uploads/basic_electronics.png" alt="Basic Electronics" width="100%" height="100%">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="e1" class="control-label">Answer: </label>
                                        <textarea rows="2" class="form-control" required id="e1" name="e1"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">2. Solve for the value of R5 </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img src="./uploads/r5.png" alt="R5" width="100%" height="100%">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="r1" class="control-label">Answer: </label>
                                        <textarea rows="2" class="form-control" required id="r1" name="r1"></textarea>
                                    </div>
                                </div>
                                <div class="h4 text-center ">
                                    End of Test II
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            } elseif ($rows['application'] == 4) { ?>
                <form>
                    <div class="align-items-top mb-3">

                        <div class="shadow rounded-0">
                            <div class="toggle-accordion accordion hover" id="toggle-002" data-toggle-id="002" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                                <label class="h4" id="toggle-002" data-toggle-id="002">
                                    TEST II.
                                </label>
                            </div>
                            <div class="card-body address-holder002 hidden lala" data-exam-id="002">
                                <h3 style="color:#FF0000"><b>INSTRUCTIONS: Write your answer at the back of your resume.</b></h3><br>
                                <h6><b> 1. Write the symbol for the following. <B>(2 POINTS EACH)</B></b></h6><br>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">A. Voltage Source</label>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">B. Current Source</label>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">C. Transformer </label>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label"> D. Capacitor</label>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">E. Resistor </label>
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <h6><b> 2. Draw the diagram for simple DC Power Supply <b>(30 POINTS)</b></b></h6><br><br>
                                <h6><b> 3. Find the Value of I <b>(10 POINTS)</b></b></h6>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="./uploads/value_of_i.png" alt="Find the value of I" width="100%" height="100%">
                                    </div>
                                </div>
                                <br><br>
                                <h6><b> 4. Write the Logic Gates type <b>(2 POINTS EACH)</b></b></h6>
                                <br>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">A. </label><img src="./uploads/logic_gate_a.png" alt="Logic Gate" width="50%" height="50%">
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">B. </label><img src="./uploads/logic_gate_b.png" alt="Logic Gate" width="50%" height="50%">
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">C. </label><img src="./uploads/logic_gate_c.png" alt="Logic Gate" width="50%" height="50%">
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">D. </label><img src="./uploads/logic_gate_d.png" alt="Logic Gate" width="50%" height="50%">
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <div class="indented">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">E. </label><img src="./uploads/logic_gate_e.png" alt="Logic Gate" width="50%" height="50%">
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                                <div class="h4 text-center ">
                                    End of Test II
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            } ?>

        <?php endwhile; ?>
        <div class="align-items-top mb-3">
            <div class="shadow rounded-0">
                <div class="card-footer">
                    <div class="d-flex justify-contron-between w-100">
                        <div class="col-6">
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary btn-lg btn-flat " type="submit" id="submit-button">Submit</button>
                        </div>
                    </div>
                </div>
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
    $(function() {
        $(".hidden").hide();
        // Attach event listeners to all the divs
        var divs = document.querySelectorAll('.toggle-accordion');
        divs.forEach(function(div) {
            div.addEventListener('click', handleClick);
        });

        // Check if any input field with the 'required' attribute is present
        var inputs = document.querySelectorAll('input[required]');
        // console.log(inputs, 'req')
        // Event handler function

        let isCodeExecuted = false; //====================gawing false kapag ibabalik na ang timer======================//


        let timerActive = true; // Set to true when the timer is active, and false when it's not
        function handleClick(event) {
            // Get the toggle ID from the data attribute of the clicked div
            var toggleId = event.target.getAttribute('data-toggle-id');
            console.log(toggleId);

            // Get the specific div by its ID
            var specificDiv = document.getElementById('toggle-' + toggleId);
            $(".address-holder" + toggleId).slideToggle("slow");
            var addressHolder = document.querySelector('.address-holder' + toggleId);
            var hiddenDiv = document.querySelector('.address-holder' + toggleId);
            var requiredRadios = hiddenDiv.querySelectorAll('input[type="radio"][required]');
            var isAnyRadioSelected = Array.from(requiredRadios).some(function(radio) {
                return radio.checked;
            });



            console.log(specificDiv, 'spef')

            var submitButton = document.getElementById('submit-button');

            function triggerButton() {
                timerActive = false;
                $(`input`).removeAttr('required');
                $(`textarea`).removeAttr('required');
                submitButton.click(); // Simulate a button click
            }


            // Set a timer for 5 seconds (5000 milliseconds)
            // setTimeout(triggerButton, 5000);
            var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
            console.log(userId);


            //=========================EXAM TIMER==========================================//
            if (userId != 1) {
                setTimeout(triggerButton, 150 * 60 * 1000); //150mins
            } else if (userId == 1) {
                setTimeout(triggerButton, 120 * 60 * 1000); //120 mins
            }

            window.onbeforeunload = function() {
                if (timerActive == true) {
                    return "Are you sure you want to leave this page? The timer is still active.";
                } else {}
            };

            submitButton.addEventListener('click', function(event) {
                // Prevent the default form submission
                event.preventDefault();
                if (isAnyRadioSelected == false) {
                    var specificAddressHolder = document.querySelector('.card-body.address-holder' + toggleId);
                    if (specificAddressHolder) {
                        var className = specificAddressHolder.classList.item(1);
                    }
                    $(specificAddressHolder).show("slow");
                    // }
                    specificDiv.classList.add('show');

                    var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
                    console.log(userId, 'tab1')
                    // if (userId == 2) {
                    //     $('#take-exam').submit();
                    //     $('#take-exam1').submit();
                    // } else {
                    //     $('#take-exam').submit();
                    // }
                    $('#take-exam').submit();
                } else {

                    var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
                    console.log(userId, 'tab2')
                    // if (userId == 2) {
                    //     $('#take-exam').submit();
                    //     $('#take-exam1').submit();
                    // } else {

                    //     $('#take-exam').submit();
                    // }
                    $('#take-exam').submit();
                }

            });

            //=======================================Isa pang uri ng timer or ibang design ng timer===========================//
            // if (!isCodeExecuted) {
            //     console.log('outside');
            //     var totalMinutes = 90; // Set the total minutes for the countdown
            //     var minutes = totalMinutes % 60;
            //     var hours = Math.floor(totalMinutes / 60);
            //     var seconds = 0;

            //     setInterval(function() {
            //         if (seconds === 0) {
            //             if (minutes === 0 && hours === 0) {
            //                 // Countdown is finished
            //                 clearInterval();
            //                 return;
            //             }
            //             if (minutes === 0) {
            //                 hours--;
            //                 minutes = 59;
            //             } else {
            //                 minutes--;
            //             }
            //             seconds = 59;
            //         } else {
            //             seconds--;
            //         }

            //         $(".hour").html((hours < 10 ? "0" : "") + hours);
            //         $(".minute").html((minutes < 10 ? "0" : "") + minutes);
            //         $(".second").html((seconds < 10 ? "0" : "") + seconds);
            //     }, 1000);
            //     isCodeExecuted = true;
            // }
            if (!isCodeExecuted) {
                var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
                console.log(userId);
                if (userId != 1) {
                    var countToDate = (+new Date) + (150 * 60 * 1000);
                } else if (userId == 1) {
                    var countToDate = (+new Date) + (120 * 60 * 1000);
                }
                // const countToDate = new Date().setHours(new Date().getHours())
                let previousTimeBetweenDates
                setInterval(() => {
                    const currentDate = new Date()
                    const timeBetweenDates = Math.ceil((countToDate - currentDate) / 1000)
                    flipAllCards(timeBetweenDates)

                    previousTimeBetweenDates = timeBetweenDates
                }, 250)

                function flipAllCards(time) {
                    const seconds = time % 60
                    const minutes = Math.floor(time / 60) % 60
                    const hours = Math.floor(time / 3600)

                    flip(document.querySelector("[data-hours-tens]"), Math.floor(hours / 10))
                    flip(document.querySelector("[data-hours-ones]"), hours % 10)
                    flip(document.querySelector("[data-minutes-tens]"), Math.floor(minutes / 10))
                    flip(document.querySelector("[data-minutes-ones]"), minutes % 10)
                    flip(document.querySelector("[data-seconds-tens]"), Math.floor(seconds / 10))
                    flip(document.querySelector("[data-seconds-ones]"), seconds % 10)
                }

                function flip(flipCard, newNumber) {
                    const topHalf = flipCard.querySelector(".top")
                    const startNumber = parseInt(topHalf.textContent)
                    if (newNumber === startNumber) return

                    const bottomHalf = flipCard.querySelector(".bottom")
                    const topFlip = document.createElement("div")
                    topFlip.classList.add("top-flip")
                    const bottomFlip = document.createElement("div")
                    bottomFlip.classList.add("bottom-flip")

                    top.textContent = startNumber
                    bottomHalf.textContent = startNumber
                    topFlip.textContent = startNumber
                    bottomFlip.textContent = newNumber

                    topFlip.addEventListener("animationstart", e => {
                        topHalf.textContent = newNumber
                    })
                    topFlip.addEventListener("animationend", e => {
                        topFlip.remove()
                    })
                    bottomFlip.addEventListener("animationend", e => {
                        bottomHalf.textContent = newNumber
                        bottomFlip.remove()
                    })
                    flipCard.append(topFlip, bottomFlip)
                }
                isCodeExecuted = true;
            }
        }
        $('.to_click').text('Hide');
        $('.to_click').on('click', function() {
            var toHideElement = $('.to_hide');

            if (toHideElement.css('opacity') == 1) {
                toHideElement.css('opacity', 0);
                $('.to_click').text('Show');
            } else {
                toHideElement.css('opacity', 1);
                $('.to_click').text('Hide');
            }
        });
        // Get all checkboxes within the specified container
        const checkboxes = document.querySelectorAll('.custom-control-input');

        // Attach an event listener to each checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Get the question ID from the checkbox's name attribute
                const questionId = this.name.split('[')[1].split(']')[0];
                console.log(questionId)
                // Count the number of checked checkboxes for the current question ID
                const numChecked = document.querySelectorAll(`input[name="answer[${questionId}][]"]:checked`).length;

                // If more than two checkboxes are checked for the current question, uncheck the current one
                if (numChecked > 2) {
                    this.checked = false;
                }
                let min = 159;
                let max = 170;
                if ((questionId >= min && questionId <= max) || (questionId >= 417 && questionId <= 428)) {
                    console.log('IN')
                    var userId = <?php echo $_settings->userdata('application'); ?>;
                    console.log(userId, 'id');
                    if (numChecked == 1 || numChecked == 2 || numChecked == 3) {
                        $(`input[name="answer[${questionId}][]"]`).removeAttr('required');
                    } else if (numChecked != 1) {
                        $(`input[name="answer[${questionId}][]"]`).attr('required', true)
                    }
                } else {
                    console.log('OUT')

                    if (numChecked == 2 || numChecked == 3) {
                        $(`input[name="answer[${questionId}][]"]`).removeAttr('required');
                    } else if (numChecked != 2) {
                        $(`input[name="answer[${questionId}][]"]`).attr('required', true)
                    }
                }
                console.log(numChecked)
            });
        });
        // Retrieve the values of the radio inputs from localStorage
        var radioInputValues = JSON.parse(localStorage.getItem('radio-input-values'));

        // If the values are not null, set the corresponding radio inputs as checked
        if (radioInputValues !== null) {
            for (var key in radioInputValues) {
                var inputId = "option_" + radioInputValues[key];
                document.getElementById(inputId).checked = true;
            }
        }

        // Store the values of the radio inputs in localStorage when a radio input is clicked
        document.querySelectorAll('input[type="radio"]').forEach(function(input) {
            input.addEventListener('click', function(event) {
                var radioInputValues = {};
                document.querySelectorAll('input[type="radio"]').forEach(function(input) {
                    if (input.checked) {
                        var questionId = input.getAttribute('name').replace("answer[", "").replace("]", "");
                        radioInputValues[questionId] = input.value;
                    }
                });
                localStorage.setItem('radio-input-values', JSON.stringify(radioInputValues));
            });
        });

        var checkInputValues = JSON.parse(localStorage.getItem('check-input-values'));

        // If the values are not null, set the corresponding checkbox inputs as checked
        if (checkInputValues !== null) {
            for (var questionId in checkInputValues) {
                var inputIds = checkInputValues[questionId];
                for (var i = 0; i < inputIds.length; i++) {
                    var inputId = "option_" + inputIds[i];
                    document.getElementById(inputId).checked = true;
                }
            }
        }

        // Store the values of the checkbox inputs in localStorage when a checkbox input is clicked
        document.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
            input.addEventListener('click', function(event) {
                var checkInputValues = {};
                document.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
                    if (input.checked) {
                        var questionId = input.getAttribute('name').replace("answer[", "").replace("]", "");
                        if (!checkInputValues.hasOwnProperty(questionId)) {
                            checkInputValues[questionId] = [];
                        }
                        checkInputValues[questionId].push(input.value);
                    }
                });
                localStorage.setItem('check-input-values', JSON.stringify(checkInputValues));
            });
        });
        console.log(checkInputValues)
        if (checkInputValues !== null) {
            for (var questionId in checkInputValues) {
                var inputIds = checkInputValues[questionId];
                for (var i = 0; i < inputIds.length; i++) {
                    var inputId = "option_" + inputIds[i];
                    document.getElementById(inputId).checked = true;
                    const questionIds = questionId.split('[')[0];
                    console.log(inputIds.length)
                    if ((questionIds >= 159 && questionIds <= 170) || (questionIds >= 417 && questionIds <= 428)) {
                        $(`input[name="answer[${questionIds}][]"]`).removeAttr('required');
                    } else {
                        if (inputIds.length > 1) {
                            $(`input[name="answer[${questionIds}][]"]`).removeAttr('required');
                        }
                    }
                }
            }
        }
        var score = 0;
        // This function is attached to the submit event of the #take-exam form.
        // When the form is submitted, this function will be executed.
        $('#take-exam').submit(function(e) {
            console.log('aa')
            // Remove any stored data from localStorage upon form submission.


            // Prevent the form from submitting by calling the preventDefault() method on the e object.
            e.preventDefault();

            // Get a reference to the current form element.
            var _this = $(this);

            // Check if the form is valid.
            // If the form is not valid, the function will call the reportValidity() method on the form element.
            // The reportValidity() method will display an error message to the user.
            if (_this[0].checkValidity() == false) {
                _this[0].reportValidity();
                // alert()
                return false;
            }

            // Remove any existing error messages from the form.
            $('.err-msg').remove();

            // Create a new div element.
            // The div element will be used to display an error message if an error occurs.
            var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
            var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
            console.log(userId, 'tab')
            if (userId == 2) {
                var form1 = $('#take-exam1');
                if (!form1[0].checkValidity()) {
                    form1[0].reportValidity();
                    console.log('here')
                    return false;
                }
            }
            var form2 = $('#take-exam2');
            if (!form2[0].checkValidity()) {
                form2[0].reportValidity();
                console.log('here')
                return false;
            }

            timerActive = false;
            // Start a loading animation.
            start_loader();

            // Make an Ajax request to the classes/Master.php file.
            // The classes/Master.php file is a PHP file that contains the code to calculate the score for the exam.
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=calculate_score",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    // Display an error message if the Ajax request fails.
                    console.error(err)
                    el.addClass('alert-danger').text("An error occured");
                    _this.prepend(el)
                    el.show('.modal')
                    end_loader();
                },
                success: function(resp) {
                    // Check the response from the classes/Master.php file.
                    // If the response is a success, redirect the user to the view_score page.
                    // If the response is a failure, display an error message to the user.
                    if (typeof resp == 'object' && resp.status == 'success') {

                        score = resp.score;
                        var userIds = <?php echo isset($apply) ? $apply : 'na' ?>;
                        console.log(userIds, 'tab')
                        if (userIds != 2) {
                            // localStorage.removeItem('radio-input-values');
                            // localStorage.removeItem('check-input-values');
                            // location.href = "./?p=view_score&id=<?= isset($id) ? md5($id) : '' ?>";

                            $('#take-exam2').submit();
                        } else if (userIds == 2) {
                            $('#take-exam1').submit();
                        }
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        el.addClass('alert-danger').text(resp.msg);
                        _this.prepend(el)
                        el.show('.modal')
                    } else {
                        el.text("An error occured");
                        console.error(resp)
                    }
                    $("html, body").scrollTop(0);
                    end_loader()
                }
            })
        })
        var isSubmitting = false; // Flag to track if form is currently being submitted

        $('#take-exam1').submit(function(e) {
            // Prevent the form from submitting by calling the preventDefault() method on the e object.
            e.preventDefault();
            // Get a reference to the current form element.
            var _this = $(this);
            // Check if the form is valid.
            // If the form is not valid, the function will call the reportValidity() method on the form element.
            // The reportValidity() method will display an error message to the user.
            if (_this[0].checkValidity() == false) {
                _this[0].reportValidity();
                // alert()
                return false;
            }
            // Remove any existing error messages from the form.
            $('.err-msg').remove();
            // Create a new div element.
            // The div element will be used to display an error message if an error occurs.
            var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
            var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
            console.log(userId, 'tab')
            // if (userId == 2) {
            //     var form1 = $('#take-exam');
            //     if (!form1[0].checkValidity()) {
            //         form1[0].reportValidity();
            //         console.log('here')
            //         return false;
            //     }
            // }
            // if (userId != 1) {
            //     var form2 = $('#take-exam2');
            //     if (!form2[0].checkValidity()) {
            //         form2[0].reportValidity();
            //         console.log('here')
            //         return false;
            //     }
            // }
            if (isSubmitting) {
                return; // Exit the function if submission is already in progress
            }
            timerActive = false;
            // Start a loading animation.
            start_loader();
            isSubmitting = true; // Set the flag to indicate that form submission is in progress
            // Make an Ajax request to the classes/Master.php file.
            // The classes/Master.php file is a PHP file that contains the code to calculate the score for the exam.
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_test",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    // Display an error message if the Ajax request fails.
                    console.error(err)
                    el.addClass('alert-danger').text("An error occured");
                    _this.prepend(el)
                    el.show('.modal')
                    end_loader();
                },
                success: function(resp) {
                    // Check the response from the classes/Master.php file.
                    // If the response is a success, redirect the user to the view_score page.
                    // If the response is a failure, display an error message to the user.
                    if (typeof resp == 'object' && resp.status == 'success') {
                        isSubmitting = false;
                        $('#take-exam2').submit();

                        // localStorage.removeItem('radio-input-values');
                        // localStorage.removeItem('check-input-values');
                        // location.href = "./?p=view_score&id=<?= isset($id) ? md5($id) : '' ?>";
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        isSubmitting = false;
                        el.addClass('alert-danger').text(resp.msg);
                        _this.prepend(el)
                        el.show('.modal')
                    } else {
                        isSubmitting = false;
                        el.text("An error occured");
                        console.error(resp)
                    }
                    $("html, body").scrollTop(0);
                    end_loader()
                }
            })
        })
        var isSubmittingagain = false;
        $('#take-exam2').submit(function(e) {
            console.log('aa')
            // Remove any stored data from localStorage upon form submission.


            // Prevent the form from submitting by calling the preventDefault() method on the e object.
            e.preventDefault();

            // Get a reference to the current form element.
            var _this = $(this);

            // Check if the form is valid.
            // If the form is not valid, the function will call the reportValidity() method on the form element.
            // The reportValidity() method will display an error message to the user.
            if (_this[0].checkValidity() == false) {
                _this[0].reportValidity();
                // alert()
                return false;
            }

            // Remove any existing error messages from the form.
            $('.err-msg').remove();

            // Create a new div element.
            // The div element will be used to display an error message if an error occurs.
            var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
            var userId = <?php echo isset($apply) ? $apply : 'na' ?>;
            console.log(userId, 'tab')
            // if (userId == 2) {
            //     var form1 = $('#take-exam1');
            //     if (!form1[0].checkValidity()) {
            //         form1[0].reportValidity();
            //         console.log('here')
            //         return false;
            //     }
            // }
            // if (userId != 1) {
            //     var form2 = $('#take-exam');
            //     if (!form2[0].checkValidity()) {
            //         form2[0].reportValidity();
            //         console.log('here')
            //         return false;
            //     }
            // }
            if (isSubmittingagain) {
                return; // Exit the function if submission is already in progress
            }
            timerActive = false;
            // Start a loading animation.
            start_loader();
            isSubmittingagain = true;
            // Make an Ajax request to the classes/Master.php file.
            // The classes/Master.php file is a PHP file that contains the code to calculate the score for the exam.
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_essay",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    // Display an error message if the Ajax request fails.
                    console.error(err)
                    el.addClass('alert-danger').text("An error occured");
                    _this.prepend(el)
                    el.show('.modal')
                    end_loader();
                },
                success: function(resp) {
                    // Check the response from the classes/Master.php file.
                    // If the response is a success, redirect the user to the view_score page.
                    // If the response is a failure, display an error message to the user.
                    if (typeof resp == 'object' && resp.status == 'success') {
                        isSubmittingagain = false;
                        // $('#take-exam').submit();

                        localStorage.removeItem('radio-input-values');
                        localStorage.removeItem('check-input-values');
                        location.href = "./?p=view_score&id=<?= isset($id) ? md5($id) : '' ?>&107844=" + score;
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        isSubmittingagain = false;
                        el.addClass('alert-danger').text(resp.msg);
                        _this.prepend(el)
                        el.show('.modal')
                    } else {
                        isSubmittingagain = false;
                        el.text("An error occured");
                        console.error(resp)
                    }
                    $("html, body").scrollTop(0);
                    end_loader()
                }
            })
        })
    })
</script>