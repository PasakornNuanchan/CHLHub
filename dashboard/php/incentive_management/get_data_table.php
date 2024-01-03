<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_request_data_table = "
SELECT
    jt.ID as id_job_title,
	jt.job_number,
	(SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.consignee_number) as bill_to_c,
    (SELECT u1.first_name FROM user u1 WHERE jt.sale_support = u1.ID) as sale_support_f,
    (SELECT u1.last_name FROM user u1 WHERE jt.sale_support = u1.ID) as sale_support_l,
    (SELECT sum(bar.amtinclvat) FROM billing bar WHERE jt.ID = bar.ref_job_id AND bar.type = 'AR') ar_amt,
    (SELECT sum(bar.amtinclvat) FROM billing bar WHERE jt.ID = bar.ref_job_id AND bar.type = 'AP') ap_amt
FROM
    job_title jt
WHERE
    1;
";


$result = $con->query($sql_request_data_table);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $table[] = $row;
    $id_find[] = $row['id_job_title'];
  }
} else {
  $table = "0 results";
}

$id_find = implode(",",$id_find);
// $id_find;
$sql_data_all_amount = "
SELECT
    bpl.ID,
    bpl.data_number_id ,
    bpl.amount,
    b.currency as current_currency,
    bpl.currency as currency_new,
    bpl.id_refer_bp,
    bpl.currency_number,
    b.ref_job_id
FROM
    billing_payment_list bpl
    LEFT JOIN billing b ON b.ID = bpl.data_number_id
WHERE
b.ref_job_id IN ($id_find)
";

$result = $con->query($sql_data_all_amount);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $spend[] = $row;
  }
} else {
  $spend = "0 results";
}

echo json_encode(array('table'=>$table,'spend'=>$spend));
// ?>