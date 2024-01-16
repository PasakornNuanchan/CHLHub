<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_data_bank = "
SELECT
	'CARRIER' as bill_type,
    car.ID as id_number,
	car.bank_abb,
    car.bank_number,
    car.carrier_id
FROM
    carrier_bank car
";


$result = $con->query($sql_data_bank);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bank_data[] = $row;
  }
} else {
  $bank_data = "0 results";
}


echo json_encode(array('bank_data' => $bank_data));



?>