<?php
$query = $conn->query("SELECT * FROM `assessment`");
$countrow = $query->num_rows;
if ($countrow <= 0) {

    if (isset($_GET['id'])) {
        $qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname  from `applicants` where id = '{$_GET['id']}' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $k => $v) {
                $$k = $v;
            }
        }
    }
} else {
    $query = $conn->query("SELECT a.*,concat(c.surname,', ',c.firstname,' ',c.middlename) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
    $countrow = $query->num_rows;
    if ($countrow == 1) {
        if (isset($_GET['id'])) {
            $qry = $conn->query("SELECT a.*,concat(c.surname,',  ',c.firstname,' ',c.middlename) as fullname from `assessment` a inner join applicants c on c.id = a.id where a.id = '{$_GET['id']}' ");
            if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                    $$k = $v;
                }
            }
        }
    } else {
        if (isset($_GET['id'])) {
            $qry = $conn->query("SELECT *, concat(surname,', ',firstname,' ', middlename) as fullname  from `applicants` where id = '{$_GET['id']}' ");
            if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                    $$k = $v;
                }
            }
        }
    }
}
date_default_timezone_set('Asia/Manila');
?>
<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: scale-down;
        object-position: center center;
        border-radius: 100% 100%;
    }

    input[type="text"] {
        border: 0;
        border-bottom: 1px solid black;
        outline: 0;
        text-align: center;
        font-weight: bold;
    }

    ::-webkit-input-placeholder {
        text-align: center;
    }

    :-moz-placeholder {
        text-align: center;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 0;
    }

    input[type="number"] {
        border: 0;
        border-bottom: 1px solid black;
        outline: 0;
        text-align: center;
        font-weight: bold;
    }

    input[type="date"] {
        border: 0;
        border-bottom: 1px solid black;
        outline: 0;
        text-align: center;
        font-weight: bold;
    }

    input.form-control:read-only {
        background-color: #fff;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><?php echo isset($id) ? "Assessment Form" : '' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="client-form" enctype="multipart/form-data">

                <input type="hidden" readonly name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="">Personal Information</legend>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name" class="control-label ">Name : </label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="name" readonly name="name" value="<?php echo isset($fullname) ? $fullname : '' ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date" style="display: block; text-align: center;" class="control-label ">Date : </label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date" readonly name="date" value="<?php echo date("m-d-Y") ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="a_position" class="control-label ">Position :</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="a_position" readonly name="a_position" placeholder="Position" value="<?php echo isset($a_position) ? $a_position : '' ?>">
                            </div>

                        </div>
                        <p class="h5"><b>I - Qualifying Exam</b></P>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">Rating</label>
                                <input type="number" class="form-control form-control-sm rounded-0" id="rating" readonly name="rating" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating) ? $rating : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="a_remarks" class="control-label ">Remarks</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="a_remarks" placeholder="REMARKS" readonly name="a_remarks" value="<?php echo isset($a_remarks) ? $a_remarks : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="conducted_by" class="control-label ">Conducted By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="conducted_by" placeholder="CONDUCTED BY" readonly name="conducted_by" value="<?php echo isset($conducted_by) ? $conducted_by : '' ?>">
                            </div>
                        </div>
                        <div class="card-header text-center">

                        </div>
                        <p class="h5 login-box-msg"><b><i>Interview Rating Scale</i></b></P>
                        <I>Instruction : From scale of 1 - 10 (with 10 as the highest and 1 as the lowest) rate each item based on your observation during the interview.</I><br><br>
                        <p class="h5"><b>II - Preliminary Interview</b></I>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">a. APPEARANCE</label>
                                <I> (Manner of Dressing, Posture/Poise)</I>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating1" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating1" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating1) ? $rating1 : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                                <I>(Knowledgeability, Competence, Judgement, Analytical Ability)</I>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating3" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating3" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating3) ? $rating3 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                                <I> (Vocabulary, Voice Projection)</I>
                                <I> (Diction, Self-Expression)</I>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating2" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating2" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating2) ? $rating2 : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">d. PERSONALITY</label>
                                <I>(Energy/Alertness/Iniative, Integrity/Honesty)</I>
                                <I>(Self Confidence, Decisiveness)</I>
                                <I>(Stress Tolerance, Interpersonal Sensitivity)</I>
                            </div>
                            <div class="form-group form-inline col-sm-2">
                                <label for="rating4" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating4" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating4) ? $rating4 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="comment" class="control-label ">COMMENTS</label>
                                <textarea rows="2" class="form-control" readonly name="comment" placeholder="COMMENTS" value="<?php echo isset($comment) ? $comment : '' ?>"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="interview" class="control-label ">Interviewed By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="interview" placeholder="INTERVIEWED BY" readonly name="interview" value="<?php echo isset($interview) ? $interview : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="position1" class="control-label " style="display: block; text-align: center;">Position:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="position1" placeholder="POSITION" readonly name="position1" value="<?php echo isset($position1) ? $position1 : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="date1" class="control-label " style="display: block; text-align: center;">Date:</label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date1" readonly name="date1" value="date1">
                            </div>
                        </div>
                        <div class="card-header text-center">

                        </div><br>
                        <p class="h5"><b>III - Final Interview</b></I>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">a. APPEARANCE</label>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating5" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating5" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating5) ? $rating5 : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">c. JOB KNOWLEDGE</label>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating7" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating7" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating7) ? $rating7 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">b. COMMUNICATION SKILLS</label>
                            </div>
                            <div class="form-group form-inline  col-sm-2">
                                <label for="rating6" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating6" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating6) ? $rating6 : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="rating" class="control-label ">d. PERSONALITY</label>
                            </div>
                            <div class="form-group form-inline col-sm-2">
                                <label for="rating8" class="control-label " style="display: block; text-align: center;">RATING:</label>
                                <input type="number" class="form-control form-control-sm rounded-0" readonly name="rating8" placeholder="RATINGS" min="1" max="10" value="<?php echo isset($rating8) ? $rating8 : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="comment1" class="control-label ">COMMENTS</label>
                                <textarea rows="2" class="form-control" readonly name="comment1" placeholder="COMMENTS" value="<?php echo isset($comment1) ? $comment1 : '' ?>" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="interview1" class="control-label ">Interviewed By:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" placeholder="INTERVIEWED BY" id="interview1" readonly name="interview1" value="<?php echo isset($interview1) ? $interview1 : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="position2" class="control-label " style="display: block; text-align: center;">Position:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="position2" placeholder="POSITION" readonly name="position2" value="<?php echo isset($position2) ? $position2 : '' ?>">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="date2" class="control-label " style="display: block; text-align: center;">Date:</label>
                                <input type="date" style="display: block; text-align: center;" class="form-control form-control-sm rounded-0" id="date2" readonly name="date2" value="date2">
                            </div>
                        </div>
                        <p><b>If applicant is qualified, do you consider him/her :</b></p>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" type="radio" id="customRadio5" disabled name="choice" <?php if ((isset($choice) ? $choice : '')  == 1) { ?> checked <?php } ?> value="1">
                                    <label for="customRadio5" class="control-label" style="display: block; text-align: center;">First Choice</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" type="radio" id="customRadio4" disabled name="choice" <?php if ((isset($choice) ? $choice : '') == 2) { ?> checked <?php } ?>value="2">
                                    <label for="customRadio4" class="control-label" style="display: block; text-align: center;">Second Choice</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" type="radio" id="customRadio3" disabled name="choice" <?php if ((isset($choice) ? $choice : '') == 3) { ?> checked <?php } ?>value="3">
                                    <label for="customRadio3" class="control-label" style="display: block; text-align: center;">Third Choice</label>
                                </div>
                            </div>


                        </div>
                        <div class="card-header text-center">
                        </div><br>
                        <i>To be filled-up by Human Resource Department</i><br>
                        <br>
                        <div class="row">
                            <div class="form-group form-inline col-sm-4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="commencement" class="control-label " style="display: block; text-align: center;">Date Commencement :</label>
                                <input type="date" class="form-control  form-control-sm rounded-0" placeholder="DATE COMMENCEMENT" id="commencement" readonly name="commencement" value="commencement">
                            </div>
                            <div class="form-group form-inline col-sm-4">
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="noted" class="control-label form-inline " style="display: block; text-align: center;">Noted By:</label>
                                <input type="text" class="form-control  form-control-sm rounded-0" id="noted" placeholder="NOTED BY" readonly name="noted" value="<?php echo isset($noted) ? $noted : '' ?>">
                                <I style="display: block; text-align: center;">HR Dept.</I>
                            </div>
                            <div class="form-group col-sm-4">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label for="approve" class="control-label form-inline " style="display: block; text-align: center;">Approved By:</label>
                                <input type="text" class="form-control  form-control-sm rounded-0" id="approve" readonly name="approve" placeholder="APPROVED BY" value="<?php echo isset($approve) ? $approve : '' ?>">
                                <I style="display: block; text-align: center;">Department Section Head / Manager</I>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card-footer text-center">
    <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Return</a>
</div>
</div>
<script>
    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })

        $('#client-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Users.php?f=assess_client",
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
                        alert_toast("Application Successful", 'success')
                        setTimeout(function() {
                            location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
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
</script>