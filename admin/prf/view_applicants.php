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
<div class="container-fluid">
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
                        <td><?php echo $arow['date_commencement'] ?></td>
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
                                    <span class="badge badge-info rounded-pill">Buddy/Department training</span>
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
                    </tr>
                <?php endwhile; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
    $('.update_status').click(function() {
        // _conf("Are you sure to APPROVE this PCN?", "appr_prf", [$(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign')])
        appr_prf($(this).attr('data-id'), $(this).attr('data-val'), $(this).attr('data-sign'));
    })
    $('.table td,.table th').addClass('py-1 px-2 align-middle')
    $('.table').dataTable();

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