<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT 
        jt.create_date,
        jt.job_number,
        jt.mbl,
        c.carrier_name,
        co.consignee_name,
        a.location_name,
        a.country,
        jt.eta
    FROM
        job_title as jt
    INNER JOIN carrier as c ON jt.carrier_number = c.carrier_number
    INNER JOIN consignee as co ON jt.consignee_number = co.consignee_number
    LEFT JOIN area as a ON jt.port_of_receipt_number = a.area_number";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $booking_list[] = $row;
        }
    } else {
        $booking_list[] = "0 results";
    }
    echo json_encode(array('booking_list'=>$booking_list));

?>