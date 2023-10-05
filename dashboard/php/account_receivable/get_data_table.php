<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$arr_data = $_POST['arr_data'];

if ($arr_data[0]['data_status'] != '') {

  foreach ($arr_data as $k => $v) {

    $data_status = isset($v['data_status']) ? $v['data_status'] : '';
    $data_bill_to_serach = isset($v['data_bill_to_serach']) ? $v['data_bill_to_serach'] : '';
    $type_bill_to_serach = isset($v['type_bill_to_serach']) ? $v['type_bill_to_serach'] : '';
    $job_number_data_serach = isset($v['job_number_data_serach']) ? $v['job_number_data_serach'] : '';
    $hbl_data_serach = isset($v['hbl_data_serach']) ? $v['hbl_data_serach'] : '';
    $container_data_serach = isset($v['container_data_serach']) ? $v['container_data_serach'] : '';
    $billing_data_serach = isset($v['billing_data_serach']) ? $v['billing_data_serach'] : '';
    $data_search = isset($v['data_search']) ? $v['data_search'] : '';
    $data_start_date = isset($v['data_start_date']) ? $v['data_start_date'] : '';
    $data_end_date = isset($v['data_end_date']) ? $v['data_end_date'] : '';
    $sale_data_search = isset($v['sale_data_search']) ? $v['sale_data_search'] : '';
    $cs_data_search = isset($v['cs_data_search']) ? $v['cs_data_search'] : '';
    // $data_action_status = isset($v['data_action_status']) ? $v['data_action_status'] : '';

    
    $data_checked_create = isset($v['data_checked_create']) ? $v['data_checked_create'] : '';
    $data_checked_check = isset($v['data_checked_check']) ? $v['data_checked_check'] : '';
    $data_checked_applied = isset($v['data_checked_applied']) ? $v['data_checked_applied'] : '';
    $data_checked_approve = isset($v['data_checked_approve']) ? $v['data_checked_approve'] : '';
    $data_checked_paid = isset($v['data_checked_paid']) ? $v['data_checked_paid'] : '';
    $data_checked_all = isset($v['data_checked_all']) ? $v['data_checked_all'] : '';
    // $action_paid = $data_action_paid == '1' ? 
    // $action_unpaid = $data_action_unpaid == '1' ? 
    // $action_created = $data_action_created == '1' ? "AND b.create_data_time is NOT NULL" : '';
    // $action_applied = $data_action_applied == '1' ? "AND b.action_paid_date_time is NOT NULL " : '';
    // $action_approved = $data_action_approved == '1' ? "AND b.create_data_time is NOT NULL " : '';
  

    $bill_to = $type_bill_to_serach != '' ? "AND b.bill_to_type = '$type_bill_to_serach' AND b.bill_to = '$data_bill_to_serach' " : '';
    $job_number = $job_number_data_serach != '' ? "AND b.ref_job_id ='$job_number_data_serach' " : '';
    $hbl = $hbl_data_serach != '' ? "AND bl.hbl = '$hbl_data_serach' " : '';
    $container = $container_data_serach != '' ? "AND c1.container_number = '$container_data_serach' " : '';
    $billing_des = $billing_data_serach != '' ? "AND b.billing_description ='$billing_data_serach ' " : '';;
    $sale_support = $sale_data_search != '' ? "AND jt.sale_support = '$sale_data_search' " : '';
    $cs_support = $cs_data_search != '' ? "AND jt.cs_support = '$cs_data_search' " : '';

    if($data_search != ''){
      if($data_search == '1'){
        $search_date = "AND b.create_data_time BETWEEN '$data_start_date' AND '$data_end_date' ";
      }else if($data_search = '2'){
        $search_date = "AND b.check_date_time BETWEEN '$data_start_date' AND '$data_end_date' ";
      }else if($data_search = '3'){
        $search_date = "AND b.action_paid_date_time BETWEEN '$data_start_date' AND '$data_end_date' ";
      }
    }
    // $search_action_status = '';
    // if($data_action_status != ''){
    //   if($data_action_status == '1'){
    //     $search_action_status = "AND b.create_data_time is NOT NULL AND b.check_date_time is NULL AND b.action_paid_date_time is NULL AND b.approve_date_time is NULL";
    //   }else if($data_action_status == '2'){
    //     $search_action_status = "AND b.create_data_time is NOT NULL AND b.check_date_time is NOT NULL AND b.action_paid_date_time is NULL AND b.approve_date_time is NULL";
    //   }else if($data_action_status == '3'){
    //     $search_action_status = "AND b.create_data_time is NOT NULL AND b.check_date_time is NOT NULL AND b.action_paid_date_time is NOT NULL AND b.approve_date_time is NULL";
    //   }else if($data_action_status == '4'){
    //     $search_action_status = "AND b.create_data_time is NOT NULL AND b.check_date_time is NOT NULL AND b.action_paid_date_time is NOT NULL AND b.approve_date_time is NOT NULL";
    //   }else if($data_action_status == '5'){
    //     $search_action_status = "AND b.create_data_time is NOT NULL AND b.check_date_time is NOT NULL AND b.action_paid_date_time is NOT NULL";
    //   }else {
    //     $search_action_status = "";
    //   }
    // }

    
 
    
  $check_create = $data_checked_create == '1' ? "AND b.create_data_time IS NOT NULL" : "AND b.create_data_time IS NULL";
  $check_checked = $data_checked_check == '1' ? "AND b.check_date_time IS NOT NULL" : "AND b.check_date_time IS NULL";
  $check_apply = $data_checked_applied == '1'  ? "AND b.action_paid_date_time IS NOT NULL" : "AND b.action_paid_date_time IS NULL";
  $check_approve = $data_checked_approve == '1' ? "AND b.approve_date_time IS NOT NULL" : "AND b.approve_date_time IS NULL";
//  $check_paid = $data_checked_paid == '1' ? "AND "
  $check_all = $data_checked_all == '1' ? "" : $check_create." ".$check_checked." ".$check_apply." ".$check_approve ;


 $sql_query_data = "
    SELECT
        b.ID,
        b.billing_description,
        (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
        jt.cs_support,
        (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.cs_support) cs_support_name,
        (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.sale_support) sale_support_name,
        (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.create_by) create_by_name,
        (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.check_by) check_by_name,
        (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
        (SELECT cons.consignee_name FROM consignee cons WHERE cons.ID = b.bill_to) as bill_to_c,
        GROUP_CONCAT(c1.container_number) container_data,
        GROUP_CONCAT(bl.hbl) hbl_data,
        jt.booking_number,
        jt.create_date,
        b.bill_to_type,
        b.bill_to,
        b.payble,
        b.currency,
        b.qty,
        b.unit_price,
        b.amount,
        b.vat,
        b.amtinclvat,
        b.remark,
        b.type,
        b.create_data_time,
        b.create_by,
        b.delete_date_time,
        b.delete_by,
        b.action_paid_by,
        b.action_paid_date_time,
        b.check_by,
        b.check_date_time,
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
        b.approve_by,
        b.approve_date_time
    FROM
        `billing` b
        LEFT JOIN job_title jt ON jt.ID = b.ref_job_id
        LEFT JOIN container c1 ON b.ref_job_id = c1.ref_job_id
        LEFT JOIN bl_title bl ON b.ref_job_id = bl.ref_job_id
    WHERE
        b.type = 'AR'
        $bill_to
        $job_number
        $hbl
        $container
        $billing_des
        $sale_support
        $cs_support
        $search_date
        $check_all
    GROUP BY
      b.ID
    ";
  }

  $result = $con->query($sql_query_data);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $table[] = $row;
    }
  } else {
    $table = "0 results";
  }

} else {

  $sql_query_data = "
  SELECT
  b.ID,
  b.billing_description,
  (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
  jt.cs_support,
  (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.cs_support) cs_support_name,
  (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.sale_support) sale_support_name,
  (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.create_by) create_by_name,
  (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.check_by) check_by_name,
  (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
  (SELECT cons.consignee_name FROM consignee cons WHERE cons.ID = b.bill_to) as bill_to_c,
  GROUP_CONCAT(c1.container_number) container_data,
  GROUP_CONCAT(bl.hbl) hbl_data,
  jt.booking_number,
  jt.create_date,
  b.bill_to_type,
  b.bill_to,
  b.payble,
  b.currency,
  b.qty,
  b.unit_price,
  b.amount,
  b.vat,
  b.amtinclvat,
  b.remark,
  b.type,
  b.create_data_time,
  b.create_by,
  b.delete_date_time,
  b.delete_by,
  b.action_paid_by,
  b.action_paid_date_time,
  b.check_by,
  b.check_date_time,
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
  b.approve_by,
  b.approve_date_time
FROM
  `billing` b
  LEFT JOIN job_title jt ON jt.ID = b.ref_job_id
  LEFT JOIN container c1 ON b.ref_job_id = c1.ref_job_id
  LEFT JOIN bl_title bl ON b.ref_job_id = bl.ref_job_id
WHERE
  b.type = 'AR'
GROUP BY
b.ID
      ";

  $result = $con->query($sql_query_data);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $table[] = $row;
    }
  } else {
    $table = "0 results";
  }
}




echo json_encode(array('table' => $table));
