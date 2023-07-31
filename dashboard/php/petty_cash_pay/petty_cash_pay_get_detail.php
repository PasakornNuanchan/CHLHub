<?php
include '../../core/conn.php';
$sql_pay ="
SELECT
    cp.ID,
    cp.type_payble,
    cp.payto_payble,
    cp.description_payble,
    cp.amount_payble,
    cp.currency_payble,
    cp.img_payble,
    cp.remark_payble,
    cp.ref_job_id,
    cp.status,
    cp.datetime_paid,
    cp.paid_by,
    cp.create_by,
    cp.create_datetime,
    cp.petty_cash_number,
    jt.job_number,
    u.first_name as ufn,
    u.last_name as uln,
    u1.first_name as u1fn,
    u1.last_name as u1ln,
    u.bank_number as bnb,
    u.bank_name as bbn,
    cp.type_pay
FROM
    cash_pay cp
LEFT JOIN job_title jt ON jt.ID = cp.ref_job_id
LEFT JOIN user u ON cp.create_by = u.ID
LEFT JOIN user u1 ON cp.paid_by = u1.ID
WHERE 
 cp.type_payble IN ('Payble')
";

$result = $con->query($sql_pay);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_pay[] = $row;
  }
} else {
  $data_pay = "0 results";
}

$sql_pettycash ="
SELECT
    pct.ID,
    pct.petty_cash_number,
    pct.request_by,
    pct.datetime_request,
    pct.total_amount_request,
    pct.total_amount_request_cur,
    pct.tranfer_method,
    pct.tranfer_bank_name,
    pct.tranfer_bank_number,
    pct.tranfer_amount,
    pct.tranfer_amount_cur,
    pct.tranfer_by,
    pct.tranfer_datetime,
    pct.tranfer_recript,
    pct.cash_return,
    pct.amount_return,
    pct.return_payment_method,
    pct.return_payment_by,
    pct.return_payment_datetime,
    pct.return_payment_receipt,
    pct.amount_return_cur,
    pct.status_doc,
    u.first_name,
    u.last_name
FROM
    petty_cash_title pct
    LEFT JOIN user u ON pct.request_by = u.ID
WHERE
    1
";

$result = $con->query($sql_pettycash);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_petty_cash[] = $row;
    $data_id_petty_cash_title[] = "'".$row['petty_cash_number']."'";
  }
} else {
  $data_petty_cash = "0 results";
}

$imp_set_petty_cash_detail = strval(implode(",",$data_id_petty_cash_title));

$sql_petty_cash_detail = "
  SELECT
    pcd.ID,
    pcd.petty_cash_number,
    pcd.job_number,
    pcd.amount,
    pcd.currency,
    pcd.pcd_status,
    jt.job_number as job_number_main
FROM
    petty_cash_detail pcd
LEFT JOIN job_title jt ON pcd.job_number = jt.ID
WHERE
    petty_cash_number IN ($imp_set_petty_cash_detail)
  ";

  $result = $con->query($sql_petty_cash_detail);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $get_detail_petty_cash[] = $row;
      $get_data_id_find_usage[] = $row['ID'];
    }
    foreach($get_detail_petty_cash as $k => $v){
      $arr_get_detail_petty_cash[$v['petty_cash_number']][] = $v;
    }
  }

$imp_set_petty_cash_usage = strval(implode(",",$get_data_id_find_usage));
$sql_petty_cash_usage = "
SELECT
    `ID`,
    `type_payble`,
    `payto_payble`,
    `description_payble`,
    `amount_payble`,
    `currency_payble`,
    `img_payble`,
    `remark_payble`,
    `ref_job_id`,
    `status`,
    `datetime_paid`,
    `paid_by`,
    `create_by`,
    `create_datetime`,
    `petty_cash_number`,
    `img_pay`,
    `type_pay`
FROM
    `cash_pay`
WHERE
  petty_cash_number IN ($imp_set_petty_cash_usage)
";

$result = $con->query($sql_petty_cash_usage);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $get_data_usage[] = $row;
    }
    foreach($get_data_usage as $k => $v){
      $arr_get_detail_petty_cash_usage[$v['petty_cash_number']][] = $v;
    }
  }



$sql_advancecash ="
SELECT
    cp.ID,
    cp.type_payble,
    cp.payto_payble,
    cp.description_payble,
    cp.amount_payble,
    cp.currency_payble,
    cp.img_payble,
    cp.remark_payble,
    cp.ref_job_id,
    cp.status,
    cp.datetime_paid,
    cp.paid_by,
    cp.create_by,
    cp.create_datetime,
    cp.petty_cash_number,
    jt.job_number,
    u.first_name as ufn,
    u.last_name as uln,
    u1.first_name as u1fn,
    u1.last_name as u1ln,
    u.bank_number as bnb,
    u.bank_name as bbn,
    cp.type_pay
FROM
    cash_pay cp
LEFT JOIN job_title jt ON jt.ID = cp.ref_job_id
LEFT JOIN user u ON cp.create_by = u.ID
LEFT JOIN user u1 ON cp.paid_by = u1.ID
WHERE 
 cp.type_payble IN ('Advancecash')
";

$result = $con->query($sql_advancecash);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_advance_cash[] = $row;
  }
} else {
  $data_advance_cash = "0 results";
}



echo json_encode(array('data_pay'=>$data_pay,
'data_petty_cash'=>$data_petty_cash,
'arr_get_detail_petty_cash'=>$arr_get_detail_petty_cash,
'data_advance_cash'=>$data_advance_cash,
'arr_get_detail_petty_cash_usage'=>$arr_get_detail_petty_cash_usage));


?>