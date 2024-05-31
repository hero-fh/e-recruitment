
  // Retrieve the value of the input field from localStorage
  var inputFieldValue = JSON.parse(localStorage.getItem('input-field-values'));

  
    // document.getElementById('firstname').value = inputFieldValue[0];
    // document.getElementById('middlename').value = inputFieldValue[1];
    // document.getElementById('surname').value = inputFieldValue[2];
    // document.getElementById('nickname').value = inputFieldValue[3];
    // document.getElementById('birthdate').value = inputFieldValue[4];
    // document.getElementById('age').value = inputFieldValue[5];
    // document.getElementById('mobile_number').value = inputFieldValue[6];
    // document.getElementById('permanent_address').value = inputFieldValue[7];
    // document.getElementById('current_address').value = inputFieldValue[8];
    // document.getElementById('gender').value = inputFieldValue[9];
    // document.getElementById('height').value = inputFieldValue[10];
    // document.getElementById('weight').value = inputFieldValue[11];
    // document.getElementById('religion').value = inputFieldValue[12];
    // document.getElementById('dialect_spoken').value = inputFieldValue[13];
    // document.getElementById('ambition').value = inputFieldValue[14];
    // document.getElementById('hobbies').value = inputFieldValue[15];
    // document.getElementById('talent').value = inputFieldValue[16];
    // document.getElementById('email').value = inputFieldValue[17];
    // document.getElementById('license').value = inputFieldValue[18];
    // document.getElementById('philhealth').value = inputFieldValue[19];
    // document.getElementById('tin').value = inputFieldValue[20];
    // document.getElementById('sss').value = inputFieldValue[21];
    // document.getElementById('sssloan').value = inputFieldValue[22];
    // document.getElementById('pagibig').value = inputFieldValue[23];
    // document.getElementById('pagibigloan').value = inputFieldValue[24];
    // document.getElementById('civil_status').value = inputFieldValue[25];
    // document.getElementById('children').value = inputFieldValue[26];
    // document.getElementById('caretaker').value = inputFieldValue[27];
    // document.getElementById('spouse').value = inputFieldValue[28];
    // document.getElementById('occupation1').value = inputFieldValue[29];
    // document.getElementById('age1').value = inputFieldValue[30];
    // document.getElementById('father').value = inputFieldValue[31];
    // document.getElementById('occupation2').value = inputFieldValue[32];
    // document.getElementById('age2').value = inputFieldValue[33];
    // document.getElementById('mother').value = inputFieldValue[34];
    // document.getElementById('occupation3').value = inputFieldValue[35];
    // document.getElementById('age3').value = inputFieldValue[36];
    // document.getElementById('sibling_name').value = inputFieldValue[37];
    // document.getElementById('occupation4').value = inputFieldValue[38];
    // document.getElementById('age4').value = inputFieldValue[39];
    // document.getElementById('sibling2').value = inputFieldValue[40];
    // document.getElementById('occupation5').value = inputFieldValue[41];
    // document.getElementById('age5').value = inputFieldValue[42];
    // document.getElementById('contact_person').value = inputFieldValue[43];
    // document.getElementById('contact_person_number').value = inputFieldValue[44];
    // document.getElementById('relationship').value = inputFieldValue[45];
    // document.getElementById('relative').value = inputFieldValue[46];
    // document.getElementById('resume').value = inputFieldValue[47];
    // document.getElementById('goals').value = inputFieldValue[48];
    // document.getElementById('problem').value = inputFieldValue[49];
    // document.getElementById('solution').value = inputFieldValue[50];
    // document.getElementById('medical').value = inputFieldValue[51];
    // document.getElementById('shifting_schedule').value = inputFieldValue[52];
    // document.getElementById('education').value = inputFieldValue[53];
    // document.getElementById('course').value = inputFieldValue[54];
    // document.getElementById('award').value = inputFieldValue[55];
    // document.getElementById('computer_literate').value = inputFieldValue[56];
    // document.getElementById('tor').value = inputFieldValue[57];
    // document.getElementById('shs_diploma').value = inputFieldValue[58];
    // document.getElementById('hs_diploma').value = inputFieldValue[59];
    // document.getElementById('form137').value = inputFieldValue[60];
    // document.getElementById('position').value = inputFieldValue[61];
    // document.getElementById('company').value = inputFieldValue[62];
    // document.getElementById('duration').value = inputFieldValue[63];
    // document.getElementById('reason').value = inputFieldValue[64];
    // document.getElementById('last_contact_person').value = inputFieldValue[65];
    // document.getElementById('gap').value = inputFieldValue[66];
    // document.getElementById('fb').value = inputFieldValue[67];
    // document.getElementById('attendance').value = inputFieldValue[68];
    // document.getElementById('vaccine').value = inputFieldValue[69];
    // document.getElementById('firstdose').value = inputFieldValue[70];
    // document.getElementById('seconddose').value = inputFieldValue[71];
    // document.getElementById('lgu').value = inputFieldValue[72];
    // document.getElementById('remarks').value = inputFieldValue[73];
    // document.getElementById('pending_application').value = inputFieldValue[74];
    // document.getElementById('expected_salary').value = inputFieldValue[75];
    // document.getElementById('barangay').value = inputFieldValue[76];
    // document.getElementById('city').value = inputFieldValue[77];
    // document.getElementById('province').value = inputFieldValue[78];
    // document.getElementById('zip').value = inputFieldValue[79];
    // document.getElementById('booster').value = inputFieldValue[80];
    // document.getElementById('dose').value = inputFieldValue[81];
    // document.getElementById('lgu1').value = inputFieldValue[82];
    
    // document.getElementById('position1').value = inputFieldValue[83];
    // document.getElementById('company1').value = inputFieldValue[84];
    // document.getElementById('duration1').value = inputFieldValue[85];
    // document.getElementById('reason1').value = inputFieldValue[86];
    // document.getElementById('last_contact_person1').value = inputFieldValue[87];
    // document.getElementById('application').value = inputFieldValue[83];
  

  // Store the value of the input field in localStorage when the input changes
  document.querySelectorAll('input').forEach(function(input) {
    input.addEventListener('input', function(event) {
      var inputFieldValue = [
        // document.getElementById('firstname').value,
        // document.getElementById('middlename').value,
        // document.getElementById('surname').value,
        // document.getElementById('nickname').value,
        // document.getElementById('birthdate').value,
        // document.getElementById('age').value,
        // document.getElementById('mobile_number').value,
        // document.getElementById('permanent_address').value,
        // document.getElementById('current_address').value,
        // document.getElementById('gender').value,
        // document.getElementById('height').value,
        // document.getElementById('weight').value,
        // document.getElementById('religion').value,
        // document.getElementById('dialect_spoken').value,
        // document.getElementById('ambition').value,
        // document.getElementById('hobbies').value,
        // document.getElementById('talent').value,
        // document.getElementById('email').value,
        // document.getElementById('license').value,
        // document.getElementById('philhealth').value,
        // document.getElementById('tin').value,
        // document.getElementById('sss').value,
        // document.getElementById('sssloan').value,
        // document.getElementById('pagibig').value,
        // document.getElementById('pagibigloan').value,
        // document.getElementById('civil_status').value,
        // document.getElementById('children').value,
        // document.getElementById('caretaker').value,
        // document.getElementById('spouse').value,
        // document.getElementById('occupation1').value,
        // document.getElementById('age1').value,
        // document.getElementById('father').value,
        // document.getElementById('occupation2').value,
        // document.getElementById('age2').value,
        // document.getElementById('mother').value,
        // document.getElementById('occupation3').value,
        // document.getElementById('age3').value,
        // document.getElementById('sibling_name').value,
        // document.getElementById('occupation4').value,
        // document.getElementById('age4').value,
        // document.getElementById('sibling2').value,
        // document.getElementById('occupation5').value,
        // document.getElementById('age5').value,
        // document.getElementById('contact_person').value,
        // document.getElementById('contact_person_number').value,
        // document.getElementById('relationship').value,
        // document.getElementById('relative').value,
        // document.getElementById('resume').value,
        // document.getElementById('goals').value,
        // document.getElementById('problem').value,
        // document.getElementById('solution').value,
        // document.getElementById('medical').value,
        // document.getElementById('shifting_schedule').value,
        // document.getElementById('education').value,
        // document.getElementById('course').value,
        // document.getElementById('award').value,
        // document.getElementById('computer_literate').value,
        // document.getElementById('tor').value,
        // document.getElementById('shs_diploma').value,
        // document.getElementById('hs_diploma').value,
        // document.getElementById('form137').value,
        // document.getElementById('position').value,
        // document.getElementById('company').value,
        // document.getElementById('duration').value,
        // document.getElementById('reason').value,
        // document.getElementById('last_contact_person').value,
        // document.getElementById('gap').value,
        // document.getElementById('fb').value,
        // document.getElementById('attendance').value,
        // document.getElementById('vaccine').value,
        // document.getElementById('firstdose').value,
        // document.getElementById('seconddose').value,
        // document.getElementById('lgu').value,
        // document.getElementById('remarks').value,
        // document.getElementById('pending_application').value,
        // document.getElementById('expected_salary').value,
        // document.getElementById('barangay').value,
        // document.getElementById('city').value,
        // document.getElementById('province').value,
        // document.getElementById('zip').value,
        // document.getElementById('booster').value,
        // document.getElementById('dose').value,
        // document.getElementById('lgu1').value,
        // document.getElementById('position1').value,
        // document.getElementById('company1').value,
        // document.getElementById('duration1').value,
        // document.getElementById('reason1').value,
        // document.getElementById('last_contact_person1').value
        // document.getElementById('application').value
      ];
      localStorage.setItem('input-field-values', JSON.stringify(inputFieldValue));
    });

  });
  // var dropdown = document.getElementById("app");

  // // Add event listener to listen for changes in the dropdown selection
  // dropdown.addEventListener("change", function() {
  //     // Get the selected value
  //     var selectedValue = dropdown.value;
  //     console.log(selectedValue)
  //     // Store the selected value in localStorage
  //     localStorage.setItem("savedValue", selectedValue);
  // });
 
  $(function() {
    $(document).trigger('scroll')
    // end_loader();
    //registration function
    $('#registration').submit(function(e) {
      // Remove the stored data from localStorage upon form submission
      console.log($('#age').val())
      if($('#age').val() < 18){
        alert_toast(" Must be 18 and above", 'warning')
        return false;
      }
      e.preventDefault();
      timerActive = false;

      start_loader()
      if ($('.err-msg').length > 0)
        $('.err-msg').remove();
      $.ajax({
        url: _base_url_ + "classes/Users.php?f=save_client",
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
            localStorage.removeItem('input-field-values');
            localStorage.removeItem('savedValue');
            var userId = resp.application;
            alert_toast("Account registration Successful", 'success')
            setTimeout(function() {
              if (userId != 1) {
                location.replace('./?p=take_exam&id=1f0e3dad99908345f7439f8ffabdffc4');
              } else if (userId == 1) {
                location.replace('./?p=take_exam&id=8e296a067a37563370ded05f5a3bf3ec');

              }
              console.log(userId, 'tab')
            }, 2000)
          } else if (resp.status == 'failed' && !!resp.msg) {
            var _err_el = $('<div>')
            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
            alert_toast(resp.msg, 'error')
            end_loader()

          } else {
            console.log(resp)
            // alert_toast("an error occured", 'error')
            alert_toast(resp.msg, 'error')
            end_loader()
          }
        }
      })
    })
  })
