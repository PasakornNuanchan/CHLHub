<?php

use PDF as GlobalPDF;

include '../../core/conn.php';

$job_number = $_GET['job_number'];
$task_number = $_GET['transport_number'];
$hbl = $_GET['lskdhblf'];


$sql_count_container = "
SELECT 
	jt.job_number,
    (SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.consignee_number) as consignee,
    (SELECT tb.drop_con_address FROM transport_booking tb WHERE tb.ID = '$task_number' ) as place_to_delivery,
    (SELECT tb.pick_con_address FROM transport_booking tb WHERE tb.ID = '$task_number') as place_to_pick,
    (SELECT concat(tc.Driver_name,'\n',tc.phone_number,'\n',tc.plate_number) FROM transport_contact tc WHERE tc.route_id = '$task_number') as license_plate,
    (SELECT tb.type_truck FROM transport_booking tb WHERE tb.ID = '$task_number' ) as truck_type,
    (SELECT con.container_number FROM container con WHERE con.ID = (SELECT tc.container_id FROM transport_contact tc WHERE tc.route_id = '$task_number')) as container_number,
    jt.inv,
    (SELECT ci.cargo FROM container_information ci WHERE ci.ref_job_id = jt.ID) cargo_description,
    (SELECT con.package FROM container con WHERE con.ID = (SELECT tc.container_id FROM transport_contact tc WHERE tc.route_id = '$task_number')) as container_package,
    (SELECT u.name FROM unit u WHERE u.ID = (SELECT con.unit FROM container con WHERE con.ID = (SELECT tc.container_id FROM transport_contact tc WHERE tc.route_id = '$task_number'))) as container_package_unit,
    (SELECT con.gw FROM container con WHERE con.ID = (SELECT tc.container_id FROM transport_contact tc WHERE tc.route_id = '$task_number')) as container_gw,
    (SELECT con.volume FROM container con WHERE con.ID = (SELECT tc.container_id FROM transport_contact tc WHERE tc.route_id = '$task_number')) as container_cbm,
    jt.mother_vessel,
    jt.delivery_plan
FROM 
	job_title jt
WHERE 
	jt.ID = '$job_number'
";

$result = $con->query($sql_count_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_detail[] = $row;
  }
} else {
  $data_detail = "0 results";
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


$imagePath = '../../../assets/images/icons/chllogo1.png';

// ตั้งค่าขนาดของรูปภาพ
$imageWidth = 165;
$imageHeight = 25;

$pdf->Image($imagePath, 23, 10, $imageWidth, $imageHeight);


$text_first_x = 15;
$text_second_x = 103;


$pdf->SetXY($text_first_x,35);
$pdf->Cell(180, 6, "","T");

$pdf->SetXY($text_first_x,55);
$pdf->Cell(180, 6, "","T");


//ซ้าย
$pdf->SetY(35);
for ($i = 0; $i <= 34; $i++) {
    $pdf->setX(5);
    $pdf->Cell(10, 6.31, "", 'R', 1, 'L');
}

//ซ้าย
$pdf->SetY(35);
for ($i = 0; $i <= 34; $i++) {
    $pdf->setX(185);
    $pdf->Cell(10, 6.31, "", 'R', 1, 'R');
}

$pdf->SetXY($text_first_x,63);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,76);
$pdf->Cell(88, 6,"" ,"B",0);

$pdf->SetXY(138,76);
$pdf->Cell(57, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,89);
$pdf->Cell(88, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,102);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,115);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetY(55);
for ($i = 0; $i <= 10; $i++) {
    $pdf->setX(40);
    $pdf->Cell(10, 6, "", 'R', 1, 'R');
}

$pdf->SetY(55);
for ($i = 0; $i <= 10; $i++) {
    $pdf->setX(93);
    $pdf->Cell(10, 6, "", 'R', 1, 'R');
}

$pdf->SetY(55);
for ($i = 0; $i <= 10; $i++) {
    $pdf->setX(128);
    $pdf->Cell(10, 6, "", 'R', 1, 'R');
}


