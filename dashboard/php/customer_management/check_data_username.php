<?php
include '../../core/conn.php';
$username = $_POST['username'] ? $_POST['username'] : '';

$sql ="
SELECT
    `sec_username`
FROM
    `user_cus`
WHERE
    sec_username = '$username'
";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    $data_check = "1";
} else {
    $data_check = "0";
}

echo json_encode(array('data_check'=>$data_check))
?>