<?php

include '../../core/conn.php';


$data_detail_arr = $_POST['data_detail_arr'];
$table_detail_arr = $_POST['table_detail_arr'];
$table_container_bl_arr = $_POST['table_container_bl_arr'];

$table_fright_bl_arr = $_POST['table_fright_bl_arr'];
$arr_fright_delete = $_POST['arr_fright_delete'];

if ($arr_fright_delete != '') {
    foreach ($arr_fright_delete as $k => $v) {
        $data_id = isset($v['data_id']) ? $v['data_id'] : '';
        $sql_query_delete_fright = "
        DELETE
        FROM
            `fright_bl`
        WHERE
            `ID` = '$data_id'
        ";
        $con->query($sql_query_delete_fright);
    }
}


foreach ($data_detail_arr as $k => $v) {
    $bl_data =  isset($v['bl_data']) ? $v['bl_data'] : '';
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $notify = isset($v['notify']) ? $v['notify'] : '';
    $carriage = isset($v['carriage']) ? $v['carriage'] : '';
    $bill_header = isset($v['bill_header']) ? $v['bill_header'] : '';
    $delivery_agent = isset($v['delivery_agent']) ? $v['delivery_agent'] : '';
    $shipper_on_board =  $v['shipper_on_board'];
    $on_board_date = $v['on_board_date'];
    $bl_number = isset($v['bl_number']) ? $v['bl_number'] : '';
    $shipper_bl = isset($v['shipper_bl']) ? $v['shipper_bl'] : '';
    $consignee_bl = isset($v['consignee_bl']) ? $v['consignee_bl'] : '';
    $des_of_god = isset($v['des_of_god']) ? $v['des_of_god'] : '';
    $final_destination = isset($v['final_destination']) ? $v['final_destination'] : '';
    $data_place = isset($v['data_place']) ? $v['data_place'] : '';
    $payble_at = isset($v['payble_at']) ? $v['payble_at'] : '';
    $sel_frieght = isset($v['sel_frieght']) ? $v['sel_frieght'] : '';
    $data_container_all = isset($v['data_container_all']) ? $v['data_container_all'] : '';
    $shipper_on_board = $shipper_on_board ? "'" . $shipper_on_board . "'" : 'NULL';
    $on_board_date = $on_board_date ? "'" . $on_board_date . "'" : 'NULL';

    $sql_query_detail_title = "
    UPDATE
        `bl_title`
    SET
        `notify_party` = '$notify',
        `pre_carriage` = '$carriage',
        `bill_header` = '$bill_header',
        `delivery_agent` = '$delivery_agent',
        `shipper_on_board` = $shipper_on_board,
        `on_board_date` = $on_board_date,
        `bl_number` = '$bl_number',
        `shipper_bl`='$shipper_bl',
        `consignee_bl`='$consignee_bl',
        `description_of_good` = '$des_of_god',
        `final_destination`= '$final_destination',
        `place` = '$data_place',
        `payble_at` = '$payble_at',
        `fright_c_on` = '$sel_frieght',
        `container_in_bl` = '$data_container_all'
    WHERE
        ID = '$bl_data'
    ";

    //echo $sql_query_detail_title;
    $result = $con->query($sql_query_detail_title);
    if ($result->num_rows == 0) {
        $arr_save_detail = '1';
    } else {
        $arr_save_detail = '0';
    }
}

foreach ($table_detail_arr as $k => $v) {
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $container_no_and_seal = isset($v['container_no_and_seal']) ? $v['container_no_and_seal'] : '';
    $container_or_package = isset($v['container_or_package']) ? $v['container_or_package'] : '';
    $package_unit = isset($v['package_unit']) ? $v['package_unit'] : '';
    $kind_of_package = isset($v['kind_of_package']) ? $v['kind_of_package'] : '';
    $gross_Weight = isset($v['gross_Weight']) ? $v['gross_Weight'] : '';
    $gross_weight_unit = isset($v['gross_weight_unit']) ? $v['gross_weight_unit'] : '';
    $mesurement = isset($v['mesurement']) ? $v['mesurement'] : '';
    $mesurement_unit = isset($v['mesurement_unit']) ? $v['mesurement_unit'] : '';
    $id_row = isset($v['id_row']) ? $v['id_row'] : '';
    $id_bl = isset($v['id_bl']) ? $v['id_bl'] : '';


    if ($id_row == '') {
        $sql_query_table_list = "
    INSERT INTO `bl_list`(
        `ref_job_id`,
        `container_no`,
        `package`,
        `package_unit`,
        `kind_of_package`,
        `gross_weight`,
        `gross_weight_unit`,
        `measurement`,
        `cbm_unit`,
        `bl_title_id`
    )
    VALUES(
        '$id_number',
        '$container_no_and_seal',
        '$package_unit',
        '$container_or_package',
        '$kind_of_package',
        '$gross_Weight',
        '$gross_weight_unit',
        '$mesurement',
        '$mesurement_unit',
        '$id_bl'
    )
    ";
    } else {
        $sql_query_table_list = "
    UPDATE
        `bl_list`
    SET
        `ref_job_id` = '$id_number',
        `container_no` = '$container_no_and_seal',
        `package` = '$container_or_package',
        `package_unit` = '$package_unit',
        `kind_of_package` = '$kind_of_package',
        `gross_weight` = '$gross_Weight',
        `gross_weight_unit` = '$gross_weight_unit',
        `measurement` = '$mesurement',
        `cbm_unit` = '$mesurement_unit'
    WHERE
        `ID` = '$id_row'
    ";
    }

    //echo $sql_query_table_list;
    $result = $con->query($sql_query_table_list);
    if ($result->num_rows == 0) {
        $arr_save_list = '1';
    } else {
        $arr_save_list = '0';
    }
}





foreach ($table_container_bl_arr as $k => $v) {

    $id_number = isset($v['id_container']) ? $v['id_container'] : '';
    $quantity_bl = isset($v['quantity_bl']) ? $v['quantity_bl'] : '';
    $unit_bl = isset($v['unit_bl']) ? $v['unit_bl'] : '';
    $cbm_bl = $v['cbm_bl'];
    $weight_bl = isset($v['weight']) ? $v['weight'] : '';

    $cbm_bl = $cbm_bl == '' ? "NULL" : "'" . $cbm_bl . "'";
    $weight_bl = $weight_bl == '' ? "NULL" : "'" . $weight_bl . "'";
    $quantity_bl = $quantity_bl == '' ? "NULL" : "'" . $quantity_bl . "'";

    $sql_query_container = "
    UPDATE
        `container`
    SET
        `volume` = $cbm_bl,
        `package` = $quantity_bl,
        `gw` = $weight_bl,
        `unit` = '$unit_bl'
    WHERE
        ID = '$id_number'
    ";
    //echo $sql_query_container;
    $result = $con->query($sql_query_container);
    if ($result->num_rows == 0) {
        $arr_save_container = '1';
    } else {
        $arr_save_container = '0';
    }
}

echo json_encode(array('arr_save_detail' => $arr_save_detail, 'arr_save_list' => $arr_save_list, 'arr_save_container' => $arr_save_container));
