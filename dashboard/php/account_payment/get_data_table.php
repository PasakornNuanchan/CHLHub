<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_radio_process = isset($_POST['data_radio_process']) ? $_POST['data_radio_process'] : '';
$data_radio_select_type = isset($_POST['data_radio_select_type']) ? $_POST['data_radio_select_type'] : '';
$data_data_id = isset($_POST['data_data_id']) ? $_POST['data_data_id'] : '';
$data_data_type = isset($_POST['data_data_type']) ? $_POST['data_data_type'] : '';
$data_name_type = isset($_POST['data_name_type']) ? $_POST['data_name_type'] : '';
$job_number = isset($_POST['job_number']) ? $_POST['job_number'] : '';
$dn_cn = isset($_POST['dn_cn']) ? $_POST['dn_cn'] : '';

if($data_radio_process == ''){
    $sql_data_table = "
    SELECT
    b.ID,
    (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
    (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
    b.bill_to_type,
    b.bill_to,
    b.billing_description as billing_des_id,
    (SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to) as bill_to_c,
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
    (SELECT u4.first_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_f,
    (SELECT u4.last_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_l,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_f,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_l,
    (SELECT u6.first_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_f,
    (SELECT u6.last_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_l,
    (SELECT jt.booking_number FROM job_title jt WHERE jt.ID = b.ref_job_id) booking_no,
    (SELECT GROUP_CONCAT(con.container_number) FROM container con WHERE b.ref_job_id = con.ref_job_id) container,
    (SELECT bpl.amount FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID) billing_payment_spend,
    (SELECT bpl.currency FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID) billing_payment_cur,
    (SELECT jt.create_date FROM job_title jt WHERE jt.ID = b.ref_job_id) create_date_job

    FROM
    billing b
    WHERE
    b.type = 'AR' 
    AND b.status = '2'
    HAVING
    billing_payment_spend is null
    ORDER BY
    job_number
    

";
}else{

    // $data_query_type = '';
    // $sql_radio_function_select = '';


    // if ($data_radio_process == "pro") {
        // $data_query_type = "(SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to) as bill_to_c,";
    // } else {
        // $data_query_type = "if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
        // (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,";
    // }

    // $data_radio_process
    // if($data_radio_process == "process"){
    // 
    // }else{
    // 
    // }

    // $data_radio_select_type
    // $data_data_id
    // $data_data_type
    // $data_name_type
    $data_having = "
    HAVING
    billing_payment_spend is null";

    if($data_name_type != '0' || $job_number != '' || $dn_cn != ''){


        $data_name_type = $data_name_type != '0' ? "AND bill_to_c = '$data_name_type'" : "";
        $job_number = $job_number != '' ? "AND job_number = '$job_number'" : "";
        // $dn_cn

        
        $data_having = "
        HAVING
        1=1
        $data_name_type
        $job_number 
        
        AND billing_payment_spend is null
        ";
    }

    $data_bill_to_c = "";
    if($data_radio_select_type == "AR"){
        $data_bill_to_c = "(SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to) as bill_to_c,";
    }else{
        $data_bill_to_c = "if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
        (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,";
    }
    // $job_number
    // $dn_cn

    $sql_data_table = "
    SELECT
    b.ID,
    (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
    (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
    b.bill_to_type,
    b.bill_to,
    b.billing_description as billing_des_id,
    $data_bill_to_c
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
    (SELECT u4.first_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_f,
    (SELECT u4.last_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_l,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_f,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_l,
    (SELECT u6.first_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_f,
    (SELECT u6.last_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_l,
    (SELECT jt.booking_number FROM job_title jt WHERE jt.ID = b.ref_job_id) booking_no,
    (SELECT GROUP_CONCAT(con.container_number) FROM container con WHERE b.ref_job_id = con.ref_job_id) container,
    (SELECT bpl.amount FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID) billing_payment_spend,
    (SELECT bpl.currency FROM billing_payment_list bpl WHERE bpl.data_number_id = b.ID) billing_payment_cur,
    (SELECT jt.create_date FROM job_title jt WHERE jt.ID = b.ref_job_id) create_date_job
    FROM
    billing b
    WHERE
    b.type = '$data_radio_select_type' 
    AND b.status = '2'
    $data_having
    ORDER BY
    job_number
    ";


}

// echo $sql_data_table;

$result = $con->query($sql_data_table);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table[] = $row;
    }
} else {
    $table = "0 results";
}
echo json_encode(array('table' => $table));
