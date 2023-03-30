<?php
    include '../../core/conn.php';

    $arr_save = $_POST['arr_save'];
    $department = $_POST['department'];
    
    foreach($arr_save as $k => $i){
        if($i['save_check'] == 1){
            $arr_save_wait[] = $i['id_menu'];
        }
    }
    $imp_sw = implode(",",$arr_save_wait);
    
    $sql_save = "
    UPDATE
        `department`
    SET
        `menu` = '$imp_sw'
    WHERE
        `ID` = '$department'
    ";

    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }

    echo json_encode($arr_suc);
   
?>