<?php

use PDF as GlobalPDF;

include '../../core/conn.php';

$job_number = $_GET['job_number'];

$sql_count_container = "
SELECT
	jt.job_number,
	(SELECT c.consignee_name FROM consignee c WHERE ID = jt.consignee_number) as consingee_name,
    (SELECT concat(a.location_name,' , ',a.provice) FROM area a WHERE ID = jt.port_of_loading_number) as etd_port,
    jt.etd,
    (SELECT concat(a.location_name,' , ',a.provice) FROM area a WHERE ID = jt.port_of_discharge) as eta_port,
    (SELECT coninfo.cargo FROM container_information coninfo WHERE jt.ID = coninfo.ref_job_id) as cargo_des,
    jt.eta,
    jt.inv,
    (SELECT GROUP_CONCAT(bl.hbl) FROM bl_title bl WHERE jt.ID = bl.ref_job_id) as hbl,
    (SELECT GROUP_CONCAT(con.container_number) FROM container con WHERE jt.ID = con.ref_job_id) as container_data,
    (SELECT SUM(con.quantity) FROM container con WHERE jt.ID = con.ref_job_id) as quantity,
    (SELECT GROUP_CONCAT(DISTINCT con1.container_type) FROM container con1 WHERE jt.ID = con1.ref_job_id ) as dis_type,
    (SELECT GROUP_CONCAT( con1.container_type) FROM container con1 WHERE jt.ID = con1.ref_job_id ) as type_data,
    (SELECT SUM(con.gw) FROM container con WHERE jt.ID = con.ref_job_id) as gw,
    (SELECT car.carrier_sub_name FROM carrier car WHERE ID = jt.carrier_number) as carrier,
    jt.mother_vessel,
    jt.remark
	
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

$sql_container = "
SELECT
    c.container_type
    FROM
        container c
    WHERE
        c.ref_job_id = '$job_number'
"





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




// $set_height_header = 6;
// $pdf->SetXY(10, 12);
// $pdf->SetFont('times', 'B', 8, '', true);
// $pdf->Cell(100, $set_height_header, "Shipper", 'TR', 0, 'L');
// $pdf->SetX(140);
// $pdf->Cell(60, $set_height_header, "B/L NO.", 1, 0, 'L');


// for ($i = 1; $i <= 4; $i++) {
//   $pdf->SetX(10);
//   $pdf->Cell(100, 6, "", 'R', 1, 'L');
// }

$pdf->SetY(10);
for ($i = 0; $i <= 36; $i++) {
    $pdf->setX(1);
    $pdf->Cell(10, 6, "", 'R', 1, 'L');
}

$pdf->setY(10);
for ($i = 0; $i <= 36; $i++) {
    $pdf->SetX(40);
    $pdf->Cell(10, 6, "", 'R', 1, 'L');
}

$pdf->setY(10);
for ($i = 0; $i <= 36; $i++) {
    $pdf->SetX(190);
    $pdf->Cell(10, 6, "", 'R', 1, 'L');
}
//ล่าง
$pdf->setXY(11,226);
$pdf->Cell(189,6,"",'B');

// ขวา
$pdf->setXY(11,10);
$pdf->Cell(189,6,"",'T');

$pdf->SetXY(11,20);
$pdf->Cell(189,6,"",'T');

$pdf->SetXY(11,24);
$pdf->Cell(134,6,"",'B');

$pdf->SetXY(11,34);
$pdf->Cell(134,6,"",'B');

$pdf->SetXY(145,24);
$pdf->Cell(55,6,"",'B');

$pdf->SetXY(11,44);
$pdf->Cell(134,6,"",'B');

$pdf->SetXY(11,54);
$pdf->Cell(134,6,"",'B');

$pdf->SetXY(11,64);
$pdf->Cell(134,6,"",'B');

$pdf->SetXY(11,74);
$pdf->Cell(189,6,"",'B');

$pdf->SetXY(11,84);
$pdf->Cell(189,6,"",'B');

$pdf->SetXY(11,94);
$pdf->Cell(189,6,"",'B');



