<?php
require('../../core/conn.php');
$quotation_number = isset($_GET['quo_no']) ? $_GET['quo_no'] : '';
$sql = "
    SELECT
        qt.`ID`,
        qt.quartation_number AS 'title_number',
        qt.consignee_number AS 'title_consignee_number',
        qt.term AS 'title_term',
        qt.commodity AS 'title_commodity',
        qt.type AS 'title_type',
        qt.user_sale AS 'title_user_sale',
        USER.first_name,
        USER.last_name,
        qt.status AS 'title_status',
        consignee.consignee_name as 'consignee_name',
        GROUP_CONCAT(pol_a.location_name SEPARATOR ', ') as 'pol_locations',
        r.route_number,
        GROUP_CONCAT(pod_a.location_name SEPARATOR ', ') as 'pod_locations',
        destination,
        shipment_term.st_name,
        qt.commodity,
        CONCAT(us.first_name , ' ' ,us.last_name) as 'sale_user',
        qt.create_datetime

    FROM
        `quartation_title` AS qt
    LEFT JOIN USER ON USER.ID = qt.user_sale
    JOIN consignee on consignee.consignee_number = qt.consignee_number
    JOIN quartation_detail_base qdb ON qdb.quartation_number = qt.quartation_number
    JOIN route r on r.route_number = qdb.base_service_route
    JOIN area as pol_a on pol_a.area_number = r.pol
    JOIN area as pod_a on pod_a.area_number = r.pod
    JOIN shipment_term on qt.term = shipment_term.ID
    JOIN `user` us on us.ID = qt.user_sale

    JOIN (SELECT
        GROUP_CONCAT(`dropoff` ORDER BY `type` DESC ,`ID` ASC SEPARATOR ', ') as destination,
        `quotation_number`
    FROM
        `quotation_detail_trucking`
        WHERE `quotation_number` = ?
    GROUP BY quotation_number
        ORDER by type desc) as dtnt
    ON qt.quartation_number = dtnt.quotation_number
    WHERE
        qt.quartation_number = ?
    GROUP BY
        qt.quartation_number;
    ";

$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $quotation_number, $quotation_number);
$stmt->execute();

$result = $stmt->get_result();
//base
$sql_base = "
        SELECT DISTINCT
            qdb.`ID`,
            qdb.`qty`,
            r.carrier_number as 'r_number',
            cr.carrier_name as 'r_carrier_name',
            r.pol as 'r_pol',
            arl.location_name as 'locateL',
            r.pod as 'r_pod',
            ard.location_name as 'locateD',
            r.container_type as 'r_container_type',
            r.price as 'r_price',
            (qdb.qty*qdb.unit_price) as 'price_qty',
            qdb.remark as 'r_remark',
            qdb.markup_price as 'r_markup',
            r.currency as 'r_curr'
        FROM
            `quartation_detail_base` as qdb
            LEFT JOIN route r on qdb.base_service_route = r.route_number
            INNER JOIN area arl on arl.area_number = r.pol
            INNER JOIN area ard on ard.area_number = r.pod
            LEFT JOIN carrier cr on cr.carrier_number = r.carrier_number 
        WHERE 1 AND
            qdb.quartation_number = ?;
    ";
$stmt_base = $con->prepare($sql_base);
$stmt_base->bind_param("s", $quotation_number);
$stmt_base->execute();
$result_base = $stmt_base->get_result();

//truck
$sql_truck = "
        SELECT
            `ID`,
            `quotation_number`,
            `type`,
            `pickup`,
            `dropoff`,
            `price`,
            `remark`,
            `markup`,
            `currency`
        FROM
            `quotation_detail_trucking` qdt
        WHERE
            1 AND `quotation_number` = ?
    ";
$stmt_truck = $con->prepare($sql_truck);
$stmt_truck->bind_param("s", $quotation_number);
$stmt_truck->execute();
$result_truck = $stmt_truck->get_result();

//sup_service
$sql_sup = "
        SELECT
            qds.`ID`,
            qss.description,
            qds.`quotation_number`,
            qds.`type`,
            qds.`price`,
            qds.`currency`,
            qds.`markup`,

            qds.`remark`
        FROM
            `quotation_detail_supservice` qds 
            LEFT JOIN quotation_sup_service qss on qss.ID = qds.description
        WHERE
            1 AND `quotation_number` = ?
    ";
$stmt_sup = $con->prepare($sql_sup);
$stmt_sup->bind_param("s", $quotation_number);
$stmt_sup->execute();
$result_sup = $stmt_sup->get_result();

//Remark PDF
$sql_remark_pdf = "
    SELECT
        `quotation_number`,
        `remark`
    FROM
        `quotation_markup_remark`
    WHERE
        1
        AND `quotation_number` = ?
    ";
