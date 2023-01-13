<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT 
    jt.create_date,
    jt.job_number,
    jt.type_import_export,
    c.consignee_name,
    jt.eta,
    a.location_name,
    a.country,
    IF((js.INV_check_by AND
        js.PL_check_by AND
        js.BL_check_by AND
        js.ID_check_by AND 
        js.IL_check_by) IS null , 0 ,1) as document_status,
   IF(COUNT(tb.job_number) >0 ,1,0) as transport_status
       FROM job_title as jt 
       LEFT OUTER JOIN consignee as c ON jt.consignee_number = c.consignee_number
       LEFT OUTER JOIN area as a ON jt.ts_port_number = a.area_number
       LEFT OUTER JOIN transport_booking as tb ON jt.job_number = tb.job_number
       LEFT OUTER JOIN job_status as js ON jt.job_number = js.job_number
       GROUP BY jt.job_number

    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $customs[] = $row;
        }
    } else {
        $customs[] = "0 results";
    }
    echo json_encode(array('customs'=>$customs));

?>