$pdf->SetXY(50,114);
$pdf->Cell(150,6,"",'B');


$pdf->setY(120);
for ($i = 0; $i <= 6; $i++) {
    $pdf->SetX(86);
    $pdf->Cell(10, 5.8, "", 'R', 1, 'L');
}






//เส้นใต้ cntr no.
$pdf->SetXY(11,124);
$pdf->Cell(189,6,"",'B');

$pdf->SetXY(11,134);
$pdf->Cell(189,6,"",'B');

$pdf->SetXY(11,144);
$pdf->Cell(189,6,"",'B');

$pdf->SetXY(50,154);
$pdf->Cell(150,6,"",'B');

$pdf->SetXY(50,164);
$pdf->Cell(150,6,"",'B');


$pdf->setY(160);
for ($i = 0; $i <= 10; $i++) {
    $pdf->SetX(86);
    $pdf->Cell(10, 6.5, "", 'R', 1, 'L');
}


$pdf->setY(120.1);
for ($i = 0; $i <= 7; $i++) {
    $pdf->SetX(135);
    $pdf->Cell(10, 6.2, "", 'R', 1, 'L');
}


$pdf->SetXY(50,174);
$pdf->Cell(150,6,"",'B');

$pdf->SetXY(50,184);
$pdf->Cell(46,6,"",'B');

$pdf->SetXY(50,194);
$pdf->Cell(46,6,"",'B');

$pdf->SetXY(50,204);
$pdf->Cell(46,6,"",'B');

$pdf->SetXY(50,214);
$pdf->Cell(46,6,"",'B');


// $pdf->setY(20);
// for ($i = 0; $i <= 9; $i++) {
//     $pdf->SetX(86);
//     $pdf->Cell(10, 6, "", 'R', 1, 'L');
// }

$pdf->setY(10);
for ($i = 0; $i <= 9; $i++) {
    $pdf->SetX(135);
    $pdf->Cell(10, 7, "", 'R', 1, 'L');
}



$pdf->setXY(12,12);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"JOB CONTROL",0);


$pdf->setXY(145,12);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ENTRY REF.",0);

$pdf->setXY(12,22);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"JOB NO.",0);

$pdf->setXY(145,22);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ENTRY NO.",0);

$pdf->setXY(12,12);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"JOB CONTROL",0);

$pdf->setXY(12,32);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"CONSIGNEE.",0);

$pdf->setXY(12,42);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ETD PORT",0);

$pdf->setXY(12,52);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ETD",0);

$pdf->setXY(12,62);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ETA PORT",0);

$pdf->setXY(12,72);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ETA",0);

$pdf->setXY(12,82);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"INVOICE NO.",0);

$pdf->setXY(12,92);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"BL No.",0);

$pdf->setXY(12,112);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"CNTR NO.",0);


$pdf->setXY(12,132);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"CNTR TYPE",0);

$pdf->setXY(12,142);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"AGENT",0);

$pdf->setXY(12,152);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"VESSLE NAME",0);
$pdf->setXY(12,162);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"PERSON PIC",0);
$pdf->setXY(12,172);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"CLEAR DATE",0);
$pdf->setXY(12,182);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"DELIVERY DATE",0);
$pdf->setXY(12,192);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ENTER DATE",0);
$pdf->setXY(12,202);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"D/O RELEASE",0);
$pdf->setXY(12,212);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"ATA",0);
$pdf->setXY(12,222);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(40,6,"PORT",0);




//  BOI BO.
$pdf->setXY(96,132);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(49,6,"BOI NO.",0,0,"L");

// DOA NO.
$pdf->setXY(96,142);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(49,6,"DOA NO.",0,0,"L");

// REMARK
$pdf->setXY(96,172);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(104,6,"REMARK",0,0,"C");





