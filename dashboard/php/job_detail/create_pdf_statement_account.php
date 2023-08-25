<?php
include '../../core/conn.php';
//require '../../core/con_path.php';

// $job_number = $_GET['job_number'];
// $list_request = $_GET['list_request'];
// $header = $_GET['header'];
// $footer = $_GET['footer'];
// $due = $_GET['due'];
// $date_data = date("Y-m-d");
// $currency = $_GET['currency'];

// $sql_data_query_list = "
// SELECT
//     bi.ID,
//     bi.billing_description,
//     bi.job_number,
//     bi.bill_to_type,
//     bi.bill_to,
//     bi.payble,
//     bi.currency,
//     bi.qty,
//     bi.unit_price,
//     bi.amount,
//     bi.vat,
//     bi.amtinclvat,
//     bi.remark,
//     bi.type,
//     bi.create_data_time,
//     bi.create_by,
//     bi.delete_date_time,
//     bi.delete_by,
//     bi.action_paid_by,
//     bi.action_paid_date_time,
//     bi.check_by,
//     bi.check_date_time,
//     bi.status,
//     bi.ref_job_id,
//     bi.add_on,
//     bi.last_update_by,
//     bi.last_update_datetime,
//     bi.sys_rate,
//     bi.Billing_date,
//     bi.tax_with_hold_by,
//     bi.commit_sale,
//     bi.tax_with_hold_date_time,
//     bi.with_holding_tax,
//     bi.currency_main,
//     bi.need_vat,
//     bi.refer,
//     bd.billing_item_name
// FROM
//     `billing` bi
// LEFT JOIN billing_description bd ON bi.billing_description = bd.ID
// WHERE
//     bi.ID IN ($list_request)
// ";
// $result = $con->query($sql_data_query_list);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $query_list[] = $row;
//   }
// } else {
//   $query_list = "0 results";
// }

// $sql_query_job_detail = "
// SELECT
//     jt.ID,
//     jt.job_number,
//     jt.consignee_number,
//     jt.booking_number,
//     jt.shipper_number,
//     jt.st_number,
//     jt.mbl,
//     jt.hbl,
//     jt.inv,
//     jt.carrier_number,
//     jt.port_of_receipt_number,
//     jt.port_of_loading_number,
//     jt.ts_port_number,
//     jt.port_of_delivery_number,
//     jt.mother_vessel,
//     jt.voy_no_mother,
//     jt.feeder_vessel,
//     jt.voy_no_feeder,
//     jt.etd,
//     jt.eta,
//     jt.clearlance_date,
//     jt.delivery_date,
//     jt.check_document,
//     jt.enter_date,
//     jt.payment_date,
//     jt.pickup_DO_date,
//     jt.type_import_export,
//     jt.remark,
//     jt.create_date,
//     jt.status_job,
//     jt.sale_support,
//     jt.last_save_by,
//     jt.booking_agent,
//     jt.customs_broker,
//     jt.terminal,
//     jt.bill_to_type,
//     jt.ref_quo,
//     jt.shipping_ass,
//     jt.cs_support,
//     jt.commodity,
//     jt.delivery_place,
//     jt.do_number,
//     jt.currency_main,
//     c.carrier_name,
//     cn.consignee_name,
//     cn.address,
//     cn.tax,
//     a1.location_name as location_POL,
//     a1.provice as provice_POL,
//     a2.location_name as location_POD,
//     a2.provice as provice_POD,
//     (SELECT SUM(gw) FROM container WHERE ref_job_id = '$job_number') as Grossweight,
//     (SELECT SUM(single_cnt) FROM container WHERE ref_job_id = '$job_number') as single_cnt_all,
//     (SELECT SUM(package) FROM container WHERE ref_job_id = '$job_number') as package_all,
//     (SELECT GROUP_CONCAT(container_number) FROM container WHERE ref_job_id = '$job_number') as container_all
// FROM
//     job_title jt
// LEFT JOIN carrier c ON jt.carrier_number = c.ID
// LEFT JOIN consignee cn ON jt.consignee_number  = cn.ID
// LEFT JOIN area a1 ON jt.port_of_loading_number = a1.ID
// LEFT JOIN area a2 ON jt.port_of_delivery_number = a2.ID

