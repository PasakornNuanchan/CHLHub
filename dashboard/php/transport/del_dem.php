<?php
include '../../core/conn.php';
$arr = array();
$arr_suc = array();
$del_id = $_POST['dem_arr_del'];

 $sql_query =
    "
            UPDATE
                `demurrage`
            SET
                `status` = '1'
            WHERE
                ID = $del_id
            ";

if ($con->query($sql_query) != 1) {
    $arr_suc['st'] = '0';
} else {
    $arr_suc['st'] = '1';
}
echo json_encode($arr_suc);