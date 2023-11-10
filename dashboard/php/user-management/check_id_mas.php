<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$inp_un = $_POST['inp_un'];


$sql_check_Id = "
SELECT
    ID
FROM
    USER
WHERE
    sec_user_id = '$inp_un'
";

$result = $con->query($sql_check_Id);
if ($result->num_rows == 0) {
    $res_in_status = '1';
} else {
    $res_in_status = '0';
}

echo json_encode($res_in_status);
?>
