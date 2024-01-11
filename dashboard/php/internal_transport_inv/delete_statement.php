<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_id_number = isset($_POST['data_id_number']) ? $_POST['data_id_number'] : '';
$sql_data_set = "DELETE FROM `transport_statement` WHERE ID = '$data_id_number'";
// echo $sql_data_set;
$result = $con->query($sql_data_set);
if ($result->num_rows == 0) {
    $arr_res_ap = '1';
} else {
    $arr_res_ap = '0';
}


echo json_encode($arr_res_ap);
