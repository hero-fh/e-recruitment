$(function() {
    $(".hidden").hide();
    // Attach event listeners to all the divs
    var divs = document.querySelectorAll('.toggle-accordion');
    divs.forEach(function(div) {
        div.addEventListener('click', handleClick);
    });

    // Check if any input field with the 'required' attribute is present
    var inputs = document.querySelectorAll('input[required]');
    // Event handler function
    function handleClick(event) {
        // Get the toggle ID from the data attribute of the clicked div
        var toggleId = event.target.getAttribute('data-toggle-id');
        console.log(toggleId);

        // Get the specific div by its ID
        var specificDiv = document.getElementById('toggle-' + toggleId);
        $(".address-holder" + toggleId).slideToggle("slow");
        var addressHolder = document.querySelector('.address-holder' + toggleId);
        var hiddenDiv = document.querySelector('.address-holder' + toggleId);
        var requiredRadios = hiddenDiv.querySelectorAll('input[type="radio"][required]');
        var isAnyRadioSelected = Array.from(requiredRadios).some(function(radio) {
            return radio.checked;
        });

        var submitButton = document.getElementById('submit-button');
        submitButton.addEventListener('click', function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Show the accordion if any required radio is selected
            if (isAnyRadioSelected == false) {
                var specificAddressHolder = document.querySelector('.card-body.address-holder' + toggleId);
                if (specificAddressHolder) {
                    var className = specificAddressHolder.classList.item(1);
                }
                $(specificAddressHolder).show("slow");
                // }
                specificDiv.classList.add('show');
                $('#take-exam').submit();
            } else {

                $('#take-exam').submit();
            }
            console.log(isAnyRadioSelected);
        });

    }
    // Get all checkboxes within the specified container
    const checkboxes = document.querySelectorAll('.custom-control-input');

    // Attach an event listener to each checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Get the question ID from the checkbox's name attribute
            const questionId = this.name.split('[')[1].split(']')[0];
            console.log(questionId)
            // Count the number of checked checkboxes for the current question ID
            const numChecked = document.querySelectorAll(`input[name="answer[${questionId}][]"]:checked`).length;

            // If more than two checkboxes are checked for the current question, uncheck the current one
            if (numChecked > 2) {
                this.checked = false;
            }
            let min = 159;
            let max = 170;
            if ((questionId >= min && questionId <= max) || (questionId >= 417 && questionId <= 428)) {
                console.log('IN')
                if (numChecked == 1 || numChecked == 2 || numChecked == 3) {
                    $(`input[name="answer[${questionId}][]"]`).removeAttr('required');
                } else if (numChecked != 1) {
                    $(`input[name="answer[${questionId}][]"]`).attr('required', true)
                }
            } else {
                console.log('OUT')

                if (numChecked == 2 || numChecked == 3) {
                    $(`input[name="answer[${questionId}][]"]`).removeAttr('required');
                } else if (numChecked != 2) {
                    $(`input[name="answer[${questionId}][]"]`).attr('required', true)
                }
            }
            console.log(numChecked)
        });
    });
    // Retrieve the values of the radio inputs from localStorage
    var radioInputValues = JSON.parse(localStorage.getItem('radio-input-values'));

    // If the values are not null, set the corresponding radio inputs as checked
    if (radioInputValues !== null) {
        for (var key in radioInputValues) {
            var inputId = "option_" + radioInputValues[key];
            document.getElementById(inputId).checked = true;
        }
    }

    // Store the values of the radio inputs in localStorage when a radio input is clicked
    document.querySelectorAll('input[type="radio"]').forEach(function(input) {
        input.addEventListener('click', function(event) {
            var radioInputValues = {};
            document.querySelectorAll('input[type="radio"]').forEach(function(input) {
                if (input.checked) {
                    var questionId = input.getAttribute('name').replace("answer[", "").replace("]", "");
                    radioInputValues[questionId] = input.value;
                }
            });
            localStorage.setItem('radio-input-values', JSON.stringify(radioInputValues));
        });
    });

    var checkInputValues = JSON.parse(localStorage.getItem('check-input-values'));

    // If the values are not null, set the corresponding checkbox inputs as checked
    if (checkInputValues !== null) {
        for (var questionId in checkInputValues) {
            var inputIds = checkInputValues[questionId];
            for (var i = 0; i < inputIds.length; i++) {
                var inputId = "option_" + inputIds[i];
                document.getElementById(inputId).checked = true;
            }
        }
    }

    // Store the values of the checkbox inputs in localStorage when a checkbox input is clicked
    document.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
        input.addEventListener('click', function(event) {
            var checkInputValues = {};
            document.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
                if (input.checked) {
                    var questionId = input.getAttribute('name').replace("answer[", "").replace("]", "");
                    if (!checkInputValues.hasOwnProperty(questionId)) {
                        checkInputValues[questionId] = [];
                    }
                    checkInputValues[questionId].push(input.value);
                }
            });
            localStorage.setItem('check-input-values', JSON.stringify(checkInputValues));
        });
    });
    console.log(checkInputValues)
    if (checkInputValues !== null) {
        for (var questionId in checkInputValues) {
            var inputIds = checkInputValues[questionId];
            for (var i = 0; i < inputIds.length; i++) {
                var inputId = "option_" + inputIds[i];
                document.getElementById(inputId).checked = true;
                const questionIds = questionId.split('[')[0];
                console.log(inputIds.length)
                if ((questionIds >= 159 && questionIds <= 170) || (questionIds >= 417 && questionIds <= 428)) {
                    $(`input[name="answer[${questionIds}][]"]`).removeAttr('required');
                } else {
                    if (inputIds.length > 1) {
                        $(`input[name="answer[${questionIds}][]"]`).removeAttr('required');
                    }
                }
            }
        }
    }

    $('#take-exam').submit(function(e) {
        localStorage.removeItem('radio-input-values');
        localStorage.removeItem('check-input-values');
        e.preventDefault();
        var _this = $(this);
        if (_this[0].checkValidity() == false) {
            _this[0].reportValidity();
            // alert()
            return false;
        }
        $('.err-msg').remove();
        var el = $('<div>')
        el.addClass("alert err-msg")
        el.hide()
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=calculate_score",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                // Display an error message if the Ajax request fails.
                console.error(err)
                el.addClass('alert-danger').text("An error occured");
                _this.prepend(el)
                el.show('.modal')
                end_loader();
            },
            success: function(resp) {
                // Check the response from the classes/Master.php file.
                // If the response is a success, redirect the user to the view_score page.
                // If the response is a failure, display an error message to the user.
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = "./?p=view_score&id=<?= md5(isset($id)) ? md5($id) : '' ?>";
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