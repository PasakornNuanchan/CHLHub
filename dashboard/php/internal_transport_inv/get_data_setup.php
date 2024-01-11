<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$data_job_number = isset($_POST['data_job_number']) ? $_POST['data_job_number'] : '';
$data_description = isset($_POST['data_description']) ? $_POST['data_description'] : '';
$data_applied_person = isset($_POST['data_applied_person']) ? $_POST['data_applied_person'] : '';


$sql_job_number = '';
$sql_description = '';
$sql_applied_person = '';
if($data_job_number != ''){
  $sql_job_number = "
  AND ts.ref_job_id = '$data_job_number'
  ";
}
if($data_description != ''){
  $sql_description = "
  AND ts.description = '$data_description'
  ";
}
if($data_applied_person != ''){
  $sql_applied_person = "
  AND ts.pay_to = '$data_applied_person'
  ";
}
$sql_list = "
SELECT
    ts.ID,
    ts.ref_job_id,
    ts.description,
    ts.pay_to,
    ts.qty,
    ts.price,
    ts.vat,
    ts.total,
    ts.currency,
    ts.receipt,
    ts.type_file,
    ts.name_file,
    ts.remark,
    ts.create_by,
    ts.create_datetime,
    ts.check_by,
    ts.check_date,
    ts.generate_by,
    ts.generate_date,
    u1.first_name create_by_first_name,
    u1.last_name create_by_last_name,
    u2.first_name check_by_first_name,
    u2.last_name check_by_last_name,
    u3.first_name gen_by_first_name,
    u3.last_name gen_by_last_name


FROM
    transport_statement ts
    LEFT JOIN user u1 ON ts.create_by = u1.ID
    LEFT JOIN user u2 ON ts.check_by = u2.ID
    LEFT JOIN user u3 ON ts.generate_by = u3.ID
WHERE
    ts.create_datetime BETWEEN '$start_date' AND '$end_date'
    $sql_job_number
    $sql_description
    $sql_applied_person
";

// echo $sql_list;
$result = $con->query($sql_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $list_table[] = $row;
  }
} else {
  $list_table = "0 results";
}



echo json_encode(array('list_table'=>$list_table));
?>