$pdf->SetXY($text_first_x,122);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,137);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,150);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,163);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,183);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,203);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,211);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,224);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,237);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetXY($text_first_x,250);
$pdf->Cell(180, 6,"" ,"B",0);

$pdf->SetY(143);
for ($i = 0; $i <= 10; $i++) {
    $pdf->setX(40);
    $pdf->Cell(10, 6, "", 'R', 1, 'R');
}

$pdf->SetY(230);
for ($i = 0; $i <= 3; $i++) {
    $pdf->setX(40);
    $pdf->Cell(10, 6.5, "", 'R', 1, 'R');
}

$pdf->SetY(230);
for ($i = 0; $i <= 3; $i++) {
    $pdf->setX(93);
    $pdf->Cell(10, 6.5, "", 'R', 1, 'R');
}

$pdf->SetY(230);
for ($i = 0; $i <= 3; $i++) {
    $pdf->setX(128);
    $pdf->Cell(10, 6.5, "", 'R', 1, 'R');
}



$pdf->SetFont('THSarabunNew', '', 13, '', true);
$pdf->SetXY($text_first_x,36);
$pdf->Cell(180, 6, "CHINA HIGHWIN (THAILAND) LIMITED.","",0,"C");
$pdf->SetXY($text_first_x,42);
$pdf->Cell(180, 6, "COUNTRY COMPLEX A, 17TH FLOOR, 223/92, SANPAWUT ROAD,","",0,"C");
$pdf->SetXY($text_first_x,48);
$pdf->Cell(180, 6, "KHWENG BANGNA TAI, KHET BANGNA, BANGKOK 10260 TAX ID:0745560004379","0",1,"C");

$pdf->SetXY($text_first_x,56);
$pdf->Cell(165, 6, "Delivery Date :","",0,"L");
$pdf->SetXY($text_first_x,61);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "วัน-เดือน-ปี ที่ส่งสินค้า"),"",0,"L");

$pdf->SetXY($text_second_x,56);
$pdf->Cell(165, 6, "Job No.","",0,"L");
$pdf->SetXY($text_second_x,61);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "รหัสงาน"),"",0,"L");




$pdf->SetXY($text_first_x,69);
$pdf->Cell(165, 6, "Consignee :","",0,"L");
$pdf->SetXY($text_first_x,74);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "ลูกค้า"),"",0,"L");


$pdf->SetXY($text_second_x,75);
$pdf->Cell(35, 6, "Concat person / Tel :","",0,"C");
$pdf->SetXY($text_second_x,80);
$pdf->Cell(35, 6, "Place tp Delivery / Time","",0,"C");
$pdf->SetXY($text_second_x,85);
$pdf->Cell(35, 6, ":","",0,"C");
$pdf->SetXY($text_second_x,90);
$pdf->Cell(35, 6, iconv('UTF-8', 'TIS-620', "ผู้ติดต่อ / โทร"),"",0,"C");
$pdf->SetXY($text_second_x,95);
$pdf->Cell(35, 6, iconv('UTF-8', 'TIS-620', "สถานที่ส่งสินค้า/เวลา"),"",0,"C");


$pdf->SetXY($text_first_x,82);
$pdf->Cell(165, 6, "Type of vechicle :","",0,"L");
$pdf->SetXY($text_first_x,87);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "ประเภทของรถ"),"",0,"L");

$pdf->SetXY($text_first_x,95);
$pdf->Cell(165, 6, "Place to pick up/Time :","",0,"L");
$pdf->SetXY($text_first_x,100);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "สถานที่รับสินค้า / เวลา"),"",0,"L");

$pdf->SetXY($text_second_x,108);
$pdf->Cell(165, 6, "license plate :","",0,"L");
$pdf->SetXY($text_second_x,113);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "ทะเบียนรถ"),"",0,"L");

$pdf->SetXY($text_first_x,108);
$pdf->Cell(165, 6, "Container No :","",0,"L");
$pdf->SetXY($text_first_x,113);
$pdf->Cell(165, 6, iconv('UTF-8', 'TIS-620', "เลขตู้"),"",0,"L");

