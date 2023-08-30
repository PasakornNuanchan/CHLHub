<?php
include '../../core/conn.php';

$job_number = $_POST['job_number'];
$date_start = $_POST['date_start'];
$date_stop = $_POST['date_stop'];
$bill_to = $_POST['bill_to'];
$cs_support = $_POST['cs_support'];
$bill_to_type = $_POST['bill_to_type'];

$cs_support = $cs_support == '' ? '' : "AND jt.cs_support = '$cs_support'";
$job_number = $job_number == '' ? '' : "AND jt.job_number LIKE '%$job_number%'";
$q_date = "";
if($date_start == '' && $date_stop == ''){
    $q_date = "";
}else if($date_start == '' && $date_stop != ''){
    $q_date = "AND jt.create_date BETWEEN '1900-01-01' AND '$date_stop'";
}else if($date_start != '' && $date_stop == ''){
    $q_date = "AND jt.create_date BETWEEN '$date_start' AND '2100-01-31'";
}else if($date_start != '' && $date_stop != ''){
    $q_date = "AND jt.create_date BETWEEN '$date_start' AND '$date_stop'";
}

if($bill_to != ''){
    $q_bill_to = "AND b.bill_to_type = '$bill_to_type' AND b.bill_to = '$bill_to' ";
}else{
    $q_bill_to = "";
}


$limit_data = "";
if($job_number == '' || $date_start == '' || $date_stop == '' || $date_stop == '' || $bill_to == '' || $cs_support == '' ){
    $limit_data = "LIMIT 150";
}

$sql_data_dafault = "
SELECT 
jt.ID,
b.ID as billing_id,
jt.create_date,
if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),(SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
jt.job_number,
jt.mbl,
(SELECT GROUP_CONCAT(c.container_number) FROM container c WHERE c.ref_job_id = jt.ID) as container,
(SELECT COUNT(c.container_number) FROM container c WHERE c.ref_job_id = jt.ID) as container_quantity,
(SELECT bd.billing_item_name FROM billing_description bd WHERE bd.ID = b.billing_description) as billing_item_data,
((b.qty *b.unit_price)*b.vat/100)+(b.qty *b.unit_price) as cal_data,
b.currency
FROM job_title jt
LEFT JOIN billing b ON jt.ID = b.ref_job_id
WHERE b.type ='AP' AND b.status = '0' $cs_support $job_number $q_date $q_bill_to
ORDER BY bill_to_c
$limit_data
";

$result = $con->query($sql_data_dafault);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_setting_default_ap_by_job[] = $row;
    //$data_setting_default_ap_by_job[] = $row['ID'];
  }
  foreach($data_setting_default_ap_by_job as $k => $v){
    $data_setdefault_ap_by_job[$v['ID']][] = $v;
  }
} else {
  $data_setdefault_ap_by_job = "0 results";
}

// foreach($data_setting_default_ap_by_job as $k => $v){
//     $data_setting_default_ap_by_job[] = 
// }


echo json_encode(array('data_setdefault_ap_by_job'=>$data_setdefault_ap_by_job))

?>