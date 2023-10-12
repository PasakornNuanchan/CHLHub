<?php
require '../../vendor/autoload.php'; // นำเข้า autoload ของไลบรารี
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// สร้าง Spreadsheet
$spreadsheet = new Spreadsheet();

// สร้าง worksheet
$sheet = $spreadsheet->getActiveSheet();

// เพิ่มรูปภาพ
$drawing = new Drawing();
$drawing->setName('Sample image');
$drawing->setDescription('Sample image');
//$drawing->setPath('path_to_your_image.jpg'); // เปลี่ยนเป็นที่อยู่ของรูปของคุณ
$drawing->setCoordinates('A1');

$sheet->setCellValue('A10', 1);
$sheet->setCellValue('B1', 2);
$sheet->setCellValue('C1', 3);
$sheet->setCellValue('D1', 4);
$drawing->setWorksheet($sheet);

// บันทึกไฟล์ Excel
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('sample.xlsx');
