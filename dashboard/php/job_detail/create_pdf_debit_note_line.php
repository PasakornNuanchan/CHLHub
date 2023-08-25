<?php
 include '../../core/conn.php';
 
$job_number = $_GET['job_number'];
$list_request = $_GET['list_request'];
$header = $_GET['header'];
$footer = $_GET['footer'];

$sql_header = "
SELECT
    `corp_name`
FROM
    `corp_header_bill`
WHERE
    ID = '$header'
";

$result = $con->query($sql_header);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $header_data[] = $row['corp_name'];
  }
} else {
  $header_data = "0 results";
}


$sql_footer = "
SELECT
    `ID`,
    `corp_name`,
    `footer_1`,
    `footer_2`,
    `footer_3`,
    `footer_4`,
    `footer_5`,
    `footer_6`,
    `footer_7`,
    `footer_8`,
    `footer_9`,
    `footer_10`
FROM
    `corp_footer_bill`
WHERE
  ID = '$footer'
";

$result = $con->query($sql_footer);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $footer_data[] = $row;
  }
} else {
  $footer_data = "0 results";
}

$sql_data_query_list = "
SELECT
    bi.ID,
    bi.billing_description,
    bi.job_number,
    bi.bill_to_type,
    bi.bill_to,
    bi.payble,
    bi.currency,
    bi.qty,
    bi.unit_price,
    bi.amount,
    bi.vat,
    bi.amtinclvat,
    bi.remark,
    bi.type,
    bi.create_data_time,
    bi.create_by,
    bi.delete_date_time,
    bi.delete_by,
    bi.action_paid_by,
    bi.action_paid_date_time,
    bi.check_by,
    bi.check_date_time,
    bi.status,
    bi.ref_job_id,
    bi.add_on,
    bi.last_update_by,
    bi.last_update_datetime,
    bi.sys_rate,
    bi.Billing_date,
    bi.tax_with_hold_by,
    bi.commit_sale,
    bi.tax_with_hold_date_time,
    bi.currency_main,
    bi.need_vat,
    bi.refer,
    bd.billing_item_name
FROM
    `billing` bi
LEFT JOIN billing_description bd ON bi.billing_description = bd.ID
WHERE
    bi.ID IN ($list_request)
";
$result = $con->query($sql_data_query_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $query_list[] = $row;
  }
} else {
  $query_list = "0 results";
}

$sql_query_job_detail = "
SELECT
    jt.ID,
    jt.job_number,
    jt.consignee_number,
    jt.booking_number,
    jt.shipper_number,
    jt.st_number,
    jt.mbl,
    jt.hbl,
    jt.inv,
    jt.carrier_number,
    jt.port_of_receipt_number,
    jt.port_of_loading_number,
    jt.ts_port_number,
    jt.port_of_delivery_number,
    jt.mother_vessel,
    jt.voy_no_mother,
    jt.feeder_vessel,
    jt.voy_no_feeder,
    jt.etd,
    jt.eta,
    jt.clearlance_date,
    jt.delivery_date,
    jt.check_document,
    jt.enter_date,
    jt.payment_date,
    jt.pickup_DO_date,
    jt.type_import_export,
    jt.remark,
    jt.create_date,
    jt.status_job,
    jt.sale_support,
    jt.last_save_by,
    jt.booking_agent,
    jt.customs_broker,
    jt.terminal,
    jt.bill_to_type,
    jt.ref_quo,
    jt.shipping_ass,
    jt.cs_support,
    c.carrier_name,
    cn.consignee_name,
    cn.tel,
    cn.consignee_number,
    cn.fax,
    a1.location_name as location_POL,
    a1.provice as provice_POL,
    a2.location_name as location_POD,
    a2.provice as provice_POD
FROM
    job_title jt
LEFT JOIN carrier c ON jt.carrier_number = c.ID
LEFT JOIN consignee cn ON jt.consignee_number  = cn.ID
LEFT JOIN area a1 ON jt.port_of_loading_number = a1.ID
LEFT JOIN area a2 ON jt.port_of_delivery_number = a2.ID
WHERE
    jt.ID = '$job_number'
";
$result = $con->query($sql_query_job_detail);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_job_detail[] = $row;
  }
} else {
  $data_job_detail = "0 results";
}

$sql_container = "
SELECT
	COUNT(ID) as count_container_type,
    `container_type` as container_type,
    GROUP_CONCAT(container_number) as container_name
FROM
    `container`
WHERE
    ref_job_id = '$job_number'
  GROUP BY container_type
";

