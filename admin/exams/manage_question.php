<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `question_list` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
?>
        <center>Question has been deleted.</center>
        <style>
            #uni_modal {
                display: none
            }
        </style>
        <div class="text-right">
            <button class="btn btn-gradient-dark btn-flat"><i class="fa fa-times"></i> Close</button>
        </div>
<?php
        exit;
    }
}

?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<div class="container-fluid">
    <form action="" id="question-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="exam_id" value="<?= isset($_GET['eid']) ? $_GET['eid'] : '' ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="points" class="control-label">Points</label>
                    <input type="number" class="form-control form-control-sm rounded-0" name="points" id="points" min="1" value="<?= isset($points) ? $points : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="question" class="control-label">Question</label>
                    <textarea name="question" id="question" class="form-control form-control-sm rounded-0" required><?= isset($question) ? html_entity_decode($question) : "" ?></textarea>
                </div>

            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend class="h5 text-dark">Options</legend>
                    <div class="list-group" id="option-list">
                        <?php
                        if (isset($id)) :
                            $options = $conn->query("SELECT * FROM `option_list` where question_id = '{$id}'");
                            while ($row = $options->fetch_assoc()) :
                        ?>
                                <div class="list-group-item item">
                                    <div class="form-group">
                                        <input type="hidden" class="id" name="opt_id[]" value="<?= $row['id'] ?>">
                                        <textarea name="option[]" rows="3" class="form-control form-control-sm rounded-0 option" required><?= html_entity_decode($row['option']) ?></textarea>
                                    </div>
                                    <div class="row justify-content-between align-items-end form-group">
                                        <div class="col-auto custom-control custom-checkbox">
                                            <input tabindex="-1" class="custom-control-input custom-control-input-success custom-control-input-outline is_right" type="checkbox" name="is_right[]" value='1' <?= ($row['is_right'] == 1) ? 'checked' : '' ?>>
                                            <label for="" class="custom-control-label">Correct Answer</label>
                                        </div>
                                        <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option text-decoration-none text-reset" title="Remove Option"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="my-2 text-right">
                        <button class="btn btn-light border btn-flat btn-sm" id="add_option" type="button"><i class="fa fa-plus"></i> Add Option</button>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>
<noscript id="option-clone">
    <div class="list-group-item item">
        <div class="form-group">
            <input type="hidden" class="id" name="opt_id[]" value="">
            <textarea name="option[]" rows="3" class="form-control form-control-sm rounded-0 option" required></textarea>
        </div>
        <div class="row justify-content-between align-items-end form-group">
            <div class="col-auto custom-control custom-checkbox">
                <input tabindex="-1" class="custom-control-input custom-control-input-success custom-control-input-outline is_right" type="checkbox" name="is_right[]" value='1'>
                <label for="" class="custom-control-label">Correct Answer</label>
            </div>
            <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option text-decoration-none text-reset" title="Remove Option"><i class="fa fa-times"></i></a>
        </div>
    </div>
