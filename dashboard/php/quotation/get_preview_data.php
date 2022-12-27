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
            `quartation_detail_base`.`quartation_number`,
            `quartation_detail_base`.`description`,
            `quartation_detail_base`.`type`,
            `quartation_detail_base`.`unit_price`,
            `quartation_detail_base`.`currency`,
            `quartation_detail_base`.`remark`,
            `quartation_detail_base`.`base_service_route`,
            `quartation_detail_base`.`markup_price`,
            `quartation_detail_base`.`markup_result`,
            route.*,
            carrier.ID as 'carrier_ID'
        FROM
            `quartation_detail_base` 
            LEFT JOIN route on route.route_number = quartation_detail_base.base_service_route and quartation_detail_base.type = 'base_service'
            LEFT JOIN carrier on carrier.carrier_number = route.carrier_number
        WHERE
            1 AND `quartation_number` = '$quartation_number'
    ";


    $sql_truck_fee = "
        SELECT
            *
        FROM
            quotation_detail_trucking
        WHERE
            1 AND `quotation_number` = '$quartation_number'
    ";

    $sql_supservice = "
        SELECT * FROM `quotation_detail_supservice`
        WHERE
            1 AND `quotation_number` = '$quartation_number'
    ";


    $result = $con -> query($sql);
    $result_detail = $con -> query($sql_detail);
    $result_truck = $con -> query($sql_truck_fee);
    $result_supservice = $con -> query($sql_supservice);





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

    if ($result_truck->num_rows > 0) {
        while($row = $result_truck->fetch_assoc()) {
            if($row['type']=='import'){
                $arr['truck_fee']['import'][] = $row;
            }else{
                $arr['truck_fee']['export'][] = $row;
            }
        }
    } else {
        $arr['truck_fee'] = "0 results";
    }


    if ($result_supservice->num_rows > 0) {
        while($row = $result_supservice->fetch_assoc()) {
            $arr['sup_service'][] = $row;
        }
    } else {
        $arr['sup_service'] = "0 results";
    }
    echo json_encode($arr)

?>