// data job control
foreach($data_detail as $k => $v){


$pdf->setXY(50,12);
$pdf->SetFont('THSarabunNew', 'B', 26, '', true);
$pdf->Cell(95,6,strtoupper($v['consingee_name']),0,0,"C");

// data job No.
$pdf->setXY(50,22);
$pdf->SetFont('THSarabunNew', 'B', 26, '', true);
$pdf->Cell(95,6,strtoupper($v['job_number']),0,0,"C");

// data consignee.
$pdf->setXY(50,32);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['consingee_name']),0,1,"C");

// data cargo desceiption
$pdf->setXY(145,30);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->MultiCell(55,6,strtoupper($v['cargo_des']),0,"C",false);

// data ETD PORT.
$pdf->setXY(50,42);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['etd_port']),0,0,"C");

// data ETD .
$pdf->setXY(50,52);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['etd']),0,0,"C");

// data ETA PORT.
$pdf->setXY(50,62);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['eta_port']),0,0,"C");

// data ETA .
$pdf->setXY(50,72);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['eta']),0,0,"C");

// data INVOICE .
$pdf->setXY(50,82);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(150,6,strtoupper($v['inv']),0,0,"L");

// data BL no.
$pdf->setXY(50,92);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(150,6,strtoupper($v['hbl']),0,0,"L");

// data CNTR NO. line 1
$pdf->setXY(50,122);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(46,6,strtoupper($v['quantity']." Package"),0,0,"C");

// data CNTR NO. line 2 first
$pdf->setXY(50,102);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->MultiCell(150,6,strtoupper($v['container_data']),0,"L");

// data CNTR NO. line 2 last
$pdf->setXY(96,122);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(49,6,strtoupper($v['gw']." KGS"),0,0,"C");


// data agent.first
$pdf->setXY(50,142);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(46,6,strtoupper($v['carrier']),0,0,"L");

// data agent.first
$pdf->setXY(50,152);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->Cell(95,6,strtoupper($v['mother_vessel']),0,0,"L");

// data remark
$pdf->setXY(96,182);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->MultiCell(104,6,strtoupper($v['remark']),0,"L");

}



$data_detail_container = explode(" ",$data_detail['type_data']);
print_r($data_detail_container);
// foreach($data_detail as $k => $v){
//     print_r($v['type_data']);
// }

// foreach($data_detail as $k => $v){
    
    


// // data CNTR type.first
// $pdf->setXY(50,132);
// $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
// $pdf->Cell(46,6,"fdslp[flps[dl[fpsd]]]",0,0,"L");


// }









$pdf->setXY(10,232);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "รับ shipping doc ดราฟ"),0,0,"L");

$pdf->setXY(110,232);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "ยิงใบขน"),0,0,"L");

$pdf->setXY(10,237);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "คอนเฟริ์ม shipping doc"),0,0,"L");

$pdf->setXY(110,237);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "รับค่าใช้จ่ายแลก DO"),0,0,"L");

$pdf->setXY(10,242);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "รับ shipping doc ตัวจริงทางไปรษณีย์"),0,0,"L");

$pdf->setXY(110,242);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "เบิกค่าใช้จ่ายแลกDOในระบบ+Excel"),0,0,"L");

$pdf->setXY(10,247);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "Enter"),0,0,"L");

$pdf->setXY(110,247);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "แลก DO"),0,0,"L");

$pdf->setXY(10,252);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "ดราฟใบขน"),0,0,"L");

$pdf->setXY(110,252);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "จัดชุดงานเคลียร์"),0,0,"L");

$pdf->setXY(10,257);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "คอนเฟิร์มใบขน"),0,0,"L");

$pdf->setXY(110,257);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "Customs clear"),0,0,"L");

$pdf->setXY(110,262);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "ส่งของ"),0,0,"L");

$pdf->setXY(110,267);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(104,6,iconv('UTF-8', 'TIS-620', "ส่งชุดงานให้ลูกค้า"),0,0,"L");







$pdf->setXY(70,233);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,233);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(70,238);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,238);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(70,243);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,243);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(70,248);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,248);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(70,253);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,253);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(70,258);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,258);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,263);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");

$pdf->setXY(160,268);
$pdf->SetFont('THSarabunNew', '', 12, '', true);
$pdf->Cell(4,4,"",1,0,"L");









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
