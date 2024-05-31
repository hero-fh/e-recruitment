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
<!-- <link rel="stylesheet" href="<?php echo base_url ?>dist/css/view_client.css"> -->
<style>
    .check {
        width: 50px;
        height: 50px;
        position: absolute;
        opacity: 0;
    }

    .path1 {
        stroke-dasharray: 400;
        stroke-dashoffset: 400;
        transition: .5s all;
    }

    .path2 {
        stroke-dasharray: 1800;
        stroke-dashoffset: 1800;
        transition: .5s all;
    }

    .check:checked+label svg g path {
        stroke-dashoffset: 0;
    }
</style>
<noscript>
    <!-- <link rel="stylesheet" href="<?php echo base_url ?>dist/css/view_client.css"> -->
    <style>
        .page-break {
            page-break-before: always;
        }

        .check {
            width: 50px;
            height: 50px;
            position: absolute;
            opacity: 0;
        }

        .path1 {
            stroke-dasharray: 400;
            stroke-dashoffset: 400;
            transition: .5s all;
        }

        .path2 {
            stroke-dasharray: 1800;
            stroke-dashoffset: 1800;
            transition: .5s all;
        }

        .check:checked+label svg g path {
            stroke-dashoffset: 0;
        }
    </style>
</noscript>
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
                        <label class="control-label ">Last name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($surname) ? ucwords(strtolower($surname)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">First name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($firstname) ? ucwords(strtolower($firstname)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Middle name</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($middlename) ? ucwords(strtolower($middlename)) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label ">Nickname</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($nickname) ? ucwords(strtolower($nickname)) : 'N/A' ?>" readonly>
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
                        <label for="middlename" class="control-label ">Mobile number</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($mobile_number) ? $mobile_number : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label class="control-label ">Permanent address</label>
                        <!-- <textarea type="text" class="form-control  rounded-0" readonly><?php echo isset($permanent_address) ? $permanent_address : 'N/A' ?></textarea> -->
                        <?php if ($perma_barangay != '') { ?>
                            <input type="text" class="form-control  rounded-0" readonly value="<?php echo ucwords(strtolower($permanent_address)), ' ', $perma_barangay, ' ', $perma_city, ', ', $perma_province, ', ', $perma_region ?>">
                        <?php } else { ?>
                            <input type="text" class="form-control  rounded-0" readonly value="<?php echo ucwords(strtolower($current_address)), ' ', $barangay, ' ', $city, ', ', $province, ', ', $region ?>">
                        <?php } ?>
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="control-label ">Zip code</label>
                        <?php if ($perma_zip != '') { ?>
                            <input type="text" class="form-control  rounded-0" readonly value="<?php echo $perma_zip ?>">
                        <?php } else { ?>
                            <input type="text" class="form-control  rounded-0" readonly value="<?php echo $zip ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label class="control-label ">Current address</label>
                        <input type="text" class="form-control  rounded-0" readonly value="<?php echo ucwords(strtolower($current_address)), ' ', $barangay, ' ', $city, ', ', $province, ', ', $region ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Zip code</label>
                        <input type="text" class="form-control  rounded-0" readonly value="<?php echo $zip ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label class="control-label ">Gender</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($gender) ? $gender : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="firstname" class="control-label ">Height</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($height) ? $height : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="middlename" class="control-label ">Weight</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($weight) ? $weight : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="middlename" class="control-label ">Religion</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($religion) ? ucwords(strtolower($religion)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="middlename" class="control-label ">Dialect spoken</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($dialect_spoken) ? ucwords(strtolower($dialect_spoken)) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="form-group col-sm-3">
                        <label class="control-label ">Ambition</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($ambition) ? $ambition : 'N/A' ?>" readonly>
                    </div> -->
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Hobbies/Sports</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($hobbies) ? ucwords(strtolower($hobbies)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Talent/Skills</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($talent) ? ucwords(strtolower($talent)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Email address</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($email) ? $email : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-sm-12">
                        <label class="control-label ">Facebok account</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($fb) ? strtolower($fb) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <legend class="">Government ID's</legend>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Driver's license</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($license) ? $license : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Philhealth #</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($philhealth) ? $philhealth : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Tin #</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($tin) ? $tin : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">SSS #</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($sss) ? $sss : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="firstname" class="control-label ">With existing loan</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($sssloan) && $sssloan == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Pag-Ibig #</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($pagibig) ? $pagibig : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="firstname" class="control-label ">With existing loan</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($pagibigloan)  && $pagibigloan == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>
                </div>
                <legend class="">Civil Information</legend>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Civil status</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($civil_status) ? $civil_status : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Children/Ages</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($children) ? $children : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Who takes care of children</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($caretaker) ? $caretaker : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Name of spouse</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($spouse) ? $spouse : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Occupation</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($occupation1) ? $occupation1 : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Age</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($age1) ? $age1 : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Father</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($father) ? ucwords(strtolower($father)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Occupation</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($occupation2) ? ucwords(strtolower($occupation2)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Age</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($age2) ? $age2 : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Mother</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($mother) ? ucwords(strtolower($mother)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Occupation</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($occupation3) ? ucwords(strtolower($occupation3)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Age</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($age3) ? $age3 : 'N/A' ?>" readonly>
                    </div>
                </div>
                <?php
                $options = $conn->query("SELECT * FROM `sibling` where `applicant_id` = '{$_GET['id']}' and sibling_name != '' ");
                while ($row = $options->fetch_assoc()) :
                ?>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Sibling</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['sibling_name']) ? ucwords(strtolower($row['sibling_name'])) : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Occupation</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['sibling_occupation']) ? ucwords(strtolower($row['sibling_occupation'])) : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Age</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['sibling_age']) ? $row['sibling_age'] : 'N/A' ?>" readonly>
                        </div>

                    </div>
                <?php endwhile; ?>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Contact person in case of emergency</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($contact_person) ? ucwords(strtolower($contact_person)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstname" class="control-label ">Contact number</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($contact_person_number) ? $contact_person_number : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="middlename" class="control-label ">Relationship</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($relationship) ? ucwords(strtolower($relationship)) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="control-label ">Email address</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($gap) ? ucwords(strtolower($gap)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="firstname" class="control-label ">Relatives/Friends working at TSPI</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($relative) ? ucwords(strtolower($relative)) : 'N/A' ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="control-label ">Medical history</label>
                        <input type="text" class="form-control  rounded-0" readonly value="<?php echo isset($medical) ? html_entity_decode($medical) : 'N/A' ?>">
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="shifting_schedule" class="control-label" style="display: block; text-align: center;">Can you render overtime/shifting schedule<b style="color:#FF0000" ;>*</b></label>
                            <div class="input-group justify-content-center">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text  ">YES</span>
                                </div>
                                <input type="radio" required id="shifting_schedule2" class="form-control form-control-sm col-md-1 mr-5" disabled readonly <?php echo isset($shifting_schedule) && $shifting_schedule == 1 ? 'checked disabled' : '' ?>>
                                <div class="input-group-prepend">
                                    <span class="input-group-text ">NO</span>
                                </div>
                                <input type="radio" required id="shifting_schedule1" class="form-control form-control-sm col-md-1" disabled readonly <?php echo isset($shifting_schedule) && $shifting_schedule == 2 ? 'checked disabled' : '' ?>>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group col-sm-6">
                        <label class="control-label ">Render Overtime/Shifting Schedule</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($shifting_schedule) ? $shifting_schedule : 'N/A' ?>" readonly>
                    </div> -->
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label ">Covid vaccine</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($vaccine) ? ucwords(strtolower($vaccine)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">1st dose</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($firstdose) ? date("m/d/Y", strtotime($firstdose)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">2nd dose</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($seconddose) ? date("m/d/Y", strtotime($seconddose)) : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">LGU</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($lgu) ? ucwords(strtolower($lgu)) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <?php
                $options = $conn->query("SELECT * FROM `booster` where `applicant_id` = '{$_GET['id']}' and booster !=''");
                while ($row = $options->fetch_assoc()) :
                ?>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Booster</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['booster']) ? ucwords(strtolower($row['booster'])) : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Dose date</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['dose']) ? date("m/d/Y", strtotime($row['dose'])) : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">LGU</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['lgu1']) ? ucwords(strtolower($row['lgu1'])) : 'N/A' ?>" readonly>
                        </div>

                    </div>
                <?php endwhile; ?>
                <legend class="">Educational Background</legend>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="control-label ">Highest educational ettainment</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($education) ? $education : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label ">Course</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($course) ? ucwords(strtolower($course)) : 'N/A' ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="control-label ">Awards/Recognition recieved</label>
                        <textarea type="text" rows="2" class="form-control  rounded-0" readonly><?php echo  isset($award) ? $award  : 'N/A' ?></textarea>
                    </div>
                    <!-- <div class="col-md-4">

                        <div class="form-group">
                            <label for="computer_literate" class="control-label" style="display: block; text-align: center;">ARE YOU COMPUTER LITERATE<b style="color:#FF0000" ;>*</b></label>
                            <div class="input-group justify-content-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  ">YES</span>
                                </div>
                                <input type="radio" required class="form-control col-md-1 mr 1 mr-sm-5" id="computer_literate1" disabled <?php echo isset($computer_literate) && $computer_literate == 1 ? 'checked disabled' : '' ?>>
                                <div class="input-group-prepend">
                                    <span class="input-group-text ">NO</span>
                                </div>
                                <input type="radio" required class="form-control col-md-1 1-sm" id="computer_literate2" disabled <?php echo isset($computer_literate) && $computer_literate == 2 ? 'checked disabled' : '' ?>>

                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group col-sm-6">
                        <label class="control-label ">Computer Literate</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($computer_literate) ? $computer_literate : 'N/A' ?>" readonly>
                    </div> -->
                </div>
                <!-- <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label ">Transcript of Record</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($tor)  && $tor == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">SH School Diploma</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($shs_diploma)  && $shs_diploma == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">High School Diploma</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($hs_diploma)  && $hs_diploma == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label ">Form137</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($form137)  && $form137 == 1 ? 'Yes' : 'None' ?>" readonly>
                    </div>

                </div><br> -->
                <?php
                $options = $conn->query("SELECT * FROM `work_experience` where `applicant_id` = '{$_GET['id']}' and company !=''");
                ?>
                <legend class="<?php echo $options->num_rows == 0 ? 'd-none' : '' ?>">Work Experience</legend>
                <?php
                while ($row = $options->fetch_assoc()) :
                    // Create DateTime objects
                    $startDate = date_create($row['start']);
                    $endDate = date_create($row['end']);
                    // Calculate the difference in months
                    $interval = date_diff($startDate, $endDate);
                    $months = $interval->format('%m');

                    // Calculate the difference in years
                    $years = floor($months / 12);

                ?>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Name of company</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['company']) ? $row['company'] : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Company address</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['company_address']) ? $row['company_address'] : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Position</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['position']) ? $row['position'] : 'N/A' ?>" readonly>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Duration</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($months) ? $months . ' ' . 'Months' : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Reason for resignation</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['reason']) ? $row['reason'] : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label ">Contact person in previous work</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['last_contact_person']) ? $row['last_contact_person'] : 'N/A' ?>" readonly>
                        </div>

                    </div>
                <?php endwhile; ?>
                <?php
                $options = $conn->query("SELECT * FROM `training` where `applicant_id` = '{$_GET['id']}' and certificate !=''");
                ?>
                <legend class="<?php echo $options->num_rows == 0 ? 'd-none' : '' ?>">Trainings/Seminars attended</legend>
                <?php
                while ($row = $options->fetch_assoc()) :
                ?>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="control-label ">Trainings/Seminars attended</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['certificate']) ? $row['certificate'] : 'N/A' ?>" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label ">Month/Year attended</label>
                            <input type="text" class="form-control  rounded-0" value="<?php echo isset($row['year_attended']) ? date("M Y", strtotime($row['year_attended'])) : 'N/A' ?>" readonly>
                        </div>
                    </div>
                <?php endwhile; ?>


                <!-- <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="control-label ">Attendance Status/Disciplinary Actions Issued on Previous Employment</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($attendance) ? $attendance : 'N/A' ?>" readonly>
                    </div>
                </div> -->
                <!-- <legend>Vaccination</legend> -->


                <!-- <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Remarks</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($remarks) ? $remarks : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Pending Application</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($pending_application) ? $pending_application : 'N/A' ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label ">Expected Salary</label>
                        <input type="text" class="form-control  rounded-0" value="<?php echo isset($expected_salary) ? $expected_salary : 'N/A' ?>" readonly>
                    </div>
                </div> -->
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
        $check_test2 = $conn->query("SELECT id FROM `enumeration_score` where applicant_id='{$_GET['id']}'")->num_rows;
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

                    <?php
                    if (isset($recommended_pos))
                        $this_pos = $conn->query("SELECT position FROM position where position = '{$recommended_pos}'")->fetch_array() ?>
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="col-md-12">
                        <fieldset class="border-bottom border-info">
                            <legend class="">Personal Information</legend>
                            <div class="row justify-content-between">
                                <div class="form-group col-md-2">
                                    <label for="name" class="control-label ">Name: </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control  rounded-0" id="name" name="name" value="<?php echo isset($fullname) ? ucwords(strtolower($fullname)) : '' ?>" readonly>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="date" style="display: block; text-align:right" class="control-label ">Date: </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="date" max="<?php echo date("Y-m-d") ?>" style="display: block;" class="form-control  rounded-0" readonly <?php echo isset($date) ? 'readonly' : '' ?> id="date" name="date" value="<?php echo isset($date) ? $date : date('Y-m-d') ?>">
                                </div>
                            </div>
                            <!-- if (($application != 1 && $choose == 3 && $job_offer == 1)) -->
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <?php if (!isset($choose)) { ?>
                                        <label for="a_position" class="control-label ">Position:</label>
                                    <?php } else { ?>
                                        <?php if (($application != 1 && $choose == 3 && $job_offer == 1)) { ?>
                                            <label for="a_position" class="control-label ">Position:✔</label>
                                        <?php } elseif (($application != 1 && $choose == 3 && $job_offer == 2)) { ?>
                                            <label for="a_position" class="control-label ">Position:❌</label>
                                        <?php } else { ?>
                                            <label for="a_position" class="control-label ">Position:</label>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control  rounded-0" readonly id="a_position" name="a_position" placeholder="Position" value="<?php echo isset($this_pos[0]) ? $this_pos[0] : $app ?>">
                                </div>
                                <!-- <div class="form-group col-md-2">
                                    <label class="control-label">Accept job offer: </label><br>
                                </div> -->
                                <!-- <?php if (!isset($choose)) { ?>

                                <?php } else { ?>
                                    <?php if ($application != 1 && $choose == 3 && $_settings->userdata('DEPARTMENT') == 'Human Resource' && $job_offer == 0) { ?>
                                        <div class="form-group col-md-6">
                                            <button class="btn btn-flat btn-m btn-outline-success approve_data" type="button" data-id="<?php echo $id ?>" data-val="1" data-sign="1"> <i class="fas fa-thumbs-up"></i> Accept</button>
                                            <button class="btn btn-flat btn-m btn-outline-danger disapprove_data" type="button" data-id="<?php echo $id ?>" data-val="2" data-sign="1"> <i class="fas fa-thumbs-down"></i> Reject</button>
                                        </div>
                                    <?php } ?>
                                <?php } ?> -->
                            </div>
                            <br>
                            <!-- for qualifying exam -->
                            <div class="position-relative <?php echo isset($conducted_by) ? 'quali' : '' ?>">
                                <div class="ribbon-wrapper ribbon-xl" style=" pointer-events: none;">
                                    <?php if (($check_test2 == 0)) { ?>
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


                                <div id="change" value="2" style="padding: 5px;text-align: left;border: 0;border-top: 1px solid black; ">
                                    <label class="h5">I - Qualifying Exam</label>
                                </div>
                                <div class="row ">
                                    <!-- <div class="form-group  col-sm-3" style=" text-align: left;">
                                        <label class="h5">I - Qualifying Exam</label>
                                    </div> -->
                                    <div class="form-group col-sm-2">
                                        <label for="rating" class="control-label ">Exam rating:</label>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <input type="text" class="form-control  rounded-0" disabled required id="rating" value="<?php echo isset($score) ?  (number_format($score, 2)) . '%'  : 'N/A' ?>">
                                        <input type="hidden" class="form-control  rounded-0" name="rating" value="<?php echo isset($score) ?  (number_format($score, 2))  : 'N/A' ?>">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="a_remarks" class="control-label" style="display: block; text-align:right">Result:</label>
                                        <!-- <input type="text" class="form-control  rounded-0" disabled required id="a_remarks" placeholder="REMARKS" name="a_remarks" value="<?php echo isset($pass) ? $pass : 'N/A' ?>"> -->
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <!-- <label for="a_remarks" class="control-label ">Result</label> -->
                                        <input type="text" class="form-control  rounded-0" readonly required id="a_remarks" placeholder="REMARKS" name="a_remarks" value="<?php echo isset($pass) ? $pass : 'N/A' ?>">
                                    </div>

                                </div>
                                <div class="row ">
                                    <!-- <div class="form-group  col-sm-3" style=" text-align: left;">
                                        <label class="h5">I - Qualifying Exam</label>
                                    </div> -->

                                    <div class="form-group col-sm-2">
                                        <label for="conducted_by" class="control-label ">Conducted by:</label>
                                        <!-- <input type="text" class="form-control  rounded-0" readonly required id="conducted_by" placeholder="Conducted by" name="conducted_by" value="<?php echo isset($conducted_by) ? $conducted_by : $_settings->userdata('EMPNAME') ?>"> -->
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <!-- <label for="conducted_by" class="control-label ">Conducted by:</label> -->
                                        <input type="text" class="form-control  rounded-0" readonly required id="conducted_by" placeholder="Conducted by" name="conducted_by" value="<?php echo isset($conducted_by) ? $conducted_by : $_settings->userdata('EMPNAME') ?>">
                                    </div>
                                    <?php if ($_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
                                        <div class="form-group col-sm-2 text-right">
                                            <label for="conducted_by" class="control-label">PRF no:</label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select name="prf_no" id="prf_no" class="form-control rounded-0 select2" style="pointer-events: none;">
                                                <option value="" selected disabled>--Select PRF--</option>
                                                <?php
                                                $application = $conn->query("SELECT * FROM `prf_request` where `prf_status` = 2");
                                                while ($row = $application->fetch_assoc()) :
                                                ?>
                                                    <option value=" <?= $row['prf_no'] ?>" <?php echo isset($prf_no) && $prf_no == $row['prf_no'] ? 'selected' : '' ?>>PRF no: <?= $row['prf_no'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <br><br>
                            <?php if ($passed[0] == 1 && $check_test2 == 1) { ?>
                                <div class="position-relative <?php echo isset($initial) ? 'quali' : '' ?>">
                                    <div class="ribbon-wrapper ribbon-xl" style=" pointer-events: none;">
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

                                    <div style="text-align: center;"><I>Instruction : Identify and assess relevant criteria based on your observation during interview.</I><br><br>
                                    </div>
                                    <div id="change1" value="4" style="padding: 5px;border: 0;">
                                        <label class="h5">II - Initial Interview</label>
                                    </div>

                                    <?php
                                    if (isset($rating1) && isset($rating2) && isset($rating3) && isset($rating4)) {
                                        $array1 = explode(",",  $rating1);
                                        $array2 = explode(",", $rating2);
                                        $array3 = explode(",", $rating3);
                                        $array4 = explode(",", $rating4);
                                    ?>
                                        <div class="row item2">
                                            <div class="form-group col-sm-4 ">
                                                <!-- <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label> -->
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;">Ratings</u></label>
                                            </div>
                                            <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                            <div class="form-group col-sm-4">
                                                <!-- <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label> -->
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;">Ratings</label>
                                            </div>


                                        </div>
                                        <div class="row item2">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;"><u><?php echo isset($rating1) ? $rating1 : '' ?></u></label>
                                            </div>
                                            <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                            <div class="form-group col-sm-4">
                                                <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;"><u><?php echo isset($rating2) ? $rating2 : '' ?></u></label>
                                            </div>
                                            <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                        </div>
                                        <div class="row item2">
                                            <div class="form-group col-sm-4 ">
                                                <label for="" class="control-label " style=" text-align: center;">C. Job Knowledge</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style=" text-align: center;"><u><?php echo isset($rating3) ? $rating3 : '' ?></u></label>
                                            </div>
                                            <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label " style=" text-align: center;">D. Personality</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style=" text-align: center;"><u><?php echo isset($rating4) ? $rating4 : '' ?></u></label>
                                            </div>
                                            <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <!-- ----------------------------  Appearance / comm skills----------------------------------------- -->
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;">Passed</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating1" class="control-label " style=" text-align: center;">Passed</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                            </div>

                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">1.Manner of Dressing</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a1" <?php echo isset($array1[0]) &&  $array1[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array1[0]) &&  $array1[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga1" value="1">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a2" <?php echo isset($array1[0]) &&  $array1[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array1[0]) &&  $array1[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga1" value="2">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">1. Vocabulary</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b1" <?php echo isset($array2[0]) &&  $array2[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array2[0]) &&  $array2[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb1" value="1">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b2" <?php echo isset($array2[0]) &&  $array2[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array2[0]) &&  $array2[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb1" value="2">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">2.Posture/Poise</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a3" <?php echo isset($array1[1]) &&  $array1[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array1[1]) &&  $array1[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga2" value="3">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a4" <?php echo isset($array1[1]) &&  $array1[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array1[1]) &&  $array1[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga2" value="4">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">2. Voice Projection</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b3" <?php echo isset($array2[1]) &&  $array2[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array2[1]) &&  $array2[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb2" value="3">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b4" <?php echo isset($array2[1]) &&  $array2[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array2[1]) &&  $array2[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb2" value="4">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">3. Pleasing Personality</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a5" <?php echo isset($array1[2]) &&  $array1[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array1[2]) &&  $array1[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga3" value="5">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a6" <?php echo isset($array1[2]) &&  $array1[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array1[2]) &&  $array1[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga3" value="6">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">3. Diction</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b5" <?php echo isset($array2[2]) &&  $array2[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array2[2]) &&  $array2[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb3" value="5">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b6" <?php echo isset($array2[2]) &&  $array2[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array2[2]) &&  $array2[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb3" value="6">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">4. Neat</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a7" <?php echo isset($array1[3]) &&  $array1[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array1[3]) &&  $array1[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga4" value="7">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a8" <?php echo isset($array1[3]) &&  $array1[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array1[3]) &&  $array1[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga4" value="8">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">4. Self-Expression</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b7" <?php echo isset($array2[3]) &&  $array2[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array2[3]) &&  $array2[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb4" value="7">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b8" <?php echo isset($array2[3]) &&  $array2[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array2[3]) &&  $array2[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb4" value="8">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">5. Facial Expression</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a9" <?php echo isset($array1[4]) &&  $array1[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array1[4]) &&  $array1[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga5" value="9">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_a10" <?php echo isset($array1[4]) &&  $array1[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array1[4]) &&  $array1[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinga5" value="10">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">5. Relevance</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b9" <?php echo isset($array2[4]) &&  $array2[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array2[4]) &&  $array2[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb5" value="9">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_b10" <?php echo isset($array2[4]) &&  $array2[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array2[4]) &&  $array2[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingb5" value="10">
                                            </div>
                                        </div>

                                        <!-- ----------------------------  Job knowledge / Personality----------------------------------------- -->

                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="" class="control-label " style=" text-align: center;">C. Job Knowledge</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style=" text-align: center;">Passed</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style="text-align: center;">Failed</label>
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label " style=" text-align: center;">D. Personality</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style=" text-align: center;">Passed</label>
                                            </div>
                                            <div class="form-group  col-sm-1" style=" text-align: center;">
                                                <label for="" class="control-label " style="text-align: center;">Failed</label>
                                            </div>

                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">1. Knowledgeability</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c1" <?php echo isset($array3[0]) &&  $array3[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array3[0]) &&  $array3[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc1" value="1">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c2" <?php echo isset($array3[0]) &&  $array3[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array3[0]) &&  $array3[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc1" value="2">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">1. Integrity</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d1" <?php echo isset($array4[0]) &&  $array4[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array4[0]) &&  $array4[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd1" value="1">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d2" <?php echo isset($array4[0]) &&  $array4[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array4[0]) &&  $array4[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd1" value="2">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">2. Competence</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c3" <?php echo isset($array3[1]) &&  $array3[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array3[1]) &&  $array3[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc2" value="3">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c4" <?php echo isset($array3[1]) &&  $array3[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array3[1]) &&  $array3[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc2" value="4">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">2. Self-confidence</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d3" <?php echo isset($array4[1]) &&  $array4[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array4[1]) &&  $array4[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd2" value="3">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d4" <?php echo isset($array4[1]) &&  $array4[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array4[1]) &&  $array4[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd2" value="4">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">3. Judgement</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c5" <?php echo isset($array3[2]) &&  $array3[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array3[2]) &&  $array3[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc3" value="5">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c6" <?php echo isset($array3[2]) &&  $array3[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array3[2]) &&  $array3[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc3" value="6">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">3. Stress Tolerance</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d5" <?php echo isset($array4[2]) &&  $array4[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array4[2]) &&  $array4[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd3" value="5">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d6" <?php echo isset($array4[2]) &&  $array4[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array4[2]) &&  $array4[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd3" value="6">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">4. Analytical Ability</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c7" <?php echo isset($array3[3]) &&  $array3[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array3[3]) &&  $array3[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc4" value="7">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c8" <?php echo isset($array3[3]) &&  $array3[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array3[3]) &&  $array3[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc4" value="8">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">4. Interpersonal Sensitivity</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d7" <?php echo isset($array4[3]) &&  $array4[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array4[3]) &&  $array4[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd4" value="7">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d8" <?php echo isset($array4[3]) &&  $array4[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array4[3]) &&  $array4[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd4" value="8">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-sm-4 ">
                                                <label for="rating" class="control-label ">5. Specialization</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c9" <?php echo isset($array3[4]) &&  $array3[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array3[4]) &&  $array3[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingc5" value="9">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_c10" <?php echo isset($array3[4]) &&  $array3[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array3[4]) &&  $array3[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control  rounded-0 form-control-sm " required name="ratingc5" value="10">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="rating" class="control-label ">5. Decisiveness</label>
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d9" <?php echo isset($array4[4]) &&  $array4[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array4[4]) &&  $array4[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd5" value="9">
                                            </div>
                                            <div class="form-group  col-sm-1">
                                                <input type="radio" required id="<?php echo isset($array1[0]) && $array1[0] != 0 ? $id : '' ?>rating_id_d10" <?php echo isset($array4[4]) &&  $array4[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array4[4]) &&  $array4[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingd5" value="10">
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="comment" class="control-label ">Comments</label>
                                            <textarea rows="2" class="form-control notes" required name="comment" placeholder="Comments"><?php echo isset($comment) ? $comment : '' ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-2">
                                            <label for="interview" class="control-label ">Interviewed by: </label>
                                        </div>
                                        <div class="form-group col-sm-4">

                                            <input type="text" class="form-control  rounded-0" id="interview" readonly placeholder="Interviewed by" name="interview" value="<?php echo isset($interview) ? $interview : $_settings->userdata('EMPNAME') ?>">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="date1" class="control-label " style="display: block; text-align: right;">Date: </label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="date" readonly max="<?php echo date("Y-m-d") ?>" <?php echo isset($date1) ? 'readonly' : '' ?> style="display: block;" required class="form-control  rounded-0" id="date1" name="date1" value="<?php echo isset($date1) ? $date1 : date('Y-m-d') ?>">
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="form-group col-sm-2">
                                            <label for="position1" class="control-label " style="display: block; ">Position: </label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="text" class="form-control  rounded-0" id="position1" readonly placeholder="Position" name="position1" value="<?php echo isset($position1) ? $position1 : $_settings->userdata('JOB_TITLE') ?>">
                                        </div>

                                        <div class="form-group col-sm-2">
                                            <label for="decide" class="control-label" style="display: block; text-align: right;">Result: </label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input type="hidden" class="form-control  rounded-0 " id="decide" name="decide" value="<?php echo isset($decide) ? $decide : '' ?>">
                                            <input type="text" readonly class="form-control <?php echo isset($decide) ? '' : 'd-none' ?> rounded-0 " id="decide1" value="<?php echo isset($decide) && $decide == 1 ? 'Passed'  : 'Failed' ?>">
                                            <select required name="decide" class="form-control <?php echo isset($decide) ? 'd-none' : '' ?> rounded-0" id="decide">
                                                <option value="" selected disabled>--Choose--</option>
                                                <option value="1" <?php echo isset($decide) && $decide == 1 ? 'selected' : '' ?>>Passed</option>
                                                <option value="2" <?php echo isset($decide) && $decide == 2 ? 'selected' : '' ?>>Failed</option>
                                            </select>
                                        </div>
                                    </div>

                                </div><br><br>
                            <?php  } ?>
                            <?php if (isset($initial) && $initial == 1) { ?>
                                <div id="option-list2">
                                    <?php
                                    function intToRoman($num)
                                    {
                                        $romanNumerals = [
                                            3 => 'III',
                                            4 => 'IV',
                                            5 => 'V',
                                            6 => 'VI',
                                            7 => 'VII',
                                            8 => 'VIII',
                                            9 => 'IX',
                                            10 => 'X'
                                        ];

                                        return isset($romanNumerals[$num]) ? $romanNumerals[$num] : '';
                                    }

                                    $i = 3; // Start value of i
                                    $romanNumeral = intToRoman($i);
                                    // echo "Last value of i: $i" . PHP_EOL; // Access the last value of i
                                    $options1 = $conn->query("SELECT * FROM `add_interview` where `assessment_id` = '{$_GET['id']}' and rate5!=''");
                                    while ($row = $options1->fetch_assoc()) :
                                        $array5 = explode(",", $row['rate5']);
                                        $array6 = explode(",", $row['rate6']);
                                        $array7 = explode(",", $row['rate7']);
                                        $array8 = explode(",", $row['rate8']);
                                        // echo "Roman Numeral for $i: $romanNumeral" . PHP_EOL;
                                        $romanNumeral = intToRoman($i); // Calculate the next Roman numeral
                                        $i++; // Increment i
                                    ?>
                                        <div class="position-relative <?php echo isset($choose) ? 'quali' : '' ?>">
                                            <?php if (isset($row['choose'])) { ?>
                                                <div class="ribbon-wrapper ribbon-xl" style=" pointer-events: none;">
                                                    <?php if (isset($row['choose']) && $row['choose'] == 2) { ?>
                                                        <div class="ribbon bg-danger text-xl">
                                                            <?php echo 'Failed'; ?>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (isset($row['choose']) && $row['choose'] != 2) { ?>
                                                        <div class="ribbon bg-success text-xl">
                                                            <?php echo 'Passed'; ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>


                                            <div id="change2" value="6" style="padding: 5px;text-align: left;border: 0;border-top: 1px solid black; ">
                                                <label class="h5"><?php echo "$romanNumeral" ?> - Department Interview</label>
                                            </div>
                                            <!-- ----------------------------  Appearance / comm skills----------------------------------------- -->
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <!-- <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label> -->
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating1" class="control-label " style=" text-align: center;">Ratings</u></label>
                                                </div>
                                                <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                                <div class="form-group col-sm-4">
                                                    <!-- <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label> -->
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating1" class="control-label " style=" text-align: center;">Ratings</label>
                                                </div>


                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label>
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating1" class="control-label " style=" text-align: center;"><u><?php echo isset($row['rate5']) ? $row['rate5'] : '' ?></u></label>
                                                </div>
                                                <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                                <div class="form-group col-sm-4">
                                                    <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label>
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating1" class="control-label " style=" text-align: center;"><u><?php echo isset($row['rate6']) ? $row['rate6'] : '' ?></u></label>
                                                </div>
                                                <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                            </div>
                                            <!-- <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">1.Manner of Dressing</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e1" <?php echo isset($array5[0]) &&  $array5[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array5[0]) &&  $array5[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge1" value="1">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e2" <?php echo isset($array5[0]) &&  $array5[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array5[0]) &&  $array5[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge1" value="2">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">1. Vocabulary</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f1" <?php echo isset($array6[0]) &&  $array6[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array6[0]) &&  $array6[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf1" value="1">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f2" <?php echo isset($array6[0]) &&  $array6[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array6[0]) &&  $array6[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf1" value="2">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">2.Posture/Poise</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e3" <?php echo isset($array5[1]) &&  $array5[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array5[1]) &&  $array5[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge2" value="3">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e4" <?php echo isset($array5[1]) &&  $array5[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array5[1]) &&  $array5[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge2" value="4">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">2. Voice Projection</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f3" <?php echo isset($array6[1]) &&  $array6[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array6[1]) &&  $array6[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf2" value="3">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f4" <?php echo isset($array6[1]) &&  $array6[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array6[1]) &&  $array6[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf2" value="4">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">3. Pleasing Personality</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e5" <?php echo isset($array5[2]) &&  $array5[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array5[2]) &&  $array5[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge3" value="5">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e6" <?php echo isset($array5[2]) &&  $array5[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array5[2]) &&  $array5[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge3" value="6">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">3. Diction</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f5" <?php echo isset($array6[2]) &&  $array6[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array6[2]) &&  $array6[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf3" value="5">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f6" <?php echo isset($array6[2]) &&  $array6[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array6[2]) &&  $array6[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf3" value="6">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">4. Neat</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e7" <?php echo isset($array5[3]) &&  $array5[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array5[3]) &&  $array5[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge4" value="7">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e8" <?php echo isset($array5[3]) &&  $array5[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array5[3]) &&  $array5[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge4" value="8">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">4. Self-Expression</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f7" <?php echo isset($array6[3]) &&  $array6[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array6[3]) &&  $array6[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf4" value="7">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f8" <?php echo isset($array6[3]) &&  $array6[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array6[3]) &&  $array6[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf4" value="8">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">5. Facial Expression</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e9" <?php echo isset($array5[4]) &&  $array5[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array5[4]) &&  $array5[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge5" value="9">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_e10" <?php echo isset($array5[4]) &&  $array5[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array5[4]) &&  $array5[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratinge5" value="10">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">5. Relevance</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f9" <?php echo isset($array6[4]) &&  $array6[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array6[4]) &&  $array6[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf5" value="9">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_f10" <?php echo isset($array6[4]) &&  $array6[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array6[4]) &&  $array6[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingf5" value="10">
                                                </div>
                                            </div> -->

                                            <!-- ----------------------------  Job knowledge / Personality----------------------------------------- -->

                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="" class="control-label " style=" text-align: center;">C. Job Knowledge</label>
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style=" text-align: center;"><u><?php echo isset($row['rate7']) ? $row['rate7'] : '' ?></u></label>
                                                </div>
                                                <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                                <div class="form-group col-sm-4">
                                                    <label for="" class="control-label " style=" text-align: center;">D. Personality</label>
                                                </div>
                                                <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style=" text-align: center;"><u><?php echo isset($row['rate8']) ? $row['rate8'] : '' ?></u></label>
                                                </div>
                                                <!-- <div class="form-group  col-sm-1" style=" text-align: center;">
                                                    <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                </div> -->

                                            </div>
                                            <!-- <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">1. Knowledgeability</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g1" <?php echo isset($array7[0]) &&  $array7[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array7[0]) &&  $array7[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg1" value="1">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g2" <?php echo isset($array7[0]) &&  $array7[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array7[0]) &&  $array7[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg1" value="2">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">1. Integrity</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h1" <?php echo isset($array8[0]) &&  $array8[0] == 1 ? 'checked disabled' : '' ?><?php echo isset($array8[0]) &&  $array8[0] == 2 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh1" value="1">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h2" <?php echo isset($array8[0]) &&  $array8[0] == 2 ? 'checked disabled' : '' ?><?php echo isset($array8[0]) &&  $array8[0] == 1 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh1" value="2">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">2. Competence</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g3" <?php echo isset($array7[1]) &&  $array7[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array7[1]) &&  $array7[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg2" value="3">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g4" <?php echo isset($array7[1]) &&  $array7[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array7[1]) &&  $array7[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg2" value="4">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">2. Self-confidence</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h3" <?php echo isset($array8[1]) &&  $array8[1] == 3 ? 'checked disabled' : '' ?><?php echo isset($array8[1]) &&  $array8[1] == 4 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh2" value="3">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h4" <?php echo isset($array8[1]) &&  $array8[1] == 4 ? 'checked disabled' : '' ?><?php echo isset($array8[1]) &&  $array8[1] == 3 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh2" value="4">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">3. Judgement</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g5" <?php echo isset($array7[2]) &&  $array7[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array7[2]) &&  $array7[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg3" value="5">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g6" <?php echo isset($array7[2]) &&  $array7[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array7[2]) &&  $array7[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg3" value="6">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">3. Stress Tolerance</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h5" <?php echo isset($array8[2]) &&  $array8[2] == 5 ? 'checked disabled' : '' ?><?php echo isset($array8[2]) &&  $array8[2] == 6 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh3" value="5">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h6" <?php echo isset($array8[2]) &&  $array8[2] == 6 ? 'checked disabled' : '' ?><?php echo isset($array8[2]) &&  $array8[2] == 5 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh3" value="6">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">4. Analytical Ability</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g7" <?php echo isset($array7[3]) &&  $array7[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array7[3]) &&  $array7[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg4" value="7">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g8" <?php echo isset($array7[3]) &&  $array7[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array7[3]) &&  $array7[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg4" value="8">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">4. Interpersonal Sensitivity</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h7" <?php echo isset($array8[3]) &&  $array8[3] == 7 ? 'checked disabled' : '' ?><?php echo isset($array8[3]) &&  $array8[3] == 8 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh4" value="7">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h8" <?php echo isset($array8[3]) &&  $array8[3] == 8 ? 'checked disabled' : '' ?><?php echo isset($array8[3]) &&  $array8[3] == 7 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh4" value="8">
                                                </div>
                                            </div>
                                            <div class="row item2">
                                                <div class="form-group col-sm-4 ">
                                                    <label for="rating" class="control-label ">5. Specialization</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g9" <?php echo isset($array7[4]) &&  $array7[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array7[4]) &&  $array7[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingg5" value="9">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_g10" <?php echo isset($array7[4]) &&  $array7[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array7[4]) &&  $array7[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control  rounded-0 form-control-sm " required name="ratingg5" value="10">
                                                </div>

                                                <div class="form-group col-sm-4">
                                                    <label for="rating" class="control-label ">5. Decisiveness</label>
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h9" <?php echo isset($array8[4]) &&  $array8[4] == 9 ? 'checked disabled' : '' ?><?php echo isset($array8[4]) &&  $array8[4] == 10 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh5" value="9">
                                                </div>
                                                <div class="form-group  col-sm-1">
                                                    <input type="radio" required id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating_id_h10" <?php echo isset($array8[4]) &&  $array8[4] == 10 ? 'checked disabled' : '' ?><?php echo isset($array8[4]) &&  $array8[4] == 9 ? 'onclick="javascript: return false;"' : '' ?> class="form-control form-control-sm  rounded-0" required name="ratingh5" value="10">
                                                </div>
                                            </div>-->
                                            <div class="row item2">
                                                <div class="form-group col-sm-12">
                                                    <label for="comment1" class="control-label ">Comments</label>
                                                    <textarea rows="2" class="form-control notes" required name="comment1[]" placeholder="Comments" placeholder="Comment"><?php echo isset($row['com']) ? $row['com'] : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row address-holder2 item2">
                                                <div class="form-group  col-sm-2">
                                                    <label for="interview1" class="control-label ">Interviewed by:</label>
                                                </div>
                                                <div class="form-group  col-sm-4">
                                                    <?php if (empty($_settings->userdata('EMPNAME'))) { ?>
                                                        <input type="text" class="form-control  rounded-0" required placeholder="Interviewed by" id="interview1" name="interview1[]" value="<?php echo isset($row['inter']) ? $row['inter'] : '' ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control  rounded-0" required placeholder="Interviewed by" id="interview1" name="interview1[]" value="<?php echo isset($row['inter']) ? $row['inter'] : $_settings->userdata('EMPNAME') ?>">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group  col-sm-2">
                                                    <label for="date2" class="control-label " style="display: block; text-align: right;">Date:</label>
                                                </div>
                                                <div class="form-group  col-sm-4">
                                                    <input type="date" max="<?php echo date("Y-m-d") ?>" <?php echo isset($row['dat2']) ? 'readonly' : '' ?> style="display: block; " required class="form-control  rounded-0" id="date2" name="date2[]" value="<?php echo isset($row['dat2']) ? date("Y-m-d", strtotime($row['dat2'])) : '' ?>">
                                                </div>


                                            </div>
                                            <div class="row address-holder2 item2">

                                                <div class="form-group  col-sm-2">
                                                    <label for="position2" class="control-label " style="display: block; ">Position:</label>
                                                </div>
                                                <div class="form-group  col-sm-4">
                                                    <input type="text" class="form-control  rounded-0" required id="position2" placeholder="Position" name="position2[]" value="<?php echo isset($row['pos2']) ? $row['pos2'] : '' ?>">
                                                </div>
                                                <div class="form-group  col-sm-2">
                                                    <label for="date2" class="control-label " style="display: block; text-align: right;">Result:</label>
                                                </div>
                                                <div class="form-group  col-sm-4">
                                                    <input type="hidden" class="form-control rounded-0" name="choose[]" value="<?php echo isset($row['choose']) ? $row['choose'] : '' ?>">
                                                    <input type="text" class="form-control rounded-0" value="<?php echo isset($row['choose']) && $row['choose'] == 3 ? 'Passed' : 'Failed' ?>">

                                                </div>
                                            </div>
                                            <div class="row address-holder2 item2">
                                                <div class="form-group  col-sm-6">
                                                    <label for="expected" class="control-label " style="display: block; ">Expected salary:</label>
                                                    <input type="text" class="form-control  rounded-0" required id="expected" placeholder="Position" name="expected[]" value="<?php echo isset($row['expected']) ? $row['expected'] : '' ?>">
                                                </div>
                                                <div class="form-group  col-sm-6">
                                                    <label for="recommended" class="control-label " style="display: block; ">Recommended salary:</label>
                                                    <input type="text" class="form-control  rounded-0" required id="recommended" placeholder="Position" name="recommended[]" value="<?php echo isset($row['recommended']) ? $row['recommended'] : '' ?>">
                                                </div>
                                            </div><br>
                                            <div class="row address-holder2 item2">
                                                <div class="col-md-12">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary  d-inline">
                                                            <input type="checkbox" <?php echo isset($row['recommended_pos']) && $row['recommended_pos'] != '' ? 'checked disabled' : '' ?> onclick="this.checked = false;">
                                                            <label>Recommend to other position/department.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control  rounded-0" readonly id="recommended_pos" placeholder="Input recommended position / department." name="recommended_pos[]" value="<?php echo isset($row['recommended_pos']) ? $row['recommended_pos'] : '' ?>">

                                                <?php $this_pos = $conn->query("SELECT position FROM position where position = '{$row['recommended_pos']}'")->fetch_array() ?>
                                                <input type="text" class="form-control  rounded-0" readonly placeholder="Input recommended position / department." value="<?php echo isset($this_pos[0]) ? $this_pos[0] : '' ?>">

                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <input type="hidden" id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating5" name="rating5[]" value="<?php echo isset($row['rate5']) ? $row['rate5'] : '0,0,0,0,0' ?>">
                                        <input type="hidden" id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating6" name="rating6[]" value="<?php echo isset($row['rate6']) ? $row['rate6'] : '0,0,0,0,0' ?>">
                                        <input type="hidden" id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating7" name="rating7[]" value="<?php echo isset($row['rate7']) ? $row['rate7'] : '0,0,0,0,0' ?>">
                                        <input type="hidden" id="<?php echo isset($row['id']) ? $row['id'] : '' ?>rating8" name="rating8[]" value="<?php echo isset($row['rate8']) ? $row['rate8'] : '0,0,0,0,0' ?>">
                                    <?php endwhile; ?>
                                    <?php if ($options1->num_rows <= 8 && ($decide == 1 || $choose == 3) && $job_offer == 0) { ?>
                                        <div class="my-2 text-center aai">
                                            <button class="btn btn-primary btn-block-sm a_btn" id="add_option2" type="button"><i class="fa fa-plus"></i> Add Another Interviewer</button>
                                        </div>
                                    <?php } ?>
                                    <noscript id="option-clone2">
                                        <br>
                                        <div class="item2">
                                            <div id="change2" value="6" style="padding: 5px;text-align: left;border: 0;border-top: 1px solid black; ">
                                                <label class="h5">Department Interview</label>
                                            </div>
                                            <div id="option-list2">
                                                <div class="row justify-content-end align-items-end form-group">
                                                    <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option2 text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option1"><i class="fa fa-times"></i></a>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating1" class="control-label " style=" text-align: center;">A. Appearance</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="rating1" class="control-label " style=" text-align: center;">Passed</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating1" class="control-label " style=" text-align: center;">B. Communication skills</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="rating1" class="control-label " style=" text-align: center;">Passed</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="rating3" class="control-label " style="text-align: center;">Failed</label>
                                                    </div>

                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">1.Manner of Dressing</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e1" class="form-control form-control-sm  rounded-0" required name="ratinge1" value="1">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e2" class="form-control form-control-sm  rounded-0" required name="ratinge1" value="2">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">1. Vocabulary</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f1" class="form-control form-control-sm  rounded-0" required name="ratingf1" value="1">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f2" class="form-control form-control-sm  rounded-0" required name="ratingf1" value="2">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">2.Posture/Poise</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e3" class="form-control form-control-sm  rounded-0" required name="ratinge2" value="3">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e4" class="form-control form-control-sm  rounded-0" required name="ratinge2" value="4">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">2. Voice Projection</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f3" class="form-control form-control-sm  rounded-0" required name="ratingf2" value="3">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f4" class="form-control form-control-sm  rounded-0" required name="ratingf2" value="4">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">3. Pleasing Personality</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e5" class="form-control form-control-sm  rounded-0" required name="ratinge3" value="5">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e6" class="form-control form-control-sm  rounded-0" required name="ratinge3" value="6">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">3. Diction</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f5" class="form-control form-control-sm  rounded-0" required name="ratingf3" value="5">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f6" class="form-control form-control-sm  rounded-0" required name="ratingf3" value="6">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">4. Neat</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e7" class="form-control form-control-sm  rounded-0" required name="ratinge4" value="7">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e8" class="form-control form-control-sm  rounded-0" required name="ratinge4" value="8">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">4. Self-Expression</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f7" class="form-control form-control-sm  rounded-0" required name="ratingf4" value="7">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f8" class="form-control form-control-sm  rounded-0" required name="ratingf4" value="8">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">5. Facial Expression</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e9" class="form-control form-control-sm  rounded-0" required name="ratinge5" value="9">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_e10" class="form-control form-control-sm  rounded-0" required name="ratinge5" value="10">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">5. Relevance</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f9" class="form-control form-control-sm  rounded-0" required name="ratingf5" value="9">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_f10" class="form-control form-control-sm  rounded-0" required name="ratingf5" value="10">
                                                    </div>
                                                </div>

                                                <!-- ----------------------------  Job knowledge / Personality----------------------------------------- -->

                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="" class="control-label " style=" text-align: center;">C. Job Knowledge</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="" class="control-label " style=" text-align: center;">Passed</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="" class="control-label " style=" text-align: center;">D. Personality</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="" class="control-label " style=" text-align: center;">Passed</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1" style=" text-align: center;">
                                                        <label for="" class="control-label " style="text-align: center;">Failed</label>
                                                    </div>

                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">1. Knowledgeability</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g1" class="form-control form-control-sm  rounded-0" required name="ratingg1" value="1">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g2" class="form-control form-control-sm  rounded-0" required name="ratingg1" value="2">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">1. Integrity</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h1" class="form-control form-control-sm  rounded-0" required name="ratingh1" value="1">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h2" class="form-control form-control-sm  rounded-0" required name="ratingh1" value="2">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">2. Competence</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g3" class="form-control form-control-sm  rounded-0" required name="ratingg2" value="3">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g4" class="form-control form-control-sm  rounded-0" required name="ratingg2" value="4">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">2. Self-confidence</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h3" class="form-control form-control-sm  rounded-0" required name="ratingh2" value="3">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h4" class="form-control form-control-sm  rounded-0" required name="ratingh2" value="4">
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">3. Judgement</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g5" class="form-control form-control-sm  rounded-0" required name="ratingg3" value="5">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g6" class="form-control form-control-sm  rounded-0" required name="ratingg3" value="6">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">3. Stress Tolerance</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h5" class="form-control form-control-sm  rounded-0" required name="ratingh3" value="5">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h6" class="form-control form-control-sm  rounded-0" required name="ratingh3" value="6">
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">4. Analytical Ability</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g7" class="form-control form-control-sm  rounded-0" required name="ratingg4" value="7">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g8" class="form-control form-control-sm  rounded-0" required name="ratingg4" value="8">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">4. Interpersonal Sensitivity</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h7" class="form-control form-control-sm  rounded-0" required name="ratingh4" value="7">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h8" class="form-control form-control-sm  rounded-0" required name="ratingh4" value="8">
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="form-group col-sm-4 ">
                                                        <label for="rating" class="control-label ">5. Specialization</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g9" class="form-control form-control-sm  rounded-0" required name="ratingg5" value="9">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_g10" class="form-control  rounded-0 form-control-sm " required name="ratingg5" value="10">
                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="rating" class="control-label ">5. Decisiveness</label>
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h9" class="form-control form-control-sm  rounded-0" required name="ratingh5" value="9">
                                                    </div>
                                                    <div class="form-group  col-sm-1">
                                                        <input type="radio" id="rating_id_h10" class="form-control form-control-sm  rounded-0" required name="ratingh5" value="10">
                                                    </div>
                                                </div>
                                                <div class="row item2">
                                                    <div class="form-group col-sm-12">
                                                        <label for="comment1" class="control-label ">Comments</label>
                                                        <textarea rows="2" class="form-control notes" required name="comment1[]" placeholder="Comments" placeholder="Comment"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row address-holder2 item2">
                                                    <div class="form-group  col-sm-2">
                                                        <label for="interview1" class="control-label ">Interviewed by:</label>

                                                    </div>
                                                    <div class="form-group  col-sm-4">
                                                        <?php if (empty($_settings->userdata('EMPNAME'))) { ?>
                                                            <input type="text" class="form-control  rounded-0" required placeholder="Interviewed by" id="interview1" name="interview1[]" value="<?php echo isset($row['inter']) ? $row['inter'] : '' ?>">
                                                        <?php } else { ?>
                                                            <input readonly type="text" class="form-control  rounded-0" required placeholder="Interviewed by" id="interview1" name="interview1[]" value="<?php echo isset($row['inter']) ? $row['inter'] : $_settings->userdata('EMPNAME') ?>">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group  col-sm-2">
                                                        <label for="date2" class="control-label " style="display: block; text-align: right;">Date:</label>
                                                    </div>
                                                    <div class="form-group  col-sm-4">

                                                        <input type="date" readonly max="<?php echo date("Y-m-d") ?>" style="display: block; " class="form-control  rounded-0" id="date2" name="date2[]" value="<?php echo date("Y-m-d") ?>">
                                                    </div>
                                                </div>
                                                <div class="row address-holder2 item2">
                                                    <div class="form-group  col-sm-2">
                                                        <label for="position2" class="control-label " style="display: block; text-align: center;">Position:</label>
                                                    </div>
                                                    <div class="form-group  col-sm-4">
                                                        <input type="text" class="form-control  rounded-0" required id="position2" placeholder="Position" name="position2[]" value="<?php echo $_settings->userdata('JOB_TITLE') ?>">
                                                    </div>

                                                    <div class="form-group  col-sm-2">
                                                        <label for="date2" class="control-label " style="display: block; text-align: right;">Result:</label>
                                                    </div>
                                                    <div class="form-group  col-sm-4">
                                                        <select name="choose[]" id="choose" class="form-control  rounded-0 " required>
                                                            <option value="" selected disabled>--Choose--</option>
                                                            <option <?php echo isset($row['choose']) && $row['choose'] != 2 ? "selected" : '' ?> value="3">Passed</option>
                                                            <option <?php echo isset($row['choose']) && $row['choose'] == 2 ? "selected" : '' ?> value="2">Failed</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <br><br>
                                                <div class="row address-holder2 item2">
                                                    <div class="form-group  col-sm-2">
                                                        <label for="expected" class="control-label " style="display: block; ">Expected salary:</label>
                                                    </div>
                                                    <div class="form-group  col-sm-4">
                                                        <input type="number" class="form-control  rounded-0" required id="expected" placeholder="Input expected salary" name="expected[]">
                                                    </div>
                                                    <div class="form-group  col-sm-2">
                                                        <label for="recommended" class="control-label " style="display: block;">Recommended salary:</label>
                                                    </div>
                                                    <div class="form-group  col-sm-4">
                                                        <input type="number" class="form-control  rounded-0" required id="recommended" placeholder="Input recommended salary" name="recommended[]">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row address-holder2 item2">
                                                    <div class="col-md-12">
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-primary  d-inline">
                                                                <input type="checkbox" id="recom_to">
                                                                <label for="recom_to">Recommend to other position/department.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <input type="text" class="form-control  rounded-0 recompos"  id="recommended_pos" placeholder="Input recommended position / department." name="recommended_pos[]"> -->
                                                    <select name="recommended_pos[]" id="recommended_pos" disabled class="form-control recompos rounded-0 select2" required>
                                                        <option value="" selected disabled>--Select Position--</option>
                                                        <?php
                                                        $application = $conn->query("SELECT * FROM `position` where  `status` = 1 ORDER BY position");
                                                        while ($row = $application->fetch_assoc()) :
                                                        ?>
                                                            <option value="<?= $row['position'] ?>" <?php echo isset($position) && $position == $row['position'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <br><br>

                                            </div>
                                        </div>
                                        <input type="hidden" id="rating5" name="rating5[]" value="0,0,0,0,0">
                                        <input type="hidden" id="rating6" name="rating6[]" value="0,0,0,0,0">
                                        <input type="hidden" id="rating7" name="rating7[]" value="0,0,0,0,0">
                                        <input type="hidden" id="rating8" name="rating8[]" value="0,0,0,0,0">
                                    </noscript>
                                </div>
                            <?php  } ?>
                            <br>
                            <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
                                <?php if (isset($choose) && $choose == 3) { ?>
                                    <hr class="dashed-hr" style="border: none; border-top: 2px dashed black;">
                                    <i>To be filled-up by Human Resource Department</i><br>
                                    <br>
                                    <div class="row">
                                        <div class="form-group  col-sm-3">
                                            <label for="commencement" class="control-label ">Date Commencement :</label>
                                        </div>
                                        <div class="form-group  col-sm-4">
                                            <input type="date" max="<?php echo date("Y-m-d") ?>" <?php echo isset($commencement) ? 'readonly' : '' ?> class="form-control   rounded-0" placeholder="DATE COMMENCEMENT" id="commencement" name="commencement" value="<?php echo isset($commencement) ? $commencement : '' ?>">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group  col-sm-2" style="text-align: right;">
                                            <label for="noted" class="control-label  ">Noted By:</label>
                                        </div>
                                        <div class="form-group  col-sm-4">
                                            <input type="text" class="form-control   rounded-0" id="noted" placeholder="NOTED BY" name="noted" value="<?php echo isset($noted) ? $noted : '' ?>">
                                            <I style="display:block; text-align: center;">HR Dept.</I>
                                        </div>
                                        <div class="form-group  col-sm-2" style="text-align: right;">
                                            <label for="approve" class="control-label  " style="display: block; text-align: center;">Approved By:</label>
                                        </div>
                                        <div class="form-group  col-sm-4">
                                            <input type="text" class="form-control   rounded-0" id="approve" name="approve" placeholder="APPROVED BY" value="<?php echo isset($approve) ? $approve : '' ?>">
                                            <I style="display:block; text-align: center;">Department Section Head / Manager</I>
                                        </div>
                                    </div>
                                <?php  } ?>
                            <?php  } ?>
                        </fieldset>
                    </div>
                    <input type="hidden" id="rating1" name="rating1" value="<?php echo isset($rating1) ? $rating1 : '0,0,0,0,0' ?>">
                    <input type="hidden" id="rating2" name="rating2" value="<?php echo isset($rating2) ? $rating2 : '0,0,0,0,0' ?>">
                    <input type="hidden" id="rating3" name="rating3" value="<?php echo isset($rating3) ? $rating3 : '0,0,0,0,0' ?>">
                    <input type="hidden" id="rating4" name="rating4" value="<?php echo isset($rating4) ? $rating4 : '0,0,0,0,0' ?>">

                </form>
            </div>
            <div class="card-footer text-center savebtn <?php echo (isset($passed[0]) && $passed[0] == 2) || (isset($passed[0]) && $passed[0] == 0) || (isset($initial) && $initial == 2) || (isset($choose) && $choose == 2) ? 'd-none' : '' ?>">
                <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form1">Save</button>
                <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
                    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Cancel</a>
                <?php } else { ?>
                    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/assess_" ?>">Cancel</a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>


<div class="card-footer text-center">
    <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
        <!-- <button class="btn btn-flat btn-sn btn-primary" type="button" id="print"><i class="fa fa-print"></i> Print Assessment</button> -->
    <?php } ?>
    <!-- <a class="btn btn-flat btn-sn btn-primary" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>"><i class="fa fa-edit"></i> Edit</a> -->
    <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants" ?>">Back to List</a>
    <?php } else { ?>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/assess_" ?>">Back to List</a>
    <?php } ?>
</div>
<?php
$user_type = $_settings->userdata('type');
$data_json = json_encode($user_type);
?>
<script>
    $(document).ready(function() {
        var pass1 = 0;
        var pass2 = 0;
        var pass3 = 0;
        var pass4 = 0;
        var noval = [0]
        var noval1 = [0]
        if ($('#rating1').val() == '' || $('#rating1').val() == noval) {
            var ratinga1Array = [0];
        } else {
            var ratinga1Array = [$('#rating1').val()];
        }

        if ($('#rating2').val() == '' || $('#rating2').val() == noval1) {
            var ratingb1Array = [0];
        } else {
            var ratingb1Array = [$('#rating2').val()];
        }

        if ($('#rating3').val() == '' || $('#rating3').val() == noval1) {
            var ratingc1Array = [0];
        } else {
            var ratingc1Array = [$('#rating3').val()];
        }
        if ($('#rating4').val() == '' || $('#rating4').val() == noval1) {
            var ratingd1Array = [0];
        } else {
            var ratingd1Array = [$('#rating4').val()];
        }
        console.log('Rating A1:', $('#rating1').val());
        console.log('Rating A2:', $('#rating2').val());
        console.log('Rating A3:', $('#rating3').val());
        console.log('Rating A4:', $('#rating4').val());
        // if ($('#rating5').val() == '' || $('#rating5').val() == noval) {
        //     var ratinge1Array = [0, 0, 0, 0,0];
        // } else {
        //     var ratinge1Array = [$('#rating5').val()];
        // }

        // if ($('#rating6').val() == '' || $('#rating6').val() == noval1) {
        //     var ratingf1Array = [0];
        // } else {
        //     var ratingf1Array = [$('#rating6').val()];
        // }

        // if ($('#rating7').val() == '' || $('#rating7').val() == noval1) {
        //     var ratingg1Array = [0];
        // } else {
        //     var ratingg1Array = [$('#rating7').val()];
        // }
        // if ($('#rating8').val() == '' || $('#rating8').val() == noval1) {
        //     var ratingh1Array = [0];
        // } else {
        //     var ratingh1Array = [$('#rating8').val()];
        // }
        // var ratinga1Array = [0, 0, 0, 0,0];
        // var ratingb1Array = [0];
        // var ratingc1Array = [0];
        // var ratingd1Array = [0];
        // var ratinge1Array = [0, 0, 0, 0,0];
        // var ratingf1Array = [0];
        // var ratingg1Array = [0];
        // var ratingh1Array = [0];
        //------------------------------------rating array 1------------------------------------------//

        // Attach a change event handler to the radio buttons for ratinga1
        $('input[name="ratinga1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_a1').is(':checked')) {

                var selectedValue = $('#rating_id_a1').val();
                ratinga1Array.splice(0, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_a2').is(':checked')) {

                var selectedValue = $('#rating_id_a2').val();
                ratinga1Array.splice(0, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratinga2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_a3').is(':checked')) {

                var selectedValue = $('#rating_id_a3').val();
                ratinga1Array.splice(1, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_a4').is(':checked')) {

                var selectedValue = $('#rating_id_a4').val();
                ratinga1Array.splice(1, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratinga3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_a5').is(':checked')) {

                var selectedValue = $('#rating_id_a5').val();
                ratinga1Array.splice(2, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_a6').is(':checked')) {

                var selectedValue = $('#rating_id_a6').val();
                ratinga1Array.splice(2, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratinga4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_a7').is(':checked')) {

                var selectedValue = $('#rating_id_a7').val();
                ratinga1Array.splice(3, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_a8').is(':checked')) {

                var selectedValue = $('#rating_id_a8').val();
                ratinga1Array.splice(3, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratinga5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_a9').is(':checked')) {

                var selectedValue = $('#rating_id_a9').val();
                ratinga1Array.splice(4, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_a10').is(':checked')) {

                var selectedValue = $('#rating_id_a10').val();
                ratinga1Array.splice(4, 1);
                // Add the selected value to the ratinga1Array
                ratinga1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });

        //------------------------------------rating array 2------------------------------------------//

        $('input[name="ratingb1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_b1').is(':checked')) {

                var selectedValue = $('#rating_id_b1').val();
                ratingb1Array.splice(0, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_b2').is(':checked')) {

                var selectedValue = $('#rating_id_b2').val();
                ratingb1Array.splice(0, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingb2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_b3').is(':checked')) {

                var selectedValue = $('#rating_id_b3').val();
                ratingb1Array.splice(1, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_b4').is(':checked')) {

                var selectedValue = $('#rating_id_b4').val();
                ratingb1Array.splice(1, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingb3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_b5').is(':checked')) {

                var selectedValue = $('#rating_id_b5').val();
                ratingb1Array.splice(2, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_b6').is(':checked')) {

                var selectedValue = $('#rating_id_b6').val();
                ratingb1Array.splice(2, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingb4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_b7').is(':checked')) {

                var selectedValue = $('#rating_id_b7').val();
                ratingb1Array.splice(3, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_b8').is(':checked')) {

                var selectedValue = $('#rating_id_b8').val();
                ratingb1Array.splice(3, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingb5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_b9').is(':checked')) {

                var selectedValue = $('#rating_id_b9').val();
                ratingb1Array.splice(4, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_b10').is(':checked')) {

                var selectedValue = $('#rating_id_b10').val();
                ratingb1Array.splice(4, 1);
                // Add the selected value to the ratingb1Array
                ratingb1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });
        //------------------------------------rating array 3------------------------------------------//

        $('input[name="ratingc1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_c1').is(':checked')) {

                var selectedValue = $('#rating_id_c1').val();
                ratingc1Array.splice(0, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_c2').is(':checked')) {

                var selectedValue = $('#rating_id_c2').val();
                ratingc1Array.splice(0, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingc2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_c3').is(':checked')) {

                var selectedValue = $('#rating_id_c3').val();
                ratingc1Array.splice(1, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_c4').is(':checked')) {

                var selectedValue = $('#rating_id_c4').val();
                ratingc1Array.splice(1, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingc3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_c5').is(':checked')) {

                var selectedValue = $('#rating_id_c5').val();
                ratingc1Array.splice(2, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_c6').is(':checked')) {

                var selectedValue = $('#rating_id_c6').val();
                ratingc1Array.splice(2, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingc4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_c7').is(':checked')) {

                var selectedValue = $('#rating_id_c7').val();
                ratingc1Array.splice(3, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_c8').is(':checked')) {

                var selectedValue = $('#rating_id_c8').val();
                ratingc1Array.splice(3, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingc5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_c9').is(':checked')) {

                var selectedValue = $('#rating_id_c9').val();
                ratingc1Array.splice(4, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_c10').is(':checked')) {

                var selectedValue = $('#rating_id_c10').val();
                ratingc1Array.splice(4, 1);
                // Add the selected value to the ratingc1Array
                ratingc1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });
        //------------------------------------rating array 4------------------------------------------//

        $('input[name="ratingd1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_d1').is(':checked')) {

                var selectedValue = $('#rating_id_d1').val();
                ratingd1Array.splice(0, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_d2').is(':checked')) {

                var selectedValue = $('#rating_id_d2').val();
                ratingd1Array.splice(0, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingd2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_d3').is(':checked')) {

                var selectedValue = $('#rating_id_d3').val();
                ratingd1Array.splice(1, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_d4').is(':checked')) {

                var selectedValue = $('#rating_id_d4').val();
                ratingd1Array.splice(1, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingd3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_d5').is(':checked')) {

                var selectedValue = $('#rating_id_d5').val();
                ratingd1Array.splice(2, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_d6').is(':checked')) {

                var selectedValue = $('#rating_id_d6').val();
                ratingd1Array.splice(2, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        $('input[name="ratingd4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_d7').is(':checked')) {

                var selectedValue = $('#rating_id_d7').val();
                ratingd1Array.splice(3, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_d8').is(':checked')) {

                var selectedValue = $('#rating_id_d8').val();
                ratingd1Array.splice(3, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        $('input[name="ratingd5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_d9').is(':checked')) {

                var selectedValue = $('#rating_id_d9').val();
                ratingd1Array.splice(4, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_d10').is(':checked')) {

                var selectedValue = $('#rating_id_d10').val();
                ratingd1Array.splice(4, 1);
                // Add the selected value to the ratingd1Array
                ratingd1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });

        var count = 0;

        function myFunction() {
            count1 = 0;
            count2 = 0;
            count3 = 0;
            count4 = 0;

            // Loop through specific radio buttons by their IDs
            var specificIdsa1 = [
                'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7', 'rating_id_a9'
                // 'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9',
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsa1.length; i++) {
                var radioButton = $('#' + specificIdsa1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count1++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsb1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9'
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsb1.length; i++) {
                var radioButton = $('#' + specificIdsb1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count2++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsc1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                // 'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9',
                'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9'
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsc1.length; i++) {
                var radioButton = $('#' + specificIdsc1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count3++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsd1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                // 'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9',
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9'
            ];
            for (var i = 0; i < specificIdsd1.length; i++) {
                var radioButton = $('#' + specificIdsd1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count4++;
                }
            }


            // var count = count1 + count2 + count3 + count4
            // if ((count1 >= 2) && (count2 >= 3) && (count3 >= 3) && (count4 >= 3)) {
            //     $('#decide').val(1)
            //     $('#decide1').val('Passed')
            // } else {
            //     $('#decide').val(2)
            //     $('#decide1').val('Failed')
            // }
            $('#rating1').val(count1)
            $('#rating2').val(count2)
            $('#rating3').val(count3)
            $('#rating4').val(count4)
            // $('#rating1').val(ratinga1Array)
            // $('#rating2').val(ratingb1Array)
            // $('#rating3').val(ratingc1Array)
            // $('#rating4').val(ratingd1Array)
            // console.log('Number of checked specific radio buttons 1: ' + count1);
            // console.log('Number of checked specific radio buttons 2: ' + count2);
            // console.log('Number of checked specific radio buttons 3: ' + count3);
            // console.log('Number of checked specific radio buttons 4: ' + count4);
            // console.log('decide value ' + $('#decide').val());
            console.log('Rating A1:', $('#rating1').val());
            console.log('Rating A2:', $('#rating2').val());
            console.log('Rating A3:', $('#rating3').val());
            console.log('Rating A4:', $('#rating4').val());
        }

    });
    $(document).ready(function() {
        $('.approve_data').click(function() {
            _conf("Are you sure to accept this job offer?", "accept_", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
        })
        $('.disapprove_data').click(function() {
            _conf("Are you sure to reject this job offer?", "accept_", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
        })
    })

    function accept_($id, $val, $sign) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Users.php?f=accept_",
            method: "POST",
            data: {
                id: $id,
                val: $val,
                sign: $sign
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    // $('.sub').click();
                    location.reload()
                    // location.replace(_base_url_ + "admin/?page=overtime_form/view_ot&id=" + resp.id);
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
    var user_t = <?php echo $user_type; ?>
    // console.log(user_t)
    $('.is_right').click(function() {
        var clickedCheckboxId = $(this).attr('id');
        // console.log(clickedCheckboxId)


        var selectedOptions = $('.is_right:checked');
        var numSelected = selectedOptions.length;
        if (numSelected > 1) {
            $('.is_right').prop('checked disabled', false).trigger('change');
            $(this).prop('checked disabled', true).trigger('change')
        }
        var selectedOptionsId = selectedOptions.attr('id');
        var cb1 = document.querySelector('#check1');
        var cb2 = document.querySelector('#check2');


    });
    $('.remove-option2').click(function() {
        $(this).closest('.item2').remove()
        $('.a_btn').removeClass('d-none')
    })
    // Add Option button click event
    // $('#add_option2').click(function() {
    //     // Clone the template option and convert it into a jQuery object
    //     var item = $($('#option-clone2').html()).clone();

    //     // Append the modified item to the option list
    //     $('#option-list2').append(item);

    //     // Attach event handlers to the cloned item

    //     item.find('.remove-option2').click(function() {
    //         $(this).closest('.item2').remove();
    //     });
    // });

    $('#add_option2').click(function() {

        $('.a_btn').addClass('d-none')
        // Clone the template option and convert it into a jQuery object
        var item = $($('#option-clone2').html()).clone();

        // Append the modified item to the option list
        $('#option-list2').append(item);

        // Attach event handlers to the cloned item
        item.find('.remove-option2').click(function() {
            $(this).closest('.item2').remove();
            $('.a_btn').removeClass('d-none')
        });
        item.find('.select2').select2({
            width: 'resolve'
        })
        // Add an event listener to the input inside the cloned item
        item.find('#recom_to').on('change', function() {
            if ($('#recom_to').is(':checked')) {
                $('.recompos').removeAttr('disabled')
                $('.recompos').attr('required', true)
            } else {
                $('.recompos').removeAttr('required')
                $('.recompos').val('')
                $('.recompos').attr('disabled', true)
            }

        });
        // var ratinga1Array = [0, 0, 0, 0,0];
        // var ratingb1Array = [0];
        // var ratingc1Array = [0];
        // var ratingd1Array = [0];
        var ratinge1Array = [0];
        var ratingf1Array = [0];
        var ratingg1Array = [0];
        var ratingh1Array = [0];
        //------------------------------------rating array 5------------------------------------------//

        // Attach a change event handler to the radio buttons for ratinga1
        item.find('input[name="ratinge1"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_e1').is(':checked')) {
                var selectedValue = $('#rating_id_e1').val();
                ratinge1Array.splice(0, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_e2').is(':checked')) {
                var selectedValue = $('#rating_id_e2').val();
                ratinge1Array.splice(0, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratinge2"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_e3').is(':checked')) {
                var selectedValue = $('#rating_id_e3').val();
                ratinge1Array.splice(1, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_e4').is(':checked')) {
                var selectedValue = $('#rating_id_e4').val();
                ratinge1Array.splice(1, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratinge3"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_e5').is(':checked')) {
                var selectedValue = $('#rating_id_e5').val();
                ratinge1Array.splice(2, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_e6').is(':checked')) {
                var selectedValue = $('#rating_id_e6').val();
                ratinge1Array.splice(2, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratinge4"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_e7').is(':checked')) {
                var selectedValue = $('#rating_id_e7').val();
                ratinge1Array.splice(3, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_e8').is(':checked')) {
                var selectedValue = $('#rating_id_e8').val();
                ratinge1Array.splice(3, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratinge5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_e9').is(':checked')) {

                var selectedValue = $('#rating_id_e9').val();
                ratinge1Array.splice(4, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_e10').is(':checked')) {

                var selectedValue = $('#rating_id_e10').val();
                ratinge1Array.splice(4, 1);
                // Add the selected value to the ratinge1Array
                ratinge1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });

        //------------------------------------rating array 6------------------------------------------//

        item.find('input[name="ratingf1"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_f1').is(':checked')) {
                var selectedValue = $('#rating_id_f1').val();
                ratingf1Array.splice(0, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_f2').is(':checked')) {
                var selectedValue = $('#rating_id_f2').val();
                ratingf1Array.splice(0, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingf2"]').change(function() {
            // Get the selected value for ratinge1
            if ($('#rating_id_f3').is(':checked')) {
                var selectedValue = $('#rating_id_f3').val();
                ratingf1Array.splice(1, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_f4').is(':checked')) {
                var selectedValue = $('#rating_id_f4').val();
                ratingf1Array.splice(1, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingf3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_f5').is(':checked')) {
                var selectedValue = $('#rating_id_f5').val();
                ratingf1Array.splice(2, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_f6').is(':checked')) {
                var selectedValue = $('#rating_id_f6').val();
                ratingf1Array.splice(2, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingf4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_f7').is(':checked')) {
                var selectedValue = $('#rating_id_f7').val();
                ratingf1Array.splice(3, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_f8').is(':checked')) {
                var selectedValue = $('#rating_id_f8').val();
                ratingf1Array.splice(3, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingf5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_f9').is(':checked')) {
                var selectedValue = $('#rating_id_f9').val();
                ratingf1Array.splice(4, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_f10').is(':checked')) {
                var selectedValue = $('#rating_id_f10').val();
                ratingf1Array.splice(4, 1);
                // Add the selected value to the ratingf1Array
                ratingf1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });
        //------------------------------------rating array 7------------------------------------------//

        item.find('input[name="ratingg1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_g1').is(':checked')) {
                var selectedValue = $('#rating_id_g1').val();
                ratingg1Array.splice(0, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_g2').is(':checked')) {
                var selectedValue = $('#rating_id_g2').val();
                ratingg1Array.splice(0, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingg2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_g3').is(':checked')) {
                var selectedValue = $('#rating_id_g3').val();
                ratingg1Array.splice(1, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_g4').is(':checked')) {
                var selectedValue = $('#rating_id_g4').val();
                ratingg1Array.splice(1, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingg3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_g5').is(':checked')) {
                var selectedValue = $('#rating_id_g5').val();
                ratingg1Array.splice(2, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_g6').is(':checked')) {
                var selectedValue = $('#rating_id_g6').val();
                ratingg1Array.splice(2, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingg4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_g7').is(':checked')) {
                var selectedValue = $('#rating_id_g7').val();
                ratingg1Array.splice(3, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_g8').is(':checked')) {
                var selectedValue = $('#rating_id_g8').val();
                ratingg1Array.splice(3, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingg5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_g9').is(':checked')) {
                var selectedValue = $('#rating_id_g9').val();
                ratingg1Array.splice(4, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_g10').is(':checked')) {
                var selectedValue = $('#rating_id_g10').val();
                ratingg1Array.splice(4, 1);
                // Add the selected value to the ratingg1Array
                ratingg1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });
        //------------------------------------rating array 8------------------------------------------//

        item.find('input[name="ratingh1"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_h1').is(':checked')) {
                var selectedValue = $('#rating_id_h1').val();
                ratingh1Array.splice(0, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(0, 0, selectedValue);
            } else if ($('#rating_id_h2').is(':checked')) {
                var selectedValue = $('#rating_id_h2').val();
                ratingh1Array.splice(0, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(0, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingh2"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_h3').is(':checked')) {
                var selectedValue = $('#rating_id_h3').val();
                ratingh1Array.splice(1, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(1, 0, selectedValue);
            } else if ($('#rating_id_h4').is(':checked')) {
                var selectedValue = $('#rating_id_h4').val();
                ratingh1Array.splice(1, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(1, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingh3"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_h5').is(':checked')) {
                var selectedValue = $('#rating_id_h5').val();
                ratingh1Array.splice(2, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(2, 0, selectedValue);
            } else if ($('#rating_id_h6').is(':checked')) {
                var selectedValue = $('#rating_id_h6').val();
                ratingh1Array.splice(2, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(2, 0, selectedValue);
            }
            myFunction()

        });
        item.find('input[name="ratingh4"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_h7').is(':checked')) {
                var selectedValue = $('#rating_id_h7').val();
                ratingh1Array.splice(3, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(3, 0, selectedValue);
            } else if ($('#rating_id_h8').is(':checked')) {
                var selectedValue = $('#rating_id_h8').val();
                ratingh1Array.splice(3, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(3, 0, selectedValue);
            }
            myFunction()
        });
        item.find('input[name="ratingh5"]').change(function() {
            // Get the selected value for ratinga1
            if ($('#rating_id_h9').is(':checked')) {
                var selectedValue = $('#rating_id_h9').val();
                ratingh1Array.splice(4, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(4, 0, selectedValue);
            } else if ($('#rating_id_h10').is(':checked')) {
                var selectedValue = $('#rating_id_h10').val();
                ratingh1Array.splice(4, 1);
                // Add the selected value to the ratingh1Array
                ratingh1Array.splice(4, 0, selectedValue);
            }
            myFunction()
        });

        function myFunction() {
            // $('#rating1').val(ratinga1Array)
            // $('#rating2').val(ratingb1Array)
            // $('#rating3').val(ratingc1Array)
            // $('#rating4').val(ratingd1Array)
            // $('#rating5').val(ratinge1Array)
            // $('#rating6').val(ratingf1Array)
            // $('#rating7').val(ratingg1Array)
            // $('#rating8').val(ratingh1Array)



            count1 = 0;
            count2 = 0;
            count3 = 0;
            count4 = 0;

            // Loop through specific radio buttons by their IDs
            var specificIdsa1 = [
                'rating_id_e1', 'rating_id_e3', 'rating_id_e5', 'rating_id_e7', 'rating_id_e9'
                // 'rating_id_f1', 'rating_id_f3', 'rating_id_f5', 'rating_id_f7', 'rating_id_f9',
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsa1.length; i++) {
                var radioButton = $('#' + specificIdsa1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count1++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsb1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                'rating_id_f1', 'rating_id_f3', 'rating_id_f5', 'rating_id_f7', 'rating_id_f9'
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsb1.length; i++) {
                var radioButton = $('#' + specificIdsb1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count2++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsc1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                // 'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9',
                'rating_id_g1', 'rating_id_g3', 'rating_id_g5', 'rating_id_g7', 'rating_id_g9'
                // 'rating_id_d1', 'rating_id_d3', 'rating_id_d5', 'rating_id_d7', 'rating_id_d9',
            ];
            for (var i = 0; i < specificIdsc1.length; i++) {
                var radioButton = $('#' + specificIdsc1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count3++;
                }
            }


            // Loop through specific radio buttons by their IDs
            var specificIdsd1 = [
                // 'rating_id_a1', 'rating_id_a3', 'rating_id_a5', 'rating_id_a7',
                // 'rating_id_b1', 'rating_id_b3', 'rating_id_b5', 'rating_id_b7', 'rating_id_b9',
                // 'rating_id_c1', 'rating_id_c3', 'rating_id_c5', 'rating_id_c7', 'rating_id_c9',
                'rating_id_h1', 'rating_id_h3', 'rating_id_h5', 'rating_id_h7', 'rating_id_h9'
            ];
            for (var i = 0; i < specificIdsd1.length; i++) {
                var radioButton = $('#' + specificIdsd1[i]);

                // Check if the radio button is checked
                if (radioButton.is(':checked')) {
                    count4++;
                }
            }


            // var count = count1 + count2 + count3 + count4
            // if ((count1 >= 2) && (count2 >= 3) && (count3 >= 3) && (count4 >= 3)) {
            //     $('#choose').val(3)
            //     $('#choose1').val('Passed')
            // } else {
            //     $('#choose').val(2)
            //     $('#choose1').val('Failed')
            // }

            $('#rating5').val(count1)
            $('#rating6').val(count2)
            $('#rating7').val(count3)
            $('#rating8').val(count4)
            // console.log('Number of checked specific radio buttons 1: ' + count1);
            // console.log('Number of checked specific radio buttons 2: ' + count2);
            // console.log('Number of checked specific radio buttons 3: ' + count3);
            // console.log('Number of checked specific radio buttons 4: ' + count4);
            // console.log('decide value ' + $('#choose').val());

            console.log('Rating A5:', $('#rating5').val());
            console.log('Rating A6:', $('#rating6').val());
            console.log('Rating A7:', $('#rating7').val());
            console.log('Rating A8:', $('#rating8').val());
        }

    });


    $('#a_remarks').change(function() {
        // console.log($('#a_remarks').val())
        // if ($('#a_remarks').val() == 1) {
        $('.savebtn').removeClass('d-none')
        // } else if ($('#a_remarks').val() == 2) {
        //     $('.savebtn').addClass('d-none')
        // }
    })
    $(".quali :input").attr("readonly", true);
    if (user_t != 1) {

        $(".a_btn").removeAttr("readonly");
    }
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

    $('#print').click(function() {
        $('.view_req').hide();
        $('.line').hide();
        var head = $('head').clone();
        var rep = $('#printable').clone();
        var ns = $('noscript').clone().html();
        start_loader()
        rep.find('.content').after('<div class="page-break"></div>');

        rep.prepend(ns)
        rep.prepend(head)
        rep.find('#print_header').show()
        var nw = window.document.open('', '_blank', 'width=900,height=600')
        nw.document.write(rep.html())
        nw.document.close()
        setTimeout(function() {
            nw.print()
            setTimeout(function() {
                $('.view_req').show();
                $('.line').show();
                nw.close()
                end_loader()
            }, 200)
        }, 300)
    })


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
    $("#customFile").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['application/pdf'];
        if (!(fileType == match[0])) {
            alert('Sorry, only PDF files are allowed to upload.');
            $("#file").val('');
            return false;
        }
    });
    $(function() {

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
    $(function() {
        $('#client-form1').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Users.php?f=assess_client",
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
                        alert_toast("Application Successful", 'success')
                        setTimeout(function() {
                            location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
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