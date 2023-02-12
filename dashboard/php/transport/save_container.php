<?php
    include '../../core/conn.php';
    $arr = array();
    $arr_suc = array();
    $container_data = $_POST['container_arr'];

    try {
        // begin transaction
        $con->begin_transaction();
        $all_queries_success = true;

        foreach($container_data as $k => $v){
            $ID = isset($v['ID']) ? $v['ID'] : '';
            $container_number = isset($v['container_nubmer']) ? $v['container_nubmer'] : '';
            $gw = isset($v['gw']) ? $v['gw'] : '';
            $cbm = isset($v['cbm']) ? $v['cbm'] : '';
            $seal_number = isset($v['seal_number']) ? $v['seal_number'] : '';

           $sql_query = "
            UPDATE
                container
            SET
                container_number = '$container_number',
                seal_number = '$seal_number',
                gross_weight = '$gw',
                cbm = '$cbm'
            WHERE ID = '$ID'";
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