<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';


$arr_data = $_POST['arr_data'];

foreach($arr_data as $k => $v){

    $type_file = isset($v['type_file']) ? $v['type_file'] : '';
    $file = isset($v['file']) ? $v['file'] : '';
    $job_number = isset($v['job_number']) ? $v['job_number'] : '';
    $description = isset($v['description']) ? $v['description'] : '';
    $payto = isset($v['payto']) ? $v['payto'] : '';
    $qty = isset($v['qty']) ? $v['qty'] : '';
    $price = isset($v['price']) ? $v['price'] : '';
    $vat = isset($v['vat']) ? $v['vat'] : '';
    $total = isset($v['total']) ? $v['total'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $remark = isset($v['remark']) ? $v['remark'] : '';
    $operation = isset($v['operation']) ? $v['operation'] : '';
    $plate = isset($v['plate']) ? $v['plate'] : '';


    $sql_query_data = "
    INSERT INTO `transport_statement`(
        `ref_job_id`,
        `description`,
        `pay_to`,
        `qty`,
        `price`,
        `vat`,
        `currency`,
        `receipt`,
        `type_file`,
        `remark`,
        `opertaion_date`,
        `truck_number`
    )
    VALUES(
        '$job_number',
        '$description',
        '$payto',
        '$qty',
        '$price',
        '$vat',
        '$currency',
        '$file',
        '$type_file',
        '$remark',
        '$operation',
        '$plate'
    )
    ";

    if ($con->query($sql_query_data) === TRUE) {
        $arr_results = '1';
    } else {
        $arr_results = '0';
    }

}

echo json_encode(array('arr_results'=>$arr_results))


?>