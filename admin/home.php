<?php require_once('applicants/auto_delete.php') ?>
<?php require_once('prf/auto_cancel.php') ?>
<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<script src='https://cdn.plot.ly/plotly-2.24.1.min.js'></script>
<hr class="border-info">
<div class="row">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">All Application</span>
                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `applicants`")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pending Applications</span>
                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `applicants` where status=0")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Complete Requirements</span>
                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `applicants` where status=1 || pdf = 1 || assess=1")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Fit to work</span>
                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `applicants` where status=1 and pdf = 1 and assess=1")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<!-- BAR CHART -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Applicant Exam Report</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- <div id='myDiv'> -->
        <div id="chart"></div>
    </div>
    <!-- /.card-body -->
</div>
</div>
<?php
$cur = date("Y");
$count = $conn->query("SELECT  DATE_FORMAT(`application_date`, '%Y-%m') as `date`, COUNT(*) as `count` FROM `applicants`where `passed` = 1 GROUP BY DATE_FORMAT(`application_date`, '%Y-%m') ORDER BY `count` DESC");
$passed = array();

while ($row = $count->fetch_assoc()) {
    $date = $row['date'];
    $month = date("n", strtotime($date)); // Get the month name from the formatted date
    $count1 = $row['count'];
    $month1 = $month - 1;
    // Store the month and count in an associative array
    $passed[] = $count1;
}
$encodedpassed = json_encode($passed);
$count = $conn->query("SELECT  DATE_FORMAT(`application_date`, '%Y-%m') as `date`, COUNT(*) as `count` FROM `applicants`where `passed` = 2 GROUP BY DATE_FORMAT(`application_date`, '%Y-%m') ORDER BY `count` DESC");
$failed = array();

while ($row = $count->fetch_assoc()) {
    $date = $row['date'];
    $month = date("n", strtotime($date)); // Get the month name from the formatted date
    $count1 = $row['count'];
    $month1 = $month - 1;
    // Store the month and count in an associative array
    $failed[] = $count1;
}
$encodedfailed = json_encode($failed);
$count = $conn->query("SELECT  DATE_FORMAT(`application_date`, '%Y-%m') as `date`, COUNT(*) as `count` FROM `applicants` GROUP BY DATE_FORMAT(`application_date`, '%Y-%m') ORDER BY `count` DESC");
$date1 = array();
$all = array();
while ($row = $count->fetch_assoc()) {
    // echo $row['count'];
    $date = $row['date'];
    $month = date("n", strtotime($date)); // Get the month name from the formatted date
    $count1 = $row['count'];
    $month1 = $month - 1;
    // Store the month and count in an associative array
    $all[] = $count1;
    $date1[] = $row['date'];
    // echo $date;
}
$encodedall = json_encode($all);
// print_r($encodedall);
// echo '<br>';
// print_r($encodedfailed);
// echo '<br>';
// print_r($encodedpassed);
$data = [];
for ($i = 0; $i < count($date1); $i++) {
    $data[] = ['date' => $date1[$i], 'count' => $all[$i]];
}
$data1 = [];
for ($i = 0; $i < count($passed); $i++) {
    $data1[] = ['date' => $date1[$i], 'count' => $passed[$i]];
}
$data2 = [];
for ($i = 0; $i < count($failed); $i++) {
    $data2[] = ['date' => $date1[$i], 'count' => $failed[$i]];
}
// print_r($passed);
$jsonData = json_encode($data);
$jsonData1 = json_encode($data1);
$jsonData2 = json_encode($data2);
// print_r($jsonData);
// echo '<br>';
// print_r($jsonData1);
// echo '<br>';
// print_r($jsonData2);
// 
?>



