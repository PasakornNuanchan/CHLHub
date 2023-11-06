<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    $arr = array();
    $sql = "
    SELECT 
        jt.create_date,
        jt.job_number,
        jt.mbl,
        jt.ID,
        (SELECT c.carrier_name FROM carrier c WHERE c.ID = jt.carrier_number) carrier_name,
        (SELECT co.consignee_name FROM consignee co WHERE co.ID = jt.consignee_number) consignee_name,
        (SELECT concat(a.location_name,',',a.provice) FROM area a WHERE a.area_number = jt.ts_port_number) location_name,
        jt.eta,
        jt.ID
    FROM
        job_title as jt
    ORDER BY jt.ID DESC";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $booking_list[] = $row;
        }
    } else {
        $booking_list = "0 results";
    }
    echo json_encode(array('booking_list'=>$booking_list));

?>