<?php
require 'PhpSpreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// 創建一個新的Spreadsheet對象
$spreadsheet = new Spreadsheet();

// 編輯Excel文件，設置標題和數據
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', '姓名');
$sheet->setCellValue('B1', '年齡');
$sheet->setCellValue('A2', 'John');
$sheet->setCellValue('B2', 25);
$sheet->setCellValue('A3', 'Jane');
$sheet->setCellValue('B3', 30);

// 創建一個新的Xlsx寫入器對象，並將Spreadsheet對象保存到文件中
$writer = new Xlsx($spreadsheet);
$writer->save('example.xlsx');
