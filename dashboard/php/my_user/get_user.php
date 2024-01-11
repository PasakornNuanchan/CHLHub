<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_get_user = "
SELECT
    `ID`,
    `user_number`,
    `first_name`,
    `last_name`,
    `address`,
    `mobile_number`,
    `email`,
    `country_number`,
    `city_number`,
    `sec_user_id`,
    `sec_user_pass`,
    `pincode_forgot`,
    `pictrue`,
    `status_user`,
    `department_number`,
    `bank_number`,
    `bank_name`,
    `brunch`
FROM
    `user`
WHERE
    ID = '$data_user'
";

$result = $con->query($sql_get_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_user[] = $row;
  }
} else {
  $get_user = "0 results";
}

echo json_encode(array('get_user'=>$get_user))

?>