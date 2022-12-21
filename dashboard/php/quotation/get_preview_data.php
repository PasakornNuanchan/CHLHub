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
            `quartation_detail`.`quartation_number`,
            `quartation_detail`.`description`,
            `quartation_detail`.`type`,
            `quartation_detail`.`unit_price`,
            `quartation_detail`.`currency`,
            `quartation_detail`.`remark`,
            `quartation_detail`.`base_service_route`,
            `quartation_detail`.`markup_price`,
            `quartation_detail`.`markup_result`,
            route.*,
            carrier.ID as 'carrier_ID'
        FROM
            `quartation_detail` 
            LEFT JOIN route on route.route_number = quartation_detail.base_service_route and quartation_detail.type = 'base_service'
            LEFT JOIN carrier on carrier.carrier_number = route.carrier_number
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