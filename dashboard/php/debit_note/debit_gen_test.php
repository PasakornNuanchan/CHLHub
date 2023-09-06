<?php
require '../../lib/vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
// mockup data by json file ex. you can use retrive data from db.
$json = file_get_contents('employee.json');
$employees = json_decode($json, true);
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
 
// cell value
$spreadsheet->getActiveSheet()->setCellValue('A1', 'ทดสอบภาษาไทย by ITOFFSIDE.COM');
$spreadsheet->getActiveSheet()->setCellValue('A2', 12345.6789);
$spreadsheet->getActiveSheet()->setCellValue('A3', true);
$spreadsheet->getActiveSheet()->setCellValue(
    'A4',
    '=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))'
);
 
// style
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
    );
 
$writer = new Xlsx($spreadsheet);
 
// save file to server and create link
$writer->save('excel/itoffside.xlsx');
echo '<a href="excel/itoffside.xlsx">Download Excel</a>';
