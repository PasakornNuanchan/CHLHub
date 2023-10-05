<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
$arr_data_delete = $_POST['arr_data_delete'];

foreach($arr_data_delete as $k => $v){
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $sql_query_delete = "
    DELETE
    FROM
        `acbank`
    WHERE
        ID = '$id_number'
    ";
    $result = $con->query($sql_query_delete);
    if ($result->num_rows == 0) {
        $arr_res_del = '1';
    } else {
        $arr_res_del = '0';
    }
}
echo json_encode(array('arr_res_del'=>$arr_res_del))

?>