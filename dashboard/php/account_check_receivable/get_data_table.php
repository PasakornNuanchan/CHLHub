<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];

if($arr_data[0] != ''){
  foreach($arr_data as $k =>$v){

    $data_type = isset($v['data_type']) ? $v['data_type'] : '';
    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    $data_job = isset($v['data_job']) ? $v['data_job'] : '';
    $data_currency = isset($v['data_currency']) ? $v['data_currency'] : '';

    


    $data_query_type_n_id = $data_type != "" ? "AND b.bill_to_type = '$data_type' AND b.bill_to = '$data_id' " : '';
    $data_query_job = $data_job != "" ? "AND b.ref_job_id = '$data_job' " : '';
    $data_query_currency = $data_currency != "" ? "AND b.currency = '$data_currency' " : '';
    // $data_job
    // $data_currency


    $sql_get_data_table = "
      SELECT
          (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
          (SELECT concat(first_name,' ',last_name) FROM user WHERE user.ID = (SELECT sale_support FROM job_title WHERE ID = b.ref_job_id)) sale_support,
          if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
          (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
          (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
          b.currency,
          b.ref_job_id,
          b.ID,
          b.qty,
          b.unit_price,
          b.vat,
          b.remark,
          b.sys_rate,
          b.sys_rate_currency
      FROM
          billing b
      WHERE
          b.type = 'AR' 
          AND b.type = 'AR' 
          AND b.approve_date_time IS NOT NULL
          $data_query_type_n_id
          $data_query_job
          $data_query_currency
      ";


  }
  
}else{
  $sql_get_data_table = "
  SELECT
      (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
      (SELECT concat(first_name,' ',last_name) FROM user WHERE user.ID = (SELECT sale_support FROM job_title WHERE ID = b.ref_job_id)) sale_support,
      if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
      (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
      (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
      b.currency,
      b.ID,
      b.qty,
      b.unit_price,
      b.vat,
      b.remark,
      b.sys_rate,
      b.sys_rate_currency
  FROM
      billing b
  WHERE
      b.type = 'AR' AND b.type = 'AR' AND b.approve_date_time IS NOT NULL
  ";
}



$result = $con->query($sql_get_data_table);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $table[] = $row;
    }
  } else {
    $table = "0 results";
  }


  echo json_encode(array('table'=>$table));
