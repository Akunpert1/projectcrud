<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-roti.php';
// Membuat objek dari class Mahasiswa
$roti = new roti();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataroti = [
    'kode' => $_POST['kode'],
    'nama' => $_POST['nama'],
    'toping' => $_POST['toping'],
    'jumlah' => $_POST['jumlah'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $roti->inputroti($dataroti);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>