<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data_id = $_POST['data_id'];
$checked_data = $_POST['checked_data'];
$sql_query_data = "
        UPDATE
            `billing`
        SET
            `pre_approve_by` = '$data_user',
            `pre_approve_dt` = '$t_time_save',
            `pre_approve_status` = '$checked_data'
        WHERE
        ID = '$data_id';
    ";

$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $res_arr = '1';
} else {
    $res_arr = '0';
}

echo json_encode((array('res_arr' => $res_arr)))
?>