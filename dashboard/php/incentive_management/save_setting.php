<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];

foreach($arr_data as $k => $v){
    $id_incen = isset($v['id_incen']) ? $v['id_incen'] : '';
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $percentage = isset($v['percentage']) ? $v['percentage'] : '0';

    
    if($id_incen !== '' ){
        $sql_data_save = "
        UPDATE
            `incentive_management`
        SET
            `percentage` = '$percentage'
        WHERE
            ID = '$id_incen'
    ";
    }else{
        $sql_data_save = "
        INSERT INTO `incentive_management`(`user_id`, `percentage`)
        VALUES(
            '$id_number',
            '$percentage'
        )
    ";
    }
    
    // echo $sql_data_save;

    if ($con->query($sql_data_save) === TRUE) {
        $res_data = '1';
    } else {
        $res_data = '0';
    }
}

echo json_encode($res_data);
?>