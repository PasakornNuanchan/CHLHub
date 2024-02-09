<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_data_id = isset($_POST['data_data_id']) ? $_POST['data_data_id'] : '';
$data_data_type = isset($_POST['data_data_type']) ? $_POST['data_data_type'] : '';
$data_name_type = isset($_POST['data_name_type']) ? $_POST['data_name_type'] : '';
$job_number = isset($_POST['job_number']) ? $_POST['job_number'] : '';
$billing_code = isset($_POST['billing_code']) ? $_POST['billing_code'] : '';
$data_applied_person = isset($_POST['data_applied_person']) ? $_POST['data_applied_person'] : '';
$data_date_applied = isset($_POST['data_date_applied']) ? $_POST['data_date_applied'] : '';
$radio_p = isset($_POST['radio_p']) ? $_POST['radio_p'] : '';
$radio_type = isset($_POST['radio_type']) ? $_POST['radio_type'] : '';
if ($billing_code == '' && $data_applied_person == '' && $data_date_applied == '' && $radio_p == '') {
  $sql_get_data_table = "
  SELECT
      b.ID,
      (SELECT bd.billing_code FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
    (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
      b.bill_to_type,
      b.bill_to,
      b.billing_description as billing_des_id,
      IF(b.type = 'AR',(SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to),
      if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),(SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to))) as bill_to_c,
      if(b.bill_to_type = '1','GC','CARRIER') as type_bill,
      b.payble,
      b.currency,
      b.qty,
      b.unit_price,
      b.amount,
      b.vat,
      b.amtinclvat,
      b.remark,
      b.type,
      (SELECT u1.first_name FROM user u1 WHERE b.create_by = u1.ID) create_by_f,
      (SELECT u1.last_name FROM user u1 WHERE b.create_by = u1.ID) create_by_l,
      b.create_data_time,
      b.check_by,
      (SELECT u2.first_name FROM user u2 WHERE b.check_by = u2.ID) check_by_f,
      (SELECT u2.last_name FROM user u2 WHERE b.check_by = u2.ID) check_by_l,
      b.check_date_time,
      b.action_paid_by,
      (SELECT u3.first_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_f,
      (SELECT u3.last_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_l,
      b.action_paid_date_time,
      b.approve_by,
      b.approve_date_time,
      b.delete_date_time,
      b.delete_by,
      b.status,
      b.ref_job_id,
      b.add_on,
      b.last_update_by,
      b.last_update_datetime,
      b.sys_rate,
      b.Billing_date,
      b.sys_rate_currency,
      b.tax_with_hold_by,
      b.commit_sale,
      b.tax_with_hold_date_time,
      b.currency_main,
      b.need_vat,
      b.refer,
      b.with_holding_tax,
      b.paid_amt,
      b.pre_approve_by,
      b.pre_approve_dt,
      b.pre_approve_status,
      b.payment_term,
      b.bank_number,
      (SELECT bpl.amount FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID ) amount_paid,
      (SELECT bpl.currency FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID ) currency_paid
  FROM
      billing b
  WHERE b.type = 'AP' AND action_paid_by IS NOT NULL
  ORDER BY
  b.check_by ASC,
  job_number ASC, bill_to_c ASC
  ";
} else {



  if ($billing_code != '' || $data_applied_person != '' || $data_date_applied != '' || $radio_p != '' || $radio_type != '') {

    // $data_name_type
    // $job_number
    // $billing_code
    // $data_applied_person
    // $data_date_applied
    

    // if($radio_p == "")

    if($radio_type == "AP"){
      $data_type_find = "
      b.type='$radio_type'
      AND action_paid_by IS NOT NULL
      ";
    }else{
      $data_type_find = "
      b.type='$radio_type'
      ";
    }
    
    // having
    $data_applied_person = $data_applied_person ? "AND b.action_paid_by = '$data_applied_person'" : '';
    $data_date_applied = $data_date_applied ? "AND b.action_paid_date_time LIKE '%$data_date_applied%'" : '';
    $data_find_where = "
    WHERE
    $data_type_find
    $data_applied_person
    $data_date_applied
    ";

    $radio_pa = $radio_p == "paid" ? "AND amount_paid IS NOT NULL" : '';
    $job_number = $job_number ? "AND job_number = '$job_number'" : '';
    $billing_code = $billing_code ? "AND billing_description = '$billing_code'" : '';
    $data_name_type = $data_name_type ? "AND bill_to_c = '$data_name_type'" : '';
    $data_find_having = "
    Having
    $data_type_find
    $billing_code
    $job_number
    $data_name_type
    $radio_pa
    ";
  }



  $sql_get_data_table = "
  SELECT
      b.ID,
      (SELECT bd.billing_code FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
    (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
      b.bill_to_type,
      b.bill_to,
      b.billing_description as billing_des_id,
      IF(b.type = 'AR',(SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to),
      if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),(SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to))) as bill_to_c,
      if(b.bill_to_type = '1','GC','CARRIER') as type_bill,
      b.payble,
      b.currency,
      b.qty,
      b.unit_price,
      b.amount,
      b.vat,
      b.amtinclvat,
      b.remark,
      b.type,
      (SELECT u1.first_name FROM user u1 WHERE b.create_by = u1.ID) create_by_f,
      (SELECT u1.last_name FROM user u1 WHERE b.create_by = u1.ID) create_by_l,
      b.create_data_time,
      b.check_by,
      (SELECT u2.first_name FROM user u2 WHERE b.check_by = u2.ID) check_by_f,
      (SELECT u2.last_name FROM user u2 WHERE b.check_by = u2.ID) check_by_l,
      b.check_date_time,
      b.action_paid_by,
      (SELECT u3.first_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_f,
      (SELECT u3.last_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_l,
      b.action_paid_date_time,
      b.approve_by,
      b.approve_date_time,
      b.delete_date_time,
      b.delete_by,
      b.status,
      b.ref_job_id,
      b.add_on,
      b.last_update_by,
      b.last_update_datetime,
      b.sys_rate,
      b.Billing_date,
      b.sys_rate_currency,
      b.tax_with_hold_by,
      b.commit_sale,
      b.tax_with_hold_date_time,
      b.currency_main,
      b.need_vat,
      b.refer,
      b.with_holding_tax,
      b.paid_amt,
      b.pre_approve_by,
      b.pre_approve_dt,
      b.pre_approve_status,
      b.payment_term,
      b.bank_number,
      (SELECT bpl.amount FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID ) amount_paid,
      (SELECT bpl.currency FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID ) currency_paid

  FROM
      billing b
      $data_find_where
      $data_find_having
  ORDER BY
  b.check_by ASC,
  job_number
  ";
}

// echo $sql_get_data_table;
$arr_get_to_table = [];
$result = $con->query($sql_get_data_table);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $table[] = $row;
  }

  foreach ($table as $k => $v) {


    $data_table_bill_to_type = $v['bill_to_type'];
    $data_table_bill_to = $v['bill_to'];
    $data_table_jobnumber = $v['job_number'];
    $data_table_currency = $v['currency'];
    $data_table_check_by = $v['check_by'] ? "H" : "NH";

    $data_name_find =
      $data_table_bill_to_type .
      $data_table_bill_to .
      $data_table_jobnumber .
      $data_table_currency .
      $data_table_check_by;

    if(in_array($data_name_find,$arr_get_to_table)){
      $arr_get_to_table[$data_name_find][] = $v;
    }else{
      $arr_get_to_table[$data_name_find][] = $v;
    }
  }
} else {
  $table = "0 results";
}


echo json_encode(array('table' => $arr_get_to_table));

