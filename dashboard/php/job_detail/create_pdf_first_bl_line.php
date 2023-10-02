<?php

use PDF as GlobalPDF;

include '../../core/conn.php';

$job_number = $_GET['job_number'];
$bl_number = $_GET['bl_number_main'];
$id_row = $_GET['id_list'];
//query

$sql_query_fright = "
SELECT
    `fright`,
    `prepaid`,
    `collect`
FROM
    `fright_bl`
WHERE
    `ref_row` = '$bl_number'
";
$result = $con->query($sql_query_fright);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_fright[] = $row;
  }
} else {
  $data_fright = "0 results";
}

$sql_query_shipper = "
SELECT
    jt.final_destination,
    jt.shipper_number,
    s.shipper_name,
    s.address as address_shipper,
    c.consignee_name,
    c.address as address_consignee,
    jt.mbl,
    jt.hbl,
    jt.feeder_vessel,
    a1.location_name as a1location,
    a2.location_name as a2location,
    a3.location_name as a3location,
    a4.location_name as a4location,
    a1.provice as a1provice,
    a2.provice as a2provice,
    a3.provice as a3provice,
    a4.provice as a4provice,
    jt.mother_vessel,
    st.st_name
FROM
    job_title jt
LEFT JOIN shipper s ON jt.shipper_number = s.ID
LEFT JOIN consignee c ON jt.consignee_number = c.ID
LEFT JOIN area a1 ON jt.port_of_receipt_number = a1.ID
LEFT JOIN area a2 ON jt.port_of_loading_number = a2.ID
LEFT JOIN area a3 ON jt.ts_port_number = a3.ID
LEFT JOIN area a4 ON jt.port_of_delivery_number = a4.ID
LEFT JOIN shipment_term st ON jt.st_number = st.ID
WHERE
    jt.ID = '$job_number'
";
$result = $con->query($sql_query_shipper);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_shipperandconsignee[] = $row;
    $data_address_shipper[] = $row['address_shipper'];
    $data_address_consignee[] = $row['address_consignee'];
  }
} else {
  $data_shipper = "0 results";
}


$sql_list = "
SELECT
    *
FROM
    `bl_title`
WHERE
    ID = '$bl_number'
";

$result = $con->query($sql_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $data_shipper[] = $row['shipper_bl'];
    $data_consignee[] = $row['consignee_bl'];
    $data_description[] = $row['description_of_good'];
    $data_bl_number[] = $row['bl_number'];
    $data_notify[] = $row['notify_party'];
    $data_delivery_agent[] = $row['delivery_agent'];
  }
} else {
  $data = "0 results";
}

$sql_query_bl_list = "
SELECT * FROM `bl_list` WHERE ID = '$id_row'
";
$result = $con->query($sql_query_bl_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_bl_list[] = $row;
    $data_bl_list_container[] = $row['container_no'];
    $data_bl_list_kind[] = $row['kind_of_package'];
  }
} else {
  $data_bl_list = "0 results";
}

//print_r($data_bl_list_kind[]);

$sql_container_bl_list = "
SELECT 
c.*,
u.name
FROM container c
LEFT JOIN unit u ON c.unit = u.ID
WHERE ref_job_id = '$job_number'";
$result = $con->query($sql_container_bl_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container_data[] = $row;
  }
} else {
  $container_data = "0 results";
}

$sql_count_container = "
SELECT
	container_type,
	COUNT(ID) as count_id
FROM
    container c
WHERE
    ref_job_id = '$job_number'
GROUP BY
	container_type
";

$result = $con->query($sql_count_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $count_container[] = $row;
  }
} else {
  $count_container = "0 results";
}





//pdf
$id_create = $_GET['id_create'];
require('../../lib/fpdf/fpdf.php');
class PDF extends FPDF
{
  function Header()
  {

    $this->SetFont('Arial', 'B', 16);
  }

  function Footer()
  {

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
  }
}
//setting
$set_top = 7;
$pdf = new PDF();
$pdf->AddPage('P', 'A4');


// sub head

