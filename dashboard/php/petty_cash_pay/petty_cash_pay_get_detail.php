<?php
include '../../core/conn.php';
$sql ="
SELECT
    cp.ID,
    cp.type_payble,
    cp.payto_payble,
    cp.description_payble,
    cp.amount_payble,
    cp.currency_payble,
    cp.img_payble,
    cp.remark_payble,
    cp.ref_job_id,
    cp.status,
    cp.datetime_paid,
    cp.paid_by,
    cp.create_by,
    cp.create_datetime,
    cp.petty_cash_number,
    jt.job_number,
    u.first_name as ufn,
    u.last_name as uln,
    u1.first_name as u1fn,
    u1.last_name as u1ln,
    u.bank_number as bnb,
    u.bank_name as bbn
FROM
    cash_pay cp
LEFT JOIN job_title jt ON jt.ID = cp.ID
LEFT JOIN user u ON cp.create_by = u.ID
LEFT JOIN user u1 ON cp.paid_by = u1.ID
WHERE 
 cp.type_payble IN ('Payble')
";

$result = $con->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_petty_cash[] = $row;
  }
} else {
  $data_petty_cash = "0 results";
}


echo json_encode(array('data_petty_cash'=>$data_petty_cash));


?>