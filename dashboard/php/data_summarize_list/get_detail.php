<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT 
    jt.create_date,
    jt.job_number,
    jt.booking_number,
    jt.consignee_number,
    jt.shipper_number,
    jt.carrier_number,
    jt.status_job,
    jt.clearlance_date,
    COUNT(tb.job_number) as c_qty
    FROM job_title as jt
    LEFT JOIN transport_booking as tb ON jt.job_number = tb.job_number
    GROUP BY jt.job_number

    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sm_list[] = $row;
        }
    } else {
        $sm_list[] = "0 results";
    }
    echo json_encode(array('sm_list'=>$sm_list));

?>