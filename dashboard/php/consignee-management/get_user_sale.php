<?php 
include '../../core/conn.php';

$sql = "
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
ORDER BY
	first_name ASC
";

$result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $user_sale[] = $row;
      }
    } else {
      $user_sale = "0 results";
    }


echo json_encode(array('user_sale'=>$user_sale));
?>