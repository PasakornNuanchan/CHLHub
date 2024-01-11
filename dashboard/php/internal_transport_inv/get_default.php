<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_request_job_number = "
SELECT 
    jt.ID,
    jt.job_number,
    c.consignee_name
FROM
    job_title jt
LEFT JOIN consignee c ON jt.consignee_number = c.ID
";

$sql_request_bill_to_internal = "
SELECT
    `ID`,
    `corp_name`
FROM
    `internal_transport_payto`
WHERE
    1
";

$sql_request_description = "
SELECT
    `ID`,
    `description_name`
FROM
    `internal_transport_description`
WHERE
    1
";


$result = $con->query($sql_request_job_number);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_number[] = $row;
  }
} else {
  $job_number = "0 results";
}

$result = $con->query($sql_request_bill_to_internal);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bill_to[] = $row;
  }
} else {
  $bill_to = "0 results";
}

$result = $con->query($sql_request_description);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $description[] = $row;
  }
} else {
  $description = "0 results";
}



echo json_encode(array('job_number'=>$job_number,'bill_to'=>$bill_to,'description'=>$description));
// ?>