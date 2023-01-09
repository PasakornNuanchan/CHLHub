<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT 
        jt.create_date,
        jt.job_number,
        co.consignee_name,
        jt.type_import_export,
        a.location_name,
        a.country,
        jt.eta,
        jt.status_job
    FROM
        job_title as jt
    INNER JOIN consignee as co ON jt.consignee_number = co.consignee_number
    INNER JOIN area as a ON jt.port_of_receipt_number = a.area_number    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $transport_list[] = $row;
        }
    } else {
        $transport_list[] = "0 results";
    }
    echo json_encode(array('transport_list'=>$transport_list));

?>