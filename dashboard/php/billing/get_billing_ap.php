<?php
    include '../../core/conn.php';
    $arr = array();
    $sql_description = "
    SELECT * FROM `billing_description`
    ";

    
    $sql_bill_to = "
    SELECT
        c.ID,
        c.carrier_name as 'bill_to_name',
        '1' as 'bill_to_type'
    FROM
        carrier c
    UNION
        (
        SELECT
            ts.ID,
            ts.transport_sup_name as 'bill_to_name',
            '2' as 'bill_to_type'
        FROM
            transport_sup ts
    )
    UNION
        (
        SELECT 
            gc.ID,
            gc.name as 'bill_to_name',
            '3' as 'bill_to_type'
        FROM
            Goverment_contact gc
    )
    ;
    ";
    
    $result = $con -> query($sql_description);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bl_description[] = $row;
        }
    } else {
        $bl_description[] = "0 results";
    }

    $result = $con -> query($sql_bill_to);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bl_bill[] = $row;
        }
    } else {
        $bl_bill[] = "0 results";
    }
    echo json_encode(array('bl_description'=>$bl_description,'bl_bill'=>$bl_bill))

?>