$result = $con->query($sql_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container_name[] = $row['container_name'];
    $data_container[] = $row;
  }
} else {
  $data_container = "0 results";
}

$container_name = implode(',',$container_name);
// $arr_merge_wait_imp = array_merge($counte_container_type, $container_type);

foreach($data_container as $k => $v){
    $container_type = isset($v['container_type']) ? $v['container_type'] : '';
    $count_container_type = isset($v['count_container_type']) ? $v['count_container_type'] : '';
    $text_container_group[] = $count_container_type." (".$container_type.")";
}
$data_container_text_imp = implode(',',$text_container_group);

require ('../../lib/fpdf/fpdf.php');
class PDF extends FPDF {
    function Header() {
        // ตัวอย่างการกำหนดข้อความในส่วนหัวของเอกสาร
        $this->SetFont('Arial', 'B', 16);
        
          // $this->Cell(0, 10, "$header_data", 0, 1, 'C');
        
        
        $this->SetLineWidth(0.4);
        // $this->Line(10, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());
        // $this->Cell(0, 10, 'DEBIT NOTE', 0, 1, 'C');
    }

    function Footer() {
        // ตัวอย่างการกำหนดข้อความในส่วนท้ายของเอกสาร
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        //$this->Cell(0, 10, 'test' . $this->PageNo(), 0, 0, 'C');
    }
}
//setting
$set_top = 7;
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
// เส้น
foreach($header_data as $k => $v){
  $pdf->Cell(0, 10, "$v", 0, 1, 'C');
}
$pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY());
$pdf->Cell(0, 10, 'DEBIT NOTE', 0, 1, 'C');

$pdf->SetFont('Arial', '', 9);


// sub head
foreach($data_job_detail as $k => $v){

    $mbl = isset($v['mbl']) ? $v['mbl'] : '';
    $eta = isset($v['eta']) ? $v['eta'] : '';
    $etd = isset($v['etd']) ? $v['etd'] : '';
    $inv = isset($v['inv']) ? $v['inv'] : '';
    $job_number_main = isset($v['job_number']) ? $v['job_number'] : '';
    $carrier_name = isset($v['carrier_name']) ? $v['carrier_name'] : '';
    
    $consignee_name = isset($v['consignee_name']) ? $v['consignee_name'] : '';
    $location_POL = isset($v['location_POL']) ? $v['location_POL'] : '';
    $provice_POL = isset($v['provice_POL']) ? $v['provice_POL'] : '';
    $location_POD = isset($v['location_POD']) ? $v['location_POD'] : '';
    $provice_POD = isset($v['provice_POD']) ? $v['provice_POD'] : '';
    // $ = isset($v['location_POL']) ? $v['location_POL'] : '';
    // $ = isset($v['location_POL']) ? $v['location_POL'] : '';
    $tel = isset($v['tel']) ? $v['tel'] : '';
    $fax = isset($v['fax']) ? $v['fax'] : '';
    $mother_vessel = isset($v['mother_vessel']) ? $v['mother_vessel'] : '';
    $consignee_number = isset($v['consignee_number']) ? $v['consignee_number'] : '';
    
    // row1
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "TO: $consignee_name", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "INV NO.: $inv", 0, 1, 'L');
    // row2
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "TEL: $tel", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "POL: $location_POL , $provice_POL", 0, 1, 'L');
    // row3
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "FAX: $fax", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "POD: $location_POD , $provice_POD", 0, 1, 'L');
    // row4
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "S/O: $consignee_number", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "CARRIER: $carrier_name", 0, 1, 'L');
    //row5
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "VOL/VYG: $mother_vessel", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "JOB NO.: $job_number_main", 0, 1, 'L');
    //row6
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, "CNTR.QTY/TYPE: $data_container_text_imp", 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "B/L No.: $mbl", 0, 1, 'L');
    //row7
    $data_get_y = $pdf->GetY();
    $pdf->SetX(10);
    $pdf->MultiCell(90, $set_top, "CNTR.NUMBER: $container_name ", 0, 'L');
    $data_get_y_last_cntr = $pdf->GetY();
    $pdf->SetXY(110,$data_get_y);
    $pdf->Cell(0, $set_top, "ETD: $etd", 0, 1, 'L');
    //row8
    $pdf->SetX(10);
    $pdf->Cell(0, $set_top, '', 0, 0, 'L');
    $pdf->SetX(110);
    $pdf->Cell(0, $set_top, "ETA: $eta", 0, 1, 'L');
}
// เส้น
$pdf->SetXY(5,$data_get_y_last_cntr);
$cellWidth = 40; // กว้างของเซลล์
$cellHeight = 8; // สูงของเซลล์
$pdf->SetFont('Arial', '', 8);
$col_first = 80;
$col_second = 30;

