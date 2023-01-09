<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT
        act.datetime_request,
        act.advance_cash_number,
        u.first_name,
        u.last_name,
        COUNT(acd.job_number) as COUNT_job,
        act.total_amount_request
    FROM `advance_cash_title` as act
        INNER JOIN user as u ON act.request_by = u.user_number
        INNER JOIN advance_cash_detail as acd ON act.advance_cash_number = acd.advance_cash_number
    GROUP BY
        acd.advance_cash_number
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $act[] = $row;
        }
    } else {
        $act[] = "0 results";
    }
    echo json_encode(array('act'=>$act));

?>