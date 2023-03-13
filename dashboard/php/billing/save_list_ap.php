<?php
require '../../function/auth/get_session.php';
include '../../core/conn.php'; 
include '../../core/con_path.php';


$arr_save_ar = $_POST['arr_save_ap'];



foreach($arr_save_ar as $k => $v){
    $val_id = isset($v['val_id']) ? $v['val_id'] : '';
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
          `type`
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
          'AP'
      )
        ";
      $status = $con->query($query_insert);
      

      }else{
   $sql_update = 
    "
          UPDATE
          `billing`
      SET
          `billing_description` = '$sel_des',
          `bill_to` = '$sel_bill_to',
          `bill_to_type` = '$sel_bill_to_type',
          `currency` = '$sel_cur_description',
          `qty` = '$inp_qty_ar',
          `unit_price` = '$inp_unit_price_ar',
          `amount` = '$inp_amt_ar_s',
          `vat` = '$inp_vat_s',
          `amtinclvat` = '$inp_amt_icv_ar_s',
          `remark` = '$inp_remark'
      WHERE
          ID = '$val_id'
    ";
    $status = $con->query($sql_update);

    }
    echo json_encode($status);
}
    
