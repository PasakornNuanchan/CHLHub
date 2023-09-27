<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];


if($arr_data['arr_data'] != '1'){
  echo "test";
}else{
  $sql_query_data = "
  SELECT
      bank.ID,
      bank.location,
      bank.country,
      bank.payment_menthod,
      bank.bank_code,
      bank.company_name,
      bank.bank_account,
      bank.currency,
      bank.bank_brunch,
      bank.bank_address,
      bank.swift_code,
      bank.bank_telephone,
      bank.commercial_number,
      bank.tax_number,
      bank.create_by,
      bank.create_datetime,
      bank.last_modify_by,
      bank.last_modify_datetime,
      u1.first_name create_fn,
      u1.last_name create_ln,
      u2.last_name last_fn,
      u2.last_name last_ln
  FROM
      acbank bank
  LEFT JOIN user u1 ON bank.create_by = u1.ID
  LEFT JOIN user u2 ON bank.last_modify_by = u2.ID
  WHERE
      1
  ";
  $result = $con->query($sql_query_data);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $get_bank_account[] = $row;
    }
  } else {
    $get_bank_account = "0 results";
  }
}






echo json_encode(array('get_bank_account'=>$get_bank_account))

?>



