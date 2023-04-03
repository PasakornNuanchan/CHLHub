<?php
    include '../../core/conn.php';
    $arr = array();
    
    $job_number = $_POST['job_number'];

    $data_request= "
    SELECT 
    cp.ID,
    cp.type,
    cp.description,
    bd.billing_item_name,
    cp.pay_to,
    gc.name,
    cp.amount,
    cp.currency,
    cp.remark
    FROM cash_payment cp
    LEFT JOIN billing_description bd ON cp.description = bd.ID
    LEFT JOIN Goverment_contact gc ON cp.pay_to = gc.ID
    WHERE status = 2 AND job_number = '$job_number';
    ";
    
    $result = $con -> query($data_request);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $dtpcad[] = $row;
        }
    } else {
        $dtpcad = "data_error";
    }

    echo json_encode(array('dtpcad'=>$dtpcad))

?>