// WHERE
//     jt.ID = '$job_number'
// ";
// $result = $con->query($sql_query_job_detail);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $data_job_detail[] = $row;
//   }
// } else {
//   $data_job_detail = "0 results";
// }

// $sql_container = "
// SELECT
// 	COUNT(ID) as count_container_type,
//     `container_type` as container_type,
//     GROUP_CONCAT(container_number) as container_name
// FROM
//     `container`
// WHERE
//     ref_job_id = '$job_number'
//   GROUP BY container_type
// ";

// $result = $con->query($sql_container);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $container_name[] = $row['container_name'];
//     $data_container[] = $row;
//   }
// } else {
//   $data_container = "0 results";
// }

// $container_name = implode(',',$container_name);


// foreach($data_container as $k => $v){
//     $container_type = isset($v['container_type']) ? $v['container_type'] : '';
//     $count_container_type = isset($v['count_container_type']) ? $v['count_container_type'] : '';
//     $text_container_group[] = $count_container_type." (".$container_type.")";
// }
// $data_container_text_imp = implode(',',$text_container_group);
// $sql_container = "
// SELECT
// 	COUNT(ID) as count_container_type,
//     `container_type` as container_type,
//     GROUP_CONCAT(container_number) as container_name
// FROM
//     `container`
// WHERE
//     ref_job_id = '$job_number'
//   GROUP BY container_type
// ";

// $result = $con->query($sql_container);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $data_container[] = $row;
//   }
// } else {
//   $data_container = "0 results";
// }

// foreach($data_container as $k => $v){
//   $container_type = isset($v['container_type']) ? $v['container_type'] : '';
//   $count_container_type = isset($v['count_container_type']) ? $v['count_container_type'] : '';
//   $text_container_group[] = $count_container_type."*".$container_type."";
// }
// $data_container_text_imp = implode(', ',$text_container_group);


// $sql_bill_header = "
// SELECT
//     *
// FROM
//     `corp_header_bill`
// WHERE
//     ID = '$header'
// ";

// $sql_bill_footer = "
// SELECT
//     *
// FROM
//     `corp_footer_bill`
// WHERE
//     ID ='$footer'
// ";

// $result = $con->query($sql_bill_header);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $header_data[] = $row;
//   }
// } else {
//   $header_data = "0 results";
// }

// $result = $con->query($sql_bill_footer);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $footer_data[] = $row;
//   }
// } else {
//   $footer_data = "0 results";
// }

require('../../lib/fpdf/fpdf.php');
class PDF extends FPDF
{
  function Header()
  {

    $this->SetFont('Arial', 'B', 16);
    //$this->Cell(0, 10, 'INVOICE_test', 0, 1, 'C');
  }

  function Footer()
  {

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    //$this->Cell(0, 10, 'test' . $this->PageNo(), 0, 0, 'C');
  }
}
//setting
$set_top = 7;
$pdf = new PDF();
$pdf->AddPage();


// sub head

$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew_b.php');
$pdf->AddFont('THSarabunNew', 'BI', 'THSarabunNew_bi.php');
$pdf->AddFont('THSarabunNew', 'I', 'THSarabunNew_i.php');

$pdf->SetFont('THSarabunNew', 'B', 20, '', true);
$pdf->Cell(0, 10, "CHINA HIGHWIN LTD.", 0, 0, 'C');
$pdf->Ln();


$pdf->SetLineWidth(0.4); 
$pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY());
$pdf->Ln();

