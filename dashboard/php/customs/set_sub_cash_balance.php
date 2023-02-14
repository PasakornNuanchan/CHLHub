<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';




$sql_cash_balance = "

SELECT 
pcd.ID,
pcd.petty_cash_number,
pcd.job_number, 
pcd.amount - (SELECT SUM(cp.amount) FROM petty_cash_detail as pcd1 
LEFT JOIN cash_payment as cp ON pcd1.ID = cp.ID_petty_cash
WHERE cp.type = 'Petty Cash' AND pcd.ID = pcd1.ID AND cp.status = 0) as cash_balance,
pcd.currency 
FROM 
petty_cash_detail as pcd
WHERE pcd.job_number = '$job_number'

";



$result = $con->query($sql_cash_balance);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cbl[] = $row;
  
   // $cbl_arr[] = $row;

  }
} else {
  $cbl = "0 results";
}

// foreach ($cbl_arr as $k => $v) {
//   $cbl[$v['ID']][] = $v;
// }



     echo json_encode(array('cbl'=>$cbl));
?>