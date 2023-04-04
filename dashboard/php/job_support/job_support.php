<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/get_last_job.php';


echo $sql_job_title = "
INSERT INTO `job_title`(
    `job_number`,
    `create_date`,
    `status_job`
)
VALUES(
    '$get_last_job',
    '$t_time_save',
    '0'
)
";

$result_title = $con->query($sql_job_title);
echo $result_title;

echo $sql_job_detail = "
INSERT INTO `job_status`(
    `job_number`
)
VALUES(
    '$get_last_job'
)
";
$result_detail = $con->query($sql_job_detail);
echo $result_detail;

$sql_container_information = "
INSERT INTO `container_information`(
    `job_number`
)
VALUES(  
    '$get_last_job'
)";


$result_detail = $con->query($sql_container_information);
echo $result_detail;
// $list_data = $_POST['save_arr_detail'];
// $data_title = $_POST['save_arr_title'];

// foreach ($data_title as $k => $v) {
//     $get_sel_mt = isset($v['sel_tranfer_mt']) ? $v['sel_tranfer_mt'] : '';
// }

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


// $sql_insert_title =
//     "
// INSERT INTO `petty_cash_title`(
//     `petty_cash_number`,
//     `request_by`,
//     `datetime_request`,
//     `tranfer_method`,
//     `tranfer_bank_name`,
//     `tranfer_bank_number`,
//     `status_doc`
// )
// VALUES(
//     '$run_doc',
//     '$data_user',
//     '$t_time_save',
//     '$get_sel_mt',
//     '$bank_name',
//     '$bank_number',
//     '0'
// )
// ";

// $status = $con->query($sql_insert_title);
// echo json_encode($run_doc);

 
