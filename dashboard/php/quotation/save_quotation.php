<?php
    include '../../core/conn.php';
    // echo json_encode($_POST);
    $detail = $_POST['detail'];
    $base = $_POST['base'];
    $truck_import = $_POST['truck_import'];
    $truck_export = $_POST['truck_export'];
    $sup_service = $_POST['sup_service'];
    $quo_no = $_POST['quo_no'];
    $con->autocommit(FALSE);

    //base service
    $updated_base_id = array();
    $check_base_id = array();
    foreach ($base as $k => $v) {
        $id = isset($v['base_id']) ? $v['base_id'] : '';
        $check_base_id[] = $base_id;

        $carrier_number = $v['carrier'];
        $carrier_type = $v['carrier_type'];
        $pol = $v['pol'];
        $pod = $v['pod'];
        $qty = $v['qty'];

        //Check if route is exist in table route
        $sql_base_check = "SELECT * FROM `route` WHERE carrier_number = '$carrier_number' AND container_type = '$carrier_type' AND pol = '$pol' AND pod = '$pod'; ";
        $result = $con -> query($sql_base_check);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $route_number = ($row['route_number']);
            }
        } else {
            echo json_encode(array('err_msg' => 'route not found','err' => '1'));
            return;
        }

        $sql_save_base = '';
        if ($id != '') {
            $check_base_id[] = $id;
            $sql_save_base = "
                UPDATE
                    `quartation_detail_base`
                SET
                    `base_service_route` = '$route_number',
                    `qty` = '$qty'
                WHERE
                `ID` = '$id'
            ";
            $resule_base_save[] = $con -> query($sql_save_base);
            if ($con->affected_rows == 1) {
                $updated_base_id[] = $id;
            }
        }else{
            $sql_save_base = "
                INSERT INTO `quartation_detail_base`(
                    `quartation_number`,
                    `description`,
                    `type`,
                    `unit_price`,
                    `currency`,
                    `remark`,
                    `base_service_route`,
                    `markup_price`,
                    `markup_result`,
                    `qty`
                )
                VALUES(
                    '$quo_no',
                    '',
                    'base_service',
                    '',
                    '',
                    '',
                    '$route_number',
                    '',
                    '',
                    '$qty'
                );
            ";
            $resule_base_save[] = $con -> query($sql_save_base);
            if ($con->affected_rows == 1) {
                $con->insert_id;
                $updated_base_id[] = $con->insert_id;
            }
        }
    }
    $base_rows_arr =array_merge($updated_base_id,$check_base_id);
    array_walk($base_rows_arr, function(&$val, $key) {
        $val = "'" . $val . "'";
    });
    $base_rows_str = implode(",", $base_rows_arr);
    if(sizeof($base_rows_arr) >= 1){
         $sql_delete_base = "
            DELETE FROM `quartation_detail_base` WHERE 1 
                AND `quartation_number` = '$quo_no'
                AND ID not in ($base_rows_str)
        ";
        $con->query($sql_delete_base);
    }else{
         $sql_delete_base = "
            DELETE FROM `quartation_detail_base` WHERE 1 
                AND `quartation_number` = '$quo_no'
        ";
        $con->query($sql_delete_base);
    }
    


    //  $truck_import
    $updated_import_id = array();
    $check_import_id = array();
    foreach ($truck_import as $k => $v) {
        $id = isset($v['ID']) ? $v['ID'] : '';
        $truck_pickup = isset($v['truck_pickup']) ? $v['truck_pickup'] : '';
        $truck_drop = isset($v['truck_drop']) ? $v['truck_drop'] : '';
        $budget = isset($v['budget']) ? $v['budget'] : '';
        $currency = isset($v['currency']) ? $v['currency'] : '';
        $sql_save_truck_import = '';
        if ($id != '') {
            $check_import_id[] = $id;
            $sql_save_truck_import = "
            UPDATE
                `quotation_detail_trucking`
            SET
                `quotation_number` = '$quo_no',
                `type` = 'import',
                `pickup` = '$truck_pickup',
                `dropoff` = '$truck_drop',
                `price` = '$budget',
                `currency` = '$currency'
            WHERE
                1 AND `ID` = '$id';
            ";
            $resule_base_save[] = $con -> query($sql_save_truck_import);
            if ($con->affected_rows == 1) {
                $updated_id[] = $id;
            }
        }else{
            $sql_save_truck_import = "
            INSERT INTO `quotation_detail_trucking`(
                `quotation_number`,
                `type`,
                `pickup`,
                `dropoff`,
                `price`,
                `currency`
            )
            VALUES(
                '$quo_no',
                'import',
                '$truck_pickup',
                '$truck_drop',
                '$budget',
                '$currency'
            );
            ";
            $resule_base_save[] = $con -> query($sql_save_truck_import);
            if ($con->affected_rows == 1) {
                $updated_id[] = $con->insert_id;
            }
        }
        $resule_base_save[] = $con -> query($sql_save_truck_import);
    }
    $truck_import_rows_arr =array_merge($updated_import_id,$check_import_id);
    array_walk($truck_import_rows_arr, function(&$val, $key) {
        $val = "'" . $val . "'";
    });
    $truck_import_rows_str = implode(",", $truck_import_rows_arr);
    if(sizeof($truck_import_rows_arr) >= 1){
        $sql_delete_truck_import = "
            DELETE FROM `quotation_detail_trucking` WHERE 1 
                AND `quotation_number` = '$quo_no'
                AND `type` = 'import'
                AND ID not in ($truck_import_rows_str)
        ";
        $con->query($sql_delete_truck_import);
    }else{
        $sql_delete_truck_import = "
            DELETE FROM `quotation_detail_trucking` WHERE 1 
                AND `quotation_number` = '$quo_no'
                AND `type` = 'import'
        ";
        $con->query($sql_delete_truck_import);
    }





    //  $truck_export
    $updated_export_id = array();
    $check_export_id = array();
    foreach ($truck_export as $k => $v) {
        $id = isset($v['ID']) ? $v['ID'] : '';
        $truck_pickup = isset($v['truck_pickup']) ? $v['truck_pickup'] : '';
        $truck_drop = isset($v['truck_drop']) ? $v['truck_drop'] : '';
        $budget = isset($v['budget']) ? $v['budget'] : '';
        $currency = isset($v['currency']) ? $v['currency'] : '';
        $sql_save_truck_export = '';
        if ($id != '') {
            $check_export_id[] = $id;
            $sql_save_truck_export = "
            UPDATE
                `quotation_detail_trucking`
            SET
                `quotation_number` = '$quo_no',
                `type` = 'export',
                `pickup` = '$truck_pickup',
                `dropoff` = '$truck_drop',
                `price` = '$budget',
                `currency` = '$currency'
            WHERE
                1 AND `ID` = '$id';
            ";
            $resule_base_save[] = $con -> query($sql_save_truck_export);
            if ($con->affected_rows == 1) {
                $updated_id[] = $id;
            }
        }else{
            $sql_save_truck_export = "
            INSERT INTO `quotation_detail_trucking`(
                `quotation_number`,
                `type`,
                `pickup`,
                `dropoff`,
                `price`,
                `currency`
            )
            VALUES(
                '$quo_no',
                'export',
                '$truck_pickup',
                '$truck_drop',
                '$budget',
                '$currency'
            );
            ";
            $resule_base_save[] = $con -> query($sql_save_truck_export);
            if ($con->affected_rows == 1) {
                $updated_id[] = $con->insert_id;
            }
        }
    }

    $truck_export_rows_arr =array_merge($updated_export_id,$check_export_id);
    array_walk($truck_export_rows_arr, function(&$val, $key) {
        $val = "'" . $val . "'";
    });
    $truck_export_rows_str = implode(",", $truck_export_rows_arr);
    if(sizeof($truck_export_rows_arr) >= 1){
        $sql_delete_truck_export = "
            DELETE FROM `quotation_detail_trucking` WHERE 1 
                AND `quotation_number` = '$quo_no'
                AND `type` = 'export'
                AND ID not in ($truck_export_rows_str)
        ";
        $con->query($sql_delete_truck_export);
    }else{
        $sql_delete_truck_export = "
            DELETE FROM `quotation_detail_trucking` WHERE 1 
                AND `quotation_number` = '$quo_no'
                AND `type` = 'export'
        ";
        $con->query($sql_delete_truck_export);
    }
    
    $con->commit();
    // echo $con->rollback();
    

?>