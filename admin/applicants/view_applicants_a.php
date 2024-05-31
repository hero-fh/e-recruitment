<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname FROM applicants where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<link rel="stylesheet" href="<?php echo base_url ?>dist/css/view_client.css">
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
} else {
    $query = $conn->query("SELECT a.*,concat(c.surname,', ',c.firstname,' ',c.middlename) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
    $countrow = $query->num_rows;
    if ($countrow == 1) {
        if (isset($_GET['id'])) {
            $qry = $conn->query("SELECT a.*,concat(c.surname,',  ',c.firstname,' ',c.middlename) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
            if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                    $$k = $v;
                }
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
        }
    }
}
date_default_timezone_set('Asia/Manila');
?>


<div class="card card-outline card-primary">
    <div class="toggle accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
        <p class="h5"><b>Applicant Information</b></P>
    </div>
    <div class="personal">
        <div class="card-body">
            <div class="container-fluid" id="print_out">
                <legend class="">Personal Information</legend>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Last Name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($surname) ? $surname : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">First Name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($firstname) ? $firstname : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Middle Name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($middlename) ? $middlename : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="surname" class="control-label ">Nickname</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($nickname) ? $nickname : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="firstname" class="control-label ">Birthdate</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($birthdate) ? date("m/d/Y", strtotime($birthdate)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="middlename" class="control-label ">Age</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($age) ? $age : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="middlename" class="control-label ">Mobile Number</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($mobile_number) ? $mobile_number : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="surname" class="control-label ">Permanent Address</label>
                        <textarea type="text" class="form-control  rounded-0" readonly><?php echo isset($permanent_address) ? $permanent_address : 'N/A' ?></textarea>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="surname" class="control-label ">Current Address</label>
                        <input type="text" class="form-control  rounded-0" readonly value="<?php echo $current_address, ' ', $barangay, ' ', $city, ', ', $province ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Zip Code</label>
                        <input type="text" class="form-control  rounded-0" readonly value="<?php echo $zip ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="middlename" class="control-label ">Email Address</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($email) ? $email : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="surname" class="control-label ">Facebok Account</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($fb) ? $fb : 'N/A' ?>" readonly>
                    </div>
                </div>




                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Contact Person Name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($contact_person) ? $contact_person : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Contact Number</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($contact_person_number) ? $contact_person_number : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Relationship</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($relationship) ? $relationship : 'N/A' ?>" readonly>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="surname" class="control-label ">Highest Educational Attainment</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($education) ? $education : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="surname" class="control-label ">Course</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($course) ? $course : 'N/A' ?>" readonly>
                    </div>
                </div>

                <h4 class="form-group">Work Experience</h4><br>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Position</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($position) ? $position : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Name of Company</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($company) ? $company : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="surname" class="control-label ">Duration</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($duration) ? $duration : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="surname" class="control-label ">Reason for Resignation</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($reason) ? $reason : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="surname" class="control-label ">Contact Person in Previous Work</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($last_contact_person) ? $last_contact_person : 'N/A' ?>" readonly>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="card card-outline card-primary">
    <div class="toggle1 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
        <p class="h5"><b>Assessment Form</b></P>
    </div>
    <!-- <div class="toggle1 accordion" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
        <p class="h5"><b>Assessment Form</b></P>
    </div> -->
    <div class="assess">
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

            // $initial = $conn->query("SELECT decide FROM  `assessment` where id='{$_GET['id']}'")->fetch_array()[0];
            // $initial = $countrow > 0 ? $initial = $conn->query("SELECT decide FROM  `assessment` where id='{$_GET['id']}'")->fetch_array()[0] : '';
            $score1 = $conn->query("SELECT SUM(score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score2 = $conn->query("SELECT SUM(test2) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score3 = $score1 + $score2;
            $total = $conn->query("SELECT SUM(total_score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
            $score = ($score3 / $total) * 100;
            $score = $score > 0 ? $score : 0;
            $passed = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
            if ($passed[0] == 1) {
                $pass = 'Passed';
            } else {
                $pass = 'Failed';
            }
            $app = $conn->query("SELECT `position_name` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array()[0];
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
                    $initial = $conn->query("SELECT decide FROM  `assessment` where id='{$_GET['id']}'")->fetch_array()[0];
                    $score1 = $conn->query("SELECT SUM(score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
                    $score2 = $conn->query("SELECT SUM(test2) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
                    $score3 = $score1 + $score2;
                    $total = $conn->query("SELECT SUM(total_score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
                    $score = ($score3 / $total) * 100;
                    $score = $score > 0 ? $score : 0;
                    $passed = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
                    if ($passed[0] == 1) {
                        $pass = 'Passed';
                    } else {
                        $pass = 'Failed';
                    }
                    $app = $conn->query("SELECT `position_name` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array()[0];
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
                    $score3 = $score1 + $score2;
                    $total = $conn->query("SELECT SUM(total_score) FROM  `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];
                    $score = ($score3 / $total) * 100;
                    $score = $score > 0 ? $score : 0;
                    $passed = $conn->query("SELECT passed FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
                    if ($passed[0] == 1) {
                        $pass = 'Passed';
                    } else {
                        $pass = 'Failed';
                    }
                    $app = $conn->query("SELECT `position_name` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array()[0];
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
        $aid = $conn->query("SELECT `application` FROM `applicants` where id='{$_GET['id']}'")->fetch_array()[0];
        $cid = $conn->query("SELECT `category_id` FROM `applicant_score` where applicant_id='{$_GET['id']}'")->fetch_array()[0];

        $total_points = $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$cid}'")->fetch_array()[0];

        // $total_score =  $conn->query("SELECT SUM(q.points) FROM  `question_list` q inner join `exam_list` e on q.exam_id = e.id inner join `category_list` c on c.id=e.category_id where c.status=1 and e.status=1 and c.id = '{$cid}'")->fetch_array()[0];

        // default time zone
        date_default_timezone_set('Asia/Manila');
        ?>


        <div class="card-body">
            <div class="container-fluid">
                <style>
                    input[type="date"]::-webkit-calendar-picker-indicator {
                        background: transparent;
                        bottom: 0;
                        color: transparent;
                        cursor: pointer;
                        height: auto;
                        left: 0;
                        position: absolute;
                        right: 0;
                        top: 0;
                        width: auto;
                    }
                </style>
                <form action="" id="client-form1" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="col-md-12">
                        <fieldset class="border-bottom border-info">
                            <legend class="">Personal Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label ">Name : </label>
                                    <input type="text" class="form-control form-control-sm rounded-0" id="name" name="name" value="<?php echo isset($fullname) ? $fullname : '' ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                    <input type="date" max="<?php echo date("Y-m-d") ?>" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date" name="date" value="<?php echo isset($date) ? $date : '' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="a_position" class="control-label ">Position :</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" required id="a_position" name="a_position" placeholder="Position" value="<?php echo isset($a_position) ? $a_position : $app ?>">
                                </div>
                                <div class="form-group col-md-4">
                                </div>
                                <div class="form-group col-md-4">
                                </div>

                            </div>
                            <br>
                            <!-- for qualifying exam -->
                            <div class="position-relative <?php echo isset($conducted_by) ? 'quali' : '' ?>">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <?php if (($total == $total_points) && ($aid != 1 && $aid != 3)) { ?>
                                        <div class="ribbon bg-warning text-xl">
                                            <?php echo 'Check Test II'; ?>
                                        </div>
                                    <?php } else { ?>
                                        <?php if ($pass == 'Failed') { ?>
                                            <div class="ribbon bg-danger text-xl">
                                                <?php echo $pass; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($pass == 'Passed') { ?>
                                            <div class="ribbon bg-success text-xl">
                                                <?php echo $pass; ?>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>


                                <div id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-top: 1px solid black; ">
                                    <label class="h5">I - Qualifying Exam</label>
                                </div>
                                <div class="row ">
                                    <div class="form-group  col-sm-4">
                                        <label for="rating" class="control-label ">Exam Rating</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" disabled required id="rating" value="<?php echo isset($score) ?  (number_format($score, 2)) . '%'  : 'N/A' ?>">
                                        <input type="hidden" class="form-control form-control-sm rounded-0" name="rating" value="<?php echo isset($score) ?  (number_format($score, 2))  : 'N/A' ?>">
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <label for="a_remarks" class="control-label ">Remarks</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" disabled required id="a_remarks" placeholder="REMARKS" name="a_remarks" value="<?php echo isset($pass) ? $pass : 'N/A' ?>">
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <label for="conducted_by" class="control-label ">Conducted By:</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" required id="conducted_by" placeholder="CONDUCTED BY" name="conducted_by" value="<?php echo isset($conducted_by) ? $conducted_by : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <?php if ($passed[0] == 1) { ?>
                                <div class="position-relative <?php echo isset($initial) ? 'quali' : '' ?>">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <?php if (isset($initial) && $initial == 2) { ?>
                                            <div class="ribbon bg-danger text-xl">
                                                <?php echo 'Failed'; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($initial) && $initial == 1) { ?>
                                            <div class="ribbon bg-success text-xl">
                                                <?php echo 'Passed'; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- for hr interview -->
                                    <p class="h5 login-box-msg " style="padding: 5px;text-align: center;border: 0;border-top: 1px solid black; "><b><i>Interview Rating Scale</i></b></P>
                                    <br>
                                    <div style="text-align: center;"><I>Instruction : From scale of 1 - 10 (with 10 as the highest and 1 as the lowest) rate each item based on your observation during the interview.</I><br><br>
                                    </div>
                                    <div id="change1" value="4" style="padding: 5px;text-align: center;border: 0;">
                                        <label class="h5">II - Preliminary Interview</label>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-sm-4 ">
                                            <label for="rating" class="control-label ">a. APPEARANCE</label>
                                            <I> (Manner of Dressing, Posture/Poise)</I>
                                        </div>
                                        <div class="form-group form-inline col-sm-2">
                                            <label for="rating1" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-" required name="rating1" min="1" max="10" value="<?php echo isset($rating1) ? $rating1 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                                            <I>(Knowledgeability, Competence, Judgement, Analytical Ability)</I>
                                        </div>
                                        <div class="form-group form-inline col-sm-2">
                                            <label for="rating3" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-" required name="rating3" min="1" max="10" value="<?php echo isset($rating3) ? $rating3 : '' ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                                            <I> (Vocabulary, Voice Projection)</I>
                                            <I> (Diction, Self-Expression)</I>
                                        </div>
                                        <div class="form-group form-inline col-sm-2">
                                            <label for="rating2" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-" required name="rating2" min="1" max="10" value="<?php echo isset($rating2) ? $rating2 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="rating" class="control-label ">d. PERSONALITY</label>
                                            <I>(Energy/Alertness/Iniative, Integrity/Honesty)</I>
                                            <I>(Self Confidence, Decisiveness)</I>
                                            <I>(Stress Tolerance, Interpersonal Sensitivity)</I>
                                        </div>
                                        <div class="form-group form-inline col-sm-2">
                                            <label for="rating4" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-" required name="rating4" min="1" max="10" value="<?php echo isset($rating4) ? $rating4 : '' ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="comment" class="control-label ">COMMENTS</label>
                                            <textarea rows="2" class="form-control" required name="comment" placeholder="COMMENTS"><?php echo isset($comment) ? $comment : '' ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="interview" class="control-label ">Interviewed By:</label>
                                            <input type="text" class="form-control form-control-sm rounded-0" id="interview" required placeholder="INTERVIEWED BY" name="interview" value="<?php echo isset($interview) ? $interview : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="position1" class="control-label " style="display: block; text-align: center;">Position:</label>
                                            <input type="text" class="form-control form-control-sm rounded-0" id="position1" required placeholder="POSITION" name="position1" value="<?php echo isset($position1) ? $position1 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="date1" class="control-label " style="display: block; text-align: center;">Date:</label>
                                            <input type="date" max="<?php echo date("Y-m-d") ?>" style="display: block; text-align: center;" required class="form-control form-control-sm rounded-0" id="date1" name="date1" value="<?php echo isset($date1) ? $date1 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="decide" class="control-label">Remarks</label>
                                            <small><i class="text-info">If the applicant pass the exam</i></small>
                                            <select name="decide" required id="decide" class="form-control  form-control-sm rounded-0">
                                                <option value="">---Choose---</option>
                                                <option <?php echo isset($decide) && $decide == 1 ? 'selected' : '' ?> value="1">Passed</option>
                                                <option <?php echo isset($decide) && $decide == 2 ? 'selected' : '' ?> value="2">Failed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br><br>
                            <?php  } ?>
                            <?php if (isset($initial) && $initial == 1) { ?>
                                <div class="position-relative <?php echo isset($choice) ? 'quali' : '' ?>">
                                    <?php if (isset($choice)) { ?>
                                        <div class="ribbon-wrapper ribbon-xl">
                                            <?php if (isset($choice) && $choice == 4) { ?>
                                                <div class="ribbon bg-danger text-xl">
                                                    <?php echo 'Failed'; ?>
                                                </div>
                                            <?php } ?>
                                            <?php if (isset($choice) && $choice < 4 && $choice > 0) { ?>
                                                <div class="ribbon bg-success text-xl">
                                                    <?php echo 'Passed'; ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <!-- for Department Section Head / Manager -->
                                    <div id="change2" value="6" style="padding: 5px;text-align: center;border: 0;border-top: 1px solid black; ">
                                        <label class="h5">III - Final Interview</label>
                                    </div>
                                    <div class="row">
                                        <div class="form-group  col-sm-4">
                                            <label for="rating" class="control-label ">a. APPEARANCE</label>
                                        </div>
                                        <div class="form-group form-inline  col-sm-2">
                                            <label for="rating5" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-0" required name="rating5" min="1" max="10" value="<?php echo isset($rating5) ? $rating5 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                                        </div>
                                        <div class="form-group form-inline  col-sm-2">
                                            <label for="rating7" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-0" required name="rating7" min="1" max="10" value="<?php echo isset($rating7) ? $rating7 : '' ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group  col-sm-4">
                                            <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                                        </div>
                                        <div class="form-group form-inline  col-sm-2">
                                            <label for="rating6" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-0" required name="rating6" min="1" max="10" value="<?php echo isset($rating6) ? $rating6 : '' ?>">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="rating" class="control-label ">d. PERSONALITY</label>
                                        </div>
                                        <div class="form-group form-inline col-sm-2">
                                            <label for="rating8" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                            <input type="number" class="form-control form-control-sm rounded-0" required name="rating8" min="1" max="10" value="<?php echo isset($rating8) ? $rating8 : '' ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="comment1" class="control-label ">COMMENTS</label>
                                            <textarea rows="2" class="form-control" required name="comment1" placeholder="COMMENTS" placeholder="Comment"><?php echo isset($comment1) ? $comment1 : '' ?></textarea>
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
                                            <input type="date" max="<?php echo date("Y-m-d") ?>" style="display: block; text-align: center;" required class="form-control form-control-sm rounded-0" id="date2" name="date2" value="<?php echo isset($date2) ? $date2 : '' ?>">
                                        </div>

                                    </div>
                                    <br><br>
                                    <div class="address-holder2">

                                        <p><b>If applicant is qualified, do you consider him/her :</b></p>
                                    </div>

                                    <div class="row address-holder2">
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <input class="form-control" type="radio" id="customRadio5" name="choice" <?php if ((isset($choice) ? $choice : '')  == 1) { ?> checked <?php } ?> value="1">
                                                <label for="customRadio5" class="control-label" style="display: block; text-align: center;">First Choice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <input class="form-control" type="radio" id="customRadio4" name="choice" <?php if ((isset($choice) ? $choice : '') == 2) { ?> checked <?php } ?>value="2">
                                                <label for="customRadio4" class="control-label" style="display: block; text-align: center;">Second Choice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <input class="form-control" type="radio" id="customRadio3" name="choice" <?php if ((isset($choice) ? $choice : '') == 3) { ?> checked <?php } ?>value="3">
                                                <label for="customRadio3" class="control-label" style="display: block; text-align: center;">Third Choice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <input class="form-control" type="radio" id="customRadio2" name="choice" <?php if ((isset($choice) ? $choice : '') == 4) { ?> checked <?php } ?>value="4">
                                                <label for="customRadio2" class="control-label" style="display: block; text-align: center;">Failed</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-header text-center">
                                    </div><br>
                                </div>
                            <?php  } ?>
                            <?php if (isset($choice) && $choice != 4 && $choice < 4 && $choice > 0) { ?>
                                <i>To be filled-up by Human Resource Department</i><br>
                                <br>
                                <div class="row">
                                    <div class="form-group form-inline col-sm-4">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="commencement" class="control-label " required style="display: block; text-align: center;">Date Commencement :</label>
                                        <input type="date" max="<?php echo date("Y-m-d") ?>" class="form-control  form-control-sm rounded-0" placeholder="DATE COMMENCEMENT" id="commencement" name="commencement" value="<?php echo isset($commencement) ? $commencement : '' ?>">
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
                            <?php  } ?>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center" <?php echo (isset($passed[0]) && $passed[0] == 2) || (isset($initial) && $initial == 2) || (isset($choice) && $choice == 4) ? 'style="display: none;"' : '' ?>>
                <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form1">Save</button>
                <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Cancel</a>
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-primary">
    <?php if ((isset($pdf) ? $pdf : 'N/A') == 0) { ?>

        <!-- <a href="<?php echo base_url . "admin?page=applicants/add_req&id=" .  $id ?>"> -->
        <div class="toggle3 accordion hover" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
            <p class="h5 add_requirement"><b>Add Requirements</b></P>
        </div>
        <div class="requirement1">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="client-form" enctype="multipart/form-data">
                        <input type="hidden" name="applicant_id" value="<?php echo isset($id) ? $id : 'N/A' ?>">
                        <div class="col-md-12">
                            <fieldset class="border-bottom border-info">
                                <legend class="">Upload Requirement</legend>
                                <div class="row">
                                    <!-- for passing requirement -->
                                    <div class="form-group col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" accept=".pdf" onchange="displayImg(this,$(this))">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Upload</button>
                <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Cancel</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="toggle2 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
            <p class="h5"><b>Applicant Requirements</b></P>
        </div>
    <?php } ?>
    <div class="requirement">
        <div class="card-body">
            <div class="container-fluid">

                <table class="table">
                    <colgroup>
                        <col width="10%">
                        <col width="20%">
                        <col width="50%">
                        <col width="20%">

                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Uploaded</th>
                            <th>File Name</th>
                            <th class="text-center">Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $act = $conn->query("SELECT * FROM users where id = " . $_settings->userdata('id'));
                        while ($ive = $act->fetch_assoc()) :
                            $i = 1;
                            $qry = $conn->query("SELECT *  from `requirements` where applicant_id = '{$_GET['id']}'");
                            while ($row = $qry->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td class="text-left"><?php echo $i++; ?></td>
                                    <td class="text-left"><?php echo date("m-d-Y", strtotime($row['date_passed'])) ?></td>
                                    <td><?php echo ucwords($row['file_name']) ?></td>

                                    <td class="text-right py-0 text-center">
                                        <div class="btn-group btn-group-sm img-item">
                                            <a href="javascript:void(0)" style="display: block; text-align: center;" class="btn btn-info view_req" data-id="<?php echo $row['id'] ?>"><span class="fas fa-eye"></span></a>
                                            <a class="btn btn-danger delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash"></span></a>

                                        </div>
                                    </td>


                                </tr>
                            <?php endwhile; ?>
                        <?php endwhile; ?>

                    </tbody>
                </table>
                <form action="" id="client-form" enctype="multipart/form-data">
                    <input type="hidden" name="applicant_id" value="<?php echo isset($id) ? $id : 'N/A' ?>">
                    <div class="col-md-12">
                        <fieldset class="border-bottom border-info">
                            <legend class="">Upload Requirement</legend>
                            <div class="row">

                                <!-- for passing requirement -->
                                <div class="form-group col-sm-12">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" accept=".pdf" onchange="displayImg(this,$(this))">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Upload</button>
            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Cancel</a>
        </div>
    </div>
</div>
<div class="card-footer text-center">
    <!-- <button class="btn btn-flat btn-sn btn-primary" type="button" id="print"><i class="fa fa-print"></i> Print</button> -->
    <!-- <a class="btn btn-flat btn-sn btn-primary" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>"><i class="fa fa-edit"></i> Edit</a> -->
    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Back to List</a>
</div>


<script>
    $(".personal").hide();
    $('.toggle').click(function() {
        $(".personal").slideToggle("slow");
    });
    $(".requirement").hide();
    $('.toggle2').click(function() {
        $(".requirement").slideToggle("slow");
    });
    $(".requirement1").hide();
    $('.toggle3').click(function() {
        $(".requirement1").slideToggle("slow");
    });
    $(".assess").hide();
    $('.toggle1').click(function() {
        $(".assess").slideToggle("slow");
    });
    // modal for applicant requirements
    $(document).ready(function() {
        $('.view_req').click(function() {
            uni_modal('', "uploads/index.php?id=" + $(this).attr('data-id'), 'large')
        })
        $('.delete_data').click(function() {
            _conf("Are you sure to delete this File permanently?", "delete_product", [$(this).attr('data-id')])
        })
    })
    // $(document).ready(function() {
    //     $('#customFile').on('change', function() {
    //         var file = this.files[0];
    //         var maxSize = 10 * 1024 * 1024; // 10MB
    //         // var maxSize = 1; // 10MB

    //         if (file.size > maxSize) {
    //             alert("File size exceeds the limit. Please upload a file size less than 10MB.");
    //             // Clear the file input if desired
    //             $('#customFile').val('');
    //         }
    //     });
    // });

    function delete_product($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_file",
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
    // responsible for displaying the chosen file to upload
    function displayImg(input, _this) {
        console.log(input.files)
        var fnames = []
        Object.keys(input.files).map(k => {
            fnames.push(input.files[k].name)
        })
        _this.siblings('.custom-file-label').html(JSON.stringify(fnames))

    }
    //condition for accepting specific type of files
    $("#file").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
            alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
            $("#file").val('');
            return false;
        }
    });
    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })
        // client form fucntion
        $('#client-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=upload",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Requirements successfully uploaded", 'success')
                        setTimeout(function() {
                            // location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
                            location.reload()
                        }, 1000)

                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        end_loader()
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })

    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name)
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
            _this.siblings('label').text('Choose file')
        }
    }
</script>