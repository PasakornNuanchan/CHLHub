<?php
    include '../../core/conn.php';
    include '../../core/con_path.php';

    $arr = array();
    $sql = "
    SELECT 
        pct.datetime_request,
        pct.petty_cash_number,
        u.first_name,
        u.last_name,
        COUNT(pcd.job_number) as COUNT_job,
        pct.total_amount_request,
        IF(tranfer_by IS NOT NULL ,1,0) as payble_check
    FROM 
        `petty_cash_title` as pct
        INNER JOIN user as u ON pct.request_by = u.user_number
        INNER JOIN petty_cash_detail as pcd ON pct.petty_cash_number = pcd.petty_cash_number
    WHERE u.user_number = '$data_user'
    GROUP BY 
        pcd.petty_cash_number

    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $pct[] = $row;
        }
    } else {
        $pct[] = "0 results";
    }
    echo json_encode(array('pct'=>$pct));

?>