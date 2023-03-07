<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    include '../../core/con_path.php';
    $arr = array();
    $sql = "
    SELECT
        cp.job_number,
        c.consignee_name,
        cp.currency
    FROM
        `cash_payment` AS cp
        LEFT JOIN job_title as jt ON cp.job_number = jt.job_number
        LEFT JOIN consignee as c ON jt.consignee_number = c.consignee_number
    WHERE
        cp.type = 'Advance Cash' AND 
        cp.create_by = '$data_user'
    GROUP BY
        cp.job_number , cp.currency
    ";
    
    
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    } else {
        $arr[] = "0 results";
    }
    echo json_encode($arr)

?>