$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew_b.php');
$pdf->AddFont('THSarabunNew', 'BI', 'THSarabunNew_bi.php');
$pdf->AddFont('THSarabunNew', 'I', 'THSarabunNew_i.php');



$pdf->AddFont('times', '', 'times.php');
$pdf->AddFont('times', 'B', 'timesb.php');
$pdf->AddFont('times', 'BI', 'timesbi.php');
$pdf->AddFont('times', 'I', 'timesi.php');


//$pdf->AddFont('calisto', '', 'CALIST.php');




$set_height_header = 6;
$pdf->SetXY(10, 12);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(100, $set_height_header, "Shipper", 'TR', 0, 'L');
$pdf->SetX(140);
$pdf->Cell(60, $set_height_header, "B/L NO.", 1, 0, 'L');


for ($i = 1; $i <= 4; $i++) {
  $pdf->SetX(10);
  $pdf->Cell(100, 6, "", 'R', 1, 'L');
}


$pdf->SetX(10);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(100, $set_height_header, "Consignee", 'TR', 1, 'L');
$pdf->SetFont('times', '', 8, '', true);

for ($i = 1; $i <= 3; $i++) {
  $pdf->SetX(10);
  $pdf->Cell(100, 6, "", 'R', 1, 'L');
}


$pdf->SetX(10);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(100, $set_height_header, "Notify Party", 'TR', 0, 'L');
$pdf->SetFont('times', '', 8, '', true);
$pdf->Ln();




$pdf->SetX(110);
$pdf->Cell(90, $set_height_header, "Delivery Agent", 'T', 0, 'L');
//$get_data_y_delivery = $pdf->getY();

for ($i = 1; $i <= 4; $i++) {
  $pdf->SetX(10);
  $pdf->Cell(100, 5, "", 'R', 1, 'L');
}




//$pdf->SetXY()
$pdf->SetX(10, $get_y_notify + 1);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(50, 4, strtoupper("pre_carriage"), 'TR', 0, 'L');
$pdf->SetX(60);
$pdf->Cell(50, 4, strtoupper("Place of Receipt"), 'TR', 0, 'L');
$pdf->Ln();

foreach ($data_shipperandconsignee as $k => $v) {
  $pdf->SetX(10);
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->Cell(100, 4, strtoupper($v['feeder_vessel']), 0, 0, 'L');
}

foreach ($data_shipperandconsignee as $k => $v) {

  $pdf->SetX(60);
  $pdf->Cell(50, 4, strtoupper($v['a1location'] . "," . $v['a1provice']), "R", 1, 'L');
}

$pdf->SetX(10);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(50, 4, strtoupper("vessel / Voyage"), "TR", 0, 'L');
$pdf->SetX(60);
$pdf->Cell(50, 4, strtoupper("Port of Loading"), "TR", 1, 'L');

foreach ($data_shipperandconsignee as $k => $v) {
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetX(10);
  $pdf->Cell(50, 4, strtoupper($v['mother_vessel']), 0, 0, 'L');
  $pdf->SetX(60);
  $pdf->Cell(50, 4, $v['a2location'] . "," . $v['a2provice'], "R", 1, 'L');
}

$pdf->SetX(10);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(50, 4, strtoupper("Port of Discharge"), "TR", 0, 'L');
$pdf->SetX(60);
$pdf->Cell(50, 4, strtoupper("Place of Delivery"), "TR", 0, 'L');
$pdf->SetX(110);
$pdf->Cell(90, 4, strtoupper("Final Destination(merchant's reference only)"), 'LT', 1, 'L');
//$pdf->Ln();

foreach ($data_shipperandconsignee as $k => $v) {
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetX(10);
  $pdf->Cell(50, 4, strtoupper($v['a3location'] . "," . $v['a3provice']), '', 0, 'L');
  $pdf->SetX(60);
  $pdf->Cell(50, 4, strtoupper($v['a4location'] . "," . $v['a4provice']), 'R', 0, 'L');
  $pdf->SetX(110);
  $pdf->Cell(80, 4, strtoupper($v['final_destination']), '', 1, 'L');
  
}

