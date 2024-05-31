<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `prf_request` where md5(id) = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    input {
        pointer-events: none;
    }

    select {
        pointer-events: none;
    }

    .select2 {
        pointer-events: none;
    }

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
    <div class="card-header">
        <h4 class="card-title card-primary">Create new prf</h4>
    </div>
    <div class="card-body">
        <form action="" id="ir-form">
            <input type="hidden" name="id" value="<?php echo isset($id)  ? $id : '' ?>">
            <input type="hidden" name="requestor_id" value="<?php echo isset($requestor_id)  ? $requestor_id : '' ?>">
            <h4 class="text-center"><strong>PERSONNEL REQUISITION FORM</strong></h4>
            <div class="container-fluid">
                <div class=" justify-content-end row">
                    <label class=" col-form-label text-info">PRF No.</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control form-control-sm rounded-0 text-inline" id="prf_no" name="prf_no" value="<?php echo isset($prf_no) ? $prf_no :  date('Y') . '-' . sprintf("%03d", $control_no + 1) ?>">
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
                        <input required type="text" name="requestor_name" id="requestor_name" class="form-control form-control-sm  rounded-0" readonly value="<?php echo isset($requestor_name)  ? $requestor_name : '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label text-info">Department</label>
                        <input required readonly type="text" name="requestor_department" id="requestor_department" class="form-control form-control-sm readonly rounded-0" value="<?php echo isset($requestor_department)  ? $requestor_department : '' ?>">
                    </div>
                </div>
                <br>
                <h5>Employment Requirement:</h5>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label  text-info">Job title: </label>
                        <select name="job_title" id="job_title" onchange="showHint(this.value)" class="form-control form-control-sm select2" required>
                            <option value="" disabled <?= !isset($job_title) ? "selected" : "" ?>>--Select Job Title--</option>
                            <?php
                            $application = $conn->query("SELECT * FROM `position`  ORDER BY position");
                            while ($row = $application->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['id'] ?>" <?php echo isset($job_title) && $job_title == $row['id'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label text-info">No of requested personnel</label>
                        <input required type="number" name="no_req" class="form-control form-control-sm  rounded-0" value="<?php echo isset($no_req)  ? $no_req : '' ?>">
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

                    <!-- <div class="col-md-4">
                        <label class="control-label text-info">Job level</label>
                        <select name="job_level" required class="custom-select">
                            <option value="" disabled selected>--Select Job Level--</option>
                            <option <?php echo isset($job_level) && $job_level == 1 ? 'selected' : '' ?> value="1">Direct</option>
                            <option <?php echo isset($job_level) && $job_level == 2 ? 'selected' : '' ?> value="2">Non-exempt</option>
                            <option <?php echo isset($job_level) && $job_level == 3 ? 'selected' : '' ?> value="3">Exempt</option>
                            <option <?php echo isset($job_level) && $job_level == 4 ? 'selected' : '' ?> value="4">Section head</option>
                            <option <?php echo isset($job_level) && $job_level == 5 ? 'selected' : '' ?> value="5">Manager</option>
                            <option <?php echo isset($job_level) && $job_level == 6 ? 'selected' : '' ?> value="6">Senior management</option>
                        </select>
                    </div> -->
                    <div class="col-md-12 mt-2">
                        <label class="control-label text-info">Job description</label>
                        <textarea type="text" readonly name="job_desc" id="job_desc" rows="5" class="form-control form-control-sm  rounded-0"><?php echo isset($job_desc)  ? $job_desc : '' ?></textarea>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="control-label text-info">Qualifications</label>
                        <textarea type="text" readonly name="job_quali" id="job_quali" rows="5" class="form-control form-control-sm  rounded-0"><?php echo isset($job_quali)  ? $job_quali : '' ?></textarea>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="control-label text-info">Reason</label>
                        <select name="prf_reason" id="prf_reason" class="form-control form-control  rounded-0" required>
                            <option value="" selected disabled>--Select Reason--</option>
                            <option value="Additional manpower" <?php echo isset($prf_reason) && $prf_reason == 'Additional manpower'  ? 'selected' : '' ?>>Additional manpower</option>
                            <option value="Replacement" <?php echo isset($prf_reason) && $prf_reason == 'Replacement'  ? 'selected' : '' ?>>Replacement</option>
                        </select>
                        <!-- <textarea type="text" required name="prf_reason" rows="2" class="form-control form-control-sm  rounded-0"><?php echo isset($prf_reason)  ? $prf_reason : '' ?></textarea> -->
                    </div>
                    <?php
                    if (isset($prf_reason) && $prf_reason == 'Replacement') {
                        $options = $conn->query("SELECT * FROM `prf_replacement` where `prf_no` = '$prf_no'");
                        while ($row = $options->fetch_assoc()) :
                    ?>
                            <div class="col-md-6">
                                <label class="control-label text-info">Replacement for</label>
                                <input type="text" disabled class="form-control  rounded-0" value="<?php echo isset($row['replacement']) ? $row['replacement'] : 'N/A' ?>" readonly>
                            </div>
                            <div class="col-md-6">
                            </div>
                        <?php endwhile;
                    } else { ?>
                        <div class="col-md-6 mt-2">
                            <label class="control-label text-info">Employment Status</label>
                            <input type="text" disabled class="form-control  rounded-0" value="<?php echo isset($employment_status) ? $employment_status : 'N/A' ?>" readonly>
                        </div>
                    <?php } ?>

                    <!-- <div class="col-md-6">
                <label class="control-label text-info">Replacement for</label>
                <select name="replacement" id="replacement" disabled class="form-control form-control-sm rounded-0 select2" required>
                    <option value="" disabled <?= !isset($replacement) ? "selected" : "" ?>></option>
                    <?php
                    $category = $conn->query("SELECT EMPNAME FROM `employee_masterlist` where EMPLOYID !=0");
                    while ($row = $category->fetch_assoc()) :
                    ?>
                        <option value="<?= $row['EMPNAME'] ?>" <?php echo isset($replacement) && $replacement == $row['EMPNAME'] ? 'selected' : '' ?>><?= $row['EMPNAME'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div> -->

                </div>

                <br>
                <div class="row py-1 justify-content-center text-center">
                    <a class="btn btn-block col-2 mr-3 btn-success view_" href="javascript:void(0)" data-id="<?php echo $prf_no ?>"><span class="fa fa-eye text-dark"></span> View applicants</a><br>
                    <!-- <button class="btn btn-flat btn-primary" type="submit" form="ir-form">SUBMIT</button> -->
                    <a class="btn btn-block col-2 btn-dark" href="<?php echo base_url . '/admin?page=prf/all' ?>">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('.view_').click(function() {
        uni_modal('PRF Applicants', _base_url_ + "admin/prf/view_applicants.php?id=" + $(this).attr('data-id'), 'large')
    })
    // function showHint(str) {
    //     if (str.length == 0) {
    //         document.getElementById("job_desc").value = "";
    //         document.getElementById("department").value = "";
    //         document.getElementById("shift").value = "";
    //         return;
    //     } else {
    //         var xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function() {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 document.getElementById("job_desc").value = this.responseText;
    //                 // document.getElementById("requestor_department").value = this.responseText;
    //             }
    //         };
    //         xmlhttp.open("GET", _base_url_ + "get_job_desc.php?q=" + str, true);
    //         xmlhttp.send();
    //         //--------------------------------------------//

    //         var xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function() {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 document.getElementById("job_quali").value = this.responseText;
    //                 // document.getElementById("requestor_department").value = this.responseText;
    //             }
    //         };
    //         xmlhttp.open("GET", _base_url_ + "get_job_quali.php?q=" + str, true);
    //         xmlhttp.send();

    //         //--------------------------------------------//
    //         var xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function() {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 document.getElementById("shift").value = this.responseText;
    //                 // document.getElementById("requestor_department").value = this.responseText;
    //             }
    //         };
    //         xmlhttp.open("GET", _base_url_ + "get_shift.php?q=" + str, true);
    //         xmlhttp.send();


    //     }

    // }


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
    $('#prf_reason').on('change', function() {
        console.log($('#prf_reason').val())
        if ($('#prf_reason').val() == 'Replacement') {
            $('#replacement').removeAttr('disabled')
        } else {
            $('#replacement').attr('disabled', true)
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
    })

    // document.getElementById("ir_form").addEventListener("keydown", function(event) {
    //     // Check if the Enter key is pressed (key code 13)
    //     if (event.key === "Enter") {
    //         // Prevent the default form submission behavior
    //         event.preventDefault();
    //     }
    // });
</script>