$pdf->SetFont('THSarabunNew', 'B', 20, '', true);
$pdf->SetXY($text_first_x,129);
$pdf->Cell(180, 6, "Good Description","",0,"C");
$pdf->SetXY($text_first_x,135);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "รายละเอียดสินค้า"),"",0,"C");


$pdf->SetFont('THSarabunNew', '', 13, '', true);
$pdf->SetXY($text_first_x,143);
$pdf->Cell(180, 6, "BL NO.","",0,"L");
$pdf->SetXY($text_first_x,148);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "เลขที่ใบตราส่ง"),"",0,"L");

$pdf->SetXY($text_first_x,156);
$pdf->Cell(180, 6, "Invoice No.","",0,"L");
$pdf->SetXY($text_first_x,161);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "เลขที่อินวอยซ์"),"",0,"L");

$pdf->SetXY($text_first_x,172);
$pdf->Cell(180, 6, "Item : ","",0,"L");
$pdf->SetXY($text_first_x,177);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "รายการสินค้า"),"",0,"L");

$pdf->SetXY($text_first_x,189);
$pdf->Cell(180, 6, "Number of package &","",0,"L");
$pdf->SetXY($text_first_x,193);
$pdf->Cell(180, 6, "weight","",0,"L");
$pdf->SetXY($text_first_x,198);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "จำนวนหีบห่อ และ"),"",0,"L");
$pdf->SetXY($text_first_x,203);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "น้ำหนัก"),"",0,"L");


$pdf->SetFont('THSarabunNew', 'B', 16, '', true);
$pdf->SetXY($text_first_x,217);
$pdf->Cell(180, 6, "Received complete and accurate products according to the details listed above.","",0,"C");
$pdf->SetXY($text_first_x,223);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "ได้รับสินค้าครบถ้วนถูกต้องตามรายละเอียดด้านบนนี้แล้ว"),"",0,"C");


$pdf->SetFont('THSarabunNew', '', 13, '', true);

$pdf->SetXY($text_first_x,231);
$pdf->Cell(180, 6, "Date : ","",0,"L");
$pdf->SetXY($text_first_x,236);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "วัน-เดือน-ปี"),"",0,"L");

$pdf->SetXY($text_first_x,244);
$pdf->Cell(180, 6, "Check & Received by : ","",0,"L");
$pdf->SetXY($text_first_x,249);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "ชื่อ ผู้รับสินค้า"),"",0,"L");


$pdf->SetXY($text_second_x,231);
$pdf->Cell(180, 6, "Shipping : ","",0,"L");
$pdf->SetXY($text_second_x,236);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "ผู้สั่งงาน"),"",0,"L");


$pdf->SetXY($text_second_x,244);
$pdf->Cell(180, 6, "Driver: ","",0,"L");
$pdf->SetXY($text_second_x,249);
$pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "ชื่อ ผู้ขับรถ"),"",0,"L");



