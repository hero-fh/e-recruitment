<link rel="stylesheet" href="<?php echo base_url ?>dist/css/eform.css">
<style>
    textarea {
        vertical-align: top;
        width: 100%;
        resize: none;
    }
</style>
<div class="container">
    <form action="" id="prf">
        <div id="printable" style="overflow-x:auto;overflow-y:hidden;">
            <input type="hidden" name="id" value="<?php isset($id) ? $id : '' ?>">
            <input type="hidden" name="acc_requestor_id" value="<?php echo $_settings->userdata('id') ?>">
            <input type="hidden" name="acc_requestor" value="<?php echo $_settings->userdata('approver') ?>">
            <?php $num = $conn->query("SELECT max(id) from prf_request ")->fetch_array()[0];
            $curyear =  date("Y");
            $num++;
            $unique = str_pad($num, 3, "0", STR_PAD_LEFT);
            ?>
            <p class="text-right"><b style="font-size: 1rem;"><span style="width:100%;border-collapse:collapse;font-size:12.0pt;line-height:107%;font-family:Arial,sans-serif;">PRF No: <input type="text" class="wbot" name="prf_no" value="<?php echo $curyear . "-" . $unique ?>"></span></b><br></p>
            <p class="MsoNormal" style="margin-bottom:24.65pt;">
                <o:p></o:p>
            </p>
            <p>

            </p>
            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;text-align:center;"><b><span style="font-size:20.0pt;line-height:107%;font-family:Arial,sans-serif;">PERSONNEL REQUISITION FORM</span></b>
            </p>
            <br>

            <table class="TableGrid" border="0" cellspacing="0" cellpadding="0" width="737" style="width:100%;border-collapse:collapse;">
                <tbody>
                    <tr style="height:23.05pt">
                        <td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:23.05pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.75pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">EMPLOYMENT
                                        REQUIREMENTS</span></b>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:33.75pt">
                        <td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:33.75pt">
                            <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of
                                    Requisition<span>&nbsp;&nbsp;&nbsp;&nbsp; </span>: <input min="<?php echo date("Y-m-d") ?>" type="date" class="date2" name="requisition" id="requisition" required></span>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:33.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date Received by HR: </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:33.7pt">
                            <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Department<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>:
                                    <select name="prf_department" id="prf_department" required class="xwbot" style="width:30%;appearance: none;">
                                        <option value="" selected>--Department--</option>
                                        <option value="Equipment Engineering">Equipment Engineering</option>
                                        <option value="Facilities">Facilities</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Logistic">Logistic</option>
                                        <option value="MIS">MIS</option>
                                        <option value="PPC">PPC</option>
                                        <option value="Process Engineering">Process Engineering</option>
                                        <option value="Production">Production</option>
                                        <option value="Quality Assurance">Quality Assurance</option>
                                        <option value="Store">Store</option>
                                        <option value="HR">HR</option>
                                        <option value="CE & Training">CE & Training</option>
                                        <option value="Purchasing">Purchasing</option>
                                        <option value="Training">Training</option>
                                    </select>
                                    <input type="text" name="prf_station" id="prf_station" placeholder="Station" class="xwbot" style="width:20%;">
                                    <!-- <select name="prf_station" id="prf_station" required class="xwbot" style="width:20%;appearance: none;">
                                        <option value="" selected>--Station--</option>
                                        <option value="ADCV">ADCV</option>
                                        <option value="Batching">Batching</option>
                                        <option value="Boxing">Boxing</option>
                                        <option value="Brand">Brand</option>
                                        <option value="Branding">Branding</option>
                                        <option value="CE / Timekeeping">CE / Timekeeping</option>
                                        <option value="Equipment Engineering">Equipment Engineering</option>
                                        <option value="Facilities">Facilities</option>
                                        <option value="Finance">Finance</option>
                                        <option value="FVI">FVI</option>
                                        <option value="HR">HR</option>
                                        <option value="IQA Warehouse">IQA Warehouse</option>
                                        <option value="IQA-OQA">IQA-OQA</option>
                                        <option value="Line sustaining">Line sustaining</option>
                                        <option value="Logistics">Logistics</option>
                                        <option value="LTC">LTC</option>
                                        <option value="MIS">MIS</option>
                                        <option value="PE">PE</option>
                                        <option value="PM">PM</option>
                                        <option value="Prove">Prove</option>
                                        <option value="Probe/FVI">Probe/FVI</option>
                                        <option value="Process Engineering">Process Engineering</option>
                                        <option value="Production">Production</option>
                                        <option value="Purchasing">Purchasing</option>
                                        <option value="QA">QA</option>
                                        <option value="Reject/Retention">Reject/Retention</option>
                                        <option value="Rescon">Rescon</option>
                                        <option value="Rescon/Batching">Rescon/Batching</option>
                                        <option value="RTO TNR">RTO TNR</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Store">Store</option>
                                        <option value="TRN-Residual">TRN-Residual</option>
                                        <option value="TRN-Residual&batching">TRN-Residual & Batching</option>
                                        <option value="Traffic">Traffic</option>
                                        <option value="Training">Training</option>
                                        <option value="Tray Management">Tray Management</option>
                                        <option value="UFLEX">UFLEX</option>
                                        <option value="UM">UM</option>
                                        <option value="WLCSP">WLCSP</option>
                                    </select> -->
                                    <select name="prf_pl" id="prf_pl" required class="xwbot" style="width:20%;appearance: none;">
                                        <option value="" selected>--PL--</option>
                                        <option value="G & A">G & A</option>
                                        <option value="PL1">PL1</option>
                                        <option value="PL1-PL4">PL1-PL4</option>
                                        <option value="PL2">PL2</option>
                                        <option value="PL3">PL3</option>
                                        <option value="PL4">PL4</option>
                                        <option value="PL5">PL5</option>
                                        <option value="PL6">PL6</option>
                                        <option value="PL8">PL8</option>
                                        <option value="PL9">PL9</option>
                                    </select>



                                    <!-- <input type="text" name="prf_department" id="prf_department" placeholder="Department" class="xwbot" style="width:20%;">-->
                                    <!-- <input type="text" name="prf_station" id="prf_station" placeholder="Station" class="xwbot" style="width:20%;"> -->
                                    <!-- <input type="text" name="prf_pl" id="prf_pl" placeholder="PL" class="xwbot" style="width:20%;"> -->
                                </span>

                            </p>
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:33.7pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">No. of Requirements: <input type="number" placeholder="Input No. Of Requirements" class="xbot" style="width:50%;" name="req_no" id="req_no" required></span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="459" colspan="2" valign="top" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 7pt;height:33.7pt">
                            <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Position<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>:
                                    <select name="position" class="xbot" id="position" required style="width:50%;appearance: none;">
                                        <option value="" <?= !isset($position) ? "selected" : "" ?>>--Select Position--</option>
                                        <?php
                                        $position1 = $conn->query("SELECT * FROM `position` where  `status` = 1  ORDER BY position");
                                        while ($row = $position1->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['id'] ?>" <?php echo isset($position) && $position == $row['id'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <!-- <input id="position" name="position" class="wbot" required style="width:50%;" placeholder="Input Position"> -->

                                </span>
                            </p>
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:33.7pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Other Requirements: <input type="text" placeholder="Input Other Requirements..." class="xbot" name="other_req" id="other_req" style="width:50%;"></span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:38.9pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:12.1pt;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Academic Qualifications :</span>
                                <textarea onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" placeholder="Input Academic Qualifications..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="academic_qualification" id="academic_qualification" required></textarea>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:28.7pt">
                        <td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:28.7pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.7pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">JOB
                                        DESCRIPTION</span></b>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:38.15pt">
                        <td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:38.15pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Year of Experience<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: <input type="text" style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" class="xbot" style="width:50%;" placeholder="Input Years of Experience..." name="exp_years" id="exp_years" required></span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:76.8pt">
                        <td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:76.8pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Skills / Abilities / Knowledge :</span>
                                <textarea onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" placeholder="Input Skills / Abilities / Knowledge..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="skills" id="skills" required></textarea>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:101.4pt">
                        <td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:101.4pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Please Provide Detailed<span>&nbsp; </span>Job function :</span>
                                <textarea onload="resizeTextarea(this)" oninput="resizeTextarea(this)" rows="3" class="xbot auto-resize" placeholder="Input Job Function..." style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" name="job_function" id="job_function" required></textarea>

                            </p>
                        </td>
                    </tr>
                    <tr style="height:48.0pt">
                        <td width="737" colspan="3" valign="top" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:48.0pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Reason for Personnel Requisition :</span>
                                <textarea onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot auto-resize" style="width:100%; box-sizing:border-box; font-size:12pt; word-break:break-word; white-space: normal;  overflow: hidden;" placeholder="Input Reason for Personnel Requisition..." name="reason_for_requisition" id="reason_for_requisition" required></textarea>

                            </p>
                        </td>
                    </tr>
                    <style>
                        .select2 {
                            border: 1px solid black;
                            outline: 0;
                            text-align: center;
                            font-weight: bold;
                        }
                    </style>
                    <tr style="height:23.75pt">
                        <td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Prepared By:</span>

                                <!-- <input type="text" class="wbot" name="requestor" id="requestor" required value="<?php echo isset($requestor) ? $requestor : '' ?>" required> -->
                            </p>
                            <div class="row justify-content-center">
                                <div class="form-group  col-6">
                                    <select name="requestor" id="requestor" class="form-control xwbot select2" required>
                                        <option value="" disabled <?= !isset($meta['approver']) ? "selected" : "" ?>></option>
                                        <?php
                                        $application = $conn->query("SELECT * FROM `employee_masterlist`  ORDER BY EMPNAME");
                                        while ($row = $application->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['EMPNAME'] ?>" <?php echo isset($meta['approver']) && $meta['approver'] == $row['EMPLOYID'] ? 'selected' : '' ?>><?= $row['EMPNAME'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="height:52.7pt">
                        <td width="226" valign="top" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:52.7pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Demartment Head:</span>

                            </p>
                        </td>
                        <td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:52.7pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Approved By:</span>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:52.7pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Noted by:</span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:15.1pt">
                        <td width="226" valign="top" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:15.1pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.8pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Department Head</span>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:15.1pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:20.0pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Authorized Signatory</span>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:15.1pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.6pt;text-align:center;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Human Resource Manager</span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:25.2pt">
                        <td width="737" colspan="3" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:25.2pt">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:19.5pt;text-align:center;line-height:normal"><b><span style="font-size:12.0pt;font-family:Arial,sans-serif;">(For
                                        Administration Department Only)</span></b>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:23.75pt">
                        <td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of Advertisement :</span>

                            </p>
                        </td>
                    </tr>
                    <tr style="height:20.05pt">
                        <td width="459" colspan="2" rowspan="3" valign="bottom" style="width:344.35pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:20.05pt">
                            <p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Status:<span>&nbsp; </span>
                                    <div class="checkbox">
                                        <input disabled type="radio" value="1" class="check" id="check1" name="status" />
                                        <label for="check1" class="label">
                                            <svg width="50" height="50" viewBox="0 0 100 100">
                                                <rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
                                                <g transform="translate(30,20)">
                                                    <path d="M 10,25 L 25,40 L 45,10" stroke="black" fill="none" stroke-width="10" class="path1" />
                                                </g>
                                            </svg>
                                            <span>Hold &nbsp;&nbsp;&nbsp;</span>
                                        </label> <b>Reason: </b><input class="xbot auto-resize" style=" box-sizing:border-box; font-size:10pt; word-break:break-word; white-space: normal; width:50%; overflow: hidden;" name="reason1" disabled>
                                    </div>
                                </span>
                            </p>
                            <p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">
                                    <div class="checkbox">
                                        <input disabled type="radio" value="2" class="check" id="check2" name="status" />
                                        <label for="check2" class="label">
                                            <svg width="50" height="50" viewBox="0 0 100 100">
                                                <rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
                                                <g transform="translate(30,20)">
                                                    <path d="M 10,25 L 25,40 L 45,10" stroke="black" fill="none" stroke-width="10" class="path1" />
                                                </g>
                                            </svg>
                                            <span>Cancelled &nbsp;&nbsp;&nbsp;</span>
                                        </label> <b>Reason: </b><input class="xbot auto-resize" style=" box-sizing:border-box; font-size:10pt; word-break:break-word; white-space: normal; width:50%; overflow: hidden;" name="reason2" disabled>
                                    </div>
                                </span>
                            </p>
                            <p class="MsoNormal" style="margin-bottom:0;line-height:normal;"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">
                                    <div class="checkbox">
                                        <input disabled type="radio" value="3" class="check" id="check3" name="status" />
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
                                <textarea  onload="resizeTextarea(this)" oninput="resizeTextarea(this)" class="xbot"  style="width:50%;; box-sizing:border-box; font-size:.7vw; word-break:break-word; white-space: normal;  overflow: hidden;" name="reason2"><?php echo isset($reason2) ? $reason2 : '' ?></textarea>

                            </span>
                        </p>
                        <br>
                        <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:.10cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="border:solid black 1.5pt;padding:0cm"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span>&nbsp;</span>Closed</span>

                        </p> -->
                        </td>
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:20.05pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
                                    Requestor / Date: </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:20.05pt">
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:20.05pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
                                    Requestor / Date: </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:20.05pt">
                        <td width="278" valign="top" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:20.05pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:100.1pt;margin-bottom:0cm;margin-left:0cm;text-align:justify;text-justify:inter-ideograph;line-height:normal"><span style="font-size:10.0pt;font-family:Arial,sans-serif;">Signature of
                                    Requestor / Date: </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:23.8pt">
                        <td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:23.8pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Name of Successful Applicant : </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:23.75pt">
                        <td width="737" colspan="3" valign="bottom" style="width:552.85pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Date of Commencement : </span>
                                <o:p></o:p>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:23.75pt">
                        <td width="226" valign="bottom" style="width:169.45pt;border:solid black 1.0pt;border-top:none;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Checked By :</span>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="233" valign="top" style="width:174.9pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal">
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="278" valign="bottom" style="width:208.5pt;border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.7pt 20.55pt .75pt 1.7pt;height:23.75pt">
                            <p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:.25pt;line-height:normal"><span style="font-size:12.0pt;font-family:Arial,sans-serif;">Signature / Date </span>

                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between; width:100%;border-collapse:collapse;">
                <h6 style="margin: 0;"><b>TELFORD SVC. PHILS., INC.</b></h6>
                <h6 style="margin: 0;"><b>ADMIN-01 (Rev.9)</b>
                    <o:p></o:p>
                </h6>
            </div>
        </div>

        <div class="card-header text-center"></div><br>
        <div class="row  justify-content-between  ">

            <div class="form-group col-4 ">

                <button type="submit" class="btn btn-success btn-block">REQUEST PERSONNEL</button>
            </div>
            <div class="form-group col-4 ">
                <a href="<?php echo base_url . "prf/" ?>" class="btn btn-success btn-block"><span class="fas fa-arrow-left"></span> Back</a>
            </div>

        </div>
    </form>
    <!-- <div class="container">
        <form id="filter-form">
            <div class="row align-items-end justify-content-center">
                <div class="form-group col-md-4">
                    <button class="btn btn-flat btn-block btn-success" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </div> -->

</div>


<script>
    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })
    })
    // var btn = <?php //echo $data_json; 
                    ?>;
    // console.log(btn)
    // if (btn == 1) {
    //     $('#view').removeClass('d-none')
    //     $('#sub').addClass('d-none')
    // } else if (btn == 2) {
    //     $('#view').addClass('d-none')
    //     $('#sub').removeClass('d-none')

    // }
    // Retrieve the value of the input field from localStorage
    // var inputFieldValue = JSON.parse(localStorage.getItem('input-field-values'));
    // if (inputFieldValue) {
    //     document.getElementById('requisition').value = inputFieldValue[0];
    //     document.getElementById('prf_department').value = inputFieldValue[1];
    //     document.getElementById('prf_station').value = inputFieldValue[2];
    //     document.getElementById('prf_pl').value = inputFieldValue[3];
    //     document.getElementById('req_no').value = inputFieldValue[4];
    //     document.getElementById('other_req').value = inputFieldValue[5];
    //     document.getElementById('academic_qualification').value = inputFieldValue[6];
    //     document.getElementById('exp_years').value = inputFieldValue[7];
    //     document.getElementById('skills').value = inputFieldValue[8];
    //     document.getElementById('job_function').value = inputFieldValue[9];
    //     document.getElementById('reason_for_requisition').value = inputFieldValue[10];
    //     document.getElementById('position').value = inputFieldValue[11];
    //     document.getElementById('requestor').value = inputFieldValue[12];
    // }
    // // Store the value of the input field in localStorage when the input changes
    // document.querySelectorAll('input, textarea,select').forEach(function(input) {
    //     input.addEventListener('input', function(event) {
    //         var updatedInputFieldValues = [
    //             document.getElementById('requisition').value,
    //             document.getElementById('prf_department').value,
    //             document.getElementById('prf_station').value,
    //             document.getElementById('prf_pl').value,
    //             document.getElementById('req_no').value,
    //             document.getElementById('other_req').value,
    //             document.getElementById('academic_qualification').value,
    //             document.getElementById('exp_years').value,
    //             document.getElementById('skills').value,
    //             document.getElementById('job_function').value,
    //             document.getElementById('reason_for_requisition').value,
    //             document.getElementById('position').value,
    //             document.getElementById('requestor').value
    //         ];
    //         localStorage.setItem('input-field-values', JSON.stringify(updatedInputFieldValues));
    //     });
    // });



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
                        localStorage.removeItem('input-field-values');

                        setTimeout(function() {
                            location.replace(_base_url_ + "prf/")
                            // location.replace(_base_url_ + "prf/?p=view_prf&id=" + resp.id, )
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