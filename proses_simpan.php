<?php
include "koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$gender = $_POST['gender'];
$bertemu = $_POST['bertemu_dengan'];
$tanggal_jam = $_POST['tanggal_jam'];
$keperluan = $_POST['keperluan'];
$jawaban = $_POST['jawaban_video'];

$foto_ktp = $_FILES['foto_ktp']['name'];
$tmp_name = $_FILES['foto_ktp']['tmp_name'];
$upload_dir = "uploads/";

if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
$target_file = $upload_dir . basename($foto_ktp);
move_uploaded_file($tmp_name, $target_file);

$sql = "INSERT INTO tamu (nama, alamat, no_telp, gender, foto_ktp, bertemu_dengan, tanggal_jam, keperluan, jawaban_video)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssssss", $nama, $alamat, $no_telp, $gender, $foto_ktp, $bertemu, $tanggal_jam, $keperluan, $jawaban);
mysqli_stmt_execute($stmt);

echo "Data berhasil disimpan. <a href='index.php'>Kembali</a>";
?>
