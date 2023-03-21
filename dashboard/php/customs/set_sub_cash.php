<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

$sql_payment = "
SELECT 
cp.ID,
cp.type,
cp.pay_to,
bd.billing_item_name,
cp.amount,
cp.currency,
u.first_name,
u.last_name,
cp.job_number,
cp.datetime_create,
cp.remark,
cp.status,
cp.picture,
g.name
FROM cash_payment cp
LEFT JOIN billing_description bd ON cp.description = bd.ID 
LEFT JOIN user u ON cp.create_by = u.user_number
LEFT JOIN Goverment_contact as g ON cp.pay_to = g.ID
WHERE cp.job_number = '$job_number' AND cp.status IN ('0','2')
ORDER BY
cp.ID ASC
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