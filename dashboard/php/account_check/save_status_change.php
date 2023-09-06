<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$id_row = $_POST['id_row'];
$status_data = $_POST['status_data'];
$amt_incv = $_POST['amt_incv'];
$remark = $_POST['remark'];

$id_row = isset($id_row) ? $id_row : '';
$status_data = isset($status_data) ? $status_data : '';
$amt_incv = isset($amt_incv) ? $amt_incv : '';
$remark = isset($remark) ? $remark : '';


$sql_query_data = "
UPDATE
    `billing`
SET
    `action_paid_by` = '$data_user',
    `action_paid_date_time` = '$t_time_save',
    `status` = '$status_data',
    `paid_amt` = '$amt_incv',
    `remark` = '$remark'
WHERE
    ID = '$id_row'
";


$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);
?>

