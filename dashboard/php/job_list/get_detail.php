<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    $arr = array();
    $sql = "
    SELECT 
        jt.ID,
        jt.job_number,
		if(jt.client_type = 1,(SELECT sp.shipper_name FROM shipper sp WHERE sp.ID = jt.client_number),(SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.client_number)) as client_name,
        jt.booking_number,
        (SELECT concat(a.provice,',',a.location_name) FROM area a WHERE a.ID = jt.port_of_loading_number) as POL,
        (SELECT concat(a.provice,',',a.location_name) FROM area a WHERE a.ID = jt.port_of_discharge) as POD,
        jt.etd,
        jt.eta,
        (SELECT concat(u.first_name,' ',u.last_name) FROM user u WHERE u.ID = jt.sale_support) as sale_support
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