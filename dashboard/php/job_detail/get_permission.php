<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$sql_data_user_permission = "
SELECT
    u.department_number,
    u.ID,
    pjd.job_detail,
    pjd.transport,
    pjd.reportcs,
    pjd.customs,
    pjd.billing,
    pjd.withdraw
FROM
    user u
LEFT JOIN permisson_job_detail pjd ON u.department_number = pjd.department
WHERE
    u.ID = '$data_user'
";


$result = $con->query($sql_data_user_permission);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_permission = $row;
  }
} else {
  $data_permission = "0 results";
}

echo json_encode(array('data_permission'=>$data_permission))
?>