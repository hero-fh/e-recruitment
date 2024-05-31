<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM applicants where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: scale-down;
        object-position: center center;
        border-radius: 100% 100%;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 0;
    }
</style>


<div class="card card-outline card-primary">
    <div class="toggle accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
        <p class="h5"><b>Update Applicant's Information</b></P>
    </div>
    <div class="card-body personal">
        <div class="container-fluid">
            <!-- client form section -->
            <form action="" id="client-form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <input type="hidden" name="application" value="<?php echo isset($application) ? $application : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <div class="card-header text-center">
                            <p class="h3"><b>Personal Information</b></p>
                        </div> <br>
                        <!-- <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="control-label">Medical Status</label>
                                <select name="status" id="" class="select custom-select">
                                    <option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Unfit to work</option>
                                    <option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Fit to work</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="surname" class="control-label ">Last Name</label>
                                <input type="text" class="form-control  " id="surname" name="surname" value="<?php echo isset($surname) ? $surname : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="firstname" class="control-label ">First Name</label>
                                <input type="text" class="form-control  " id="firstname" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="middlename" class="control-label ">Middle Name</label>
                                <input type="text" class="form-control  " id="middlename" name="middlename" value="<?php echo isset($middlename) ? $middlename : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="gender" class="control-label ">Gender</label>
                                <select name="gender" id="gender" class="custom-select  " required>
                                    <option <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Male</option>
                                    <option <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="mobile_number" class="control-label ">Mobile #</label>
                                <input type="text" class="form-control  " id="mobile_number" name="mobile_number" value="<?php echo isset($mobile_number) ? $mobile_number : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="email" class="control-label ">Email</label>
                                <input type="email" class="form-control  " id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                            </div>
                        </div>
                        <label class="control-label">CURRENT ADDRESS</label>
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label class="form-label">Region *</label>
                                <select name="region" class="form-control form-control-md" required id="region">
                                    <option value="<?php echo isset($region) ? $region : '' ?>"><?php echo isset($region) ? $region : '' ?></option>
                                    <!-- <option value="">--Choose Region--</option> -->
                                </select>
                                <input type="hidden" class="form-control form-control-md" name="region" id="region-text" value="<?php echo isset($region) ? $region : '' ?>">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label class="form-label">Province *</label>
                                <select name="province" class="form-control form-control-md" required id="province">
                                    <option value="<?php echo isset($province) ? $province : '' ?>"><?php echo isset($province) ? $province : '' ?></option>

                                    <!-- <option value="">--Choose State/Province--</option> -->
                                </select>
                                <input type="hidden" class="form-control form-control-md" name="province" id="province-text" value="<?php echo isset($province) ? $province : '' ?>">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label class="form-label">City / Municipality *</label>
                                <select name="city" class="form-control form-control-md" required id="city">
                                    <!-- <option value="">--Choose City / Minucipality--</option> -->
                                    <option value="<?php echo isset($city) ? $city : '' ?>"><?php echo isset($city) ? $city : '' ?></option>

                                </select>
                                <input type="hidden" class="form-control form-control-md" name="city" id="city-text" value="<?php echo isset($city) ? $city : '' ?>">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label class="form-label">Barangay *</label>
                                <select name="barangay" class="form-control form-control-md" required id="barangay">
                                    <!-- <option value="">--Choose Barangay--</option> -->
                                    <option value="<?php echo isset($barangay) ? $barangay : '' ?>"><?php echo isset($barangay) ? $barangay : '' ?></option>

                                    <input type="hidden" class="form-control form-control-md" name="barangay" id="barangay-text" value="<?php echo isset($barangay) ? $barangay : '' ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 inline">
                                <div class="form-group">
                                    <label for="current_address" class="control-label ">House or Appartment No./Street Name<b style="color:#FF0000" ;>*</b></label>
                                    <!-- <input type="text" class="form-control" required id="current_address" name="current_address" placeholder="Street/House or Appartment No. etc."> -->
                                    <input type="text" class="form-control" required id="current_address" name="current_address" value="<?php echo isset($current_address) ? $current_address : '' ?>" placeholder="Street/House or Appartment No. etc.">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="zip" class="control-label">ZIP CODE<b style="color:#FF0000" ;>*</b></label>
                                    <!-- <input type="number" class="form-control " required id="zip" name="zip" placeholder="Zip Code"> -->
                                    <input type="number" class="form-control " required id="zip" name="zip" value="<?php echo isset($zip) ? $zip : '' ?>" placeholder="Zip Code">

                                </div>
                            </div>
                        </div>

                        <div class="card-header text-center">
                            <p class="h3"><b>Government ID's</b></p>
                        </div> <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license" class="control-label">DRIVER'S LICENSE</label>
                                    <input type="text" class="form-control" id="license" name="license" value="<?php echo isset($license) ? $license : '' ?>" placeholder="Driver's License">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="philhealth" class="control-label">PHILHEALTH NO.</label>
                                    <input type="text" class="form-control" id="philhealth" name="philhealth" value="<?php echo isset($philhealth) ? $philhealth : '' ?>" placeholder="Philhealth No.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin" class="control-label">Tax Identification Number</label>
                                    <input type="text" class="form-control" id="tin" name="tin" value="<?php echo isset($tin) ? $tin : '' ?>" placeholder="Tax Identification Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sss" class="control-label">SSS NO.</label>
                                    <input type="text" class="form-control" id="sss" value="<?php echo isset($sss) ? $sss : '' ?>" placeholder="SSS No." name="sss">
                                </div>
                            </div>
                            <div class="col-md-3 inline">
                                <div class="form-group">
                                    <label for="sssloan" class="control-label" style="display: block; text-align: center;">WITH EXISTING LOAN</label>
                                    <input type="checkbox" name="sssloan" id="sssloan" class="form-control" value="Yes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pagibig" class="control-label">PAG-IBIG NO.</label>
                                    <input type="text" class="form-control" id="pagibig" value="<?php echo isset($pagibig) ? $pagibig : '' ?>" placeholder="PAG-IBIG No." name="pagibig">
                                </div>
                            </div>
                            <div class="col-md-3 inline">
                                <div class="form-group">
                                    <label for="pagibigloan" class="control-label" style="display: block; text-align: center;">WITH EXISTING LOAN</label>
                                    <input type="checkbox" name="pagibigloan" id="pagibigloan" class="form-control" value="Yes">
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center">
                            <p class="h3"><b>Civil Information</b></p>
                        </div> <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="civil_status" class="control-label">CIVIL STATUS</label>
                                    <select name="civil_status" id="civil_status" class="custom-select">
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Widowed</option>
                                        <option>Devorced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="children" class="control-label">CHILDREN/AGES</label>
                                    <input type="text" class="form-control" id="children" value="<?php echo isset($children) ? $children : '' ?>" placeholder="Children/Ages" name="children">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="caretaker" class="control-label">WHO TAKES CARE OF CHILDREN</label>
                                    <input type="text" class="form-control" id="caretaker" value="<?php echo isset($caretaker) ? $caretaker : '' ?>" placeholder="Who's taking care of your children" name="caretaker">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="spouse" class="control-label">NAME OF SPOUSE</label>
                                    <input type="text" class="form-control" id="spouse" value="<?php echo isset($spouse) ? $spouse : '' ?>" placeholder="Name of Spouse" name="spouse">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="occupation1" class="control-label">OCCUPATION</label>
                                    <input type="text" class="form-control" id="occupation1" value="<?php echo isset($occupation1) ? $occupation1 : '' ?>" placeholder="Occupation" name="occupation1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="age1" class="control-label">AGE</label>
                                    <input type="number" class="form-control" id="age1" value="<?php echo isset($age1) ? $age1 : '' ?>" placeholder="Age" name="age1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_person" class="control-label">CONTACT PERSON NAME</label>
                                    <input type="text" class="form-control" id="contact_person" value="<?php echo isset($contact_person) ? $contact_person : '' ?>" placeholder="Contact Person Name" required name="contact_person">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_person_number" class="control-label">CONTACT NUMBER</label>
                                    <input type="text" class="form-control" id="contact_person_number" required value="<?php echo isset($contact_person_number) ? $contact_person_number : '' ?>" placeholder="Contact Number" name="contact_person_number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="relationship" class="control-label">RELATIONSHIP</label>
                                    <input type="text" class="form-control" id="relationship" required value="<?php echo isset($relationship) ? $relationship : '' ?>" placeholder="Relationship" name="relationship">
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-flat btn-sn btn-primary" type="submit">Save</button>
                    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$rpos = $conn->query("SELECT recommended_pos FROM assessment where id = '{$id}'")->fetch_array()[0];
