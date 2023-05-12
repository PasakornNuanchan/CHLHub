<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

    $sql_detail_job = "
    SELECT 
          js.ID,
          js.job_number,
          js.INV_receiv_status,
          js.INV_picture,
          IF(concat(INV_re.first_name,' ',INV_re.last_name) IS null ,'',concat(INV_re.first_name,' ',INV_re.last_name))as INV_receiv_by ,
          IF(js.inv_receiv_datetime is null ,' ',js.inv_receiv_datetime) as inv_receiv_datetime,
          IF(concat(INV_ck.first_name,' ',INV_ck.last_name) IS null ,'',concat(INV_ck.first_name,' ',INV_ck.last_name)) as INV_check_by,
          IF(js.inv_check_datetime is null ,' ',js.inv_check_datetime) as inv_check_datetime,
          js.PL_receiv_status,
          js.PL_picture,
          IF(concat(PL_re.first_name,' ',PL_re.last_name) IS null ,'',concat(PL_re.first_name,' ',PL_re.last_name))  as PL_receiv_by,
          IF(js.pl_receiv_datetime is null ,' ',js.pl_receiv_datetime) as pl_receiv_datetime,
          IF(concat(PL_ck.first_name,' ',PL_ck.last_name) IS null ,'',concat(PL_ck.first_name,' ',PL_ck.last_name)) as PL_check_by,
          IF(js.pl_check_datetime is null ,' ',js.pl_check_datetime) as pl_check_datetime,
          js.BL_receiv_status,
          js.BL_picture,
          IF(concat(BL_re.first_name,' ',BL_re.last_name) IS null ,'',concat(BL_re.first_name,' ',BL_re.last_name)) as BL_receiv_by,
          IF(js.bl_receiv_datetime is null ,' ',js.bl_receiv_datetime) as bl_receiv_datetime,
          IF(concat(BL_ck.first_name,' ',BL_ck.last_name) IS null ,'',concat(BL_ck.first_name,' ',BL_ck.last_name)) as BL_check_by,
          IF(js.bl_check_datetime is null ,' ',js.bl_check_datetime) as bl_check_datetime,
          js.ID_receiv_status,
          js.ID_picture,
          IF(concat(ID_re.first_name,' ',ID_re.last_name) IS null ,'',concat(ID_re.first_name,' ',ID_re.last_name)) as ID_receiv_by,
          IF(js.id_receiv_datetime is null ,' ',js.id_receiv_datetime) as id_receiv_datetime,
          IF(concat(ID_ck.first_name,' ',ID_ck.last_name) IS null ,'',concat(ID_ck.first_name,' ',ID_ck.last_name)) as ID_check_by,
          IF(js.id_check_datetime is null ,' ',js.id_check_datetime) as id_check_datetime,
          js.IL_receiv_status,
          js.IL_picture,
          IF(concat(IL_re.first_name,' ',IL_re.last_name) IS null ,'',concat(IL_re.first_name,' ',IL_re.last_name)) as IL_receiv_by,
          IF(js.il_receiv_datetime is null,' ',js.il_receiv_datetime) as il_receiv_datetime,
          IF(concat(IL_ck.first_name,' ',IL_ck.last_name) IS null ,'',concat(IL_ck.first_name,' ',IL_ck.last_name)) as IL_check_by,
          IF(js.il_check_datetime is null,' ',js.il_check_datetime) as il_check_datetime,
          IF(js.Cus_suc_datetime is null,' ',js.Cus_suc_datetime) as Cus_suc_datetime,
          IF(concat(custom_by.first_name,' ',custom_by.last_name) IS null ,'',concat(custom_by.first_name,' ',custom_by.last_name)) as custom_by,
          js.Cus_status
        FROM `job_status` js
      LEFT OUTER JOIN user INV_re ON js.INV_receiv_by = INV_re.user_number
      LEFT OUTER JOIN user INV_ck ON js.INV_check_by = INV_ck.user_number
      LEFT OUTER JOIN user PL_re ON js.PL_receiv_by = PL_re.user_number
      LEFT OUTER JOIN user PL_ck ON js.PL_check_by = PL_ck.user_number
      LEFT OUTER JOIN user BL_re ON js.BL_receiv_by = BL_re.user_number
      LEFT OUTER JOIN user BL_ck ON js.BL_check_by = BL_ck.user_number
      LEFT OUTER JOIN user ID_re ON js.ID_receiv_by = ID_re.user_number
      LEFT OUTER JOIN user ID_ck ON js.ID_check_by = ID_ck.user_number
      LEFT OUTER JOIN user IL_re ON js.IL_receiv_by = IL_re.user_number
      LEFT OUTER JOIN user IL_ck ON js.IL_check_by = IL_ck.user_number 
      LEFT OUTER JOIN user custom_by ON js.cus_by = custom_by.user_number
          WHERE job_number ='$job_number'";
 
          $sql_jt = "
          SELECT jt.clearlance_date FROM job_title as jt WHERE job_number ='$job_number'
          ";

          $sql_js = "
          SELECT 
          u1.first_name as f_cus,
          u1.last_name l_cus,
          js.Cus_suc_datetime,
          js.Cus_status,
          js.cus_pro,
          u2.first_name as f_ship,
          u2.last_name l_ship,
          js.ship_arrievd_st,
          js.ship_arrived_status,
          js.ship_pro,
          u3.first_name f_cy,
          u3.last_name l_cy,
          js.cy_rtn,
          cy_rtn_status,
          js.drop_status,
          js.drop_datetime,
          js.drop_pro,
          u4.first_name drop_f,
          u4.last_name drop_l
          FROM job_status as js
          LEFT JOIN user as u1 ON js.cus_by = u1.user_number
          LEFT JOIN user as u2 ON js.ship_arrievd_by = u2.user_number
          LEFT JOIN user as u3 ON js.cy_rtn_by = u3.user_number
          LEFT JOIN user as u4 ON js.drop_by = u4.user_number
          WHERE job_number ='$job_number'
          ";
        
        $sql_adapter = "SELECT ID FROM job_title WHERE job_number ='$job_number'";          

$result = $con->query($sql_adapter);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $adt = $row['ID'];
  }
} else {
  $adt = "0 results";
}


$sql_container ="
SELECT 
cn.*,
u1.first_name as up_f,
u1.last_name as up_l,
u2.first_name as cntr_f,
u2.last_name as cntr_l,
u3.first_name as cy_f,
u3.last_name as cy_l
FROM container cn
LEFT JOIN user u1 ON cn.up_by_cntr = u1.user_number
LEFT JOIN user u2 ON cn.cntr_up_by = u2.user_number
LEFT JOIN user u3 ON cn.cy_by_cntr = u3.user_number
WHERE ref_job_id = '$adt'
";

$result = $con->query($sql_detail_job);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dts = $row;
  }
} else {
  $dts = "0 results";
}

$result = $con->query($sql_jt);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dtsa = $row;
  }
} else {
  $dtsa = "0 results";
}

$result = $con->query($sql_js);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dtcr = $row;
  }
} else {
  $dtcr = "0 results";
}

$result = $con->query($sql_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container[] = $row;
  }
} else {
  $container = "0 results";
}


  echo json_encode(array('dts'=>$dts,'dtsa'=>$dtsa,'dtcr'=>$dtcr,'container'=>$container));
