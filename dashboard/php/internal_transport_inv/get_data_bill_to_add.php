<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_bill_to = "
SELECT
    `ID`,
    `corp_name`,
    `tax_id`,
    `address`
FROM
    `internal_transport_payto`
WHERE
    1
";
// echo $sql_data_set;
$result = $con->query($sql_bill_to);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bill_to[] = $row;
  }
} else {
  $bill_to = "0 results";
}


echo json_encode(array('bill_to'=>$bill_to));
