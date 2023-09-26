<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_job_number = "
SELECT 
    jt.ID,
    jt.job_number,
    c.consignee_name
FROM job_title jt
LEFT JOIN consignee c ON c.ID = jt.consignee_number
ORDER BY ID DESC
LIMIT 100 
";

$sql_query_description = "
SELECT
    `ID`,
    `description_name`
FROM
    `internal_transport_description`
WHERE
    1
";

$sql_query_plate = "
SELECT
    `ID`,
    `plate`
FROM
    `internal_transport_truck_number`
WHERE
    1
";

$sql_query_payto = "
SELECT
    `ID`,
    `corp_name`
FROM
    `internal_transport_payto`
WHERE
    1
";

$result = $con->query($sql_query_job_number);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_number[] = $row;
  }
} else {
  $job_number = "0 results";
}

$result = $con->query($sql_query_description);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $description[] = $row;
  }
} else {
  $description = "0 results";
}

$result = $con->query($sql_query_plate);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $plate[] = $row;
  }
} else {
  $plate = "0 results";
}

$result = $con->query($sql_query_payto);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pay_to[] = $row;
  }
} else {
  $pay_to = "0 results";
}


echo json_encode(array('job_number'=>$job_number,'description'=>$description,'plate'=>$plate,'pay_to'=>$pay_to))
?>