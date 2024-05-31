<style>
    td {
        vertical-align: middle;
    }
</style>
<div class="col-12 col-sm-12">
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
                    <div class="container-fluid overflow-auto">
                        <table class="table table-bordered table-stripped text-center">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>PRF No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Department</th>
                                    <th>Requested Position</th>
                                    <th>No. of requested personnel</th>
                                    <th>Reason of request</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Remarks</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($_settings->userdata('EMPNAME'))) {
                                    if ($_settings->userdata('EMPPOSITION') == 5) {
                                        $qry = $conn->query("SELECT * FROM prf_request WHERE (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 1) or (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and dh_name = 0 and `prf_status` = 0) ORDER BY `date_created` desc");
                                    }
                                    if ($_settings->userdata('EMPPOSITION') == 4) {
                                        if ($_settings->userdata('EMPLOYID') == '1694') { // Leand
                                            $dept1 = "MIS";
                                            $dept2 = "Facilities";
                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    (`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '702') { // Joan
                                            $dept1 = 'Finance';
                                            $dept2 = 'Purchasing';
                                            $prodline1 = 'G & A';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND `requestor_pl` = '{$prodline1}') ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '524') { // Charity
                                            $dept1 = 'Human Resource';
                                            $dept2 = 'Training';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    (`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '8563') { // Bryan
                                            $dept1 = 'Production';
                                            $dept2 = 'Production - QFP';
                                            $dept3 = 'Production - RFC';
                                            $dept4 = 'Production / Non - TNR';
                                            $prodline1 = 'PL1 - PL4';
                                            $prodline2 = 'PL1 (ADGT)';
                                            $prodline3 = 'PL4 (ADGT)';
                                            $prodline4 = 'PL6 (ADLT)';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' OR `requestor_pl` = '{$prodline4}')) ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '20') { // Noel
                                            $dept1 = 'Production';
                                            $dept2 = 'Store';
                                            $dept3 = 'IQA Warehouse';
                                            $dept4 = 'Logistics';
                                            $prodline1 = 'PL9 (AD/WHSE)';
                                            $prodline2 = 'G & A';
                                            $prodline3 = 'PL8 (AMS O/S)';

                                            $prodline4 = 'PL3 (ADCV)'; //tin
                                            $prodline5 = 'PL3 (ADCV) - Onsite'; //tin
                                            // $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}') ORDER BY `date_created` desc");

                                            //    $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                            //                             (((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') 
                                            //                                 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}'))) 
                                            //                             ORDER BY `date_created` desc");
                                            $qry = $conn->query("SELECT * FROM prf_request WHERE (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    (((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') 
                                                                        AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}')))) OR (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}'))
                                                                    ORDER BY `date_created` desc");
                                        }
                                        // if ($_settings->userdata('DEPARTMENT') == 'Production' && $_settings->userdata('PRODUCT_LINE') == 'PL6 (ADLT)') {
                                        //     $dept1 = 'Production';
                                        //     $dept2 = 'Production / Non - TNR';
                                        //     $prodline1 = 'PL6 (ADLT)';

                                        //     $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                        //                             ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND (`requestor_pl` = '{$prodline2}')) ORDER BY `date_created` desc");
                                        // }
                                        if ($_settings->userdata('EMPLOYID') == '297') { // Erwin
                                            $dept1 = 'Quality Assurance';
                                            $prodline1 = 'G & A';
                                            $prodline2 = 'PL1 - PL4';
                                            $prodline3 = 'PL1 (ADGT)';
                                            $prodline4 = 'PL2 (AD/OS)';
                                            $prodline5 = 'PL3 (ADCV)';
                                            $prodline6 = 'PL3 (ADCV) - Onsite';
                                            $prodline7 = 'PL4 (ADGT)';
                                            $prodline8 = 'PL6 (ADLT)';
                                            $prodline9 = 'PL8 (AMS O/S)';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                                                        OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}'
                                                                        OR `requestor_pl` = '{$prodline8}' OR `requestor_pl` = '{$prodline9}')) ORDER BY `date_created` desc");
                                        }
                                        if (($_settings->userdata('EMPLOYID') == '1023')) { // Adonis
                                            $dept1 = 'Equipment Engineering';
                                            $prodline1 = 'G & A';
                                            $prodline2 = 'PL1 (ADGT)';
                                            $prodline3 = 'PL2 (AD/OS)';
                                            $prodline4 = 'PL3 (ADCV)';
                                            $prodline5 = 'PL3 (ADCV) - Onsite';
                                            $prodline6 = 'PL4 (ADGT)';
                                            $prodline7 = 'PL6 (ADLT)';
                                            $prodline8 = 'PL8 (AMS O/S)';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                                                        OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}'
                                                                        OR `requestor_pl` = '{$prodline8}')) ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '1170') { // Realyn
                                            $dept1 = 'Process Engineering';
                                            $prodline1 = 'G & A';
                                            $prodline2 = 'PL1 - PL4';
                                            $prodline3 = 'PL2 (AD/OS)';
                                            $prodline4 = 'PL3 (ADCV)';
                                            $prodline5 = 'PL3 (ADCV) - Onsite';
                                            $prodline6 = 'PL6 (ADLT)';
                                            $prodline7 = 'PL8 (AMS O/S)';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                                                        OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}' )) ORDER BY `date_created` desc");
                                        }
                                        if ($_settings->userdata('EMPLOYID') == '1065') { // Tess
                                            $dept1 = 'Production';
                                            $dept2 = 'Production / PE';
                                            $prodline1 = 'PL2 (AD/OS)';

                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                                                    ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND `requestor_pl` = '{$prodline1}') ORDER BY `date_created` desc");
                                        }
                                    }
                                    if ($_settings->userdata('EMPPOSITION') == 3) {
                                        if ($_settings->userdata('EMPLOYID') == '108') { // Ma. Lourdes
                                            $dept1 = "PPC";
                                            $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND `requestor_department` = '{$dept1}' ORDER BY `date_created` desc");
                                        }
                                    }
                                    if ($_settings->userdata('EMPLOYID') == '600') { //tin
                                        $prodline1 = 'PL3 (ADCV)';
                                        $prodline2 = 'PL3 (ADCV) - Onsite';
                                        $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}') ORDER BY `date_created` desc");
                                    }
                                    if ($_settings->userdata('EMPPOSITION') == 2) {
                                        $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND `requestor_id` = '{$_settings->userdata('EMPLOYID')}' ORDER BY `date_created` desc");
                                    }
                                } else {
                                    $qry = $conn->query("SELECT * FROM prf_request WHERE `prf_status` = 0 ORDER BY `date_created` desc");
                                }
                                // $qry = $conn->query("SELECT * FROM prf_request where dh_name = '{$_settings->userdata('EMPLOYID')}' or (((dh_status=1 or dh_name='na') or dh_name='na') and od_name = '{$_settings->userdata('EMPLOYID')}') order by date_created desc ");
                                // $qry = $conn->query("SELECT p.*,e.EMPLOYID,e.APPROVER1,e.APPROVER1_1,e.APPROVER2,e.APPROVER2_1,e.APPROVER2_2 FROM prf_request p INNER JOIN employee_masterlist e on p.requestor_id = e.EMPLOYID WHERE ((e.APPROVER1 = '{$_settings->userdata('EMPLOYID')}' and (dh_status=0 and od_status=0 and (prf_status=1 or prf_status = 0))) OR (e.APPROVER1_1 = '{$_settings->userdata('EMPLOYID')}' and (dh_status=0 and od_status=0 and (prf_status=1 or prf_status = 0)))) OR ((e.APPROVER2 = '{$_settings->userdata('EMPLOYID')}' and (prf_status=1 or prf_status = 0) and (dh_status=1 or dh_name='na')) OR (e.APPROVER2_1 = '{$_settings->userdata('EMPLOYID')}'and (prf_status=1 or prf_status = 0) and (dh_status=1 or dh_name='na')) OR (e.APPROVER2_2 = '{$_settings->userdata('EMPLOYID')}'and (prf_status=1 or prf_status = 0) and (dh_status=1 or dh_name='na'))) ORDER BY p.date_created DESC");
                                while ($row = $qry->fetch_assoc()) :
                                ?>

                                    <tr>
                                        <!-- <td> <?php echo $i++ ?></td> -->
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>
                                        <td><?php echo $row['requestor_name'] ?></td>
                                        <td><?php echo $row['requestor_department'] ?></td>
                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>
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
                                        <!-- <td class="text-center">
                                            <?php if ($row['prf_status'] == 0) : ?>
                                                <span class="badge badge-secondary rounded-pill">Pending</span>
                                            <?php elseif ($row['prf_status'] == 1) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_status'] == 2) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_status'] == 3) : ?>
                                                <span class="badge badge-danger rounded-pill">Disapproved</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <!-- <td><?php echo $row['disappr_reason'] ?></td> -->


                                        <!--<td align="center">
                                             <button type="button" class="btn btn-flat btn-default btn-sm rounded-pill px-3">
                                                <a class="btn btn-sm rounded-pill px-3 view_" href="javascript:void(0)" data-id="<?php echo $row['prf_no'] ?>">View</a>
                                            </button> 
                                        </td>-->
                                        <?php if ($row['prf_status'] == 0 && $row['dh_name'] != 0) { ?>
                                            <td class="text-center">
                                                <span class="btn-block btn-success btn-sm text-dark rounded-pill btn appr" data-od="<?php echo $_settings->userdata('EMPLOYID') ?>" data-id="<?php echo  $row['id'] ?>" data-val="1" data-sign="1">Approve</span>
                                                <span class="btn-block btn-danger btn-sm text-dark rounded-pill btn disappr" data-od="<?php echo $_settings->userdata('EMPLOYID') ?>" data-id="<?php echo  $row['id'] ?>" data-val="2" data-sign="1">Disapprove</span>
                                            </td>
                                        <?php } elseif (($row['prf_status'] == 0 && $row['dh_name'] == 0) || $row['prf_status'] == 1) { ?>
                                            <td class="text-center">
                                                <span class="btn-block btn-success btn-sm text-dark rounded-pill btn appr" data-od="1432" data-id="<?php echo  $row['id'] ?>" data-val="1" data-sign="2">Approve</span>
                                                <span class="btn-block btn-danger btn-sm text-dark rounded-pill btn disappr" data-od="<?php echo $_settings->userdata('EMPLOYID') ?>" data-id="<?php echo  $row['id'] ?>" data-val="2" data-sign="2">Disapprove</span>
                                            </td>
                                        <?php } else {
                                            echo '<td></td>';
                                        } ?>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                    <div class="container-fluid overflow-auto">
                        <table class="table table-bordered table-stripped text-center">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>PRF No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Department</th>
                                    <th>Requested Position</th>
                                    <th>No. of requested personnel</th>
                                    <th>Reason of request</th>
                                    <th>PRF Status</th>
                                    <th>Remarks</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $qry = $conn->query("SELECT * FROM prf_request where (dh_name = '{$_settings->userdata('EMPLOYID')}' and dh_status!=0) or (od_name = '{$_settings->userdata('EMPLOYID')}' and (dh_name=1 or od_name!=0))  order by date_created desc ");
                                // $qry = $conn->query("SELECT p.*,e.EMPLOYID,e.APPROVER1,e.APPROVER1_1,e.APPROVER2,e.APPROVER2_1,e.APPROVER2_2 FROM prf_request p INNER JOIN employee_masterlist e on p.requestor_id = e.EMPLOYID WHERE ((e.APPROVER1 = '{$_settings->userdata('EMPLOYID')}' ) OR (e.APPROVER1_1 = '{$_settings->userdata('EMPLOYID')}')) OR ((e.APPROVER2 = '{$_settings->userdata('EMPLOYID')}' and (od_status!=0 and (dh_status=1 or dh_name='na'))) OR (e.APPROVER2_1 = '{$_settings->userdata('EMPLOYID')}'and (od_status!=0 and (dh_status=1 or dh_name='na'))) OR (e.APPROVER2_2 = '{$_settings->userdata('EMPLOYID')}'and  (od_status!=0 and (dh_status=1 or dh_name='na'))) ) ORDER BY p.date_created DESC");
                                while ($row = $qry->fetch_assoc()) :
                                    //wala payung request ni ma'am cha 10-13-23
                                ?>

                                    <tr>
                                        <!-- <td> <?php echo $i++ ?></td> -->
                                        <td><?php echo $row['prf_no'] ?></td>
                                        <td><?php echo date("m-d-Y", strtotime($row['date_created'])) ?></td>
                                        <td><?php echo $row['requestor_name'] ?></td>
                                        <td><?php echo $row['requestor_department'] ?></td>
                                        <td><?php echo $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$row['job_title']}'")->fetch_array()[0]; ?></td>
                                        <td><?php echo $row['no_req'] ?></td>
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
                                            echo '</td>';
                                        } ?>
                                        <td class="text-center">
                                            <?php if ($row['prf_status'] == 0) : ?>
                                                <span class="badge badge-secondary rounded-pill">Pending</span>
                                            <?php elseif ($row['prf_status'] == 1) : ?>
                                                <span class="badge badge-warning rounded-pill">Partially Approved</span>
                                            <?php elseif ($row['prf_status'] == 2) : ?>
                                                <span class="badge badge-success rounded-pill">Approved</span>
                                            <?php elseif ($row['prf_status'] == 3) : ?>
                                                <span class="badge badge-danger rounded-pill">Disapproved</span>
                                            <?php elseif ($row['prf_status'] == 4) : ?>
                                                <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            <?php elseif ($row['prf_status'] == 5) : ?>
                                                <span class="badge badge-info rounded-pill">Hold</span>
                                            <?php elseif ($row['prf_status'] == 6) : ?>
                                                <span class="badge badge-success rounded-pill">Served</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row['disappr_reason'] ?></td>
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
        $('.appr').click(function() {
            // _conf("Are you sure to APPROVE this personnel requisition?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
            appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'), $(this).attr('data-od'));
        })
        $('.disappr').click(function() {
            uni_modal('', _base_url_ + "admin/prf/disappr.php?id=" + $(this).attr('data-id') + "&sign=" + $(this).attr('data-sign') + "&od=" + $(this).attr('data-od'), 'small')
            // _conf("Are you sure to DISAPPROVE this PCN?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
            // appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
        })
    })

    function appr_prf($id, $val, $sign, $od) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=appr_prf",
            method: "POST",
            data: {
                id: $id,
                val: $val,
                sign: $sign,
                od: $od
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
    $(document).ready(function() {
        $('.delete_data').click(function() {
            _conf("Are you sure to cancel this incident report?", "delete_po", [$(this).attr('data-id')])
        })

        $('.view_').click(function() {
            uni_modal('PRF Applicants', _base_url_ + "admin/prf/view_applicants.php?id=" + $(this).attr('data-id'), 'large')
        })
        $('.export_list').click(function() {
            uni_modal("", "prf/export_data.php", 'mid-large')

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
</script>