<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT jt.create_date,jt.job_number,c.consignee_name,jt.etd,jt.eta,jt.mother_vessel,jt.voy_no_mother,jt.inv,jt.mbl
                                    FROM job_title as jt 
                                    INNER JOIN consignee as c ON jt.consignee_number = c.consignee_number

    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cs[] = $row;
        }
    } else {
        $cs[] = "0 results";
    }
    echo json_encode(array('cs'=>$cs));

?>