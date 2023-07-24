<?php
include '../../core/conn.php';
$id_number = $_POST['data'];

$sql_get_data_payble = "
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
    pb.first_name as pbfn,
    pb.last_name as pbln,
    cp.create_by,
    cb.first_name as cbfn,
    cb.last_name as cbln,
    cp.create_datetime
FROM
    cash_pay cp
LEFT JOIN user pb ON cp.paid_by = pb.ID
LEFT JOIN user cb ON cp.create_by = cb.ID
WHERE
    ref_job_id = '$id_number' AND type_payble = 'Payble'
";

$result = $con->query($sql_get_data_payble);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_payble[] = $row;
  }
} else {
  $data_payble = "0 results";
}


$sql_get_petty_cash_cash_pay = "
SELECT
    `ID`,
    `petty_cash_number`,
    `job_number`,
    `amount`,
    `currency`,
    `pcd_status`
FROM
    `petty_cash_detail`
WHERE
    job_number = '$id_number'
";
$result = $con->query($sql_get_petty_cash_cash_pay);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_petty_cash[] = $row;
    $data_petty_search[] = $row['ID'];
  }
} else {
  $data_petty_cash = "0 results";
  $data_petty_search = "0 results";
}

if($data_petty_search == "0 results"){
  $data_in_petty_cash = "0 results";
  $arr_data_petty_cash = "0 results";
}else{
  $imp_petty_cash_set = strval(implode(",",$data_petty_search));
  $sql_get_sub_list = "
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
    pb.first_name as pbfn,
    pb.last_name as pbln,
    cp.create_by,
    cb.first_name as cbfn,
    cb.last_name as cbln,
    cp.create_datetime,
    cp.petty_cash_number
FROM
    cash_pay cp
LEFT JOIN user pb ON cp.paid_by = pb.ID
LEFT JOIN user cb ON cp.create_by = cb.ID
WHERE
	type_payble = 'Pettycash' AND petty_cash_number IN($imp_petty_cash_set)
  ";

  $result = $con->query($sql_get_sub_list);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data_in_petty_cash[] = $row;
    }
    foreach($data_in_petty_cash as $k => $v){
        $arr_data_petty_cash[$v['petty_cash_number']][] = $v;
    }
  }
}




// $sql_get_data_pettycash = "
// SELECT
//     cp.ID,
//     cp.type_payble,
//     cp.payto_payble,
//     cp.description_payble,
//     cp.amount_payble,
//     cp.currency_payble,
//     cp.img_payble,
//     cp.remark_payble,
//     cp.ref_job_id,
//     cp.status,
//     cp.datetime_paid,
//     cp.paid_by,
//     pb.first_name as pbfn,
//     pb.last_name as pbln,
//     cp.create_by,
//     cb.first_name as cbfn,
//     cb.last_name as cbln,
//     cp.create_datetime
// FROM
//     cash_pay cp
// LEFT JOIN user pb ON cp.paid_by = pb.ID
// LEFT JOIN user cb ON cp.create_by = cb.ID
// WHERE
//     ref_job_id = '$id_number' AND type_payble = 'Pettycash'
// ";

// $result = $con->query($sql_get_data_pettycash);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $data_pettycash[] = $row;
//   }
// } else {
//   $data_pettycash = "0 results";
// }

$sql_get_data_advancecash = "
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
    pb.first_name as pbfn,
    pb.last_name as pbln,
    cp.create_by,
    cb.first_name as cbfn,
    cb.last_name as cbln,
    cp.create_datetime
FROM
    cash_pay cp
LEFT JOIN user pb ON cp.paid_by = pb.ID
LEFT JOIN user cb ON cp.create_by = cb.ID
WHERE
    ref_job_id = '$id_number' AND type_payble = 'Advancecash'
";

$result = $con->query($sql_get_data_advancecash);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_advancecash[] = $row;
  }
} else {
  $data_advancecash = "0 results";
}

echo json_encode(array(
'data_withdraw'=>$data_payble,
'data_advancecash'=>$data_advancecash,
'data_petty_cash'=>$data_petty_cash,
'arr_data_petty_cash'=>$arr_data_petty_cash
));
