<?php
session_start();
require '../../core/conn.php';

$arr_base = array_key_exists('base', $_POST) ? $_POST['base'] : array();
$arr_truck = array_key_exists('truck', $_POST) ? $_POST['truck'] : array();
$arr_sup = array_key_exists('sup', $_POST) ? $_POST['sup'] : array();

try{
        
    $con->begin_transaction();
    $stmt = $con->prepare("UPDATE `quartation_detail_base` SET `markup_price` = ?, `markup_result` = ? + (`unit_price` * qty), `remark` = ? WHERE ID = ?");
    if($stmt){
        foreach ($arr_base as $k => $v) {
            $stmt->bind_param("ddss", $v['markup'], $v['markup'], $v['remark'], $v['ID']);
            if($stmt->execute()){
                //query executed successfully
            }else{
                throw new Exception("Error occurred while executing the statement");
            }
        }
    }else{
        throw new Exception("Error occurred while preparing the statement");
    }

    $stmt_truck = $con->prepare("
        UPDATE
            `quotation_detail_trucking`
        SET

            `markup` = ?,
            `markup_result` = (? + `price`),
            `remark` = ?

        WHERE
            `ID` = ?"
    );
    if($stmt_truck){
        foreach ($arr_truck as $k => $v) {
            $stmt_truck->bind_param("ddss", $v['markup'],$v['markup'], $v['remark'], $v['ID']);
            if($stmt_truck->execute()){
                //query executed successfully
            }else{
                throw new Exception("Error occurred while executing the statement");
            }
        }
    }else{
        throw new Exception("Error occurred while preparing the statement");
    }



    $stmt_sup = $con->prepare("
        UPDATE
            `quotation_detail_supservice`
        SET

            `markup` = ?,
            `markup_result` = (? + `price`),
            `remark` = ?
        WHERE
            `ID` = ?"
    );
    if($stmt_sup){
        foreach ($arr_sup as $k => $v) {
            $stmt_sup->bind_param("ddss", $v['markup'],$v['markup'], $v['remark'], $v['ID']);
            if($stmt_sup->execute()){
                //query executed successfully
            }else{
                throw new Exception("Error occurred while executing the statement");
            }
        }
    }else{
        throw new Exception("Error occurred while preparing the statement");
    }
    echo json_encode(array('st' => '1'));
    $con->commit();
}catch(Exception $e){
    echo json_encode(array('st' => '0', 'msg' => $e));
    $con->rollback();
}


?>