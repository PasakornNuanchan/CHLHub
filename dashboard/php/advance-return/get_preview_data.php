<?php
$advance_number = $_POST['advance_number'];
    include '../../core/conn.php';
    $sql_pct = "
    SELECT 
   act.advance_cash_number,
   u.first_name,
   u.last_name,
   act.datetime_request,
   act.tranfer_method_request,
   act.tranfer_bank_name,
   act.tranfer_bank_number
    FROM `advance_cash_title` as act
      INNER JOIN user u ON (act.request_by = u.user_number)
      WHERE advance_cash_number ='$advance_number'
    ";

   $sql_pcd = "
   SELECT acd.job_number,acd.amount,acd.currency,c.consignee_name FROM advance_cash_detail as acd 
LEFT JOIN job_title as jt ON acd.job_number = jt.job_number
LEFT JOIN consignee as c ON jt.consignee_number = c.consignee_number
WHERE acd.advance_cash_number = '$advance_number'
    ";

   $sql_payment  ="
   SELECT 
   act.payment_method,
   act.payment_by,
   act.payment_amount,
   act.payment_amount_cur,
   act.payment_datetime,
   act.payment_recript,
   u.first_name,
   u.last_name
   FROM advance_cash_title as act 
   INNER JOIN user as u ON act.payment_by = u.user_number
   WHERE act.advance_cash_number = '$advance_number'";

   $sql_count_des = "
   SELECT count(job_number) as c_qty FROM `advance_cash_detail` where `advance_cash_number` ='$advance_number'
    ";

    

    $job_number = 0;




 
    
    $result = $con -> query($sql_pct);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pct = $row;
        } 
      } else {
        $pct = "0 results";
      }

      $result = $con -> query($sql_pcd);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $pcd[] = $row;
            $pcdjn[] = $row['job_number'];
        }
      } else {
        $pcd = "0 results";
      }

      $result = $con -> query($sql_payment);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $payment = $row;
        } 
      } else {
        $payment = "0 results";
      }

      $result = $con -> query($sql_count_des);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $scd = $row;
        }
      } else {
        $scd = "0 results";
      }
  
      $imp_set = implode(',' , $pcdjn);
      $sql_pcdr = "
      SELECT * FROM Cash_payment as cp INNER JOIN billing_description as bd on cp.description = bd.billing_number 
      WHERE cp.type = 'Advance Cash' AND cp.job_number IN($imp_set)";
      
      $result = $con -> query($sql_pcdr);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $dtpc[] = $row;
        }
      } else {
        $scd = "0 results";
      }
      
      foreach ($dtpc as $k => $v) {
        $dtpc_arr[$v['job_number']][] = $v;
      }



      echo json_encode(array('pcd'=>$pcd,'pct'=>$pct,'scd'=>$scd,'dtpc'=>$dtpc_arr,'imp_set'=>$imp_set,'$pcdjn'=>$pcdjn,'payment'=>$payment));
    




?>