$pdf->SetFont('times', 'B', 8, '', true);
$pdf->SetX(10);
$pdf->Cell(50, 4, strtoupper("Container NO. & Seal NO."), "TR", 0, 'L');
$pdf->SetX(60);
$pdf->Cell(25, 4, strtoupper("No.of"), "TR", 0, 'L');
$pdf->SetX(85);
$pdf->Cell(70, 4, strtoupper("Kind of packages; Description of Goods"), 'TR', 0, 'L');
$pdf->SetX(155);
$pdf->Cell(25, 4, strtoupper("Gross Weight"), 'TR', 0, 'L');
$pdf->SetX(180);
$pdf->Cell(25, 4, strtoupper("Measurement"), 'TR', 1, 'L');

$pdf->SetX(10);
$pdf->Cell(50, 4, strtoupper("Marks and Numbers"), "R", 0, 'L');
$pdf->SetX(60);
$pdf->Cell(25, 4, strtoupper("Container or"), "R", 0, 'L');
$pdf->SetX(85);
$pdf->Cell(70, 4, strtoupper("SHIPPER'S LOAD & COUNT & SEAL"), 'R', 0, 'L');
$pdf->SetX(155);
$pdf->Cell(25, 4, strtoupper(""), 'R', 0, 'L');
$pdf->SetX(180);
$pdf->Cell(25, 4, strtoupper(""), 'R', 1, 'L');

$pdf->SetX(10);
$pdf->Cell(50, 4, strtoupper(""), "R", 0, 'L');
$pdf->SetX(60);
$pdf->Cell(25, 4, strtoupper("Package"), "R", 0, 'L');
$pdf->SetX(85);
$pdf->Cell(70, 4, strtoupper(""), 'R', 0, 'L');
$pdf->SetX(155);
$pdf->Cell(25, 4, strtoupper(""), 'R', 0, 'L');
$pdf->SetX(180);
$pdf->Cell(25, 4, strtoupper(""), 'R', 1, 'L');

for ($i = 0; $i <= 16; $i++) {

  $pdf->SetX(10);
  $pdf->Cell(50, 4, strtoupper(""), "R", 0, 'L');
  $pdf->SetX(60);
  $pdf->Cell(25, 4, strtoupper(""), "R", 0, 'L');
  $pdf->SetX(85);
  $pdf->Cell(70, 4, strtoupper(""), 'R', 0, 'L');
  $pdf->SetX(155);
  $pdf->Cell(25, 4, strtoupper(""), 'R', 0, 'L');
  $pdf->SetX(180);
  $pdf->Cell(25, 4, strtoupper(""), 'R', 1, 'L');
}


$get_y_table = $pdf->GetY();

$pdf->SetFont('times', '', 8, '', true);




$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(195, 3, strtoupper("Total number of Container"), 'T', 1, 'L');
$get_y_res = $pdf->GetY();
$pdf->Cell(195, 3, strtoupper("or other Packages or Units"), '', 1, 'L');
$get_y_res_last = $pdf->GetY();
$pdf->Cell(195, 3, strtoupper("(in words)"), 'B', 1, 'L');



foreach ($count_container as $k => $v) {
  $container_type = isset($v['container_type']) ? $v['container_type'] : '';
  $count_id = isset($v['count_id']) ? $v['count_id'] : '';

  $count_id_total = $count_id_total + $count_id;
  $text_data = "($count_id" . "X" . "$container_type) ";
  $all_context = $all_context . $text_data;
}

$all_context = strtoupper($all_context . " CONTAINER(S) ONLY");
$words = convertNumberToWords($count_id_total);

$pdf->SetXY(60, $get_y_res);

$pdf->Cell(150, 4, strtoupper("TOTAL : $words $all_context"));


$pdf->setXY(10, $get_y_res_last);
$pdf->Ln();
$pdf->Cell(38, 4, "Freight charges on ", 'RB');
$pdf->SetX(48);
$pdf->Cell(30, 4, "Prepaid", 'RB', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "Collect", 'RB', '', 'C');
$pdf->SetX(113);
$pdf->SetFont('times', '', 8, '', true);
$pdf->Cell(60, 4, "ACCEPTED in apparent good order and condition except as otherwise", 'L', 1, 'L');


