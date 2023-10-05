<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
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

$sql_status_check = "
SELECT
    js.ID,
    js.ship_arrievd_st,
    u1.first_name fn_ship,
    u1.last_name ln_ship,
    js.ship_arrived_status,
    js.ship_pro,
    js.drop_status,
    js.drop_datetime,
    u2.first_name fn_drop,
    u2.last_name ln_drop,
    js.drop_pro,
    js.cy_pro,
    js.cy_rtn,
    js.cy_rtn_by,
    js.cy_rtn_status,
    jt.clearlance_date,
    js.Cus_suc_datetime,
    u3.first_name fn_cus,
    u3.last_name ln_cus,
    js.Cus_status,
    js.cus_pro
FROM
    job_status js
    LEFT JOIN job_title jt ON js.ref_job_id = jt.ID
    LEFT JOIN user u1 ON js.ship_arrievd_by	= u1.ID
    LEFT JOIN user u2 ON js.drop_by = u2.ID
    LEFT JOIN user u3 ON js.Cus_by = u3.ID
WHERE
    ref_job_id = '$id_number'
";

$sql_data_container = "
SELECT
    cn.ID,
    cn.job_number,
    cn.container_type,
    cn.container_number,
    cn.seal_number,
    cn.ref_job_id,
    cn.up_status_cntr,
    cn.up_datetime_cntr,
    u1.first_name as fn_up,
    u1.last_name as ln_up,
    cn.up_pro_cntr,
    cn.cy_status_cntr,
    cn.cy_datetime_cntr,
    u2.first_name as fn_cy,
    u2.last_name as ln_cy,
    cn.cy_pro_cntr,
    cn.cntr_status_ar,
    u3.first_name as fn_cntr,
    u3.last_name as ln_cntr,
    cn.cntr_datetime,
    cn.cntr_pro
FROM
    container cn
    LEFT JOIN user u1 ON cn.up_by_cntr = u1.ID
    LEFT JOIN user u2 ON cn.cy_by_cntr = u2.ID
    LEFT JOIN user u3 ON cn.cntr_up_by = u3.ID
WHERE
    ref_job_id = '$id_number'
";

$result = $con->query($get_table_reportcs);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_table_reportcs = $row;
  }
} else {
  $get_data_table_reportcs = "0 results";
}

$result = $con->query($sql_status_check);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_status = $row;
  }
} else {
  $get_data_status = "0 results";
}

$result = $con->query($sql_data_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_container[] = $row;
  }
} else {
  $get_data_container = "0 results";
}


echo json_encode(array(
    'get_data_table_reportcs'=>$get_data_table_reportcs,
    'get_data_status'=>$get_data_status,
    'get_data_container'=>$get_data_container
));

?>