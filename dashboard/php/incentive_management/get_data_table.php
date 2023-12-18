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
  }
} else {
  $table = "0 results";
}

echo json_encode(array('table'=>$table));
?>