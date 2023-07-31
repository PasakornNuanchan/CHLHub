<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$sql_data_user_permission = "
SELECT
    pjd.job_detail
FROM
    user u
LEFT JOIN permisson_job_detail pjd ON u.department_number = pjd.department
WHERE
    u.ID = '$data_user'
";

$result = $con->query($sql_data_user_permission);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_detail = $row['job_detail'];
  }
} else {
  $job_detail = "0 results";
}

echo json_encode(array('permis'=>$job_detail))
?>