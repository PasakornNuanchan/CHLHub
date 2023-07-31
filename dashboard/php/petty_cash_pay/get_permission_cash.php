<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$sql_data_cash_permission = "
SELECT
  pmc.ID,
  pmc.department,
  pmc.payble,
  pmc.advance,
  pmc.pettycash,
  pmc.returnpettycash
FROM
    user u
LEFT JOIN permission_cash pmc ON u.department_number = pmc.department
WHERE
    u.ID = '$data_user'
";

$result = $con->query($sql_data_cash_permission);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_permission = $row;
  }
} else {
  $data_permission = "0 results";
}

echo json_encode(array('data_permission'=>$data_permission))
?>