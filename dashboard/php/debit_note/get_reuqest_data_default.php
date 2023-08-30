<?php
include '../../core/conn.php';


$sql_data_bill_to = "
SELECT 
1 as type_data,
gc.ID as data_id, 
gc.name as name_data
FROM Goverment_contact gc
UNION
SELECT
2 as type_data,
c.ID as data_id,
c.carrier_name as name_data
FROM carrier c 
";


$result = $con->query($sql_data_bill_to);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_bill_to[] = $row;
  }
} else {
  $data_bill_to = "0 results";
}

$sql_data_user = "
SELECT 
u.ID,
u.first_name,
u.last_name
FROM `user` u WHERE u.department_number = '4'
";

$result = $con->query($sql_data_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_user_cs[] = $row;
  }
} else {
  $data_user_cs = "0 results";
}



echo json_encode(array('data_bill_to'=>$data_bill_to,'data_user_cs'=>$data_user_cs))
?>