// data
foreach($data_detail as $k => $v){
  $data_truck_true = '';
  if($v['truck_type'] == '1'){
    $data_truck_true = "truck";
  }else if($v['truck_type'] == '2'){
    $data_truck_true = "Box Truck 4W";
  }else if($v['truck_type'] == '3'){
    $data_truck_true = "Box Truck 4W (refrigerated truck)";
  }else if($v['truck_type'] == '4'){
    $data_truck_true = "Truck 6W";
  }else if($v['truck_type'] == '5'){
    $data_truck_true = "Truck 6W (refrigerated truck)";
  }else if($v['truck_type'] == '6'){
    $data_truck_true = "Truck 10W";
  }else if($v['truck_type'] == '7'){
    $data_truck_true = "Tractor / Trailer 2 axle";
  }else if($v['truck_type'] == '7'){
    $data_truck_true = "Tractor / Trailer 3 axle";
  }

$data_job_number = isset($v['job_number']) ? $v['job_number'] : '';
$data_consignee = isset($v['consignee']) ? $v['consignee'] : '';
$data_place_to_delivery = isset($v['place_to_delivery']) ? $v['place_to_delivery'] : '';
$data_license_plate = isset($v['license_plate']) ? $v['license_plate'] : '';
$data_inv = isset($v['inv']) ? $v['inv'] : '';
$data_cargo = isset($v['cargo_description']) ? $v['cargo_description'] : '';
$data_container_package = isset($v['container_package']) ? $v['container_package'] : '';
$data_container_package_unit = isset($v['container_package_unit']) ? $v['container_package_unit'] : '';
$data_container_gw = isset($v['container_gw']) ? $v['container_gw'] : '';
$data_container_cbm = isset($v['container_cbm']) ? $v['container_cbm'] : '';
$data_mother_vessel = isset($v['mother_vessel']) ? $v['mother_vessel'] : '';
$data_place_to_pick = isset($v['place_to_pick']) ? $v['place_to_pick'] : '';
$data_delivery_plan = isset($v['delivery_plan']) ? $v['delivery_plan'] : '';

$data_date_plan = substr($data_delivery_plan,0,10);
// data delivery date
$pdf->SetXY(50,59);
$pdf->Cell(53, 6, iconv('UTF-8', 'TIS-620', $data_date_plan),"0",0,"C");

// data job number

  $pdf->SetXY(138,59);
  $pdf->Cell(57, 6, iconv('UTF-8', 'TIS-620', $data_job_number),"0",0,"C");



// data consignee
$pdf->SetXY(50,72);
$pdf->Cell(53, 6, iconv('UTF-8', 'TIS-620', $data_consignee),"0",0,"C");

// data contact person
$pdf->SetXY(138,72);
$pdf->Cell(57, 6, iconv('UTF-8', 'TIS-620', $data_delivery_plan),"0",0,"C");

// data type of vehicle
$pdf->SetXY(50,85);
$pdf->Cell(53, 6, iconv('UTF-8', 'TIS-620', $data_truck_true),"0",0,"C");

// data place to delivery / time
$pdf->SetXY(138,83);
$pdf->MultiCell(57, 5, iconv('UTF-8', 'TIS-620', $data_place_to_delivery),0,"C");

// data place to pick up/time
$pdf->SetXY(50,95);
$pdf->MultiCell(53, 4, iconv('UTF-8', 'TIS-620', $data_place_to_pick),0,"C");

// data Container no
$pdf->SetXY(50,111);
$pdf->Cell(53, 6, iconv('UTF-8', 'TIS-620', "LCL"),"0",0,"C");

// data plate
$pdf->SetXY(138,109);
$pdf->MultiCell(57, 3.5, iconv('UTF-8', 'TIS-620', $data_license_plate),0,"C");


// data bl
$pdf->SetXY(50,146.5);
$pdf->Cell(145, 6, iconv('UTF-8', 'TIS-620', "$hbl/$data_mother_vessel"),"",0,"C");

// data invoice no
$pdf->SetXY(50,159.5);
$pdf->Cell(145, 6, iconv('UTF-8', 'TIS-620', $data_inv),"",0,"C");

// data item
$pdf->SetXY(50,170.5);
$pdf->MultiCell(145, 4, iconv('UTF-8', 'TIS-620', $data_cargo),0,"C");

// data nubmer of package&weight
$pdf->SetXY(50,196);
$pdf->Cell(145, 6, iconv('UTF-8', 'TIS-620', $data_container_package.$data_container_package_unit.'/'.$data_container_gw.'Kg/'.$data_container_cbm.'CBM'),"",0,"C");
}

//$data_container_package_unit





$pdf->SetAutoPageBreak(false);
$pdf->Output('I', 'report.pdf');

// foreach($data_detail as $k => $v){
//   $pdf->SetXY(140,30);
//   $pdf->Cell(180, 6, iconv('UTF-8', 'TIS-620', "f,dspf","1",0,"L"));
// }



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
