<?php
// if (isset($_GET['id']) && $_GET['id'] > 0) {
//     $qry = $conn->query("SELECT * from `ir_requests` where id = '{$_GET['id']}' ");
//     if ($qry->num_rows > 0) {
//         foreach ($qry->fetch_assoc() as $k => $v) {
//             $$k = $v;
//         }
//     }
// }

$year = date('Y'); // Get the current year
$control_no = $conn->query("SELECT * FROM prf_request WHERE YEAR(date_created) = $year")->num_rows;

?>
<style>
    input.form-control:read-only {
        background-color: #fff;
    }

    select.custom-select:disabled {
        background-color: #fff;
    }

    textarea.form-control:read-only {
        background-color: #fff;
    }
</style>
<div class="card card-outline card-primary  overflow-auto">
    <!-- <div class="card-header">
        <h4 class="card-title card-primary">Create new prf</h4>
    </div> -->
    <div class="card-body">
        <form action="" id="ir-form">
            <input type="hidden" name="id" value="<?php echo isset($id)  ? $id : '' ?>">
            <input type="hidden" name="requestor_id" value="<?php echo $_settings->userdata('EMPLOYID') ?>">
            <h4 class="text-center"><strong>PERSONNEL REQUISITION</strong></h4>
            <div class="container-fluid">
                <div class=" justify-content-end row">
                    <label class=" col-form-label text-info">PRF No.</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control form-control-sm rounded-0 text-inline" id="prf_no" value="<?php echo isset($prf_no) ? $prf_no :  date('Y') . '-' . sprintf("%03d", $control_no + 1) ?>">
                    </div>
                </div>
                <div class=" justify-content-end row">
                    <label class=" col-form-label text-info">Date</label>
                    <div class="col-sm-3">
                        <input type="date" readonly class="form-control form-control-sm  rounded-0" value="<?php echo isset($date_created)  ? date('Y-m-d', strtotime($date_created)) : date('Y-m-d') ?>">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">Requestor name</label>
                        <input required type="text" name="requestor_name" id="requestor_name" class="form-control form-control-sm  rounded-0" readonly value="<?php echo $_settings->userdata('EMPNAME') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label text-info">Department</label>
                        <input required readonly type="text" name="requestor_department" id="requestor_department" class="form-control form-control-sm readonly rounded-0" value="<?php echo  $_settings->userdata('DEPARTMENT') ?>">
                    </div>
                </div>
                <br>
                <h5 class="text-info">Employment Requirement:</h5>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label  text-info">Job title: </label>
                        <select name="job_title" id="job_title" onchange="showHint(this.value)" class="form-control form-control-sm select2" required>
                            <option value="" disabled <?= !isset($job_title) ? "selected" : "" ?>>--Select Job Title--</option>
                            <?php


                            if ($_settings->userdata('EMPPOSITION') != 5) {
                                $value = $_settings->userdata('DEPARTMENT');
                                if (strpos($value, 'Production') !== false) {
                                    // The $value contains the word "Production"
                                    // echo "The value contains 'Production'";
                                    $application = $conn->query("SELECT * FROM `position` WHERE department = 'Production' ORDER BY position");
                                } else {
                                    // The $value does not contain the word "Production"
                                    // echo "The value does not contain 'Production'";
                                    $application = $conn->query("SELECT * FROM `position` WHERE department = '{$_settings->userdata('DEPARTMENT')}' ORDER BY position");
                                }
                            } else if ($_settings->userdata('EMPPOSITION') == 5) {
                                $application = $conn->query("SELECT * FROM `position` ORDER BY position");
                            }
                            while ($row = $application->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['id'] ?>" <?php echo isset($job_title) && $job_title == $row['id'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label text-info">No of requested personnel</label>
                        <input required type="number" name="no_req" id="no_req" class="form-control form-control-sm  rounded-0" value="<?php echo isset($no_req)  ? $no_req : '' ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="station" class="control-label text-info">Station</label>
                        <select name="station" id="station" class="form-control form-control-sm rounded-0 select2" required>
                            <option value="" disabled <?= !isset($station) ? "selected" : "" ?>></option>
                            <?php
                            $category = $conn->query("SELECT DISTINCT STATION FROM `employee_masterlist`");
                            while ($row = $category->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['STATION'] ?>" <?php echo isset($station) && $station == $row['STATION'] ? 'selected' : '' ?>><?= $row['STATION'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="productline" class="control-label text-info">Product line</label>
                        <select name="productline" id="productline" class="form-control form-control-sm rounded-0 select2" required>
                            <option value="" disabled <?= !isset($productline) ? "selected" : "" ?>></option>
                            <?php
                            $category = $conn->query("SELECT DISTINCT PRODLINE FROM `employee_masterlist`");
                            while ($row = $category->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['PRODLINE'] ?>" <?php echo isset($productline) && $productline == $row['PRODLINE'] ? 'selected' : '' ?>><?= $row['PRODLINE'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="control-label text-info">Job description</label>
                        <textarea readonly name="job_desc" id="job_desc" rows="5" class="form-control form-control-sm  rounded-0"><?php echo isset($job_desc)  ? $job_desc : '' ?></textarea>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="control-label text-info">Qualifications</label>
                        <textarea readonly name="job_quali" id="job_quali" rows="5" class="form-control form-control-sm  rounded-0"><?php echo isset($job_quali)  ? $job_quali : '' ?></textarea>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="control-label text-info">Reason</label>
                        <select disabled name="prf_reason" id="prf_reason" class="form-control form-control select2 rounded-0" required>
                            <option value="" selected disabled>--Select Reason--</option>
                            <option value="Additional manpower">Additional manpower</option>
                            <option value="Replacement">Replacement</option>
                        </select>
                        <!-- <textarea type="text" required name="prf_reason" rows="2" class="form-control form-control-sm  rounded-0"><?php echo isset($prf_reason)  ? $prf_reason : '' ?></textarea> -->
                    </div>
                    <!-- <fieldset>
                        <div id="option-list">
                            <div class="row item">
                                <label class="control-label text-info">Replacement for</label>
                                <select name="replacement"  disabled class="form-control form-control-sm rounded-0 select2" required>
                                    <option value="" disabled <?= !isset($replacement) ? "selected" : "" ?>></option>
                                    <?php
                                    $category = $conn->query("SELECT EMPNAME FROM `employee_masterlist` where EMPLOYID !=0");
                                    while ($row = $category->fetch_assoc()) :
                                    ?>
                                        <option value="<?= $row['EMPNAME'] ?>" <?php echo isset($replacement) && $replacement == $row['EMPNAME'] ? 'selected' : '' ?>><?= $row['EMPNAME'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="my-2 text-center">
                            <button class="btn btn-primary btn-block-sm" id="add_option" type="button"><i class="fa fa-plus"></i> Add Sibling</button>
                        </div>
                    </fieldset> -->
                    <div class="col-md-6 rep mt-2">
                        <label class="control-label text-info">Replacement for</label>
                        <select name="replacement[]" disabled class="form-control form-control rounded-0 select2 lala replacement" required>
                            <option value="" disabled selected>--Select Employee--</option>
                            <?php
                            $category = $conn->query("SELECT EMPNAME FROM `employee_masterlist` where EMPLOYID !=0");
                            while ($row = $category->fetch_assoc()) :
                            ?>
                                <option value="Not on the list">Not on the list</option>
                                <option value="<?= $row['EMPNAME'] ?>" <?php echo isset($replacement) && $replacement == $row['EMPNAME'] ? 'selected' : '' ?>><?= $row['EMPNAME'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        <div id="option-list">
                            <div class="item">
                            </div>
                        </div>
                        <div class="my-2 text-center">
                            <button class="btn btn-primary btn-block-sm rep_btn d-none aopt" id="add_option" type="button"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="col-md-6  mt-2 add">
                        <label class="control-label text-info">Employment Status</label>
                        <select name="employment_status" id="employment_status" disabled class="form-control form-control rounded-0 select2" required>
                            <option value="" disabled selected>--Select Status--</option>
                            <option value="Contractual">Contractual</option>
                            <option value="Probationary">Probationary</option>
                        </select>
                    </div>
                    <noscript id="option-clone">
                        <div class="item  mt-2">
                            <div id="option-list">

                                <span>
                                    <label class="control-label text-info">Replacement for </label>
                                    <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option m-2 text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option1"><i class="fa fa-times"></i></a>
                                </span>
                                <select name="replacement[]" class="form-control form-control rounded-0 select2 replacement" required>
                                    <option value="" disabled selected>--Select Employee--</option>
                                    <?php
                                    $category = $conn->query("SELECT EMPNAME FROM `employee_masterlist` where EMPLOYID !=0");
                                    while ($row = $category->fetch_assoc()) :
                                    ?>
                                        <option value="Not on the list">Not on the list</option>
                                        <option value="<?= $row['EMPNAME'] ?>" <?php echo isset($replacement) && $replacement == $row['EMPNAME'] ? 'selected' : '' ?>><?= $row['EMPNAME'] ?></option>
                                    <?php endwhile; ?>
                                </select>

                            </div>
                        </div>
                    </noscript>
                </div>
                <input readonly type="hidden" name="requestor_pl" class="form-control form-control-sm  rounded-0" value="<?php echo $_settings->userdata('PRODLINE') ?>">
                <br>
                <?php
                $appr1 = $conn->query("SELECT EMPPOSITION FROM `employee_masterlist` WHERE EMPLOYID = '{$_settings->userdata('EMPLOYID')}'")->fetch_array();
                // $appr2 = $conn->query("SELECT EMPNAME FROM `employee_masterlist` WHERE EMPLOYID = 1432")->fetch_array();
                // echo $appr1[0];

                if (isset($appr1[0]) && $appr1[0] < 4 && $_settings->userdata('EMPLOYID') != 108 && $_settings->userdata('EMPLOYID') != 600) {
                ?>
                    <input readonly type="hidden" name="dh_name" class="form-control form-control-sm  rounded-0" value="1">
                <?php } else if (isset($appr1[0]) && $appr1[0] >= 5) { ?>
                    <input readonly type="hidden" name="dh_name" class="form-control form-control-sm  rounded-0" value="1432">
                    <input readonly type="hidden" name="od_name" class="form-control form-control-sm  rounded-0" value="1432">
                    <input readonly type="hidden" name="dh_status" class="form-control form-control-sm  rounded-0" value="1">
                    <input readonly type="hidden" name="dh_sign_date" class="form-control form-control-sm  rounded-0" value="<?php echo date('Y-m-d') ?>">
                    <input readonly type="hidden" name="od_status" class="form-control form-control-sm  rounded-0" value="1">
                    <input readonly type="hidden" name="od_sign_date" class="form-control form-control-sm  rounded-0" value="<?php echo date('Y-m-d') ?>">
                    <input readonly type="hidden" name="prf_status" class="form-control form-control-sm  rounded-0" value="2">
                <?php } ?>

                <!-- <div class="row justify-content-between">
                    <div class="form-group  col-5">
                        <label class="control-label  text-info">For Approval </label>
                        <input readonly type="text" class="form-control form-control-sm  rounded-0" value="<?php echo isset($appr1[0]) ? $appr1[0] : '' ?>">
                        <input readonly type="hidden" name="dh_name" class="form-control form-control-sm  rounded-0" value="<?php echo $_settings->userdata('APPROVER1') ?>">
                        <i class="text-info" style="display:block; text-align: center;">Approver 1</i>
                    </div>
                    <div class="col-4">
                        <label class="control-label  text-info">Date </label>
                        <input readonly type="date" name="dh_sign_date" class="form-control form-control-sm  rounded-0" value="<?php echo isset($dh_sign_date)  ? date('Y-m-d', strtotime($dh_sign_date)) : '' ?>">
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="form-group  col-5">
                        <label class="control-label  text-info">For Approval </label>
                        <input readonly type="text" class="form-control form-control-sm  rounded-0" value="<?php echo isset($appr2[0]) ? $appr2[0] : '' ?>">
                        <input readonly type="hidden" name="od_name" class="form-control form-control-sm  rounded-0" value="1432">


                        <i class="text-info" style="display:block; text-align: center;">Approver 2</i>
                    </div>
                    <div class="col-4">
                        <label class="control-label  text-info">Date </label>
                        <input readonly type="date" name="od_sign_date" class="form-control form-control-sm  rounded-0" value="<?php echo isset($od_sign_date)  ? date('Y-m-d', strtotime($od_sign_date)) : '' ?>">
                    </div>
                </div> -->
                <div class=" py-1 text-center">
                    <button class="btn btn-flat btn-primary" type="submit" form="ir-form">SUBMIT</button>
                    <a class="btn btn-flat btn-dark" href="<?php echo base_url . '/admin?page=prf/request' ?>">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("job_desc").value = "";
            document.getElementById("department").value = "";
            document.getElementById("shift").value = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("job_desc").value = this.responseText;
                    // document.getElementById("requestor_department").value = this.responseText;
                }
            };
            xmlhttp.open("GET", _base_url_ + "get_job_desc.php?q=" + str, true);
            xmlhttp.send();
            //--------------------------------------------//

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("job_quali").value = this.responseText;
                    // document.getElementById("requestor_department").value = this.responseText;
                }
            };
            xmlhttp.open("GET", _base_url_ + "get_job_quali.php?q=" + str, true);
            xmlhttp.send();

            //--------------------------------------------//
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("shift").value = this.responseText;
                    // document.getElementById("requestor_department").value = this.responseText;
                }
            };
            xmlhttp.open("GET", _base_url_ + "get_shift.php?q=" + str, true);
            xmlhttp.send();


        }

    }


    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })
    })
    var messageType = 1;

    // $(window).on("beforeunload", function(event) {
    //     // Show a warning message
    //     if (messageType == 1) {
    //         return "Are you sure you want to leave? Your changes may not be saved.";
    //     }

    // });
    // $(document).ready(function() {
    //     $('#no_req').change(function() {
    //         for (var i = 0; i < $('#no_req').val(); i++) {
    //             $('#add_option').click()
    //             console.log("Iteration " + (i + 1));
    //         }
    //     })

    // });
    var clickCount = 1; // Initialize click count

    // Attach a click event handler to the sample button
    $('#add_option').click(function() {
        clickCount++; // Increment click count
        if (clickCount == $('#no_req').val()) {
            // Enable the submit button when the condition is met
            $('.aopt').attr('disabled', true);
        }
        console.log('dsad', clickCount)
    });


    $('#add_option').click(function() {
        // Clone the template option and convert it into a jQuery object
        var item = $($('#option-clone').html()).clone();
        item.find('.select2').select2({
            width: 'resolve'
        })
        // Append the modified item to the option list
        $('#option-list').append(item);
        // Attach event handlers to the cloned item

        // item.find('.lala').addClass('select2');

        item.find('.remove-option').click(function() {
            $(this).closest('.item').remove();
            clickCount--;
            if (clickCount < $('#no_req').val()) {
                $('.aopt').removeAttr('disabled');
            }
            console.log('dsad', clickCount)
        });
    });
    $('#no_req').on('change', function() {
        if ($('#no_req').val() != '' && $('#no_req').val() != 0) {
            $('#prf_reason').removeAttr('disabled')
        } else {
            $('#prf_reason').attr('disabled', true)
        }
        if (clickCount < $('#no_req').val() && $('#prf_reason').val() == 'Replacement') {
            $('.rep_btn').removeAttr('disabled')
        } else if (clickCount > $('#no_req').val() && $('#prf_reason').val() == 'Replacement') {
            $('.rep_btn').attr('disabled', true)
        }
    })
    $('.rep').addClass('d-none')
    $('.add').addClass('d-none')
    $('#prf_reason').on('change', function() {
        console.log($('#prf_reason').val())
        if ($('#prf_reason').val() == 'Replacement') {
            $('.replacement').removeAttr('disabled')
            $('.rep').removeClass('d-none')
            $('#employment_status').attr('disabled', true)
            $('.add').addClass('d-none')
            $('#employment_status').val('')
            if ($('#no_req').val() > 1)
                $('.rep_btn').removeClass('d-none')
        } else {
            $('.replacement').val('')
            $('#option-list').empty();
            $('.rep_btn').addClass('d-none')
            $('.replacement').attr('disabled', true)
            $('.rep').addClass('d-none')
            $('.add').removeClass('d-none')
            $('#employment_status').removeAttr('disabled')
        }
    })

    $('.new_ir').click(function() {
        // if ($('#hr_received').val() !== '' && $('#ads_date').val() !== '') {
        uni_modal("Add Incident", "ir_form/add_ir.php?id=" + $(this).attr('data-id') + "&ir=" + $(this).attr('data-ir'));
        // } else {
        //     $('#sub').click()
        // }
    })

    $('#ir-form').submit(function(e) {
        if (clickCount < $('#no_req').val() && $('#prf_reason').val() == 'Replacement') {
            alert_toast("&nbsp Insufficient applicant name to be replace.", 'warning')
            e.preventDefault();
        } else if (clickCount > $('#no_req').val() && $('#prf_reason').val() == 'Replacement') {
            alert_toast("&nbsp There's an excess input of applicant names.", 'warning')
            e.preventDefault();
        } else {
            e.preventDefault();
            messageType = 2;
            var _this = $(this)
            $('.err-msg').remove();
            var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_prf_request",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.error(err)
                    el.addClass('alert-danger').text("An error occured");
                    _this.prepend(el)
                    el.show('.modal')
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Personnel request successfully passed", 'success')
                        // location.reload();
                        location.replace(_base_url_ + 'admin/?page=prf/request')
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
        }
    })

    // document.getElementById("ir_form").addEventListener("keydown", function(event) {
    //     // Check if the Enter key is pressed (key code 13)
    //     if (event.key === "Enter") {
    //         // Prevent the default form submission behavior
    //         event.preventDefault();
    //     }
    // });
</script>