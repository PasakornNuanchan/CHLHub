<?php
include '../../core/conn.php';


$data = $_POST['data'];
$sql = "
SELECT
    `ID`,
    `sec_username`,
    `sec_password`,
    `email`,
    `phone_number`,
    `name`,
    `sur_name`,
    `status_u`,
    `forgot_pin`,
    `corp_id`
FROM
    `user_cus`
WHERE
    ID = '$data'
"; 

$result = $con -> query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data_raw = $row;
    }
} else {
    $data_raw = "0 results";
}

echo json_encode(array('data_raw'=>$data_raw))
?>