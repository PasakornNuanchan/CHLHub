<?php
include '../../core/conn.php';
$pw = $_POST['password'] ? $_POST['password'] : '';
$val = $_POST['val'] ? $_POST['val'] : '';
$ID = $_POST['check_number'] ? $_POST['check_number'] : '';


$key = "LHC2zMKN1!?a83b7@a3Hl9#SnaKA0923";
$iterations = 9137;
$pwHash = hash_pbkdf2('sha256', $pw, $key,$iterations,32);

if($val == "gp"){
    $sql = "
    UPDATE
        `user_cus`
    SET
        `sec_password` = '$pwHash'
    WHERE
        ID = '$ID'
    ";
    

}else{
    $sql = "
    UPDATE
        `user_cus`
    SET
        `forgot_pin` = '$pwHash'
    WHERE
        ID = '$ID'
    ";
}

// echo $sql;
if ($con->query($sql) != 1) {
    $arr_suc['st'] = '0';
} else {
    $arr_suc['st'] = '1';
}

echo json_encode($arr_suc);

?>