$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "noted the total number of containers or other packages or units", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "enumerated below(*) for transportation from the place of acceptance to", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "the place delivery, subject to the terms hereof including the terms on", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "the reverse side herof and the terms of the C.T.O's applicable tariff", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "One of the original Bills of lading must be surrended duly endorsed", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "in exchange for the Goods or Delivery Order.", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "IN WITNESS whereof three(3) original Bills of lading have been", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "signed, one of which being accomplished, the other (s) to be void.", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '1', 'C');


$pdf->SetFont('times', '', 8, '', true);
$pdf->Cell(38, 4, "", 'R');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');


$pdf->Cell(38, 4, "", 'RB');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'RB', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'RB', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');





$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(38, 4, "Total", 'R', 0, 'L');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'R', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'R', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');

$pdf->Cell(38, 4, "", 'RB');
$pdf->SetX(48);
$pdf->Cell(30, 4, "", 'RB', '', 'C');
$pdf->SetX(78);
$pdf->Cell(35, 4, "", 'RB', '', 'C');
$pdf->SetX(113);
$pdf->Cell(60, 4, "", 'L', 1, 'L');


$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(60, 4, "Payable at", 'R', 0, 'L');
$pdf->SetX(70);
$pdf->Cell(43, 4, "NO. of Original B(s)/L", 'R', 0, 'L');
$pdf->SetX(113);
$pdf->Cell(90, 4, "Place / Date of issue", 'T', 1, 'L');

$pdf->Cell(60, 4, "", 'RB', 0, 'L');
$pdf->SetX(70);
$pdf->Cell(43, 4, "", 'RB', 0, 'L');
$pdf->SetX(113);
$pdf->Cell(90, 4, "", 'B', 1, 'L');

// $pdf->Cell(50,4,"",'RB');
// $pdf->SetX(50);
// $pdf->Cell(30,4,"",'RB','','C');
// $pdf->SetX(78);
// $pdf->Cell(35,4,"",'RB','','C');
// $pdf->SetX(113);
// $pdf->Cell(60,4,"",'L',1,'L');


foreach ($data_shipperandconsignee as $k => $v) {
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetXY(155, 12);
  $pdf->Cell(60, $set_height_header, $v['hbl'], '', 0, 'L');
}

// foreach($data_shipperandconsignee as $k => $v){
//   $pdf->SetFont('times', '', 8, '', true);
//   $pdf->SetXY(10,16);
//   $pdf->Cell(100, $set_height_header, $v['shipper_name'], 'R', 0, 'L');
// }

foreach ($data_shipper as $k => $v) {
  $pdf->SetXY(10, 18);
  $pdf->MultiCell(100, 3, strtoupper($v), '', "L");
}

// foreach($data_shipperandconsignee as $k => $v){
//   $pdf->SetXY(10,41);
//   $pdf->Cell(100, $set_height_header, strtoupper($v['consignee_name']), 'R', 1, 'L');
// }

foreach ($data_consignee as $k => $v) {
  $pdf->SetXY(10, 41);
  $pdf->MultiCell(100, 3, strtoupper($v), 'R', "L");
}


foreach ($data_notify as $k => $v) {
  $pdf->SetXY(10, 65);
  $pdf->MultiCell(100, 3, strtoupper($v), 'R', "L");
  $get_y_notify = $pdf->GetY();
}


foreach ($data_delivery_agent as $k => $v) {
  $pdf->SetXY(115, 73);
  $pdf->MultiCell(75, 3, strtoupper($v), '', "L");
}

$get_y_table = 123;

foreach ($data_bl_list as $k => $v) {
  $pdf->SetXY(10, $get_y_table);
  $pdf->MultiCell(50, 4, strtoupper($v['container_no']), "R", 'L');
  $data_last_container = $pdf->GetY();
}

foreach ($data_bl_list as $k => $v) {
  $pdf->SetXY(60, $get_y_table);
  $pdf->MultiCell(25, 4, strtoupper($v['package']) . " " . strtoupper($v['package_unit']), "R", 'C');
}