</noscript>
<script>
    // $(document).ready(function() {
    //     // Add Option button click event
    //     $('#add_option').click(function() {
    //         // Clone the template option and convert it into a jQuery object
    //         var item = $($('#option-clone').html()).clone();

    //         // Find the textarea inside the cloned item and initialize Summernote
    //         var optionTextarea = item.find('.option');
    //         optionTextarea.summernote({
    //             height: 100, // Set the desired height of the editor
    //             // Other options or callbacks if needed
    //         });

    //         // Append the modified item to the option list
    //         $('#option-list').append(item);

    //         // Attach event handlers to the cloned item
    //         item.find('.custom-checkbox>label').click(function() {
    //             if (!$(this).siblings('input').is(':checked'))
    //                 update_correct($(this).siblings('input'));
    //             else
    //                 $(this).siblings('input').prop('checked', false).trigger('change');
    //         });

    //         item.find('.remove-option').click(function() {
    //             $(this).closest('.item').remove();
    //         });
    //     });
    // });
    var currentUrl = window.location.href;
    var urlParams = new URLSearchParams(currentUrl);
    var idValue = urlParams.get('id');
    console.log(idValue)
    if (idValue == 43 || idValue == 36 || idValue == 35 || idValue == 46) {
        function update_correct(_this) {
            var selectedOptions = $('.is_right:checked');
            var numSelected = selectedOptions.length;

            if (numSelected >= 2) {
                // Uncheck all checkboxes if two or more are already selected
                $('.is_right').prop('checked', false).trigger('change');
            }

            // Check the selected checkbox only if less than two are selected
            if (numSelected < 2) {
                _this.prop('checked', true).trigger('change');
            }
            // }

            // function save_answers() {
            var correctOptions = $('.is_right:checked');
            var correctValues = correctOptions.map(function() {
                return $(this).closest('.item').find('.option').val();
            }).get();

            // Save the correct values in a single column and row
            var correctValuesStr = correctValues.join(','); // Comma-separated string of correct values
            var ar = [correctValuesStr];
            // Save the correct values to a single column and row in your desired data storage
            // (e.g., a database or a specific data structure)
            var data = {
                ar: ar
            };

            // Example console log to show the correct values
            console.log(ar);
        }
    } else {
        function update_correct(_this) {
            $('.is_right').each(function() {
                $(this).prop('checked', false).trigger('change')
            })
            _this.prop('checked', true).trigger('change')
        }
    }
    // function update_correct(_this) {
    //     var numCorrect = 0;

    //     $('.is_right').each(function() {
    //         if ($(this).is(':checked')) {
    //             numCorrect++;
    //         }
    //     });

    //     if (numCorrect >= 2 && !_this.is(':checked')) {
    //         _this.prop('checked', false).trigger('change');
    //     } else {
    //         _this.prop('checked', true).trigger('change');
    //     }
    // }


    $(function() {
        $('#uni_modal').on('shown.bs.modal', function() {
            $('#question').summernote({
                height: '20vh',
                placeholder: 'Write the question here',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ol', 'ul', 'paragraph', 'height']],
                    ['table', ['table']],
                    ['insert', ['pitcure', 'link', 'math']],
                    ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
                ]
            })
            $('.option').summernote({
                height: '5vh',
                placeholder: 'Write the options here',
                toolbar: []
            })
        })
        $('.custom-checkbox>label').click(function() {
            if (!$(this).siblings('input').is(':checked'))
                update_correct($(this).siblings('input'));
            else
                $(this).siblings('input').prop('checked', false).trigger('change');
        })
        $('.remove-option').click(function() {
            $(this).closest('.item').remove()
        })
        // Add Option button click event
        $('#add_option').click(function() {
            // Clone the template option and convert it into a jQuery object
            var item = $($('#option-clone').html()).clone();

            // Find the textarea inside the cloned item and initialize Summernote
            var optionTextarea = item.find('.option');
            optionTextarea.summernote({
                height: '5vh',
                placeholder: 'Write the question here',
                toolbar: [

                ]
            })

            // Append the modified item to the option list
            $('#option-list').append(item);

            // Attach event handlers to the cloned item
            item.find('.custom-checkbox>label').click(function() {
                if (!$(this).siblings('input').is(':checked'))
                    update_correct($(this).siblings('input'));
                else
                    $(this).siblings('input').prop('checked', false).trigger('change');
            });

            item.find('.remove-option').click(function() {
                $(this).closest('.item').remove();
            });
        });
        // $('#add_option').click(function() {
        //     console.log('test')
        //     var item = $($('noscript#option-clone').html()).clone()
        //     $('#option-list').append(item)
        //     item.find('.custom-checkbox>label').click(function() {
        //         if (!$(this).siblings('input').is(':checked'))
        //             update_correct($(this).siblings('input'));
        //         else
        //             $(this).siblings('input').prop('checked', false).trigger('change');
        //     })
        //     item.find('.remove-option').click(function() {
        //         $(this).closest('.item').remove()
        //     })
        // })
        $('#uni_modal #question-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            if (_this[0].checkValidity() == false) {
                _this[0].reportValidity();
                return false;
            }
            var i = 0;
            $("#option-list .item").each(function() {
                $(this).find('.id').attr("name", "opt_id[" + i + "]")
                $(this).find('.option').attr("name", "option[" + i + "]")
                $(this).find('.is_right').attr("name", "is_right[" + i + "]")
                i++;
            })
            var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_question",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.error(err)
                    el.addClass('alert-danger').text("Error, Add Option");
                    _this.prepend(el)
                    el.show('.modal')
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        el.addClass('alert-danger').text(resp.msg);
                        _this.prepend(el)
                        el.show('.modal')
                    } else {
                        el.text("An error occured");
                        console.error(resp)
                    }
                    $("html, body").scrollTop(0);
                    end_loader()

                }
            })
        })
    })
</script>