$stmt_remark_pdf = $con->prepare($sql_remark_pdf);
$stmt_remark_pdf->bind_param("s", $quotation_number);
$stmt_remark_pdf->execute();
$result_remark_pdf = $stmt_remark_pdf->get_result();



$result_title_array = array();
$result_base_array = array();
$result_truck_array = array();
$result_sup_array = array();
$result_remark_pdf_array = array();
$result_array = array();
while ($row = $result->fetch_assoc()) {
    $result_title_array = $row;
}

while ($row = $result_base->fetch_assoc()) {
    $result_base_array[] = $row;
}
while ($row = $result_truck->fetch_assoc()) {
    $result_truck_array[] = $row;
}
while ($row = $result_sup->fetch_assoc()) {
    $result_sup_array[] = $row;
}
while ($row = $result_remark_pdf->fetch_assoc()) {
    $result_remark_pdf_array = $row;
}


// require('../../lib/fpdf/fpdf.php');   
require('../../lib/tcpdf/tcpdf.php');


class PDF extends TCPDF
{
    public function Header()
    {
        global $result_title_array;
        $date_str = $result_title_array['create_datetime'];
        $date = new DateTime($date_str);
        $date_created = $date->format('d/m/Y H:i');
        // $this->AddFont('THSarabunNew','','THSarabunNew.php');
        // $this->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        // $this->SetFont('THSarabunNew','B',16);
        $this->SetFont('freeserif', '', 12, '', true);

        $this->SetXY(10, 0);
        $img_path = '../../../assets/images/pdf/';
        $this->Image($img_path . 'CHL_logo.jpg', 50, 12, 120, '', '', 'http://www.tcpdf.org', '', false, 300);
        $this->Ln();
        $this->SetXY(10, 30);
        $this->Cell(190, 7, 'ใบเสนอราคา (QUOTATION)', 0, 1, 'C');
        $this->Cell(190, 7, 'บริการขาออก-ขาเข้า (EXPORT-IMPORT Service)', 0, 1, 'C');

        $this->SetXY(10, 50);
        $this->Cell(95, 6, 'Make by : ' . $result_title_array['sale_user'], 0, 0, 'L');
        $this->Cell(95, 6, 'Date by : ' . $date_created, 0, 1, 'L');
        $this->Cell(190, 6, 'CTC : ' . $result_title_array['consignee_name'], 0, 1, 'L');
        $this->Cell(190, 6, 'POL : ' . $result_title_array['pol_locations'], 0, 1, 'L');
        $this->Cell(190, 6, 'POD : ' . $result_title_array['pod_locations'], 0, 1, 'L');
        $this->Cell(190, 6, 'Destination : ' . $result_title_array['destination'], 0, 1, 'L');
        $this->Cell(190, 6, 'Term : ' . $result_title_array['st_name'], 0, 1, 'L');
        $this->Cell(190, 6, 'Commodity : ' . $result_title_array['commodity'], 0, 1, 'L');

        //table header
        $this->SetXY(10, $this->GetY() + 20);
        $this->Cell(20, 6, 'Item No. ', 1, 0, 'C');
        $this->Cell(65, 6, 'Description', 1, 0, 'C');
        $this->Cell(65, 6, 'Unit Price', 1, 0, 'C');
        $this->Cell(40, 6, 'Unit', 1, 1, 'C');
        //end table header
    }
    public function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set the font style for the footer
        $this->SetFont('helvetica', 'I', 8);
        // Output the page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(10, 118);
$pdf->SetFont('freeserif', '', 10, '', true);

$num = 0;

foreach ($result_base_array as $k => $v) {
    if ($pdf->GetY() >= 220) {
        $pdf->AddPage();
        $pdf->setXY(10, 118);
    }
    $num++;
    $markup_val = '';
    if ($v['r_markup'] == 0 || !(isset($v['r_markup']))) {
        $markup_val = 'Cost if any';
    } else {
        $markup_val = number_format($v['r_markup'] * $v['qty'], 2) . '.-';
    }
    $pdf->Cell(20, 6, $num, 1, 0, 'C');
    $pdf->Cell(65, 6, $v['r_carrier_name'] . ' : ' . $v['r_container_type'], 1, 0, 'L');
    $pdf->Cell(65, 6, $markup_val, 1, 0, 'R');
    $pdf->Cell(40, 6, $v['qty'], 1, 1, 'C');
}


$array_import = array();
$array_export = array();

foreach ($result_truck_array as $k => $v) {
    if ($v['type'] == 'import') {
        $array_import['truck'][] = $v;
    } else if ($v['type'] == 'export') {
        $array_export['truck'][] = $v;
    }
}
foreach ($result_sup_array as $k => $v) {
    if ($v['type'] == 'Import') {
        $array_import['sup'][] = $v;
    } else if ($v['type'] == 'Export') {
        $array_export['sup'][] = $v;
    }
}

// print_r($array_import);
#Import

if (!empty($array_import)) {
    if (array_key_exists('truck', $array_import)) {
        $pdf->Cell(190, 6, ' Import ', 1, 1, 'L');
        foreach ($array_import['truck'] as $k => $v) {
            if ($pdf->GetY() >= 220) {
                $pdf->AddPage();
                $pdf->setXY(10, 118);
            }
            $num++;
            $markup_val = '';
            if ($v['markup'] == 0 || !(isset($v['markup']))) {
                $markup_val = 'Cost if any';
            } else {
                $markup_val = number_format($v['markup'], 2) . '.-';
            }
            $pdf->Cell(20, 6, $num, 1, 0, 'C');
            $pdf->Cell(65, 6, $v['type'] . ' : ' . $v['pickup'] . '-' . $v['dropoff'], 1, 0, 'L');
            $pdf->Cell(65, 6,  $markup_val, 1, 0, 'R');
            $pdf->Cell(40, 6, ' - ', 1, 1, 'C');
        }
    }
    if (array_key_exists('sup', $array_import)) {
        foreach ($array_import['sup'] as $k => $v) {
            if ($pdf->GetY() >= 220) {
                $pdf->AddPage();
                $pdf->setXY(10, 118);
            }
            $markup_val = '';
            if ($v['markup'] == 0 || !(isset($v['markup']))) {
                $markup_val = 'Cost if any';
            } else {
                $markup_val = number_format($v['markup'], 2) . '.-';
            }

            $num++;
            $pdf->Cell(20, 6, $num, 1, 0, 'C');
            $pdf->Cell(65, 6, $v['type'] . " : " . $v['description'], 1, 0, 'L');
            $pdf->Cell(65, 6, $markup_val, 1, 0, 'R');
            $pdf->Cell(40, 6, ' - ', 1, 1, 'C');
        }
    }
}


#Export
if (!empty($array_export)) {
    if ($pdf->GetY() >= 220) {
        $pdf->AddPage();
        $pdf->setXY(10, 118);
        $pdf->Cell(190, 6, ' Export ', 1, 1, 'L');
    }
    if (array_key_exists('truck', $array_export)) {
        foreach ($array_export['truck'] as $k => $v) {
            if ($pdf->GetY() >= 220) {
                $pdf->AddPage();
                $pdf->setXY(10, 118);
            }
            $markup_val = '';
            if ($v['markup'] == 0 || !(isset($v['markup']))) {
                $markup_val = 'Cost if any';
            } else {
                $markup_val = number_format($v['markup'], 2) . '.-';
            }
            $num += 1;
            $pdf->Cell(20, 6, $num, 1, 0, 'C');
            $pdf->Cell(65, 6, $v['type'] . ' : ' . $v['pickup'] . '-' . $v['dropoff'], 1, 0, 'L');
            $pdf->Cell(65, 6, $markup_val, 1, 0, 'R');
            $pdf->Cell(40, 6, ' - ', 1, 1, 'C');
        }
    }
    if (array_key_exists('sup', $array_export)) {
        foreach ($array_export['sup'] as $k => $v) {
            if ($pdf->GetY() >= 220) {
                $pdf->AddPage();
                $pdf->setXY(10, 118);
            }
            $num++;
            $markup_val = '';
            if ($v['markup'] == 0 || !(isset($v['markup']))) {
                $markup_val = 'Cost if any';
            } else {
                $markup_val = number_format($v['markup'], 2) . '.-';
            }
            $pdf->Cell(20, 6, $num, 1, 0, 'C');
            $pdf->Cell(65, 6, $v['type'] . " : " . $v['description'], 1, 0, 'L');
            $pdf->Cell(65, 6, $markup_val, 1, 0, 'R');
            $pdf->Cell(40, 6, ' - ', 1, 1, 'C');
        }
    }
}


if ($pdf->GetY() >= 220) {
    $pdf->AddPage();
    $pdf->setXY(10, 118);
}
$pdf->SetY(-75);
//html to pdf here
$remark =  (isset($result_remark_pdf_array['remark']) ? $result_remark_pdf_array['remark'] : '');
$pdf->writeHTML($remark, true, false, true, false, '');
$pdf->SetXY(140,-35);
$pdf->Cell(50, 6, '-----------------------------', 0, 1, 'C');
$pdf->SetXY(140,-30);
$pdf->Cell(50, 6, $result_title_array['sale_user'], 0, 1, 'C');


$pdf->Output('example.pdf', 'I');
