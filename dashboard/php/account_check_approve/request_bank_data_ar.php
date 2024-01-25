<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_data_bank = "
SELECT
	  'consignee' as bill_type,
    cb.ID as id_number,
	  cb.bank_abb,
    cb.bank_number,
    cb.consignee_id bank_id
FROM
    consignee_bank cb
";


$result = $con->query($sql_data_bank);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bank_data[] = $row;
    // $bank_carrier_id = $row['carrier_id'];
  }
    foreach($bank_data as $k => $v){
      $arr_data_bank[$v['bank_id']][] = $v;
    }
  
} else {
  $bank_data = "0 results";
}


echo json_encode(array('bank_data' => $arr_data_bank));



?>