<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

//echo $job_number;
$sql_jt = "
    SELECT 
        apol.location_name as pol_location,
        apol.country as pol_country,
        apod.location_name as pod_location,
        apod.country as pod_country,
        sale.first_name,
        sale.last_name,
        con.consignee_name,
        con.tel as consignee_tel,
        con.email as consignee_email,
        con.linkman as consignee_linkman,
        shp.shipper_name,
        shp.tel as shipper_tel,
        shp.email as shipper_email,
        shp.linkman as shipper_linkman,
        COUNT(c.container_number) as count_cntr
    FROM job_title as jt
    LEFT JOIN consignee as con ON jt.consignee_number = con.consignee_number
    LEFT JOIN area as apol ON jt.port_of_loading_number = apol.area_number
    LEFT JOIN area as apod ON jt.port_of_delivery_number = apod.area_number
    LEFT JOIN shipper as shp ON jt.shipper_number = shp.shipper_number
    LEFT JOIN user as sale ON jt.sale_support = sale.user_number
    LEFT JOIN transport_booking as tb ON jt.job_number = tb.job_number
    LEFT JOIN container as c ON tb.container_ID = c.ID
    WHERE jt.job_number = '$job_number'
    GROUP BY jt.job_number
    ";

    $sql_op_data = "
    SELECT
        jt.mother_vessel,
        jt.voy_no_mother,
        jt.feeder_vessel,
        jt.voy_no_feeder,
        jt.hbl,
        jt.eta,
        jt.etd,
        jt.booking_number,
        c.carrier_name,
        GROUP_CONCAT(con.container_number) as concatcntr,
        GROUP_CONCAT(DISTINCT ts.transport_sup_name) as concattrailers,
        GROUP_CONCAT(DISTINCT ts.tel) as concattel,
        GROUP_CONCAT(DISTINCT ts.linkman) as concatlinkman,
        mk.first_name as market_first,
        mk.last_name as market_last,
        ab.agent_name_corp as agent_booking,
        ab.tel as agent_tel,
        ab.email as agent_email,
        ab.linkman as agent_linkman,
        st.st_name,
        bc.corp_name as customs_name,
        bc.tel as customs_tel,
        bc.linkman as customs_linkman,
        jt.terminal
    FROM job_title as jt
        LEFT JOIN agent_booking as ab ON jt.booking_agent = ab.booking_agent_number
        LEFT JOIN carrier as c ON jt.carrier_number = c.carrier_number
        LEFT JOIN transport_booking as tb ON jt.job_number = tb.job_number
        LEFT JOIN container as con ON tb.container_ID = con.ID
        LEFT JOIN transport_sup as ts ON tb.sup_number = ts.transport_sup_number
        LEFT JOIN user as mk ON jt.last_save_by = mk.user_number
        LEFT JOIN shipment_term as st ON jt.st_number = st.st_number
        LEFT JOIN broker_customs as bc ON jt.customs_broker = bc.broker_number

    WHERE 
        jt.job_number = '$job_number'
    ";
  
    $sql_ar = "
    SELECT 
      b.ID,
      bd.billing_number,
      bd.billing_item_name,
      c.consignee_number,
      c.consignee_name,
      b.payble,
      b.currency,
      b.qty,
      b.unit_price,
      b.amount,
      b.vat,
      b.amtinclvat,
      b.remark,
      b.check_status
    FROM `billing` b
      LEFT JOIN billing_description bd ON b.billing_description = bd.billing_number
      LEFT JOIN consignee c ON b.bill_to = c.consignee_number
    WHERE 
      job_number = '$job_number' and 
      type = 'AR'
    ";
  

     
$result = $con->query($sql_jt);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $jt = $row;
  }
} else {
  $jt = "0 results";
}

$result = $con->query($sql_op_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $op = $row;
  }
} else {
  $op = "0 results";
}

$result = $con->query($sql_ar);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $ar[] = $row;
  }
} else {
  $ar = "0 results";    
}


 
 
        

      echo json_encode(array('jt'=>$jt,'ar'=>$ar,'op'=>$op));
?>