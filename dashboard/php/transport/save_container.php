<?php
    include '../../core/conn.php';
    $arr = array();
    $arr_suc = array();
    $container_data = $_POST['container_arr'];

    try {
        // begin transaction
        $con->beginTransaction();
        foreach($container_data as $k => $v){
            $ID = isset($v['ID']) ? $v['ID'] : '';
            $container_number = isset($v['container_nubmer']) ? $v['container_nubmer'] : '';
            $gw = isset($v['gw']) ? $v['gw'] : '';
            $cbm = isset($v['cbm']) ? $v['cbm'] : '';
            $seal_number = isset($v['seal_number']) ? $v['seal_number'] : '';
    
            $sql_query = "
            UPDATE
                `container`
            SET
                `container_number` = '$container_number',
                `seal_number` = '$seal_number',
                `gross_weight` = '$gw',
                `cbm` = '$cbm'
            WHERE ID = '$ID'";
            if($con->query($sql_query)== 1){
                $arr_suc['st'] = '1';
            }else{
                $arr_suc['st'] = '0';
                
            }
        }   
        // commit the transaction
        $con->commit();
        echo "Transaction committed successfully.";
    } catch (Exception $e) {
        // rollback the transaction
        $con->rollback();
        echo "Transaction rolled back: " . $e->getMessage();
    }
    
   
        echo json_encode($arr_suc);
?>