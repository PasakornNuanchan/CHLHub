<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];
// print_r($arr_data);
foreach ($arr_data as $k => $v) {
    $inp_fn = $v['inp_fn'] ? $v['inp_fn'] : '';
    $inp_ln = $v['inp_ln'] ? $v['inp_ln'] : '';
    $inp_mp = $v['inp_mp'] ? $v['inp_mp'] : '';
    $inp_em = $v['inp_em'] ? $v['inp_em'] : '';
    $inp_ad = $v['inp_ad'] ? $v['inp_ad'] : '';
    $sel_de = $v['sel_de'] ? $v['sel_de'] : '';
    $sel_st = $v['sel_st'] ? $v['sel_st'] : '';
    $inp_un = $v['inp_un'] ? $v['inp_un'] : '';
    $inp_pw = $v['inp_pw'] ? $v['inp_pw'] : '';
    $inp_pwc = $v['inp_pwc'] ? $v['inp_pwc'] : '';
    $inp_fgp = $v['inp_fgp'] ? $v['inp_fgp'] : '';
    $inp_bn = $v['inp_bn'] ? $v['inp_bn'] : '';
    $inp_bk = $v['inp_bnum'] ? $v['inp_bnum'] : '';

    $key = "LHC2zMKN1!?a83b7@a3Hl9#SnaKA0923";
    $iterations = 9137;
    $pwHash = hash_pbkdf2('sha256', $inp_pwc, $key, $iterations, 32);

    $pwHashfgp = hash_pbkdf2('sha256', $inp_fgp, $key, $iterations, 32);
    

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
            '$inp_fn',
            '$inp_ln',
            '$inp_ad',
            '$inp_mp',
            '$inp_em',
            '$inp_un',
            '$pwHash',
            '$pwHashfgp',
            '$sel_st',
            '$sel_de',
            '$inp_bn',
            '$inp_bk'
        )
    ";
}
// echo $sql_data_query;


if ($con->query($sql_data_query) != 1) {
    $arr_suc = '0';
} else {
    $last_id = $con->insert_id;
    $arr_suc = '1';
}
echo json_encode(array('arr_suc' => $arr_suc, 'last_id' => $last_id));
