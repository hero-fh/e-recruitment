<?php require_once('../config.php') ?>

<style>
	.modal-header {
		display: none;
	}
</style>
<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif;
if (isset($_GET['id'])) {
	$ext = $conn->query("SELECT * FROM prf_request where md5(prf_no) = '{$_GET['id']}' ");
	if ($ext->num_rows > 0) {
		foreach ($ext->fetch_array() as $k => $v) {
			$$k = $v;
		}
	}
}

?>

<link rel="stylesheet" href="<?php echo base_url ?>dist/css/eform.css">
<style>
	textarea {
		vertical-align: top;
		width: 100%;
		resize: none;
	}
</style>
<form action="" id="prf">
	<div id="printable" style="overflow-x:auto;overflow-y:hidden;">
		<input readonly type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<p class="text-right"><b style="font-size: 1rem;"><span style="width:90%;margin-left:5%;margin-right:5%;border-collapse:collapse;font-size:12.0pt;line-height:107%;font-family:Arial,sans-serif;">PRF No: <input readonly type="text" class="wbot" name="prf_no" value="<?php echo isset($prf_no) ? $prf_no : '' ?>"></span></b><br></p>
		<p class="MsoNormal" style="margin-bottom:24.65pt;">
			<o:p></o:p>
		</p>
		<p>

		</p>
		<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;text-align:center;"><b><span style="font-size:20.0pt;line-height:107%;font-family:Arial,sans-serif;">PERSONNEL REQUISITION FORM</span></b>
		</p>
		<br>

		<table class="TableGrid" border="0" cellspacing="0" cellpadding="0" width="737" style="width:90%;margin-left:5%;margin-right:5%;border-collapse:collapse;">
			<tbody>
				<tr style="height:23.05pt">
					<td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:23.05pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.75pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">EMPLOYMENT
									REQUIREMENTS</span></b>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:33.75pt">
					<td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:33.75pt">
						<p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of
								Requisition<span>&nbsp;&nbsp;&nbsp;&nbsp; </span>: <input readonly type="date" class="date2" name="requisition" required value="<?php echo isset($requisition) ? date('Y-m-d', strtotime($requisition)) : '' ?>"></span>
							<o:p></o:p>
						</p>
					</td>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:33.75pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date Received by HR:</span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr>
					<td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:33.7pt">
						<p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Department<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: <input readonly type="text" name="prf_department" placeholder="Department" class="xbot" style="width:20%;" value="<?php echo isset($prf_department) ? $prf_department : 'N/A' ?>"> <input readonly type="text" name="prf_station" placeholder="Station" class="xbot" style="width:20%;" value="<?php echo isset($prf_station) ? $prf_station : 'N/A' ?>"> <input readonly type="text" name="prf_pl" placeholder="PL" class="xbot" style="width:20%;" value="<?php echo isset($prf_pl) ? $prf_pl : 'N/A' ?>"></span>
							<o:p></o:p>
						</p>
					</td>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:33.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">No. of Requirements: <input readonly type="text" placeholder="Input No. Of Requirements" class="xbot" style="width:50%;" name="req_no" id="req_no" value="<?php echo isset($req_no) ? $req_no : '' ?>" required></span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr>
					<td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:33.7pt">
						<p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Position<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>:
								<!-- <select name="position" class="xbot" id="position" required style="width:50%;appearance: none;">
									<option value="" disabled <?= !isset($position) ? "selected" : "" ?>>--Select Position--</option>
									<?php
									$position1 = $conn->query("SELECT * FROM `position` where  `status` = 1 ");
									while ($row = $position1->fetch_assoc()) :
									?>
										<option value="<?= $row['id'] ?>" <?php echo isset($position) && $position == $row['id'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
									<?php endwhile; ?>
								</select></span> -->
								<?php $pos = $conn->query("SELECT position FROM `position` WHERE id = '$position'")->fetch_array()[0]; ?>
								<input readonly id="position" name="position" class="xbot" required style="width:50%;" placeholder="Input Position" value="<?php echo isset($pos) ? $pos : '' ?>">
						</p>
					</td>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:33.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Other Requirements: <input readonly type="text" class="xbot" name="other_req" style="width:50%;" value="<?php echo isset($other_req) ? $other_req : '' ?>"></span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr>
					<td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:28.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:12.1pt;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Academic Qualifications :</span>
							<textarea readonly onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" placeholder="Input Academic Qualifications..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="academic_qualification" required><?php echo isset($academic_qualification) ? $academic_qualification : '' ?></textarea>
						</p>
					</td>
				</tr>
				<tr style="height:28.7pt">
					<td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:28.7pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.7pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">JOB
									DESCRIPTION</span></b>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:38.15pt">
					<td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Year of Experience<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: <input readonly type="text" class="xbot" placeholder="Input Years of Experience..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="exp_years" value="<?php echo isset($exp_years) ? $exp_years : '' ?>" required></span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:20.8pt">
					<td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Skills / Abilities / Knowledge :</span>
							<textarea readonly onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" placeholder="Input Skills / Abilities / Knowledge..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="skills" required><?php echo isset($skills) ? $skills : '' ?></textarea>
						</p>
					</td>
				</tr>
				<tr style="height:20.4pt">
					<td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Please Provide Detailed<span>&nbsp; </span>Job function :</span>
							<textarea readonly onload="resizeTextarea(this)" oninput="resizeTextarea(this)" rows="3" class="xbot auto-resize" placeholder="Input Job Function..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="job_function" required><?php echo isset($job_function) ? $job_function : '' ?></textarea>

						</p>
					</td>
				</tr>
				<tr style="height:20.0pt">
					<td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Reason for Personnel Requisition :</span>
							<textarea readonly onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="reason_for_requisition" required><?php echo isset($reason_for_requisition) ? $reason_for_requisition : '' ?></textarea>

						</p>
					</td>
				</tr>
				<tr style="height:52.7pt">
					<td width="226" valign="top" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:52.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Prepared By:</span>
						<table class="table sign ">
							<colgroup>
								<col width="40%">
								<col width="60%">
							</colgroup>
							<?php
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 1");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>
									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
								</tr>
							<?php endwhile; ?>
						</table>
						</p>
					</td>
					<td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:52.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Approved By:</span>
						<table class="table sign ">
							<colgroup>
								<col width="40%">
								<col width="60%">
							</colgroup>
							<?php
							$first_s = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 1");
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 2");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>
									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
								</tr>
							<?php endwhile; ?>
							<?php if ($sign->num_rows == 0 && $first_s->num_rows == 2) {
							?>
								<div style="text-align: center;">
									<a href="javascript:void(0)" class="btn btn-primary btn-sm view_req" data-id="<?php echo $prf_no ?>" data-dept="2"><span class="fas fa-pencil-alt">&nbsp;Sign</span></a>
								</div>
							<?php } ?>
						</table>
						</p>
					</td>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:52.7pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Noted by:</span>
						<table class="table sign ">
							<colgroup>
								<col width="40%">
								<col width="60%">
							</colgroup>
							<?php
							$approved = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 2");
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 3");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>
									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
								</tr>
							<?php endwhile; ?>
							<?php if ($sign->num_rows == 0 && $approved->num_rows != 0) {
							?>
								<div style="text-align: center;">
									<a href="javascript:void(0)" class="btn btn-primary btn-sm view_req" data-id="<?php echo $prf_no ?>" data-dept="3"><span class="fas fa-pencil-alt">&nbsp;Sign</span></a>
								</div>
							<?php } ?>
						</table>
						</p>
					</td>
				</tr>
				<tr style="height:15.1pt">
					<td width="226" valign="top" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:15.1pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.8pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Requestor/Department Head</span>
							<o:p></o:p>
						</p>
					</td>
					<td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:15.1pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:20.0pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Authorized Signatory</span>
							<o:p></o:p>
						</p>
					</td>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:15.1pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.6pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Human Resource Manager</span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:25.2pt">
					<td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:25.2pt">
						<p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.5pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">(For
									Administration Department Only)</span></b>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:23.75pt">
					<td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:23.75pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of Advertisement :</span>

						</p>
					</td>
				</tr>
				<tr>
					<td width="459" colspan="2" rowspan="3" valign="bottom" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:20.05pt">
						<input readonly type="hidden" name="status" id="check4" value="4">
						<p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Status:<span>&nbsp; </span>
								<div class="checkbox">
									<input disabled type="checkbox" class="check status" id="check1" name="status" />
									<label for="check1" class="label">
										<svg width="50" height="50" viewBox="0 0 100 100">
											<rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
											<g transform="translate(30,20)">
												<path d="M 10,25 L 25,40 L 45,10" stroke="black" fill="none" stroke-width="10" class="path1" />
											</g>
										</svg>
										<span>Hold &nbsp;&nbsp;&nbsp;</span>
									</label> <b>Reason: </b><input readonly class="xbot auto-resize" style=" box-sizing:border-box; font-size:10pt; word-break:break-word; white-space: normal;  overflow: hidden; text-align: left;" name="reason1">
								</div>
							</span>
						</p>
						<p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">
								<div class="checkbox">
									<input disabled type="checkbox" class="check status" id="check2" name="status" />
									<label for="check2" class="label">
										<svg width="50" height="50" viewBox="0 0 100 100">
											<rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
											<g transform="translate(30,20)">
												<path d="M 10,25 L 25,40 L 45,10" stroke="black" fill="none" stroke-width="10" class="path1" />
											</g>
										</svg>
										<span>Cancelled &nbsp;&nbsp;&nbsp;</span>
									</label> <b>Reason: </b><input readonly class="xbot auto-resize" style=" box-sizing:border-box; font-size:10pt; word-break:break-word; white-space: normal;  overflow: hidden;text-align: left;" name="reason2">
								</div>
							</span>
						</p>
						<p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">
								<div class="checkbox">
									<input disabled type="checkbox" class="check status" id="check3" name="status" />
									<label for="check3" class="label">
										<svg width="50" height="50" viewBox="0 0 100 100">
											<rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
											<g transform="translate(30,20)">
												<path d="M 10,25 L 25,40 L 45,10" stroke="black" fill="none" stroke-width="10" class="path1" />
											</g>
										</svg>
										<span>Closed</span>
									</label>
								</div>
							</span>
						</p>
						<!-- <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="border:solid black 1.5pt;padding:0cm"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span>&nbsp;</span>Cancelled<span>&nbsp;&nbsp;&nbsp; </span>Reason:
                                <textarea readonly  onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot"  style="width:50%;; box-sizing:border-box; font-size:.7vw; word-break:break-word; white-space: normal;  overflow: hidden;" name="reason2"><?php echo isset($reason2) ? $reason2 : '' ?></textarea>

                            </span>
                        </p>
                        <br>
                        <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:.10cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="border:solid black 1.5pt;padding:0cm"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span>&nbsp;</span>Closed</span>

                        </p> -->
					</td>

					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:1pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="padding:0;margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
								Requestor / Date: </span>
						<table class="table sign " style="margin-top: 20px;">
							<colgroup>
								<col width="30%">
								<col width="40%">
								<col width="30%">
							</colgroup>
							<?php
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 4");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>

									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
									<td class="sign-name" style="padding: 0;">
										<input readonly type="date" class="date2" name="req_sign1" id="req_sign1" value="<?php echo isset($row['signing_date']) ? date('Y-m-d', strtotime($row['signing_date'])) : '' ?>">
									</td>
								</tr>
							<?php endwhile; ?>
							<?php if ($sign->num_rows == 0) {
							?>
								<!-- <div style="text-align: center;">
									<a href="javascript:void(0)" class="btn btn-primary btn-sm view_req" data-id="<?php echo $prf_no ?>" data-dept="4"><span class="fas fa-pencil-alt">&nbsp;Sign</span></a>
								</div> -->
							<?php } ?>
						</table>
						</p>
					</td>
				</tr>
				<tr>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:1pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
								Requestor / Date: </span>
						<table class="table sign " style="margin-top: 20px;">
							<colgroup>
								<col width="30%">
								<col width="40%">
								<col width="30%">
							</colgroup>
							<?php
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 5");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>

									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
									<td class="sign-name" style="padding: 0;">
										<input readonly type="date" class="date2" name="req_sign2" id="req_sign2" value="<?php echo isset($row['signing_date']) ? date('Y-m-d', strtotime($row['signing_date'])) : '' ?>">
									</td>
								</tr>
							<?php endwhile; ?>
							<?php if ($sign->num_rows == 0) {
							?>
								<!-- <div style="text-align: center;">
									<a href="javascript:void(0)" class="btn btn-primary btn-sm view_req" data-id="<?php echo $prf_no ?>" data-dept="5"><span class="fas fa-pencil-alt">&nbsp;Sign</span></a>
								</div> -->
							<?php } ?>
						</table>

						</p>
					</td>
				</tr>
				<tr>
					<td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:1pt 20.55pt .75pt 7pt;">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
								Requestor / Date: </span>
						<table class="table sign " style="margin-top: 20px;">
							<colgroup>
								<col width="30%">
								<col width="40%">
								<col width="30%">
							</colgroup>
							<?php
							$sign = $conn->query("SELECT * FROM `prf_sign` WHERE prf_id = '$prf_no' and `sign` = 6");
							while ($row = $sign->fetch_assoc()) :
							?>
								<tr class="sign-tr" style="padding: 0;">
									<td class="sign-name" style="padding: 0;">
										<small><b><?php echo $row['emp_name'] ?></b></small><br>
									</td>

									<td class="sign-detail" style="padding: 0; ">
										<small>Digitally Signed By: <?php echo $row['emp_name'] ?></small><br>
										<small>DN: CN=<?php echo $row['emp_name'] ?> E=<?php echo $row['email'] ?></small><br>
										<small>Reason: I am approving this document.</small><br>
										<small>Date: <?php echo date('Y.m.d H:i:s', strtotime($row['signing_date'])) ?>+08'00'</small><br>
									</td>
									<td class="sign-name" style="padding: 0;">
										<input readonly type="date" class="date2" name="req_sign3" id="req_sign3" value="<?php echo isset($row['signing_date']) ? date('Y-m-d', strtotime($row['signing_date'])) : '' ?>">
									</td>
								</tr>
							<?php endwhile; ?>
							<?php if ($sign->num_rows == 0) {
							?>
								<!-- <div style="text-align: center;">
									<a href="javascript:void(0)" class="btn btn-primary btn-sm view_req" data-id="<?php echo $prf_no ?>" data-dept="6"><span class="fas fa-pencil-alt">&nbsp;Sign</span></a>
								</div> -->
							<?php } ?>
						</table>
						</p>
					</td>
				</tr>
				<tr style="height:23.8pt">
					<td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:23.8pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Name of Successful Applicant : <input readonly type="text" placeholder="" class="xbot" style="width:50%;" name="applicant_name" id="applicant_name"></span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:23.75pt">
					<td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:23.75pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of Commencement : </span>
							<o:p></o:p>
						</p>
					</td>
				</tr>
				<tr style="height:23.75pt">
					<td width="226" valign="bottom" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:23.75pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Checked By :</span>
							<o:p></o:p>
						</p>
					</td>
					<td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:23.75pt">
						<p class="MsoNormal" style="margin-bottom:0cm;line-height:normal">
							<o:p></o:p>
						</p>
					</td>
					<td width="278" valign="bottom" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 7pt;height:23.75pt">
						<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Signature / Date </span>

						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<div style="display: flex; justify-content: space-between; width:90%;margin-left:5%;margin-right:5%;border-collapse:collapse;">
			<h6 style="margin: 0;"><b>TELFORD SVC. PHILS., INC.</b></h6>
			<h6 style="margin: 0;"><b>ADMIN-01 (Rev.9)</b>
				<o:p></o:p>
			</h6>
		</div>
	</div>
	<div class="card-header text-center" style="width:90%;margin-left:5%;margin-right:5%;border-collapse:collapse;font-size:12.0pt;line-height:107%;font-family:Arial,sans-serif;"></div><br>
	<div class="row  justify-content-end " style="width:90%;margin-left:5%;margin-right:5%;border-collapse:collapse;font-size:12.0pt;line-height:107%;font-family:Arial,sans-serif;">
		<!--<div class="form-group col-4 ">
			 <button type="submit" class="btn btn-success btn-block">PASS THE APPLICATION</button> 
		</div>-->
		<div class="form-group col-4 ">
			<a href="<?php echo base_url . "prf/" ?>" class="btn btn-success btn-block"><span class="fas fa-arrow-left"></span> Back</a>
		</div>

		<!-- <div class="form-group col-md-4">
			<button class="btn btn-flat btn-block btn-success" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
		</div> -->
	</div>
	<!-- <div class="container">
        <form id="filter-form">
            <div class="row align-items-end justify-content-center">
                <div class="form-group col-md-4">
                    <button class="btn btn-flat btn-block btn-success" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </div> -->