<script>
    // Retrieve JSON data from PHP
    var jsonData = <?php echo $jsonData; ?>;
    var jsonData1 = <?php echo $jsonData1; ?>;
    var jsonData2 = <?php echo $jsonData2; ?>;

    var formattedData = [];
    jsonData.forEach(function(item) {
        var year = item.date.substring(0, 4);
        if (!formattedData[year]) {
            formattedData[year] = {
                x: [],
                y: [],
                // text: count,
                type: 'bar',
                name: 'Total Examinees' + ' ' + year,
                textposition: 'auto',
                marker: {
                    color: 'rgba(54, 162, 235, .7)',
                    line: {
                        color: 'rgba(54, 162, 235, 1)',
                        width: 1.5
                    }
                }
            };
        }
        formattedData[year].x.push(item.date);
        formattedData[year].y.push(item.count);
    });
    var plotData = [];
    for (var key in formattedData) {
        if (formattedData.hasOwnProperty(key)) {
            plotData.push(formattedData[key]);
        }
    }




    var formattedData1 = [];
    jsonData1.forEach(function(item) {
        var year = item.date.substring(0, 4);
        if (!formattedData1[year]) {
            formattedData1[year] = {
                x: [],
                y: [],
                type: 'bar',
                name: 'Passed' + ' ' + year,
                textposition: 'auto',
                marker: {
                    color: 'rgba(75, 192, 192, .7)',
                    line: {
                        color: 'rgba(75, 192, 192, 1)',
                        width: 1.5
                    }
                }
            };
        }
        formattedData1[year].x.push(item.date);
        formattedData1[year].y.push(item.count);
    });

    // Convert formatted data to an array
    var plotData1 = [];
    for (var key in formattedData1) {
        if (formattedData1.hasOwnProperty(key)) {
            plotData.push(formattedData1[key]);
        }
    }


    var formattedData2 = [];
    jsonData2.forEach(function(item) {
        var year = item.date.substring(0, 4);
        if (!formattedData2[year]) {
            formattedData2[year] = {
                x: [],
                y: [],
                type: 'bar',
                name: 'Failed' + ' ' + year,
                textposition: 'auto',
                marker: {
                    color: 'rgba(219, 52, 77, .7)',
                    line: {
                        color: 'rgba(255, 99, 132, 1)',
                        width: 1.5
                    }
                }
            };
        }
        formattedData2[year].x.push(item.date);
        formattedData2[year].y.push(item.count);
    });

    // Convert formatted data to an array
    var plotData2 = [];
    for (var key in formattedData2) {
        if (formattedData2.hasOwnProperty(key)) {
            plotData.push(formattedData2[key]);
        }
    }
    plotData.forEach(function(trace) {
        var textLabels = trace.y.map(function(value, index) {
            return value.toString(); // Add the label prefix if desired
        });
        trace.text = textLabels;
        trace.textposition = 'auto'; // Position the text labels automatically
    });
    const d = new Date();
    let year = d.getFullYear();
    let month = d.getMonth();
    let year1 = year + 1;
    // console.log(month + 1)
    var lastday = function(y, m) {
        return new Date(y, m + 1, 0).getDate();
    }
    // Assuming you have the minimum and maximum dates available in your data
    var minDate = year + '-01-01'; // Minimum date in your data
    var maxDate = year + '-12-31'; // Maximum date in your data

    // Calculate the desired start and end dates for the range
    var startDate = minDate; // Set the desired start date
    var endDate = maxDate; // Set the desired end date
    var layout = {
        barmode: 'group',
        title: 'Year ' + year + ' Applicant Exam Report',
        xaxis: {
            range: [startDate, endDate] // Set the desired range
        }
    };
    // var layout = {
    // };

    Plotly.newPlot('chart', plotData, layout, {
        displaylogo: false,
        responsive: true,
        scrollZoom: true
    });
</script>



<!-- Page specific script -->
<!-- <script>
    $(function() {
        var pass = <?php echo $encodedpassed; ?>;
        console.log(pass)
        var fail = <?php echo $encodedfailed; ?>;
        var all = <?php echo $encodedall; ?>;
        var xValue = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        var yValue = fail;
        var yValue2 = pass;
        var yValue3 = all;

        var trace1 = {
            x: xValue,
            y: yValue,
            type: 'bar',
            name: 'Failed',
            text: yValue.map(String),
            textposition: 'auto',
            hoverinfo: 'none',
            opacity: 1,
            marker: {
                color: 'rgba(219, 52, 77, .7)',
                line: {
                    color: 'rgba(255, 99, 132, 1)',
                    width: 1.5
                }
            }
        };

        var trace2 = {
            x: xValue,
            y: yValue2,
            type: 'bar',
            name: 'Passed',
            text: yValue2.map(String),
            textposition: 'auto',
            hoverinfo: 'none',
            marker: {
                color: 'rgba(75, 192, 192, .7)',
                line: {
                    color: 'rgba(75, 192, 192, 1)',
                    width: 1.5
                }
            }
        };
        var trace3 = {
            x: xValue,
            y: yValue3,
            type: 'bar',
            name: 'Total Examinees',
            text: yValue3.map(String),
            textposition: 'auto',
            hoverinfo: 'none',
            marker: {
                color: 'rgba(54, 162, 235, .7)',
                line: {
                    color: 'rgba(54, 162, 235, 1)',
                    width: 1.5
                }
            }
        };

        var data = [trace1, trace2, trace3];
        const d = new Date();
        let year = d.getFullYear();
        var layout = {
            title: 'Year ' + year + ' Applicant Exam Report'
        };

        Plotly.newPlot('myDiv', data, layout);




    })
</script> -->