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
    u.last_name
    FROM cash_payment cp
    INNER JOIN billing_description bd ON cp.description = bd.billing_number 
    INNER JOIN user u ON cp.create_by = u.user_number
    WHERE job_number = '$job_number' AND status = 0
    ";

$sql_cash_balance = "

SELECT
SUM(pcd.amount) - IF((SELECT SUM(amount) FROM cash_payment WHERE job_number= '$job_number' AND type = 'Petty_Cash' AND status = 0) IS null,0,
                     (SELECT SUM(amount) FROM cash_payment WHERE job_number= '$job_number' AND type = 'Petty_Cash' AND status = 0)) as cash_value,
pcd.currency,
GROUP_CONCAT(pcd.petty_cash_number) as petty_cash_number
FROM petty_cash_detail pcd
WHERE pcd.job_number = '$job_number'

";


     

$result = $con->query($sql_payment);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pay[] = $row;
  }
} else {
  $pay = "0 results";
}

$result = $con->query($sql_cash_balance);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cbl = $row;
  }
} else {
  $cbl = "0 results";
}




     echo json_encode(array('pay'=>$pay,'cbl'=>$cbl));
?>