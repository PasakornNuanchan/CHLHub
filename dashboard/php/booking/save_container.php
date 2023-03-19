<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$container_arr = $_POST['container_arr'];


foreach ($container_arr as $k => $v) {
    $con_type = isset($v['con_type']) ? $v['con_type'] : '';
    $qty = isset($v['qty']) ? $v['qty'] : '';
    $slw = isset($v['slw']) ? $v['slw'] : '';
    $soc = isset($v['soc']) ? $v['soc'] : '';
    $ow = isset($v['ow']) ? $v['ow'] : '';
    $st_container = isset($v['st_container']) ? $v['st_container'] : '';
    $cy_con = isset($v['cy_con']) ? $v['cy_con'] : '';
    $rtn_con = isset($v['rtn_con']) ? $v['rtn_con'] : '';
    $job_number = isset($v['job_number']) ? $v['job_number'] : '';

    $soc = 0;
    $ow = 0;

    if ($st_container == "") {
        for ($x = 1; $x <= $qty; $x++) {
        $sql = "
        INSERT INTO `container`(
            `job_number`,
            `container_type`,
            `single_cnt`,
            `soc`,
            `ow`,
            `cy`,
            `rtn`
        )
        VALUES(
            '$job_number',
            '$con_type',
            '$slw',
            '$soc',
            '$ow',
            '$cy_con',
            '$rtn_con'
        )
        ";
            $status = $con->query($sql);
            echo json_encode($status);
        }
    }
}

// $sql_user_query = "
//     SELECT * FROM user WHERE ID = '$data_user'";

// $result = $con->query($sql_user_query);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $dat_u = $row;
//     }
// } else {
//     $dat_u = "0 results";
// }

// json_encode(array('dat_u' => $dat_u));
// $bank_number = $dat_u['bank_number'];
// $bank_name = $dat_u['bank_name'];




// foreach ($list_data as $k => $v) {
//     $get_amount = isset($v['get_amount']) ? $v['get_amount'] : '';
//     $get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
//     $get_description = isset($v['get_description']) ? $v['get_description'] : '';


//     $sql_insert_detail =
//         "
// INSERT INTO `petty_cash_detail`(
//     `petty_cash_number`,
//     `job_number`,
//     `amount`,
//     `currency`
// )
// VALUES(
//     '$run_doc',
//     '$get_description',
//     '$get_amount',
//     '$get_currency'
// )
// ";

// $status = $con->query($sql_insert_detail);
// }


// $status = $con->query($sql_insert_title);
// echo json_encode($run_doc);

//  //$status = $con->query($sql_add_list);
//  //print_r($status);
