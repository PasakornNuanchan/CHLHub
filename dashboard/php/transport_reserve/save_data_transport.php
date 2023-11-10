<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data_id_number = isset($_POST['data_id_number']) ? $_POST['data_id_number'] : '';
$data_supplier_name = isset($_POST['data_supplier_name']) ? $_POST['data_supplier_name'] : '';


$sql_query_data_hbl = "
UPDATE
    `transport_booking`
SET
    `sup_number` = '$data_supplier_name' 
WHERE
    ID = '$data_id_number'
";

$result = $con->query($sql_query_data_hbl);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);

?>