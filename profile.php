<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User profile</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <style>
                        .profile-picture {
                            position: relative;
                            display: inline-block;
                            overflow: hidden;
                            width: 100px;
                            /* Adjust the size as needed */
                            height: 100px;
                            /* Adjust the size as needed */
                        }

                        .profile-user-img {
                            width: 100%;
                            height: 100%;
                        }

                        .edit-button {
                            position: absolute;
                            bottom: 10px;
                            /* Adjust the distance from the bottom */
                            right: 10px;
                            /* Adjust the distance from the right */
                            background-color: transparent;
                            color: #333;
                            /* Adjust the color as needed */
                            border: none;
                            border-radius: 50%;
                            padding: 2px;
                            cursor: pointer;
                            transition: background-color 0.3s;
                        }

                        .edit-button i {
                            font-size: 20px;
                        }

                        .edit-button:hover {
                            background-color: #eee;
                            /* Adjust the hover background color as needed */
                        }
                    </style>
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center position-relative">
                                <div class="profile-picture">
                                    <img class="profile-user-img img-fluid img-circle" src="dist/img/pp.png" alt="User profile picture">
                                    <button class="edit-button edt" onclick="editProfile()">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                            </div>


                            <h3 class="profile-username text-center"> <?php echo ucwords(strtolower($_settings->userdata('firstname'))) ?> <?php echo ucwords(strtolower($_settings->userdata('surname'))) ?></h3>

                            <p class="text-muted text-center"><?php echo ucwords(strtolower($_settings->userdata('position_name'))) ?></p>
                            <hr>


                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                <?php echo ucwords(strtolower($_settings->userdata('education'))) ?> <?php echo ucwords(strtolower($_settings->userdata('course'))) ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                            <p class="text-muted"><?php echo ucwords(strtolower($_settings->userdata('current_address'))) ?> <?php echo ucwords(strtolower($_settings->userdata('barangay'))) ?> <?php echo ucwords(strtolower($_settings->userdata('city'))) ?>, <?php echo ucwords(strtolower($_settings->userdata('province'))) ?></p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Work experience</strong>

                            <p class="text-muted">
                                <?php
                                $options = $conn->query("SELECT * FROM `work_experience` where `applicant_id` = '{$_settings->userdata('id')}' and company !='' ");
                                ?>
                                <?php
                                if ($options->num_rows <= 0) {
                                    echo '<span class="tag tag-success">No experience</span>';
                                } else {
                                    while ($row = $options->fetch_assoc()) :
                                        $startDate = date_create($row['start']);
                                        $endDate = date_create($row['end']);
                                        $interval = date_diff($startDate, $endDate);
                                        $months = $interval->format('%m');
                                        $years = floor($months / 12);

                                ?>
                            <div class="row">
                                <div class="col-4">
                                    Company: <span class="tag tag-success"><?php echo isset($row['company']) ? $row['company'] : 'N/A' ?></span><br>
                                </div>
                                <div class="col-4">
                                    Position: <span class="tag tag-info"><?php echo isset($row['position']) ? $row['position'] : 'N/A' ?></span><br>
                                </div>
                                <div class="col-4">
                                    Duration: <span class="tag tag-warning"><?php echo isset($months) ? $months . ' ' . 'Month(s)' : 'N/A' ?></span><br><br>
                                </div>
                            </div>

                    <?php
                                    endwhile;
                                } ?>

                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Application status</strong>
                    <br>
                    <p class="text-muted">
                        <?php
                        $checks = $conn->query("SELECT a_position FROM  `assessment` where id='{$_settings->userdata('id')}'");
                        $rowscount = $checks->num_rows;
                        if ($rowscount == 1) {
                            $choose = $conn->query("SELECT choose FROM  `assessment` where id='{$_settings->userdata('id')}'")->fetch_array()[0];
                        } else {
                            $choose = NULL;
                        }
                        ?>
                        <?php if ($_settings->userdata('passed') == 1) { ?>
                            <!-- <span class="badge  rounded-pill px-3 badge-success">Passed</span> -->
                            <?php if ($_settings->userdata('assess') == 0 && $_settings->userdata('pdf') == 0) : ?>
                                <span class="badge  rounded-pill px-3 bg-navy">For interview</span>
                            <?php elseif ($_settings->userdata('assess') == 1 && $_settings->userdata('pdf') == 0 && $choose == 2) : ?>
                                <span class="badge  rounded-pill px-3 bg-danger">Failed in interview</span>
                            <?php elseif ($_settings->userdata('assess') == 1 && $_settings->userdata('pdf') == 0 && $_settings->userdata('job_offer') == 0 && $_settings->userdata('application') != 1 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-info">For job offer</span>
                            <?php elseif ($_settings->userdata('assess') == 1 && $_settings->userdata('pdf') == 0 && $_settings->userdata('job_offer') == 2 && $_settings->userdata('application') != 1 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-danger">Job offer rejected</span>
                            <?php elseif ($_settings->userdata('assess') == 1 && $_settings->userdata('pdf') == 0 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-warning">For requirement</span>
                            <?php elseif ($_settings->userdata('assess') == 1 && $_settings->userdata('pdf') != 0 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-primary">For medical</span>
                            <?php elseif ($_settings->userdata('status') == 1 && $_settings->userdata('assess') == 1 && $_settings->userdata('pdf') != 0 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-success">Fit to work</span>
                            <?php elseif ($_settings->userdata('status') == 1 && $_settings->userdata('assess') == 1 && $_settings->userdata('pdf') != 0 && $choose != 2) : ?>
                                <span class="badge  rounded-pill px-3 badge-success">For Orientation</span>
                            <?php endif; ?>
                        <?php    } elseif ($_settings->userdata('passed') == 2) { ?>
                            <span class="badge  rounded-pill px-3 badge-danger">Failed in exam</span>
                        <?php    } else { ?>
                            <span class="badge  rounded-pill px-3 bg-yellow">For exam</span>
                        <?php }; ?>


                    </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(document).ready(function() {
        $('.edt').click(function() {
            uni_modal('', _base_url_ + "admin/uploads/index.php?id=" + $(this).attr('data-id'), 'small')
        })
    })
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
</script>