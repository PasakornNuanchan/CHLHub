<?php 
include '../../core/conn.php';

$arr_save = $_POST['arr_save'];

foreach($arr_save as $k => $v){
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $username = isset($v['username']) ? $v['username'] : '';
    $password = isset($v['password']) ? $v['password'] : '';
    $statusin = isset($v['statusin']) ? $v['statusin'] : '';
    $forgot = isset($v['forgot']) ? $v['forgot'] : '';
    $user_id = isset($v['user_id']) ? $v['user_id'] : '';
    

    if($user_id == ""){
        $sql_data_save ="
        INSERT INTO `user_cus`(
            `sec_username`,
            `sec_password`,
            `status_u`,
            `forgot_pin`,
            `corp_id`
        )
        VALUES(
            '$username',
            '$password',
            '$statusin',
            '$forgot',
            '$id_number'
        )
        ";
    }else{
        $sql_data_save = "
        UPDATE
            `user_cus`
        SET
            `sec_username` = '$username',
            `sec_password` = '$password',
            `status_u` = '$statusin',
            `forgot_pin` = '$forgot',
            `corp_id` = '$id_number'
        WHERE
            ID = '$user_id'
        ";
    }

    
    $result = $con->query($sql_data_save);
        if ($result->num_rows == 0) {
            $arr_save_data = '1';
        } else {
            $arr_save_data = '0';
        }
    
}

echo json_encode(array('arr_save_data'=>$arr_save_data))

?>