<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM applicants where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: scale-down;
        object-position: center center;
        border-radius: 100% 100%;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 0;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><?php echo isset($id) ? "Upload Applicant's Requirement" : 'Add New Applicant' ?></h5>
    </div>
    <div class="requirement1">
        <!-- <div class="card-body">
            <div class="container-fluid">
                <form action="" id="client-form" enctype="multipart/form-data">
                    <input type="hidden" name="applicant_id" value="<?php echo isset($id) ? $id : 'N/A' ?>">
                    <div class="col-md-12">
                        <fieldset class="border-bottom border-info">
                            <legend class="">Upload Requirement</legend>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" accept=".pdf" onchange="displayImg(this,$(this))">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Upload</button>
            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Cancel</a>
        </div>
    </div>
</div>
<div class="requirement"> -->
        <div class="card-body">
            <div class="container-fluid">

                <table class="table">
                    <colgroup>
                        <col width="10%">
                        <col width="20%">
                        <col width="50%">
                        <col width="20%">

                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Uploaded</th>
                            <th>File Name</th>
                            <th class="text-center">Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $act = $conn->query("SELECT * FROM users where id = " . $_settings->userdata('id'));
                        while ($ive = $act->fetch_assoc()) :
                            $i = 1;
                            $qry = $conn->query("SELECT *  from `requirements` where applicant_id = '{$_GET['id']}'");
                            while ($row = $qry->fetch_assoc()) :
                        ?>
                                <tr>
                                    <td class="text-left"><?php echo $i++; ?></td>
                                    <td class="text-left"><?php echo date("m-d-Y", strtotime($row['date_passed'])) ?></td>
                                    <td><?php echo ucwords($row['file_name']) ?></td>

                                    <td class="text-right py-0 text-center">
                                        <div class="btn-group btn-group-sm img-item">
                                            <a href="javascript:void(0)" style="display: block; text-align: center;" class="btn btn-info view_req" data-id="<?php echo $row['id'] ?>"><span class="fas fa-eye"></span></a>
                                            <a class="btn btn-danger delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash"></span></a>

                                        </div>
                                    </td>


                                </tr>
                            <?php endwhile; ?>
                        <?php endwhile; ?>

                    </tbody>
                </table>
                <form action="" id="client-form" enctype="multipart/form-data">
                    <input type="hidden" name="applicant_id" value="<?php echo isset($id) ? $id : 'N/A' ?>">
                    <div class="col-md-12">
                        <fieldset class="border-bottom border-info">
                            <legend class="">Upload Requirement</legend>
                            <div class="row">

                                <!-- for passing requirement -->
                                <div class="form-group col-sm-12">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" accept=".pdf" onchange="displayImg(this,$(this))">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Upload</button>
            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url . "admin?page=applicants/view_client&id=" . $id ?>">Cancel</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.view_req').click(function() {
                uni_modal('', "uploads/index.php?id=" + $(this).attr('data-id'), 'large')
            })
            $('.delete_data').click(function() {
                _conf("Are you sure to delete this File permanently?", "delete_product", [$(this).attr('data-id')])
            })
        })
        // $(document).ready(function() {
        //     $('#customFile').on('change', function() {
        //         var file = this.files[0];
        //         var maxSize = 10 * 1024 * 1024; // 10MB
        //         // var maxSize = 1; // 10MB

        //         if (file.size > maxSize) {
        //             alert("File size exceeds the limit. Please upload a file size less than 10MB.");
        //             // Clear the file input if desired
        //             $('#customFile').val('');
        //         }
        //     });
        // });

        function delete_product($id) {
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=delete_file",
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
        // responsible for displaying the chosen file to upload
        function displayImg(input, _this) {
            console.log(input.files)
            var fnames = []
            Object.keys(input.files).map(k => {
                fnames.push(input.files[k].name)
            })
            _this.siblings('.custom-file-label').html(JSON.stringify(fnames))

        }
        //condition for accepting specific type of files
        $("#file").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
            if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        });
        $(function() {
            $('.select2').select2({
                width: 'resolve'
            })
            // client form fucntion
            $('#client-form').submit(function(e) {
                e.preventDefault();
                var _this = $(this)
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=upload",
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
                            alert_toast("Requirements successfully uploaded", 'success')
                            setTimeout(function() {
                                // location.href = _base_url_ + "admin?page=applicants/view_client&id=" + resp.id;
                                location.reload()
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