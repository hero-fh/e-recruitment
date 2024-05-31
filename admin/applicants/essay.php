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
        <div id="print_out">
            <?php
            $id = $conn->query("SELECT id FROM `applicants` WHERE id = '{$_GET['id']}'")->fetch_array()[0];
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
                <input type="hidden" name="id" value="<?php echo $id; ?>">
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

            <div class="card-header text-center"></div><br>
            <div class="row mb-3 mr-3 justify-content-end  ">
                <div class="col-4 ">
                    <?php echo isset($data[0]['applicant_id']) ? '<a class="btn btn-primary btn-block" href="' . base_url . 'admin?page=applicants">Back to List</a>' : '<button type="submit" class="btn btn-primary btn-block">SUBMIT EXAM SCORE</button>'; ?>
                    <!-- <button type="submit" class="btn btn-primary btn-block">SUBMIT EXAM SCORE</button> -->
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $("input[type='checkbox'], .score, .score1.score2.score3").on("change input", function() {

        let totalCount = calculateAll();
        let score2 = parseInt($(".score2").val());
        let score3 = parseInt($(".score3").val());
        let result = totalCount + score2 + score3;
        // var px = $('.score').val(result)
        console.log(result);
    });

    // Define event listener separately outside the main function
    $(".score2").on("input", handleScoreInput2);
    $(".score3").on("input", handleScoreInput3);



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
    // let flag = 0;
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
            var score2 = parseInt($(".score2").val());
            var score3 = parseInt($(".score3").val());
            let result = totalCount + score2 + score3;
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
                        start_loader()
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                        // location.reload();
                        // flag += 1
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
                            location.reload()
                        }, 2000)

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
                            // flag += 1
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