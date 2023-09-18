<?php

include '../../core/conn.php';
$full_my = $_POST['full_my'];

$sql_query_data = "
SELECT job_number FROM job_title WHERE job_number LIKE '%$full_my%' ORDER BY ID DESC LIMIT 1
";

$result = $con->query($sql_query_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_job = $row['job_number'];
  }
} else {
  $data_job = "0 results";
}

echo json_encode($data_job);
?>