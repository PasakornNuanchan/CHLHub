<?php
    include '../../core/conn.php';
    // echo json_encode($_POST);
    $detail = $_POST['detail'];
    $base = $_POST['base'];
    $truck_import = $_POST['truck_import'];
    $truck_export = $_POST['truck_export'];
    $sup_service = $_POST['sup_service'];

    $con->autocommit(FALSE);

    $sql_save_base = '';
    foreach ($base as $k => $v) {
        $carrier_number = $v['carrier'];
        $carrier_type = $v['carrier_type'];
        $pol = $v['pol'];
        $pod = $v['pod'];
        $qty = $v['qty'];

        $sql_base_check = "SELECT * FROM `route` WHERE carrier_number = '$carrier_number' AND container_type = '$carrier_type' AND pol = '$pol' AND pod = '$pod'; ";
        $result = $con -> query($sql_base_check);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $route_number = ($row['route_number']);
            }
        } else {
            echo json_encode(array('err_msg' => 'route not found','err' => '1'));
            return;
        }

        echo $sql_save_base ="
            INSERT INTO `quartation_detail_base`(
                `quartation_number`,
                `description`,
                `type`,
                `unit_price`,
                `currency`,
                `remark`,
                `base_service_route`,
                `markup_price`,
                `markup_result`,
                `qty`
            )
            VALUES(
                '".$detail['quo_no']."',
                '',
                '',
                '',
                '',
                '',
                '$route_number',
                '',
                '',
                '$qty'
            );
        ";
    }
    echo $sql_delete_base = "DELETE FROM `quartation_detail_base` WHERE `quartation_number` ='".$detail['quo_no']."'";
    $sql_save_base = "";
    





    $con->commit(TRUE);

?>