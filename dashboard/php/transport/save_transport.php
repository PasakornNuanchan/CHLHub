<?php
include '../../core/conn.php';
$arr = array();
$arr_suc = array();
$transport_arr = $_POST['transport_arr'];

foreach ($transport_arr as $k => $v) {
    $ID = isset($v['ID']) ? $v['ID'] : '';
    $sel_supplier = isset($v['sel_supplier']) ? $v['sel_supplier'] : '';
    $inp_peca = isset($v['inp_peca']) ? $v['inp_peca'] : '';
    $inp_peca_remark = isset($v['inp_peca_remark']) ? $v['inp_peca_remark'] : '';
    $inp_pca = isset($v['inp_pca']) ? $v['inp_pca'] : '';
    $inp_pca_remark = isset($v['inp_pca_remark']) ? $v['inp_pca_remark'] : '';
    $inp_doca = isset($v['inp_doca']) ? $v['inp_doca'] : '';
    $inp_doca_remark = isset($v['inp_doca_remark']) ? $v['inp_doca_remark'] : '';
    $inp_doeca = isset($v['inp_doeca']) ? $v['inp_doeca'] : '';
    $inp_doecaremark = isset($v['inp_doecaremark']) ? $v['inp_doecaremark'] : '';
    $truck_type = isset($v['truck_type']) ? $v['truck_type'] : '';
    $truck_remark = isset($v['truck_remark']) ? $v['truck_remark'] : '';
    $truck_quantity = isset($v['truck_quantity']) ? $v['truck_quantity'] : '';
    $inp_bg = isset($v['inp_bg']) ? $v['inp_bg'] : '';
    $sel_cur = isset($v['sel_cur']) ? $v['sel_cur'] : '';
    $job_number = isset($v['job_number']) ? $v['job_number'] : '';
    
    if ($ID != '') {
               $sql_query = "
                    UPDATE
                    `transport_booking`
                SET
                    `sup_number` = '$sel_supplier',
                    `truck_quantity` = '$truck_quantity',
                    `pick_con_empty_address` = '$inp_peca',
                    `pick_con_empty_remark` = '$inp_peca_remark',
                    `pick_con_address` = '$inp_pca',
                    `pick_con_remark` = '$inp_pca_remark',
                    `drop_con_address` = '$inp_doca',
                    `drop_con_remark` = '$inp_doca_remark',
                    `drop_con_empty_address` = '$inp_doeca',
                    `drop_con_empty_remark` = '$inp_doecaremark',
                    `budget` = '$inp_bg',
                    `cur` = '$sel_cur',
                    `type_truck` = '$truck_type',
                    `remark` = '$truck_remark'
                WHERE
                    ID = '$ID'
        ";
    } else {
            $sql_query = "
                INSERT INTO `transport_booking`(
                    `job_number`,
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
                    `remark`
                )
                VALUES(
                    '$job_number',
                    '$sel_supplier',
                    '$truck_quantity',
                    '$inp_peca',
                    '$inp_peca_remark',
                    '$inp_pca',
                    '$inp_pca_remark',
                    '$inp_doca',
                    '$inp_doca_remark',
                    '$inp_doeca',
                    '$inp_doecaremark',
                    '$inp_bg',
                    '$sel_cur',
                    '$truck_type',
                    '$truck_remark'
                )
                        ";
    }
    if ($con->query($sql_query) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
        
    }
}
echo json_encode($arr_suc);
        
        
        
       
        
        
    // try {
    //     // begin transaction
    //     $con->begin_transaction();
    //     $all_queries_success = true;
        
    //     foreach($container_data as $k => $v){
    //         $ID = isset($v['ID']) ? $v['ID'] : '';
    //         $route_number = isset($v['route_number']) ? $v['route_number'] : '';
    //         $name_val = isset($v['name_val']) ? $v['name_val'] : '';
    //         $phone_val = isset($v['phone_val']) ? $v['phone_val'] : '';
    //         $container_val = isset($v['container_val']) ? $v['container_val'] : '';
    //         $job_global = isset($v['job_global']) ? $v['job_global'] : '';
            
    //         if($ID != ''){
    //             $sql_query = "
    //             UPDATE
    //                 `transport_contact`
    //             SET
    //                 `Driver_name` = '$name_val',
    //                 `phone_number` = '$phone_val',
    //                 `container_id` = '$container_val',
    //                 `route_id` = '$route_number'
    //             WHERE
    //                 ID = '$ID'";
                
    //         }else{
    //             $sql_query = "
    //             INSERT INTO `transport_contact`(
    //                 `Driver_name`,
    //                 `phone_number`,
    //                 `container_id`,
    //                 `job_number`,
    //                 `route_id`
    //             )
    //             VALUES(
    //                 '$name_val',
    //                 '$phone_val',
    //                 '$container_val',
    //                 '$job_global',
    //                 '$route_number'
    //             )
    //             ";
    //         }
    //         if($con->query($sql_query) != 1){
    //             $all_queries_success = false;
    //             $arr_suc['st'] = '0';
    //         }else{
    //             $arr_suc['st'] = '1';

    //         }
    //     }

        
    //     // commit the transaction
    //     if ($all_queries_success) {
    //         $con->commit();
    //       } else {
    //         $con->rollback();
    //       }
    // } catch (Exception $e) {
    //     // rollback the transaction
    //     $con->rollback();
    //     echo $e;
    // }


     