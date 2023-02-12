<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';


$sql_payment = "
    SELECT * FROM cash_payment cp
    INNER JOIN billing_description bd ON cp.description = bd.billing_number 
    INNER JOIN user u ON cp.create_by = u.user_number
    WHERE job_number = '$job_number'
    ";
$sql_detail_job = "
SELECT 
js.ID,
      js.job_number,
      js.INV_receiv_status,
      js.INV_picture,
      IF(concat(INV_re.first_name,' ',INV_re.last_name) IS null ,' ',concat(INV_re.first_name,' ',INV_re.last_name))as INV_receiv_by ,
      IF(js.inv_receiv_datetime is null ,' ',js.inv_receiv_datetime) as inv_receiv_datetime,
      IF(concat(INV_ck.first_name,' ',INV_ck.last_name) IS null ,' ',concat(INV_ck.first_name,' ',INV_ck.last_name)) as INV_check_by,
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
      WHERE job_number ='$job_number'";

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
        tb.budget,
        tb.cur,
        tb.sent_line_datetime,
        tb.sup_confirm,
        tb.type_truck,
        tb.remark,
        ts.transport_sup_name,
        tt.truck_name
      FROM transport_booking as tb
      LEFT JOIN transport_sup as ts ON tb.sup_number = ts.transport_sup_number
      LEFT JOIN type_truck as tt ON tb.type_truck = tt.type_truck_number
      WHERE tb.job_number = '$job_number'
      ORDER BY tb.ID ASC";

      $sql_container = "
      SELECT * FROM container WHERE job_number = '$job_number';";

      $sql_booking = "
      SELECT * FROM job_title WHERE job_number = '$job_number';";


      $sql_cn_inform = "
      SELECT 
        `cn`.`cargo`,
        `hs`.`hs_code`,
        `hs`.`hs_decription`,
        `cn`.`cargo_type`,
        `cn`.`quantity`,
        `cn`.`gw`,
        `cn`.`volume`,
        `cn`.`mark` 
      FROM 
        container_information as cn 
        LEFT JOIN hs_code as hs ON cn.hs_code = hs.hs_code
        WHERE cn.job_number = '$job_number';";

   

     $sql_driver = "
     SELECT 
     tc.ID,
     tc.Driver_name,
     tc.phone_number,
     c.ID as container_id,
     c.seal_number,
     tc.route_id
     
     FROM transport_contact as tc
     LEFT JOIN container as c ON tc.container_id = c.ID
     WHERE tc.job_number = '$job_number'";

     
$result = $con->query($sql_payment);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pay[] = $row;
  }
} else {
  $pay = "0 results";
}

$result = $con->query($sql_detail_job);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dts = $row;
  }
} else {
  $dts = "0 results";
}
$result = $con->query($sql_transport);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tran[] = $row;
  }
} else {
  $tran[] = "0 results";
}

$result = $con -> query($sql_container);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cont[] = $row;
    }
  } else {
    $cont[] = "0 results";
  }

$result = $con -> query($sql_booking);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $booking = $row;
    }
  } else {
    $booking = "0 results";
  }

 

  $result = $con -> query($sql_cn_inform);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $cninform = $row;
      }
    } else {
      $cninform = "0 results";
    }

  

  $result = $con->query($sql_driver);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $driver[] = $row;
    }
  } else {
    $driver[] = "0 result";
  }
 
 
        

      echo json_encode(array('pay'=>$pay,'dts'=>$dts,'tran'=>$tran,'cont'=>$cont,'booking'=>$booking,'cninform'=>$cninform,'driver'=>$driver));
