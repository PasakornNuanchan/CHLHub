<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_query_bill_to = "
SELECT 
    b.bill_to_type,
    b.bill_to,
    if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
    (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c
FROM 
	billing as b
WHERE
	b.type = 'AP' AND b.approve_date_time IS NOT NULL
";

$sql_query_job_number = "
SELECT 
	b.ref_job_id,
    (SELECT jt.job_number FROM job_title jt WHERE jt.ID = b.ref_job_id) as job_number
FROM 
	billing as b
WHERE
	b.type = 'AP' AND b.approve_date_time IS NOT NULL
";

$result = $con->query($sql_query_bill_to);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $bill_to[] = $row;
    }
  } else {
    $bill_to = "0 results";
  }

  $result = $con->query($sql_query_job_number);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $job_number[] = $row;
    }
  } else {
    $job_number = "0 results";
  }

echo json_encode(array('bill_to'=>$bill_to,'job_number'=>$job_number));


?>