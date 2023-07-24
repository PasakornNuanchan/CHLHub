<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$data = $_POST['data'];

$sql_query_data = "
DELETE
FROM
    `cash_pay`
WHERE
    ID = '$data'
";

$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));


?>