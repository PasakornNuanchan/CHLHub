<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    include '../../core/con_path.php';
    $arr = array();

    $get_val_job = $_POST['valjob'];


    $sql = "
    SELECT
	cp.*,
    c.consignee_name,
    SUM(cp.amount) as amount_total,
	GROUP_CONCAT(cp.ID) as check_id
FROM
    `cash_payment` AS cp
    LEFT JOIN job_title as jt ON cp.job_number = jt.job_number
    LEFT JOIN consignee as c ON jt.consignee_number = c.consignee_number
WHERE
    cp.type = 'Advance Cash' AND 
    cp.status IN ('0') AND
    cp.create_by = '$data_user'
GROUP BY
	cp.job_number , cp.currency
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tot[] = $row;
        }
    } else {
        $tot = "0 results";
    }
    echo json_encode($tot)

?>