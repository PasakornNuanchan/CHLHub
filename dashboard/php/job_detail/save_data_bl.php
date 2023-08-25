<?php

include '../../core/conn.php';


$data_detail_arr = $_POST['data_detail_arr'];
$table_detail_arr = $_POST['table_detail_arr'];
$table_container_bl_arr = $_POST['table_container_bl_arr'];





foreach($data_detail_arr as $k => $v){
$id_number = isset($v['id_number']) ? $v['id_number'] : '';
$notify = isset($v['notify']) ? $v['notify'] : '';
$carriage = isset($v['carriage']) ? $v['carriage'] : '';
$bill_header = isset($v['bill_header']) ? $v['bill_header'] : '';
$delivery_agent = isset($v['delivery_agent']) ? $v['delivery_agent'] : '';
$shipper_on_board =  $v['shipper_on_board'];
$bl_number = isset($v['bl_number']) ? $v['bl_number'] :'';
$shipper_bl = isset($v['shipper_bl']) ? $v['shipper_bl'] : '';
$consignee_bl = isset($v['consignee_bl']) ? $v['consignee_bl'] : '';
$des_of_god = isset($v['des_of_god']) ? $v['des_of_god'] : '';




$sql_data = "
SELECT
    *
FROM
    `bl_title`
WHERE
    ref_job_id = '$id_number'
";

$result = $con->query($sql_data);
if ($result->num_rows > 0) {
  $cs_data = "1";
} else {
  $cs_data = "0";
}


if($shipper_on_board !== ''){
    $shipper_on_board = "'".$shipper_on_board."'";
}else{
    $shipper_on_board = "NULL";
}

if($cs_data == "1"){
    $sql_query_detail_title = "
    UPDATE
        `bl_title`
    SET
        `notify_party` = '$notify',
        `pre_carriage` = '$carriage',
        `bill_header` = '$bill_header',
        `delivery_agent` = '$delivery_agent',
        `shipper_on_board` = $shipper_on_board,
        `bl_number` = '$bl_number',
        `shipper_bl`='$shipper_bl',
        `consignee_bl`='$consignee_bl',
        `description_of_good` = '$des_of_god'
    WHERE
        ref_job_id = '$id_number'
    ";
    
       
}else{
    $sql_query_detail_title = "
    INSERT INTO `bl_title`(
        `ref_job_id`,
        `notify_party`,
        `pre_carriage`,
        `bill_header`,
        `delivery_agent`,
        `shipper_on_board`,
        `bl_number`,
        `shipper_bl`,
        `consignee_bl`,
        `description_of_good`
    )
    VALUES(
        '$id_number',
        '$notify',
        '$carriage',
        '$bill_header',
        '$delivery_agent',
        $shipper_on_board,
        '$bl_number',
        '$shipper_bl',
        '$consignee_bl',
        '$des_of_god'
    )
    ";
}

//echo $sql_query_detail_title;
$result = $con->query($sql_query_detail_title);
if ($result->num_rows == 0) {
    $arr_save_detail = '1';
} else {
    $arr_save_detail = '0';
}


}

foreach($table_detail_arr as $k => $v){
$id_number = isset($v['id_number']) ? $v['id_number'] : '';
$container_no_and_seal = isset($v['container_no_and_seal']) ? $v['container_no_and_seal'] : '';
$container_or_package = isset($v['container_or_package']) ? $v['container_or_package'] : '';
$kind_of_package = isset($v['kind_of_package']) ? $v['kind_of_package'] : '';
$gross_Weight = isset($v['gross_Weight']) ? $v['gross_Weight'] : '';
$mesurement = isset($v['mesurement']) ? $v['mesurement'] : '';
$id_row = isset($v['id_row']) ? $v['id_row'] : '';

if($id_row == ''){
    $sql_query_table_list = "
    INSERT INTO `bl_list`(
        `ref_job_id`,
        `container_no`,
        `package`,
        `kind_of_package`,
        `gross_weight`,
        `measurement`
    )
    VALUES(
        '$id_number',
        '$container_no_and_seal',
        '$container_or_package',
        '$kind_of_package',
        '$gross_Weight',
        '$mesurement'
    )
    ";
}else{
    $sql_query_table_list = "
    UPDATE
        `bl_list`
    SET
        `ref_job_id` = '$id_number',
        `container_no` = '$container_no_and_seal',
        `package` = '$container_or_package',
        `kind_of_package` = '$kind_of_package',
        `gross_weight` = '$gross_Weight',
        `measurement` = '$mesurement'
    WHERE
        `ID` = '$id_row'
    ";
}

$result = $con->query($sql_query_table_list);
    if ($result->num_rows == 0) {
        $arr_save_list = '1';
    } else {
        $arr_save_list = '0';
    }
}





foreach($table_container_bl_arr as $k =>$v){

$id_number = isset($v['id_container']) ? $v['id_container'] : '';
$quantity_bl = isset($v['quantity_bl']) ? $v['quantity_bl'] : '';
$unit_bl = isset($v['unit_bl']) ? $v['unit_bl'] : '';
$cbm_bl = $v['cbm_bl'];
$weight_bl = isset($v['weight']) ? $v['weight'] : '';

$cbm_bl = $cbm_bl == '' ? "NULL" : "'".$cbm_bl."'";
$weight_bl = $weight_bl == '' ? "NULL" : "'".$weight_bl."'";
$quantity_bl = $quantity_bl == '' ? "NULL" : "'".$quantity_bl."'";

$sql_query_container = "
UPDATE
    `container`
SET
    `cbm` = $cbm_bl,
    `quantity` = $quantity_bl,
    `gw` = $weight_bl,
    `unit` = '$unit_bl'
WHERE
    ID = '$id_number'
";

$result = $con->query($sql_query_container);
    if ($result->num_rows == 0) {
        $arr_save_container = '1';
    } else {
        $arr_save_container = '0';
    }
}

echo json_encode(array('arr_save_detail'=>$arr_save_detail,'arr_save_list'=>$arr_save_list,'arr_save_container'=>$arr_save_container));
