<?php

include_once '../config/class-roti.php';
$roti = new roti();

// Mengambil data dari POST dengan default jika tidak ada
$dataroti = [
    'kode' => $_POST['kode'] ?? '',
    'nama' => $_POST['nama'] ?? '',
    'toping' => $_POST['toping'] ?? '',
    'jumlah' => $_POST['jumlah_box'] ?? '',
    'alamat' => $_POST['alamat'] ?? '',
    'provinsi' => $_POST['provinsi'] ?? '',
    'email' => $_POST['email'] ?? '',
    'telp' => $_POST['telp'] ?? '',
    'status' => $_POST['status'] ?? ''
];

$edit = $roti->editroti($dataroti);

if($edit){
    header("Location: ../data-list.php?status=editsuccess");
} else {
    header("Location: ../data-edit.php?id=".$dataroti['kode']."&status=failed");
}

?>
