
<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

// $arr_data_list_del = $_POST['arr_data_list_del'] ? $_POST['arr_data_list_del'] : '';
$arr_data_list_upd = $_POST['arr_data_list_upd'] ? $_POST['arr_data_list_upd'] : '';
$arr_data_title = $_POST['arr_data_title'] ? $_POST['arr_data_title'] : '';
$arr_recipt = $_POST['arr_recipt'] ? $_POST['arr_recipt'] : '';
$arr_create = $_POST['arr_create'] ? $_POST['arr_create'] : '';
$data_del_receipt = $_POST['data_del_receipt'] ? $_POST['data_del_receipt'] : '';

if($arr_data_title != ""){
    foreach($arr_data_title as $k => $v){
   
        // $data_payment_place = isset($v['sel_data_payment_place']) ? $v['sel_data_payment_place'] : '';
        $payment_document = isset($v['payment_document']) ? $v['payment_document'] : '';
        $id_payment = isset($v['id_payment']) ? $v['id_payment'] : '';
        $data_join = isset($v['data_join']) ? $v['data_join'] : '';
        $data_payment_place = isset($v['data_payment_place']) ? $v['data_payment_place'] : '';
        $method_cash = isset($v['method_cash']) ? $v['method_cash'] : '';
        $number_rec = isset($v['number_rec']) ? $v['number_rec'] : '';
        $currency_main = isset($v['currency_main']) ? $v['currency_main'] : '';
        $number_payment_record = isset($v['number_payment_record']) ? $v['number_payment_record'] : '';
        $payment_date = $v['payment_date'] != "" ? "'".$v['payment_date']."'" : "null";
        $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
        $remark_data_modal = isset($v['remark_data_modal']) ? $v['remark_data_modal'] : '';
    
    
        $amount_all_write_off = isset($v['amount_all_write_off']) ? $v['amount_all_write_off'] : '';
        $amount_all = isset($v['amount_all']) ? $v['amount_all'] : '';
        $acual_payment = isset($v['acual_payment']) ? $v['acual_payment'] : '';
        $data_number_rec = isset($v['data_number_rec']) ? $v['data_number_rec'] : '';
        $number_payment_rec = isset($v['number_payment_rec']) ? $v['number_payment_rec'] : '';
    
        $sql_query_data_title = "
        UPDATE
            `billing_payment`
        SET
            `paid_amt` = '$amount_all_write_off',
            `pay_at` = '$data_payment_place',
            `tranfer_method` = '$method_cash',
            `document_payment` = '$payment_document',
            `payment_date` = $payment_date,
            `remark` = '$remark_data_modal',
            `ref_billing` = '$data_join',
            `currency_end` = '$currency_main',
            `actual_total_payment` = '$amount_all',
            `payment_rec` = '$number_payment_rec'
            
        WHERE
            ID = '$id_payment'
        ";
    
        // echo $sql_query_data_title;
        if ($con->query($sql_query_data_title) === TRUE) {
            $last_id = $con->insert_id;
            $billing_payment = '1';
        } else {
            $billing_payment = '0';
        }
    }
}

if($arr_data_list_upd != ""){
    foreach($arr_data_list_upd as $k => $v){
        // $data_id = isset($v['data_id']) ? $v['data_id'] : '';
        // $id_bp = isset($v['id_bp']) ? $v['id_bp'] : '';
        // $currency_to = isset($v['currency_to']) ? $v['currency_to'] : '';
        // $id_currency = isset($v['id_currency']) ? $v['id_currency'] : '';
        // $incv_wrute_off = isset($v['incv_wrute_off']) ? $v['incv_wrute_off'] : '';
        // $data_modal = isset($v['data_modal']) ? $v['data_modal'] : '';

        // $sql_query_data_list = "
        // INSERT INTO `billing_payment_list`(
        //     `data_number_id`,
        //     `amount`,
        //     `currency`,
        //     `id_refer_bp`,
        //     `currency_number`,
        //     `status_list`
        // )
        // VALUES(
        //     '$data_id',
        //     '$incv_wrute_off',
        //     '$currency_to',
        //     '$id_bp',
        //     '$id_currency',
        //     '$data_modal'
        // )
        // ";

        $id_number = isset($v['id_number']) ? $v['id_number'] : '';
        $data_id = isset($v['data_id']) ? $v['data_id'] : '';
        $id_bp = isset($v['id_bp']) ? $v['id_bp'] : '';
        $data_modal = isset($v['data_modal']) ? $v['data_modal'] : '';

        $sql_query_data_list = "
        UPDATE
            `billing_payment_list`
        SET
            `status_list` = '$data_modal'
        WHERE
            data_number_id = '$id_number'
        ";
        // echo $sql_query_data_list;
        if ($con->query($sql_query_data_list) === TRUE) {
            $billing_payment_list = '1';
        } else {
            $billing_payment_list = '0';
        }
    }
}


