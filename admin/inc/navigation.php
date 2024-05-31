</style>
<?php

$is_operator = $conn->query("SELECT * FROM ters_operator where emp_no = '{$_settings->userdata('EMPLOYID')}' and status = 1")->num_rows;
if (!empty($_settings->userdata('EMPNAME'))) {
  if ($_settings->userdata('EMPPOSITION') == 5) {
    $qry = $conn->query("SELECT * FROM prf_request WHERE (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 1) or (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and dh_name = 0 and `prf_status` = 0) ORDER BY `date_created` desc")->num_rows;
  }
  if ($_settings->userdata('EMPPOSITION') == 4) {
    if ($_settings->userdata('EMPLOYID') == '1694') { // Bobby
      $dept1 = "MIS";
      $dept2 = "Facilities";
      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  (`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') ORDER BY `date_created` desc")->num_rows;
    }
    if ($_settings->userdata('EMPLOYID') == '702') { // Joan
      $dept1 = 'Finance';
      $dept2 = 'Purchasing';
      $prodline1 = 'G & A';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND `requestor_pl` = '{$prodline1}') ORDER BY `date_created` desc")->num_rows;
    }
    if ($_settings->userdata('EMPLOYID') == '524') { // Charity
      $dept1 = 'Human Resource';
      $dept2 = 'Training';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  (`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') ORDER BY `date_created` desc")->num_rows;
    }
    if ($_settings->userdata('EMPLOYID') == '8563') { // Bryan
      $dept1 = 'Production';
      $dept2 = 'Production - QFP';
      $dept3 = 'Production - RFC';
      $dept4 = 'Production / Non - TNR';
      $prodline1 = 'PL1 - PL4';
      $prodline2 = 'PL1 (ADGT)';
      $prodline3 = 'PL4 (ADGT)';
      $prodline4 = 'PL6 (ADLT)';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' OR `requestor_pl` = '{$prodline4}')) ORDER BY `date_created` desc")->num_rows;
    }
    // if ($_settings->userdata('EMPLOYID') == '20') { // Noel
    //   $dept1 = 'Production';
    //   $dept2 = 'Store';
    //   $dept3 = 'IQA Warehouse';
    //   $dept4 = 'Logistics';
    //   $prodline1 = 'PL9 (AD/WHSE)';
    //   $prodline2 = 'G & A';
    //   $prodline3 = 'PL8 (AMS O/S)';

    //   $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
    //                               (((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') 
    //                                   AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}'))) 
    //                               ORDER BY `date_created` desc")->num_rows;
    // }
    if ($_settings->userdata('EMPLOYID') == '20') { // Noel
      $dept1 = 'Production';
      $dept2 = 'Store';
      $dept3 = 'IQA Warehouse';
      $dept4 = 'Logistics';
      $prodline1 = 'PL9 (AD/WHSE)';
      $prodline2 = 'G & A';
      $prodline3 = 'PL8 (AMS O/S)';

      $prodline4 = 'PL3 (ADCV)'; //tin
      $prodline5 = 'PL3 (ADCV) - Onsite'; //tin
      // $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}') ORDER BY `date_created` desc");

      //    $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
      //                             (((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') 
      //                                 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}'))) 
      //                             ORDER BY `date_created` desc");
      $qry = $conn->query("SELECT * FROM prf_request WHERE (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                              (((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}' OR `requestor_department` = '{$dept3}' OR `requestor_department` = '{$dept4}') 
                                  AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}')))) OR (prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}'))
                              ORDER BY `date_created` desc")->num_rows;
    }
    // if ($_settings->userdata('DEPARTMENT') == 'Production' && $_settings->userdata('PRODUCT_LINE') == 'PL6 (ADLT)') {
    //     $dept1 = 'Production';
    //     $dept2 = 'Production / Non - TNR';
    //     $prodline1 = 'PL6 (ADLT)';

    //     $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
    //                             ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND (`requestor_pl` = '{$prodline2}')) ORDER BY `date_created` desc")->num_rows;
    // }
    if ($_settings->userdata('EMPLOYID') == '297') { // Erwin
      $dept1 = 'Quality Assurance';
      $prodline1 = 'G & A';
      $prodline2 = 'PL1 - PL4';
      $prodline3 = 'PL1 (ADGT)';
      $prodline4 = 'PL2 (AD/OS)';
      $prodline5 = 'PL3 (ADCV)';
      $prodline6 = 'PL3 (ADCV) - Onsite';
      $prodline7 = 'PL4 (ADGT)';
      $prodline8 = 'PL6 (ADLT)';
      $prodline9 = 'PL8 (AMS O/S)';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                      OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}'
                                      OR `requestor_pl` = '{$prodline8}' OR `requestor_pl` = '{$prodline9}')) ORDER BY `date_created` desc")->num_rows;
    }
    if (($_settings->userdata('EMPLOYID') == '1023')) { // Adonis
      $dept1 = 'Equipment Engineering';
      $prodline1 = 'G & A';
      $prodline2 = 'PL1 (ADGT)';
      $prodline3 = 'PL2 (AD/OS)';
      $prodline4 = 'PL3 (ADCV)';
      $prodline5 = 'PL3 (ADCV) - Onsite';
      $prodline6 = 'PL4 (ADGT)';
      $prodline7 = 'PL6 (ADLT)';
      $prodline8 = 'PL8 (AMS O/S)';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                      OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}'
                                      OR `requestor_pl` = '{$prodline8}')) ORDER BY `date_created` desc")->num_rows;
    }
    if ($_settings->userdata('EMPLOYID') == '1170') { // Realyn
      $dept1 = 'Process Engineering';
      $prodline1 = 'G & A';
      $prodline2 = 'PL1 - PL4';
      $prodline3 = 'PL2 (AD/OS)';
      $prodline4 = 'PL3 (ADCV)';
      $prodline5 = 'PL3 (ADCV) - Onsite';
      $prodline6 = 'PL6 (ADLT)';
      $prodline7 = 'PL8 (AMS O/S)';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}') AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}' OR `requestor_pl` = '{$prodline3}' 
                                      OR `requestor_pl` = '{$prodline4}' OR `requestor_pl` = '{$prodline5}' OR `requestor_pl` = '{$prodline6}' OR `requestor_pl` = '{$prodline7}' )) ORDER BY `date_created` desc")->num_rows;
    }
    if ($_settings->userdata('EMPLOYID') == '1065') { // Tess
      $dept1 = 'Production';
      $dept2 = 'Production / PE';
      $prodline1 = 'PL2 (AD/OS)';

      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND
                                  ((`requestor_department` = '{$dept1}' OR `requestor_department` = '{$dept2}') AND `requestor_pl` = '{$prodline1}') ORDER BY `date_created` desc")->num_rows;
    }
  }
  if ($_settings->userdata('EMPPOSITION') == 3) {
    if ($_settings->userdata('EMPLOYID') == '108') { // Ma. Lourdes
      $dept1 = "PPC";
      $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND `requestor_department` = '{$dept1}' ORDER BY `date_created` desc")->num_rows;
    }
  }
  if ($_settings->userdata('EMPLOYID') == '600') { // tin
    $prodline1 = 'PL3 (ADCV)';
    $prodline2 = 'PL3 (ADCV) - Onsite';
    $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND (`requestor_pl` = '{$prodline1}' OR `requestor_pl` = '{$prodline2}') ORDER BY `date_created` desc")->num_rows;
  }
  if ($_settings->userdata('EMPPOSITION') == 2) {
    $qry = $conn->query("SELECT * FROM prf_request WHERE prf_hold != 1 and requestor_id != '{$_settings->userdata('EMPLOYID')}' and `prf_status` = 0 AND `requestor_id` = '{$_settings->userdata('EMPLOYID')}' ORDER BY `date_created` desc")->num_rows;
  }
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4 ">
  <!-- Brand Logo -->
  <a href="<?php echo base_url ?>admin" class="brand-link bg-primary bg-gradient text-sm">
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image elevation-3 bg-white">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>
          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column  nav-flat" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <!-- <li class="nav-header">Personnel Requisition Form</li> -->

              <!-- <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=prf/index_hr" class="nav-link nav-pr">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                      PR Form
                    </p>
                  </a>
                </li> -->

              <li class="nav-item  overflow-auto aa">
                <?php if ($_settings->userdata('type') == 1 || $is_operator > 0 || !empty($_settings->userdata('EMPPOSITION'))) : ?>
                  <a href="#" class="nav-link nav-is-tree nav-prf">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                      Personnel Requisition
                      <i class="right fas fa-angle-left"></i>
                      <!-- <span class="badge badge-primary rounded-pill"> <?php echo $qry ?></span> -->
                    </p>
                  </a>
                <?php endif; ?>
                <ul class="nav nav-treeview">
                  <?php if ($_settings->userdata('type') == 1 || $is_operator > 0) : ?>
                    <li class="nav-item">
                      <a href="?page=prf/all" class="nav-link nav-all">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PRF Monitoring</p>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('EMPPOSITION') >= 4 || $_settings->userdata('EMPLOYID') == 600 || $_settings->userdata('EMPLOYID') == 108) : ?>
                    <li class="nav-item">
                      <a href="?page=prf/approve" class="nav-link nav-approve">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approve Request <span class="badge badge-primary rounded-pill"> <?php echo $qry ?></span></p>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if ($_settings->userdata('type') == 1 || $_settings->userdata('EMPPOSITION') >= 2) : ?>
                    <li class="nav-item">
                      <a href="?page=prf/request" class="nav-link nav-request">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View/Create request</p>
                      </a>
                    </li>
                  <?php endif; ?>



                </ul>
              </li>
              <?php if ($_settings->userdata('type') != 1 && $is_operator == 0) : ?>
                <li class="nav-item dropdown">
                  <a href="?page=applicants/assess_" class="nav-link nav-applicants">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Applicant List
                    </p>
                  </a>
                </li>
              <?php elseif ($_settings->userdata('type') == 1 || $is_operator > 0) : ?>
                <li class="nav-item dropdown">
                  <a href="?page=applicants" class="nav-link nav-applicants">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Applicant List
                    </p>
                  </a>
                </li>
              <?php endif; ?>
              <!-- <li class="nav-header">Recruitment</li> -->

              <?php if ($_settings->userdata('type') == 1 || $is_operator > 0) : ?>



                <li class="nav-header">Maintenance</li>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=export" class="nav-link nav-export">
                    <i class="nav-icon fas fa-file-csv"></i>
                    <p>
                      Export Applicant List
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=holidays" class="nav-link nav-holidays">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                      Holidays
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=exams" class="nav-link nav-exams">
                    <i class="nav-icon fas fa-feather-alt"></i>
                    <p>
                      Answer Sheet
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=categories" class="nav-link nav-categories">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                      Exam Categories
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=position" class="nav-link nav-position">
                    <i class="nav-icon fas fa-chair"></i>
                    <p>
                      Available Position
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user">
                    <i class="nav-icon fas fa-diagnoses"></i>
                    <p>
                      Admin List
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=adminERS" class="nav-link nav-adminERS">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                      E-Recruitment Operator
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                      Settings
                    </p>
                  </a>
                </li>
              <?php endif; ?>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  var page;
  $(document).ready(function() {
    page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    page = page.replace(/\//gi, '_');
    console.log(page)
    var str = page;
    var parts = str.split("_");
    var result = parts[0];
    var after = parts[1];
    // var pattern = /applicants(\w+)/;
    // var match = str.match(pattern);
    // var str = page;
    var pattern = new RegExp(result + "(\\w+)");
    var match = str.match(pattern);
    if (match) {
      var wordAfterApplicants = match[0];
      console.log("Word after " + result + ": " + after);

      console.log(after)
      if ($('.nav-link.nav-' + result).length > 0) {
        $('.nav-link.nav-' + result).addClass('active')
        if ($('.nav-link.nav-' + result).hasClass('nav-is-tree') == true) {
          $('.nav-link.nav-' + result).parent().addClass('menu-open')
          $('.nav-link.nav-' + after).addClass('active')
        }
      }
    } else {
      console.log("No word found after '" + result + "'.");
      if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active')
        if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
          $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
          $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')

        }
        if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
          $('.nav-link.nav-' + page).parent().addClass('menu-open')
        }
      }
    }

    // if ($('.nav-link.nav-' + page).length > 0) {
    //   $('.nav-link.nav-' + page).addClass('active')
    //   if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
    //     $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
    //     $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')

    //   }

    //   if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
    //     $('.nav-link.nav-' + page).parent().addClass('menu-open')
    //   }
    // }

    $('#receive-nav').click(function() {
      $('#uni_modal').on('shown.bs.modal', function() {
        $('#find-transaction [name="tracking_code"]').focus();
      })
      uni_modal("Enter Tracking Number", "transaction/find_transaction.php");
    })
  })
</script>