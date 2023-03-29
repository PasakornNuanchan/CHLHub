<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];



$shipper_id = isset($_POST['uset_arr_temp']['shipper_id']) ? $_POST['uset_arr_temp']['shipper_id'] : '';
$cname = isset($_POST['uset_arr_temp']['cname']) ? $_POST['uset_arr_temp']['cname'] : '';
$address = isset($_POST['uset_arr_temp']['address']) ? $_POST['uset_arr_temp']['address'] : '';
$tax = isset($_POST['uset_arr_temp']['tax']) ? $_POST['uset_arr_temp']['tax'] : '';
$email = isset($_POST['uset_arr_temp']['email']) ? $_POST['uset_arr_temp']['email'] : '';
$phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
$fax = isset($_POST['uset_arr_temp']['fax']) ? $_POST['uset_arr_temp']['fax'] : '';
$linkman = isset($_POST['uset_arr_temp']['linkman']) ? $_POST['uset_arr_temp']['linkman'] : '';
$linkman_tel = isset($_POST['uset_arr_temp']['linkman_tel']) ? $_POST['uset_arr_temp']['linkman_tel'] : '';


if ($shipper_id != 'undefined') {
   $sql_save = "
        UPDATE
            `shipper`
        SET
            `tel` = '$phone_number',
            `fax` = '$fax',
            `linkman` = '$linkman',
            `email` = '$email',
            `address` = '$address',
            `tax` = '$tax',
            `linkman_tel` = '$linkman_tel'
        WHERE
            `ID` = '$shipper_id'
                        ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
} else {

    $check_corp_name = "
        SELECT shipper_name FROM shipper WHERE shipper_name = '$cname'
        ";
    $result_check_corp_name = $con->query($check_corp_name);

    

    if ($result_check_corp_name->num_rows > 0) {
        $arr_suc['st'] = '4';
        
    }else{
        $sql_save = "
        INSERT INTO `shipper`(
            `shipper_name`,
            `tel`,
            `fax`,
            `linkman`,
            `email`,
            `address`,
            `tax`,
            `linkman_tel`
                )
        VALUES(
            '$cname',
            '$phone_number',
            '$fax',
            '$linkman',
            '$email',
            '$address',
            '$tax',
            '$linkman_tel'
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
