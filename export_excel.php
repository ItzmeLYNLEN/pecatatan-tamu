<?php
require 'vendor/autoload.php';
include "koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->fromArray([
  'ID', 'Nama', 'Alamat', 'No Telp', 'Gender', 'Foto KTP', 'Bertemu Dengan',
  'Tanggal Jam', 'Keperluan', 'Jawaban Video', 'Waktu Submit'
], NULL, 'A1');

$query = mysqli_query($conn, "SELECT * FROM tamu");
$row = 2;
while ($data = mysqli_fetch_assoc($query)) {
  $sheet->fromArray(array_values($data), NULL, 'A' . $row);
  $row++;
}

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data_tamu.xlsx"');
$writer->save('php://output');
exit;
?>
