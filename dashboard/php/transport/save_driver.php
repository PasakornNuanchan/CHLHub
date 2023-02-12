<?php
    include '../../core/conn.php';
    $arr = array();
    $arr_suc = array();
    $container_data = $_POST['driver_arr'];
    
    try {
        // begin transaction
        $con->begin_transaction();
        $all_queries_success = true;
        
        foreach($container_data as $k => $v){
            $ID = isset($v['ID']) ? $v['ID'] : '';
            $route_number = isset($v['route_number']) ? $v['route_number'] : '';
            $name_val = isset($v['name_val']) ? $v['name_val'] : '';
            $phone_val = isset($v['phone_val']) ? $v['phone_val'] : '';
            $container_val = isset($v['container_val']) ? $v['container_val'] : '';
            $job_global = isset($v['job_global']) ? $v['job_global'] : '';
            
            if($ID != ''){
                $sql_query = "
                UPDATE
                    `transport_contact`
                SET
                    `Driver_name` = '$name_val',
                    `phone_number` = '$phone_val',
                    `container_id` = '$container_val',
                    `route_id` = '$route_number'
                WHERE
                    ID = '$ID'";
                
            }else{
                $sql_query = "
                INSERT INTO `transport_contact`(
                    `Driver_name`,
                    `phone_number`,
                    `container_id`,
                    `job_number`,
                    `route_id`
                )
                VALUES(
                    '$name_val',
                    '$phone_val',
                    '$container_val',
                    '$job_global',
                    '$route_number'
                )
                ";
            }
            if($con->query($sql_query) != 1){
                $all_queries_success = false;
                $arr_suc['st'] = '0';
            }else{
                $arr_suc['st'] = '1';

            }
        }

        
        // commit the transaction
        if ($all_queries_success) {
            $con->commit();
          } else {
            $con->rollback();
          }
    } catch (Exception $e) {
        // rollback the transaction
        $con->rollback();
        echo $e;
    }


        echo json_encode($all_queries_success);