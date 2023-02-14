<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

$sql_payment = "
    SELECT 
    cp.ID,
    cp.type,
    bd.billing_item_name,
    cp.amount,
    u.first_name,
    u.last_name,
    cp.job_number,
    cp.datetime_create,
    cp.remark
    FROM cash_payment cp
    INNER JOIN billing_description bd ON cp.description = bd.ID 
    INNER JOIN user u ON cp.create_by = u.user_number
    WHERE cp.job_number = '$job_number' AND status = 0
    ";




$sql_sel_pcn = "
SELECT
    ID,
    petty_cash_number
FROM
    `petty_cash_detail`
WHERE
    job_number = '$job_number'
    ";

$result = $con->query($sql_payment);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pay[] = $row;
  }
} else {
  $pay = "0 results";
}



$result = $con->query($sql_sel_pcn);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pcn[] = $row;
  }
} else {
  $pcn = "0 results";
}




     echo json_encode(array('pay'=>$pay,'pcn'=>$pcn));
?>