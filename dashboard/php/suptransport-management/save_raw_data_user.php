<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];



$suptransport_id = isset($_POST['uset_arr_temp']['suptransport_id']) ? $_POST['uset_arr_temp']['suptransport_id'] : '';
$cname = isset($_POST['uset_arr_temp']['cname']) ? $_POST['uset_arr_temp']['cname'] : '';
$address = isset($_POST['uset_arr_temp']['address']) ? $_POST['uset_arr_temp']['address'] : '';
$tax = isset($_POST['uset_arr_temp']['tax']) ? $_POST['uset_arr_temp']['tax'] : '';
$email = isset($_POST['uset_arr_temp']['email']) ? $_POST['uset_arr_temp']['email'] : '';
$phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
$line = isset($_POST['uset_arr_temp']['line']) ? $_POST['uset_arr_temp']['line'] : '';
$fax = isset($_POST['uset_arr_temp']['fax']) ? $_POST['uset_arr_temp']['fax'] : '';
$linkman = isset($_POST['uset_arr_temp']['linkman']) ? $_POST['uset_arr_temp']['linkman'] : '';
$linkman_tel = isset($_POST['uset_arr_temp']['linkman_tel']) ? $_POST['uset_arr_temp']['linkman_tel'] : '';


if ($suptransport_id != 'undefined') {
    $sql_save = "
        UPDATE
            `transport_sup`
        SET
            `transport_sup_name` = '$cname',
            `tel` = '$phone_number',
            `fax` = '$fax',
            `linkman` = '$linkman',
            `email` = '$email',
            `line` = '$line',
            `linkman_tel` = '$linkman_tel',
            `address` = '$address',
            `tax` = '$tax'
        WHERE
            `ID` = '$suptransport_id'
                        ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
} else {

    $check_corp_name = "
        SELECT transport_sup_name FROM transport_sup WHERE transport_sup_name = '$cname'
        ";
    $result_check_corp_name = $con->query($check_corp_name);

    

    if ($result_check_corp_name->num_rows > 0) {
        $arr_suc['st'] = '4';
        
    }else{
        $sql_save = "
        INSERT INTO `transport_sup`(
            `transport_sup_name`,
            `tel`,
            `fax`,
            `linkman`,
            `email`,
            `line`,
            `linkman_tel`,
            `address`,
            `tax`
        )
        VALUES(
            '$cname',
            '$phone_number',
            '$fax',
            '$linkman',
            '$email',
            '$line',
            '$linkman_tel',
            '$address',
            '$tax'
        )
                                ";
        if ($con->query($sql_save) != 1) {
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
        }
    }
}





echo json_encode($arr_suc);
