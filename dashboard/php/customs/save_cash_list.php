<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';

 $list_data = $_POST['arr_get_val_cash'];
foreach ($list_data as $k => $v) {
    $type = isset($v['type']) ? $v['type'] : '';
    $description = isset($v['description']) ? $v['description'] : '';
    $pay_to = isset($v['pay_to']) ? $v['pay_to'] : '';
    $pic = isset($v['pic']) ? $v['pic'] : '';
    $amount = isset($v['amount']) ? $v['amount'] : '';
    $amount_cur = isset($v['amount_cur']) ? $v['amount_cur'] : '';
    $remark = isset($v['remark']) ? $v['remark'] : '';
    $job_number_pcn = isset($v['job_number_pcn']) ? $v['job_number_pcn'] : '';
    $petty_cash_number_cash = isset($v['petty_cash_number_cash']) ? $v['petty_cash_number_cash'] : '';

    $sql_add_list =
        "INSERT INTO `cash_payment`(
            `type`,
            `description`,
            `pay_to`,
            `picture`,
            `amount`,
            `create_by`,
            `job_number`,
            `currency`,
            `datetime_create`,
            `remark`,
            `status`,
            `ID_petty_cash`
        )
        VALUES(
            '$type',
            '$description',
            '$pay_to',
            '$pic',
            '$amount',
            '$data_user',
            '$job_number_pcn',
            '$amount_cur',
            '$t_time_save',
            '$remark',
            '0',
            '$petty_cash_number_cash'
        )
        ";

        if($con->query($sql_add_list) != 1){
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
        }

}


echo json_encode($arr_suc);

?>