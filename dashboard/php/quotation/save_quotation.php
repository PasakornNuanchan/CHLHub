<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';

    function create_quo_no(){
        include '../../core/conn.php';
        $date = date("Ym");
        $search = 'QT'.$date;
        $search = 'QT202212';
        $sql = "
            SELECT MAX(`quartation_number`) as 'cur_quo_no' FROM `quartation_title` WHERE `quartation_number` like '$search%';
        ";
        $query = $con -> query($sql);
        $result = $query->fetch_assoc();
        if($result['cur_quo_no'] == null){
            $quo_no = $search.'001';

        }else{
            $quo = substr($result['cur_quo_no'],-3,3);
            $quo_no = str_pad((int)$quo + 1, strlen($quo), '0', STR_PAD_LEFT);
            $new_quo = $quo_no;
            $quo_no = $search.$new_quo;
        }
        return $quo_no;

    }

    $array_st = array(
        'st' => '1',
        'msg' => ''
    );

    $detail = isset($_POST['detail'])? $_POST['detail'] : array();
    $base = isset($_POST['base'])? $_POST['base'] : array();
    $truck_import = isset($_POST['truck_import'])? $_POST['truck_import'] : array();
    $truck_export = isset($_POST['truck_export'])? $_POST['truck_export'] : array();
    $sup_service = isset($_POST['sup_service'])? $_POST['sup_service'] : array();
    $quo_no = isset($_POST['quo_no'])? $_POST['quo_no'] : '';
    $title_id = isset($_POST['title_id'])? $_POST['title_id'] : '';
    //$con->autocommit(FALSE);

    //print_r($_POST);

    if ($quo_no == '') {

        $quo_no = create_quo_no();
        $consignee = $detail['consignee'];
        $term = $detail['term'];
        $commod = $detail['commod'];
        $type_title = $detail['type_title'];
        $sign_st = $detail['sign_st'];
        $user = $_SESSION['ID'];
        $currentDateTime = date('Y-m-d H:i:s');
        $create_quo_no = '';
        $sql_query_title = "
            INSERT INTO `quartation_title`(
                `quartation_number`,
                `consignee_number`,
                `term`,
                `commodity`,
                `type`,
                `user_sale`,
                `create_datetime`,
                `status`
            )
            VALUES(
                '$quo_no',
                '$consignee',
                '$term',
                '$commod',
                '$type_title',
                '$user',
                '$currentDateTime',
                '0'
            )
        ";

        if($con->query($sql_query_title) != 1){
            //$all_queries_success = false;
            $arr_suc['title_quo'] = '0';
        }else{
            $arr_suc['title_quo'] = '1';

        }
        // $resule_quot_insert[] = $con -> query($sql);
        //         if ($con->affected_rows == 1) {
        //             $con->insert_id;
        //             $updated_quot_insert[] = $con->insert_id;
        //         }
    }else{

        $consignee = $detail['consignee'];
        $term = $detail['term'];
        $commod = $detail['commod'];
        $type_title = $detail['type_title'];

        $sql_query_title ="
        UPDATE
            `quartation_title`
        SET
            `consignee_number` = '$consignee',
            `term` = '$term',
            `commodity` = '$commod',
            `type` = '$type_title'
        WHERE
            ID = '$title_id'
        ";

        if($con->query($sql_query_title) != 1){
            //$all_queries_success = false;
            $arr_suc['title_quo'] = '0';
        }else{
            $arr_suc['title_quo'] = '1';
        }

        // $resule_quot_insert[] = $con -> query($sql);
        
        //         if ($con->affected_rows == 1) {
        //             $con->insert_id;
        //             $updated_quot_insert[] = $con->insert_id;
        //         }
    }

    
    //base service
    
    if(sizeof($base)>0){
        $updated_base_id = array();
        $check_base_id = array();
        foreach ($base as $k => $v) {
            $id = isset($v['base_id']) ? $v['base_id'] : '';
            $check_base_id[] = $id;
    
            $carrier_number = $v['carrier'];
            $carrier_type = $v['carrier_type'];
            $pol = $v['pol'];
            $pod = $v['pod'];
            $qty = $v['qty'];
    
            //Check if route is exist in table route
            $sql_base_check = "SELECT * FROM `route` WHERE carrier_number = '$carrier_number' AND container_type = '$carrier_type' AND pol = '$pol' AND pod = '$pod'; ";
            $result = $con -> query($sql_base_check);
            $route_price = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $route_number = ($row['route_number']);
                    $route_price = $row['price'];
                    $route_currency = $row['currency'];
                }
            } else {
                $array_st['st'] = '0';
                $array_st['msg'] = 'Can not find route please check again';
                return;
            }
    
            $sql_save_base = '';
            if ($id != '') {
                $check_base_id[] = $id;
                $sql_save_base = "
                    UPDATE
                        `quartation_detail_base`
                    SET
                        `unit_price` = '$route_price',
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
                        `type`,
                        `unit_price`,
                        `currency`,
                        `base_service_route`,
                        `qty`
                    )
                    VALUES(
                        '$quo_no',
                        'base_service',
                        '$route_price',
                        '$route_currency',
                        '$route_number',
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
    }else{

    }


    //  $truck_import
    if(sizeof($truck_import)>0){
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
                    $updated_import_id[] = $id;
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
                    $updated_import_id[] = $con->insert_id;
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
    }else{

    }
    


    //  $truck_export
    if(sizeof($truck_export)>0){
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
                    $updated_export_id[] = $id;
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
                    $updated_export_id[] = $con->insert_id;
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
    }else{

    }
    
    


    //Sup service
    if(sizeof($sup_service)>0){
        $updated_sup_service_id = array();
        $check_sup_service_id = array();
        foreach ($sup_service as $k => $v) {
            $sup_id = isset($v['ID']) ? $v['ID'] : '';        
            $quo_no = $quo_no;
            $description = isset($v['service']) ? $v['service'] : '';
            $type = isset($v['type']) ? $v['type'] : '';
            $price = isset($v['unit_price']) ? $v['unit_price'] : '';
            $currency = isset($v['currency']) ? $v['currency'] : '';
            $remark = isset($v['remark']) ? $v['remark'] : '';

            $sql_save_sup_service = '';
            if ($sup_id != '') {
                $check_sup_service_id[] = $sup_id;
                $sql_save_sup_service = "
                UPDATE
                    `quotation_detail_supservice`
                SET
                    `quotation_number` = '$quo_no',
                    `description` = '$description',
                    `type` = '$type',
                    `price` = '$price',
                    `currency` = '$currency',
                    `remark` = '$remark'
                WHERE
                    1 AND `ID` = '$sup_id';
                ";
                $sql_save_sup_service;
                $resule_sup_save[] = $con -> query($sql_save_sup_service);
                if ($con->affected_rows == 1) {
                    $updated_sup_service_id[] = $id;
                }
            }else{
                 $sql_save_sup_service = "
                INSERT INTO `quotation_detail_supservice`(
                    `quotation_number` ,
                    `description`,
                    `type`,
                    `price`,
                    `currency`,
                    `remark`
                )
                VALUES(
                    '$quo_no',
                    '$description',
                    '$type',
                    '$price',
                    '$currency',
                    '$remark'
                );
                ";
                $sql_save_sup_service;
                $resule_sup_save[] = $con -> query($sql_save_sup_service);
                if ($con->affected_rows == 1) {
                    $updated_sup_service_id[] = $con->insert_id;
                }
            }
        }

        $sup_service_rows_arr =array_merge($updated_sup_service_id,$check_sup_service_id);
        array_walk($sup_service_rows_arr, function(&$val, $key) {
            $val = "'" . $val . "'";
        });
        $sup_service_rows_str = implode(",", $sup_service_rows_arr);
        if(sizeof($sup_service_rows_arr) >= 1){
            $sql_delete_sup_service = "
                DELETE FROM `quotation_detail_supservice` WHERE 1 
                    AND `quotation_number` = '$quo_no'
                    AND ID not in ($sup_service_rows_str)
            ";
            $con->query($sql_delete_sup_service);
        }else{
            $sql_delete_sup_service = "
                DELETE FROM `quotation_detail_supservice` WHERE 1 
                    AND `quotation_number` = '$quo_no'
            ";
            $con->query($sql_delete_sup_service);
        }
    }else{
        
    }

    $con->commit();
    // $con->rollback();

    echo json_encode($array_st);
    

?>