<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$date_select = isset($_POST['data_sent']['date_select']) ? $_POST['data_sent']['date_select'] : '';
$sale = isset($_POST['data_sent']['sale']) ? $_POST['data_sent']['sale'] : '';
$client = isset($_POST['data_sent']['client']) ? $_POST['data_sent']['client'] : '';
$date_start = isset($_POST['data_sent']['date_start']) ? $_POST['data_sent']['date_start'] : '';
$date_end = isset($_POST['data_sent']['date_end']) ? $_POST['data_sent']['date_end'] : '';
$job_number = isset($_POST['data_sent']['job_number']) ? $_POST['data_sent']['job_number'] : '';
$have_ar = isset($_POST['data_sent']['have_ar']) ? $_POST['data_sent']['have_ar'] : '';
$no_ap = isset($_POST['data_sent']['no_ap']) ? $_POST['data_sent']['no_ap'] : '';
$unfinish = isset($_POST['data_sent']['unfinish']) ? $_POST['data_sent']['unfinish'] : '';
$all_co = isset($_POST['data_sent']['all_co']) ? $_POST['data_sent']['all_co'] : '';
$commition = isset($_POST['data_sent']['commition']) ? $_POST['data_sent']['commition'] : '';
$currency = isset($_POST['data_sent']['currency']) ? $_POST['data_sent']['currency'] : '';
$co_op = isset($_POST['data_sent']['co_op']) ? $_POST['data_sent']['co_op'] : '';

$having_sale = '';
if ($sale != '') {
  $having_sale = "AND user_sale = '$sale' ";
}


$having_client = '';
if ($client != '') {
  $having_client = "AND consignee_number = '$client' ";
}

$having_date_select = '';
if($date_select != ''&& $date_start != '' && $date_end != ''){
  if($date_select == "op_date"){
    $having_date_select = "AND create_date BETWEEN '$date_start' AND '$date_end'";
  }else if($date_select == "received_date"){
    $having_date_select = "AND rcvd_date BETWEEN '$date_start' AND '$date_end'";
  }else if($date_select == "paid_date"){
    $having_date_select = "AND paid_date BETWEEN '$date_start' AND '$date_end'";
  }
}


$having_job_number = '';
if ($job_number != '') {
  $having_job_number = "AND job_number = '$job_number' ";
}

$having_have_ar = "";
$having_no_ap = "";
$having_unfinish = "";
$having_all_co = "";
$having_commition = "";
$having_currency = "";

if($have_ar == '1'){
  $having_have_ar = "AND ar_amt IS NOT NULL";
}
if($no_ap == '1'){
  $having_no_ap = "AND ap_amt IS NULL";
}
if($unfinish == '1'){
  $having_unfinish = "AND ";
}
// if($all_co == '1'){
//   $having_all_co = "";
// }
// if($commition == '1'){
//   $having_commition = "";
// }

// if($currency != ""){
//   $having_currency = "AND";
// }
// echo $currency;
// echo $co_op;



$sql_data = "
SELECT
    jt.ID,
    jt.job_number,
    jt.consignee_number,
    (SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.consignee_number) as bill_to_c,
    (SELECT u1.ID FROM user u1 WHERE jt.sale_support = u1.ID) user_sale,
   	(SELECT u1.first_name FROM user u1 WHERE jt.sale_support = u1.ID) f_name_sale,
   	(SELECT u1.last_name FROM user u1 WHERE jt.sale_support = u1.ID) l_name_sale,
	  (SELECT SUM(b.amtinclvat) FROM billing b WHERE b.type = 'AR' AND FIND_IN_SET(b.ref_job_id,jt.ID)) ar_amt,
    (SELECT SUM(bpl.amount) FROM billing b LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID WHERE b.type = 'AR' AND FIND_IN_SET(b.ref_job_id,jt.ID)) rcvd_amt,
    (SELECT SUM(b.amtinclvat) FROM billing b WHERE b.type = 'AP' AND FIND_IN_SET(b.ref_job_id,jt.ID)) ap_amt,
	  (SELECT SUM(bpl.amount) FROM billing b LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID WHERE b.type = 'AP' AND FIND_IN_SET(b.ref_job_id,jt.ID)) paid_amt,
    jt.create_date,
    (SELECT MAX(bp.payment_date) FROM billing b LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID LEFT JOIN billing_payment bp ON bpl.id_refer_bp = bp.ID WHERE b.type = 'AR' AND FIND_IN_SET(b.ref_job_id,jt.ID)) rcvd_date,
	  (SELECT MAX(bp.payment_date) FROM billing b LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID LEFT JOIN billing_payment bp ON bpl.id_refer_bp = bp.ID WHERE b.type = 'AP' AND FIND_IN_SET(b.ref_job_id,jt.ID)) paid_date,
    jt.mother_vessel
FROM
    job_title jt
    LEFT JOIN billing b ON b.ref_job_id = jt.ID
    LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = b.ID
GROUP BY
	jt.ID 
  HAVING
  1=1
  $having_sale
  $having_client
  $having_date_select
  $having_job_number
  $having_have_ar
  $having_no_ap
  ORDER BY
  ID DESC
";
// echo $sql_data;
$result = $con->query($sql_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $table_data[] = $row;

    if($row['user_sale'] != ''){
      if(in_array(,$data_get_uesr) != $row['user_sale']){
        $data_get_user[] = $row['user_sale'];
      }
    }
  }
} else {
  $table_data = "0 results";
}




if($table_data != "0 results"){
  $data_implode_get_user = implode(",",$data_get_user);
  $sql_data_get_user = "
  SELECT * FROM user WHERE ID IN ($data_implode_get_user)
  ";
  echo $sql_data_get_user;
}

echo json_encode(array('table'=>$table,'spend'=>$spend,'table_data'=>$table_data));

