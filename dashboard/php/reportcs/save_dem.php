<?php
    include '../../core/conn.php';
    $arr = array();
    $arr_suc = array();
    $dem_save = $_POST['dem_arr'];
    $dem_delete = $_POST['delete_dem_arr'];

    print_r($dem_delete);
    print_r($dem_save);

    try {
        // begin transaction
        $con->begin_transaction();
        $all_queries_success = true;

        foreach($dem_save as $k => $v){
            $ID = isset($v['ID_dem']) ? $v['ID_dem'] : '';
            $containe_ID = isset($v['containe_ID']) ? $v['containe_ID'] : '';
            $old_dem = isset($v['old_dem']) ? $v['old_dem'] : '';
            $new_dem = isset($v['new_dem']) ? $v['new_dem'] : '';
            $doc = isset($v['doc']) ? $v['doc'] : '';

            if($ID != ''){
            $sql_update = "
            UPDATE
                `demurrage`
            SET
                `container_id` = '$containe_ID',
                `old_dem_time` = '$old_dem',
                `new_dem_time` = '$new_dem',
                `file_add` = '$doc'
            WHERE
                ID = $ID";
            }else{
            $sql_update = "
            INSERT INTO `demurrage`(
                `container_id`,
                `old_dem_time`,
                `new_dem_time`,
                `file_add`
            )
            VALUES(
                '$containe_ID',
                '$old_dem',
                '$new_dem',
                '$doc'
            )
            ";
            }
            if($con->query($sql_update) != 1){
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
    ?>