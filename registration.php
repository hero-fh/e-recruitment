<header class="bg-primary py-5" id="main-header">
  <div class="container h-100 d-flex align-items-end justify-content-center w-100">
    <div class="text-center text-white w-100">
      <h2 class="display-5 fw-bolder mx-6"><?php echo $_settings->info('name') ?></h2>
      <div class="col-auto mt-2">
        <!-- <a class="btn btn-primary btn-lg rounded-0" href="./?p=exams">Explore Exams</a> -->
      </div>
    </div>
  </div>
</header>
<style>
  #uni_modal .modal-footer {
    display: none;
  }

  .inline {
    display: inline-block;
    max-width: 100%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .input-container input {
    border: none;
    box-sizing: border-box;
    outline: 0;
    padding: .75rem;
    position: relative;
    width: 100%;
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

  input[type="month"]::-webkit-calendar-picker-indicator {
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

  .hide {
    display: none;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- <script src="dist/js/address.js"></script> -->
<!-- <script>
  start_loader()
</script> -->
<div class=" px-4 px-lg-5 mt-5">
  <div class="card card-outline card-primary">
    <div class="card-body">
      <div class="card-header text-center">
        <p class="h3"><b>Personal Informaton</b></p><small class="text-info"><i><i class="fas fa-info-circle text-info"></i>Required input field has asterisk(<b style="color:#FF0000" ;>*</b>) in it </i></small><br><small class="text-info"><i><i class="fas fa-info-circle text-info"></i>Put(<b style="color:#FF0000" ;>N/A</b>) if the required input field is not applicable </i></small>
      </div><br>
      <!-- Registration form -->
      <form action="" id="registration">
        <input autocomplete="off" type="hidden" name="id">
        <!-- Personal Information -->
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="firstname" class="control-label">First name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="firstname" required name="firstname" placeholder="Firstname">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="middlename" class="control-label">Middle name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="middlename" required name="middlename" placeholder="Middlename">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="surname" class="control-label">Surname<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="surname" required name="surname" placeholder="Surname">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="nickname" class="control-label">Nickname</label>
              <input autocomplete="off" type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname">
            </div>
          </div>
          <div class="col-md-3">
            <!-- <div class="form-group">
              <label for="birthdate" class="control-label">BIRTHDATE<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="date" max="<?php echo date("Y-m-d") ?>" id="birthdate" class="form-control" required name="birthdate">
              <small class="text-info"><i><i class="fas fa-info-circle text-info"></i> The date format depends on the computer's date format.</i></small> 
            </div>-->

            <label for="birthdate" class="control-label">Birthdate<b style="color:#FF0000" ;>*</b></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input autocomplete="off" type="date" max="<?php echo date("Y-m-d") ?>" id="birthdate" class="form-control" required name="birthdate">
            </div>

          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="age" class="control-label">Age<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" readonly type="number" class="form-control" required id="age" name="age" placeholder="Age">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="mobile_number" class="control-label">Mobile number<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control form-control form" pattern="[0-9]+" required placeholder="09xxxxxxxxx" minlength='11' maxlength="11" id="mobile_number" name="mobile_number">
            </div>
          </div>
        </div>
        <h4>Current address</h4>
        <div class="row">
          <div class="col-sm-3 mb-3">
            <label class="form-label">Region<b style="color:#FF0000" ;>*</b></label>
            <select name="region" class="form-control form-control-md" required id="region">
              <option value="">--Select Region--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md" name="region" id="region-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">Province<b style="color:#FF0000" ;>*</b></label>
            <select name="province" class="form-control form-control-md" required id="province">
              <option value="">--Choose State/Province--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md" name="province" id="province-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">City / Municipality<b style="color:#FF0000" ;>*</b></label>
            <select name="city" class="form-control form-control-md" required id="city">
              <option value="">--Select City / Minucipality--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md" name="city" id="city-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">Barangay<b style="color:#FF0000" ;>*</b></label>
            <select name="barangay" class="form-control form-control-md" required id="barangay">
              <option value="">--Select Barangay--</option>
              <input autocomplete="off" type="hidden" class="form-control form-control-md" name="barangay" id="barangay-text">
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 inline">
            <div class="form-group">
              <label for="current_address" class="control-label ">House or appartment no./street name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" required id="current_address" name="current_address" placeholder="Street/House or Appartment No. etc.">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="zip" class="control-label">Zip code<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="number" class="form-control " required id="zip" name="zip" placeholder="Zip Code">
            </div>
          </div>
        </div>
        <h4>Permanent address</h4>
        <div class="form-group clearfix">
          <div class="icheck-primary d-inline">
            <input type="checkbox" id="same">
            <label for="same" class="control-label">(Click if permanent address is same with current address)</label>
          </div>
        </div>
        <div class="row ">
          <div class="col-sm-3 mb-3">
            <label class="form-label">Region<b style="color:#FF0000" ;>*</b></label>
            <select name="perma_region" class="form-control form-control-md same_" required id="perma_region">
              <option value="">--Select Region--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md same_" name="perma_region" id="perma_region-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">Province<b style="color:#FF0000" ;>*</b></label>
            <select name="perma_province" class="form-control form-control-md same_" required id="perma_province">
              <option value="">--Choose State/Province--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md same_" name="perma_province" id="perma_province-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">City / Municipality<b style="color:#FF0000" ;>*</b></label>
            <select name="perma_city" class="form-control form-control-md same_" required id="perma_city">
              <option value="">--Select City / Minucipality--</option>
            </select>
            <input autocomplete="off" type="hidden" class="form-control form-control-md same_" name="perma_city" id="perma_city-text">
          </div>
          <div class="col-sm-3 mb-3">
            <label class="form-label">Barangay<b style="color:#FF0000" ;>*</b></label>
            <select name="perma_barangay" class="form-control form-control-md same_" required id="perma_barangay">
              <option value="">--Select Barangay--</option>
              <input autocomplete="off" type="hidden" class="form-control form-control-md same_" name="perma_barangay" id="perma_barangay-text">
            </select>
          </div>
        </div>
        <div class="row same_">
          <div class="col-md-8 inline">
            <div class="form-group">
              <label for="permanent_address" class="control-label ">House or appartment No./street name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control  same_" required id="permanent_address" name="permanent_address" placeholder="Street/House or Appartment No. etc.">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="perma_zip" class="control-label">Zip code<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="number" class="form-control  same_" required id="perma_zip" name="perma_zip" placeholder="Zip Code">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="gender" class="control-label">Gender<b style="color:#FF0000" ;>*</b></label>
              <select name="gender" id="gender" class="custom-select">
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="height" class="control-label">Height<b style="color:#FF0000" ;>*</b></label>
              <div class="input-group">
                <input autocomplete="off" type="number" class="form-control" id="height" required name="height" placeholder="Height">
                <div class="input-group-append">
                  <div class="input-group-text">cm</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="weight" class="control-label">Weight<b style="color:#FF0000" ;>*</b></label>
              <div class="input-group">
                <input autocomplete="off" type="number" class="form-control" id="weight" required name="weight" placeholder="Weight">
                <div class="input-group-append">
                  <div class="input-group-text">kg</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="religion" class="control-label">Religion</label>
              <input autocomplete="off" type="text" class="form-control" id="religion" name="religion" placeholder="Religion">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="dialect_spoken" class="control-label">Dialect spoken<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="dialect_spoken" required name="dialect_spoken" placeholder="Dialect Spoken">
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="ambition" class="control-label">AMBITION<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="ambition" required name="ambition" placeholder="Ambition">
            </div>
          </div> -->
          <div class="col-md-4">
            <div class="form-group">
              <label for="hobbies" class="control-label">Hobbies/Sports<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="hobbies" required name="hobbies" placeholder="Hobbies">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="talent" class="control-label">Talent/Skills<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="talent" required name="talent" placeholder="Talent/Skills">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email" class="control-label">Email<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="email" class="form-control" id="email" required name="email" placeholder="Email">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="fb" class="control-label">Facebook account</label>
              <input autocomplete="off" type="text" class="form-control" id="fb" placeholder="Facebook Account" name="fb">
            </div>
          </div>
        </div>
        <div class="card-header text-center"></div>
        <!-- Government Identification -->
        <div class="card-header text-center">
          <p class="h3"><b>Government ID's</b></p>
        </div> <br>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="license" class="control-label">Driver's license</label>
              <input autocomplete="off" type="text" class="form-control" id="license" name="license" placeholder="Driver's License">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="philhealth" class="control-label">Philhealth no.<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" required type="text" pattern="[0-9]+" class="form-control" minlength="12" maxlength="12" id="philhealth" name="philhealth" placeholder="Philhealth No.">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="tin" class="control-label">Tax identification number<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" required type="text" pattern="[0-9]+" class="form-control" id="tin" minlength="9" maxlength="9" name="tin" placeholder="Tax Identification Number">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="sss" class="control-label">SSS no.<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" minlength="10" maxlength="10" required type="text" pattern="[0-9]+" class="form-control" id="sss" placeholder="SSS No." name="sss">
            </div>
          </div>
          <div class="col-md-3 inline">
            <div class="form-group">
              <label for="sssloan" class="control-label" style="display: block; text-align: center;">With existing loan</label>
              <input autocomplete="off" type="checkbox" name="sssloan" id="sssloan" class="form-control" value="1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="pagibig" class="control-label">Pag-ibig no.<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" required minlength="12" maxlength="12" type="text" pattern="[0-9]+" class="form-control" id="pagibig" placeholder="PAG-IBIG No." name="pagibig">
            </div>
          </div>
          <div class="col-md-3 inline">
            <div class="form-group">
              <label for="pagibigloan" class="control-label" style="display: block; text-align: center;">With existing loan</label>
              <input autocomplete="off" type="checkbox" name="pagibigloan" id="pagibigloan" class="form-control" value="1">
            </div>
          </div>
        </div>

        <div class="card-header text-center"></div>
        <!-- Civil Information -->
        <div class="card-header text-center">
          <p class="h3"><b>Civil Information</b></p>
        </div> <br>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="civil_status" class="control-label">CIVIL STATUS<b style="color:#FF0000" ;>*</b></label>
              <select name="civil_status" id="civil_status" class="custom-select">
                <option>Single</option>
                <option>Married</option>
                <option>Widowed</option>
                <option>Devorced</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="children" class="control-label">Children/Ages</label>
              <input autocomplete="off" type="text" class="form-control" id="children" placeholder="Children/Ages" name="children">
            </div>
          </div>
          <div class="col-md-4 inline">
            <div class="form-group">
              <label for="caretaker" class="control-label">Who takes care of children</label>
              <input autocomplete="off" type="text" class="form-control" id="caretaker" placeholder="Who's taking care of your children" name="caretaker">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="spouse" class="control-label">Name of spouse</label>
              <input autocomplete="off" type="text" class="form-control" id="spouse" placeholder="Name of Spouse" name="spouse">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="occupation1" class="control-label">Occupation</label>
              <input autocomplete="off" type="text" class="form-control" id="occupation1" placeholder="Occupation" name="occupation1">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="age1" class="control-label">Age</label>
              <input autocomplete="off" type="number" class="form-control" id="age1" placeholder="Age" name="age1">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="father" class="control-label">Father's name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="father" required placeholder="Father's Name" name="father">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="occupation2" class="control-label">Occupation</label>
              <input autocomplete="off" type="text" class="form-control" id="occupation2" placeholder="Occupation" name="occupation2">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="age2" class="control-label">Age</label>
              <input autocomplete="off" type="number" class="form-control" id="age2" placeholder="Age" name="age2">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="mother" class="control-label">Mother's name<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="mother" placeholder="Mother's Name" required name="mother">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="occupation3" class="control-label">Occupation</label>
              <input autocomplete="off" type="text" class="form-control" id="occupation3" placeholder="Occupation" name="occupation3">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="age3" class="control-label">Age</label>
              <input autocomplete="off" type="number" class="form-control" id="age3" placeholder="Age" name="age3">
            </div>
          </div>
        </div>
        <fieldset>
          <div id="option-list">
            <div class="row item">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="sibling_name" class="control-label">Sibling details</label>
                  <input autocomplete="off" type="text" class="form-control" id="sibling_name" placeholder="Sibling Details" name="sibling_name[]">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="occupation4" class="control-label">Occupation</label>
                  <input autocomplete="off" type="text" class="form-control" id="occupation4" placeholder="Occupation" name="sibling_occupation[]">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="age4" class="control-label">Age</label>
                  <input autocomplete="off" type="number" class="form-control" id="age4" placeholder="Age" name="sibling_age[]">
                </div>
              </div>
            </div>
          </div>
          <div class="my-2 text-center">
            <button class="btn btn-primary btn-block-sm" id="add_option" type="button"><i class="fa fa-plus"></i> Add Sibling</button>
          </div>
        </fieldset>
        <noscript id="option-clone">
          <div class="list-group-item item">
            <div class="list-group" id="option-list">
              <div class="row justify-content-end align-items-end form-group">
                <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option1"><i class="fa fa-times"></i></a>
              </div>
              <div class="row item">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="sibling_name" class="control-label">Sibling details<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" id="sibling_name" placeholder="Sibling Details" required name="sibling_name[]">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="occupation4" class="control-label">Occupation<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" id="occupation4" placeholder="Occupation" required name="sibling_occupation[]">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="age4" class="control-label">Age<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="number" class="form-control" id="age4" placeholder="Age" required name="sibling_age[]">
                  </div>
                </div>
              </div>
              <!-- <div class="row justify-content-between align-items-end form-group">
                <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option text-decoration-none text-reset" title="Remove Option"><i class="fa fa-times"></i></a>
              </div> -->
            </div>

          </div>
        </noscript>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="contact_person" class="control-label">Contact Person in case of emergency<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="contact_person" placeholder="Contact Person Name" required name="contact_person">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="contact_person_number" class="control-label">Contact number<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" pattern="[0-9]+" class="form-control" id="contact_person_number" required placeholder="09xxxxxxxxx" minlength='11' maxlength="11" name="contact_person_number">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="relationship" class="control-label">Relationship<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="relationship" required placeholder="Relationship" name="relationship">
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-md-6">
            <div class="form-group">
              <label for="resume" class="control-label">WHO PREPARED YOUR RESUME<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="resume" required placeholder="Who prepared your resume?" name="resume">
            </div>
          </div> -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="gap" class="control-label">Email address<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="email" class="form-control" required id="gap" placeholder="Email address of contact person" name="gap">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="relative" class="control-label">Relative/Friends working at TSPI<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="relative" required placeholder="Relative/Friends Working at TSPI" name="relative">
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="goals" class="control-label">GOALS IN LIFE<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="goals" placeholder="Goals in life" required name="goals">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="problem" class="control-label">MAJOR PROBLEM ENCOUNTERED<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="problem" required placeholder="Major problem encountered" name="problem">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="solution" class="control-label">HOW IT WAS HANDLED/RESOLVED<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="solution" required placeholder="How it was handled/resolved" name="solution">
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-md-12" ng-app="myApp">
            <div class="form-group">
              <label for="medical" class="control-label">Any medical history</label>
              <!-- <textarea rows="2" class="form-control" id="medical" name="medical" placeholder="Medical History"></textarea> -->
              <select class="custom-select" id="stateSel" size="1">
                <option value="" disabled selected="selected">---Do you have any medical history---</option>
              </select>
              <br>
              <br>
              <select disabled class="custom-select" name="medical" id="countySel" size="1">
                <option value="" disabled selected="selected">--------</option>
              </select>
              <br>
              <br>
              <input autocomplete="off" disabled type="text" class="form-control d-none" id="med" required placeholder="Please input other medical history" name="medical">
              <!-- <select class="custom-select" name="optthree" id="citySel" size="1">
                <option value="" selected="selected">Please select county first</option>
              </select> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="vaccine" class="control-label">Covid vaccine<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" required id="vaccine" placeholder="Covid vaccine brand" name="vaccine">
            </div>
          </div>
          <div class="col-md-3">
            <label for="firstdose" class="control-label">1st dose date<b style="color:#FF0000" ;>*</b></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input autocomplete="off" type="date" required max="<?php echo date("Y-m-d") ?>" id="firstdose" class="form-control" name="firstdose">
            </div>
          </div>
          <div class="col-md-3">
            <label for="seconddose" class="control-label">2nd dose date<b style="color:#FF0000" ;>*</b></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input autocomplete="off" type="date" max="<?php echo date("Y-m-d") ?>" required id="seconddose" class="form-control" name="seconddose">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="lgu" class="control-label">Lgu<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" required placeholder="Where did you get your vaccine?" id="lgu" name="lgu">
            </div>
          </div>
        </div>
        <fieldset>
          <div id="option-list2">
            <div class="row item2">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="booster" class="control-label">Booster</label>
                  <input autocomplete="off" type="text" class="form-control" id="booster" placeholder="Covid vaccine brand" name="booster[]">
                </div>
              </div>
              <div class="col-md-4">
                <label for="dose" class="control-label">Dose date</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input autocomplete="off" type="date" max="<?php echo date("Y-m-d") ?>" id="dose" class="form-control" name="dose[]">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lgu1" class="control-label">Lgu</label>
                  <input autocomplete="off" type="text" class="form-control" placeholder="Where did you get your Booster?" id="lgu1" name="lgu1[]">
                </div>
              </div>
            </div>
          </div>
          <div class="my-2 text-center">
            <button class="btn btn-primary btn-block-sm" id="add_option2" type="button"><i class="fa fa-plus"></i> Add Booster</button>
          </div>
        </fieldset>
        <noscript id="option-clone2">
          <div class="list-group-item item2">
            <div class="list-group" id="option-list2">
              <div class="row justify-content-end align-items-end form-group">
                <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option2 text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option1"><i class="fa fa-times"></i></a>
              </div>
              <div class="row item2">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="booster" class="control-label">Booster<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" required id="booster" placeholder="Covid vaccine brand" name="booster[]">
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="dose" class="control-label">Dose date<b style="color:#FF0000" ;>*</b></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input autocomplete="off" type="date" max="<?php echo date("Y-m-d") ?>" required id="dose" class="form-control" name="dose[]">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lgu1" class="control-label">Lgu<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" required placeholder="Where did you get your Booster?" id="lgu1" name="lgu1[]">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </noscript>
        <!-- <div class="col-md-4">
            <div class="form-group">
              <label for="shifting_schedule" class="control-label" style="display: block; text-align: center;">Can you render overtime/shifting schedule<b style="color:#FF0000" ;>*</b></label>
              <div class="input-group justify-content-center">
                <div class="input-group-prepend ">
                  <span class="input-group-text  ">Yes</span>
                </div>
                <input autocomplete="off" type="radio" name="shifting_schedule" id="shifting_schedule2" class="form-control col-md-1 mr-5" required value="1">
                <div class="input-group-prepend">
                  <span class="input-group-text ">No</span>
                </div>
                <input autocomplete="off" type="radio" name="shifting_schedule" id="shifting_schedule1" class="form-control col-md-1" required value="2">
              </div>
            </div>
          </div> -->
        <div class="card-header text-center"></div>
        <!-- Educational Background -->
        <div class="card-header text-center">
          <p class="h3"><b>Educational Background</b></p>
        </div> <br>
        <div class="row">
          <!-- <div class="col-md-6">
            <div class="form-group">
              <label for="education" class="control-label">HIGHEST EDUCATIONAL ATTAINMENT<b style="color:#FF0000" ;>*</b></label>
              <input autocomplete="off" type="text" class="form-control" id="education" required placeholder="Highest Educational Attainment" name="education">
            </div>
          </div> -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="education" class="control-label">Highest educational attainment<b style="color:#FF0000" ;>*</b></label>
              <select name="education" id="education" required class="custom-select educ">
                <option value="" disabled selected>--Choose--</option>
                <option value="Highschool Graduate">Highschool Graduate</option>
                <option value="Senior High School Graduate">Senior High School Graduate</option>
                <option value="Vocational Graduate">Vocational Graduate</option>
                <option value="College Undergraduate">College Undergraduate</option>
                <option value="College Graduate">College Graduate</option>
                <option value="Post Graduate">Post Graduate</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="course" class="control-label">Course</label>
              <input autocomplete="off" type="text" class="form-control course" id="course" disabled placeholder="Course" name="course">
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="award" class="control-label">Award/ Recognitions received</label>
              <textarea rows="2" class="form-control" id="award" name="award" placeholder="Award / Recognitions Recieved"></textarea>
            </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="form-group">

              <div class="form-group">
                <label for="computer_literate" class="control-label" style="display: block; text-align: center;">ARE YOU COMPUTER LITERATE<b style="color:#FF0000" ;>*</b></label>
                <div class="input-group justify-content-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text  ">YES</span>
                  </div>
                  <input autocomplete="off" type="radio" class="form-control col-md-1 mr-5" id="computer_literate1" name="computer_literate" required value="1">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">NO</span>
                  </div>
                  <input autocomplete="off" type="radio" class="form-control col-md-1" id="computer_literate2" name="computer_literate" required value="2">

                </div>
              </div>
            </div>
          </div> -->
        </div><br>
        <!-- <p class="login-box-msg"><b>DO YOU HAVE</b></p>
        <div class="row justify-content-center"><small class="text-info"><i><i class="fas fa-info-circle text-info"></i>Leave blank if not available</i></small></div> -->

        <!-- <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="tor" class="control-label" style="display: block; text-align: center;">TRANSCRIPT OF RECORD</label>
              <input autocomplete="off" type="checkbox" class="form-control" id="tor" name="tor" value="1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="shs_diploma" class="control-label" style="display: block; text-align: center;">SENIOR HS DIPLOMA</label>
              <input autocomplete="off" type="checkbox" class="form-control" id="shs_diploma" name="shs_diploma" value="1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="hs_diploma" class="control-label" style="display: block; text-align: center;">HIGHSCHOOL DIPLOMA</label>
              <input autocomplete="off" type="checkbox" class="form-control" id="hs_diploma" name="hs_diploma" value="1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="form137" class="control-label" style="display: block; text-align: center;">FORM137</label>
              <input autocomplete="off" type="checkbox" class="form-control" id="form137" name="form137" value="1">
            </div>
          </div>
        </div> -->

        <div class="card-header text-center"></div>
        <!------------------------------------------------------------- Work Experience --------------------------------------------------->
        <div class="card-header text-center">
          <p class="h3"><b>Work Experience</b></p>
        </div> <br>


        <fieldset>
          <div id="option-list1">
            <div class="row item1">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="company" class="control-label">Name of company</label>
                  <input autocomplete="off" type="text" class="form-control" id="company" placeholder="Name of company" name="company[]">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="company_address" class="control-label">Company address</label>
                  <input autocomplete="off" type="text" class="form-control" id="company_address" placeholder="Company address" name="company_address[]">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="position" class="control-label">Position</label>
                  <input autocomplete="off" type="text" class="form-control" id="position" placeholder="Position" name="position[]">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>DURATION:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt">&nbsp; Start</i>
                      </span>
                    </div>
                    <input autocomplete="off" type="month" class="form-control float-right" name="start[]" id="start">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"> End</i>
                      </span>
                    </div>
                    <input autocomplete="off" type="month" class="form-control float-right" name="end[]" id="end">
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <label for="reason" class="control-label">Reason for resignation</label>
                  <input autocomplete="off" type="text" class="form-control" id="reason" placeholder="Reason for Resignation" name="reason[]">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="last_contact_person" class="control-label">Contact person in previous work</label>
                  <input autocomplete="off" type="text" class="form-control" id="last_contact_person" placeholder="Contact person in previous work" name="last_contact_person[]">
                </div>
              </div>
            </div>
          </div>
          <div class="my-2 text-center">
            <button class="btn btn-primary btn-block-sm" id="add_option1" type="button"><i class="fa fa-plus"></i> Add Work Experience</button>
          </div>
        </fieldset>
        <noscript id="option-clone1">
          <div class="list-group-item item1">
            <div class="list-group" id="option-list1">
              <div class="row justify-content-end align-items-end form-group">
                <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option1 text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option1"><i class="fa fa-times"></i></a>
              </div>
              <div class="row item1">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="company" class="control-label">Name of company<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" id="company" required placeholder="Name of Company" name="company[]">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="company_address" class="control-label">Company address</label>
                    <input autocomplete="off" type="text" class="form-control" required id="company_address" placeholder="Company address" name="company_address[]">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="position" class="control-label">Position<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" id="position" required placeholder="Position" name="position[]">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>DURATION:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt">&nbsp; Start<b style="color:#FF0000" ;>*</b></i>
                        </span>
                      </div>
                      <input autocomplete="off" type="month" class="form-control float-right" required name="start[]" id="start">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"> End<b style="color:#FF0000" ;>*</b></i>
                        </span>
                      </div>
                      <input autocomplete="off" type="month" class="form-control float-right" required name="end[]" id="end">
                    </div>

                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="reason" class="control-label">Reason for resignation<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" id="reason" required placeholder="Reason for Resignation" name="reason[]">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="last_contact_person" class="control-label">Contact person in previous work<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" required id="last_contact_person" placeholder="Contact person in previous work" name="last_contact_person[]">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </noscript><br>
        <div class="card-header text-center"></div>
        <div class="card-header text-center">
          <p class="h3"><b>Trainings/Seminars attended</b></p>
        </div> <br>
        <fieldset>
          <div id="option-list3">
            <div class="row item3">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="certificate" class="control-label">Trainings/Seminars attended</label>
                  <input autocomplete="off" type="text" class="form-control" id="certificate" placeholder="Trainings/Seminars attended" name="certificate[]">
                </div>
              </div>
              <div class="col-md-6">
                <label for="year_attended" class="control-label">Month/Year attended</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input autocomplete="off" type="month" max="<?php echo date("Y-m-d") ?>" id="year_attended" value="" class="form-control" name="year_attended[]">
                </div>
              </div>
            </div>
          </div>
          <div class="my-2 text-center">
            <button class="btn btn-primary btn-block-sm" id="add_option3" type="button"><i class="fa fa-plus"></i> Add Trainings/Seminars attended</button>
          </div>
        </fieldset>
        <noscript id="option-clone3">
          <div class="list-group-item item3">
            <div class="list-group" id="option-list3">
              <div class="row justify-content-end align-items-end form-group">
                <a tabindex="-1" href="javascript:void(0)" class="col-auto remove-option3 text-decoration-none text-reset btn btn-danger btn-block-sm" title="Remove Option3"><i class="fa fa-times"></i></a>
              </div>
              <div class="row item3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="certificate" class="control-label">Trainings/Seminars attended<b style="color:#FF0000" ;>*</b></label>
                    <input autocomplete="off" type="text" class="form-control" required id="certificate" placeholder="Trainings/Seminars attended" name="certificate[]">
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="year_attended" class="control-label">Month/Year attended</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input autocomplete="off" type="month" year max="<?php echo date("Y-m-d") ?>" id="year_attended" class="form-control" name="year_attended[]">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </noscript>

        <!-- <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="attendance" class="control-label">ATTENDANCE STATUS/DISCIPLINARY ACTIONS ISSUED ON PREVIOUS EMPLOYMENT</label>
              <input autocomplete="off" type="text" class="form-control" id="attendance" placeholder="Attendance Status/Diciplinary Actions Issued onPrevious Employment" name="attendance">
            </div>
          </div>
        </div> -->

        <!-- <div class="card-header text-center"></div><br>
        <div class="card-header text-center">
          <p class="h3"><b>Vaccination</b></p>
        </div> <br> -->

        <!-- <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for=" remarks" class="control-label">REMARKS</label>
              <input autocomplete="off" type="text" class="form-control" placeholder="Remarks" id="remarks" name="remarks">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pending_application" class="control-label">PENDING APPLICATON</label>
              <input autocomplete="off" type="text" class="form-control" placeholder="Pending Application" id="pending_application" name="pending_application">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="expected_salary" class="control-label">EXPECTED SALARY</label>
              <input autocomplete="off" type="number" class="form-control" placeholder="Expected Salary" id="expected_salary" name="expected_salary">
            </div>
          </div>
        </div> -->
        <br>
        <input autocomplete="off" type="hidden" id="application" name="application" required>
        <input autocomplete="off" type="hidden" name="position_name" id="position_name" required>
        <div class="form-group clearfix text-center">
          <div class="icheck-primary btn-lg d-inline">
            <input type="checkbox" id="cert" required>
            <label for="cert">I hereby certify that the above information is true and correct.</label>
          </div>
        </div>
        <div class="card-header text-center"></div><br>
        <div class="row  justify-content-end  ">
          <div class="col-4 ">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- <script src="ph-address-selector.js"></script> -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/ph-address-selector1.js"></script>
<!-- <script src="dist/js/ph-address-selector.js"></script> -->
<script src="dist/js/registration.js"></script>


<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script>
  var stateObject = {
    "Yes": {
      "Hypertension": [],
      "Operation": [],
      "Surgery": [],
      "Family History": [],
      "Covid": [],
      "Maintenance": [],
      "Others...": []
    },
    "No": {
      // "Douglas": ["Roseburg", "Winston"],
    }
  }
  window.onload = function() {
    var stateSel = document.getElementById("stateSel"),
      countySel = document.getElementById("countySel");

    for (var state in stateObject) {
      stateSel.options[stateSel.options.length] = new Option(state, state);
    }

    stateSel.onchange = function() {
      countySel.length = 1; // remove all options bar first
      if (this.selectedIndex < 1) {
        // countySel.options[0].text = "Please select if you have any medical history first.";
        console.log("Selected : None");
        return; // done   
      }
      // countySel.options[0].text = "----------";
      var selectedState = this.value;
      if (selectedState == 'Yes') {
        $('#countySel').removeAttr('disabled')
        $('#countySel').attr('required', true)
      } else {
        $('#countySel').removeAttr('required')
        $('#countySel').attr('disabled', true)
        $('#med').addClass('d-none')
        $('#med').removeAttr('required')
        $('#med').attr('disabled', true)
      }
      console.log("Selected : " + selectedState);

      for (var county in stateObject[selectedState]) {
        countySel.options[countySel.options.length] = new Option(county, county);
      }
      if (countySel.options.length == 2) {
        countySel.selectedIndex = 1;
      }
    }

    countySel.onchange = function() {
      if (this.selectedIndex < 1) {
        console.log("Selected : None");
        return; // done   
      }
      var selectedCounty = this.value;
      if (selectedCounty == 'Others...') {
        console.log("lalalalal");
        $('#med').removeAttr('disabled')
        $('#med').removeClass('d-none')
        $('#med').attr('required', true)
      } else {
        $('#med').addClass('d-none')
        $('#med').removeAttr('required')
        $('#med').attr('disabled', true)

      }
      console.log("Selected : " + selectedCounty);
    }

    stateSel.onchange(); // reset in case the page is reloaded
  }
  let timerActive = true;
  window.onbeforeunload = function() {
    if (timerActive == true) {
      return "Are you sure you want to leave this page?";
    } else {}
  };
  $("#birthdate").change(function() {
    var dt = $('#birthdate').val()
    var dob = new Date(dt);
    //calculate month difference from current date in time
    var month_diff = Date.now() - dob.getTime();

    //convert the calculated difference in date format
    var age_dt = new Date(month_diff);

    //extract year from date    
    var year = age_dt.getUTCFullYear();

    //now calculate the age of the user
    var age = Math.abs(year - 1970);
    // console.log(age)
    $('#age').val(age)
  });
  //display the calculated age
  // document.write("Age of the date entered: " + age + " years");

  function triggerButton() {
    console.log('Open')
    uni_modal("", "privacy.php", "large")
  }

  setTimeout(triggerButton, 500);

  $('#same').click(function() {
    // console.log('ondas')
    if ($('#same').is(':checked')) {
      $('.same_').attr('disabled', true)
      // $('#perma_region').val($('#region').val())
      // $('#perma_province').val($('#province').val())
      // $('#perma_city').val($('#city').val())
      // $('#perma_barangay').val($('#barangay').val())
      $('#permanent_address').val($('#current_address').val())
      $('#perma_zip').val($('#zip').val())
    } else {
      $('#perma_region').val('')
      $('#perma_province').val('')
      $('#perma_city').val('')
      $('#perma_barangay').val('')
      $('#permanent_address').val('')
      $('#perma_zip').val('')
      $('.same_').removeAttr('disabled')
      // alert('Submit 2 clicked');
    }
  })
  $("#start, #end").on("change input", function() {
    var startDate = $('#start').val().value;
    var endDate = $('#end').val().value;
    console.log(startDate)
    console.log(endDate)
    if ((Date.parse(startDate) <= Date.parse(endDate))) {
      alert("End date should be greater than Start date");
      document.getElementById("end").value = "";
    }
  });

  // // Date range picker
  // $('#duration').daterangepicker()


  $(".educ").on("change input", function() {
    if ($('.educ').val() == 'Vocational Graduate' || $('.educ').val() == 'College Graduate' || $('.educ').val() == 'College Undergraduate' || $('.educ').val() == 'Post Graduate') {
      $(`input[name="course"]`).removeAttr('disabled');
      $(`input[name="course"]`).attr('required', true)
      //     $(`input[name="last_contact_person"]`).removeAttr('required');
      //     console.log('w')

    } else {
      $(`input[name="course"]`).attr('disabled', true)
      $(`input[name="course"]`).removeAttr('required');
      //     $(`input[name="last_contact_person"]`).attr('required', true)

    }
  });
  $('.remove-option').click(function() {
    $(this).closest('.item').remove()
  })
  // Add Option button click event
  $('#add_option').click(function() {
    // Clone the template option and convert it into a jQuery object
    var item = $($('#option-clone').html()).clone();

    // Append the modified item to the option list
    $('#option-list').append(item);

    // Attach event handlers to the cloned item

    item.find('.remove-option').click(function() {
      $(this).closest('.item').remove();
    });
  });
  $('.remove-option1').click(function() {
    $(this).closest('.item1').remove()
  })
  // Add Option button click event
  $('#add_option1').click(function() {
    // Clone the template option and convert it into a jQuery object
    var item = $($('#option-clone1').html()).clone();

    // Append the modified item to the option list
    $('#option-list1').append(item);

    // Attach event handlers to the cloned item

    item.find('.remove-option1').click(function() {
      $(this).closest('.item1').remove();
    });
  });
  $('.remove-option2').click(function() {
    $(this).closest('.item2').remove()
  })
  // Add Option button click event
  $('#add_option2').click(function() {
    // Clone the template option and convert it into a jQuery object
    var item = $($('#option-clone2').html()).clone();

    // Append the modified item to the option list
    $('#option-list2').append(item);

    // Attach event handlers to the cloned item

    item.find('.remove-option2').click(function() {
      $(this).closest('.item2').remove();
    });
  });
  $('.remove-option3').click(function() {
    $(this).closest('.item3').remove()
  })
  // Add Option button click event
  $('#add_option3').click(function() {
    // Clone the template option and convert it into a jQuery object
    var item = $($('#option-clone3').html()).clone();

    // Append the modified item to the option list
    $('#option-list3').append(item);

    // Attach event handlers to the cloned item

    item.find('.remove-option3').click(function() {
      $(this).closest('.item3').remove();
    });
  });
  window.addEventListener("message", function(event) {
    if (event.data.type === "modalClosed") {
      // Handle the input values received from the modal
      var inputValues = event.data.inputValues;
      var text = event.data.text;
      console.log("Modal Input Values:", text);
      $('#application').val(inputValues)
      $('#position_name').val(text)
      // console.log(inputValues)
    }
  });
</script>