$choose = $conn->query("SELECT choose FROM assessment where id = '{$id}'")->fetch_array()[0];
$prf_no = $conn->query("SELECT prf_no FROM assessment where id = '{$id}'")->fetch_array()[0];
$this_pos = $conn->query("SELECT position FROM position where position = '{$rpos}'")->fetch_array();
$exam_type = $conn->query("SELECT application_id FROM position where position = '{$rpos}'")->fetch_array();
$app = $conn->query("SELECT `position_name` FROM  `applicants` where id='{$_GET['id']}'")->fetch_array();
// echo $exam_type[0];
?>
<div class="card card-outline card-primary">
    <div class="toggle5 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
        <p class="h5"><b><?php echo isset($job_offer) &&  $choose == 3 && $job_offer == 1 ? '✔' : '' ?><?php echo $application == 1 &&  $recommended_pos != NULL && $exam_type[0] == 1 && $choose == 3 && $job_offer == 0 ? '✔' : '' ?><?php echo $application == 1 && ($recommended_pos == '' || $recommended_pos == NULL) && $choose == 3 && $job_offer == 0 ? '✔' : '' ?><?php echo isset($job_offer) && $choose == 3 && $job_offer == 2 ? '❌' : '' ?>Job offer</b></P>
    </div>
    <div class="card-body job_offer">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="form-group col-md-1">
                    <?php if (isset($exam_type[0]) && $exam_type[0] != 1) { ?>
                        <?php if (!isset($choose)) { ?>
                            <label for="a_position" class="control-label ">Position:</label>
                        <?php } else { ?>
                            <?php if (($application == 1 && $choose == 3 && $job_offer == 1)) { ?>
                                <label for="a_position" class="control-label ">Position:✔</label>
                            <?php } elseif (($application == 1 && $choose == 3 && $job_offer == 2)) { ?>
                                <label for="a_position" class="control-label ">Position:❌</label>
                            <?php } else { ?>
                                <label for="a_position" class="control-label ">Position:</label>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
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
                    <?php } ?>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control  rounded-0" readonly id="a_position" name="a_position" placeholder="Position" value="<?php echo isset($this_pos[0]) ? $this_pos[0] : $app[0] ?>">
                </div>
                <!-- <div class="form-group col-md-2">
                                    <label class="control-label">Accept job offer: </label><br>
                                </div> -->
                <?php if (!isset($choose)) { ?>

                <?php } else { ?>
                    <?php if (isset($exam_type[0]) && $exam_type[0] != 1 && $application == 1) { ?>
                        <?php if ($application == 1 && $choose == 3 && $_settings->userdata('DEPARTMENT') == 'Human Resource' && $job_offer == 0) { ?>
                            <div class="form-group col-md-6">
                                <button class="btn btn-flat btn-m btn-outline-success approve_data" type="button" data-id="<?php echo $id ?>" data-val="1" data-sign="1"> <i class="fas fa-thumbs-up"></i> Accept Job offer</button>
                                <button class="btn btn-flat btn-m btn-outline-danger disapprove_data" type="button" data-id="<?php echo $id ?>" data-val="2" data-sign="1"> <i class="fas fa-thumbs-down"></i> Reject Job offer</button>
                                <!-- <span class="badge badge-success right">&check;</span> -->
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if ($application != 1 && $choose == 3 && $_settings->userdata('DEPARTMENT') == 'Human Resource' && $job_offer == 0) { ?>
                            <div class="form-group col-md-6">
                                <button class="btn btn-flat btn-m btn-outline-success approve_data" type="button" data-id="<?php echo $id ?>" data-val="1" data-sign="1"> <i class="fas fa-thumbs-up"></i> Accept Job offer</button>
                                <button class="btn btn-flat btn-m btn-outline-danger disapprove_data" type="button" data-id="<?php echo $id ?>" data-val="2" data-sign="1"> <i class="fas fa-thumbs-down"></i> Reject Job offer</button>
                                <!-- <span class="badge badge-success right">&check;</span> -->
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if ($job_offer == 1 || ($application == 1 &&  (isset($exam_type[0]) ? $exam_type[0] == 1 : '')) || ($application == 1 && ($recommended_pos == NULL || $recommended_pos == ''))) { ?>
    <div class="row">
        <div class="col-6">
            <div class="card card-outline card-primary">
                <?php if ((isset($pdf) ? $pdf : 'N/A') == 0) { ?>

                    <!-- <a href="<?php echo base_url . "admin?page=applicants/add_req&id=" .  $id ?>"> -->
                    <div class="toggle3 accordion hover" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <p class="h5 add_requirement"><b>Add Requirements</b></P>
                    </div>
                    <div class="requirement1">
                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="" id="client-form1" enctype="multipart/form-data">
                                    <input type="hidden" name="applicant_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 'N/A' ?>">
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
                        <div class="card-footer text-center">
                            <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form1">Upload</button>
                            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Cancel</a>
                        </div>
                    </div>
                <?php } elseif ((isset($pdf) ? $pdf : 'N/A') == 2) { ?>
                    <div class=" hover" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <p class="h5 add_requirement"><b>Requirement Deleted</b></P>
                    </div>
                <?php } else { ?>
                    <div class="toggle2 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <p class="h5"><b>✔Applicant Requirements</b></P>
                    </div>
                <?php } ?>
                <div class="requirement">
                    <div class="card-body">
                        <div class="container-fluid overflow-auto">

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

                                </tbody>
                            </table>
                            <form action="" id="client-form1" enctype="multipart/form-data">
                                <input type="hidden" name="applicant_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 'N/A' ?>">
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
                                <div class="card-footer text-center">
                                    <button class="btn btn-flat btn-sn btn-primary" type="submit">Upload</button>
                                    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-outline card-primary">
                <div class="toggle4 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                    <p class="h5"><b><?php echo $status == 1 ? '✔' : '' ?><?php echo $status == 0 ? '❌' : '' ?>Medical</b></P>
                </div>
                <div class="card-body medical">
                    <div class="container-fluid">
                        <!-- client form section -->
                        <form action="" id="client-form2">
                            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                            <input type="hidden" name="application" value="<?php echo isset($application) ? $application : '' ?>">
                            <div class="col-md-12">
                                <fieldset class="border-bottom border-info">

                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="" class="control-label"> Medical Status</label>
                                            <select name="status" id="status" class="select custom-select">
                                                <option value="" selected disabled>--Select status--</option>
                                                <option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Unfit to work</option>
                                                <option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Fit to work</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 unfit_class d-none">
                                            <label for="" class="control-label"> Remarks</label>
                                            <input type="text" name="unfit_remarks" required class="form-control unfit" value="<?php echo isset($unfit_remarks) ? $unfit_remarks : '' ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-flat btn-sn btn-primary" type="submit">Save</button>
                                <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-outline card-primary">
                <div class="toggle6 accordion hover" id="change" value="2" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                    <p class="h5"><b><?php echo isset($prf_no) && $prf_no != '' ? '✔' : '' ?>Personnel Requisition</b></P>
                </div>
                <div class="card-body prf">
                    <div class="container-fluid">
                        <form action="" id="client-form3">
                            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                            <input type="hidden" name="a_remarks" value="Passed">
                            <?php $chck = $conn->query("SELECT id FROM `prf_applicants` where `applicant_name` = '{$id}'")->fetch_array(); ?>

                            <label for="conducted_by" class="control-label">PRF no:</label>
                            <select <?php echo isset($chck[0]) ? 'disabled' : '' ?> name="prf_no" id="prf_no" class="form-control rounded-0 select2">
                                <option value="" selected disabled>--Select PRF--</option>
                                <?php
                                $application = $conn->query("SELECT * FROM `prf_request` where `prf_status` = 2 and prf_hold != 1");
                                while ($row = $application->fetch_assoc()) :
                                ?>
                                    <option value="<?= $row['prf_no'] ?>" <?php echo isset($prf_no) && $prf_no == $row['prf_no'] ? 'selected' : '' ?>>PRF no: <?= $row['prf_no'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <br>
                            <div class="card-footer text-center">
                                <button class="btn btn-flat btn-sn btn-primary" type="submit">Save</button>
                                <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/manage_client&id=" . $id ?>">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<script>
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
    $(".personal").hide();
    $(".unfit").attr("disabled", true);
    if ($("#status").val() == 0) {
        $(".unfit_class").removeClass("d-none");
        //     $(".unfit").removeAttr("disabled");
        // } else if ($("#status").val() == 1) {
        //     $(".unfit_class").addClass("d-none");
        //     $(".unfit").attr("disabled", true);
    }
    $('#status').on("change", function() {
        if ($("#status").val() == 0) {
            $(".unfit_class").removeClass("d-none");
            $(".unfit").removeAttr("disabled");
        } else if ($("#status").val() == 1) {
            $(".unfit_class").addClass("d-none");
            $(".unfit").attr("disabled", true);
        }
    });
    $('.toggle').click(function() {
        $(".personal").slideToggle("slow");
    });
    $(".requirement1").hide();
    $('.toggle3').click(function() {
        $(".requirement1").slideToggle("slow");
    });
    $(".requirement").hide();
    $('.toggle2').click(function() {
        $(".requirement").slideToggle("slow");
    });
    $(".medical").hide();
    $('.toggle4').click(function() {
        $(".medical").slideToggle("slow");
    });
    $(".job_offer").hide();
    $('.toggle5').click(function() {
        $(".job_offer").slideToggle("slow");
    });
    $(".prf").hide();
    $('.toggle6').click(function() {
        $(".prf").slideToggle("slow");
    });
    $(document).ready(function() {
        $('.view_req').click(function() {
            uni_modal('', "uploads/index.php?id=" + $(this).attr('data-id'), 'large')
        })
        $('.delete_data').click(function() {
            _conf("Are you sure to delete this File permanently?", "delete_product", [$(this).attr('data-id')])
        })
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
    var my_handlers = {
        // fill province
        fill_provinces: function() {
            //selected region
            var region_code = $(this).val();

            // set selected text to input
            var region_text = $(this).find("option:selected").text();
            let region_input = $('#region-text');
            region_input.val(region_text);
            //clear province & city & barangay input
            $('#province-text').val('');
            $('#city-text').val('');
            $('#barangay-text').val('');

            //province
            let dropdown = $('#province');
            dropdown.empty();
            dropdown.append('<option value="" >--Choose State/Province--</option>');
            dropdown.prop('selectedIndex', 0);

            //city
            let city = $('#city');
            city.empty();
            city.append('<option selected="true" disabled></option>');
            city.prop('selectedIndex', 0);

            //barangay
            let barangay = $('#barangay');
            barangay.empty();
            barangay.append('<option selected="true" disabled></option>');
            barangay.prop('selectedIndex', 0);

            // filter & fill
            var url = _base_url_ + 'dist/ph-json/province.json';
            $.getJSON(url, function(data) {
                var result = data.filter(function(value) {
                    return value.region_code == region_code;
                });

                result.sort(function(a, b) {
                    return a.province_name.localeCompare(b.province_name);
                });

                $.each(result, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
                })

            });
        },
        // fill city
        fill_cities: function() {
            //selected province
            var province_code = $(this).val();

            // set selected text to input
            var province_text = $(this).find("option:selected").text();
            let province_input = $('#province-text');
            province_input.val(province_text);
            //clear city & barangay input
            $('#city-text').val('');
            $('#barangay-text').val('');

            //city
            let dropdown = $('#city');
            dropdown.empty();
            dropdown.append('<option value="" >--Choose city/municipality--</option>');
            dropdown.prop('selectedIndex', 0);

            //barangay
            let barangay = $('#barangay');
            barangay.empty();
            barangay.append('<option selected="true" disabled></option>');
            barangay.prop('selectedIndex', 0);

            // filter & fill
            var url = _base_url_ + 'dist/ph-json/city.json';
            $.getJSON(url, function(data) {
                var result = data.filter(function(value) {
                    return value.province_code == province_code;
                });

                result.sort(function(a, b) {
                    return a.city_name.localeCompare(b.city_name);
                });

                $.each(result, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
                })

            });
        },
        // fill barangay
        fill_barangays: function() {
            // selected barangay
            var city_code = $(this).val();

            // set selected text to input
            var city_text = $(this).find("option:selected").text();
            let city_input = $('#city-text');
            city_input.val(city_text);
            //clear barangay input
            $('#barangay-text').val('');

            // barangay
            let dropdown = $('#barangay');
            dropdown.empty();
            // dropdown.append('<option selected="true" disabled>Choose barangay</option>');
            dropdown.append('<option value="">--Choose Barangay--</option>');
            dropdown.prop('selectedIndex', 0);

            // filter & Fill
            var url = _base_url_ + 'dist/ph-json/barangay.json';
            $.getJSON(url, function(data) {
                var result = data.filter(function(value) {
                    return value.city_code == city_code;
                });

                result.sort(function(a, b) {
                    return a.brgy_name.localeCompare(b.brgy_name);
                });

                $.each(result, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
                })

            });
        },

        onchange_barangay: function() {
            // set selected text to input
            var barangay_text = $(this).find("option:selected").text();
            let barangay_input = $('#barangay-text');
            barangay_input.val(barangay_text);
        },

    };


    $(function() {
        // events
        $('#region').on('change', my_handlers.fill_provinces);
        $('#province').on('change', my_handlers.fill_cities);
        $('#city').on('change', my_handlers.fill_barangays);
        $('#barangay').on('change', my_handlers.onchange_barangay);

        // load region
        let dropdown = $('#region');
        dropdown.empty();
        dropdown.append('<option value="<?php echo isset($region) ? $region : '' ?>" ><?php echo isset($region) ? $region : '--Choose Region--' ?></option>');
        dropdown.prop('selectedIndex', 0);
        const url = _base_url_ + 'dist/ph-json/region.json';
        // Populate dropdown with list of regions
        $.getJSON(url, function(data) {
            $.each(data, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
            })
        });

    });

    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })
        // client form fucntion

        // client form fucntion
        $('#client-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/users.php?f=save_client",
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
                        alert_toast("Applicant information successfully updated", 'success')
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
        $('#client-form1').submit(function(e) {
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
        $('#client-form2').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/users.php?f=save_client",
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
                        alert_toast("Medical status successfully updated", 'success')
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
        $('#client-form3').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/users.php?f=assess_client",
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
                        alert_toast("Applicants successfully assigned.", 'success')
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


    // function displayImg(input, _this) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $('#cimg').attr('src', e.target.result);
    //             _this.siblings('label').text(input.files[0].name)
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         $('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
    //         _this.siblings('label').text('Choose file')
    //     }
    // }
</script>