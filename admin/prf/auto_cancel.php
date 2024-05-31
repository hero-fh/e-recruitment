<?php
$threshold = date('Y-m-d', strtotime('-1 month')); // Get the date for 1 year ago

// Prepare and execute the query
$stmt = $conn->query("UPDATE prf_request set prf_status = 4,prf_hold=0 WHERE date_hold <= '$threshold'");
