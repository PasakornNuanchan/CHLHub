<?php
require '../../function/auth/get_session.php';
include '../../core/conn.php'; 
include '../../core/con_path.php';


$arr_save_ar = $_POST['arr_save_data'];



foreach($arr_save_ar as $k => $v){
    $id_cash_payment = isset($v['id_cash_payment']) ? $v['id_cash_payment'] : '';
    $sel_des = isset($v['sel_des']) ? $v['sel_des'] : '';
    $sel_bill_to = isset($v['sel_bill_to']) ? $v['sel_bill_to'] : ''; 
    $sel_bill_to_type = isset($v['sel_bill_to_type']) ? $v['sel_bill_to_type'] : ''; 
    $sel_cur_description = isset($v['sel_cur_description']) ? $v['sel_cur_description'] : ''; 
    $inp_qty_ar =isset($v['inp_qty_ar']) ? $v['inp_qty_ar'] : ''; 
    $inp_unit_price_ar = isset($v['inp_unit_price_ar']) ? $v['inp_unit_price_ar'] : ''; 
    $inp_amt_ar = isset($v['inp_amt_ar']) ? $v['inp_amt_ar'] : ''; 
    $inp_vat = isset($v['inp_vat']) ? $v['inp_vat'] : ''; 
    $inp_amt_icv_ar = isset($v['inp_amt_icv_ar']) ? $v['inp_amt_icv_ar'] : ''; 
    $inp_remark = isset($v['inp_remark']) ? $v['inp_remark'] : '';
    $job_number = isset($v['job_number']) ? $v['job_number'] : '';
    $inp_amt_ar_s = str_replace(",","",$inp_amt_ar);
    $inp_vat_s = str_replace("%","",$inp_vat);
    $inp_amt_icv_ar_s = str_replace(",","",$inp_amt_icv_ar);

    if($val_id == ""){
    $query_insert = 
        "
      INSERT INTO `billing`(
          `billing_description`,
          `job_number`,
          `bill_to`,
          `bill_to_type`,
          `currency`,
          `qty`,
          `unit_price`,
          `amount`,
          `vat`,
          `amtinclvat`,
          `remark`,
          `payble`,
          `type`,
          `action_paid_by`,
          `action_paid_date_time`

      )
      VALUES(
          '$sel_des',
          '$job_number',
          '$sel_bill_to',
          '$sel_bill_to_type',
          '$sel_cur_description',
          '$inp_qty_ar',
          '$inp_unit_price_ar',
          '$inp_amt_ar_s',
          '$inp_vat_s',
          '$inp_amt_icv_ar_s',
          '$inp_remark',
          '1',
          'AP',
          '$data_user',
          '$t_time_save'
      )
        ";
    $status = $con->query($query_insert);


    $sql_query_payment = "
    UPDATE
    `cash_payment`
        SET
            `status` = '3'
        WHERE
        `ID` = '$id_cash_payment'
    ";

    $status_pay = $con->query($sql_query_payment);
    }

    
}
echo json_encode($status, $status_pay);   
