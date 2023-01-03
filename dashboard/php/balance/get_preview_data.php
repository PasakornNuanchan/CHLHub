<?php
$advance_number = $_POST['advance_number'];
    include '../../core/conn.php';

    $sql_pct = "
    SELECT 
	pct.ID,
	pct.petty_cash_number,
    SUM(pcd.amount) as total_amount ,
    IF(count(jt.job_number) = COUNT(jt.clearlance_date),'PASS','NOT PASS') as customs_clear,
    pct.return_payment_by as check_payment
FROM petty_cash_title as pct 
INNER JOIN petty_cash_detail as pcd ON pct.petty_cash_number = pcd.petty_cash_number
INNER JOIN job_title as jt ON pcd.job_number = jt.job_number
GROUP BY pct.petty_cash_number
HAVING pct.return_payment_by = 0

    ";


  

    $result = $con -> query($sql_pct);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pc_wfc[] = $row;
        }
      } else {
        $pc_wfc = "0 results";
      }

   
      echo json_encode(array('pc_wfc'=>$pc_wfc));




?>