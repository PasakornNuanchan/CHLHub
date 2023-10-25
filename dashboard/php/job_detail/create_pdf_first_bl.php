<?php

//use PDF as GlobalPDF;

include '../../core/conn.php';

$job_number = $_GET['job_number'];
$bl_number = $_GET['bl_number_main'];
//query
$sql_query_shipper = "
SELECT
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
    jt.mother_vessel
FROM
    job_title jt
LEFT JOIN shipper s ON jt.shipper_number = s.ID
LEFT JOIN consignee c ON jt.consignee_number = c.ID
LEFT JOIN area a1 ON jt.port_of_receipt_number = a1.ID
LEFT JOIN area a2 ON jt.port_of_loading_number = a2.ID
LEFT JOIN area a3 ON jt.ts_port_number = a3.ID
LEFT JOIN area a4 ON jt.port_of_delivery_number = a4.ID
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
  `ID`,
  `ref_job_id`,
  `hbl`,
  `notify_party`,
  `pre_carriage`,
  `bill_header`,
  `delivery_agent`,
  `shipper_on_board`,
  `bl_number`,
  `shipper_bl`,
  `consignee_bl`,
  `description_of_good`,
  `on_board_date`,
  `final_destination`,
  `place`
FROM
    `bl_title`
WHERE
    ID = '$bl_number'
";

$result = $con->query($sql_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $data_bl_number[] = $row['bl_number'];
    $data_notify[] = $row['notify_party'];
    $data_delivery_agent[] = $row['delivery_agent'];
  }
} else {
  $data = "0 results";
}

$sql_query_bl_list = "
SELECT * FROM `bl_list` WHERE bl_title_id = '$bl_number'
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

$sql_container_bl_list = "
SELECT 

*
 FROM container WHERE ref_job_id = '$job_number'";
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
// $pdf->SetXY(20,12);
// $pdf->SetFont('times', 'B', 8, '', true);
// $pdf->Cell(100, $set_height_header, "Shipper", '', 0, 'L');
// $pdf->SetX(140);
// $pdf->Cell(60, $set_height_header, "B/L NO.", '', 0, 'L');

// foreach($data as $k => $v){
//   $pdf->SetFont('times', '', 8, '', true);
//   $pdf->SetXY(20,17);
//   $pdf->MultiCell(100, 3, strtoupper($v['shipper_bl']), '', 0);
// }

foreach($data as $k => $v){
  $pdf->SetFont('times', '', 8, '', true);
  $pdf->SetXY(140,17);
  $pdf->MultiCell(60, 3, $v['hbl'], '', 0);
}

foreach($data as $k => $v){
  $pdf->SetXY(20,40);
  $pdf->MultiCell(100,3,strtoupper($v['consignee_bl']),'',"L");
}

foreach($data_notify as $k => $v){
  $pdf->SetXY(20,60);
  $pdf->MultiCell(100,3,strtoupper($v),0,"L");
}
$pdf->Ln();
$pdf->Ln();

foreach($data_delivery_agent as $k => $v){
  $pdf->SetX(120);
  $pdf->MultiCell(100,3,strtoupper($v),0,"L");
}


foreach($data_shipperandconsignee as $k => $v ){
  $pdf->SetX(20);
  $pdf->Cell(100,3,strtoupper($v['feeder_vessel']),0,0,'L');
}

foreach($data_shipperandconsignee as $k => $v){
  
  $pdf->SetX(65);
  $pdf->Cell(50,3,strtoupper($v['a1location'].",".$v['a1provice']),0,0,'L');
}

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

foreach($data_shipperandconsignee as $k => $v){
  $pdf->SetX(20);
  $pdf->Cell(50,3,strtoupper($v['mother_vessel']),0,0,'L');
  $pdf->SetX(65);
  $pdf->Cell(50,3,$v['a2location'].",".$v['a2provice'],0,0,'L');
}


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


