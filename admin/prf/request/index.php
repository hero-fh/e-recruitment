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
                <li class="nav-item ml-auto">
                    <a href="<?php echo base_url ?>admin/?page=prf/new_prf" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
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
                                    <th rowspan="2">Prf No</th>
                                    <th rowspan="2">Date Requested</th>
                                    <th rowspan="2">Requested Position</th>
                                    <th rowspan="2">No. of requested personnel</th>
                                    <th colspan="2">Approvals</th>
                                    <th rowspan="2">Recruitment Status</th>
                                    <th rowspan="2">Training Status</th>
                                    <th rowspan="2">Reason of request</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Approver 1</th>
                                    <th>Approver 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $qry = $conn->query("SELECT * FROM prf_request where requestor_id = " . $_settings->userdata('EMPLOYID') . " and dh_status != 2 and od_status != 2 and prf_status != 3 and prf_status != 4 and prf_hold = 0 and prf_status != 6 order by date_created desc");
                                while ($row = $qry->fetch_assoc()) :
                                    $hired = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status != 5 and date_commencement <= NOW()")->fetch_array()[0];
                                    $hired1 = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status != 5")->fetch_array()[0];
                                    $job_offer = $conn->query("SELECT count(asm.id) FROM applicants ap inner join assessment asm on ap.id=asm.id where asm.prf_no = '{$row['prf_no']}' AND (ap.job_offer = 0 OR ap.application = 1) AND ap.status = 2 AND ap.pdf = 0")->fetch_array()[0];
                                    $medical =  $conn->query("SELECT count(asm.id) FROM applicants ap inner join assessment asm on ap.id=asm.id where asm.prf_no = '{$row['prf_no']}' and (ap.job_offer=1 or ap.application=1) and ap.status=2")->fetch_array()[0];

                                    $badge = $conn->query("SELECT asm.name FROM assessment asm INNER JOIN applicants ap ON ap.id = asm.id WHERE asm.prf_no = '{$row['prf_no']}' AND (ap.job_offer = 1 OR ap.application = 1) AND ap.status = 1 AND ap.pdf = 1 AND asm.name NOT IN (SELECT applicant_name FROM prf_applicants WHERE prf_no = '{$row['prf_no']}')")->num_rows;


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
                                    $date = new DateTime($row['date_hold']);
                                    $date->add(new DateInterval('P1M'));
                                    $resultDate = $date->format('Y-m-d');
                                    $app_id = $conn->query("SELECT application_id from `position` where id = '{$row['job_title']}'")->fetch_array()[0];

                                    // echo $resultDate; // This will display '2023-10-25'

                                    // You can now use $resultDate in your code as needed.

                                ?>

                                    <tr>
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>

                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>

                                        <td class="text-center">
                                            <?php if ($row['dh_status'] == 0 && $row['dh_name'] != 0 && $row['prf_hold'] != 1 && $row['prf_status'] == 0) : ?>
                                                <span class="badge badge-primary rounded-pill">Pending</span>
                                            <?php elseif ($row['dh_status'] == 0  && $row['dh_name'] == 0 && $row['prf_hold'] != 1) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['dh_status'] == 1 && $row['prf_hold'] != 1) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_hold'] == 1) : ?>
                                                --<!-- <span class="badge badge-success rounded-pill">Approved</span> -->
                                            <?php elseif ($row['dh_status'] == 2 || $row['prf_status'] == 3) : ?>
                                                <span class="badge badge-danger rounded-pill">Disapproved</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row['od_status'] == 0 && $row['prf_hold'] != 1 && $row['prf_status'] != 3 && $row['dh_status'] == 0  && $row['dh_name'] != 0) : ?>
                                                --
                                            <?php elseif ($row['od_status'] == 0 && $row['prf_hold'] != 1 && $row['prf_status'] != 3 && ($row['dh_status'] == 1 || $row['dh_name'] == 0)) : ?>
                                                <span class="badge badge-primary rounded-pill">Pending</span>
                                            <?php elseif ($row['od_status'] == 1 && $row['prf_hold'] != 1) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_hold'] == 1) : ?>
                                                --<!-- <span class="badge badge-success rounded-pill">Approved</span> -->
                                            <?php elseif ($row['od_status'] == 2 || $row['prf_status'] == 3) : ?>
                                                <span class="badge badge-danger rounded-pill">Disapproved</span>
                                            <?php endif; ?>
                                        </td>
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
                                                <span class="badge rounded-pill">Ongoing hiring <span class="badge badge-primary rounded-pill"><?php echo $delta ?></span></span><br>
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
                                            <!-- <button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
                                                <a class="btn btn-sm rounded-pill px-3 view_" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>">View</a>

                                                 <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> 
                                            </button>-->
                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item view_" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><i class="fas fa-eye text-primary"></i> View</a>
                                                <div class="dropdown-divider"></div>
                                                <!-- <a class="btn btn-sm btn-flat rounded-pill" href="<?php echo base_url . 'admin?page=prf/view_ir&id=' . md5($row['id']) ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                                <div class="dropdown-divider"></div> -->
                                                <?php if ($row['prf_hold'] == 1  && $row['prf_status'] != 6 && date('Y-m-d') <= $resultDate) { ?>
                                                    <a class="dropdown-item appr" href="javascript:void(0)" data-id="<?php echo  $row['id'] ?>" data-val="0" data-sign="6"><i class="fas fa-play text-primary"></i> Resume</a>
                                                    <div class="dropdown-divider"></div>
                                                <?php } elseif ($row['prf_hold'] == 0) { ?>
                                                    <a class="dropdown-item appr" href="javascript:void(0)" data-id="<?php echo  $row['id'] ?>" data-val="1" data-sign="6"><i class="fas fa-pause text-primary"></i> Hold</a>
                                                    <div class="dropdown-divider"></div>
                                                <?php } ?>
                                                <span class="dropdown-item  cancel" data-id="<?php echo  $row['id'] ?>"><i class="fas fa-ban text-primary"></i> Cancel</span>
                                                <!-- <a class="dropdown-item appr" href="javascript:void(0)" data-id="<?php echo  $row['id'] ?>" data-val="4" data-sign="5"><i class="fas fa-ban text-primary"></i> Cancel</a> -->

                                            </div>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                    <div class="container-fluid  overflow-auto">
                        <table class="table table-bordered table-stripped text-center">
                            <thead>
                                <tr>

                                    <th>Prf No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Department</th>
                                    <th>Requested Position</th>
                                    <th>No. of requested personnel</th>
                                    <th>PRF Status</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $where = 'AND (date_served >= DATE_SUB(NOW(), INTERVAL 365 DAY) OR date_served IS NULL)';
                                $qry = $conn->query("SELECT * FROM prf_request WHERE requestor_id = " . $_settings->userdata('EMPLOYID') . " and (prf_status=3 or prf_status = 4 or prf_status = 6 or prf_hold != 0) $where ORDER BY date_created DESC");
                                // $qry = $conn->query("SELECT * FROM prf_request where requestor_id = " . $_settings->userdata('EMPLOYID') . " and (prf_status=3 or prf_status = 4 or prf_status = 6 or prf_hold != 0) order by date_created desc");
                                while ($row = $qry->fetch_assoc()) :
                                    $hired = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}'")->fetch_array()[0];
                                    $job_offer = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=1")->fetch_array()[0];
                                    $medical = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=2")->fetch_array()[0];
                                    $orientation = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and recruitment_status=3")->fetch_array()[0];
                                    $certification = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=1")->fetch_array()[0];
                                    $certified = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=2")->fetch_array()[0];
                                    $awol = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=3")->fetch_array()[0];
                                    $rebatched = $conn->query("SELECT count(id) FROM prf_applicants where prf_no = '{$row['prf_no']}' and training_status=4")->fetch_array()[0];
                                    $delta = $row['no_req'] - $hired;
                                    $date = new DateTime($row['date_hold']);
                                    $date->add(new DateInterval('P1M'));
                                    $resultDate = $date->format('Y-m-d');
                                ?>

                                    <tr>
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>
                                        <td><?php echo $row['requestor_name'] ?></td>
                                        <td><?php echo $row['requestor_department'] ?></td>
                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>
                                        <td class="text-center">
                                            <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 0) : ?>
                                                <span class="badge badge-secondary rounded-pill">Pending</span>
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
                                            <?php if ($row['prf_hold'] == 1  && $row['prf_status'] != 6 && date('Y-m-d') <= $resultDate) { ?>
                                                <button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
                                                    <a class="btn btn-sm rounded-pill px-3 appr" href="javascript:void(0)" data-id="<?php echo  $row['id'] ?>" data-val="0" data-sign="6"><i class="fas fa-play text-primary"></i> Resume</a>
                                                </button>
                                            <?php } else { ?>
                                            <?php if ($row['prf_hold'] != 1 && $row['prf_status'] == 3) :
                                                    echo $row['disappr_reason'];
                                                elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 4) :
                                                    echo $row['cancel_reason'];
                                                elseif ($row['prf_hold'] != 1 && $row['prf_status'] == 6) :
                                                    echo 'Date Served' . ' ' . date('m-d-Y', strtotime($row['date_served']));

                                                endif;
                                            } ?>


                                        </td>

                                        <td align="center">
                                            <button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
                                                <a class="btn btn-sm rounded-pill px-3 view_" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>">View</a>

                                                <!-- <a class="btn btn-sm  rounded-pill px-3 who" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
                                            </button>
                                            <!-- <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu"> 
                                            <a class="btn btn-sm btn-flat rounded-pill" href="<?php echo base_url . 'admin?page=prf/view_ir&id=' . md5($row['id']) ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                             <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-pen text-warning"></span> Update</a>

                                            </div> -->
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


        $('.view_').click(function() {
            uni_modal('PRF Applicants', _base_url_ + "admin/prf/view_applicants.php?id=" + $(this).attr('data-id'), 'large')
        })

        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable();

        $('.appr').click(function() {
            // _conf("Are you sure to APPROVE this personnel requisition?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
            appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
        })
        $('.cancel').click(function() {
            uni_modal('', _base_url_ + "admin/prf/cancel_prf.php?id=" + $(this).attr('data-id'), 'small')
            // _conf("Are you sure to DISAPPROVE this PCN?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
            // appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
        })

    })

    function appr_prf($id, $val, $sign) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=appr_prf",
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
</script>