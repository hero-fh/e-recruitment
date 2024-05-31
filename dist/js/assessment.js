    //arrow for accordion
    var accordion = document.querySelector('.toggle.accordion');
    accordion.addEventListener('click', function() {
        accordion.classList.toggle('open');
        var addressHolder = document.querySelector('.form-group.address-holder');
        addressHolder.classList.toggle('open');
    });
    var accordion1 = document.querySelector('.toggle1.accordion');

    accordion1.addEventListener('click', function() {
        accordion1.classList.toggle('open');
        var addressHolder1 = document.querySelector('.form-group.address-holder1');
        addressHolder1.classList.toggle('open');
    });
    var accordion2 = document.querySelector('.toggle2.accordion');

    accordion2.addEventListener('click', function() {
        accordion2.classList.toggle('open');
        var addressHolder2 = document.querySelector('.form-group.address-holder2');
        addressHolder2.classList.toggle('open');
    });
    // hide the I-Qualifying exam, II-Preliminary Interview, III -Final Interview
    $(".address-holder1").hide();
    $(".address-holder2").hide();
    $(".address-holder").hide();
    $("input[name='rating']").prop('disabled', true);
    $("input[name='a_remarks']").prop('disabled', true);
    $("input[name='conducted_by']").prop('disabled', true);
    $("input[name='rating1']").prop('disabled', true);
    $("input[name='rating2']").prop('disabled', true);
    $("input[name='rating3']").prop('disabled', true);
    $("input[name='rating4']").prop('disabled', true);
    $("input[name='comment']").prop('disabled', true);
    $("input[name='interview']").prop('disabled', true);
    $("input[name='date1']").prop('disabled', true);
    $("input[name='position1']").prop('disabled', true);
    $("input[name='rating5']").prop('disabled', true);
    $("input[name='rating6']").prop('disabled', true);
    $("input[name='rating7']").prop('disabled', true);
    $("input[name='rating8']").prop('disabled', true);
    $("input[name='comment1']").prop('disabled', true);
    $("input[name='interview1']").prop('disabled', true);
    $("input[name='date2']").prop('disabled', true);
    $("input[name='position2']").prop('disabled', true);
    $("input[name='choice']").prop('disabled', true);

    $("select[name='rating']").removeAttr('required')
    $("select[name='a_remarks']").removeAttr('required')
    $("select[name='conducted_by']").removeAttr('required')

    $("select[name='rating1']").removeAttr('required')
    $("select[name='rating2']").removeAttr('required')
    $("select[name='rating3']").removeAttr('required')
    $("select[name='rating4']").removeAttr('required')
    // $("select[name='comment']").removeAttr('required')
    $("select[name='interview']").removeAttr('required')
    $("select[name='date1']").removeAttr('required')
    $("select[name='position1']").removeAttr('required')

    $("select[name='rating5']").removeAttr('required')
    $("select[name='rating6']").removeAttr('required')
    $("select[name='rating7']").removeAttr('required')
    $("select[name='rating8']").removeAttr('required')
    // $("select[name='comment1']").removeAttr('required')
    $("select[name='interview1']").removeAttr('required')
    $("select[name='date2']").removeAttr('required')
    $("select[name='position2']").removeAttr('required')
    $("select[name='choice']").removeAttr('required')

    $('.toggle').click(function() {
        // document.getElementById("change").value
        // this.value = 1;

        if (this.value == 2) {
            $(".address-holder").slideToggle("slow");
            this.value = 1;
            console.log('isChecked: ' + this.value);
            $("input[name='rating']").prop('disabled', true);
            $("input[name='a_remarks']").prop('disabled', true);
            $("input[name='conducted_by']").prop('disabled', true);
            $("select[name='rating']").removeAttr('required')
            $("select[name='a_remarks']").removeAttr('required')
            $("select[name='conducted_by']").removeAttr('required')
        } else {
            $(".address-holder").slideToggle("slow");
            this.value = 2;
            console.log('isChecked: ' + this.value);
            $("input[name='rating']").prop('disabled', false);
            $("input[name='a_remarks']").prop('disabled', false);
            $("input[name='conducted_by']").prop('disabled', false);
            $("select[name='rating']").attr('required', true)
            $("select[name='a_remarks']").attr('required', true)
            $("select[name='conducted_by']").attr('required', true)
        }
    });
    $('.toggle1').click(function() {
        if (this.value == 4) {
            $(".address-holder1").slideToggle("slow");
            this.value = 3;
            console.log('isChecked: ' + this.value);
            $("input[name='rating1']").prop('disabled', true);
            $("input[name='rating2']").prop('disabled', true);
            $("input[name='rating3']").prop('disabled', true);
            $("input[name='rating4']").prop('disabled', true);
            $("input[name='comment']").prop('disabled', true);
            $("input[name='interview']").prop('disabled', true);
            $("input[name='date1']").prop('disabled', true);
            $("input[name='position1']").prop('disabled', true);
            $("select[name='rating1']").removeAttr('required')
            $("select[name='rating2']").removeAttr('required')
            $("select[name='rating3']").removeAttr('required')
            $("select[name='rating4']").removeAttr('required')
            $("select[name='comment']").removeAttr('required')
            $("select[name='interview']").removeAttr('required')
            $("select[name='date1']").removeAttr('required')
            $("select[name='position1']").removeAttr('required')
        } else {
            $(".address-holder1").slideToggle("slow");
            this.value = 4;
            console.log('isChecked: ' + this.value);
            $("input[name='rating1']").prop('disabled', false);
            $("input[name='rating2']").prop('disabled', false);
            $("input[name='rating3']").prop('disabled', false);
            $("input[name='rating4']").prop('disabled', false);
            $("input[name='comment']").prop('disabled', false);
            $("input[name='interview']").prop('disabled', false);
            $("input[name='date1']").prop('disabled', false);
            $("input[name='position1']").prop('disabled', false);
            $("select[name='rating1']").attr('required', true)
            $("select[name='rating2']").attr('required', true)
            $("select[name='rating3']").attr('required', true)
            $("select[name='rating4']").attr('required', true)
            $("select[name='comment']").attr('required', true)
            $("select[name='interview']").attr('required', true)
            $("select[name='date1']").attr('required', true)
            $("select[name='position1']").attr('required', true)

        }
    });
    $('.toggle2').click(function() {
        if (this.value == 6) {
            $(".address-holder2").slideToggle("slow");
            this.value = 5;
            console.log('isChecked: ' + this.value);
            $("input[name='rating5']").prop('disabled', true);
            $("input[name='rating6']").prop('disabled', true);
            $("input[name='rating7']").prop('disabled', true);
            $("input[name='rating8']").prop('disabled', true);
            $("input[name='comment1']").prop('disabled', true);
            $("input[name='interview1']").prop('disabled', true);
            $("input[name='date2']").prop('disabled', true);
            $("input[name='position2']").prop('disabled', true);
            $("input[name='choice']").prop('disabled', true);
            $("select[name='rating5']").removeAttr('required')
            $("select[name='rating6']").removeAttr('required')
            $("select[name='rating7']").removeAttr('required')
            $("select[name='rating8']").removeAttr('required')
            $("select[name='comment1']").removeAttr('required')
            $("select[name='interview1']").removeAttr('required')
            $("select[name='date2']").removeAttr('required')
            $("select[name='position2']").removeAttr('required')
            $("select[name='choice']").removeAttr('required')
        } else {
            $(".address-holder2").slideToggle("slow");
            this.value = 6;
            console.log('isChecked: ' + this.value);
            $("input[name='rating5']").prop('disabled', false);
            $("input[name='rating6']").prop('disabled', false);
            $("input[name='rating7']").prop('disabled', false);
            $("input[name='rating8']").prop('disabled', false);
            $("input[name='comment1']").prop('disabled', false);
            $("input[name='interview1']").prop('disabled', false);
            $("input[name='date2']").prop('disabled', false);
            $("input[name='position2']").prop('disabled', false);
            $("input[name='choice']").prop('disabled', false);
            $("select[name='rating5']").attr('required', true)
            $("select[name='rating6']").attr('required', true)
            $("select[name='rating7']").attr('required', true)
            $("select[name='rating8']").attr('required', true)
            $("select[name='comment1']").attr('required', true)
            $("select[name='interview1']").attr('required', true)
            $("select[name='date2']").attr('required', true)
            $("select[name='position2']").attr('required', true)
            $("select[name='choice']").attr('required', true)
        }
    });
    $(function() {
        $('.select2').select2({
            width: 'resolve'
        })
        $('#client-form1').submit(function(e) {
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
