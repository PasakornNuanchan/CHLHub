<?php
include '../../core/conn.php';

$carrier_number = $_POST['carrier_number'];

$sql_request_raw_carrier = "
SELECT * FROM carrier WHERE ID = '$carrier_number'";
$sql_request_carrier_bank = " 
    SELECT
    `ID`,
    `bank_abb`,
    `company_name`,
    `company_address`,
    `bank_number`,
    `bank_account`,
    `bank_swift_code`,
    `bank_code`,
    `country`,
    `tax_number`,
    `commercial_number`,
    `carrier_id`
FROM
    `carrier_bank`
WHERE
    carrier_id = '$carrier_number'";


$result = $con->query($sql_request_raw_carrier);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $sqrc = $row;
  }
} else {
  $sqrc = "0 results";
}

$result = $con->query($sql_request_carrier_bank);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bank[] = $row;
  }
} else {
  $bank = "0 results";
}


echo json_encode(array('sqrc' => $sqrc, 'bank' => $bank));
