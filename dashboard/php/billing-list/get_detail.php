<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT
        jt.create_date,
        jt.job_number,
        u.first_name,
        u.last_name,
        IF((SELECT COUNT(billing.job_number) FROM billing WHERE billing.type ='AP' AND jt.job_number = billing.job_number) =
            (SELECT SUM(billing.payble) FROM billing WHERE billing.type ='AP' AND jt.job_number = billing.job_number),1,0) as AP,
        IF((SELECT COUNT(billing.job_number) FROM billing WHERE billing.type ='AR' AND jt.job_number = billing.job_number) =
            (SELECT SUM(billing.payble) FROM billing WHERE billing.type ='AR' AND jt.job_number = billing.job_number),1,0) as AR,
        s.shipper_name
    FROM
        job_title as jt 
        LEFT OUTER JOIN billing as b ON jt.job_number = b.job_number
        LEFT JOIN user as u ON jt.sale_support = u.user_number
        LEFT JOIN shipper as s ON jt.shipper_number = s.shipper_number
    GROUP BY
        jt.job_number
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $billing_list[] = $row;
        }
    } else {
        $billing_list[] = "0 results";
    }
    echo json_encode(array('billing_list'=>$billing_list));

?>