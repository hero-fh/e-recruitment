<style>
    td {
        vertical-align: middle;
    }
</style>
<div class="col-12 col-sm-12 lala">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1 ">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="pt-2 px-3">
                    <h3 class="card-title">List of personnel requisition</h3>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-active-tab" data-toggle="pill" href="#custom-tabs-one-active" role="tab" aria-controls="custom-tabs-one-active" aria-selected="true">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-history-tab" data-toggle="pill" href="#custom-tabs-one-history" role="tab" aria-controls="custom-tabs-one-history" aria-selected="false">History</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-active" role="tabpanel" aria-labelledby="custom-tabs-one-active-tab">
                    <div class="container-fluid  overflow-auto">
                        <table class="table table-bordered table-stripped text-center">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>PRF No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Department</th>
                                    <th>Requested Position</th>
                                    <th>No. of request personnel</th>
                                    <th>Hired</th>
                                    <th>Delta</th>
                                    <th>Recruitment Status</th>
                                    <th>Training Status</th>
                                    <th>Reason of request</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $qry = $conn->query("SELECT * FROM prf_request where prf_status=2 and prf_hold = 0 order by date_created desc");
                                while ($row = $qry->fetch_assoc()) :
                                    $hired = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status != 5 and date_commencement <= NOW()")->fetch_array()[0];
                                    $hired1 = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status != 5")->fetch_array()[0];
                                    $job_offer = $conn->query("SELECT count(asm.id) FROM applicants ap inner join assessment asm on ap.id=asm.id where asm.prf_no = '{$row['prf_no']}' AND (ap.job_offer = 0 OR ap.application = 1) AND ap.status = 2 AND ap.pdf = 0")->fetch_array()[0];
                                    $medical =  $conn->query("SELECT count(asm.id) FROM applicants ap inner join assessment asm on ap.id=asm.id where asm.prf_no = '{$row['prf_no']}' and (ap.job_offer=1 or ap.application=1) and ap.status=2")->fetch_array()[0];

                                    $badge = $conn->query("SELECT asm.name FROM assessment asm INNER JOIN applicants ap ON ap.id = asm.id WHERE asm.prf_no = '{$row['prf_no']}' AND (ap.job_offer = 1 OR ap.application = 1) AND ap.status = 1 AND ap.pdf = 1 AND asm.id NOT IN (SELECT applicant_name FROM prf_applicants WHERE prf_no = '{$row['prf_no']}')")->num_rows;


                                    // $medical = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=2")->fetch_array()[0];
                                    $orientation = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=3 and training_status = 0")->fetch_array()[0];
                                    $classroom = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=3 and training_status=1")->fetch_array()[0];
                                    $buddy = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=2")->fetch_array()[0];
                                    $validation = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=3")->fetch_array()[0];
                                    $certified = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=4")->fetch_array()[0];
                                    $awol = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=5")->fetch_array()[0];
                                    $rebatched = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=6")->fetch_array()[0];
                                    $delta1 = $row['no_req'] - $hired1;
                                    $delta2 = $delta1 - $job_offer;
                                    $delta = $delta2 - $medical;
                                    $delta =  $delta < 0 ?  0 :  $delta;
                                    $app_id = $conn->query("SELECT application_id from `position` where id = '{$row['job_title']}'")->fetch_array()[0];

                                ?>

                                    <tr>
                                        <!-- <td> <?php echo $i++ ?></td> -->
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>
                                        <td><?php echo $row['requestor_name'] ?></td>
                                        <td><?php echo $row['requestor_department'] ?></td>
                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>
                                        <td><?php echo $hired ?></td>
                                        <td><?php echo $delta ?></td>

                                        <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 0) : ?>
                                            <td>
                                                -- <!-- <span class="badge badge-secondary rounded-pill">Pending</span> -->
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 1) : ?>
                                            <td>
                                                -- <!-- <span class="badge badge-warning rounded-pill">Patially approved</span> -->
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 2) : ?>
                                            <td class="text-left">
                                                <?php echo $delta != 0 ? '<span class="badge rounded-pill">Ongoing hiring <span class="badge badge-primary rounded-pill">' . $delta . '</span></span><br>' : '' ?>
                                                <?php echo $job_offer != 0 ? '<span class="badge rounded-pill">For job offer <span class="badge badge-primary rounded-pill">' . $job_offer . '</span></span><br>' : '' ?>
                                                <?php echo $medical != 0 ? ' <span class="badge  rounded-pill">For medical requirement <span class="badge badge-primary rounded-pill">' . $medical . '</span></span><br>' : '' ?>
                                                <?php echo $orientation != 0 ? ' <span class="badge rounded-pill">For orientation <span class="badge badge-primary rounded-pill">' . $orientation . '</span></span>' : '' ?>
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 3) : ?>
                                            <td>
                                                --<!-- <span class="badge badge-danger rounded-pill">Disapproved</span> -->
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 4) : ?>
                                            <td>
                                                <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            </td>
                                        <?php elseif ($row['prf_hold'] == 1  && $row['prf_status'] != 6) : ?>
                                            <td>
                                                <span class="badge badge-primary rounded-pill">Hold</span>
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 6) : ?>
                                            <td>
                                                <span class="badge badge-success rounded-pill">Served</span>
                                            </td>
                                        <?php endif; ?>
                                        <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 0 && $classroom == 0) : ?>
                                            <td>
                                                -- <!-- <span class="badge badge-secondary rounded-pill">Pending</span> -->
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 1) : ?>
                                            <td>
                                                -- <!-- <span class="badge badge-warning rounded-pill">Patially approved</span> -->
                                            </td>

                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 2) : ?>
                                            <td class="text-left">
                                                <?php if ($app_id == 1) { ?>
                                                    <?php echo $classroom != 0 ? '<span class="badge rounded-pill">Classroom training <span class="badge badge-primary rounded-pill">' . $classroom . '</span></span><br>' : '' ?>
                                                    <?php echo $buddy != 0 ? '<span class="badge rounded-pill">Buddy training <span class="badge badge-primary rounded-pill">' . $buddy . '</span></span><br>' : '' ?>
                                                    <?php echo $validation != 0 ? '<span class="badge rounded-pill">Validation <span class="badge badge-primary rounded-pill">' . $validation . '</span></span><br>' : '' ?>
                                                    <?php echo $certified != 0 ? '<span class="badge rounded-pill">Certified <span class="badge badge-primary rounded-pill">' . $certified . '</span></span><br>' : '' ?>
                                                    <?php echo $awol != 0 ? '<span class="badge  rounded-pill">Discontinued/AWOL <span class="badge badge-primary rounded-pill">' . $awol . '</span></span><br>' : '' ?>
                                                    <?php echo $rebatched != 0 ? '<span class="badge rounded-pill">Rebatched <span class="badge badge-primary rounded-pill">' . $rebatched . '</span></span>' : '' ?>
                                                <?php } else if ($app_id != 1) { ?>
                                                    <?php echo $classroom != 0 ? '<span class="badge rounded-pill">Classroom training <span class="badge badge-primary rounded-pill">' . $classroom . '</span></span><br>' : '' ?>
                                                    <?php echo $buddy != 0 ? '<span class="badge rounded-pill">Buddy/Department training <span class="badge badge-primary rounded-pill">' . $buddy . '</span></span><br>' : '' ?>
                                                    <?php echo $validation != 0 ? '<span class="badge rounded-pill">Validation <span class="badge badge-primary rounded-pill">' . $validation . '</span></span><br>' : '' ?>
                                                    <?php echo $certified != 0 ? '<span class="badge rounded-pill">Certified <span class="badge badge-primary rounded-pill">' . $certified . '</span></span><br>' : '' ?>
                                                    <?php echo $awol != 0 ? '<span class="badge  rounded-pill">Discontinued/AWOL <span class="badge badge-primary rounded-pill">' . $awol . '</span></span><br>' : '' ?>
                                                    <?php echo $rebatched != 0 ? '<span class="badge rounded-pill">Rebatched <span class="badge badge-primary rounded-pill">' . $rebatched . '</span></span>' : '' ?>

                                                <?php } ?>
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 3) : ?>
                                            <td>
                                                -- <!-- <span class="badge badge-danger rounded-pill">Disapproved</span> -->
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 4) : ?>
                                            <td>
                                                <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            </td>
                                        <?php elseif ($row['prf_hold'] == 1  && $row['prf_status'] != 6) : ?>
                                            <td>
                                                <span class="badge badge-primary rounded-pill">Hold</span>
                                            </td>
                                        <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 6) : ?>
                                            <td>
                                                <span class="badge badge-success rounded-pill">Served</span>
                                            </td>
                                        <?php endif; ?>
                                        <!-- <td>
                                            <span class="badge badge-warning rounded-pill">For certification</span>
                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">

                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-hourglass text-warning"></span> For certification</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-handshake text-info"></span> Certified</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-medkit text-success"></span> Discontinued/AWOL</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-users text-danger"></span> Rebatched</a>
                                            </div>
                                        </td> -->
                                        <?php
                                        if ($row['prf_reason'] == 'Replacement') {
                                            $i = 1;

                                            echo '<td class="text-left">';

                                            echo 'Replacement For: <br>';
                                            $options = $conn->query("SELECT * FROM `prf_replacement` where `prf_no` = '{$row['prf_no']}'");
                                            while ($rows = $options->fetch_assoc()) :
                                        ?>
                                                <?php echo '' . $i++ . '. ' . $rows['replacement'] . '<br>'  // echo  isset($rows['replacement']) ? $row['prf_reason'] . ' for <b>' . $rows['replacement'] . '</b>' : $row['prf_reason'] 
                                                ?>
                                        <?php endwhile;
                                            echo '</td>';
                                        } else {
                                            echo '<td class="text-left">';

                                            echo $row['prf_reason'];
                                            echo ' for ';
                                            echo $row['employment_status'];
                                            echo '</td>';
                                        } ?>

                                        <td align="center">
                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu text-center" role="menu">
                                                <a class="dropdown-item" href="<?php echo base_url . 'admin?page=prf/view_prf&id=' . md5($row['id']) ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye"></span> View PRF</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item view_" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye"></span> View applicants</a>
                                                <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 2 && ($_settings->userdata('DEPARTMENT') == 'Human Resource' || $_settings->userdata('DEPARTMENT') == 'Training') && $delta != 0) : ?>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item add_app" data-prf="<?php echo $row['prf_no'] ?>" data-id="<?php echo $row['id'] ?>" data-req="<?php echo  $row['no_req'] ?>" href="javascript:void(0)"><i class="fa fa-plus"></i> Add Applicant <span class="badge badge-info badge-sm rounded-pill "><?php echo $badge ?></span></a>
                                                    <div class="dropdown-divider"></div>
                                                <?php endif; ?>
                                                <a class="dropdown-item close_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-check text-dark"></span> Close PRF</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                    <div class="container-fluid  overflow-auto">
                        <table class="table table-bordered table-stripped text-center">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>PRF No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Department</th>
                                    <th>PL</th>
                                    <th>Station</th>
                                    <th>Requested Position</th>
                                    <th>No. of requested personnnel</th>
                                    <th>PRF Status</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                // $qry = $conn->query("SELECT * FROM prf_request where prf_status !=2 or prf_hold = 1 order by date_created desc");
                                $where = 'AND (date_served >= DATE_SUB(NOW(), INTERVAL 365 DAY) OR date_served IS NULL)';
                                $qry = $conn->query("SELECT * FROM prf_request WHERE (prf_status != 2 OR prf_hold = 1) $where ORDER BY date_created DESC");

                                while ($row = $qry->fetch_assoc()) :
                                ?>

                                    <tr>
                                        <!-- <td><?php echo $i++ ?></td> -->
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>
                                        <td><?php echo $row['requestor_name'] ?></td>
                                        <td><?php echo $row['requestor_department'] ?></td>
                                        <td><?php echo $row['productline'] ?></td>
                                        <td><?php echo $row['station'] ?></td>
                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>
                                        <td class="text-center">
                                            <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 0 && $row['dh_name'] != 0) : ?>
                                                <span class="badge badge-secondary rounded-pill">Pending</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 0 && $row['dh_name'] == 0) : ?>
                                                <span class="badge badge-warning rounded-pill">Partially Approved</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 1) : ?>
                                                <span class="badge badge-warning rounded-pill">Partially Approved</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 2) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 3) : ?>
                                                <span class="badge badge-danger rounded-pill">Disapproved</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 4) : ?>
                                                <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            <?php elseif ($row['prf_hold'] == 1) : ?>
                                                <span class="badge badge-info rounded-pill">Hold</span>
                                            <?php elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 6) : ?>
                                                <span class="badge badge-success rounded-pill">Served</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 3) :
                                                echo $row['disappr_reason'];
                                            elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 4) :
                                                echo $row['cancel_reason'];
                                            elseif ($row['prf_hold'] == 1) :
                                                echo 'Date Hold' . ' ' . date('m-d-Y', strtotime($row['date_hold']));
                                            elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 6) :
                                                echo 'Date Served' . ' ' . date('m-d-Y', strtotime($row['date_served']));

                                            endif;
                                            ?>
                                        </td>
                                        <td align="center">
                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">

                                                <a class="dropdown-item" href="<?php echo base_url . 'admin?page=prf/view_prf&id=' . md5($row['id']) ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View PRF</a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.add_app').click(function() {
            uni_modal("New Applicants", "prf/add.php?id=" + $(this).attr('data-id') + "&prf=" + $(this).attr('data-prf') + "&req=" + $(this).attr('data-req'));
        })
        $('.delete_data').click(function() {
            _conf("Are you sure to cancel this?", "delete_po", [$(this).attr('data-id')])
        })
        $('.close_data').click(function() {
            _conf("Are you sure to closed this prf?", "close_data", [$(this).attr('data-id')])
        })
        $('.issue_da').click(function() {
            // _conf("Are you sure to issue disciplinary action on this incident report?", "issue_da", [$(this).attr('data-id')])
            uni_modal("Are you sure to issue disciplinary action on this incident report?", "pr_form/new_da.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.view_').click(function() {
            uni_modal('PRF Applicants', _base_url_ + "admin/prf/manage_applicants.php?id=" + $(this).attr('data-id'), 'large')
        })
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable();
    })

    function delete_po($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=ir_cancel",
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

    function close_data($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=close_prf",
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