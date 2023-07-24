<?php
    include '../../core/conn.php';


    $gen_date_start = $_POST['gen_date_start'];
    $gen_date_end = $_POST['gen_date_end'];
    
    $sql = "
    SELECT
    jt.job_number,
    jt.clearlance_date AS date_task,
    c.consignee_name,
    'Clearlance' AS TYPE
FROM
    job_title jt
LEFT JOIN consignee c ON
    jt.consignee_number = c.consignee_number
WHERE
    jt.job_number IS NOT NULL AND jt.clearlance_date BETWEEN '$gen_date_start' AND '$gen_date_end'
    
UNION

SELECT
    jt.job_number,
    jt.eta AS data_task,
    c.consignee_name,
    'eta' AS TYPE
FROM
    job_title jt
LEFT JOIN consignee c ON
    jt.consignee_number = c.consignee_number
WHERE
    jt.job_number IS NOT NULL AND jt.eta BETWEEN '$gen_date_start' AND '$gen_date_end'
    ";
    $result = $con -> query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $calendar[] = $row;
        }
    } else {
        $calendar[] = "0 results";
    }
    echo json_encode(array('calendar'=>$calendar));

?>