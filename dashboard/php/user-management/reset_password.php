<?php
include '../../core/conn.php';
$password = $_POST['password'] ? $_POST['password'] : '';
$val = $_POST['val'] ? $_POST['val'] : '';
$id_number = $_POST['lang_id'] ? $_POST['lang_id'] : '';

// $password = "1!2@3#4$";
$key = "LHC2zMKN1!?a83b7@a3Hl9#SnaKA0923";
$iterations = 9137;
$pwHash = hash_pbkdf2('sha256', $password, $key,$iterations,32);

if($val == "ps"){
    $sql = "
    UPDATE
        `user`
    SET
        `sec_user_pass` = '$pwHash'
    WHERE
        ID = '$id_number'
    ";
    

}else{
    $sql = "
    UPDATE
        `user`
    SET
        `pincode_forgot` = '$pwHash'
    WHERE
        ID = '$id_number'
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