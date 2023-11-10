<?php
include '../../core/conn.php';

$arr_delete_driver_transport = $_POST['arr_delete_driver_transport'];
$arr_delete_route_transport = $_POST['arr_delete_route_transport'];
$arr_transport_detail = $_POST['arr_transport_detail'];
$arr_driver_detail = $_POST['arr_driver_detail'];
$id_number = $_POST['id_number'];

    if($arr_delete_driver_transport == ''){
        $arr_delete_driver = '1';
    }else{
        foreach($arr_delete_driver_transport as $k => $v){
            $driver_id = isset($v['driver_id']) ? $v['driver_id'] : '';
            $sql_query_delete_driver = "
            DELETE FROM `transport_contact` WHERE ID = '$driver_id'";
            $result = $con->query($sql_query_delete_driver);
            if ($result->num_rows == 0) {
                $arr_delete_driver = '1';
            } else {
                $arr_delete_driver = '0';
            }
        }
    }

    if($arr_delete_route_transport == ''){
        $arr_data_delete_transport = '1';
    }else{
        foreach($arr_delete_route_transport as $k => $v){
            $route_id = isset($v['route_id']) ? $v['route_id'] : '';
            $sql_query_delete_driver = "
            DELETE FROM `transport_contact` WHERE route_id = '$route_id'";
            $sql_query_delete_transport = "
            DELETE FROM `transport_booking` WHERE ID = '$route_id'";
    
    
            $result_delete_driver = $con->query($sql_query_delete_driver);
            $result_delete_transport = $con->query($sql_query_delete_transport);
            
            if ($result_delete_driver->num_rows == 0 && $result_delete_transport->num_rows == 0) {
                $arr_data_delete_transport = '1';
            } else {
                $arr_data_delete_transport = '0';
            }
        }
    }
    

    foreach($arr_transport_detail as $k => $v){
        $transport_id = isset($v['transport_id']) ? $v['transport_id'] : '';
        $supplier_id = isset($v['supplier_id']) ? $v['supplier_id'] : '';
        $inp_peca = isset($v['inp_peca']) ? $v['inp_peca'] : '';
        $inp_pecar = isset($v['inp_pecar']) ? $v['inp_pecar'] : '';
        $inp_pca = isset($v['inp_pca']) ? $v['inp_pca'] : '';
        $inp_pcar = isset($v['inp_pcar']) ? $v['inp_pcar'] : '';
        $inp_doca = isset($v['inp_doca']) ? $v['inp_doca'] : '';
        $inp_docar = isset($v['inp_docar']) ? $v['inp_docar'] : '';
        $inp_deca = isset($v['inp_deca']) ? $v['inp_deca'] : '';
        $inp_decar = isset($v['inp_decar']) ? $v['inp_decar'] : '';
        $inp_ggpeca = isset($v['inp_ggpeca']) ? $v['inp_ggpeca'] : '';
        $inp_ggpca = isset($v['inp_ggpca']) ? $v['inp_ggpca'] : '';
        $inp_ggdoca = isset($v['inp_ggdoca']) ? $v['inp_ggdoca'] : '';
        $inp_ggdeca = isset($v['inp_ggdeca']) ? $v['inp_ggdeca'] : '';

        $text_conatiner_transport = isset($v['text_conatiner_transport']) ? $v['text_conatiner_transport'] : '';
        $text_hbl_transport = isset($v['text_hbl_transport']) ? $v['text_hbl_transport'] : '';



        $db_type_truck = isset($v['db_type_truck']) ? $v['db_type_truck'] : '';
        $inp_remark = isset($v['inp_remark']) ? $v['inp_remark'] : '';
        //$inp_quantity = isset($v['inp_quantity']) ? $v['inp_quantity'] : '';
        //$inp_bg = isset($v['inp_bg']) ? $v['inp_bg'] : '';
        $inp_cur = isset($v['inp_cur']) ? $v['inp_cur'] : '';

        $inp_quantity = $v['inp_quantity'];
        $inp_quantity = empty($inp_quantity) ? "NULL" : "'".$inp_quantity."'";
        $inp_bg = $v['inp_bg'];
        $inp_bg = empty($inp_bg) ? "NULL" : "'".$inp_bg."'";

        if($transport_id != ''){
            $sql_query_transport_detail = "
            UPDATE
                `transport_booking`
            SET
                `sup_number` = '$supplier_id',
                `truck_quantity` = $inp_quantity,
                `pick_con_empty_address` = '$inp_peca',
                `pick_con_empty_remark` = '$inp_pecar',
                `pick_con_address` = '$inp_pca',
                `pick_con_remark` = '$inp_pcar',
                `drop_con_address` = '$inp_doca',
                `drop_con_remark` = '$inp_docar',
                `drop_con_empty_address` = '$inp_deca',
                `drop_con_empty_remark` = '$inp_decar',
                `budget` = $inp_bg,
                `cur` = '$inp_cur',
                `type_truck` = '$db_type_truck',
                `remark` = '$inp_remark',
                `ggpick_con_empty_address` = '$inp_ggpeca',
                `ggpick_con_address` = '$inp_ggpca',
                `ggdrop_con_address` = '$inp_ggdoca',
                `ggdrop_con_empty_address` = '$inp_ggdeca',
                `container_assign` = '$text_conatiner_transport',
                `hbl_assign` = '$text_hbl_transport'
            WHERE
                `ID` = '$transport_id'
            ";
        }else{
            $sql_query_transport_detail = "
            INSERT INTO `transport_booking`(
                `sup_number`,
                `truck_quantity`,
                `pick_con_empty_address`,
                `pick_con_empty_remark`,
                `pick_con_address`,
                `pick_con_remark`,
                `drop_con_address`,
                `drop_con_remark`,
                `drop_con_empty_address`,
                `drop_con_empty_remark`,
                `budget`,
                `cur`,
                `type_truck`,
                `remark`,
                `ref_job_id`,
                `ggpick_con_empty_address`,
                `ggpick_con_address`,
                `ggdrop_con_address`,
                `ggdrop_con_empty_address`,
                `container_assign`,
                `hbl_assign`
            )
            VALUES(
                '$supplier_id',
                $inp_quantity,
                '$inp_peca',
                '$inp_pecar',
                '$inp_pca',
                '$inp_pcar',
                '$inp_doca',
                '$inp_docar',
                '$inp_deca',
                '$inp_decar',
                $inp_bg,
                '$inp_cur',
                '$db_type_truck',
                '$inp_remark',
                '$id_number',
                '$inp_ggpeca',
                '$inp_ggpca',
                '$inp_ggdoca',
                '$inp_ggdeca',
                '$text_conatiner_transport',
                '$text_hbl_transport'
            )
            ";
        }
        // echo $sql_query_transport_detail;
        $result = $con->query($sql_query_transport_detail);
        if ($result->num_rows == 0) {
            $arr_data_transport_detail = '1';
        } else {
            $arr_data_transport_detail = '0';
        }
    }

    if($arr_driver_detail == ''){
        $arr_data_driver_detail = '1';
    }else{
        foreach($arr_driver_detail as $k => $v){
            $route_id = isset($v['route_id']) ? $v['route_id'] : '';
            $driver_id = isset($v['driver_id']) ? $v['driver_id'] : '';
            $driver_name = isset($v['driver_name']) ? $v['driver_name'] : '';
            $driver_plate = isset($v['driver_plate']) ? $v['driver_plate'] : '';
            $driver_container = isset($v['driver_container']) ? $v['driver_container'] : '';
            
            //$driver_phone = isset($v['driver_phone']) ? $v['driver_phone'] : '';
    
            $driver_phone = $v['driver_phone'];
            $driver_phone = empty($driver_phone) ? "NULL" : "'".$driver_phone."'";
    
            if($driver_id != NULL){
                $sql_query_driver_detail = "
                UPDATE
                    `transport_contact`
                SET
                    `Driver_name` = '$driver_name',
                    `phone_number` = $driver_phone,
                    `plate_number` = '$driver_plate',
                    `container_id` = '$driver_container',
                    `ref_job_id` = '$id_number'
                WHERE
                    `ID` = '$driver_id'
                ";
            }else{
                $sql_query_driver_detail = "
                INSERT INTO `transport_contact`(
                    `Driver_name`,
                    `phone_number`,
                    `route_id`,
                    `ref_job_id`,
                    `plate_number`,
                    `container_id`
                )
                VALUES(
                    '$driver_name',
                    $driver_phone,
                    '$route_id',
                    '$id_number',
                    '$driver_plate',
                    '$driver_container'
                )
                ";
            }
            //echo $sql_query_driver_detail;
            $result = $con->query($sql_query_driver_detail);
            if ($result->num_rows == 0) {
                $arr_data_driver_detail = '1';
            } else {
                $arr_data_driver_detail = '0';
            }
            
        }
    }
    

        echo json_encode(array('arr_delete_driver'=>$arr_delete_driver,
        'arr_data_delete_transport'=>$arr_data_delete_transport,
        'arr_data_transport_detail'=>$arr_data_transport_detail,
        'arr_data_driver_detail'=>$arr_data_driver_detail
        ))
?>