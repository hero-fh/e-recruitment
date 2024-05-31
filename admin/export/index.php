<style>
    .custom-button {
        /* Add your custom styles here */
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        width: 250px;
    }

    .hide {
        display: none;
    }

    .custom-button:hover {
        background-color: darkblue;
    }
</style>
<div class="card card-outline card-primary ">
    <div class="card-header ">
        <h3 class="card-title">List of Applicant</h3>
    </div>
    <div class="col-12 col-sm-12">

        <div class="card-body">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card-body overflow-auto">
                        <table id="export" class="table display export table-bordered table-striped">
                            <thead>
                                <tr class="bg-gradient-primary">
                                    <th class="text-center">NO.</th>
                                    <th class="text-center">DATE APPLIED</th>
                                    <th class="text-center">LAST NAME</th>
                                    <th class="text-center">FIRST NAME</th>
                                    <th class="text-center">MIDDLE NAME</th>
                                    <th class="hide text-center">ADDRESS</th>
                                    <th class="hide text-center">CONTACT NUMBER</th>
                                    <th class="hide text-center">BIRTHDAY</th>
                                    <th class="hide text-center">CIVIL STATUS</th>
                                    <th class="hide text-center">TIN</th>
                                    <th class="hide text-center">SSS#</th>
                                    <th class="hide text-center">PHILHEALTH#</th>
                                    <th class="hide text-center">PAGIBIG#</th>
                                    <th class="text-center">POSITION</th>
                                    <th class="hide text-center">EDUCATIONAL ATTAINMENT</th>
                                    <th class="hide text-center">GENDER</th>
                                    <th class="hide text-center">NICKNAME</th>
                                    <th class="hide text-center">CONTACT PERSON</th>
                                    <th class="hide text-center">RELATION TO CONTACT PERSON</th>
                                    <th class="hide text-center">ADDRESS OF CONTACT PERSON</th>
                                    <th class="hide text-center">CONTACT NO. OF CONTACT PERSON</th>
                                    <!-- <th class="hide text-center">Working Experience (Position/Company/Duration)</th> -->
                                    <?php
                                    $z = 0;
                                    // Fetch all rows from the work_experience table
                                    $we = $conn->query("SELECT * FROM work_experience")->num_rows;
                                    if ($we > 0) {

                                        $query = $conn->query("SELECT * FROM work_experience");
                                        // Create an associative array to store the counts of <th>Position</th> for each applicant_id
                                        $applicantCounts = array();

                                        // Loop through the result set and count the occurrences of <th>Position</th> for each applicant_id
                                        while ($row = $query->fetch_assoc()) {
                                            $applicantId = $row['applicant_id'];
                                            if (!isset($applicantCounts[$applicantId])) {
                                                $applicantCounts[$applicantId] = 0;
                                            }
                                            $applicantCounts[$applicantId]++;
                                        }
                                        // Find the maximum count of <th>Position</th>
                                        $wemaxCount = max($applicantCounts);
                                        // Loop through the maximum count of <th>Position</th>
                                        for ($x = 0; $x < $wemaxCount; $x++) {
                                            echo '<th class="hide text-center">Working Experience (Position/Company/Duration)</th>';
                                        }
                                    } else {
                                        echo '<th class="hide text-center">Working Experience (Position/Company/Duration)</th>';
                                    }
                                    ?>
                                    <th class="hide text-center">1st Dose Date</th>
                                    <th class="hide text-center">2nd Dose Date</th>
                                    <th class="hide text-center">LGU</th>
                                    <th class="hide text-center">Vaccine Type</th>
                                    <?php
                                    $y = 0;
                                    $b = $conn->query("SELECT * FROM booster")->num_rows;

                                    if ($b > 0) {

                                        // Fetch all rows from the work_experience table
                                        $query = $conn->query("SELECT * FROM booster");

                                        // Create an associative array to store the counts of <th>Position</th> for each applicant_id
                                        $boosterCounts = array();

                                        // Loop through the result set and count the occurrences of <th>Position</th> for each applicant_id
                                        while ($row = $query->fetch_assoc()) {
                                            $applicantId = $row['applicant_id'];
                                            if (!isset($boosterCounts[$applicantId])) {
                                                $boosterCounts[$applicantId] = 0;
                                            }
                                            $boosterCounts[$applicantId]++;
                                        }
                                        // Find the maximum count of <th>Position</th>
                                        $bmaxCount = max($boosterCounts);
                                        // Loop through the maximum count of <th>Position</th>
                                        for ($b = 0; $b < $bmaxCount; $b++) {
                                            echo '<th class="hide text-center">Booster Date</th>';
                                            echo '<th class="hide text-center">LGU</th>';
                                            echo '<th class="hide text-center">Vaccine Type</th>';
                                        }
                                    } else {
                                        echo '<th class="hide text-center">Booster Date</th>';
                                        echo '<th class="hide text-center">LGU</th>';
                                        echo '<th class="hide text-center">Vaccine Type</th>';
                                    }
                                    ?>
                                    <th class="text-center">Email Address</th>
                                    <th class="hide text-center">EXAM RESULTS(Passed/Failed)</th>
                                    <th class="hide text-center">EXAM RESULTS(Percentage)</th>
                                    <th class="hide text-center">INITIAL INTERVIEW STATUS (Passed/Failed)</th>
                                    <th class="hide text-center">FINAL INTERVIEW STATUS (Passed/Failed)</th>
                                    <th class="hide text-center">REQUIREMENTS STATUS (Complete/Incomplete)</th>
                                    <th class="hide text-center">MEDICAL STATUS (Fit to Work/Unfit to work)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $qry = $conn->query("SELECT * from `applicants`");
                                while ($row = $qry->fetch_assoc()) :
                                    $qry1 = $conn->query("SELECT * from `work_experience` where applicant_id = '{$row['id']}'");
                                    while ($row1 = $qry1->fetch_assoc()) :

                                        // Create DateTime objects
                                        $startDate = date_create($row1['start']);
                                        $endDate = date_create($row1['end']);
                                        // Calculate the difference in months
                                        $interval = date_diff($startDate, $endDate);
                                        $months = $interval->format('%m');

                                        // Calculate the difference in years
                                        $years = floor($months / 12);
                                    endwhile;
                                    $score1 = $conn->query("SELECT * FROM  `applicant_score` where applicant_id = '{$row['id']}' ");
                                    while ($sc1 = $score1->fetch_assoc()) :
                                        $score3 = $sc1['score'] + $sc1['test2'];
                                        $score = ($score3 / $sc1['total_score']) * 100;
                                        $score = $score > 0 ? $score : 0;
                                    endwhile;
                                    $chk = $conn->query("SELECT decide FROM  `assessment` where id='{$row['id']}'");
                                    $countrow = $chk->num_rows;
                                    if ($countrow == 1) {
                                        $decide = $conn->query("SELECT decide FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
                                    } else {
                                        $decide = NULL;
                                    }
                                    $check = $conn->query("SELECT choose FROM  `assessment` where id='{$row['id']}'");
                                    $rowcount = $check->num_rows;
                                    if ($rowcount == 1) {
                                        $choice = $conn->query("SELECT choose FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
                                    } else {
                                        $choice = NULL;
                                    }
                                    $checks = $conn->query("SELECT a_position FROM  `assessment` where id='{$row['id']}'");
                                    $rowscount = $checks->num_rows;
                                    if ($rowscount == 1) {
                                        $a_pos = $conn->query("SELECT a_position FROM  `assessment` where id='{$row['id']}'")->fetch_array()[0];
                                    } else {
                                        $a_pos = NULL;
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class="text-center"><?php echo isset($row['application_date']) ? date("m-d-Y", strtotime($row['application_date'])) : 'N/A' ?></td>
                                        <td class="text-center"><?php echo ucfirst(strtolower($row['surname'])) ?></td>
                                        <td class="text-center"><?php echo ucfirst(strtolower($row['firstname'])) ?></td>
                                        <td class="text-center "><?php echo ucfirst(strtolower($row['middlename'])) ?></td>
                                        <td class="text-center hide"><?php echo ucwords(strtolower($row['current_address']));
                                                                        echo ' ';
                                                                        echo ucfirst($row['barangay']);
                                                                        echo ' ';
                                                                        echo ucfirst($row['city']);
                                                                        echo ' ';
                                                                        echo ucfirst($row['province']); ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['mobile_number']) ?></td>
                                        <td class="text-center hide"><?php echo isset($row['birthdate']) ? date("m-d-Y", strtotime($row['birthdate'])) : 'N/A' ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['civil_status']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['tin']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['sss']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['philhealth']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['pagibig']) ?></td>
                                        <td class="text-center "><?php echo isset($a_pos) ? $a_pos : $row['position_name'] ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['education']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['gender']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['nickname']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['contact_person']) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['relationship']) ?></td>
                                        <td class="text-center hide"><?php echo ucwords(strtolower($row['permanent_address'])) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst($row['contact_person_number']) ?></td>


                                        <?php
                                        if ($we > 0) {
                                            $query = $conn->query("SELECT * FROM work_experience where applicant_id = '{$row['id']}'");
                                            while ($rows = $query->fetch_assoc()) {
                                                $startDate = date_create($rows['start']);
                                                $endDate = date_create($rows['end']);
                                                // Calculate the difference in months
                                                $interval = date_diff($startDate, $endDate);
                                                $months = $interval->format('%m');

                                                // Calculate the difference in years
                                                $years = floor($months / 12);
                                                echo '<td class="text-center hide">' . ucwords(strtolower($rows['position'])) . '/' . ucwords(strtolower($rows['company']))  . '/' . ($months . ' ' . 'Months') . '</td>';
                                                $z++;
                                            }

                                            if ($z <= $wemaxCount) {
                                                while ($z < $wemaxCount) {
                                                    echo '<td class="text-center hide">N/A</td>';
                                                    $z++;
                                                }
                                            }
                                        } else {
                                            echo '<td class="text-center hide">N/A</td>';
                                        }
                                        ?>
                                        <td class="text-center hide"><?php echo isset($row['firstdose']) ? date("m-d-Y", strtotime($row['firstdose'])) : 'N/A' ?></td>
                                        <td class="text-center hide"><?php echo isset($row['seconddose']) ? date("m-d-Y", strtotime($row['seconddose'])) : 'N/A' ?></td>
                                        <td class="text-center hide"><?php echo ucfirst(strtolower($row['lgu'])) ?></td>
                                        <td class="text-center hide"><?php echo ucfirst(strtolower($row['vaccine'])) ?></td>
                                        <?php
                                        if ($b > 0) {
                                            $query1 = $conn->query("SELECT * FROM booster where applicant_id = '{$row['id']}'");

                                            while ($rows = $query1->fetch_assoc()) {
                                                echo '<td class="text-center hide">' . ucfirst($rows['dose']) . '</td>';
                                                echo '<td class="text-center hide">' . ucfirst($rows['lgu1']) . '</td>';
                                                echo '<td class="text-center hide">' . ucfirst($rows['booster']) . '</td>';
                                                $y++;
                                            }
                                            if ($y <= $bmaxCount) {
                                                while ($y < $bmaxCount) {
                                                    echo '<td class="text-center hide">N/A</td>';
                                                    echo '<td class="text-center hide">N/A</td>';
                                                    echo '<td class="text-center hide">N/A</td>';
                                                    $y++;
                                                }
                                            }
                                        } else {
                                            echo '<td class="text-center hide">N/A</td>';
                                            echo '<td class="text-center hide">N/A</td>';
                                            echo '<td class="text-center hide">N/A</td>';
                                        }
                                        ?>
                                        <td class="text-center "><?php echo strtolower($row['email']) ?></td>
                                        <td class="text-center hide"><?php echo isset($row['passed']) && $row['passed'] == 1 ? 'Passed' : 'Failed' ?></td>
                                        <td class="text-center hide"><?php echo isset($score) ?  (number_format($score, 2)) . '%'  : 'N/A' ?></td>
                                        <td class="text-center hide"><?php echo isset($decide) && $decide == 1 ? 'Passed' : 'Failed' ?></td>
                                        <td class="text-center hide"><?php echo isset($choice) && $choice != 2 ? 'Passed' : 'Failed' ?></td>
                                        <?php if ((isset($decide) && $decide == 1) || (isset($choice) && $choice != 2)) { ?>
                                            <td class="text-center hide"><?php echo isset($row['pdf']) && $row['pdf'] == 1 ? 'Complete' : 'Incomplete' ?></td>
                                            <td class="text-center hide"><?php echo isset($row['status']) && $row['status'] == 1 ? 'Fit To Work' : 'Unfit To Work' ?></td>
                                        <?php } else { ?>
                                            <td class="text-center hide"></td>
                                            <td class="text-center hide"></td>
                                        <?php  } ?>

                                        <?php
                                        $z = 0;
                                        $y = 0;
                                        ?>
                                    </tr>
                                <?php endwhile; ?>

                            </tbody>


                        </table>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.card -->

<!-- <script src="../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script>
    var currentDate = new Date();

    var currentMonth = currentDate.getMonth() + 1; // Adding 1 to adjust for zero-based month numbering
    var currentDay = currentDate.getDate();
    var currentYear = currentDate.getFullYear();

    console.log("Current date: " + currentMonth + "/" + currentDay + "/" + currentYear);

    var pageTitle = document.title;

    // $("#example13").DataTable({
    //     "responsive": true,
    //     "lengthChange": false,
    //     "autoWidth": false,
    //     "buttons": ["excel"]
    // });
    $('#export').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "buttons": [


            {
                extend: 'excel',
                className: 'custom-button',
                text: 'Export',
                title: '',
                filename: function() {
                    return pageTitle + '(' + currentMonth + '-' + currentDay + '-' + currentYear + ')';
                }
                // title: false
            }


        ]
    }).buttons().container().appendTo('#export_wrapper');
</script>