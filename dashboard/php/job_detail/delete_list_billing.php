<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$delete_list = $_POST['id_number'];

$sql_query_data = "
DELETE FROM `billing` WHERE ID = '$delete_list'
";

$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));


?>