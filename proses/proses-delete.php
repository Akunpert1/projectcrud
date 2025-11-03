<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-roti.php';
// Membuat objek dari class Mahasiswa
$roti = new roti();
// Mengambil id mahasiswa dari parameter GET
$id = $_GET['id'];
// Memanggil method deleteMahasiswa untuk menghapus data mahasiswa berdasarkan id
$delete = $roti->deleteroti($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>