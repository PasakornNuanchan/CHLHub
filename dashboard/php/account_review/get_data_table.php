<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_radio_process = isset($_POST['data_radio_process']) ? $_POST['data_radio_process'] : '';
$data_radio_select_type = isset($_POST['data_radio_select_type']) ? $_POST['data_radio_select_type'] : '';
$radio_function_select = isset($_POST['radio_function_select']) ? $_POST['radio_function_select'] : '';
$data_data_id = isset($_POST['data_data_id']) ? $_POST['data_data_id'] : '';
$data_data_type = isset($_POST['data_data_type']) ? $_POST['data_data_type'] : '';
$data_name_type = isset($_POST['data_name_type']) ? $_POST['data_name_type'] : '';
$cb_check = isset($_POST['cb_check']) ? $_POST['cb_check'] : '';
$cb_apply = isset($_POST['cb_apply']) ? $_POST['cb_apply'] : '';
$cb_appove = isset($_POST['cb_appove']) ? $_POST['cb_appove'] : '';
$job_number = isset($_POST['job_number']) ? $_POST['job_number'] : '';
$billing_code = isset($_POST['billing_code']) ? $_POST['billing_code'] : '';

$data_option_sale = isset($_POST['data_option_sale']) ? $_POST['data_option_sale'] : '';
$data_option_cs = isset($_POST['data_option_cs']) ? $_POST['data_option_cs'] : '';
$data_select_search = isset($_POST['data_select_search']) ? $_POST['data_select_search'] : '';
$inp_date_start = isset($_POST['inp_date_start']) ? $_POST['inp_date_start'] : '';
$inp_data_end = isset($_POST['inp_data_end']) ? $_POST['inp_data_end'] : '';

if ($data_radio_process == '') {
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
          (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID) as sale_support,
          (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID) as cs_support,
          (SELECT jt.create_date FROM job_title jt WHERE b.ref_job_id = jt.ID) as create_job,
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
          (SELECT u5.last_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_l,
          (SELECT u6.first_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_f,
          (SELECT u6.last_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_l,
          (SELECT jt.booking_number FROM job_title jt WHERE jt.ID = b.ref_job_id) booking_no,
          (SELECT GROUP_CONCAT(con.container_number) FROM container con WHERE b.ref_job_id = con.ref_job_id) container,
          bpl.amount as amount_paid,
          bpl.currency as currency_paid

      FROM
          billing b
          LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID 

      WHERE
          b.type = 'AR'
    ";
} else {

    // $cb_check
    if ($cb_check == '1') {
        $sql_check = "AND b.check_by IS NOT NULL";
    } else {
        $sql_check = "AND b.check_by IS NULL";
    }

    // $cb_apply
    if ($cb_apply == '1') {
        $sql_apply = "AND b.action_paid_by IS NOT NULL";
    } else {
        $sql_apply = "AND b.action_paid_by IS NULL";
    }
    // $cb_appove
    if ($cb_appove == '1') {
        $sql_approve = "AND b.approve_by IS NOT NULL ";
    } else {
        $sql_approve = "AND b.approve_by IS NULL ";
    }

    if($cb_check == '0' && $cb_apply == '0' && $cb_appove == '0'){
        $sql_check = "";
        $sql_apply = "";
        $sql_approve = "";
    }
    // $data_radio_select_type

    $sql_data_type = "";
    $having_type = "";
    


    // $data_radio_process
    if($data_radio_process == "Rprocess"){
        if ($data_radio_select_type == "All") {
            $sql_data_type = "
            AND b.status != '0'
            ";
        } elseif ($data_radio_select_type == "Unpaid") {
            $sql_data_type = "
            $sql_check
            $sql_apply
            AND b.status = '2'
            AND bpl.amount IS null
            ";
        } elseif ($data_radio_select_type == "Paid") {
            $sql_data_type = "
            $sql_check
            $sql_apply
            AND b.status = '2'
            AND bpl.amount IS NOT null
            "; 
        } elseif ($data_radio_select_type == "Reject") {
            $sql_data_type = "AND b.status = '3'";
        }
        
    }else{
        if ($data_radio_select_type == "All") {
            $sql_data_type = "";
        } elseif ($data_radio_select_type == "Unpaid") {
            $sql_data_type = "
                $sql_check
                $sql_apply
                $sql_approve
                AND b.status != '3' 
                AND bpl.amount IS null

            ";
        } elseif ($data_radio_select_type == "Paid") {
            $sql_data_type = "
                $sql_check
                $sql_apply
                $sql_approve

                
                AND b.status != '3'
                AND bpl.amount IS NOT null
            ";
            // $having_type = "AND billing_payment IS NOT NULL";
        } elseif ($data_radio_select_type == "Reject") {
            $sql_data_type = "AND b.status = '3'";
        }
    }
    // echo $data_radio_select_typ;
    // $radio_function_select
    $data_query_type = '';
    $sql_radio_function_select = '';
    if ($radio_function_select == "receivable") {
        $sql_radio_function_select = "AR";
        $data_query_type = "(SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to) as bill_to_c,";
    } else {
        $sql_radio_function_select = "AP";
        $data_query_type = "if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
        (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,";
    }

    $having_data = "";
    if ($job_number != '' || $billing_code != '' || $data_name_type != '' || $having_type != '' || $data_option_sale != '' || $data_option_cs != '' || $data_select_search != '') {
        
        $job_number = $job_number ? "AND job_number = '$job_number'" : '';
        $billing_code = $billing_code ? "AND billing_code = '$billing_code'" : '';
        $data_name_type = $data_name_type ? "AND bill_to_c = '$data_name_type'" : '';
        $data_option_sale = $data_option_sale ? "AND sale_support = '$data_option_sale'" : '';
        $data_option_cs = $data_option_cs ? "AND cs_support = '$data_option_cs'" : '';

        $data_select_search = $data_select_search != "" ? "AND $data_select_search BETWEEN '$inp_date_start' AND '$inp_data_end'" : '';


        // $inp_date_start
        // $inp_data_end

        $having_data = "
        HAVING
        1=1
        $job_number
        $billing_code
        $data_name_type
        $data_option_sale
        $data_option_cs
        $data_select_search
        $having_type
        ";
    }


    // $job_number
    // $billing_code

    // $data_option_sale
    // $data_option_cs
    // $data_select_search
    // $inp_date_start
    // $inp_data_end



    $sql_data_table = "
    SELECT
          b.ID,
          (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
        (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
          b.bill_to_type,
          b.bill_to,
          b.billing_description as billing_des_id,
          $data_query_type
          b.payble,
          b.currency,
          b.qty,
          b.unit_price,
          b.amount,
          b.vat,
          b.amtinclvat,
          b.remark,
          b.type,
          (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID) as sale_support,
          (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID) as cs_support,
          (SELECT jt.create_date FROM job_title jt WHERE b.ref_job_id = jt.ID) as create_job,
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
          (SELECT bp.paid_by FROM billing_payment bp WHERE bp.ref_billing_id = b.ID) billing_payment,
          bpl.amount as amount_paid,
          bpl.currency as currency_paid

      FROM
          billing b
          LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID 

          
      WHERE
            b.type = '$sql_radio_function_select'
            $sql_data_type
    $having_data 
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
