<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT 
        jt.ID,
        consignee_name,
        job_number 
    FROM 
        job_title as jt
    LEFT JOIN 
        consignee as c on jt.consignee_number = c.ID
    ORDER BY jt.ID DESC
    LIMIT 100
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    } else {
        $arr = "0 results";
    }
    echo json_encode($arr)

?>