$pdf->SetFont('THSarabunNew', 'B', 20, '', true);
$pdf->Cell(0, 10, "STATEMENT OF ACCOUNT", 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('THSarabunNew', '', 16, '', true);
$pdf->Cell(0, 10, "To :", 0, 0, 'L');
$pdf->SetX(140);
$pdf->Cell(0, 10, "Date : 20/12/2023", 0, 0, 'R');

$height_table = 6;
$height_table_head = 5;
$small_col = 24;
$description_col = 70;


$pdf->Ln();
$pdf->SetFillColor(184, 181, 245);
$pdf->SetFont('THSarabunNew', 'B', 14, '', true);
$pdf->SetX(5);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(10, $height_table_head, "No.", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Job no:", '1', 0,'C', true);
$pdf->Cell(30, $height_table_head, "BL no.", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Count no.", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Count qty", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Delivery", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Goods", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Rate", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Extra", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Total amount", '1', 0, 'C', true);
$pdf->Cell(20, $height_table_head, "Remark", '1', 0, 'C', true);
$pdf->Ln();

$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(5);
$pdf->Cell(10, $height_table_head, "1", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "2022010001", '1', 0,'C');
$pdf->Cell(30, $height_table_head, "BLTEST1234", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Count no.", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Count qty", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Delivery", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Goods", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Rate", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Extra", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Total amount", '1', 0, 'C');
$pdf->Cell(20, $height_table_head, "Remark", '1', 0, 'C');



//$pdf->SetX(140);
// $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
// $pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', "(ไม่ใช่ใบกำกับภาษี)"), 0, 1, 'R');

// foreach ($header_data as $k => $v) {
//   $corp_name = isset($v['corp_name']) ? $v['corp_name'] : '';
//   $header_1 = isset($v['header_1']) ? $v['header_1'] : '';
//   $header_2 = isset($v['header_2']) ? $v['header_2'] : '';
//   $header_3 = isset($v['header_3']) ? $v['header_3'] : '';
//   $header_4 = isset($v['header_4']) ? $v['header_4'] : '';
//   $header_5 = isset($v['header_5']) ? $v['header_5'] : '';



//   $pdf->SetFont('THSarabunNew', 'B', 16, '', true);
//   if ($corp_name != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top, "$corp_name", 0, 0, 'L');
//     $pdf->SetX(140);
//     $pdf->Cell(0, $set_top, iconv('UTF-8', 'TIS-620', "INVOICE/ใบแจ้งหนี้"), 0, 1, 'R');
//   }

//   $set_top_detail = 4;


//   if ($header_1 != '') {

//     $pdf->SetFont('Arial', '', 8, '', true);
//     $pdf->SetFont('THSarabunNew', '', 14, '', true);
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$header_1", 0, 1, 'L');
//   }

//   if ($header_2 != '') {
//     $pdf->SetFont('Arial', '', 8, '', true);
//     $pdf->SetFont('THSarabunNew', '', 14, '', true);
//     $pdf->Cell(0, $set_top_detail, "$header_2", 0, 0, 'L');
//     $pdf->SetX(140);
//     $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
//     $pdf->Cell(0, $set_top_detail, iconv('UTF-8', 'TIS-620', "(ไม่ใช่ใบกำกับภาษี)"), 0, 1, 'R');
//   }




//   if ($header_3 != '') {
//     $pdf->SetFont('THSarabunNew', '', 14, '', true);
//     $pdf->Cell(0, $set_top_detail, "$header_3", 0, 1, 'L');
//   }

//   if ($header_4 != '') {
//     $pdf->SetFont('THSarabunNew', '', 14, '', true);
//     $pdf->Cell(0, $set_top_detail, "$header_4", 0, 0, 'L');
//   }

//   if ($header_5 != '') {
//     $pdf->SetX(140);
//     $pdf->SetTextColor(237, 21, 21);
//     $pdf->Cell(0, $set_top_detail, iconv('UTF-8', 'TIS-620', "(ต้นฉบับ)"), 0, 1, 'R');
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Cell(0, $set_top_detail, "$header_5", 0, 0, 'L');
//     $pdf->SetX(140);
//     $pdf->SetTextColor(237, 21, 21);
//     $pdf->Cell(0, $set_top_detail, "(Original)", 0, 1, 'R',);
//     $pdf->Ln(); 
//   }

  






// }





// $pdf->SetTextColor(0, 0, 0);

// //tab head
// foreach ($data_job_detail as $k => $v) {

//   $consignee_name = isset($v['consignee_name']) ? $v['consignee_name'] : '';
//   $job_number = isset($v['job_number']) ? $v['job_number'] : '';
//   $inv = isset($v['inv']) ? $v['inv'] : '';
//   $address = isset($v['address']) ? $v['address'] : '';
//   $location_POL = isset($v['location_POL']) ? $v['location_POL'] : '';
//   $provice_POL = isset($v['provice_POL']) ? $v['provice_POL'] : '';
//   $location_POD = isset($v['location_POD']) ? $v['location_POD'] : '';
//   $provice_POD = isset($v['provice_POD']) ? $v['provice_POD'] : '';
//   $mbl = isset($v['mbl']) ? $v['mbl'] : '';
//   $tax = isset($v['tax']) ? $v['tax'] : '';
//   $etd = isset($v['etd']) ? $v['etd'] : '';
//   $eta = isset($v['eta']) ? $v['eta'] : '';
//   $grossweight = isset($v['Grossweight']) ? $v['Grossweight'] : '';
//   $container_all = isset($v['container_all']) ? $v['container_all'] : '';
//   $mother_vessel = isset($v['mother_vessel']) ? $v['mother_vessel'] : '';
//   $volume_sum = isset($v['volume_sum']) ? $v['volume_sum'] : '';
//   $package_all = isset($v['package_all']) ? $v['package_all'] : '';
//   $commodity = isset($v['commodity']) ? $v['commodity'] : '';
//   $delivery_place = isset($v['delivery_place']) ? $v['delivery_place'] : '';
//   $single_cnt_all = isset($v['single_cnt_all']) ? $v['single_cnt_all'] : '';
//   $do_number = isset($v['do_number']) ? $v['do_number'] : '';
//   $grossweight = $grossweight - $single_cnt_all;
//   $currency_main = isset($v['currency_main']) ? $v['currency_main'] : '';


//   $pdf->setX(5);
//   $pdf->SetFillColor(184, 181, 245);
//   $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
//   $pdf->Cell(200, 6, "Customer Detail", 1, 0, 'C', true);
//   $pdf->Ln();

//   $pdf->SetFillColor(0, 0, 0);
//   $pdf->SetFont('THSarabunNew', '', 14, '', true);

//   // detail head
//   $pdf->Cell(40, $set_top_detail, "Customer Name : $consignee_name", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Job No.: $job_number", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Invoice No.: $job_number", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Address: $address", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Invoice Date: $date_data", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Due Date : $due", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Currency : $currency_main", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Tax ID : $tax", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Customer inv:", 0);
//   $pdf->Cell(40, 5, "", 0);
//   $pdf->Ln();


//   //head shipment detail

//   $pdf->SetFillColor(184, 181, 245);
//   $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
//   $pdf->setX(5);
//   $pdf->Cell(200, 6, "Shipment Details", 1, 0, 'C', true);
//   $pdf->Ln();
//   $pdf->SetFillColor(0, 0, 0);
//   $pdf->SetFont('THSarabunNew', '', 14, '', true);

//   //detail shipment detail

//   $pdf->Cell(40, $set_top_detail, "POL/POD: $location_POL, $provice_POL / $location_POD, $provice_POD", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "B/L: $mbl", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Commodity: $commodity", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Volume : $data_container_text_imp", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Vessel/Flight : $mother_vessel ", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Quantity: $package_all Package", 0);
//   $pdf->Ln();
  
//   $pdf->Cell(40, $set_top_detail, iconv('UTF-8','TIS-620',"Import Entry No.: $do_number"), 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "Weight : $grossweight KGS", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Container No. : $container_all", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "ETD : $etd", 0);
//   $pdf->Ln();

//   $pdf->Cell(40, $set_top_detail, "Delivery place: $delivery_place", 0);
//   $pdf->SetX(110);
//   $pdf->Cell(40, $set_top_detail, "ETA : $eta", 0);
//   $pdf->Cell(40, 5, "", 0);
// }

// //table

// $height_table = 6;
// $height_table_head = 5;
// $small_col = 24;
// $description_col = 70;
// $pdf->Ln();
// $pdf->SetFillColor(184, 181, 245);
// $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
// $pdf->SetX(5);
// $pdf->SetDrawColor(0, 0, 0);
// $pdf->Cell(10, $height_table_head, "No.", 'LT', 0, 'C', true);
// $pdf->Cell($description_col, $height_table_head, "Description:", 'T', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, "Unit Price", 'T', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, "Quantity", 'T', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, "Unit", 'T', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, "Vat", 'T', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, "Total", 'TR', 0, 'C', true);
// $pdf->Ln();
// $pdf->SetX(5);
// $pdf->SetFont('THSarabunNew', '', 12, '', true);
// $pdf->SetDrawColor(0, 0, 0);
// $pdf->Cell(10, $height_table_head, iconv('UTF-8', 'TIS-620', "ลำดับที่"), 'L', 0, 'C', true);
// $pdf->Cell($description_col, $height_table_head, iconv('UTF-8', 'TIS-620', "รายการ:"), 'B', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, iconv('UTF-8', 'TIS-620', "ราคา"), 'B', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, iconv('UTF-8', 'TIS-620', "จำนวน"), 'B', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, iconv('UTF-8', 'TIS-620', "หน่วย"), 'B', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, iconv('UTF-8', 'TIS-620', "7%"), 'B', 0, 'C', true);
// $pdf->Cell($small_col, $height_table_head, iconv('UTF-8', 'TIS-620', "รวม"), 'R', 0, 'C', true);
// $pdf->Ln();




// $main_total = 0;
// $main_sub_non_vat_total = 0;
// $main_sub_total = 0;

// $gross_with_tax_1 = 0;
// $gross_with_tax_3 = 0;
// $gross_with_tax_7 = 0;


// foreach ($query_list as $k => $v) {

//   $billing_item_name = isset($v['billing_item_name']) ? $v['billing_item_name'] : '';
//   $qty = isset($v['qty']) ? floatval($v['qty']) : '';
//   $unit_price = isset($v['unit_price']) ? floatval($v['unit_price']) : '';
//   $currency = isset($v['currency']) ? $v['currency'] : '';
//   $vat = isset($v['vat']) ? $v['vat'] : '';
//   $sys_rate = isset($v['sys_rate']) ? $v['sys_rate'] : '';
//   $with_holding_tax = isset($v['with_holding_tax']) ? $v['with_holding_tax'] : '';


//   $unit_price = $unit_price * $sys_rate;

//   $sub_total = floatval($qty * $unit_price);
//   $total = floatval((((($qty * $unit_price)*$vat)/100)+$qty * $unit_price));
//   $main_total = $main_total + $total;
//   if($with_holding_tax == '1'){
//     $gross_with_tax_1 = $gross_with_tax_1 + $sub_total;
//     $total = $sub_total;
//   }else if($with_holding_tax == '3'){
//     $gross_with_tax_3 = $gross_with_tax_1 + $sub_total;
//     $total = $sub_total;
//   }else if($with_holding_tax == '7'){
//     $gross_with_tax_7 = $gross_with_tax_1 + $sub_total;
//     $total = $sub_total;
//   }


//   if($vat == 0){
//     $main_sub_non_vat_total = $main_sub_non_vat_total + $sub_total;
//   }else{
//     $main_sub_total = $main_sub_total + $sub_total;
//   }

//   // $main_sub_total = $main_sub_total + $sub_total;
  
//   $sub_total = number_format(floatval($sub_total),2);

//   $qty = number_format(floatval($qty), 2);
//   $unit_price = number_format(floatval($unit_price), 2);

//   $total = number_format(floatval($total), 2);

//   $pdf->SetFillColor(0, 0, 0);
//   $pdf->SetFont('THSarabunNew', '', 14, '', true);
//   //detail
//   $pdf->SetX(5);
//   $pdf->Cell(10, $height_table, "$k", 1, 0, 'C');
//   $pdf->Cell($description_col, $height_table, "$billing_item_name", 1, 0, 'L');
//   $pdf->Cell($small_col, $height_table, "$unit_price", 1, 0, 'R');
//   $pdf->Cell($small_col, $height_table, "$qty", 1, 0, 'R');
//   $pdf->Cell($small_col, $height_table, "Set", 1, 0, 'C');
//   $pdf->Cell($small_col, $height_table, "$vat%", 1, 0, 'C');
//   $pdf->Cell($small_col, $height_table, "$sub_total", 1, 0, 'R');
//   $pdf->Ln();
// }

// $amt_with_tax_1 = (($gross_with_tax_1 * 1)/100);
// $amt_with_tax_3 = (($gross_with_tax_3 * 3)/100);
// $amt_with_tax_7 = (($gross_with_tax_7 * 7)/100);

// $sum_with_holding_tax = $amt_with_tax_1 + $amt_with_tax_3 + $amt_with_tax_7;
// $gran_total = number_format(floatval($main_total - $sum_with_holding_tax),2);


// $amt_with_tax_1 = number_format(floatval($amt_with_tax_1),2);
// $amt_with_tax_3 = number_format(floatval($amt_with_tax_3),2);
// $amt_with_tax_7 = number_format(floatval($amt_with_tax_7),2);


// $gross_with_tax_1 = number_format(floatval($gross_with_tax_1),2);
// $gross_with_tax_3 = number_format(floatval($gross_with_tax_3),2);
// $gross_with_tax_7 = number_format(floatval($gross_with_tax_7),2);

// $main_total_vat_and_non = floatval($main_sub_non_vat_total + $main_sub_total);

// $main_vat = number_format(floatval($main_total - $main_total_vat_and_non),2) ;

// $main_sub_non_vat_total = number_format(floatval($main_sub_non_vat_total),2);
// $main_sub_total = number_format(floatval($main_sub_total),2);
// $main_total = number_format(floatval($main_total),2);





// $pdf->Cell(10, 4, "", 0, 'C');
// $pdf->Ln();

// // under table
// $pdf->SetX(5);
// $pdf->Cell(35, $height_table, "W/T TAX", 0, 0, 'C');
// $pdf->Cell(35, $height_table, "GROSS", 0, 0, 'C');
// $pdf->Cell(34, $height_table, "W/T AMR", 0, 0, 'C');
// $pdf->Cell(72, $height_table, "total Non-vat Amount :", 1, 0, 'L');
// $pdf->Cell(24, $height_table, "$main_sub_non_vat_total", 1, 0, 'R');
// $pdf->Ln();


// $pdf->SetX(5);
// $pdf->Cell(35, $height_table, "1%", 0, 0, 'C');
// $pdf->Cell(35, $height_table, "$gross_with_tax_1", 0, 0, 'C');
// $pdf->Cell(34, $height_table, "$amt_with_tax_1", 0, 0, 'C');
// $pdf->Cell(72, $height_table, "Total Vat Amount :", 1, 0, 'L');
// $pdf->Cell(24, $height_table, "$main_sub_total", 1, 0, 'R');
// $pdf->Ln();

// $pdf->SetX(5);
// $pdf->Cell(35, $height_table, "3%", 0, 0, 'C');
// $pdf->Cell(35, $height_table, "$gross_with_tax_3", 0, 0, 'C');
// $pdf->Cell(34, $height_table, "$amt_with_tax_3", 0, 0, 'C');
// $pdf->Cell(72, $height_table, "Vat :", 1, 0, 'L');
// $pdf->Cell(24, $height_table, "$main_vat", 1, 0, 'R');
// $pdf->Ln();

// $pdf->SetX(5);
// $pdf->Cell(35, $height_table, "7%", 0, 0, 'C');
// $pdf->Cell(35, $height_table, "$gross_with_tax_7", 0, 0, 'C');
// $pdf->Cell(34, $height_table, "$amt_with_tax_7", 0, 0, 'C');
// $pdf->Cell(72, $height_table, "Grand Total :", 1, 0, 'L');
// $pdf->Cell(24, $height_table, "$main_total", 1, 0, 'R');
// $pdf->Ln();

// $pdf->SetX(5);
// $pdf->Cell(104, $height_table, iconv('UTF-8', 'TIS-620', "จำนวนเงินที่ต้องจ่าย = $gran_total"), 1, 0, 'C');
// $pdf->Cell(72, $height_table, "Grand Total (deduct W/T tax):", 1, 0, 'L');
// $pdf->Cell(24, $height_table, "$gran_total", 1, 0, 'R');

// $pdf->Ln();
// $pdf->Ln();


// // $text = "บรรทัดที่ 1\nบรรทัดที่ 2\nบรรทัดที่ 3";

// // $pdf->MultiCell(104, 30, "test", 0, 'C');




// // results
// $pdf->SetX(5);
// $pdf->Cell(104, $height_table, "Received By", 0, 0, 'C');
// $pdf->Cell(96, $height_table, "Issued By", 0, 0, 'C');
// $pdf->Ln();
// $pdf->Ln();


// $pdf->SetX(5);
// $pdf->Cell(104, $height_table, ".......................................................................", 0, 0, 'C');
// $pdf->Cell(96, $height_table, "........................................................", 0, 0, 'C');
// $pdf->Ln();


// $pdf->SetX(5);
// $pdf->Cell(104, $height_table, "Received Date ......../.........../...........", 0, 0, 'C');
// $pdf->Cell(96, $height_table, "Issued Date .........../.........../...........", 0, 0, 'C');
// $pdf->Cell(96, 7, "", 0, 0, 'C');
// $pdf->Ln();



// foreach ($footer_data as $k => $v) {

//   $corp_name = isset($v['corp_name']) ? $v['corp_name'] : '';
//   $footer_1 = isset($v['footer_1']) ? $v['footer_1'] : '';
//   $footer_2 = isset($v['footer_2']) ? $v['footer_2'] : '';
//   $footer_3 = isset($v['footer_3']) ? $v['footer_3'] : '';
//   $footer_4 = isset($v['footer_4']) ? $v['footer_4'] : '';
//   $footer_5 = isset($v['footer_5']) ? $v['footer_5'] : '';
//   $footer_6 = isset($v['footer_6']) ? $v['footer_6'] : '';
//   $footer_7 = isset($v['footer_7']) ? $v['footer_7'] : '';
//   $footer_8 = isset($v['footer_8']) ? $v['footer_8'] : '';
//   $footer_9 = isset($v['footer_9']) ? $v['footer_9'] : '';
//   $footer_10 = isset($v['footer_10']) ? $v['footer_10'] : '';

//   $pdf->SetX(10);
//   $pdf->SetFont('THSarabunNew', 'B', 14, '', true);
//   if ($footer_1 != '') {
//     $pdf->Cell(0, $set_top_detail, "$footer_1", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_2 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_2", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_3 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_3", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_4 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_4", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_5 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_5", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_6 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_6", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_7 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_7", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_8 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_8", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_9 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_9", 0, 0, 'L');
//     $pdf->Ln();
//   }

//   if ($footer_10 != '') {
//     $pdf->SetX(10);
//     $pdf->Cell(0, $set_top_detail, "$footer_10", 0, 0, 'L');
//     $pdf->Ln();
//   }
// }















$pdf->Output('I', 'report.pdf');