$pdf->Cell(80, $cellHeight, 'DESCRIPTION OF CHARGE', 'TB', 0, 'C');
$pdf->Cell(30, $cellHeight, 'QTY', 'TB', 0, 'C');
$pdf->Cell(30, $cellHeight, 'UNIT PRICE', 'TB', 0, 'C');
$pdf->Cell(30, $cellHeight, 'CURRENCY', 'TB', 0, 'C');
$pdf->Cell(30, $cellHeight, 'DEBIT', 'TB', 0, 'C');

$currency_thb = 0;
$currency_usd = 0;
$currency_rmb = 0;
$currency_yen = 0;

foreach($query_list as $k => $v){

    $billing_item_name = isset($v['billing_item_name']) ? $v['billing_item_name'] : '';
    $qty = isset($v['qty']) ? floatval($v['qty']) :'';
    $unit_price = isset($v['unit_price']) ? floatval($v['unit_price']) :'';
    $currency = isset($v['currency']) ? $v['currency'] :'';

    // echo $qty." ";
    // echo  $unit_price." ";
    $debit = floatval($qty * $unit_price);

    $qty = number_format(floatval($qty), 2);
    $unit_price = number_format(floatval($unit_price), 2);

     

    if($currency == "THB"){
        $currency_thb = $currency_thb + $debit;
    }elseif($currency == "USD"){
        $currency_usd = $currency_usd + $debit;
    }elseif($currency == "RMB"){
        $currency_rmb = $currency_rmb + $debit;
    }elseif($currency == "YEN"){
        $currency_yen = $currency_yen + $debit;
    }
    $debit = number_format(floatval($debit), 2);
    

    
//list
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(5);
$pdf->Cell($col_first, $cellHeight, "$billing_item_name", 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, "$qty", 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, "$unit_price", 0, 0, 'R');
$pdf->Cell($col_second, $cellHeight, "$currency", 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, "$debit", 0, 0, 'R');

}
$pdf->ln();
$pdf->SetX(5);
$pdf->Cell(200,4,"","T");

$currency_thb = number_format(floatval($currency_thb),2);
$currency_usd = number_format(floatval($currency_usd),2);
$currency_rmb = number_format(floatval($currency_rmb),2);
$currency_yen = number_format(floatval($currency_yen),2);

// last USD
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(5);
$pdf->Cell($col_first, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, 'Total:', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, 'USD :', 'B', 0, 'L');
$pdf->Cell($col_second, $cellHeight, "$currency_usd", 'B', 0, 'R');
// last THB
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(5);
$pdf->Cell($col_first, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, 'THB :', 'B', 0, 'L');
$pdf->Cell($col_second, $cellHeight, "$currency_thb", 'B', 0, 'R');
// last RMB
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(5);
$pdf->Cell($col_first, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, 'RMB :', 'B', 0, 'L');
$pdf->Cell($col_second, $cellHeight, "$currency_rmb",'B', 0, 'R');
// last YEN
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(5);
$pdf->Cell($col_first, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'C');
$pdf->Cell($col_second, $cellHeight, '', 0, 0, 'L');
$pdf->Cell($col_second, $cellHeight, 'YEN :', 'B', 0, 'L');
$pdf->Cell($col_second, $cellHeight, "$currency_yen", 'B', 0, 'R');


// end

foreach($footer_data as $k => $v){
  $pdf->SetFont('Arial', '', 9);
  $pdf->Ln(); // ขึ้นบรรทัดใหม่
  $pdf->SetX(10);
  $pdf->Cell(0, 4, $v['footer_1'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_2'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_3'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_4'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_5'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_6'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_7'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_8'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_9'], 0, 1, 'L');
  $pdf->Cell(0, 4, $v['footer_10'], 0, 1, 'L');
  
}


$top_signatiure = 4;
//signature
// end
$pdf->SetFont('Arial', '', 8);
$pdf->Ln(); // ขึ้นบรรทัดใหม่
$pdf->SetX(120);
$pdf->Cell(0, $top_signatiure, '__________________________________', 0, 1, 'C');
$pdf->SetX(120);
$pdf->Cell(0, $top_signatiure, 'Accepted By', 0, 1, 'C');
$pdf->SetX(120);
$pdf->Cell(0, $top_signatiure, 'Authrized Signature and Company', 0, 1, 'C');
$pdf->SetX(120);
$pdf->Cell(0, $top_signatiure, 'Chop', 0, 1, 'C');





$pdf->Output('I', 'report.pdf');
