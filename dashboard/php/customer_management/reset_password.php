<?php
include '../../core/conn.php';
$pw = $_POST['password'] ? $_POST['password'] : '';
$val = $_POST['val'] ? $_POST['val'] : '';
$ID = $_POST['check_number'] ? $_POST['check_number'] : '';

if($val == "gp"){
    $sql = "
    UPDATE
        `user_cus`
    SET
        `sec_password` = '$pw'
    WHERE
        ID = '$ID'
    ";
    

}else{
    $sql = "
    UPDATE
        `user_cus`
    SET
        `forgot_pin` = '$pw'
    WHERE
        ID = '$ID'
    ";
}

if ($con->query($sql) != 1) {
    $arr_suc['st'] = '0';
} else {
    $arr_suc['st'] = '1';
}

echo json_encode($arr_suc);

?>