foreach ($data_bl_list as $k => $v) {
  $pdf->SetXY(155, $get_y_table);
  $pdf->MultiCell(25, 4, strtoupper($v['gross_weight']) . " " . strtoupper($v['gross_weight_unit']), "R", 'C');
}
foreach ($data_bl_list as $k => $v) {
  $pdf->SetXY(180, $get_y_table);
  $pdf->MultiCell(25, 4, strtoupper($v['measurement']) . " " . strtoupper($v['cbm_unit']), "R", 'C');
}
// foreach ($data_bl_list as $k => $v) {
//   $pdf->SetXY(85, $get_y_table);
//   $pdf->MultiCell(70, 4, strtoupper($v['kind_of_package']), "", 'L');

// }

$data_last_y_get = $pdf->GetY();
if ($data_last_container > $get_y_table) {
  $get_y_table = $data_last_container;
}

$pdf->SetXY(160, 160);
$pdf->SetFont('times', 'B', 8, '', true);
$pdf->Cell(40, 4, "SHIPPED ON BOARD:", 0, 0, 'C');
$pdf->SetXY(160, 165);
$today = date("Y/m/d");
$pdf->SetFont('times', '', 8, '', true);
$pdf->Cell(40, 4, $today, 0, 0, 'C');
$pdf->SetY($data_last_y_get + 5);


$pdf->SetFont('times', 'B', 9, '', true);
foreach ($data as $k => $v) {
  if($v['fright_c_on']== '1'){
    $pdf->SetXY(48,210);
    $pdf->Cell(30, 4,"FREIGHT PREPAID", 0,0, "C");
  }else{
    $pdf->SetXY(78,220);
    $pdf->Cell(35, 4,"FREIGHT COLLECT", 0,0, "C");
  }
  
}


$pdf->SetFont('times', '', 8, '', true);
$pdf->setXY(30, 271);
foreach ($data as $k => $v) {
  $pdf->Cell(10, 4, strtoupper($v['payble_at']), 0, 0, "C");
}



$pdf->SetXY(113, 255);
$pdf->SetFont('times', 'B', 12, '', true);
$pdf->Cell(90, 4, "_____________________________________", '', '', 'C');

$pdf->SetXY(135, 259);
$pdf->SetFont('times', 'i', 8, '', true);
$pdf->Cell(90, 4, "Authorized Signature", '', '', 'C');


$pdf->SetFont('times', '', 8, '', true);
$pdf->SetY(271);
$pdf->SetX(145);
foreach ($data as $k => $v) {
  $pdf->Cell(0, 4, $v['place']);
}
foreach ($data as $k => $v) {
  $word_bl = convertNumberToWords($v['bl_number']);
  $pdf->SetX(90);
  $pdf->Cell(20, 4, strtoupper($word_bl . "(" . $v['bl_number'] . ")"), 0, 0, 'R');
}

$pdf->SetX(170);
$pdf->Cell(0, 4, "$today");

$pdf->SetXY(110, 20);
$pdf->SetFont('times', 'B', 13, '', true);
$pdf->Cell(90, 4, "Bill of Lading", '', '', 'C');

$pdf->SetXY(110, 25);
$pdf->SetFont('times', '', 8, '', true);
$pdf->Cell(90, 4, "for combined transport and port to port shipment", '', '', 'C');


$pdf->SetXY(110, 59);
$pdf->SetFont('times', '', 9, '', true);
$pdf->Cell(90, 4, "ALL TERMS. CONDITIONS AND EXCEPTIONS", '', '', 'C');

$pdf->SetXY(110, 62);
$pdf->SetFont('times', '', 9, '', true);
$pdf->Cell(90, 4, "AS PER ORIGINAL BILL OF LANDING", '', '', 'C');


