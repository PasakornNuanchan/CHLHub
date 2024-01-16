<?php 
include '../../core/conn.php';

$consignee_number = $_POST['consignee_number'];

$sql = "
SELECT
    `ID`,
    `sec_username`,
    `sec_password`,
    `status_u`,
    `forgot_pin`,
    `corp_id`
FROM
    `user_cus`
WHERE
    corp_id = '$consignee_number'
";



$result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $user_data_consignee[] = $row;
      }
    } else {
      $user_data_consignee = "0 results";
    }


echo json_encode(array('user_data_consignee'=>$user_data_consignee));
?>