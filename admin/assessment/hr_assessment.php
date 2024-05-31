<?php
$query = $conn->query("SELECT * FROM `assessment`");
$countrow = $query->num_rows;
if ($countrow <= 0) {
    if (isset($_GET['id'])) {
        $qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname  from `applicants` where id = '{$_GET['id']}' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $k => $v) {
                $$k = $v;
            }
        }
    }
    $score1 = $conn->query("SELECT SUM(score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
    $score2 = $conn->query("SELECT SUM(test2) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
    $score = $score1 + $score2;
    $score = $score > 0 ? $score : 0;
    $pass = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
    if ($pass[0] == 1) {
        $pass = 'Passed';
    } else {
        $pass = 'Failed';
    }
    $pos = $conn->query("SELECT `application` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
    if ($pos[0] == 1) {
        $pos = 'Operator';
    } elseif ($pos[0] == 2) {
        $pos = 'QA Engineer';
    } elseif ($pos[0] == 3) {
        $pos = 'Staff';
    } elseif ($pos[0] == 4) {
        $pos = 'Technician or Equipment or Process Engineers';
    }
} else {
    $query = $conn->query("SELECT a.*,concat(c.firstname,' ',c.surname) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
    $countrow = $query->num_rows;
    if ($countrow == 1) {
        if (isset($_GET['id'])) {
            $qry = $conn->query("SELECT a.*,concat(c.firstname,' ',c.surname) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
            if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                    $$k = $v;
                }
            }
            $score1 = $conn->query("SELECT SUM(score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score2 = $conn->query("SELECT SUM(test2) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score = $score1 + $score2;
            $score = $score > 0 ? $score : 0;
            $pass = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
            if ($pass[0] == 1) {
                $pass = 'Passed';
            } else {
                $pass = 'Failed';
            }
            $pos = $conn->query("SELECT `application` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
            if ($pos[0] == 1) {
                $pos = 'Operator';
            } elseif ($pos[0] == 2) {
                $pos = 'QA Engineer';
            } elseif ($pos[0] == 3) {
                $pos = 'Staff';
            } elseif ($pos[0] == 4) {
                $pos = 'Technician or Equipment or Process Engineers';
            }
        }
    } else {
        if (isset($_GET['id'])) {
            $qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname  from `applicants` where id = '{$_GET['id']}' ");
            if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                    $$k = $v;
                }
            }
            $score1 = $conn->query("SELECT SUM(score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score2 = $conn->query("SELECT SUM(test2) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score = $score1 + $score2;
            $score = $score > 0 ? $score : 0;
            $pass = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
            if ($pass[0] == 1) {
                $pass = 'Passed';
            } else {
                $pass = 'Failed';
            }
            $pos = $conn->query("SELECT `application` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
            if ($pos[0] == 1) {
                $pos = 'Operator';
            } elseif ($pos[0] == 2) {
                $pos = 'QA Engineer';
            } elseif ($pos[0] == 3) {
                $pos = 'Staff';
            } elseif ($pos[0] == 4) {
                $pos = 'Technician or Equipment or Process Engineers';
            }
        }
    }
}
date_default_timezone_set('Asia/Manila');
?>

<link rel="stylesheet" href="<?php echo base_url ?>dist/css/assessment.css">
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><?php echo isset($id) ? "Assessment Form" : '' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="client-form" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <!-- <input type="hidden"  name="applicant_id" value="<?php echo isset($applicant_id) ? $applicant_id : '' ?>"> -->
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="">Personal Information</legend>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name" class="control-label ">Name : </label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="name" name="name" value="<?php echo isset($fullname) ? $fullname : '' ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date"  name="date" value="<?php echo date("m-d-Y") ?>"> -->
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                <!-- <input type="date" data-date="" data-date-format="MM-DD-YYYY" value="2015-08-09"> -->
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date" name="date" value="<?php echo isset($date) ? $date : date('m-d-Y') ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="a_position" class="control-label ">Position :</label>
                                <input type="text" class="form-control form-control-sm rounded-0" required id="a_position" name="a_position" placeholder="Position" value="<?php echo isset($a_position) ? $a_position : $pos ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date"  name="date" value="<?php echo date("m-d-Y") ?>"> -->
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date"  name="date" value="<?php echo date("m-d-Y") ?>"> -->
                            </div>

                        </div>
                        <br>
                        <div class="toggle accordion hover" id="change" value="2" style="padding: 5px;text-align: center; border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                            <p class="h5"><b>I - Qualifying Exam</b></P>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder col-sm-4">
                                <label for="rating" class="control-label ">Rating</label>
                                <input type="number" class="form-control form-control-sm rounded-0" required id="rating" name="rating" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($score) ? $score : $score ?>">
                            </div>
                            <div class="form-group address-holder col-sm-4">
                                <label for="a_remarks" class="control-label ">Remarks</label>
                                <input type="text" class="form-control form-control-sm rounded-0" required id="a_remarks" placeholder="REMARKS" name="a_remarks" value="<?php echo isset($pass) ? $pass :  $pass ?>">
                            </div>
                            <div class="form-group address-holder col-sm-4">
                                <label for="conducted_by" class="control-label ">Conducted By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" required id="conducted_by" placeholder="CONDUCTED BY" name="conducted_by" value="<?php echo isset($conducted_by) ? $conducted_by : '' ?>">
                            </div>
                        </div>
                        <br><br>
                        <p class="h5 login-box-msg address-holder1"><b><i>Interview Rating Scale</i></b></P>
                        <div style="text-align: center;" class="address-holder1"><I>Instruction : From scale of 1 - 10 (with 10 as the highest and 1 as the lowest) rate each item based on your observation during the interview.</I><br><br>
                        </div>
                        <div class="toggle1 accordion hover" id="change1" value="4" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                            <p class="h5"><b>II - Preliminary Interview</b></I>
                        </div>
                        <div class="row ">
                            <div class="form-group address-holder1 col-sm-4 ">
                                <label for="rating" class="control-label ">a. APPEARANCE</label>
                                <I> (Manner of Dressing, Posture/Poise)</I>
                            </div>
                            <div class="form-group form-inline address-holder1 col-sm-2">
                                <label for="rating1" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-" required name="rating1" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating1) ? $rating1 : '' ?>">
                            </div>
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                                <I>(Knowledgeability, Competence, Judgement, Analytical Ability)</I>
                            </div>
                            <div class="form-group form-inline address-holder1 col-sm-2">
                                <label for="rating3" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-" required name="rating3" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating3) ? $rating3 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                                <I> (Vocabulary, Voice Projection)</I>
                                <I> (Diction, Self-Expression)</I>
                            </div>
                            <div class="form-group form-inline address-holder1 col-sm-2">
                                <label for="rating2" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-" required name="rating2" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating2) ? $rating2 : '' ?>">
                            </div>
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="rating" class="control-label ">d. PERSONALITY</label>
                                <I>(Energy/Alertness/Iniative, Integrity/Honesty)</I>
                                <I>(Self Confidence, Decisiveness)</I>
                                <I>(Stress Tolerance, Interpersonal Sensitivity)</I>
                            </div>
                            <div class="form-group form-inline address-holder1 col-sm-2">
                                <label for="rating4" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-" required name="rating4" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating4) ? $rating4 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder1 col-sm-12">
                                <label for="comment" class="control-label ">COMMENTS</label>
                                <textarea rows="2" class="form-control" name="comment" placeholder="COMMENTS" value="<?php echo isset($comment) ? $comment : '' ?>"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="interview" class="control-label ">Interviewed By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="interview" required placeholder="INTERVIEWED BY" name="interview" value="<?php echo isset($interview) ? $interview : '' ?>">
                            </div>
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="position1" class="control-label " style="display: block; text-align: center;">Position:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="position1" required placeholder="POSITION" name="position1" value="<?php echo isset($position1) ? $position1 : '' ?>">
                            </div>
                            <div class="form-group address-holder1 col-sm-4">
                                <label for="date1" class="control-label " style="display: block; text-align: center;">Date:</label>
                                <input type="date" style="display: block; text-align: center;" required class="form-control form-control-sm rounded-0" id="date1" name="date1" value="date1">
                            </div>
                        </div><br><br>
                        <div class="toggle2 accordion hover" id="change2" value="6" style="padding: 5px;text-align: center; border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">

                            <p class="h5"><b>III - Final Interview</b></I>
                        </div>
                        <!-- <div class="toggle3" style="position:fixed;">
                            <p class="h5"><b>III - Final Interview</b></I>
                        </div> -->
                        <div class="row">
                            <div class="form-group address-holder2 col-sm-4">
                                <label for="rating" class="control-label ">a. APPEARANCE</label>
                            </div>
                            <div class="form-group form-inline address-holder2 col-sm-2">
                                <label for="rating5" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" required name="rating5" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating5) ? $rating5 : '' ?>">
                            </div>
                            <div class="form-group address-holder2 col-sm-4">
                                <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                            </div>
                            <div class="form-group form-inline address-holder2 col-sm-2">
                                <label for="rating7" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" required name="rating7" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating7) ? $rating7 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder2 col-sm-4">
                                <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                            </div>
                            <div class="form-group address-holder2 form-inline  col-sm-2">
                                <label for="rating6" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" required name="rating6" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating6) ? $rating6 : '' ?>">
                            </div>
                            <div class="form-group address-holder2 col-sm-4">
                                <label for="rating" class="control-label ">d. PERSONALITY</label>
                            </div>
                            <div class="form-group form-inline address-holder2 col-sm-2">
                                <label for="rating8" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" required name="rating8" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating8) ? $rating8 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group address-holder2 col-sm-12">
                                <label for="comment1" class="control-label ">COMMENTS</label>
                                <textarea rows="2" class="form-control textarea" name="comment1" required placeholder="COMMENTS" value="<?php echo isset($comment1) ? $comment1 : '' ?>" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row address-holder2">
                            <div class="form-group  col-sm-4">
                                <label for="interview1" class="control-label ">Interviewed By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" required placeholder="INTERVIEWED BY" id="interview1" name="interview1" value="<?php echo isset($interview1) ? $interview1 : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="position2" class="control-label " style="display: block; text-align: center;">Position:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" required id="position2" placeholder="POSITION" name="position2" value="<?php echo isset($position2) ? $position2 : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="date2" class="control-label " style="display: block; text-align: center;">Date:</label>
                                <input type="date" style="display: block; text-align: center;" required class="form-control form-control-sm rounded-0" id="date2" name="date2" value="date2">
                            </div>
                        </div>
                        <!-- <div class="form-group form-inline "><b>Add ons (Optional)</b>
                            <label class="switch">
                                <input class="toggle" id="enabler"  name="enabler" type="checkbox" />
                                <span class="slider round"></span>
                            </label>
                        </div> -->
                        <br><br>
                        <div class="address-holder2">

                            <p><b>If applicant is qualified, do you consider him/her :</b></p>
                        </div>

                        <div class="row address-holder2">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input class="form-control" type="radio" id="customRadio5" name="choice" <?php if ((isset($choice) ? $choice : '')  == 1) { ?> checked <?php } ?> value="1">
                                    <label for="customRadio5" class="control-label" style="display: block; text-align: center;">First Choice</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input class="form-control" type="radio" id="customRadio4" name="choice" <?php if ((isset($choice) ? $choice : '') == 2) { ?> checked <?php } ?>value="2">
                                    <label for="customRadio4" class="control-label" style="display: block; text-align: center;">Second Choice</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input class="form-control" type="radio" id="customRadio3" name="choice" <?php if ((isset($choice) ? $choice : '') == 3) { ?> checked <?php } ?>value="3">
                                    <label for="customRadio3" class="control-label" style="display: block; text-align: center;">Third Choice</label>
                                </div>
                            </div>


                        </div>
                        <div class="card-header text-center">
                        </div><br>
                        <i>To be filled-up by Human Resource Department</i><br>
                        <br>
                        <div class="row">
                            <div class="form-group form-inline col-sm-4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="commencement" class="control-label " required style="display: block; text-align: center;">Date Commencement :</label>
                                <input type="date" class="form-control  form-control-sm rounded-0" placeholder="DATE COMMENCEMENT" id="commencement" name="commencement" value="commencement">
                            </div>
                            <div class="form-group form-inline col-sm-4">
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="noted" class="control-label form-inline " style="display: block; text-align: center;">Noted By:</label>
                                <input type="text" class="form-control  form-control-sm rounded-0" id="noted" placeholder="NOTED BY" name="noted" value="<?php echo isset($noted) ? $noted : '' ?>">
                                <I style="display: block; text-align: center;">HR Dept.</I>
                            </div>
                            <div class="form-group col-sm-4">

                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="approve" class="control-label form-inline " style="display: block; text-align: center;">Approved By:</label>
                                <input type="text" class="form-control  form-control-sm rounded-0" id="approve" name="approve" placeholder="APPROVED BY" value="<?php echo isset($approve) ? $approve : '' ?>">
                                <I style="display: block; text-align: center;">Department Section Head / Manager</I>
                            </div>
                        </div>

                </div>


                </fieldset>

        </div>

        </form>

    </div>

</div>
<div class="card-footer text-center">
    <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Save</button>
    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Cancel</a>
</div>
</div>
<script src="<?php echo base_url ?>dist/js/hr_assessment.js"></script>