foreach ($data as $k => $v) {
  if ($v['bill_header'] == "CHL") {
    $imagePath = '../../lib/fpdf/logo/chlth.jpeg';
    $pdf->Image($imagePath, 130, 31, 50, 0);

    $pdf->SetXY(110, 45);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "CHINA HIGHWIN (THAILAND) LIMITED", '', '', 'C');

    $pdf->SetXY(110, 50);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "COPY", '', '', 'C');

    $pdf->SetXY(110, 55);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "NON-NEGOTIABLE", '', '', 'C');

    $pdf->SetXY(113, 240);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "CHINA HIGNWIN(THAILAND) LIMITED", '', 1, 'C');
  } else {
    $imagePath = '../../lib/fpdf/logo/th_shipping_line.png';
    $pdf->Image($imagePath, 143, 31, 25, 0);

    $pdf->SetXY(110, 45);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "TH SHIPPING CONTAINER LINE", '', '', 'C');

    $pdf->SetXY(110, 50);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "COPY", '', '', 'C');



    $pdf->SetXY(113, 240);
    $pdf->SetFont('times', 'B', 12, '', true);
    $pdf->Cell(90, 4, "TH SHIPPING CONTAINER LINE", '', 1, 'C');
  }
}

//print_r($data_description);

if ($data_description[0] != "") {
  foreach ($data_description as $k => $v) {
    $pdf->AddPage();

    $pdf->SetXY(170, 10);
    $pdf->SetFont('times', 'B', 9, '', true);
    $page_first = $pdf->PageNo();
    $pdf->Cell(50, 5, "Attached Sheet Page " . $page_first);

    $pdf->SetXY(10, 15);
    foreach ($data_shipperandconsignee as $k1 => $v1) {
      $pdf->Cell(180, 6, "ATTACHED SHEET FOR B/L NO.:" . $v1['mbl'] . " VESSEL/VOY : " . $v1['mother_vessel'], 0, 1, "C");
    }

    $pdf->SetFont('times', 'B', 9, '', true);
    $pdf->SetXY(10, 25);
    $pdf->Cell(180, 6, "DESCRIPTION OF GOODS:", 0, 1, "L");
    $get_last_y = 30;


    $pdf->SetFont('times', '', 9, '', true);
    $pdf->SetXY(10, $get_last_y);
    $pdf->MultiCell(180, 6, strtoupper($v), 0, 'L');
    $get_last_y = $pdf->GetY();

    $pdf->SetFont('times', 'B', 9, '', true);
    $page_first = $pdf->PageNo();
    $pdf->SetXY(170, 10);
    $pdf->Cell(50, 5, "Attached Sheet Page " . $page_first);


    $get_last_y = $get_last_y + 10;
    $pdf->SetXY(10, $get_last_y);
    $pdf->SetFont('times', 'B', 10, '', true);
    $pdf->Cell(190, 10, "** END OF ATTACHED SHEET **", 0, 0, 'C');
  }
}



$lines = explode("\n", $data_bl_list_kind[0]);
foreach ($lines as $line) {
  $currentLineCount++;
}


foreach ($container_data as $lineab) {
  $count_container_ab++;
}



