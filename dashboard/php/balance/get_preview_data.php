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
    SELECT acd.* FROM advance_cash_detail as acd
    LEFT JOIN transac_return_advance_cash as trac ON acd.ID = trac.ref_id
    LEFT JOIN advance_cash_title as act ON act.advance_cash_number = acd.advance_cash_number
    WHERE act.request_by = '$data_user' AND trac.ref_id IS  NULL
    ";


    $sql_hnc = "
   SELECT cp.job_number,cp.amount,cp.currency FROM cash_payment as cp
WHERE cp.type = 'Advance Cash' AND cp.status = '0' AND cp.create_by = '$data_user'

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