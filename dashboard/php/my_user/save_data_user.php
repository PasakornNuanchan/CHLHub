<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_data_save = $_POST['arr_data_save'] ? $_POST['arr_data_save'] : '';


foreach($arr_data_save as $k => $v){

    $fname = isset($v['fname']) ? $v['fname'] : '';
    $lname = isset($v['lname']) ? $v['lname'] : '';
    $mphone = isset($v['mphone']) ? $v['mphone'] : '';
    $email = isset($v['email']) ? $v['email'] : '';
    $address = isset($v['address']) ? $v['address'] : '';
    $bank_name = isset($v['bank_name']) ? $v['bank_name'] : '';
    $bank_number = isset($v['bank_number']) ? $v['bank_number'] : '';
    $old_pass_word = isset($v['old_pass_word']) ? $v['old_pass_word'] : '';
    $new_password = isset($v['new_password']) ? $v['new_password'] : '';
    $cf_newpassword = isset($v['cf_newpassword']) ? $v['cf_newpassword'] : '';


    if($old_pass_word != '' &&$new_password != '' &&$cf_newpassword != '' ){
        
        $sql_update_data = "
        UPDATE
            `user`
        SET
            `first_name` = '$fname',
            `last_name` = '$lname',
            `address` = '$address',
            `mobile_number` = '$mphone',
            `email` = '$email',
            `bank_number` = '$bank_number',
            `bank_name` = '$bank_name',
            `sec_user_pass` = '$new_password'
        WHERE
            ID = '$data_user'
        ";
    }else{
        $sql_update_data = "
        UPDATE
            `user`
        SET
            `first_name` = '$fname',
            `last_name` = '$lname',
            `address` = '$address',
            `mobile_number` = '$mphone',
            `email` = '$email',
            `bank_number` = '$bank_number',
            `bank_name` = '$bank_name'
        WHERE
            ID = '$data_user'
        ";
    }
    


}
// echo $sql_update_data;
$result = $con->query($sql_update_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);

