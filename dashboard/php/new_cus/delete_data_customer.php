<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';

$data = $_POST['data'];

$sql = "
    DELETE
    FROM
        `new_quest_cus`
    WHERE
        ID = '$data'
";

if($con->query($sql) != 1){
    $arr_suc = '0';
} else {
    $arr_suc = '1';
};

echo json_encode($arr_suc);

