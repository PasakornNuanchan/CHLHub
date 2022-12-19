<?php
$job_number = $_POST['quartation_number'];
    include '../../core/conn.php';


    $quartation_number = $_POST['quartation_number'];
    $arr = array();
    $sql = "
        SELECT
            `ID`,
            `quartation_number`,
            `consignee_number`,
            `term`,
            `commodity`,
            `type`,
            `remark`,
            `carrier_number`,
            `user_sale`,
            `create_datetime`,
            `status`
        FROM
            `quartation_title`
        WHERE
            1 AND `quartation_number` = '$quartation_number'
    ";
    $sql_detail = "
        SELECT
            `ID`,
            `quartation_number`,
            `description`,
            `type`,
            `unit_price`,
            `currency`,
            `remark`,
            `base_service_route`,
            `markup_price`,
            `markup_result`
        FROM
            `quartation_detail`
        WHERE
            1 AND `quartation_number` = '$quartation_number'
    ";
    $result = $con -> query($sql);
    $result_detail = $con -> query($sql_detail);

    if ($result_detail->num_rows > 0) {
        while($row = $result_detail->fetch_assoc()) {
            $arr['detail'][] = $row;
        }
    } else {
        $arr['detail'] = "0 results";
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr['title'] = $row;
        }
    } else {
        $arr['title'] = "0 results";
    }

    echo json_encode($arr)

?>