if ($currentLineCount < 10) {
  // part description
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetXY(85, 123);
  foreach ($data_bl_list_kind as $line) {
    $pdf->MultiCell(70, 3, strtoupper($line), 0, 1);
  }
  // part container
  $pdf->Ln();
  if ($count_container_ab < 7) {
    foreach ($container_data as $v) {
      $pdf->MultiCell(100, 4, $v['container_number'] . "/" . $v['seal_number'] . "/" . $v['container_type'] . "/" . $v['quantity'] . $v['name'] . "/" . $v['gw'] . "KGS./" . $v['volume'] . "CBM", 0);
    }
  } else {
    $pdf->AddPage();
    $pdf->SetFont('times', 'B', 8, '', true);
    $pdf->SetXY(170, 10);
    $pdf->Cell(30, 3, "Attached Sheet Page 2", 0, 1, 'L');

    $pdf->SetXY(10, 15);
    foreach ($data_shipperandconsignee as $k1 => $v1) {
      $pdf->Cell(180, 6, "ATTACHED SHEET FOR B/L NO.:" . $v1['mbl'] . " VESSEL/VOY : " . $v1['mother_vessel'], 0, 1, "C");
    }

    $pdf->SetXY(10, 20);
    $pdf->Cell(10, 3, "CONTAINER/SEAL NO.:", 0, 0, "L");
    $pdf->Ln();
    $pdf->SetFont('times', '', 8, '', true);

    foreach ($container_data as $v) {
      $pdf->MultiCell(190, 4, $v['container_number'] . "/" . $v['seal_number'] . "/" . $v['container_type'] . "/" . $v['quantity'] . $v['name'] . "/" . $v['gw'] . "KGS./" . $v['volume'] . "CBM", 0);
    }
    $pdf->Ln();
    $pdf->ln(2);
    $pdf->Cell(190, 3, "** END OF ATTACHED SHEET **", 0, 0, "C");
  }
} else {
  // part container
  if ($count_container_ab < 6) { //6
    $pdf->SetFont('times', '', 8, '', true);
    $pdf->SetXY(10, 140);

    foreach ($container_data as $v) {
      $pdf->MultiCell(100, 4, $v['container_number'] . "/" . $v['seal_number'] . "/" . $v['container_type'] . "/" . $v['quantity'] . $v['name'] . "/" . $v['gw'] . "KGS./" . $v['volume'] . "CBM", 0);
    }
  }


  //part description


  $pdf->SetFont('times', '', 8, '', true);

  $pdf->SetXY(85, 123);
  $pdf->MultiCell(70, 3, "DESCRIPTION OF GOODS AS PER ATTACHED SHEET", 0, 1);

  $pdf->AddPage();
  $pdf->SetFont('times', 'B', 8, '', true);
  $pdf->SetXY(170, 10);
  $pdf->Cell(30, 3, "Attached Sheet Page 2", 0, 1, 'L');

  $pdf->SetXY(10, 15);
  foreach ($data_shipperandconsignee as $k1 => $v1) {
    $pdf->Cell(180, 6, "ATTACHED SHEET FOR B/L NO.:" . $v1['mbl'] . " VESSEL/VOY : " . $v1['mother_vessel'], 0, 1, "C");
  }

  $pdf->SetXY(10, 20);
  $pdf->Cell(10, 3, "DESCRIPTION OF GOODS : ", 0, 0, "L");

  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetXY(10, 25);
  foreach ($lines as $line) {
    $pdf->Cell(190, 3, strtoupper($line), 0, 1);
  }
  $pdf->Ln();
  $pdf->SetFont('times', 'B', 8, '', true);



  // part container
  if ($count_container_ab >= 7) {
    $pdf->Cell(10, 3, "CONTAINER/SEAL NO.: ", 0, 0, "L");
    $pdf->Ln(4);
    $pdf->SetFont('times', '', 8, '', true);
    foreach ($container_data as $v) {
      $pdf->MultiCell(100, 3, $v['container_number'] . "/" . $v['seal_number'] . "/" . $v['container_type'] . "/" . $v['quantity'] . $v['name'] . "/" . $v['gw'] . "KGS./" . $v['volume'] . "CBM", 0);
    }
  }

  $pdf->ln(2);
  $pdf->Cell(190, 3, "** END OF ATTACHED SHEET **", 0, 0, "C");
};






















$pdf->SetAutoPageBreak(false);
$pdf->Output('I', 'report.pdf');




function convertNumberToWords($number)
{
  $units = array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE");
  $tens = array("", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");
  $teens = array("TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");


  $result = "";

  $hundreds = floor($number / 100);
  $tensAndUnits = $number % 100;

  if ($hundreds > 0) {
    $result .= $units[$hundreds] . " hundred";
  }

  if ($tensAndUnits > 0) {
    if ($result != "") {
      $result .= " and ";
    }

    if ($tensAndUnits < 10) {
      $result .= $units[$tensAndUnits];
    } elseif ($tensAndUnits < 20) {
      $result .= $teens[$tensAndUnits - 10];
    } else {
      $tensDigit = floor($tensAndUnits / 10);
      $unitsDigit = $tensAndUnits % 10;
      $result .= $tens[$tensDigit];
      if ($unitsDigit > 0) {
        $result .= "-" . $units[$unitsDigit];
      }
    }
  }

  return $result;
}
