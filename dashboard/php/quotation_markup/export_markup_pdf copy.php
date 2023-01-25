<?php
    require('../../core/conn.php');
    $quotation_number = isset($_GET['quo_no']) ? $_GET['quo_no'] : '';
    $sql = "
    SELECT
        qt.`ID`,
        qt.quartation_number as 'title_number',
        qt.consignee_number as 'title_consignee_number',
        qt.term as 'title_term',
        qt.commodity as 'title_commodity',
        qt.type as 'title_type',
        qt.user_sale as 'title_user_sale',
        user.first_name,
        user.last_name,
        qt.status as 'title_status'
    FROM
        `quartation_title` as qt
        LEFT JOIN user on user.ID = qt.user_sale
    WHERE
        qt.quartation_number = ?;
    ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $quotation_number);
    $stmt->execute();
    $result = $stmt->get_result();

    //base
    $sql_base = "
        SELECT DISTINCT
            qdb.`ID`,
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


    $result_title_array = array();
    $result_base_array = array();
    $result_truck_array = array();
    $result_sup_array = array();
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



    require('../../lib/fpdf/fpdf.php');   
    class PDF extends FPDF
    {
        function Header()
        {
            $this->AddFont('THSarabunNew','','THSarabunNew.php');
            $this->AddFont('THSarabunNew','B','THSarabunNew_b.php');
            $this->SetFont('THSarabunNew','B',16);
            $this->SetXY(10,0);
            $img_path = '../../../assets/images/pdf/';
            $this->Image($img_path.'CHL_logo.png', 10,10, -330);
            $this->Ln();
            $this->SetXY(10,40);
            $this->Cell(190, 7, iconv('UTF-8', 'cp874', 'ใบเสนอราคา (QUOTATION)') ,1,1,'C');
            $this->Cell(190, 7, iconv('UTF-8', 'cp874', 'บริการขาออก-ขาเข้า (EXPORT-IMPORT Service)') ,1,1,'C');

            $this->SetXY(10,60);
            $this->Cell(95, 6, iconv('UTF-8', 'cp874', 'Make by : ') ,1,0,'L');
            $this->Cell(95, 6, iconv('UTF-8', 'cp874', 'Date by : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'CTC : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'POL : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'POD : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'Destination : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'Term : ') ,1,1,'L');
            $this->Cell(190, 6, iconv('UTF-8', 'cp874', 'Commodity : ') ,1,1,'L');
        }

        function Footer()
        {
            // Code to create the footer
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    //table header
    $pdf->SetXY(10,$pdf->GetY() + 10);
    $pdf->Cell(20, 6, iconv('UTF-8', 'cp874', 'Item No. ') ,1,0,'C');
    $pdf->Cell(65, 6, iconv('UTF-8', 'cp874', 'Description') ,1,0,'C');
    $pdf->Cell(65, 6, iconv('UTF-8', 'cp874', 'Unit Price') ,1,0,'C');
    $pdf->Cell(40, 6, iconv('UTF-8', 'cp874', 'Unit') ,1,1,'C');
    //end table header

    $num = 0;
    foreach ($result_base_array as $k => $v) {
        $num += 1;
        $pdf->Cell(20, 6, iconv('UTF-8', 'cp874', $num) ,1,1,'C');

    }
    
    $pdf->Output('I','example.pdf');

?>