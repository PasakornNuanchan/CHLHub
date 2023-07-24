<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_sent = $_POST['arr_sent'];


foreach($arr_sent as $k => $v){
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $data_type_wd  = isset($v['data_type_wd']) ? $v['data_type_wd'] : '';
    $data_pay_wd = isset($v['data_pay_wd']) ? $v['data_pay_wd'] : '';
    $data_des_wd = isset($v['data_des_wd']) ? $v['data_des_wd'] : '';
    $data_amt_wd = isset($v['data_amt_wd']) ? $v['data_amt_wd'] : '';
    $data_cur_wd = isset($v['data_cur_wd']) ? $v['data_cur_wd'] : '';
    $data_rem_wd = isset($v['data_rem_wd']) ? $v['data_rem_wd'] : '';
    $data_type_pt = isset($v['data_type_pt']) ? $v['data_type_pt'] : '';
    $picture = isset($v['picture']) ? $v['picture'] : '';

    if($data_type_pt == null){
        $sql_data_query = "
        INSERT INTO `cash_pay`(
            `type_payble`,
            `payto_payble`,
            `description_payble`,
            `amount_payble`,
            `currency_payble`,
            `img_payble`,
            `remark_payble`,
            `ref_job_id`,
            `create_by`,
            `create_datetime`
        )
        VALUES(
            '$data_type_wd',
            '$data_pay_wd',
            '$data_des_wd',
            '$data_amt_wd',
            '$data_cur_wd',
            '$picture',
            '$data_rem_wd',
            '$id_number',
            '$data_user',
            '$t_time_save'
        )
        ";

    }else{
        $sql_data_query = "
        INSERT INTO `cash_pay`(
            `type_payble`,
            `payto_payble`,
            `description_payble`,
            `amount_payble`,
            `currency_payble`,
            `img_payble`,
            `remark_payble`,
            `ref_job_id`,
            `petty_cash_number`,
            `create_by`,
            `create_datetime`,
            `paid_by`,
            `datetime_paid`
        )
        VALUES(
            '$data_type_pt',
            '$data_pay_wd',
            '$data_des_wd',
            '$data_amt_wd',
            '$data_cur_wd',
            '$picture',
            '$data_rem_wd',
            '$id_number',
            '$data_type_wd',
            '$data_user',
            '$t_time_save',
            '$data_user',
            '$t_time_save'
        )
        ";
    }

$result = $con->query($sql_data_query);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);
}