</form>

<noscript>
	<style>
		textarea {
			vertical-align: top;
			width: 100%;
			resize: none;
		}

		input.form-control:read-only {
			background-color: transparent;
		}

		.wbot {
			border: 0;
			/* border-bottom: 1px solid black; */
			outline: 0;
			text-align: center;
			font-weight: bold;
			background-color: transparent;
		}

		.xbot {
			border: 0;
			outline: 0;
			text-align: center;
			font-weight: bold;
			background-color: transparent;
			padding: 0;
			appearance: none;
		}

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

		.date2 {
			margin: 0 auto;
			width: auto;
			text-align: center;
			font-size: 12pt;
			font-family: Verdana, sans-serif;
			border: 0;
			/* border-bottom: 1px solid black; */
			outline: 0;
			text-align: center;
			font-weight: bold;
			background-color: transparent;
		}

		/* .date {} */

		.image-with-signature {
			text-align: center;
		}

		.signature-line {
			height: 1px;
			background-color: black;
		}

		.signature-image {
			display: block;
			margin: 0 auto;
			height: 50px;
			width: auto;
		}

		.date {
			display: block;
			margin: 0 auto;
			height: 50px;
			width: auto;
			text-align: center;
			font-size: 12pt;
			font-family: Verdana, sans-serif;
			border: 0;
			border-bottom: 1px solid black;
			outline: 0;
			text-align: center;
			font-weight: bold;
			background-color: transparent;
		}

		.date1 {
			display: block;
			margin: 0 auto;
			width: auto;
			text-align: center;
			font-size: 12pt;
			font-family: Verdana, sans-serif;
			border: 0;
			outline: 0;
			text-align: center;
			font-weight: bold;
			background-color: transparent;
		}

		/* .date {} */

		.signature-text {
			text-align: center;
			font-size: 12pt;
			font-family: Verdana, sans-serif;
		}

		.image-container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}



		.holder {
			width: 400px;
			margin: 0 auto;
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

		.sign {
			margin-bottom: 0;
			border-bottom: 0;
			padding: 0;
		}

		.sign-name {
			border: 0;
			font-size: 1vw;
			padding: 0;
			text-align: center;
			line-height: 1;
			margin-bottom: 0;

		}

		.sign-detail {
			border: 0;
			padding: 0;
			font-size: .7vw;
			line-height: 1;
			margin-bottom: 0;

		}

		.xbot {
			border: 0;
			outline: 0;
			text-align: left;
			font-weight: bold;
			background-color: transparent;
			padding: 0;
			text-align: justify;
		}
	</style>
</noscript>

<script>
	function resizeTextarea(textarea) {
		textarea.style.height = 'auto';
		textarea.style.height = textarea.scrollHeight + 'px';
	}
	window.addEventListener('DOMContentLoaded', function() {
		var textareas = document.getElementsByClassName('auto-resize');
		for (var i = 0; i < textareas.length; i++) {
			resizeTextarea(textareas[i]);
		}
	});
	$(document).ready(function() {
		$('.view_req').click(function() {
			uni_modal('', _base_url_ + "admin/prf_admin/check/index.php?id=" + $(this).attr('data-id') + "&sign=" + $(this).attr('data-dept'));
			console.log($(this).attr('data-id'))
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this File permanently?", "delete_product", [$(this).attr('data-id')])
		})
	})
	$(function() {
		$('#filter-form').submit(function(e) {
			e.preventDefault()
			location.href = "./?page=sales&date_start=" + $('[name="date_start"]').val() + "&date_end=" + $('[name="date_end"]').val()
		})

		$('#printBTN').click(function() {
			$('.view_req').hide();
			var head = $('head').clone();
			var rep = $('#printable').clone();
			var ns = $('noscript').clone().html();
			start_loader()
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
					nw.close()
					end_loader()
				}, 200)
			}, 300)
		})
	})
	$(function() {
		$('#prf').submit(function(e) {
			e.preventDefault();
			timerActive = false;
			start_loader()
			if ($('.err-msg').length > 0)
				$('.err-msg').remove();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=request_personnel",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				error: err => {
					console.log(err)
					alert_toast("An Error Occured", 'error')
					end_loader()
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						alert_toast("Request Successful Passed", 'success')
						setTimeout(function() {
							location.reload()
						}, 2000)
					} else if (resp.status == 'failed' && !!resp.msg) {
						var _err_el = $('<div>')
						_err_el.addClass("alert alert-danger err-msg").text(resp.msg)
						alert_toast(resp.msg, 'error')
						end_loader()
					} else {
						console.log(resp)
						alert_toast(resp.msg, 'error')
						end_loader()
					}
				}
			})
		})
	})
</script>