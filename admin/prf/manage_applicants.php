<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `prf_request` where prf_no = '{$_GET['id']}'  ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
?>
        <center>Unknown Category</center>
        <style>
            #uni_modal .modal-header,
            .modal-footer.modal-header {
                display: none;
            }
        </style>
        <div class="text-right">
            <button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
        </div>
<?php
    }
}
$app_id = $conn->query("SELECT application_id from `position` where id = $job_title")->fetch_array()[0];
// echo $app_id;
?>
<style>
    #uni_modal .modal-header,
    #uni_modal .modal-footer {
        display: none;
    }
</style>
<!-- <h1 class="float-right">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</h1> -->
<div class="card-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h3 class="text-center">PRF no. <?php echo $_GET['id'] ?></h3>
    <!-- <div class="card-tools">
			<a href="<?php echo base_url . "admin?page=prf_admin/export" ?>" class="btn btn-flat btn-success"><span class="fas fa-plus"></span> Export</a>
		</div> -->
</div>
<br>
<div class="container-fluid overflow-auto">
    <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Training') { ?>
        <?php if ($app_id == 1) { ?>

            <div class="row justify-content-center">
                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="1" data-sign="4" data-id=""><span class="fas fa-chalkboard-teacher"></span> Classroom training</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="2" data-sign="4" data-id=""><span class="fa fa-handshake"></span> Buddy training</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="3" data-sign="4" data-id=""><span class="fa fa-user-check"></span> Validation</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="4" data-sign="4" data-id=""><span class="fa fa-award"></span> Certified</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="5" data-sign="4" data-id=""><span class="fa fa-times-circle"></span> Discontinued/AWOL</a>

                <a class="btn btn-sm border-success update_status_6" href="javascript:void(0)" data-val="6" data-sign="4" data-id=""><span class="fa fa-calendar-day"></span> Rebatched</a>
            </div>
        <?php } else if ($app_id != 1) { ?>
            <div class="row justify-content-center">
                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="1" data-sign="4" data-id=""><span class="fas fa-chalkboard-teacher"></span> Classroom training</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="2" data-sign="4" data-id=""><span class="fa fa-handshake"></span> Buddy/Department training</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="3" data-sign="4" data-id=""><span class="fa fa-user-check"></span> Validation</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="4" data-sign="4" data-id=""><span class="fa fa-award"></span> Deployed</a>

                <a class="btn btn-sm border-success mr-3 update_status" href="javascript:void(0)" data-val="5" data-sign="4" data-id=""><span class="fa fa-times-circle"></span> Discontinued/AWOL</a>

                <a class="btn btn-sm border-success update_status_6" href="javascript:void(0)" data-val="6" data-sign="4" data-id=""><span class="fa fa-calendar-day"></span> Rebatched</a>
            </div>
        <?php } ?>

    <?php } else if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Human Resource') {
    ?>
        <div class="row justify-content-center">
            <a class="btn btn-sm border-success update_status_7" href="javascript:void(0)" data-val="6" data-sign="4" data-id=""><span class="fa fa-calendar-day"></span> Reschedule NEOP</a>
        </div>
    <?php } ?>
    <br>
    <br>
    <table class="table table-bordered table-stripped text-center">
        <thead>
            <tr class="bg-gradient-primary">
                <th>#</th>
                <th>PRF No.</th>
                <th>Name</th>
                <th>Date Hired</th>
                <th>Position</th>
                <th>Recruitment Status</th>
                <th>Training Status</th>
                <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Training' || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
                    <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $prf_a = $conn->query("SELECT * from `prf_applicants` where prf_no = '{$_GET['id']}'  ");
            while ($arow = $prf_a->fetch_assoc()) :
                $prf_r = $conn->query("SELECT * from `prf_request` where prf_no = '{$_GET['id']}'  ");
                while ($rrow = $prf_r->fetch_assoc()) :
                    $a_name = $conn->query("SELECT name from `assessment` where id = '{$arow['applicant_name']}'")->fetch_array()[0];
            ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo $arow['prf_no'] ?></td>
                        <td><?php echo $a_name ?></td>
                        <td><?php echo isset($arow['date_rebatched']) ? $arow['date_rebatched'] : $arow['date_commencement'] ?></td>
                        <?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '{$rrow['job_title']}'")->fetch_array()[0]; ?>
                        <td><?php echo $pos ?></td>
                        <td class="text-center">
                            <?php if ($arow['recruitment_status'] == 0) : ?>
                                <span class="badge badge-secondary rounded-pill">Pending</span>
                            <?php elseif ($arow['recruitment_status'] == 1) : ?>
                                <span class="badge badge-warning rounded-pill">For job offer</span>
                            <?php elseif ($arow['recruitment_status'] == 2) : ?>
                                <span class="badge badge-info rounded-pill">For medical requirement</span>
                            <?php elseif ($arow['recruitment_status'] == 3) : ?>
                                <span class="badge badge-success rounded-pill">For orientation</span>

                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($app_id == 1) { ?>
                                <?php if ($arow['training_status'] == 0) : ?>
                                    <span class="badge badge-secondary rounded-pill">Pending</span>
                                <?php elseif ($arow['training_status'] == 1) : ?>
                                    <span class="badge badge-warning rounded-pill">Classroom training</span>
                                <?php elseif ($arow['training_status'] == 2) : ?>
                                    <span class="badge badge-info rounded-pill">Buddy training</span>
                                <?php elseif ($arow['training_status'] == 3) : ?>
                                    <span class="badge badge-primary rounded-pill">Validation</span>
                                <?php elseif ($arow['training_status'] == 4) : ?>
                                    <span class="badge badge-success rounded-pill">Certified</span>
                                <?php elseif ($arow['training_status'] == 5) : ?>
                                    <span class="badge badge-danger rounded-pill">Discontinued/AWOL</span>
                                <?php elseif ($arow['training_status'] == 6) : ?>
                                    <span class="badge badge-secondary rounded-pill">Rebatched</span>
                                <?php endif; ?>
                            <?php } else if ($app_id != 1) { ?>
                                <?php if ($arow['training_status'] == 0) : ?>
                                    <span class="badge badge-secondary rounded-pill">Pending</span>
                                <?php elseif ($arow['training_status'] == 1) : ?>
                                    <span class="badge badge-warning rounded-pill">Classroom training</span>
                                <?php elseif ($arow['training_status'] == 2) : ?>
                                    <span class="badge badge-info rounded-pill"> Buddy/Department training</span>
                                <?php elseif ($arow['training_status'] == 3) : ?>
                                    <span class="badge badge-primary rounded-pill">Validation</span>
                                <?php elseif ($arow['training_status'] == 4) : ?>
                                    <span class="badge badge-success rounded-pill">Deployed</span>
                                <?php elseif ($arow['training_status'] == 5) : ?>
                                    <span class="badge badge-danger rounded-pill">Discontinued/AWOL</span>
                                <?php elseif ($arow['training_status'] == 6) : ?>
                                    <span class="badge badge-secondary rounded-pill">Rebatched</span>
                                <?php endif; ?>
                            <?php } ?>
                        </td>
                        <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('DEPARTMENT') == 'Training' || $_settings->userdata('DEPARTMENT') == 'Human Resource') { ?>
                            <td>
                                <input type="checkbox" class="form-control form-control-sm applicant_id" value="<?php echo $arow['id'] ?>">
                                <!-- <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="1" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fas fa-chalkboard-teacher"></span> Classroom training</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="2" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fa fa-handshake"></span> Buddy training</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="3" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fa fa-user-check"></span> Validation</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="4" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fa fa-award"></span> Certified</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="5" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fa fa-times-circle"></span> Discontinued/AWOL</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item update_status" href="javascript:void(0)" data-val="6" data-sign="4" data-id="<?php echo $arow['id'] ?>"><span class="fa fa-calendar-day"></span> Rebatched</a>
                                </div> -->
                            </td>
                        <?php } ?>
                    </tr>
                <?php endwhile; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var checkboxValues = [];
        $(".applicant_id").click(function() {
            checkboxValues = [];
            $(".applicant_id:checked").each(function() {
                checkboxValues.push($(this).val());
            });
            console.log("Checkbox Values Array:", checkboxValues);
            var joinedString = checkboxValues.join(',');

            $(".update_status").attr("data-id", joinedString);

            $(".update_status").click(function() {
                if (checkboxValues == '')
                    return false;
                appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
            });

            $(".update_status_6").attr("data-id", joinedString);
            $(".update_status_7").attr("data-id", joinedString);

        });
        $(".update_status_6").click(function() {
            if ($(this).attr('data-id') == '')
                return false;
            uni_modal('', _base_url_ + "admin/prf/rebatch_date.php?id=" + $(this).attr('data-id'), 'small')
        });
        $(".update_status_7").click(function() {
            if ($(this).attr('data-id') == '')
                return false;
            uni_modal('', _base_url_ + "admin/prf/reneop_date.php?id=" + $(this).attr('data-id'), 'small')
        });
    });

    // $('.update_status').click(function() {
    //     // _conf("Are you sure to APPROVE this PCN?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
    //     appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
    // })
    // $('.update_status_6').click(function() {
    //     uni_modal('', _base_url_ + "admin/prf/rebatch_date.php?id=" + $(this).attr('data-id'), 'small')
    //     // _conf("Are you sure to APPROVE this PCN?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
    //     // appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
    // })
    // $('.table td,.table th').addClass('py-1 px-2 align-middle')
    // $('.table').dataTable();

    // function appr_prf(dataId, dataVal, dataSign) {
    //     console.log("data-id:", dataId);
    //     console.log("data-val:", dataVal);
    //     console.log("data-sign:", dataSign);
    //     // Your appr_prf logic here
    // }
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
                    alert_toast("Applicants successfully added.", 'success');
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