if($arr_recipt != ""){
    foreach($arr_recipt as $k => $v){
        //update
        $id_number_receipt = isset($v['id_number_receipt']) ? $v['id_number_receipt'] : '';
        $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
        $currency = isset($v['currency']) ? $v['currency'] : '';
        $actaul_payment = isset($v['actaul_payment']) ? $v['actaul_payment'] : '';
        $type_data = isset($v['type_data']) ? $v['type_data'] : '';
        $name_file = isset($v['name_file']) ? $v['name_file'] : '';
        $Base_64_file_base = isset($v['Base_64_file_base']) ? $v['Base_64_file_base'] : '';
        $payment_date = isset($v['payment_date']) ? $v['payment_date'] : '';

        if($Base_64_file_base != ''){
            $sql_data_receipt = "
            UPDATE
                `billing_receipt`
            SET
                `image_file` = '$Base_64_file_base',
                `image_type` = '$type_data',
                `image_name` = '$name_file',
                `currency_receipt` = '$currency',
                `bank_account` = '$bank_account',
                `payment_date` = '$payment_date',
                `actual_payment` = '$actaul_payment'
            WHERE
                ID = '$id_number_receipt'
            ";
        }else{
            $sql_data_receipt = "
            UPDATE
                `billing_receipt`
            SET
                `currency_receipt` = '$currency',
                `bank_account` = '$bank_account',
                `payment_date` = '$payment_date',
                `actual_payment` = '$actaul_payment'
            WHERE
                ID = '$id_number_receipt'
            ";
        }
        // echo $sql_data_receipt;
        if ($con->query($sql_data_receipt) === TRUE) {
            $billing_payment_list = '1';
        } else {
            $billing_payment_list = '0';
        }
    }
}
if($arr_create != ""){
    foreach($arr_create as $k => $v){
        $get_id_bp = isset($v['get_id_bp']) ? $v['get_id_bp'] : '';
        $id_number_receipt = isset($v['id_number_receipt']) ? $v['id_number_receipt'] : '';
        $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
        $currency = isset($v['currency']) ? $v['currency'] : '';
        $actaul_payment = isset($v['actaul_payment']) ? $v['actaul_payment'] : '';
        $type_data = isset($v['type_data']) ? $v['type_data'] : '';
        $name_file = isset($v['name_file']) ? $v['name_file'] : '';
        $Base_64_file_base = isset($v['Base_64_file_base']) ? $v['Base_64_file_base'] : '';
        $payment_date = isset($v['payment_date']) ? $v['payment_date'] : '';

        $sql_create_data = "
        INSERT INTO `billing_receipt`(
            `ref_billing_payment`,
            `image_file`,
            `image_type`,
            `image_name`,
            `currency_receipt`,
            `bank_account`,
            `payment_date`,
            `actual_payment`
        )
        VALUES(
            '$get_id_bp',
            '$Base_64_file_base',
            '$type_data',
            '$name_file',
            '$currency',
            '$bank_account',
            '$payment_date',
            '$actaul_payment'
        )
        ";
        // echo $sql_create_data;
        if ($con->query($sql_create_data) === TRUE) {
            $billing_payment_list = '1';
        } else {
            $billing_payment_list = '0';
        }
    }
}
if($data_del_receipt != ""){
    foreach($data_del_receipt as $k => $v){
        $id_number_del = isset($v) ? $v : '';
        $sql_del_data = "DELETE FROM `billing_receipt` WHERE ID = '$v'";
        // echo $sql_del_data;
        if ($con->query($sql_del_data) === TRUE) {
            $billing_payment_list = '1';
        } else {
            $billing_payment_list = '0';
        }
    }
}




echo json_encode(array('billing_payment'=>$billing_payment,'billing_payment_list'=>$billing_payment_list))




?>