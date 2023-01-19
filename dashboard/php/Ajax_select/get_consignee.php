<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
        SELECT
            `ID`,
            `consignee_number`,
            `consignee_name`,
            `tel`,
            `e-mail`,
            `user_sale`,
            `tax`,
            `bank_account_name`,
            `bank_number`,
            `address`,
            `contact_person_name`,
            `contact_person_tel`
        FROM
            `consignee`
        WHERE
            1
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    } else {
        $arr[] = "0 results";
    }
    echo json_encode($arr)

?>