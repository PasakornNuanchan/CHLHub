<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


  $sql_get_data_table = "
  SELECT
          (SELECT c.consignee_name FROM consignee c WHERE c.ID = (SELECT jt.consignee_number FROM job_title jt WHERE ID = b.ref_job_id)) consignee_name ,
                    (SELECT c.tel FROM consignee c WHERE c.ID = (SELECT jt.consignee_number FROM job_title jt WHERE ID = b.ref_job_id)) consginee_tel ,
          (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
          (SELECT concat(first_name,' ',last_name) FROM user WHERE user.ID = (SELECT sale_support FROM job_title WHERE ID = b.ref_job_id)) sale_support,
          if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
          (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
          (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
          b.currency,
          b.ref_job_id,
          b.ID,
          b.qty,
          b.unit_price,
          b.vat,
          b.remark,
          b.sys_rate,
          b.sys_rate_currency,
		  (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.create_by) create_by,
	 	  (SELECT mbl FROM job_title WHERE ID = b.ref_job_id) mbl,
          (SELECT jt.mother_vessel FROM job_title jt WHERE ID = b.ref_job_id) vessel,
          (SELECT jt.etd FROM job_title jt WHERE ID = b.ref_job_id) ETD,
          (SELECT jt.eta FROM job_title jt WHERE ID = b.ref_job_id) ETA
          
      FROM
          billing b
      WHERE
          b.type = 'AP' 
          AND b.type = 'AP' 
          AND b.approve_date_time IS NOT NULL
  ";




$result = $con->query($sql_get_data_table);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $table[] = $row;
    }
  } else {
    $table = "0 results";
  }


  echo json_encode(array('table'=>$table));
