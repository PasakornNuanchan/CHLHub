<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_request_data_user = "
SELECT
	  u.ID,
    u.first_name,
    u.last_name,
    u.brunch,
    (SELECT d.department_name FROM department d WHERE u.department_number = d.ID) as department,
    (SELECT im.percentage FROM incentive_management im WHERE im.user_id = u.ID) as incetive_per,
    (SELECT im.ID FROM incentive_management im WHERE im.user_id = u.ID) as id_incen
FROM
    user u
WHERE
    1
";




$result = $con->query($sql_request_data_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $user_data_modal[] = $row;
  }
} else {
  $user_data_modal = "0 results";
}


echo json_encode(array('user_data_modal' => $user_data_modal));
