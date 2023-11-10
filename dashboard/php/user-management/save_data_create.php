<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];
foreach($arr_data as $k => $v){
    $inp_fn = isset($v['inp_fn']) ? $v['inp_fn'] : '';
    $inp_ln = isset($v['inp_ln']) ? $v['inp_ln'] : '';
    $inp_mp = isset($v['inp_mp']) ? $v['inp_mp'] : '';
    $inp_em = isset($v['inp_em']) ? $v['inp_em'] : '';
    $inp_ad = isset($v['inp_ad']) ? $v['inp_ad'] : '';
    $sel_de = isset($v['sel_de']) ? $v['sel_de'] : '';
    $sel_st = isset($v['sel_st']) ? $v['sel_st'] : '';
    $inp_un = isset($v['inp_un']) ? $v['inp_un'] : '';
    $inp_new_password = isset($v['inp_new_password']) ? $v['inp_new_password'] : '';
    $inp_bk = isset($v['inp_bk']) ? $v['inp_bk'] : '';
    $inp_bn = isset($v['inp_bn']) ? $v['inp_bn'] : '';


    $sql_data_query = "
        INSERT INTO `user`(
            `first_name`,
            `last_name`,
            `address`,
            `mobile_number`,
            `email`,
            `sec_user_id`,
            `sec_user_pass`,
            `pincode_forgot`,
            `status_user`,
            `department_number`,
            `bank_number`,
            `bank_name`
        )
        VALUES(
            '$inp_un',
            '$inp_fn',
            '$inp_ln',
            '$inp_ad',
            '$inp_mp',
            '$inp_em',
            '$inp_un',
            '$inp_new_password',
            '$sel_st',
            '$sel_de',
            '$inp_bn',
            '$inp_bk'
        )
    ";
    
}



if ($con->query($sql_data_query) != 1) {
    $arr_suc = '0';
} else {
    $arr_suc = '1';
}
echo json_encode($arr_suc);


?>