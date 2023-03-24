<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

    $sql_detail = "
    SELECT 
    jt.job_number,
    jt.inv,
    c.consignee_name,
    jt.mbl,
    jt.etd,
    jt.hbl,
    jt.eta,
    cr.carrier_name,
    concat(an.country,' ,',an.location_name) as pol,
    jt.mother_vessel,
    jt.voy_no_mother,
    jt.feeder_vessel,
    jt.voy_no_feeder,
    concat(av.country,' ,',av.location_name) as pod,
    concat(ab.country,' ,',ab.location_name) as port,
    jt.clearlance_date,
    jt.check_document,
    jt.delivery_date,
    js.cus_suc_datetime,
    jt.enter_date,
    jt.pickup_DO_date,
    jt.inv
  
    FROM job_title jt
      LEFT JOIN consignee c on jt.consignee_number = c.consignee_number
      LEFT JOIN carrier cr on jt.carrier_number = cr.carrier_number
      LEFT JOIN area an on jt.port_of_loading_number = an.area_number
      LEFT JOIN area ab on jt.port_of_delivery_number = ab.area_number
      LEFT JOIN area av on jt.ts_port_number = av.area_number
      LEFT JOIN job_status js on jt.job_number = js.job_number
     WHERE jt.job_number = '$job_number';
    ";
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
          IF(js.Cus_suc_datetime is null,' ',js.Cus_suc_datetime) as Cus_suc_datatime,
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
          WHERE job_number ='$job_number';";

    $sql_container = "
      SELECT * FROM container WHERE job_number = '$job_number';";

      $sql_transport = "
      SELECT
        tb.ID,
        tb.sup_number,
        tb.truck_quantity,
        tb.pick_con_empty_address,
        tb.pick_con_empty_remark,
        tb.pick_con_address,
        tb.pick_con_remark,
        tb.drop_con_address,
        tb.drop_con_remark,
        tb.drop_con_empty_address,
        tb.drop_con_empty_remark,
        tb.sup_confirm,
        tb.type_truck,
        tb.remark
      FROM
          `transport_booking` as tb
      WHERE job_number = '$job_number' AND status=0";

      $sql_supplier = "
      SELECT * FROM `transport_sup`
      ";

      $sql_booking = "
      SELECT * FROM job_title WHERE job_number = '$job_number';";

      $sql_cn_inform = "
      SELECT * FROM container_information 
      LEFT JOIN hs_code ON container_information.hs_code = hs_code.ID WHERE job_number = '$job_number'";

      $sql_dem = "
      SELECT  
        dem.ID,
        dem.container_id,
        dem.old_dem_time,
        dem.new_dem_time,
        dem.file_add,
        c.container_number,
        c.job_number,
        c.ID as head_of_container,
        c.RTN,
        c.CY
      FROM demurrage as dem
        LEFT JOIN container as c ON dem.container_id = c.ID
      WHERE 
        c.job_number = '$job_number'
      ORDER BY 
        dem.ID ASC
      ";



$result = $con->query($sql_detail);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $de = $row;
  }
} else {
  $de = "0 results";
}

$result = $con->query($sql_detail_job);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dej = $row;
  }
} else {
  $dej = "0 results";
}

$result = $con->query($sql_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cont[] = $row;
  }
} else {
  $cont = "0 results";
}

$result = $con->query($sql_transport);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tran[] = $row;
    $get_tran[] = $row['ID'];
  }
} else {
  $tran = "0 results";
}

$imp_set_tran_drive = implode(',', $get_tran);
$sql_tran_drive = "
      SELECT 
      tc.ID,
      tc.Driver_name,
      tc.phone_number,
      tc.container_id,
      tc.job_number,
      tc.route_id,
      c.container_number,
      c.seal_number
      FROM transport_contact as tc
      LEFT JOIN container as c ON tc.container_id = c.ID
      WHERE tc.route_id IN($imp_set_tran_drive) AND tc.status = '0'
      ";

$result = $con->query($sql_tran_drive);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $transport_driver[] = $row;
  }
} else {
  $transport_driver = "0 results";
}

foreach ($transport_driver as $k => $v) {
  $transport_driver_arr[$v['route_id']][] = $v;
}


$result = $con->query($sql_supplier);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $supplier[] = $row;
  }
} else {
  $supplier = "0 results";
}

$result = $con->query($sql_booking);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $booking = $row;
  }
} else {
  $booking = "0 results";
}

$result = $con->query($sql_cn_inform);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cninform = $row;
  }
} else {
  $cninform = "0 results";
}

$result = $con->query($sql_dem);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dem[] = $row;
  }
} else {
  $dem = "0 results";
}
      

echo json_encode(array('de'=>$de,'dej'=>$dej,'cont'=>$cont,'tran'=>$tran,'supplier'=>$supplier,'booking'=>$booking,'cninform'=>$cninform,'transport_driver_arr'=>$transport_driver_arr,'dem'=>$dem));




?>