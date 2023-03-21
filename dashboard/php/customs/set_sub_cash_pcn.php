<?php
$job_number = $_POST['job_number'];
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';


$sql_sel_pcn = "
SELECT
    pcd.ID,
    pcd.petty_cash_number
FROM
    `petty_cash_detail` as pcd
LEFT JOIN petty_cash_title as pct ON pcd.petty_cash_number = pct.petty_cash_number
WHERE
    pcd.job_number = '$job_number' AND pct.request_by = '$data_user' AND pcd.pcd_status = '0'

    ";

$result = $con->query($sql_sel_pcn);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pcn[] = $row;
  }
} else {
  $pcn = "0 results";
}




     echo json_encode(array('pcn'=>$pcn));
?>