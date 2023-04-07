<?php
$petty_number = $_POST['job_doc_pt'];
    include '../../core/conn.php';
    
    $sql_list_return = "
    SELECT
    trpc.*,
    trepc.return_by,
    trepc.return_amount,
    trepc.return_datetime,
    trepc.return_re,
    trepc.return_currency,
    trepc.method_tranfer,
    re_by.first_name,
    re_by.last_name,
    trepc.ID as ID_pic
FROM
    `transac_recript_petty_cash` AS trpc
LEFT JOIN transac_return_petty_cash AS trepc ON trpc.ID = trepc.transac_id_tranfer
LEFT JOIN USER AS re_by ON trepc.return_by = re_by.user_number
WHERE
    trpc.doc_number = '$petty_number' 
    ";

    $result = $con -> query($sql_list_return);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $list_return[] = $row;
        } 
      } else {
        $list_return = "0 results";
      }

    
     echo json_encode(array('list_return'=>$list_return));
