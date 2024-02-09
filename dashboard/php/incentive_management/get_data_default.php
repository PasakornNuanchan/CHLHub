<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_request_data_sale = "
SELECT
    `ID`,
    `first_name`,
    `last_name`,
    `brunch`
FROM
    `user`
WHERE
    department_number IN ('6','22')
";

$sql_request_data_client = "
SELECT
    `ID`,
    `consignee_name`
FROM
    `consignee`
";



$result = $con->query($sql_request_data_sale);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $sale[] = $row;
  }
} else {
  $sale = "0 results";
}

$result = $con->query($sql_request_data_client);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $client[] = $row;
  }
} else {
  $client = "0 results";
}

echo json_encode(array('sale'=>$sale,'client'=>$client));
?>