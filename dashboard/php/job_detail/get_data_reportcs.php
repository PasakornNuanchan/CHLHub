<?php
include '../../core/conn.php';

$id_number = $_POST['id_number'];

$get_table_reportcs = "
SELECT
    js.ID,
    js.job_number,
    recinv.first_name AS f_recinv,
    recinv.last_name AS l_recinv,
    cheinv.first_name AS f_cheinv,
    cheinv.last_name AS l_checinv,
    recpl.first_name AS f_recpl,
    recpl.last_name AS l_recpl,
    chepl.first_name AS f_chepl,
    chepl.last_name AS l_chepl,
    recbl.first_name AS f_recbl,
    recbl.last_name AS l_recbl,
    chebl.first_name AS f_chebl,
    chebl.last_name AS l_chebl,
    recid.first_name AS f_recid,
    recid.last_name AS l_recid,
    cheid.first_name AS f_cheid,
    cheid.last_name AS l_cheid,
    recil.first_name AS f_recil,
    recil.last_name AS l_recil,
    cheil.first_name AS f_cheil,
    cheil.last_name AS l_cheil,
    js.Cus_suc_datetime,
    js.Cus_by,
    js.Cus_status,
    js.cus_pro,
    js.inv_receiv_datetime,
    js.inv_check_datetime,
    js.bl_receiv_datetime,
    js.bl_check_datetime,
    js.pl_receiv_datetime,
    js.pl_check_datetime,
    js.id_receiv_datetime,
    js.id_check_datetime,
    js.il_receiv_datetime,
    js.il_check_datetime,
    js.ref_job_id
    
FROM
    job_status js
LEFT JOIN USER recinv ON
    recinv.ID = js.INV_receiv_by
LEFT JOIN USER cheinv ON
    cheinv.ID = js.INV_check_by
LEFT JOIN USER recpl ON
    recpl.ID = js.PL_receiv_by
LEFT JOIN USER chepl ON
    chepl.ID = js.PL_check_by
LEFT JOIN USER recbl ON
    recbl.ID = js.BL_receiv_by
LEFT JOIN USER chebl ON
    chebl.ID = js.BL_check_by
LEFT JOIN USER recid ON
    recid.ID = js.ID_receiv_by
LEFT JOIN USER cheid ON
    cheid.ID = js.ID_check_by
LEFT JOIN USER recil ON
    recil.ID = js.IL_receiv_by
LEFT JOIN USER cheil ON
    cheil.ID = js.IL_check_by
WHERE
    js.ref_job_id = '$id_number'
";

$sql_status = "
SELECT
    jt.ID,
    jt.clearlance_date,
    jt.delivery_date,
    jt.check_document,
    jt.enter_date,
    jt.pickup_DO_date,
    jt.shipping_ass,
    js.Cus_suc_datetime
FROM
    job_title jt
    LEFT join job_status js ON jt.ID = js.ref_job_id
WHERE
  jt.ID = '$id_number'
";

$result = $con->query($get_table_reportcs);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_table_reportcs = $row;
  }
} else {
  $get_data_table_reportcs = "0 results";
}

$result = $con->query($sql_status);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_status = $row;
  }
} else {
  $get_data_status = "0 results";
}


echo json_encode(array(
    'get_data_table_reportcs'=>$get_data_table_reportcs,
    'get_data_status'=>$get_data_status));

?>