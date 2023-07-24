<?php 
    include '../../core/conn.php';
    $data = $_POST['data'];

    $ID = isset($data['ID']) ? $data['ID'] : '';
    $corp_id = isset($data['corp']) ? $data['corp'] : '';
    $name = isset($data['name']) ? $data['name'] : '';
    $lname = isset($data['lname']) ? $data['lname'] : '';
    $email = isset($data['email'])? $data['email'] : '';
    $phone = isset($data['phone']) ? $data['phone'] : '';
    $status_a = isset($data['status_a']) ? $data['status_a'] : '';
    $username = isset($data['username']) ? $data['username'] : '';
    $password = isset($data['password']) ? $data['password'] : '';
    $pin = isset($data['pin']) ? $data['pin'] : '';
        

    if($ID == ''){
        $sql = "
        INSERT INTO `user_cus`(
            `sec_username`,
            `sec_password`,
            `email`,
            `phone_number`,
            `name`,
            `sur_name`,
            `status_u`,
            `forgot_pin`,
            `corp_id`
        )
        VALUES(
            '$username',
            '$password',
            '$email',
            '$phone',
            '$name',
            '$lname',
            '$status_a',
            '$pin',
            '$corp_id'
        )
        ";
    }else{
        $sql = "
        UPDATE
            `user_cus`
        SET
            `email` = '$email',
            `phone_number` = '$phone',
            `name` = '$name',
            `sur_name` = '$lname',
            `status_u` = '$status_a',
            `corp_id` = '$corp_id'
        WHERE
            ID = '$ID'
        ";
    }
    
    
    if($con->query($sql) != 1){
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }

echo json_encode($arr_suc)
?>