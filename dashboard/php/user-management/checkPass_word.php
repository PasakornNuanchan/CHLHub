<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$inp_old_password = isset($_POST['inp_old_password']) ? $_POST['inp_old_password'] : '';
$id_number = isset($_POST['id_number']) ? $_POST['id_number'] : '';


$sql_check_password = "
SELECT
    ID
FROM
    USER
WHERE
    ID = '$id_number' AND sec_user_pass = '$inp_old_password'
";

$result = $con->query($sql_check_password);
if ($result->num_rows != 0) {
    $res_in_status = '1';
} else {
    $res_in_status = '0';
}
echo json_encode($res_in_status);
