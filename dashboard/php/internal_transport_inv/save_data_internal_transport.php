<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$job_number_add = isset($_POST['job_number_add']) ? $_POST['job_number_add'] : '';
$description_add = isset($_POST['description_add']) ? $_POST['description_add'] : '';
$bill_to_add = isset($_POST['bill_to_add']) ? $_POST['bill_to_add'] : '';
$qty_add = isset($_POST['qty_add']) ? $_POST['qty_add'] : '';
$unit_price_add = isset($_POST['unit_price_add']) ? $_POST['unit_price_add'] : '';
$vat_add = isset($_POST['vat_add']) ? $_POST['vat_add'] : '';
$total_add = isset($_POST['total_add']) ? $_POST['total_add'] : '';
$remark_add = isset($_POST['remark_add']) ? $_POST['remark_add'] : '';
$currency = isset($_POST['currency']) ? $_POST['currency'] : '';
$type_data = isset($_POST['type_data']) ? $_POST['type_data'] : '';
$name_file = isset($_POST['name_file']) ? $_POST['name_file'] : '';
$Base_64_file_base = isset($_POST['Base_64_file_base']) ? $_POST['Base_64_file_base'] : '';






$sql_data_set = "
        INSERT INTO `transport_statement`(
            `ref_job_id`,
            `description`,
            `pay_to`,
            `qty`,
            `price`,
            `vat`,
            `total`,
            `currency`,
            `receipt`,
            `type_file`,
            `name_file`,        
            `remark`,
            `create_by`,
            `create_datetime`
        )
        VALUES(
            '$job_number_add',
            '$description_add',
            '$bill_to_add',
            '$qty_add',
            '$unit_price_add',
            '$vat_add',
            '$total_add',
            '$currency',
            '$Base_64_file_base',
            '$type_data',
            '$name_file',    
            '$remark_add',
            '$data_user',
            '$t_time_save'
        )
        ";



// echo $sql_data_set;
$result = $con->query($sql_data_set);
if ($result->num_rows == 0) {
    $arr_res_ap = '1';
} else {
    $arr_res_ap = '0';
}


echo json_encode($arr_res_ap);
