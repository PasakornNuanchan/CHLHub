<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];


echo $consignee_id = isset($_POST['uset_arr_temp']['consignee_id']) ? $_POST['uset_arr_temp']['consignee_id'] : '';
$corp_name = isset($_POST['uset_arr_temp']['corp_name']) ? $_POST['uset_arr_temp']['corp_name'] : '';
$corp_address = isset($_POST['uset_arr_temp']['corp_address']) ? $_POST['uset_arr_temp']['corp_address'] : '';
$corp_tax_id = isset($_POST['uset_arr_temp']['corp_tax_id']) ? $_POST['uset_arr_temp']['corp_tax_id'] : '';
$corp_email = isset($_POST['uset_arr_temp']['corp_email']) ? $_POST['uset_arr_temp']['corp_email'] : '';
$corp_phone_number = isset($_POST['uset_arr_temp']['corp_phone_number']) ? $_POST['uset_arr_temp']['corp_phone_number'] : '';
$corp_fax = isset($_POST['uset_arr_temp']['corp_fax']) ? $_POST['uset_arr_temp']['corp_fax'] : '';
$corp_linkman = isset($_POST['uset_arr_temp']['corp_linkman']) ? $_POST['uset_arr_temp']['corp_linkman'] : '';
$corp_contact_tel = isset($_POST['uset_arr_temp']['corp_contact_tel']) ? $_POST['uset_arr_temp']['corp_contact_tel'] : '';
$corp_sale_support = isset($_POST['uset_arr_temp']['corp_sale_support']) ? $_POST['uset_arr_temp']['corp_sale_support'] : '';


if ($consignee_id != '') {
    $sql_save = "
        UPDATE
            `consignee`
        SET
            `tel` = '$corp_phone_number',
            `email` = '$corp_email',
            `tax` = '$corp_tax_id',
            `address` = '$corp_address',
            `contact_person_name` = '$corp_linkman',
            `contact_person_tel` = '$corp_contact_tel',
            `fax` = '$corp_fax',
            `user_sale` = '$corp_sale_support'
        WHERE
            `ID` = '$consignee_id'
                        ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
} else {

    $check_corp_name = "
        SELECT consignee_name FROM consignee WHERE consignee_name = '$corp_name'
        ";
    $result_check_corp_name = $con->query($check_corp_name);
    if ($result_check_corp_name->num_rows > 0) {
        $arr_suc['st'] = '4';
    }else{
        $sql_save = "
                    INSERT INTO `consignee`(
                        `consignee_name`,
                        `tel`,
                        `email`,
                        `tax`,
                        `address`,
                        `contact_person_name`,
                        `contact_person_tel`,
                        `fax`,
                        `user_sale`
                    )
                    VALUES(
                        '$corp_name',
                        '$corp_phone_number',
                        '$corp_email',
                        '$corp_tax_id',
                        '$corp_address',
                        '$corp_linkman',
                        '$corp_contact_tel',
                        '$corp_fax',
                        '$corp_sale_support'
                    )
                                ";
        if ($con->query($sql_save) != 1) {
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
            $last_id = $con->insert_id;
        }
    }
}





echo json_encode(array('arr_suc'=>$arr_suc,'last_id'=>$last_id));
