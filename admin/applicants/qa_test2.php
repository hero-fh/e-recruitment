<link rel="stylesheet" href="<?php echo base_url ?>dist/css/view_client.css">
<style>
    input[type=checkbox] {
        display: none;
    }

    .label {
        border: 1px solid #000;
        display: inline-block;
        padding: 10px;
        /* background: url("unchecked.png") no-repeat left center; */
        /* padding-left: 15px; */
    }

    .label1 {
        border: 1px solid #000;
        display: inline-block;
        padding: 10px;
        /* background: url("unchecked.png") no-repeat left center; */
        /* padding-left: 15px; */
    }

    input[type=checkbox]:checked+.label {
        background: rgb(5, 255, 25);
        /* background: #28A745; */
        color: #fff;
        /* background-image: url("checked.png"); */
    }

    input[type=checkbox]:checked+.label1 {
        background: #f00;
        color: #fff;
        /* background-image: url("checked.png"); */
    }

    .notes {
        background-attachment: local;
        background-image:
            linear-gradient(to right, white 10px, transparent 10px),
            linear-gradient(to left, white 10px, transparent 10px),
            repeating-linear-gradient(white, white 30px, #ccc 30px, #ccc 31px, white 31px);
        line-height: 31px;
        padding: 8px 10px;
        width: 100%;
    }
</style>
<form action="" id="take-exam1">
    <div class="card card-outline card-primary">
        <div class="container-fluid" id="print_out">
            <?php $test = $conn->query("SELECT * FROM `enumeration` WHERE applicant_id = '{$_GET['id']}'");
            while ($row = $test->fetch_assoc()) :
                $get = $conn->query("SELECT * FROM `enumeration_score` WHERE applicant_id = '{$_GET['id']}'");
                if ($get->num_rows > 0) {
                    while ($rows = $get->fetch_assoc()) {
                        $data[] = $rows;
                    }
                }
                $qry = $conn->query("SELECT * FROM essay where applicant_id = '{$_GET['id']}' ");
                if ($qry->num_rows > 0) {
                    foreach ($qry->fetch_array() as $k => $v) {
                        $$k = $v;
                    }
                }
            ?>
                <div class="align-items-top mb-3">
                    <input type="hidden" class="applicant_id" name="applicant_id" value="<?php echo $_GET['id'] ?>">

                    <div class="toggle-accordion accordion hover" id="toggle-003" data-toggle-id="003" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <label class="h4" id="toggle-003" data-toggle-id="003">
                            Essay and Typing Test
                        </label>
                    </div>
                    <div class="card-body address-holder003 hidden lala" data-exam-id="003">
                        <h6><b>PART I. ESSAY & TYPING TEST (100 words within 5 minutes)</b></h6><br>
                        <h6><label><input type="number" class="form-control score2" name="essay1" required max="5" min="0" placeholder="Input Score" <?php echo isset($data[0]['essay1'])  ? 'disabled'  : ''; ?> value="<?php echo isset($data[0]['essay1'])  ? $data[0]['essay1']  : ''; ?>"></label><b> 1. What does work mean to you? <B>(5 POINTS)</B><BR>
                                (Ano ang kahulugan ng trabaho sa iyo?)
                            </b></h6><br>
                        <textarea rows="10" name="essayq1" required class="notes" disabled><?php echo isset($essayq1) ? $essayq1 : 'N/A' ?></textarea>
                        <h6><label><input type="number" class="form-control score3" name="essay2" required max="5" min="0" placeholder="Input Score" <?php echo isset($data[0]['essay2'])  ? 'disabled'  : ''; ?> value="<?php echo isset($data[0]['essay2'])  ? $data[0]['essay2']  : ''; ?>"></label><b> 2. How do you value work? <B>(5 POINTS)</B><BR>
                                (Paano mo pinahahalagahan ang iyong trabaho?)
                            </b></h6><br>
                        <textarea rows="10" name="essayq2" required class="notes" disabled><?php echo isset($essayq2) ? $essayq2 : 'N/A' ?></textarea>

                    </div>


                </div>
                <div class="align-items-top mb-3">

                    <div class="toggle-accordion accordion hover" id="toggle-004" data-toggle-id="004" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <label class="h4" id="toggle-004" data-toggle-id="004">
                            Visual Inspection Test
                        </label>
                    </div>
                    <div class="card-body address-holder004 hidden lala" data-exam-id="004">
                        <h6><b>PART II. VISUAL INSPECTION TEST</b></h6><br>
                        <div class="row justify-content-end">

                            <div class="col-md-8">
                                <div class="form-group" style="text-align: center;">
                                    <label for="unit1">UNIT MARK</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center;">
                                    <label for="unit2">EVALUATION</label>
                                </div>
                            </div>
                        </div><br>
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">1. Dummy Unit # 1:</label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">

                                    <input style="width: 95%;" type="text" required name="unit1" id="unit1" disabled value="<?php echo isset($unit1) ? $unit1 : 'N/A' ?>">;
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label><input name="dum1" type="checkbox" value="1" <?php echo isset($data[0]['dum1'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['dum1']) ? ($data[0]['dum1'] == 0 &&  isset($data[0]['dum1']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['dum1']) ? (($data[0]['dum1'] == 0 && isset($data[0]['dum1'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label>
                                    <!-- <input type="text" style="width:100%;" required name="unit2" id="unit2" value="<?php echo isset($unit2) ? $unit2 : 'N/A' ?>"> -->
                                </div>
                            </div>
                        </div><br>
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"> 2. Dummy Unit # 2:</label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input style="width: 95%;" type="text" disabled name="unit3" id="unit3" value="<?php echo isset($unit3) ? $unit3 : 'N/A' ?>">;
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label><input name="dum2" type="checkbox" value="1" <?php echo isset($data[0]['dum2'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['dum2']) ? ($data[0]['dum2'] == 0 &&  isset($data[0]['dum2']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['dum2']) ? (($data[0]['dum2'] == 0 && isset($data[0]['dum2'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label>
                                    <!-- <input type="text" style="width:100%;" required name="unit4" id="unit4" value="<?php echo isset($unit4) ? $unit4 : 'N/A' ?>"> -->
                                </div>
                            </div>
                        </div><br>

                    </div>

                </div>
                <div class="align-items-top mb-3">
                    <div class="toggle-accordion accordion hover" id="toggle-001" data-toggle-id="001" style="padding: 5px;text-align: center;border: 0;border-bottom: 1px solid black;border-top: 1px solid black; ">
                        <label class="h4" id="toggle-001" data-toggle-id="001">
                            TEST II. - QA Engineer
                        </label>
                    </div>
                    <div class="card-body address-holder001 hidden lala" data-exam-id="001">
                        <h6><b> A. Identification. Write the best answer on the blank. Choose among the available choices below the questions.</b></h6><br>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q1'], ''))) == '7basicqctools') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q1" value="<?php echo $row['q1'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q1" class="control-label">1. A designation given to a fixed set of graphical techniques identified as being most helpful in trouble shooting issues related to quality. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q2'], '  '))) == 'statisticalprocesscontrol') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q2" value="<?php echo $row['q2'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q2" class="control-label">2. Is a method of quality control which uses statistical methods in order to monitor and control a process. It answers the question if the process is functioning properly or not.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q3'], '  '))) == 'correctiveaction') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q3" value="<?php echo $row['q3'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q3" class="control-label">3. Action to eliminate the cause of detected nonconformity.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q4'], '  '))) == 'preventiveaction') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q4" value="<?php echo $row['q4'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q4" class="control-label"> 4. Action to eliminate the cause of potential non conformity. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q5'], '  '))) == 'audit') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q5" value="<?php echo $row['q5'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q5" class="control-label">5. This procedure sets forth the method for periodically and randomly examining systems to identify non-conforming conditions to bring to attention of those responsible for the condition and if appropriate, a corrective and preventive actions are readonly. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q6'], '  '))) == 'qualitymanagementsystem') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q6" value="<?php echo $row['q6'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q6" class="control-label">6. An international agreement on SMART management practices, the organizational structure, procedures, processes and resources needed to implement quality management. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q7'], '  '))) == 'environmentalmanagementsystem') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q7" value="<?php echo $row['q7'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q7" class="control-label">7. Refers to the management of an organization’s environmental programs in a comprehensive, systematic, planned and documented manner. It includes the organizational structure, planning and resources for developing implementing and maintaining policy for environmental protection. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q8'], '  '))) == 'paretodiagram') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q8" value="<?php echo $row['q8'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q8" class="control-label">8. It is a simple vertical bar chart that shows the frequency of various categories of a problem. The bars are arranged in a descending magnitude, from left to right, accompanied by cumulative percentage line. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q9'], '  '))) == 'controlcharts') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q9" value="<?php echo $row['q9'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q9" class="control-label">9. Tool used to check if processes are in the stable condition or maintain processes in stable condition. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q10'], '  '))) == 'processcapability') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q10" value="<?php echo $row['q10'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q10" class="control-label">10. The Ability of a process to meet design specification, which are set by engineering or customer requirements. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q11'], '  '))) == 'quality') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q11" value="<?php echo $row['q11'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q11" class="control-label">11. Products or services that meet or exceed customers satisfaction, the totality of feature and characteristic of the product and service that bear on its ability to satisfy stated or implied needs. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q12'], '  '))) == 'acceptancesampling') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q12" value="<?php echo $row['q12'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q12" class="control-label">12. A method of measuring random samples of lots or batches of products against predetermined standards. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q13'], '  '))) == 'integratedcircuit') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q13" value="<?php echo $row['q13'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q13" class="control-label">13. An interconnection of circuit components inseparably associated on or within a single substrate. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q14'], '  '))) == 'printedcircuitboard') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q14" value="<?php echo $row['q14'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q14" class="control-label">14. The general term for completely processed printed circuit or wiring configuration which maybe single, double or multi-layered. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q15'], '  '))) == 'actuator') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q15" value="<?php echo $row['q15'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q15" class="control-label">15. A device that produces mechanical motions. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q16'], '  '))) == 'pneumaticactuator') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q16" value="<?php echo $row['q16'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q16" class="control-label">16. A type of actuator that uses air pressure to produce mechanical motions. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q17'], '  '))) == 'ionizer') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q17" value="<?php echo $row['q17'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q17" class="control-label">17. A device that uses high voltage to neutralize static charge in a surface of a material. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q18'], '  '))) == 'humidity') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q18" value="<?php echo $row['q18'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q18" class="control-label">18. The moisture content of the air. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q19'], '  '))) == 'qualitycontrol') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q19" value="<?php echo $row['q19'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q19" class="control-label">19. Is a process by which entitles review the quality pf all the factors involved in production. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <?php
                            if (strtolower(str_replace(' ', '', trim($row['q20'], '  '))) == 'qualityassurance') {
                            ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" checked disabled value="1"><span class="label"> &#10004;</span></label>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="">
                                    <div class="form-group">
                                        <label><input type="checkbox" disabled value="0" checked><span class="label1">&#10006;</span></label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control " readonly id="q20" value="<?php echo $row['q20'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="q20" class="control-label">20. refers to the engineering activities implemented in a quality system so that requirements for a product or services will be fulfilled </label>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <h6><b> B. Enumeration</b></h6><br>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">I. Enumerate the Basic 7 QC Tools </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b1" type="checkbox" value="1" <?php echo isset($data[0]['b1'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b1']) ? ($data[0]['b1'] == 0 &&  isset($data[0]['b1']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b1']) ? (($data[0]['b1'] == 0 && isset($data[0]['b1'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 1. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b1" value="<?php echo $row['b1'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b2" type="checkbox" value="1" <?php echo isset($data[0]['b2'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b2']) ? ($data[0]['b2'] == 0 &&  isset($data[0]['b2']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b2']) ? (($data[0]['b2'] == 0 && isset($data[0]['b2'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 2. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b2" value="<?php echo $row['b2'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b3" type="checkbox" value="1" <?php echo isset($data[0]['b3'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b3']) ? ($data[0]['b3'] == 0 &&  isset($data[0]['b3']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b3']) ? (($data[0]['b3'] == 0 && isset($data[0]['b3'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 3. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b3" value="<?php echo $row['b3'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b4" type="checkbox" value="1" <?php echo isset($data[0]['b4'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b4']) ? ($data[0]['b4'] == 0 &&  isset($data[0]['b4']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b4']) ? (($data[0]['b4'] == 0 && isset($data[0]['b4'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 4. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b4" value="<?php echo $row['b4'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b5" type="checkbox" value="1" <?php echo isset($data[0]['b5'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b5']) ? ($data[0]['b5'] == 0 &&  isset($data[0]['b5']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b5']) ? (($data[0]['b5'] == 0 && isset($data[0]['b5'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 5. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b5" value="<?php echo $row['b5'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b6" type="checkbox" value="1" <?php echo isset($data[0]['b6'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b6']) ? ($data[0]['b6'] == 0 &&  isset($data[0]['b6']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b6']) ? (($data[0]['b6'] == 0 && isset($data[0]['b6'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 6. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b6" value="<?php echo $row['b6'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="b7" type="checkbox" value="1" <?php echo isset($data[0]['b7'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['b7']) ? ($data[0]['b7'] == 0 &&  isset($data[0]['b7']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['b7']) ? (($data[0]['b7'] == 0 && isset($data[0]['b7'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 7. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="b7" value="<?php echo $row['b7'] ?>">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">II. What are the 8 Disciples of Problem solving. </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c1" type="checkbox" value="1" <?php echo isset($data[0]['c1'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c1']) ? ($data[0]['c1'] == 0 &&  isset($data[0]['c1']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c1']) ? (($data[0]['c1'] == 0 && isset($data[0]['c1'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 1. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c1" value="<?php echo $row['c1'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c2" type="checkbox" value="1" <?php echo isset($data[0]['c2'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c2']) ? ($data[0]['c2'] == 0 &&  isset($data[0]['c2']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c2']) ? (($data[0]['c2'] == 0 && isset($data[0]['c2'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 2. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c2" value="<?php echo $row['c2'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c3" type="checkbox" value="1" <?php echo isset($data[0]['c3'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c3']) ? ($data[0]['c3'] == 0 &&  isset($data[0]['c3']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c3']) ? (($data[0]['c3'] == 0 && isset($data[0]['c3'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 3. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c3" value="<?php echo $row['c3'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c4" type="checkbox" value="1" <?php echo isset($data[0]['c4'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c4']) ? ($data[0]['c4'] == 0 &&  isset($data[0]['c4']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c4']) ? (($data[0]['c4'] == 0 && isset($data[0]['c4'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 4. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c4" value="<?php echo $row['c4'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c5" type="checkbox" value="1" <?php echo isset($data[0]['c5'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c5']) ? ($data[0]['c5'] == 0 &&  isset($data[0]['c5']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c5']) ? (($data[0]['c5'] == 0 && isset($data[0]['c5'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 5. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c5" value="<?php echo $row['c5'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c6" type="checkbox" value="1" <?php echo isset($data[0]['c6'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c6']) ? ($data[0]['c6'] == 0 &&  isset($data[0]['c6']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c6']) ? (($data[0]['c6'] == 0 && isset($data[0]['c6'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 6. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c6" value="<?php echo $row['c6'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c7" type="checkbox" value="1" <?php echo isset($data[0]['c7'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c7']) ? ($data[0]['c7'] == 0 &&  isset($data[0]['c7']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c7']) ? (($data[0]['c7'] == 0 && isset($data[0]['c7'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 7. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c7" value="<?php echo $row['c7'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span> <label><input name="c8" type="checkbox" value="1" <?php echo isset($data[0]['c8'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['c8']) ? ($data[0]['c8'] == 0 &&  isset($data[0]['c8']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['c8']) ? (($data[0]['c8'] == 0 && isset($data[0]['c8'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label> &nbsp; 8. &nbsp; </span>
                                    </div>
                                    <input type="text" class="form-control " readonly id="c8" value="<?php echo $row['c8'] ?>">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><label><input type="number" class="form-control score" name="o1" required max="5" min="0" placeholder="Input Score" <?php echo isset($data[0]['o1'])  ? 'disabled'  : ''; ?> value="<?php echo isset($data[0]['o1'])  ? $data[0]['o1']  : ''; ?>"></label>&nbsp;III. State the Mathematical representation of Ohm's Law (5pts) </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="o1" class="control-label">Answer: </label>
                                <textarea rows="4" class="form-control " readonly id="o1"><?php echo $row['o1'] ?></textarea>
                            </div>
                        </div>
                        <br><br>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">IV. Basic Electronics </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right">
                                    <label class="control-label">Symbols: &#937; | &#x192; | &#x3A5; | &Alpha; | &#956; </label>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">1. Identify the Current (I) </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="../uploads/basic_electronics.png" alt="Basic Electronics" width="100%" height="100%">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e1" class="control-label"><label><input name="e1" type="checkbox" value="1" <?php echo isset($data[0]['e1'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['e1']) ? ($data[0]['e1'] == 0 &&  isset($data[0]['e1']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['e1']) ? (($data[0]['e1'] == 0 && isset($data[0]['e1'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label>&nbsp;Answer: </label>
                                <textarea rows="2" class="form-control " readonly id="e1"><?php echo $row['e1'] ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">2. Solve for the value of R5 </label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="../uploads/r5.png" alt="R5" width="100%" height="100%">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="r1" class="control-label"><label><input name="r1" type="checkbox" value="1" <?php echo isset($data[0]['r1'])  ? 'checked disabled' : ''; ?>><span class='<?php echo isset($data[0]['r1']) ? ($data[0]['r1'] == 0 &&  isset($data[0]['r1']) ? 'label1' : 'label') : 'label' ?>'> <?php echo isset($data[0]['r1']) ? (($data[0]['r1'] == 0 && isset($data[0]['r1'])) ? '&#10006;' : '&#10004;') : '&#10004;' ?></span></label>&nbsp;Answer: </label>
                                <textarea rows="2" class="form-control " readonly id="r1"><?php echo $row['r1'] ?></textarea>
                            </div>
                        </div>

                        <div class="card-header text-center"></div><br>
                        <div class="row  mb-3 mr-3 justify-content-end  ">
                            <div class="col-4 ">
                                <?php echo isset($data[0]['applicant_id']) ? '<a class="btn btn-primary btn-block" href="' . base_url . 'admin?page=applicants">Back to List</a>' : '<button type="submit" class="btn btn-primary btn-block">SUBMIT EXAM SCORE</button>'; ?>
                                <!-- <button type="submit" class="btn btn-primary btn-block">SUBMIT EXAM SCORE</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</form>
<script>
    // $("input[type='checkbox'],.score").change(function() {
    //     totalCount = calculateAll()
    //     // alert(totalCount);
    //     console.log(totalCount)
    // });

    // function calculateAll() {
    //     let count = 0;
    //     $("input[type='checkbox']").each(function(index, checkbox) {
    //         if (checkbox.checked)
    //             count += parseInt(checkbox.value)
    //     })
    //     $(".score").on("input", function() {
    //         count += parseInt($(this).val())
    //         console.log(count)
    //     });
    //     return count;
    // }
    $("input[type='checkbox'], .score, .score1.score2.score3").on("change input", function() {

        let totalCount = calculateAll();
        let score = parseInt($(".score").val());

        let score2 = parseInt($(".score2").val());
        let score3 = parseInt($(".score3").val());
        let result = totalCount + score + score2 + score3;
        // var px = $('.score').val(result)
        console.log(result);
    });

    // Define event listener separately outside the main function
    $(".score").on("input", handleScoreInput);
    $(".score2").on("input", handleScoreInput2);
    $(".score3").on("input", handleScoreInput3);

    // Event listener function
    function handleScoreInput() {
        // Your code to handle the score input event
        let score = parseInt($(this).val());
        console.log(score);

    }

    function handleScoreInput2() {
        // Your code to handle the score input event
        let score2 = parseInt($(this).val());
        // console.log(score1);

    }

    function handleScoreInput3() {
        // Your code to handle the score input event
        let score3 = parseInt($(this).val());
        // console.log(score1);

    }

    // Main calculation function
    function calculateAll() {
        let count = 0;

        $("input[type='checkbox']").each(function(index, checkbox) {
            if (checkbox.checked)
                count += parseInt(checkbox.value);
        });

        return count;
    }
    $(document).ready(function() {
        $('#take-exam1').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            var el = $('<div>');
            el.addClass("alert err-msg");
            el.hide();
            start_loader();
            var id = $('.applicant_id').val();
            var totalCount = calculateAll();
            var score = parseInt($(".score").val());

            let score2 = parseInt($(".score2").val());
            let score3 = parseInt($(".score3").val());
            let result = totalCount + score + score2 + score3;
            console.log(result)
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=qa_score",
                data: {
                    id: id,
                    result: result
                }, // Pass the 'result' value in the data
                cache: false,
                method: 'POST',
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
                        // location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        el.addClass('alert-danger').text(resp.msg);
                        _this.prepend(el)
                        el.show('.modal')
                    } else {
                        el.text("An error occured");
                        console.error(resp)
                    }
                    $("html, body").scrollTop(0);


                }
            })
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=qa_score1",
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
                        alert_toast("Test II Score successfully saved", 'success')
                        setTimeout(function() {
                            // location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
                            // location.reload()
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
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_essay",
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
                        alert_toast("Essay successfully saved", 'success')
                        setTimeout(function() {
                            location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
                            // location.reload()
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
    })
</script>