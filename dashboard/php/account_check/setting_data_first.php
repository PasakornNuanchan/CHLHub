<?php 
include '../../core/conn.php';

$data_load_job_number = $_POST['data_load_job_number'];
$data_load_mbl = $_POST['data_load_mbl'];
$data_load_container = $_POST['data_load_container'];
$rd_st = $_POST['rd_st'];
$rd_ty = $_POST['rd_ty'];

$data_load_job_number = $data_load_job_number != "" ? "AND jt.job_number LIKE '%".$data_load_job_number."%'" : "";
$data_load_mbl = $data_load_mbl != "" ? "AND jt.mbl LIKE '%".$data_load_mbl."%'" : "";
$data_load_container = $data_load_container != "" ? "AND cn.container_number LIKE '%".$data_load_container."%'" : "";

$status_q = "";
if($rd_st == "ALL"){
    $status_q = "";
}else if($rd_st == "PREPAID"){
    $status_q = "AND b.status = '0'";
}else if($rd_st == "PAID"){
    $status_q = "AND b.status = '1'";
}else if($rd_st == "REJECT"){
    $status_q = "AND b.status = '2'";
}


//$rd_ty = $rd_ty != "ALL" ? "AND b.type = '".$rd_ty."'" : "";
$type_q = "";
if($rd_ty == "ALL"){
    $type_q == "";
}else if($rd_ty == "AR"){
    $type_q = "AND b.type = 'AR'";
}else if($rd_ty == "AP"){
    $type_q = "AND b.type = 'AP'";
}

// echo $rd_st;
// echo $rd_ty;


// echo $data_load_job_number;



$sql_data_first = "
SELECT
    b.ID,
    jt.job_number,
    bd.billing_item_name,
    if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),(SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
    b.currency,
    b.qty,
    b.unit_price,
    b.vat,
    b.remark,
    b.create_data_time,
    u1.first_name as create_f,
    u1.last_name as create_l,
    b.action_paid_date_time,
    u2.first_name as paid_f,
    u2.last_name as paid_l,
    jt.sale_support,
    b.status
FROM
    billing b
LEFT JOIN job_title jt ON b.ref_job_id = jt.ID
LEFT JOIN billing_description bd ON b.billing_description = bd.ID
LEFT JOIN user u1 ON b.create_by = u1.ID
LEFT JOIN user u2 ON b.action_paid_by = u2.ID
LEFT OUTER JOIN container cn ON cn.ref_job_id = jt.ID
WHERE
    1
    $data_load_job_number $data_load_mbl $data_load_container $status_q $type_q
GROUP BY b.ID;";

$result = $con->query($sql_data_first);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    $data_list[] = $row;
}
} else {
$data_list = "0 results";
}

$sql_data_job_all = "
SELECT job_number FROM job_title
"; 


$result = $con->query($sql_data_job_all);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $data_job_number[] = $row;
    }
} else {
    $data_job_number = "0 results";
}

$sql_data_mbl_all = "
SELECT mbl FROM job_title
";

$result = $con->query($sql_data_mbl_all);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $data_mbl[] = $row;
    }
} else {
    $data_mbl = "0 results";
}

$sql_data_container_all = "
SELECT container_number FROM container
";

$result = $con->query($sql_data_container_all);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $data_container[] = $row;
    }
} else {
    $data_container = "0 results";
}

$sql_data_user = "
SELECT ID,first_name,last_name FROM user
";

$result = $con->query($sql_data_user);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $data_user[] = $row;
    }
} else {
    $data_user = "0 results";
}
    
echo json_encode(array('data_list'=>$data_list,'data_job_number'=>$data_job_number,'data_mbl'=>$data_mbl,'data_container'=>$data_container,'data_user'=>$data_user))
?>