<?php

require_once('./config.php');

$badge = $_GET['q'];

// Fetch records from database 
$qry = $conn->query("SELECT * FROM `position` WHERE id = '" . $badge . "'");
$hint = "";
if ($qry->num_rows > 0) {
  // Output each row of the data 
  while ($row = $qry->fetch_assoc()) {
    $hint = $row['job_desc'];
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No position available" : $hint;
