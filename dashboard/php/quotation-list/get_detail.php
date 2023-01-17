<?php
    include '../../core/conn.php';
    $arr = array();
    $sql_quotation = "
    SELECT 
        qt.create_datetime,
        qt.quartation_number,
        sale.first_name,
        sale.last_name,
        c.consignee_name,
        qt.type,
        qt.status
    FROM 
      quartation_title as qt
      INNER JOIN user as sale ON qt.user_sale = sale.user_number
      INNER JOIN consignee as c ON qt.consignee_number = c.consignee_number
    ";
    
    $result = $con -> query($sql_quotation);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $quotation_list[] = $row;
        }
    } else {
        $quotation_list[] = "0 results";
    }
    echo json_encode(array('quotation_list'=>$quotation_list));

?>