foreach($data_shipperandconsignee as $k => $v){
  $pdf->SetX(20);
  $pdf->Cell(100,3,strtoupper($v['a3location'].",".$v['a3provice']),0,0,'L');
  $pdf->SetX(65);
  $pdf->Cell(100,3,strtoupper($v['a4location'].",".$v['a4provice']),0,0,'L');
}

foreach($data as $k => $v){
  $pdf->SetXY(120, 108);
  $pdf->MultiCell(90, 3, strtoupper($v['final_destination']), '', "L");
}

$data_last_y_get = 128;
foreach($data_bl_list as $k => $v){
  $data_last_y_get;

  $pdf->SetXY(20,$data_last_y_get);
  $pdf->MultiCell(45,4,strtoupper($v['container_no']),0,'L');
  $data_last_container = $pdf->GetY();

  $pdf->SetXY(65,$data_last_y_get);
  $pdf->Cell(35,4,strtoupper($v['package'])." ".strtoupper($v['package_unit']),0,0,'C');

  $pdf->SetXY(155,$data_last_y_get);
  $pdf->Cell(20,4,strtoupper($v['gross_weight'])." ".strtoupper($v['gross_weight_unit']),0,0,'C');

  $pdf->SetXY(175,$data_last_y_get);
  $pdf->Cell(20,4,strtoupper($v['measurement'])." ".strtoupper($v['cbm_unit']),0,0,'C');

  $pdf->SetXY(100,$data_last_y_get);
  $pdf->MultiCell(55,4,strtoupper($v['kind_of_package']),0,'L');
  $data_last_y_get =$pdf->GetY();


  if($data_last_container > $data_last_y_get){
    $data_last_y_get = $data_last_container;
  }
  // $pdf->MultiCell(55,6,$data_last_y_get,1,'L');
  // $pdf->MultiCell(55,6,$data_last_container,1,'L');
}


$data_last_y_get = $data_last_y_get+5;
$pdf->SetXY(20,$data_last_y_get);





foreach($container_data as $k => $v){
  $pdf->SetX(25);
  $pdf->Cell(150,4,strtoupper($v['container_number']."/".$v['seal_number']."/".$v['container_type']."/".$v['quantity'].$v['unit']."/".$v['gw'].".KGS/".$v['cbm']."CBM"),0,1,'L');
}

$today = date("Y/m/d");

$pdf->SetXY(160,172);
// $data_y = $pdf->GetY();
// echo $data_y;
$pdf->Cell(40,4,"SHIPPED ON BOARD:",0,1);
$pdf->SetX(160);
$pdf->Cell(40,4,strtoupper($today),0,1);


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$all_context = "";
$count_id_total = 0;

foreach($count_container as $k => $v){
$container_type = isset($v['container_type']) ? $v['container_type'] : '';
$count_id = isset($v['count_id']) ? $v['count_id'] : '';

$count_id_total = $count_id_total + $count_id;
$text_data = "($count_id"."X"."$container_type) ";
$all_context = $all_context.$text_data;
}

$all_context = strtoupper($all_context." CONTAINER(S) ONLY");
$words = convertNumberToWords($count_id_total);

$pdf->SetXY(52,195);

$pdf->Cell(150,4,strtoupper("TOTAL : $words $all_context"));


$pdf->SetXY(15,232);
$pdf->Cell(30,4,"FREIGHT COLLECT");






$pdf->SetY(272);

$pdf->SetX(145);
$pdf->Cell(0,4,"Bangkok");
foreach($data as $k =>$v){
  $word_bl = convertNumberToWords($v['bl_number']);
  
  $pdf->SetX(90);
  $pdf->Cell(20,4,strtoupper($word_bl."(".$v['bl_number'].")"),0,0,'R');
}


$pdf->SetX(170);
$pdf->Cell(0,4,"$today");








$pdf->SetAutoPageBreak(false); 
$pdf->Output('I', 'report.pdf');




function convertNumberToWords($number) {
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



