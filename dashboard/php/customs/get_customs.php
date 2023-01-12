<?php
    include '../../core/conn.php';
    $arr = array();
    $sql_supplier = "
    SELECT * FROM `transport_sup`
    ";
    
    
    $result = $con -> query($sql_supplier);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $supplier[] = $row;
        }
    } else {
        $supplier[] = "0 results";
    }

  
    echo json_encode(array('supplier'=>$supplier))

?>