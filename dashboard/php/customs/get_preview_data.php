<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

$sql_payment = "
    SELECT 
    cp.type,
    bd.billing_item_name,
    cp.amount,
    u.first_name,
    u.last_name
    FROM cash_payment cp
    INNER JOIN billing_description bd ON cp.description = bd.billing_number 
    INNER JOIN user u ON cp.create_by = u.user_number
    WHERE job_number = '$job_number'
    ";



      $sql_transport = "
      SELECT * FROM transport_booking WHERE job_number = '$job_number'";

   


     

$result = $con->query($sql_payment);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pay[] = $row;
  }
} else {
  $pay = "0 results";
}

$result = $con->query($sql_transport);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tran[] = $row;
  }
} else {
  $tran[] = "0 results";
}




     echo json_encode(array('pay'=>$pay,'tran'=>$tran));
?>