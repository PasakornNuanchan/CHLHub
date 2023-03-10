<?php

    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    include '../../core/con_path.php';

    $sql_pct = "
    SELECT
    trpc.doc_number,
    trpc.amount,
    trpc.currency
FROM
    transac_recript_petty_cash AS trpc
LEFT JOIN transac_return_petty_cash AS trepc
ON
    trpc.ID = trepc.transac_id_tranfer
LEFT JOIN petty_cash_title AS pct
ON
    trpc.doc_number = pct.petty_cash_number
WHERE
    trepc.ID IS NULL AND pct.request_by = '$data_user'

    ";
    $sql_awt = "
    SELECT act.advance_cash_number,
    SUM(acd.amount) as total_amount ,
    IF(COUNT(acd.job_number) = COUNT(jt.clearlance_date),'1','0') as clearance_status  ,
    act.payment_by,
    act.total_amount_request_cur
    FROM advance_cash_title  as act
INNER JOIN advance_cash_detail as acd ON act.advance_cash_number = acd.advance_cash_number
INNER JOIN job_title as jt ON acd.job_number = jt.job_number
INNER JOIN user u ON act.request_by = u.user_number
WHERE 
        u.user_number = '$data_user'
GROUP BY act.advance_cash_number
HAVING act.payment_by IS NULL

    ";
    $sql_hnc = "
    SELECT cp.job_number,cp.amount,cp.currency,IF(jt.clearlance_date IS NULL ,'0','1') as clearlance_status 
    FROM cash_payment as cp
    LEFT OUTER JOIN advance_cash_detail as acd ON cp.job_number = acd.job_number
    INNER JOIN job_title as jt ON cp.job_number = jt.job_number
    INNER JOIN user u ON cp.create_by = u.user_number
    WHERE acd.job_number IS NULL 

    ";


  

    $result = $con -> query($sql_pct);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pc_wfc[] = $row;
        }
      } else {
        $pc_wfc = "0";
      }

      $result = $con -> query($sql_awt);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $ad_wfc[] = $row;
          }
        } else {
          $ad_wfc = "0";
        }

        $result = $con -> query($sql_hnc);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $ad_hnc[] = $row;
            }
          } else {
            $ad_hnc = "0";
          }
   
      echo json_encode(array('pc_wfc'=>$pc_wfc,'ad_wfc'=>$ad_wfc,'ad_hnc'=>$ad_hnc));




?>