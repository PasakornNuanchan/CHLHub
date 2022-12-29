<?php
$advance_number = $_POST['advance_number'];
    include '../../core/conn.php';
    $sql_pct = "
    SELECT 
      pct.advance_cash_number,
      pct.datetime_request,
      rqn.first_name as rq_by_first,
      rqn.last_name as rq_by_last,
      rqt.first_name as tf_by_first,
      rqt.last_name as tf_by_last,
      pct.total_amount_request,
      pct.total_amount_request_cur,
      pct.tranfer_method,
      pct.tranfer_bank_name,
      pct.tranfer_bank_number,
      pct.all_job_number,
      pct.tranfer_amount,
      pct.tranfer_datetime,
      pct.tranfer_amount_cur,
      pct.return_payment_datetime,
      pct.amount_return,
      pct.amount_return_cur,
      pct.return_payment_method
      FROM `advance_cash_title` as pct
        INNER JOIN user rqn ON (pct.request_by = rqn.user_number)
        INNER JOIN user rqt ON (pct.tranfer_by = rqt.user_number)
        WHERE advance_cash_number = '$advance_number'
    ";

   $sql_pcd = "
   SELECT * FROM advance_cash_detail as acd
   INNER JOIN job_title as jt ON jt.job_number = acd.job_number
   INNER JOIN consignee as c ON c.consignee_number = jt.consignee_number WHERE acd.advance_cash_number ='$advance_number'
    ";

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
      WHERE cp.type = 'Advance_Cash' AND cp.job_number IN($imp_set)";
      
      $result = $con -> query($sql_pcdr);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $dtpc[] = $row;
        }
      } else {
        $scd = "0 results";
      }
      



      echo json_encode(array('pcd'=>$pcd,'pct'=>$pct,'scd'=>$scd,'dtpc'=>$dtpc,'imp_set'=>$imp_set,'$pcdjn'=>$pcdjn));
    




?>